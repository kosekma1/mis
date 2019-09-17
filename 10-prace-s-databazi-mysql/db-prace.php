<?php

/* Vkládání dat do databáze  */

/* insert [INTO] tabula [(sloupec1, sloupec2, ...) VALUES ( hodnota1, hodnota2, ...) ] */
/* Příklad 1
   insert into Customers (name, city) values ('Milada Jonášová', 'Hradec Králové');
   
   Příklad 2: bez uvedení sloupců je potřeba zadat všechny hodnoty sloupců ve správném pořadí, které se vkládají do tabulky
   insert into Customers values ('Milada Jonášová', 'Dubová 25', 'Hradec Králové'); 
   
   Příklad 3: vkládání více řádků najednou
   insert into Customers (name, city) values ('Milada Jonášová', 'Hradec Králové'), values ('Emil Zelený', 'Plzeň'), values ('Petr', 'Modrý');   
 */
 
 /* Vkládání dat do databáze se skriptu
    mysql - h hostitel -u user_name -p databasename < skript.sql 
 */

 /* Změna kódování pro konkrétní tabulku
    ALTER TABLE Book_Reviews CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;
	
	Nastavení kódování při vytváření databáze
	CREATE DATABASE mydatabase CHARACTER SET utf8 COLLATE utf8_general_ci; 
 */
 
 /* Načítání dat z databáze */
 /* 
    SELECT [nastaveni] polozky
    [INTO info_o_souboru]
	FROM [tabulky]
	[PARTITION sekce]
	[WHERE podminky]
	[GROUP BY typ_skupiny]
	[HAVING definice_where]
	[ORDER BY typ_razeni]
	[LIMIT omezeni]
	[PROCEDURE nazev_procedury(argumenty)]
	[INTO cil]
	[nastaveni_zamku];
 */
 
 /* Základní výběry SQL
 
    #vybere včechny řádky z tabulky customers a jen sloupce name a city 
	SELECT name, city FROM customers;
	
	#vybere včechny řádky a sloupce z tabulky order_items
	SELECT * FROM order_items;	
	
	#vybere včechny řádky z tabulky orders, kde je ve sloupci customerid hodnota 3
	SELECT * FROM orders 
	WHERE customerid=3
	
	#vyhledávání dle jednoduchého vzoru
	# procento % znamená libovolný počet znaků, podtržítko _ znamená jeden znak
	SELECT * FROM customers
	WHERE name LIKE "%ý";
	
	SELECT * FROM customers
	WHERE name LIKE "_a%";
		
	#Klíčové slovo REGEXP umožňuje vyhledávat podle regulárního výrazu. Sytém MySQL používá regulární
	výrazy POSIX. Klíčové slovo REGEXP můžete nahraidt jeho synonymem RLIKE. Syntaxe regulárních výrazů POPIX se
	mírně liší od regulárních výrazů PCRE z jazyka PHP. Jazyk PHP dříve podporoval také regulární výrazy POSIX, ale nyní už
	jsou v něm označeny jako zastaralé.
 
	#Vyhledávání podle více kritérií
	SELECT * FROM orders WHERE customerid=3 or customerid=4;
 
 */
 
 /* Načítání z více tabulek
    
	#zjištění které objednávky odeslala Jana Nováková
	SELECT orders.orderid, orders.amount, orders.date
	FROM customers, orders
	WHERE customers.name = 'Jana Nováková' AND customers.customerid = orders.customerid;
 
	#zjištění zákazníků, kteří odeslali nějakou objednávku, jež obsahovala jako položku knihu o systému MySQL
	SELECT customers.name
	FROM customers, orders, order_items, books
	WHERE customers.customerid = orders.customerid AND orders.orderid = order_items.orderid
	AND order_items.isbn = books.isbn and
	books.title like "%MySQL%";
	
	#zobrazení všech zákazníků s jejich objednávkami bez NULL, kartézský součin s výběrem (úplné spojení) - stačí čárka mezi tabulkami znamená INNER JOIN nebo CROSS JOIN
	SELECT customers.customerid, customers.name, orders.orderid
	FROM customers, orders WHERE customers.customerid = orders.orderid;
	
	#hledání řádků, které neodpovídají kritériím - levé spojení
	#seznam zákazníků, kteří si někdy něco objednali
	SELECT customers.customerid, customers.name, orders.orderid
	FROM customers left join orders
	ON customers.customerid = orders.customerid;
	
	#seznam zákazníků, kteří si nikdy nic neobjednali
	SELECT customers.customerid, customers.name
	FROM customers LEFT JOIN orders
	USING(customerid)	
	WHERE orders.orderid IS NULL;
	
	#zobrazení všech zákazníků s jejich objednávkami - i NULL
	#sloupec v klauzuli USING musí být v obou tabulkách se stejným názvem
	SELECT customers.customerid, customers.name, orders.orderid
	FROM customers LEFT JOIN orders
	USING(customerid);					
 
 */
 
 /* Používání jiných názvů pro tabulky - aliasy
	
	SELECT c.name
	FROM customers AS c, orders AS o, order_items AS oi, books AS b
	WHERE c.customerid=o.customerid AND o.orderid = oi.orderid AND oi.isbn = b.isbn AND b.title LIKE "%MySQL%";
	
	#alisy se hodí pro dotazy na spojení tabulky samu se sebou
	#výběr zákazníků, kteří bydlí ve stejném městě
	SELECT c1.name, c2.name, c1.city
	FROM customers as c1, customers as c2
	WHERE c1.city = c2.city AND c1.name != c2.name;	
 */
 
 /* Načítání dat v určitém pořadí
 
	#seřezaní výběru podle jména - výchozí řazení je od nejmenší po největší
	SELECT name, address
	FROM customers
	ORDER BY name;
	
	#řazení od nejmenší po největšího - není nuté ASC specifikovat jělikož se jedná o výchozí chování
	SELECT name, address
	FROM customers
	ORDER BY name ASC;
	
	#řazení od největšího po nejmenší
	SELECT name, address
	FROM customers
	ORDER BY name DESC;
 
 */
 
 /* Seskupování a agregování dat
 
	#spočítá průměr pro sloupec amount - tedy průměrnou výši objednávky
	SELECT AVG(amount)
	FROM orders;
	
	#spočítá průměrnou objednávku pro jednotlivé zákazníky - využití group by - sloupec v GROUP BY musí být i v SELECT aby dotaz fungoval
	SELECT customerid, AVG(amount)
	FROM orders
	GROUP BY customerid;
	
	#výběr objednávek dle zákazníka s průměrnou výši objednávku vyšší než 600. HAVING lze použít jen na skupiny (GROUP)
	SELECT customerid, AVG(amount)
	FROM orders
	GROUP by customerid
	HAVING AVG(amount) > 600;
	
 */
 
 /* Vybíráme řádky, které chceme vrátit
 
	#výběr dvou prvních řádků
	SELECT name
	FROM customers
	LIMIT 2;
	
	#výběr tří řádků, začínáme od druhého - 0 = 1. řádek
	SELECT name
	FROM customers
	LIMIT 2,3;
 */
 
 /* Poddotazy
 
    #základní poddotaz - výběr objednávky s nejvyšší výší objednávky
	SELECT customerid, amount
	FROM orders
	WHERE amount = (SELECT MAX(amount) FROM orders);
 
	#stejného výsledku jako v předchozím dotazu lze dosáhnout
	SELECT customerid, amount
	FROM orders
	ORDER BY amount
	LIMIT 1;
	
	#související poddotazy
	#výběr knih, které si nikdo neobjednal - použití operátoru EXISTS
	#ve vnitřním dotazu používáme tabulku z vnějšího dotazu, a to "books"
	SELECT isbn, title
	FROM books
	WHERE NOT EXISTS (SELECT * FROM order_items WHERE order_items.isbn = books.isbn);
	
*/

