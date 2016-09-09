<?php
	session_start();
	if (!$_SESSION['loggued_on_user'])
	{
		$_SESSION['erreur'] = "Connecte-toi !";
		header("Location: ./connexion.php");
		exit ;
	}
	require_once "header.php";
	require_once "footer.html";
	include ("setup.php");

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
		<div>

			<img id="chevron_gauche" src="images/chevron-left.png"/>
			<div class="booth">
				<!-- <input type="hidden" id="title" value="connard"/> -->
				<img id="filtre" src="filtres/1.png" value=""  />
				<video id="video" width="640" height="480" autoplay></video>
				<a href="#" id="snap" class="booth-capture-button">Take photo</a>
				<!-- <button class="booth-capture-button" id="snap">Snap Photo</button> -->
				<input type="hidden" id="png" value="" />
				<input type="hidden" id="nomfiltre" value="" />
				<img id="filtre2" src="filtres/1.png" value=""  />
				<!-- <img id="filtre" src="#" value=""  /> -->
				<canvas id="canvas" width="640" height="480"></canvas>
				<input id="upload" type="file" name="upload" />
				<button id="send"  onclick="postthat()">Enregistrer</button>
			</div>
			<img id="chevron_droit" src="images/chevron-right.png"/>
		</div>
			<div id="photos">
				<h2>Mes photos</h2>
				<?php
				while ($data = $requser->fetch())
				{
						echo "<div>
							<img width=25 src='./images/cross.png' style='position:initiale' onClick='deleteImg(".$data['id'].")'/>
							<img src='" . $data["image"] . "' width=200 height=200/>'
							</div>";
				// echo "<img src='" . $data2["image"] . "' width=200 height=200/>'";
				}
				?>
			</div>
		<aside>

		</aside>
		<script src="bollachcam.js">

		</script>

	</body>
</html>
