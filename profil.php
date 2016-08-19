<?php
	session_start();

	include "setup.php";
	// $bdd = new PDO('mysql:host=localhost;charset=utf8', 'root', 'root');

	if(isset($_GET['id']) AND $_GET['id'] > 0) {
		$getid = intval($_GET['id']);
		$requser = $pdo->prepare('SELECT * FROM membres WHERE id = ?');
		$requser->execute(array($getid));
		$userinfo = $requser->fetch();
	?>
	<html>
		<head>
			<meta charset="utf-8" />
			<link rel="stylesheet" href="profil.css" />
			<title>Le projet Camagru</title>
		</head>
		<body>
			<table align="center" id="table_profil">
				<tr>
					<td>
						<p>
							Gallerie
						</p>
					</td>
					<td>
						Mes photos
					</td>
					<td>
							Parametres
					</td>
				</tr>
			</table>
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
					echo "heloo";
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
			<a href="cam.html">Prendre une photo ?</a>
		</body>
	</html>
	<?php
	}
?>