/* Řádkové poddotazy - vracejí celé řádky oproti NOT EXISTS

   #řádkové poddotazy vracejí celé řádky, které následně můžeme porovnat s celými řádky vnějšího dotazu. S tímto přístupem vývojáři běžné hledají řádky, které se vyskytují jak v první, tak v druhé tabulce.
   SELECT s1, s2, s3
   FROM t1
   WHERE (s1, s2, s3) IN (SELECT s1, s2, s3 from t2;
   
   #Poddotaz jako dočasná tabulka
   #Poddotaz můžete používat v klauzuli FROM vnějšího dotazu. Díky tomu se dotazujete výstupu poddotazu, jako by se jednalo o skutečnou tabulku. Tomuto typu tabulek se říká dočasné tabulky.
   #výsledku poddotazu je nutné přiřadit alias se kterým lze pracovat jako s jakoukoliv jinou tabulkou   
   SELECT *
   FROM (SELECT customerid, name FROM customers WHERE city = 'Horní Bečva') 
   AS zakaznici_z_horni_becvy;
   
*/

/* Aktualizujeme záznamy v databázi

   UPDATE [LOW_PRIORITY] [IGNORE] nazev_tabulky
   SET sloupec1 = vyraz1[, sloupec1=vyraz1], ...]
   [WHERE podminka]
   [ORDER BY kriteria_razeni]
   [LIMIT pocet];
   
   #změna ve všech řádcích daného sloupce - zvýšení cen o 10% u všech knih
   UPDATE books SET price = price *1.1
   
   #změna jednoho řádku - změna adresy zákazníka
   UPDATE customers
   SET address = 'Olšanská 250'
   WHERE customerid = 4;
*/

/* Změna tabulek po vytvoření
   - podle standardu ANSI SQL můžete udělat pouze jednu změnu příkazem ALTER TABLE, ale systém MySQL vám jich umožňuje udělat, kolik chcete.
   - možných změn je hodně - viz dokumentace MySQL
   
   ALTER TABLE [INGORE]	 nazevtabulky zmena [, zmena ...];
   
   - nejčastější změny
   
   #změna délky datového typu pro sloupec
   ALTER TABLE customers
   MODIFY name char(70) NOT NULL;
   
   #přidání sloupce do tabulky
   ALTER TABLE orders
   ADD tax FLOAT(6,2) ATER amount;
   
   #odstranění sloupce
   ALTER TABLE orders
   DROP tax;
 */ 
 
 /* Mažeme záznamy z databáze
 
	DELETE [LOW_PRIORITY] [QUICK] [IGNORE] FROM tabulka
	[WHERE podminka]
	[ORDER BY poradi]
	[LIMIT pocet];
	
	#smazání všech řádků z tabulky
	DELETE FROM tabulka;
	
	#smazání konkrétních řádků
	DELETE FROM customers
	WHERE customerid=5
	
	#Pomocí klauzule LIMIT můžete omezit maximální počet mazanýcch řádků. Klauzuli ORDER BY používáte většinou dohromady s klauzulí LIMIT.
	
	#Klauzule LOW_PRIORITY a IGNORE fungují stejně jako u jiných příkazů. Příznak QUICK může být efektivnější u tabulek MyISAM
 
 */
 
 /* Mazání tabulek
	
	#smaže řádky i tabulku - takže pozor
	DROP TABLE tabulka;
 
 */
 
 /* Smazání celé databáze
 
	DROP DATABASE databaze;
 
 */
 
?>

