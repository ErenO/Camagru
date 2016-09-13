<?php
	session_start();
	include "setup.php";
	include "mail.php";

	if (isset($_POST['forminscription']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail2 = htmlspecialchars($_POST['mail2']);
		$mdp = $_POST['mdp'];
		$mdp2 = $_POST['mdp2'];
		$pseudoValid = 0;
		$indexMaj = 0;
		$indexMin = 0;
		$indexNum = 0;
		// while ($mdp[$i])
		// {
		// 	if ($mdp[$i] >= 'a' && $mdp[$i] <= 'z')
		// 	{
		// 		$indexMin += 1;
		// 	}
		// 	else if ($mdp[$i] >= 'A' && $mdp[$i] <= 'Z')
		// 	{
		// 		$indexMaj += 1;
		// 	}
		// 	else if ($mdp[$i] >= '0' && $mdp[$i] <= '9')
		// 	{
		// 		$indexNum += 1;
		// 	}
		// 	$i += 1;
		// }
		$mdpLength = strlen($mdp);
		$mdp = sha1($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);
		if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
		{
			$pseudolength = strlen($pseudo);
			// $reqverif = $pdo->prepare('SELECT pseudo FROM membres');
			// $reqverif->execute();
			// while ($pseudoVerif = $reqverif->fetch())
			// {
			// 	if ($pseudoVerif[0] = $pseudo)
			// 	{
			// 		$pseudoValid = 1;
			// 	}
			// }
			// $pseudoValid = 0;
			// if ($mdpLength > 5)
			// {
				// if ($indexNum > 0 && $indexMin > 0 && $indexMaj > 0)
				// {
					// if ($pseudoValid == 1)
					// {
						if ($pseudolength >= 2 && $pseudolength <= 255)
						{
							if ($mail == $mail2)
							{
								if (filter_var($mail, FILTER_VALIDATE_EMAIL))
								{
									$reqmail = $pdo->prepare("SELECT * FROM membres WHERE mail = ?");
									$reqmail->execute(array($mail));
									$mailexist = $reqmail->rowCount();
									if ($mailexist == 0)
									{
										if ($mdp == $mdp2)
										{
											$key = md5(microtime(TRUE)*100000);
											$insertmbr = $pdo->prepare("INSERT INTO membres(pseudo, mail, motdepasse, confirmkey, avatar, validate) VALUES(?, ?, ?, ?, ?, ?)");
											$insertmbr->execute(array($pseudo, $mail, $mdp, $key, "no_avatar_big.png", 0));
											$userinfo = $pdo->prepare('SELECT id FROM membres WHERE pseudo = ?');
											$userinfo->execute(array($pseudo));
											$user = $userinfo->fetch();
											$subject="Confirmation du mail";
											$message = "hello";
											// $message = "Pour valider ton compte. Clique <a href='http://localhost:8080/Camagru/validate.php?id=".$user[0]."&key=".$key."'>ici.</a>";
											$headers = "From: Support <eozdek@student.42.fr>\n".
											"MIME-Version: 1.0" . "\n" .
											"Content-type: text/html; charset=UTF-8" . "\n";
											// $_SESSION['erreur'] = "mail sent";
											mail("eren.ozdek@gmail.com", $subject, $message, $headers);
											// send_mail("eren.ozdek@gmail.com", $key, $user[0]);
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
							$_SESSION['erreur'] = "Votre pseudo doit avoir entre 2 et 255 caractères !";
						}
					// }
					// else
					// {
					// 	$_SESSION['erreur'] = "Pseudo déjà utilisé !";
					// }
			// 	}
			// 	else
			// 	{
			// 		$_SESSION['erreur'] = "Votre mot de passe doit contenir une minuscule, une majuscule et un chiffre au minimum";
			// 	}
			// }
			// else
			// {
			// 	$_SESSION['erreur'] = $pseudolength."Votre mot de passe doit contenir au minimum 6 caractères";
			// }
		}
		else
		 {
			$_SESSION['erreur'] = "Tous les champs doivent être complétés !";
		}
		header('Location: index.php');
	}
?>
