<?php
	session_start();
	include ("../config/setup.php");

	if (!empty($_POST['delete_id']))
	{
		$deleteData = $pdo->prepare('DELETE FROM post WHERE id = ?');
		$deleteData->execute(array($_POST['delete_id']));
	}
	$_SESSION['message'] = "Vous avez supprimé une de vos photos !";
	$_POST["location"] === "gallery" ? header('Location: gallery.php') : header('Location: cam.php');
?>
