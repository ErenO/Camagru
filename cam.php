<?php
	session_start();
	require "header.php";
	require "footer.html";

	if(isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		if (empty($_SESSION['id']))
		{
			$_SESSION['id'] = $getid;
		}
	}
	echo $_SESSION['ok'];
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="CSS/body.css" />
	<meta content="stuff, to, help, search, engines, not" name="keywords">
	<meta content="What this page is about." name="description">
	<meta content="Display Webcam Stream" name="title">
	<title>camagru</title>

	</head>

	<body>
		<video id="video" width="640" height="480" autoplay></video>
		<button id="snap">Snap Photo</button>
		<canvas id="canvas" width="640" height="480"></canvas>
		<aside>

		</aside>
		<script src="bollachcam.js">
		</script>
	</body>
</html>
