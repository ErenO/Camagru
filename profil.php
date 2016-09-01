<?php
	session_start();
	require "header.php";
	require "footer.html";
	include "setup.php";

	if(isset($_GET['id']) AND $_GET['id'] > 0)
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
		if (isset($_SESSION['ok']))
		{
			echo $_SESSION['ok'];
		}
		else
		{
			echo "rien";
		}
	?>
	<html>
		<head>
			<meta charset="utf-8" />
			<link rel="stylesheet" href="CSS/profil.css" />
			<title>Le projet Camagru</title>
		</head>
		<body>
			<section>
				<div align="center" id="div_profil">
					<?php
					if (!empty($userinfo['avatar']))
					{
						?>
						<img width="100" height="100" src="membres/avatar/<?php echo $userinfo['avatar'] ?> "/>
						<?php
					}
					else
					{
						echo "hello";
					}
					?>
					<h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
					<br /><br />
					Pseudo = <?php echo $userinfo['pseudo']; ?>
					<br />
					Mail = <?php echo $userinfo['mail']; ?>
					<br />
					<?php
					if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
						?>
						<br />
						<a href="edit.php">Editer mon profil</a>
						<a href="deconnexion.php">Se déconnecter</a>
						<?php
					}
					?>
				</div>
			</section>
		</body>
	</html>
	<?php
	}
?>
