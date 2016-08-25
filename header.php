<?php
session_start();
// echo $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="CSS/header.css" />
	</head>
	<body>
		<header>
				<div id="titre_principal">
					<div id="logo">
						<h1>Camagru</h1>
					</div>
				</div>
				<nav>
					<ul>
						<li><a href="profil.php?id=<?php echo $_SESSION['id'];?>">Profil</a></li>
						<li><a href="gallery.php">Gallerie</a></li>
						<li><a href="cam.php">Cam</a></li>
						<li><a href="deconnexion.php">Deconnexion</a></li>
					</ul>
				</nav>
			</header>
			<hr />
	</body>
</html>
