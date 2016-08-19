<?php
	session_start();
?>

<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>Le projet Camagru</title>
	</head>
	<body>
		<!-- <img id="paysage" src="paysage.jpeg" /> -->
	<a href="connexion.php">Déjà un compte ?</a>
		<div id="inscription_div" align="center">
			<h2 id="inscription_text">Inscription</h2>
			<br /><br />
			<form method="POST" action="create.php">
				<table>
					<tr>
						<td align="right">
							<label for="pseudo">Pseudo :</label>
						</td>
						<td>
							<input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)) { echo $pseudo; } ?>" class="input_inscription"/>
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mail">Mail :</label>
						</td>
						<td>
							<input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if (isset($mail)) { echo $mail; } ?>" class="input_inscription" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mail2">Confirmation du mail :</label>
						</td>
						<td>
							<input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if (isset($mail2)) { echo $mail2; } ?>" class="input_inscription" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mdp">Mot de passe :</label>
						</td>
						<td>
							<input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" class="input_inscription" />
						</td>
					</tr>
					<tr>
						<td align="right">
							<label for="mdp2">Confirmation du mot de passe :</label>
						</td>
						<td>
							<input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" class="input_inscription"/>
						</td>
					</tr>
					<tr>
						<td></td>
						<td align="center">
							<br />
							<input type="submit" name="forminscription" value="Inscription" id="submit" />
						</td>
					</tr>
				</table>
			</form>
			<?php
			if (isset($_SESSION['erreur'])) {
				echo '<font color="red">'.$_SESSION['erreur']."</font>";
			}
			?>
		</div>
	</body>
</html>
