<?php
	session_start();
	include ("setup.php");

	$comment = htmlspecialchars($_POST['comment']);
	$post_id = intval($_POST['numero']);
	$insert_comment = $pdo->prepare("INSERT INTO comment(comment, post_id, membre_id) VALUES(?, ?, ?)");
	$insert_comment->execute(array($comment, $_SESSION['id'], $post_id));
	header('Location: gallery.php');
?>
