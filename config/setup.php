<?php
include "database.php";

try
{
	$pdo = new PDO('mysql:host=localhost;charset=utf8', 'root', 'root');
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
	$pdo->exec("CREATE TABLE IF NOT EXISTS `membres` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`mail` TEXT NOT NULL,
		`pseudo` TEXT NOT NULL,
		`motdepasse` TEXT NOT NULL,
		`confirmkey` TEXT NOT NULL,
		`validate` INT,
		`avatar` TEXT NOT NULL,
		`confirm` INT NULL)");
	$pdo->exec("CREATE TABLE IF NOT EXISTS `post` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`titre` TEXT,
		`lieu` TEXT,
		`liked` INT,
		`image` LONGBLOB NOT NULL,
		`date_editer` TIMESTAMP,
		`membre_id` INT NOT NULL)");
	$pdo->exec("CREATE TABLE IF NOT EXISTS`comment` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`comment` TEXT NOT NULL,
	`post_id` INT NOT NULL,
	`membre_id` INT NOT NULL)");
	$pdo->exec("CREATE TABLE IF NOT EXISTS `likes` (
		`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		`photo_id` TEXT NOT NULL ,
		`post_id` INT NOT NULL)");
}
catch (PDOException $e)
{
	echo $e;
	echo '<br/>Erreur creation table <br/>';
}
?>
