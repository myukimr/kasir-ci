<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// To use reCAPTCHA, you need to sign up for an API key pair for your site.
// link: http://www.google.com/recaptcha/admin
$config['recaptcha_site_key'] = '6Lce0OAUAAAAAGo3qesDvPeG8dBUeJs_BmGJhbDu';
$config['recaptcha_secret_key'] = '6Lce0OAUAAAAADFR2tE7p_91KuC5sOsvP0SWAzUI';

// reCAPTCHA supported 40+ languages listed here:
// https://developers.google.com/recaptcha/docs/language
$config['recaptcha_lang'] = 'en';

/* End of file recaptcha.php */
/* Location: ./application/config/recaptcha.php */