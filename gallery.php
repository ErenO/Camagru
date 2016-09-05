<?php
	session_start();
	require "header.php";
	require "footer.html";
	include ("setup.php");

	$requser = $pdo->prepare('SELECT * FROM membres');
	$requser->execute(array($_SESSION['id']));
	$userinfo = $requser->fetch();
	$reqpost = $pdo->prepare('SELECT * FROM post ORDER BY id DESC');
	$reqpost->execute(array());
	// $reqcomment = $pdo->prepare('SELECT * FROM comment WHERE ')
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="CSS/body.css" />
		<link rel="stylesheet" href="CSS/gallery.css" />
		<title>Gallerie</title>
	</head>
	<body>
		<?php
			while ($data = $reqpost->fetch())
			{
				// $data2 = $reqcomment->fetch();
				echo "<div id=".$data['id'].">
				<img src='" . $data["image"] . "' width=200 height=200/>'
				<p>
				</p>

				</div>";
			// echo "<img src='" . $data2["image"] . "' width=200 height=200/>'";
			}
		?>
		<div id="comment_div">
			<input id="comment" type="text" name="commentaire" value=""/>
			<button id="send">Envoyer</button>
		</div>
	</body>
</html>
