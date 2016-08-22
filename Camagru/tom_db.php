<?php
include "database.php";

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
	$pdo->query("CREATE DATABASE IF NOT EXISTS db_canardgrue");
	$pdo->query('USE db_canardgrue');
}
catch (PDOException $e)
{
	echo $e;
	echo 'Erreur creation database';
}

try
{
	$pdo->exec("CREATE TABLE IF NOT EXISTS `user` (
		` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`email` TEXT NOT NULL ,
		`cle` TEXT NOT NULL,
		`pseudo` TEXT NOT NULL,
		`password` TEXT NOT NULL,
		`nom` TEXT ,
		`prenom` TEXT ,
		`validated` INT ,
		`avatar` LONGBLOB ,
		`country` TEXT)");
	$pdo->exec("CREATE TABLE IF NOT EXISTS `post` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`pseudo` TEXT NOT NULL ,
		`titre` TEXT ,
		`lieu` TEXT ,
		`email` TEXT NOT NULL ,
		`liked` INT ,
		`image` LONGBLOB NOT NULL ,
		`date_editer` TIMESTAMP)");
	$pdo->exec("CREATE TABLE IF NOT EXISTS`comment` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`email` TEXT NOT NULL ,
		`pseudo` TEXT NOT NULL ,
		`comment` TEXT NOT NULL ,
		`post_id` INT NOT NULL)");
	$pdo->exec("CREATE TABLE IF NOT EXISTS `likes` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`email` TEXT NOT NULL ,
		`post_id` INT NOT NULL)");
}
catch (PDOException $e)
{
	echo $e;
	echo 'Erreur creation table';
}
?>
