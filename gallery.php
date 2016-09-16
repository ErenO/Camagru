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
	$previous_id = 0;
	$previous_image = "";
	$reqvalid = $pdo->prepare('SELECT validate FROM membres WHERE id = ?');
	$reqvalid->execute(array($_SESSION['id']));
	$valid = $reqvalid->fetch();
	if ($valid[0] == 0)
	{
		$_SESSION['erreur'] = "Valide ton compte avant de te connecter !";
		echo $_SESSION['erreur'];
		exit ;
	}
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
		echo $_POST['mavariable1'];
			while ($data = $reqpost->fetch())
			{
				$reqcomment = $pdo->prepare('SELECT * FROM comment WHERE membre_id = ?');
				$reqcomment->execute(array($data['id']));
				echo " <form method='POST' action='comment.php'><div class='div_comment' id='div".$data['id']."' onClick='input_display(".$data['id'].")'>
				<img class='cross_img' width=25 src='./images/cross.png' onClick='deleteImg(".$_SESSION['id'].", ".$data['membre_id'].", ".$data['id'].")'/>
				<img class='photos_filtre' src='" . $data["image"] . "' width=250 height=200/>'";
				while ($data2 = $reqcomment->fetch())
				{
					$reqpseudo = $pdo->prepare('SELECT membres.pseudo
						FROM membres, post, comment
						WHERE comment.id = ?
						AND membres.id = comment.post_id');
						$reqpseudo->execute(array($data2['id']));
						$pseudo = $reqpseudo->fetch();
					 echo "<p class='comment' id='comment".$data['id']."'>";
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
				<p class='link_comment' id=link".$data['id']." onClick='comment_display(".$data['id'].")'>See comments</p>
				<input id='img".$data['id']."' class='photo_id' type='hidden' name='numero' value='" . $data['image'] . "' style='display:block'/>
				<input id='photo".$data['id']."' class='photo_id' type='hidden' name='numero' value='" . $data['id'] . "' style='display:block'/>
				<input id='text".$data['id']."' class='text_area' type='text' name='comment' value='' />
				<button id='btn".$data['id']."' class='btn' onClick='print_text(".$data['id'].")'>Envoyer</button>
				</br>
				<p class='coeur' id='coeur".$data['id']."' onClick='reply_click(".$_SESSION['id'].", ".$likes[0].", ".$data['id'].")'>
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
		<div id="div_center">
			<input id="hidid" type="hidden" name="hidid" value=""  />
			<?php
				echo " <form method='POST' action='comment.php'>";
				echo " <form method='POST' action='comment.php'>";
			?>
			<div>
				<?php
					echo "
					<img id='cross_finish' class='cross_img' width=25 src='./images/cross.png' onClick='finish_display()'/>
					<img id='big_photo' src='' width=640 height=480/>'";
				?>
			</div>
			<?php
				echo "<input id='text".$data['id']."' class='text_area' type='text' name='comment' value='' />
				<button id='btn".$data['id']."' class='btn'>Envoyer onClick='print_text()'</button></form>";
			?>
		</div>
		<script src="gallery.js"></script>
	</body>
</html>
