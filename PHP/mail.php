<?php
	session_start();

	function send_mail($to, $key, $id)
	{
		$subject = 'Activer votre compte';
		$message = "Pour valider ton compte. Clique <a href='http://localhost:8080/Camagru/validate.php?id=".$id."&key=".$key."'>ici.</a>";
		$message = wordwrap($message, 70);
		$headers = 'From: eozdek@student.42.fr' . "\r\n" .
		'Reply-To: eozdek@student.42.fr' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		return mail($to, $subject, $message, $headers);
	}

	function send_comment($to, $pseudo)
	{
		$subject = "On a commenté ta photo";
		$message = 'Tu viens de recevoir un commentaire de '. $pseudo .' sur ta photo !';
		$headers = 'From: eozdek@student.42.fr' . "\r\n" .
		'Reply-To: eozdek@student.42.fr' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		return mail($to, $subject, $message, $headers);
	}
?>
