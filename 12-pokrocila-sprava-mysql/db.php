<?php

/* aktualizace prav - v případě přímé změny v tabulkách je potřeba práva aktualizovat příkazem:

myslq> flush privileges;

alternativně:
> mysqladmin flush-privileges
nebo
> mysqladmin reload

*/

/* 

---Získávání informací příkazem SHOW---

#zobrazuje seznam tabulek v databázi
SHOW TABLES;

#zobrazuje seznam dostyných databázi
SHOW DATABASES;

#zobrazuje tabulky z databáze books
SHOW TABLES FROM books;

#zobrazí sloupce z tabulky orders z databáze books
SHOW COLUMNS FROM orders FROM books;
nebo alternativně
SHOW COLUMNS FROM books.orders;

#zobrazí, která oprávnění má uživatel
SHOW GRANTS FOR 'bookorama';

---Získávání informací o sloupcích příkazem DESCRIBE ---
DESCRIBE tabulka [sloupec];

---Prozkoumání dotazů příkazem EXPLAIN ---

EXPLAIN tabulka;

- umožňuje prozkoumat, jak přesně systém MySQL vyhodnocuje dotaz SELECT. Stačí jen uvést slovo EXPLAIN před příkaz SELECT

př.:
EXPLAIN
SELECT customers.name FROM customers, orders, order_items, books
WHERE customers.customerid = orders.customerid AND orders.orderid = order_items.orderid AND order_items.isbn = books.isbn AND books.title LIKE '%Java%';

- prozkoumání distribuce klíčů optimalizátorem spojení, a tak optimalizovat spojení efektivněji pomocí příkazu ANALYZE TABLE v nástroji MySQL monitor:
ANALYZE TABLE customers, orders, order_items, books;

- přidání do tabulky nového indexu
ALTER TABLE ADD INDEX (sloupec);

/* Zálohování databáze MySQL

- první možnost spočívá v uzamčení tabulek, zatímco kopírujete fyzické soubory, a to pomocí příkazu LOCK TABLES:
LOCK TABLES tabulka typ_zamku [, tabulka typ zamku]
typ_zamku - READ, WRITE

- před kopírováním souborů/zálohou je nutné zapsat všechny změny indexů na disk:
FLUSH TABLES;

- druhá (a lepší možnost) metoda je příkaz mysqldump. Ten spouštíte z příkazového řádku operačního systému, a to obvykle takto:
> mysqldump --all-databases > all.sql
- předchozím příkazem vypisujeme všechny dotazy SQL, které jsou nezbytné pro opětovné vytvoření databáze, do souboru all.sql

... a další viz knížka

*/

?>