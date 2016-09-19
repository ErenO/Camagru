<?php
	session_start();
	include ("setup.php");
	include ("mail.php");

	if (isset($_POST['comment']))
	{
		$comment = htmlspecialchars($_POST['comment']);
		$post_id = intval($_POST['numero']);
		if ($post_id != 0)
		{
			$insert_comment = $pdo->prepare("INSERT INTO comment(comment, post_id, membre_id) VALUES(?, ?, ?)");
			$insert_comment->execute(array($comment, $_SESSION['id'], $post_id));
			$userMail = $pdo->prepare('SELECT mail FROM membres WHERE id = ?');
			$userMail->execute(array($_SESSION['id']));
			$mail = $userMail->fetch();
			send_comment($mail[0], $_SESSION['pseudo']);
		}
	}
	header('Location: gallery.php');
?>
