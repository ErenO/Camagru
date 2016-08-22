<?php
	include "setup.php";

	if (isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key']))
	{
		$pseudo = htmlspecialchars(urlencode($_GET['pseudo']));
		$key = htmlspecialchars($_GET['key']);
		$requser = $pdo->prepare("SELECT * FROM membres WHERE pseudo = ? AND confirmkey = ?");
		$requser->execute(array($pseudo, $key));
		$userexist = $requser->rowCount();

		if ($userexist == 1)
		{
			$user = $requser->fetch();
			if (!$user['confirme'])
			{
				$updateuser = $pdo->prepare("UPDATE membres SET confirme = 1 WHERE pseudo = ? AND confirmkey = ?");
				$updateuser->execute(array($pseudo, $key));
				echo "Votre compte a bien été confirmé !";
			}
			else
			{
				echo "Votre compte a déjà été confirmé !";
			}
		}
		else
		{
			echo "l'utilisateur n'existe pas";
		}
	}
?>
