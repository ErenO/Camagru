<?php
	session_start();
	include ("../config/setup.php");

	$i = 1;
	$id = intval($_GET['id']);
	$key = htmlspecialchars($_GET['key']);
	$userKey = $pdo->prepare('SELECT confirmkey FROM membres WHERE id = ?');
	$userKey->execute(array($id));
	$valid = $userKey->fetch();

	if ($valid[0] == $key)
	{
		$userValid = $pdo->prepare("UPDATE membres SET validate = ? WHERE id = ?");
		$userValid->execute(array($i, $id));
	}
	header('Location: ./cam.php');
?>
