<?php
	session_start();
	include ("setup.php");

	$i = 1;
	$id = intval($_GET['id']);
	$key = htmlspecialchars($_GET['key']);
	$userKey = $pdo->prepare('SELECT confirmkey FROM membres WHERE id = ?');
	$userKey->execute(array($id));
	if ($userKey[0] == $key)
	{
		$userValid = $pdo->prepare("UPDATE membres SET validate = ? WHERE id = ?");
		$userValid->execute(array($i, $id));
	}
	header('Location: ./cam.php');
?>