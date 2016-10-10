<?php
	session_start();
	include ("../config/setup.php");

		$requser = $pdo->prepare("SELECT * FROM membres WHERE id = ?");
		$requser->execute(array($_SESSION['id']));
		$user = $requser->fetch();
		$id = intval($_GET['id']);
		if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
		{
			$mdp = $_POST['newmdp1'];
			if (preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,255}$/', $mdp))
			{
				if ($id)
				{
					$mdp1 = sha1($_POST['newmdp1']);
					$mdp2 = sha1($_POST['newmdp2']);
					if ($mdp1 == $mdp2)
					{
						$insertmdp = $pdo->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
						$insertmdp->execute(array($mdp1, $id));
						// header('Location: connexion.php?id='.$_SESSION['id']);
						$_SESSION['erreur'] = 'mot de passe changé !';
						header("Location: connexion.php");
					}
					else
					{
						$msg = "Vos deux mdp ne correspondent pas !";
					}
				}
			}
			else
			{
				$_SESSION['erreur'] = "le mot de passe doit contenir un chiffre, une minuscule, une majuscule de 6 caractères !";
			}
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
								<label>Mot de passe :</label>
							</td>
							<td class="margin" >
								<input type="password" name="newmdp1" placeholder="Mot de passe" class="input_edit"/><br /><br />
							</td>
						</tr>
						<tr align="right" id="newpasswd2">
							<td>
								<label>Confirmation - mot de passe :</label>
							</td>
							<td class="margin" >
								<input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" class="input_edit"/><br /><br />
							</td>
						</tr>
						<tr align="right" id="envoyer">
						   <td></td>
						   <td>
							   <input  type="submit" value="Mettre à jour mon profil !" />
						   </td>
					   </tr>
					</table>
				</form>
				<?php if (isset($msg)) { echo $msg; }
				echo $_SESSION['erreur'];
				$_SESSION['erreur'] = "";
				?>
			</div>
		</div>
	</body>
	</html>
