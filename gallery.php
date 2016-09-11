<?php
	session_start();
	if (!$_SESSION['loggued_on_user'])
	{
		$_SESSION['erreur'] = "Connecte-toi !";
		header("Location: ./connexion.php");
		exit;
	}
	require_once "header.php";
	require_once "footer.html";
	include ("setup.php");

	$i = 0;
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
		<link rel="stylesheet" href="button.css"  />
		<title>Gallerie</title>
	</head>
	<body>
		<?php
			while ($data = $reqpost->fetch())
			{
				$reqcomment = $pdo->prepare('SELECT * FROM comment WHERE membre_id = ?');
				$reqcomment->execute(array($data['id']));
				echo " <form method='POST' action='comment.php'><div ='div_comment' class='div_comment'>
				<img width=25 src='./images/cross.png' style='position:absolute' onClick='deleteImg(".$_SESSION['id'].", ".$data['membre_id'].", ".$data['id'].")'/>
				<img src='" . $data["image"] . "' width=200 height=200/>'";
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
				$reqlikes = $pdo->prepare('SELECT COUNT(*) FROM likes WHERE post_id = ? AND photo_id = ?');
				$reqlikes->execute(array($_SESSION['id'], $data['id']));
				$likes = $reqlikes->fetch();
				$reqlikes = $pdo->prepare('SELECT COUNT(*) FROM likes WHERE photo_id = ?');
				$reqlikes->execute(array($data['id']));
				$likeAll = $reqlikes->fetch();
				echo "
				<input id='photo_id' type='hidden' name='numero' value='" . $data['id'] . "' style='display:block'/>
				<input id='comment' type='text' name='comment' value='' style='display:block'/>
				<button id='send'>Envoyer</button>
				</br>
				<p id='coeur".$data['id']."' onClick='reply_click(".$_SESSION['id'].", ".$likes[0].", ".$data['id'].")'>
				<img src='coeur.png' style='display:block'/> ".$likeAll[0]."
				</p>
				</div>
				</form>";
				$i += 1;
			}
			if ($i == 0)
			{
				echo "<center><a href='cam.php' id='galButton' class='myButton'>Vous n'avez pas de photos. Veuillez en prendre une !</a></center>";
				// echo "<a href='cam.php'>Vous n'avez pas de photos. Veuillez en prendre une !</a>";
			}
		?>
		<script src="gallery.js"></script>
	</body>
</html>
