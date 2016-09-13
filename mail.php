<?php
	session_start();

	function send_mail($to, $key, $id)
	{
		// $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
		// $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
		// $subject="Confirmation du mail";
		$subject = 'Activer votre compte';
		$message = "Pour valider ton compte. Clique <a href='http://localhost:8080/Camagru/validate.php?id=".$id."&key=".$key."'>ici.</a>";
		// $message = 'hello';
		$message = wordwrap($message, 70);
		// $headers = "From: Support <eozdek@student.42.fr>\n".
		// "MIME-Version: 1.0" . "\n" .
		// "Content-type: text/html; charset=UTF-8" . "\n";
		$headers = 'From: eozdek@student.42.fr' . "\r\n" .
		'Reply-To: eozdek@student.42.fr' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		return mail($to, $subject, $message, $headers);
	}

	function send_comment($to, $pseudo)
	{
		// $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
		// $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
		$subject="Confirmation du mail";
		$message = 'Tu viens de recevoir un commentaire de '. $pseudo .' sur ta photo !';
		$headers = "From: Support <eozdek@student.42.fr>\n".
		"MIME-Version: 1.0" . "\n" .
		"Content-type: text/html; charset=UTF-8" . "\n";
		return mail($to, $subject, $message, $headers);
	}
?>
