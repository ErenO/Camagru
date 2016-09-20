<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="../CSS/header.css" />
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	</head>
	<body>
		<div id="header">
			<div id="logo">
				<h1>Camagru</h1>
			</div>
		</div>
		<header>
				<div id="titre_principal">
				</div>
				<nav>
					<ul>
						<li><a href="profil.php?id=<?php echo $_SESSION['id'];?>">Profil</a></li>
						<li><a href="gallery.php">Gallerie</a></li>
						<li><a href="cam.php">Cam</a></li>
						<li id="disconnect"><a href="deconnexion.php">Deconnexion</a></li>
					</ul>
				</nav>
			</header>
			<hr />
	</body>
</html>
