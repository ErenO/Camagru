<?php
	session_start();
	require_once "header.php";
	require_once "footer.html";
	include ("../config/setup.php");

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
		<link rel="stylesheet" href="../CSS/body.css" />
		<link rel="stylesheet" href="../CSS/gallery.css" />
		<link rel="stylesheet" href="../CSS/button.css"  />
		<title>Gallerie</title>
	</head>
	<body>
		<?php
		echo $_POST['mavariable1'];
			while ($data = $reqpost->fetch())
			{
				$reqcomment = $pdo->prepare('SELECT * FROM comment WHERE membre_id = ?');
				$reqcomment->execute(array($data['id']));
				$commentNb = $reqcomment->rowCount();
				echo "
				<form method='POST' action='comment.php'><div class='div_comment' id='div".$data['id']."' >";
				if ($_SESSION['id'] == $data['membre_id'])
				{
					echo "
					<img class='cross_img' width=25 src='../images/cross.png' onClick='deleteImg(".$_SESSION['id'].", ".$data['membre_id'].", ".$data['id'].")'/>";
				}
				if ($data['id'])
				{
					$protect = $data['id'];
				}
				else
				{
					$protect = 0;
				}
				if ($_SESSION['loggued_on_user'])
				{
					echo "
					<img class='photos_filtre' src='". $data["image"] ."' width=250 height=200 onClick='input_display(".$data['id'].")'/>'
					<p class='hide_comment' id=hide". $data['id'] ." onClick='comment_none(".$data['id'].")'>Masquer les ".$commentNb." commentaires</p>
					<div class='comment' id='comment". $data['id'] ."'>";
					while ($data2 = $reqcomment->fetch())
					{
						$reqpseudo = $pdo->prepare('SELECT membres.pseudo
							FROM membres, post, comment
							WHERE comment.id = ?
							AND membres.id = comment.post_id');
							$reqpseudo->execute(array($data2['id']));
							$pseudo = $reqpseudo->fetch();
							if (empty($pseudo['pseudo']))
							{
								$pseudo['pseudo'] = "Pas de pseudo";
							}
							echo "<p>";
							echo $pseudo['pseudo']. ": ";
							echo $data2['comment']."</p>";
					}
					$reqlikes = $pdo->prepare('SELECT COUNT(*) FROM likes WHERE post_id = ? AND photo_id = ?');
					$reqlikes->execute(array($_SESSION['id'], $data['id']));
					$likes = $reqlikes->fetch();
					$reqlikes = $pdo->prepare('SELECT COUNT(*) FROM likes WHERE photo_id = ?');
					$reqlikes->execute(array($data['id']));
					$likeAll = $reqlikes->fetch();
					echo "</div>
					<p class='link_comment' id=link".$data['id']." onClick='comment_display(".$data['id'].")'>Voir les ".$commentNb." commentaires</p>
					<input id='img".$data['id']."' class='photo_id' type='hidden' name='nume' value='" . $data['image'] . "' style='display:block'/>
					<input id='photo".$data['id']."' class='photo_id' type='hidden' name='numero' value='" . $data['id'] . "' style='display:block'/>
					<input id='text".$data['id']."' class='text_area' type='text' name='comment' value='' />
					<button id='btn".$data['id']."' class='btn' onClick='print_text(".$data['id'].")'>Envoyer</button>
					</br>
					<p class='coeur' id='coeur".$data['id']."' onClick='reply_click(".$_SESSION['id'].", ".$likes[0].", ".$data['id'].")'>
					<img src='../images/coeur.png' style='display:block'/> ".$likeAll[0]."
					</p>
					</div>
					</form>";
				}
				else
				{
					echo "
					<img class='photos_filtre' src='". $data["image"] ."' width=250 height=200/>'</div>";
				}
				$i += 1;
			}
			if ($i == 0)
			{
				echo "<center><a href='cam.php' id='galButton' class='myButton'>Vous n'avez pas de photos. Veuillez en prendre une !</a></center>";
			}
			?>
			<script src="../JS/gallery.js"></script>
	</body>
</html>
