<?php
	include ("setup.php");

	session_start();
	if (!$_SESSION['loggued_on_user'])
	{
		$_SESSION['message'] = "Connecte-toi !";
		header("Location: ./connexion.php");
		exit;
	}
	if (!empty($_POST['like_id']) && !empty($_POST['photo_id']))
	{
		$insertlike = $pdo->prepare("INSERT INTO likes(post_id, photo_id) VALUES(?, ?)");
		$insertlike->execute(array($_POST['like_id'], $_POST['photo_id']));
	}
	header('Location: gallery.php');
?>
