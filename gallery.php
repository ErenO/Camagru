<?php
	session_start();
	require_once "header.php";
	require_once "footer.html";
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
				echo " <form method='POST' action='comment.php'><div ='div_comment' class='div_comment'><img width=25 src='./images/cross.png' style='position:absolute' onClick='deleteImg(".$_SESSION['id'].", ".$data['membre_id'].")'/><img src='" . $data["image"] . "' width=200 height=200/>'";
				while ($data2 = $reqcomment->fetch())
				{
					$reqpseudo = $pdo->prepare('SELECT membres.pseudo
						FROM membres, post, comment
						WHERE comment.id = ?
						AND membres.id = comment.post_id');
						$reqpseudo->execute(array($data2['id']));
						$pseudo = $reqpseudo->fetch();
					 echo "<p id='".$data['id']."' style='display:block'>";
					 echo $pseudo['pseudo']. ": ";
					 echo $data2['comment']."</p>";
				}
				$userlikes = $pdo->prepare('SELECT COUNT(*) FROM likes');
				$userlikes->execute();
				$likes = $userlikes->fetch();
				echo "
				<input id='photo_id' type='hidden' name='numero' value='" . $data['id'] . "' style='display:block'/>
				<input id='comment' type='text' name='comment' value='' style='display:block'/>
				<button id='send'>Envoyer</button>
				</br>
				<p id='coeur".$data['id']."' onClick='reply_click(".$_SESSION['id'].")'>
				<img src='coeur.png' style='display:block'/> ".$likes[0]."

				</p>
				</div>
				</form>";
			}
		?>
		<script src="gallery.js"></script>
	</body>
</html>
