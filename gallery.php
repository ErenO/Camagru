<?php
	session_start();
	require "header.php";
	require "footer.html";
	include ("setup.php");

	$requser = $pdo->prepare('SELECT * FROM membres');
	$requser->execute(array());
	$userinfo = $requser->fetch();
	$reqpost = $pdo->prepare('SELECT * FROM post ORDER BY id DESC');
	$reqpost->execute(array());
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
				$reqcomment = $pdo->prepare('SELECT * FROM comment WHERE membre_id = ?');
				$reqcomment->execute(array($data['id']));
				// $data2 = $reqcomment->fetch();
				echo "<form method='POST' action='comment.php'><div id='div_comment'><img src='" . $data["image"] . "' width=200 height=200/>'";
				 while ($data2 = $reqcomment->fetch()) {
				echo "<p id='".$data['id']."' style='display:block'>".$data2['comment']."</p>";
					}
					echo "
				<input id='photo_id' type='hidden' name='numero' value='" . $data['id'] . "' style='display:block'/>
				<input id='comment' type='text' name='comment' value='' style='display:block'/>
				<button id='send'>Envoyer</button>
				</div>
				</form>";
			// echo "<img src='" . $data2["image"] . "' width=200 height=200/>'";
			}
		?>
		<script src="gallery.js"></script>
	</body>
</html>
