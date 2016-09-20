<?php
	session_start();
	include ("../config/setup.php");

	if (!$_SESSION['loggued_on_user'])
	{
		$_SESSION['erreur'] = "Connecte-toi !";
		header("Location: ./connexion.php");
		exit;
	}
	$pic = explode(",", $_POST['image']);
	if ($pic = base64_decode($pic[1])) {
		$pic = imagecreatefromstring($pic);
		if (!file_exists($_POST['png']))
		{
			$_SESSION['message'] = "Met un filtre, connard.";
			header("Location: ./cam.php");
			exit;
		}
		$filter = explode(".", $_POST['png']);
		$ext = count($filter);
		if ($filter[$ext - 1] !== "png")
		{
			$_SESSION['message'] = "Error";
			header("Location: ./cam.php");
			exit;
		}
		if (file_exists($_POST['png']))
		{
			$filter = imagecreatefrompng($_POST['png']);
			imagecopy($pic, $filter, 0, 0, 0, 0, 640, 480);
			ob_start();
			imagepng($pic);
			$image = ob_get_contents();
			ob_end_clean();
			$req = $pdo->prepare('INSERT INTO post (image, membre_id, liked) VALUES(:image, :membre_id, :liked)');
			$tab = array(
				'image' => "data:image/png;base64,".base64_encode($image),
				'membre_id' => $_SESSION['id'],
				'liked' => 0
			);
			$req->execute($tab);
			$_SESSION['message'] = "Ta photo est bien enregistré !";
		}
		header("Location: ./cam.php");
	}
?>
