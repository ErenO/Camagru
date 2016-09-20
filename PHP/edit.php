<?php
	session_start();
	include ("../config/setup.php");

	if(isset($_SESSION['id']))
	{
		$requser = $pdo->prepare("SELECT * FROM membres WHERE id = ?");
		$requser->execute(array($_SESSION['id']));
		$user = $requser->fetch();
		if (isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
		{
			$newpseudo = htmlspecialchars($_POST['newpseudo']);
			$insertpseudo = $pdo->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
			$insertpseudo->execute(array($newpseudo, $_SESSION['id']));
			header('Location: profil.php?id='.$_SESSION['id']);
		}
		if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
		{
			$newmail = htmlspecialchars($_POST['newmail']);
			if (filter_var($newmail, FILTER_VALIDATE_EMAIL))
			{
				$insertmail = $pdo->prepare("UPDATE membres SET mail = ? WHERE id = ?");
				$insertmail->execute(array($newmail, $_SESSION['id']));
				header('Location: profil.php?id='.$_SESSION['id']);
			}
		}
		if (isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
		{
			$maxSize = 2097152;
			$validExt = array('jpg', 'jpeg', 'gif', 'png');
			if ($_FILES['avatar']['size'] <= $maxSize)
			{
				$uploadExt = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
				if (in_array($uploadExt, $validExt))
				{
					$path = "membres/avatar/" . $_SESSION['id'] . "." . $uploadExt;
					$result = move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
					if ($result)
					{
						$updateAvatar = $pdo->prepare('UPDATE membres SET avatar = :avatar WHERE id = :id');
						$updateAvatar->execute(array(
							'avatar' => $_SESSION['id'] . "." . $uploadExt,
							'id' => $_SESSION['id']
						));
						$_SESSION['avatar'] = $user['avatar'];
					}
					else
					{
						$msg = "Erreur d'importation de la photo";
					}
				}
				else
				{
					$msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png !";
				}
			}
			else
			{
				$msg = "Votre photo ne doit pas dépasser 2 Megaoctets";
			}
			header('Location: profil.php?id='.$_SESSION['id']);
		}
		if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
		{
			$mdp1 = sha1($_POST['newmdp1']);
			$mdp2 = sha1($_POST['newmdp2']);
			if ($mdp1 == $mdp2)
			{
				$insertmdp = $pdo->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
				$insertmdp->execute(array($mdp1, $_SESSION['id']));
				header('Location: profil.php?id='.$_SESSION['id']);
			}
			else
			{
				$msg = "Vos deux mdp ne correspondent pas !";
			}
		}
	?>
	<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="../CSS/edit.css" />
		<link rel="stylesheet" href="../CSS/button.css" />
		<title>Le projet Camagru</title>

	</head>
	<body>
		<a href="profil.php?id= <?php echo $_SESSION['id']; ?>" ><img width="50" src="../images/home.png"/></a>
		<div align="center">
				<div align="center" id="div_edit">
					<img src="../images/retour.jpg" id="return_img" onClick="edit_back()"/>
					<h2>Edition de mon profil</h2>
					<form method="POST" action="" enctype="multipart/form-data">
						<br /><br />
					<a href="#" id="pseudo" class="booth-capture-button" onClick="edit_pseudo()">Changer de pseudo</a>
					<a href="#" id="mail" class="booth-capture-button" onClick="edit_mail()">Changer de mail</a>
					<a href="#" id="password" class="booth-capture-button" onClick="edit_passwd()">Changer de mot de passe</a>
					<a href="#" id="navatar" class="booth-capture-button" onClick="edit_avatar()">Changer d'avatar</a>
					<table id="table">
						<tr align="right" id="newpseudo">
							<td>
								<label>Pseudo :</label>
							</td >
							<td class="margin">
								<input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" class="input_edit"/><br /><br />
							</td>
						</tr>
						<tr align="right" id=newmail>
							<td>
								<label>Mail :</label>
							</td>
							<td class="margin" >
								<input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" class="input_edit"/><br /><br />
							</td>
						</tr>
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
						 <tr align="right" id="newavatar">
							<td>
								 <label>Avatar :</label>
							 </td>
							<td class="margin" align="right">
								<center>
									<input type="file" name="avatar"  style=/> <br /> <br />
								</center>
							</td>
						</tr>
						 <tr align="right" id="envoyer">
							<td></td>
							<td>
								<input  type="submit" value="Mettre à jour mon profil !" />
							</td>
						</tr>
						</form>
				</table>
				<?php if (isset($msg)) { echo $msg; } ?>
			</div>
		</div>
		<script src="../JS/edit.js"></script>
	</body>
	</html>
		<?php
		}
		else
		{
			header("Location: connexion.php");
		}
?>
