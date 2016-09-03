<?php
	session_start();
	require "header.php";
	require "footer.html";
	include ("setup.php");

	if (isset($_SESSION['bon']))
	{
		 echo '<script>alert("TON TEXTE");</script>';
	}
	$requser = $pdo->prepare('SELECT * FROM membres WHERE id = ?');
	$requser->execute(array($_SESSION['id']));
	$userinfo = $requser->fetch();
	$requser = $pdo->prepare('SELECT * FROM post WHERE pseudo = ?');
	$requser->execute(array($userinfo['pseudo']));
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="CSS/body.css" />
		<title>Gallerie</title>
	</head>
	<body>
		<?php
			while ($data = $requser->fetch())
			{
				echo "<img src='" . $data["image"] . "' width=200 height=200/>'";
			// echo "<img src='" . $data2["image"] . "' width=200 height=200/>'";
			}
		?>
	</body>
</html>
