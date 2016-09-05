<?php
// include "database.php";

$DB_DSN = 'mysql:host=localhost;charset=utf8';
$DB_USER = 'root';
$DB_PASSWORD = 'root';

try
{
	$pdo = new PDO('mysql:host=localhost;charset=utf8', 'root', 'root');
	// $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $e)
{
	echo $e;
	echo 'Erreur connexion database';
}

try
{
	$pdo->query("CREATE DATABASE IF NOT EXISTS db");
	$pdo->query('USE db');
}
catch (PDOException $e)
{
	echo $e;
	echo '<br/>Erreur creation database<br/>';
}

try
{
	$pdo->exec("CREATE TABLE IF NOT EXISTS `membres` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`mail` TEXT NOT NULL,
		`pseudo` TEXT NOT NULL,
		`motdepasse` TEXT NOT NULL,
		`confirmkey` TEXT NOT NULL,
		`avatar` TEXT NOT NULL,
		`confirm` INT NULL)");
		// `avatar` LONGBLOB ,
}
catch (PDOException $e)
{
	echo $e;
	echo '<br/>Erreur creation table <br/>';
}

try
{
	$pdo->exec("CREATE TABLE IF NOT EXISTS `post` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`titre` TEXT,
		`lieu` TEXT,
		`liked` INT,
		`image` LONGBLOB NOT NULL,
		`date_editer` TIMESTAMP,
		`membre_id` INT NOT NULL)");
}
catch (PDOException $e)
{
	echo $e;
	echo '<br/>Erreur creation table <br/>';
}
try
{
	$pdo->exec("CREATE TABLE IF NOT EXISTS`comment` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`comment` TEXT NOT NULL,
	`post_id` INT NOT NULL,
	`membre_id` INT NOT NULL)");
}
catch (PDOException $e)
{
	echo $e;
	echo '<br/>Erreur creation table <br/>';
}
// try
// {
// 	$pdo->query("INSERT INTO membres(confirm) VALUES (0)");
// }
// catch (PDOException $e)
// {
// 	echo $e;
// 	echo '<br/>Erreur set valeur confirm <br/>';
// }

// try
// {
// 	// $pdo = new PDO('mysql:host=localhost;charset=utf8', 'root', 'root');
// 	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
// 	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
// }
// catch (PDOException $e)
// {
// 	echo $e;
// 	echo 'Erreur connexion database';
// }
//
// try
// {
// 	$pdo->query("CREATE DATABASE IF NOT EXISTS db_canardgrue");
// 	$pdo->query('USE db_canardgrue');
// }
// catch (PDOException $e)
// {
// 	echo $e;
// 	echo 'Erreur creation database';
// }
//
// try
// {
// 	$pdo->exec("CREATE TABLE IF NOT EXISTS `user` (
// 		` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
// 		`email` TEXT NOT NULL ,
// 		`cle` TEXT NOT NULL,
// 		`pseudo` TEXT NOT NULL,
// 		`password` TEXT NOT NULL,
// 		`nom` TEXT ,
// 		`prenom` TEXT ,
// 		`validated` INT ,
// 		`avatar` LONGBLOB ,
// 		`country` TEXT)");
	// $pdo->exec("CREATE TABLE IF NOT EXISTS `post` (
	// 	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	// 	`pseudo` TEXT NOT NULL ,
	// 	`titre` TEXT ,
	// 	`lieu` TEXT ,
	// 	`email` TEXT NOT NULL ,
	// 	`liked` INT ,
	// 	`image` LONGBLOB NOT NULL ,
	// 	`date_editer` TIMESTAMP)");
// 	$pdo->exec("CREATE TABLE IF NOT EXISTS `likes` (
// 		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
// 		`email` TEXT NOT NULL ,
// 		`post_id` INT NOT NULL)");
// }
// catch (PDOException $e)
// {
// 	echo $e;
// 	echo 'Erreur creation table';
// }
?>
