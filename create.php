<?php
	session_start();

	include "setup.php";
	include "mail.php";

	if (isset($_POST['forminscription']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail2 = htmlspecialchars($_POST['mail2']);
		$mdp = sha1($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);
		if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
		{
			$pseudolength = strlen($pseudo);
			if ($pseudolength <= 255)
			{
				if ($mail == $mail2) {
					if (filter_var($mail, FILTER_VALIDATE_EMAIL))
					{
						$reqmail = $pdo->prepare("SELECT * FROM membres WHERE mail = ?");
						$reqmail->execute(array($mail));
						$mailexist = $reqmail->rowCount();
						if ($mailexist == 0)
						{
							if ($mdp == $mdp2)
							{
								$longueurKey = 12;
								$key = "";
								for ($i = 1; $i < $longueurKey; $i++)
								{
									$key .= mt_rand(0, 9);
								}
								$insertmbr = $pdo->prepare("INSERT INTO membres(pseudo, mail, motdepasse, confirmkey, avatar) VALUES(?, ?, ?, ?, ?)");
								$insertmbr->execute(array($pseudo, $mail, $mdp, $key, "mario.png"));
								send_mail($mail, $key, $pseudo);
								$_SESSION['erreur'] = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
							}
							else
							{
								$_SESSION['erreur'] = "Vos mots de passes ne correspondent pas !";
							}
						}
						else
						{
							$_SESSION['erreur'] = "Adresse mail déjà utilisée !";
						}
					}
					else
					{
						$_SESSION['erreur'] = "Votre adresse mail n'est pas valide !";
					}
				}
				else
				{
					$_SESSION['erreur'] = "Vos adresses mail ne correspondent pas !";
				}
			}
			else
			 {
				$_SESSION['erreur'] = "Votre pseudo ne doit pas dépasser 255 caractères !";
			}
		}
		else
		 {
			$_SESSION['erreur'] = "Tous les champs doivent être complétés !";
		}
		header('Location: index.php');
	}
?>
