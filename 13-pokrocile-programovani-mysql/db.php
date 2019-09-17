<?php

/* LOAD DATA INFILE

LOAD DATA INFILE "newbooks.txt" INTO TABLE books;
- souboru newbooks.txt je nutné oddělovat pole v tomto souboru pomocí tabulátorů a obalujete je do apostrofů, přičemž řádky jsou mezi sebou oddělené znakem nového řádku (\n).
Speciální znaky musíte escapovat zpětným lomítkem (\). Abyste mohli spouštět příkaz, musíte mít oprávnění FILE.

*/

/* Transakce v databázovém úložišti InnoDB

  #nejdříve je potřeba vypnout režim autocommit pro aktuální relaci
  SET AUTOCOMITT = 0;
  
  #zahájení transakce v případě, že je režím autocommit zapnutý je potřeba zahájit transakci příkazem jinak se spustí s prvním SQL příkazem
  START TRANSACTION;
  
  #po dokončení příkazů transakce je commmitneme do databáze
  COMMIT;
  
  #pokud změníme názor vrátíme databázi do původního stavu
  ROLLBACK;
  
  Dokud necommitnete transakci, ostatní uživatelé ji neuvidí ani nebude viditelná v jiných relacích
	    
*/

/* Cizí klíče
   Databázové úložiště podporuje cizí klíče a zajišťuje referenční integritu.
*/

/* Uložené procedury

 #Základní příklad uložené procedury
 DELIMITER //           #měníme oddělovač z ; na // aby se příkazy hned neprovedly
 
 CREATE PROCEDURE Total_Orders (OUT Total FLOAT)             #vytvoření procedury - Total je výstupní parametr
 BEGIN
   SELECT SUM(amount) INTO total FROM ORDERS;
 END
 //
 DELIMITER ;           #vracíme původní oddělovač

 #Volání procedury
 CALL Total_Orders(@t);
 SELECT @t;   #zobrazí výsledek
 
 #Funkce - přijímá pouze vstupní parametry a vrací jedinou hodnotu
 #Základní příklad funkce
 DELIMITER //            #měníme oddělovač z ; na // aby se příkazy hned neprovedly
 
 CREATE FUNCTION Add_Tax(Price FLOAT) RETURNS FLOAT NO SQL
   RETURN Price*1.2
 
 //
 DELIMITER ;           #vracíme původní oddělovač
 
 #volání funkce
 SELECT Add_Tax(100);
 
 
 #Zobrazení kódu procedur a funkcí
 SHOW CREATE PROCEDURE Total_Orders;
 SHOW CREATE FUNCTION Add_Tax;
 
 #Smazání procedur a funkcí
 DROP PROCEDURE Total_Orders;
 DROP FUNCTION Add_Tax;
 
 ###Lokální proměnné
 DELIMITER //
 CREATE FUNCTION Add_Tax(Price FLOAT) RETURN FLOAT NO SQL
 BEGIN
   DECLARE Tax FLOAT DEFAULT 0.20;
   RETURN Price*(1+Tax);
 END
 //
 DELIMITER ;   
 
*/

/* Kurzory a řídící struktury

   # Tato procedura hled8 OrderID objednávky s nejvyšší cenou.
   # Stejného výsledku je možné dosáhnout s funkcí MAX, ale tento příklad 
   # demonstruje principy uložených procedur.
   
   //handler se spustí, když dotaz již nevrátí žádné řádky - nastaví se Done=1
   //příkazem CLOSE zavíráme kurzor
   //parametr Largest_ID nelze použít jako dočasnou proměnnou, uloží se do ní jen finální výsledek
   
   DELIMITER //
   
   CREATE PROCEDURE Largest_Order (OUT Largest_ID INT)
   BEGIN
     DECLARE This_ID INT;
	 DECLARE This_Amount FLOAT;
	 DECLARE L_Amount FLOAT DEFAULT 0.0;	 
	 DECLARE L_ID INT;
	 
	 DECLARE Done INT DEFAULT 0;
	 DECLARE C1 CURSOR FOR SELECT OrderID, Amount FROM Orders;
	 DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET Done = 1;  
	 
	 OPEN C1;
	 REPEAT
	   FETCH C1 INTO This_ID, This_Amount;
	   IF NOT Done THEN
	     IF This_Amount > L_Amount THEN
		   SET L_Amount = This_Amount;
		   SET L_ID = This_ID;
		 END IF;
	   END IF;
	   UNTIL Done END REPEAT;
	 CLOSE C1;
	 
	 SET LARGEST_ID = L_ID;
	 
  END
  //
  
  DELIMITER ;

  
  //použití
  CALLL Largest_Order(@l);
  SELECT @l;
  
*/

/* ******** Triggery ***********
   Trigerry jsou speciální uložené rutiny (nebo funkce zpětného volání), které reagují na událsoti. Jedná se o kód vázaný na určtiou
   tabulku, jenž se provede, když dojde k určité akci na této tabulce.
   
   Trigger vypadá následovně:
   CREATE TRIGGER nazev_triggeru
   {BEFORE | AFTER} {INSERT | UPDATE | DELETE} ON tabulka
   [poradi] // umožňuje spouštět více triggerů pro danou kombinaci časování/události a to v určitém pořadí - formát klauzule {FOLLOWS | PRECEDES} jiny_trigger
   FOR EACH ROW
   BEGIN
     ...
   END
   
   Příklad:
   
   DELIMITER //
   
   #maže order_items před smazáním order, aby zabránil chybě referenční integrity
   CREATE TRIGGER Delete_Order_Items
   BEFORE DELETE ON Orders FOR EACH ROW
   BEGIN
     DELETE FROM Order_Items WHERE OLD.OrderID = OrderID;  #klíčové slovo OLD = použij hodnotu tohoto sloupce před spuštěním dotazu
   END
   //
   
   DELIMITER ;
   
   
   //zobrazení triggeru	
   SHOW CREATE TRIGGER Delete_Order_Items;

   #mezi další běžné případy užití triggerů patří přeformátování dat nebo zaznamenávání změn (co, kdy a kým bylo změněno)   
	
	
*/


?>