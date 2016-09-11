<?php
	session_start();

	function send_mail($to, $key, $id)
	{
		// $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
		// $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
		$subject="Confirmation du mail";
		$message = 'hello';
		$key = md5(microtime(TRUE)*100000);
		$_SESSION['key'] = $key;
		$message = "Pour valider ton compte. Clique <a href='http://localhost:8080/Camagru/validate.php?id=".$id."&key=".$key."'>ici.</a>";
		$headers = "From: Support <eozdek@student.42.fr>\n".
		"MIME-Version: 1.0" . "\n" .
		"Content-type: text/html; charset=UTF-8" . "\n";
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
