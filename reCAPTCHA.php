<?php
class reCAPTCHA {

	private $private_key;
	private $public_key;

	public function __construct($private_key, $public_key) {
		if(empty($private_key) || empty($public_key)) {
			throw new InvalidArgumentException('Both the private and public keys are required.');
		}
		$this->private_key = $private_key;
		$this->public_key = $public_key;
	}

	public function getApi() {
		return "<script src='https://www.google.com/recaptcha/api.js'></script>";
	}

	public function outputApi() {
		echo $this->getApi();
	}

	public function getCaptcha($class = 'g-recaptcha') {
		return '<div class="' $class '" data-sitekey="' . $this->public_key . '"></div>';
	}

	public function outputCaptcha($class = 'g-recaptcha') {
		echo $this->getCaptcha($class);
	}

	public function isValid($response = '', $ip = '') {
		if(empty($response) && !empty($_POST['g-recaptcha-response'])) {
			$response = $_POST['g-recaptcha-response'];
		}
		else {
			return false;
		}

		if(empty($ip)) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		$url = "https://www.google.com/recaptcha/api/siteverify?secret={$this->private_key}&response={$response}&remoteip={$ip}";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$curlData = curl_exec($curl);
		curl_close($curl);

		$response = json_decode($curlData, true);

		return (bool) $response['success'];
	}

}
