<?php
	session_start();
	function send_mail($to, $key, $pseudo)
	{
		// $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
		// $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
		// echo "HELLO";
		$subject="Confirmation du mail";
		$message = 'hello';
		$key = md5(microtime(TRUE)*100000);
		$_SESSION['key'] = $key;
		$message = "Pour valider ton compte. Clique <a href='http://localhost:8080/Camagru/User/creation/validated.php?id=".$pseudo."&key=".$key."'>ici.</a>";

		// <html>
		// 	<body>
		// 		<div align="center">
		// 			<a href="http://e2r3p3.42.fr:8080/espace_membre/confirmation.php?pseudo=" . urlencode($pseudo) . "&key".$key>Confirmez votre compte !</a>
		// 		</div>
		// 	</body>
		// </html>';
		$headers = "From: Support <eozdek@student.42.fr>\n".
		"MIME-Version: 1.0" . "\n" .
		"Content-type: text/html; charset=UTF-8" . "\n";
		// "Content-Transfer-Encoding: 8-bit". "\r\n";
		return mail($to, $subject, $message, $headers);
	}
?>
