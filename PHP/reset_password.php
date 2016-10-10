<?php
	session_start();
	include "../config/setup.php";

	if ($_POST['mail'])
	{
		$min = ctype_upper($mdp);
		$maj = ctype_lower($mdp);
		$num = ctype_digit($mdp);
		$mail = htmlspecialchars($_POST['mail']);
		//PROBLEEEEEMEMEMEMME1!!!!!! protection mail
			// $id = intval($_GET['id']);
			$reqmail = $pdo->prepare('SELECT id FROM membres WHERE mail = ?');
			$reqmail->execute(array($_POST['mail']));
			$id = $reqmail->fetch();
			// echo $id[0];
			$to = $mail;
			$subject = 'Réinitialiser ton mot de passe !';
			$message = "Pour changer ton mot de passe. Clique <a href='http://localhost:8080/Camagru/PHP/password.php?id=".$id[0]."'>ici.</a>";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: eozdek@student.42.fr' . "\r\n" .
						'Reply-To: eozdek@student.42.fr' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
			$_SESSION['erreur'] = "mail envoyé !";
	}
?>

<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="../CSS/password.css" />
		<link rel="stylesheet" href="../CSS/button.css" />
		<title>Le projet Camagru</title>
	</head>
	<body>
		<a href="profil.php?id= <?php echo $_SESSION['id']; ?>" ><img width="50" src="../images/home.png"/></a>
		<div align="center">
				<div align="center" id="div_edit">
					<form method="POST" action="" enctype="multipart/form-data">
						<br /><br />
					<table id="table">
						<tr align="right" id="newpasswd">
							<td>
								<label>Adresse mail:</label>
							</td>
							<td class="margin">
								<input type="mail" name="mail" placeholder="Adresse mail" class="input_edit"/><br /><br />
							</td>
						</tr>
						<tr align="right" id="envoyer">
							<td>
							</td>
							<td>
								<input  type="submit" value="Envoyer" />
							</td>
						</tr>
					</table>
				</form>
				<?php
				if (isset($msg))
				{
					echo $msg;
				}
				echo $_SESSION['erreur'];
				?>
			</div>
		</div>
	</body>
</html>
