<?php
	session_start();
	include ("setup.php");
	include ("mail.php");

	if (isset($_POST['comment']))
	{
		$comment = htmlspecialchars($_POST['comment']);
		$post_id = intval($_POST['numero']);
		$insert_comment = $pdo->prepare("INSERT INTO comment(comment, post_id, membre_id) VALUES(?, ?, ?)");
		$insert_comment->execute(array($comment, $_SESSION['id'], $post_id));
		$userMail = $pdo->prepare('SELECT mail FROM membres WHERE id = ?');
		$userMail->execute(array($_SESSION['id']));
		$mail = $userMail->fetch();
		send_comment("eren.ozdek@gmail.com", $_SESSION['pseudo']);
	}
	header('Location: gallery.php');
?>
