<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'mailer/class.phpmailer.php';
class My_email extends PHPMailer {
	public function __construct() {
		parent::__construct();
	}
}
?>