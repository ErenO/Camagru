<?php
	session_start();
	require('setup.php');
	if (!$_SESSION['loggued_on_user'])
	{
		$_SESSION['message'] = "You need to log in";
		header("Location: ./index.php");
		exit;
	}
	$pic = explode(",", $_POST['image']);
	if($pic = base64_decode($pic[1])) {
		$pic = imagecreatefromstring($pic);
		if (!file_exists($_POST['png']))
		{
			$_SESSION['message'] = "Filter not found";
			header("Location: ./index.php");
			exit;
		}
		$filter = explode(".", $_POST['png']);
		$ext = count($filter);
		if ($filter[$ext - 1] !== "png")
		{
			$_SESSION['message'] = "Error";
			header("Location: ./index.php");
			exit;
		}
		$filter = imagecreatefrompng($_POST['png']);
		imagecopy($pic, $filter, 0, 0, 0, 0, 640, 480);
		ob_start();
		imagepng($pic);
		// read from buffer
		$image = ob_get_contents();
		// delete buffer
		ob_end_clean();
		$req = $pdo->prepare('INSERT INTO post (pseudo, titre, lieu, image, email, liked) VALUES(:pseudo, :titre, :lieu, :image, :email, :liked)');
		$tab = array(
			'pseudo' => $_SESSION['pseudo'],
			'titre' => htmlspecialchars ($_POST['titre']),
			'lieu' => htmlspecialchars ($_POST['lieu']),
			'image' => "data:image/png;base64,".base64_encode($image),
			'email' => $_SESSION['loggued_on_user'],
			'liked' => 0
		);
		$req->execute($tab);
		$_SESSION['message'] = "You successfully posted this pic";
		header("Location: ./cam.php");
	}
?>
