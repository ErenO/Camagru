<?php
	session_start();
	include ("../config/setup.php");
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
		$mdpLength = strlen($mdp);
		if (!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
		{
			$pseudolength = strlen($pseudo);
			$reqverif = $pdo->prepare('SELECT * FROM membres WHERE pseudo = ?');
			$reqverif->execute(array($pseudo));
			$pseudoVerif = $reqverif->rowCount();
			if ($mdpLength > 5 && $mdpLength < 256)
			{
				if (preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,255}$/', $mdp))
				{
					$mdp = sha1($_POST['mdp']);
					$mdp2 = sha1($_POST['mdp2']);
					if ($pseudoVerif == 0)
					{
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
											$id = $user[0];
											$to = $mail;
											$subject = 'Activer votre compte';
											$message = "Pour valider ton compte. Clique <a href='http://localhost:8080/Camagru/PHP/validate.php?id=".$id."&key=".$key."'>ici.</a>";
											$headers  = 'MIME-Version: 1.0' . "\r\n";
											$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
											$headers .= 'From: eozdek@student.42.fr' . "\r\n" .
														'Reply-To: eozdek@student.42.fr' . "\r\n" .
														'X-Mailer: PHP/' . phpversion();
											mail($to, $subject, $message, $headers);
											$_SESSION['erreur'] = "Votre compte a bien été créé ! <a href=\"PHP/connexion.php\">Me connecter</a>";
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
					}
					else
					{
						$_SESSION['erreur'] = "Pseudo déjà utilisé !";
					}
				}
				else
				{
					$_SESSION['erreur'] = "Votre mot de passe doit contenir une minuscule, une majuscule et un chiffre au minimum";
				}
			}
			else
			{
				$_SESSION['erreur'] = "Votre mot de passe doit contenir au minimum 6 caractères et maximum 255";
			}
		}
		else
		 {
			$_SESSION['erreur'] = "Tous les champs doivent être complétés !";
		}
		header('Location: ../index.php');
	}
?>
