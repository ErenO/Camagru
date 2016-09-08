<?php
	include ("setup.php");
	if (!empty($_POST['like_id']))
	{
		$insertlike = $pdo->prepare("INSERT INTO likes(post_id, email) VALUES(?, ?)");
		$insertlike->execute(array($_POST['like_id'], "eren@gmail.com"));
	}
	header('Location: gallery.php');
?>
