# reCAPTCHA-v2
Quick little PHP class for using the new version of reCAPTCHA

**Example**

<?php
	$secret_key = 'YOUR KEY';
	$public_key = 'YOUR KEY';
	
	$recaptcha = new reCAPTCHA($secret_key, $public_key);
	
	if(!empty($_POST)) {
		if($recaptcha->isValid()) {
			echo 'Valid Captcha<br>';
		}
		else {
			echo 'Invalid Captcha<br>';
		}
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Recaptcha Test</title>
		<?php $recaptcha->outputApi() ?>
	</head>
	<body>
		Recaptcha Test: <br>
		<form method="post" action="">
			<?php $recaptcha->outputCaptcha() ?>
			<input type="submit">
		</form>
	</body>
</html>
