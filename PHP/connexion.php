<?php
	session_start();
	include ("../config/setup.php");

	if (isset($_POST['formconnexion']))
	{
		$pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
		$mdpconnect = sha1($_POST['mdpconnect']);
		if (!empty($pseudoconnect) AND !empty($mdpconnect)) {
			$requser = $pdo->prepare("SELECT * FROM membres WHERE pseudo = ? AND motdepasse = ?");
			$requser->execute(array($pseudoconnect, $mdpconnect));
			$userexist = $requser->rowCount();
			if ($userexist == 1)
			{
				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['id'];
				$_SESSION['pseudo'] = $userinfo['pseudo'];
				$_SESSION['mail'] = $userinfo['mail'];
				$_SESSION['loggued_on_user'] = "ok";
				header("Location: cam.php?id=".$_SESSION['id']);
			}
			else
			{
				$_SESSION['erreur'] = "Mauvais pseudo ou mot de passe !";
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
		<link rel="stylesheet" href="../CSS/connexion.css" />
		<title>Le projet Camagru</title>
	</head>
	<body>
		<a href="../index.php"><img src="../images/formulaire.png" width=40/></a>
		<a href="../PHP/gallery.php"><img src="../images/image.png" width=40/></a>
		<div align="center" id="div_connexion">
			<h2>Connexion</h2>
			<br /><br />
			<form method="POST" action="">
				<input type="text" name="pseudoconnect" placeholder="Pseudo" class="input_connexion"/>
				<input type="password" name="mdpconnect" placeholder="Mot de passe" class="input_connexion"//>
				<br /><br />
				<input type="submit" name="formconnexion" value="Connexion" />
			</form>
			<a href="reset_password.php" style="color:white">Mot de passe oublié ?</a>
		</br>
			<?php
			if (isset($_SESSION['erreur']))
			{
				echo '<font color="white">' . $_SESSION['erreur'] . "</font>";
				$_SESSION['erreur'] = "";
			}
			?>
		</div>
	</body>
</html>
