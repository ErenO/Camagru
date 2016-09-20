<?php
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="CSS/style.css" />
		<link async href="http://fonts.googleapis.com/css?family=Advent%20Pro" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>
		<title>Le projet Camagru</title>
	</head>
	<body>
		<div id="link_connect">
			<a id="connect" href="PHP/connexion.php">Se connecter</a>
		</div>
		<div id="inscription_div" align="center">
			<form method="POST" action="PHP/create.php">
			<label id="top" for="pseudo">Pseudo :</label>
			<input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)) { echo $pseudo; } ?>" class="input_inscription"/>
			<label for="mail">Mail :</label>
			<input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if (isset($mail)) { echo $mail; } ?>" class="input_inscription" />
			<label for="mail2">Confirmation du mail :</label>
			<input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if (isset($mail2)) { echo $mail2; } ?>" class="input_inscription" />
			<label for="mdp">Mot de passe :</label>
			<input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" class="input_inscription" />
			<label for="mdp2">Confirmation du mot de passe :</label>
			<input type="password" placeholder="Confirmez votre mot de passe" id="mdp2" name="mdp2" class="input_inscription"/>
			<br />
			<input type="submit" name="forminscription" value="Inscription" id="submit"/>
			</form>
		</div>
		<div id="message_inscription">
			<center>
				<p id="text_info">
					<?php
					if (isset($_SESSION['erreur']))
					{
						echo '<font color="red">'.$_SESSION['erreur']."</font>";
						$_SESSION['erreur'] = '';
					}
					?>
				</p>
			</center>
		</div>
	</body>
</html>
