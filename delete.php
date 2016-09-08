<?php
	include ("setup.php");

	if (!empty($_POST['delete_id']))
	{
		$deleteData = $pdo->prepare('DELETE FROM post WHERE id = ?');
		$deleteData->execute(array($_POST['delete_id']));
	}
	header('Location: gallery.php');
?>
