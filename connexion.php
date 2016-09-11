<?php
session_start();
include "setup.php";

if (isset($_POST['formconnexion']))
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if (!empty($mailconnect) AND !empty($mdpconnect)) {
		$requser = $pdo->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
		$requser->execute(array($mailconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if ($userexist == 1) {
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['pseudo'] = $userinfo['pseudo'];
			$_SESSION['mail'] = $userinfo['mail'];
			$_SESSION['loggued_on_user'] = "ok";
			header("Location: cam.php?id=".$_SESSION['id']);
		}
		else
		{
			$_SESSION['erreur'] = "Mauvais mail ou mot de passe !";
		}
	}
	else
	{
		$_SESSION['erreur'] = "Tous les champs doivent être complétés !";
	}
}
?>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="CSS/connexion.css" />
		<title>Le projet Camagru</title>
	</head>
	<body>
		<a href="index.php">Home</a>
		<div align="center" id="div_connexion">
			<h2>Connexion</h2>
			<br /><br />
			<form method="POST" action="">
				<input type="email" name="mailconnect" placeholder="Mail" class="input_connexion"/>
				<input type="password" name="mdpconnect" placeholder="Mot de passe" class="input_connexion"//>
				<br /><br />
				<input type="submit" name="formconnexion" value="Connexion" />
			</form>
			<?php
			if (isset($_SESSION['erreur']))
			{
				echo '<font color="red">' . $_SESSION['erreur'] . "</font>";
			}
			?>
		</div>
	</body>
</html>
