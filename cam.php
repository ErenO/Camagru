<?php
	session_start();
	if (!$_SESSION['loggued_on_user'])
	{
		$_SESSION['erreur'] = "Connecte-toi !";
		header("Location: ./connexion.php");
		exit ;
	}
	include ("setup.php");
	require_once "header.php";
	require_once "footer.html";

	$reqvalid = $pdo->prepare('SELECT validate FROM membres WHERE id = ?');
	$reqvalid->execute(array($_SESSION['id']));
	$valid = $reqvalid->fetch();
	// if ($valid[0] == 0)
	// {
	// 	$_SESSION['erreur'] = "Valide ton compte avant de te connecter !";
	// 	echo $_SESSION['erreur'];
	// 	exit ;
	// }

	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		if (empty($_SESSION['id']))
		{
			$_SESSION['id'] = $getid;
		}
	}
	if (isset($_SESSION['bon']))
	{
		 echo '<script>alert("TON TEXTE");</script>';
	}
	$requser = $pdo->prepare('SELECT * FROM membres WHERE id = ?');
	$requser->execute(array($_SESSION['id']));
	$userinfo = $requser->fetch();
	$requser = $pdo->prepare('SELECT * FROM post WHERE membre_id = ? ORDER BY id DESC');
	$requser->execute(array($_SESSION['id']));
	// $data = $requser->fetch();
	// $data2 = $requser->fetch();
	// echo $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="CSS/body.css" />
		<link rel="stylesheet" href="CSS/cam.css" />
		<meta content="stuff, to, help, search, engines, not" name="keywords">
		<meta content="What this page is about." name="description">
		<meta content="Display Webcam Stream" name="title">
		<title>camagru</title>
	</head>
	<body>
		<?php
			echo $_SESSION['message'];
			$_SESSION['message'] = "";
		?>
		<div id="cam">
			<img id="chevron_gauche" src="images/left-arrow.png"/>
			<div class="booth">
				<img id="filtre" src="filtres/1.png" value=""  />
				<video id="video" width="640" height="480" autoplay></video>
				<a href="#" id="snap" class="booth-capture-button">Take photo</a>
				<input type="hidden" id="png" value="" />
				<input type="hidden" id="snap_photo" value=""  />
				<img id="filtre2" src="filtres/1.png" value=""  />
				<canvas id="canvas" width="640" height="480"></canvas>
				<input id="upload" type="file" name="upload" />
				<button id="send"  onclick="postthat()">Enregistrer</button>
			</div>
			<img id="chevron_droit" src="images/right-arrow.png"/>
		</div>
			<div id="photos">
				<h2>Photos</h2>
				<?php
				while ($data = $requser->fetch())
				{
						echo "<div class='photos_div'>
							<img class='cross' width=25 src='./images/cross.png' onClick='deleteImg(".$data['id'].")'/>
							<img src='" . $data["image"] . "' width=250 height=200/>'
							</div>";
				// echo "<img src='" . $data2["image"] . "' width=200 height=200/>'";
				}
				?>
			</div>
		<aside></aside>
		<script src="cam.js"></script>
	</body>
</html>
