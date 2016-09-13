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
	include "setup.php";

	$reqpicture = $pdo->prepare('SELECT * FROM post WHERE membre_id = ? ORDER BY id DESC');
	$reqpicture->execute(array($_SESSION['id']));
	// $reqpost = $pdo->prepare('SELECT * FROM post ORDER BY id DESC');
	// $reqpost->execute(array());
	$reqvalid = $pdo->prepare('SELECT validate FROM membres WHERE id = ?');
	$reqvalid->execute(array($_SESSION['id']));
	$valid = $reqvalid->fetch();
	// if ($valid[0] == 0)
	// {
	// 	$_SESSION['erreur'] = "Valide ton compte avant de te connecter !";
	// 	echo $_SESSION['erreur'];
	// 	exit ;
	// }
	if (isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		$requser = $pdo->prepare('SELECT * FROM membres WHERE id = ?');
		$requser->execute(array($getid));
		$userinfo = $requser->fetch();
		// $_SESSION['pseudo'] = $userinfo['pseudo'];

		if (empty($_SESSION['id']))
		{
			$_SESSION['id'] = $getid;
		}
	}
	?>
	<html>
		<head>
			<meta charset="utf-8" />
			<link rel="stylesheet" href="CSS/body.css" />
			<link rel="stylesheet" href="CSS/profil.css" />
			<title>Le projet Camagru</title>
		</head>
		<body>
			<section>
				<div align="center" id="div_profil">
					<?php
					if (isset($userinfo['avatar']))
					{
						?>
						<img width="100" height="100" src="membres/avatar/<?php echo $userinfo['avatar'] ?> "/>
						<?php
					}
					?>
					<h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
					<br /><br />
					Pseudo = <?php echo $userinfo['pseudo']; ?>
					<br />
					Mail = <?php echo $userinfo['mail']; ?>
					<br />
					<?php
					if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
						?>
						<br />
						<a href="edit.php">Editer mon profil</a>
						<a href="deconnexion.php">Se déconnecter</a>
						<?php
					}
					?>
				</div>
			</section>
			<div>
				<h2>Mes photos</h2>
				<?php
				while ($photos = $reqpicture->fetch())
				{
					// print_r($photos);
					echo "<div>
					<img src=".$photos["image"]."/>
					</div>";
				}
				?>
			</div>
		</body>
	</html>
