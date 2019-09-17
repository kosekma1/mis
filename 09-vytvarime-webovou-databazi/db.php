<?php

/* Přihlášení k serveru */
echo "<h1>Přihlášení k serveru</h1>";
echo "mysql -h hostitel -u uzivatelskejmeno -p";

/* Vytvoření databáze */

echo "<h1>Vytváříme databázi</h1>";
echo "create database books;<br />";
echo "<strong>Vytvoření databáze s nastavením správného kódování:</strong><br />"
echo  "CREATE DATABASE mydatabase CHARACTER SET utf8 COLLATE utf8_general_ci; ";

/* Založení uživatelského účtu */
echo "<h1>Založení uživatelského účtu</h1>";
echo "create user \"uzivatelskejmeno@hostitel\" identified by \"heslo\"<br />";
echo "create user \"karel@localhost\" identified by \"mojeheslo\"";

/* Příkaz REVOKE */
/* Pomocí revoke odebíráte uživateli oprávnění */

/* 
revoke opraveneni [(sloupce)]
 on polozka
 from uzivatelske_jmeno
*/

/* vytvoření správce
   grant all on *.* to 'martin' identified by 'heslo' with grant option; 
*/

/* odeobrátní všech oprávnění
   revoke all privileges, grant option from 'martin';
*/

/* vytvoření uživatele bez oprávnění - jen s možností přihlašovat se
  grant usage on books.* to 'martin'@'localhost' identified by 'magie123';
  
  grant select, insert, update, delete, index, alter, create, drop on books.* to 'martin@localhost';
*/

/* odebrání oprávnění
   revoke alter, create, drop on books.* from 'martin'@'localhost'; 
*/

/* vytvoření uživatelského přístupu pro web
  grant select, insert, delete, update on books.* to 'bookorma' identified by 'bookorama123';
*/

/* vytvoření uživatelského přístupu pro web
  grant select, insert, delete, update, index, alter, create, drop, references on books.* to 'bookorma' identified by 'bookorama123';
*/

/* výběr databáze
   use nazevdb;
   
   alternativou je definovat databázi při přihlašování
   mysql -D nazevdb -h nzevhostitetel -u uzivatelskejmeno -p
*/

/* vytvoření tabulky
   create table nazevtabulky(sloupce);      
*/

/* vytvoření tabulky - přesměrováním souboru z řádky
   mysql -h localhost -u bookorama -D books -p < bookorama.sql
 */
 
 /* zobrazení seznamu tabulek
	show tables;
 */
 
 /* zobrazení seznamu databází
	show databases;
 */
 
 /* detaily o tabulce
	describe books;
 */
 
 /* tvorba indexů
	create [UNIQUE|FULLTEXT|SPATIAL] index nazev_indexu on nazev_tabulky (nazev_indexovaného_sloupce);
 */
 
?>

