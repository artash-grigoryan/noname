<?php

define('PORT', (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://');
define('DOM_NAME',     'tonsiteinternet.fr');
define('SUBDOM_NAME',  '');


//define('LANGUAGE', !empty($_GET['lang']) ? $_GET['lang'] : substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

define('PATH',           PORT.SUBDOM_NAME.DOM_NAME.'/websites/alpharelaxation.fr/partners/');
define('BASE_PATH',      PATH);
define('CURRENT_PATH',   PORT.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
define('ABS_PATH',       dirname(dirname(dirname(__FILE__))).'/');

define('WEBSITE_PATH',    PATH);
define('WEBSITE_ABS_PATH',dirname(dirname(dirname(__FILE__))).'/');

//way to the motor
define("MOTOR_ABS_PATH", dirname(dirname(dirname(dirname(__FILE__)))).'/tsi_engine_v4.2/');
define("MOTOR_PATH",     PORT.SUBDOM_NAME.DOM_NAME.'/websites/alpharelaxation.fr/tsi_engine_v4.2/');

define('SESSION_NAME', 'alpharelaxation');

define('MAIL_FROM',    'contact@alpharelaxation.fr');
define('MAIL_NAME',    'Service Partenaires Psio');

define('SUPER_ADMIN', 8);
define('ADMIN',       4);
define('CLIENT',      2);
define('USER',        1);
define('UNKNOWN',     0);

//define salt and new user auth
define('NEW_USER_AUTH', CLIENT);
define('SALT',         '24nku9Q3LkVm8G4HB3yreQru3jU99t7K9TB6Zj3y');

/*
 * define options and actions exception for auth
 * if all the component is an exception, define $action to 'all'
 */
$auth_exceptions   = array();
$auth_exceptions[] = array('option' => 'users', 'action' => 'lockedLoginForm');
$auth_exceptions[] = array('option' => 'users', 'action' => 'forgotPassword');
$auth_exceptions[] = array('option' => 'users', 'action' => 'activeAccount');
$auth_exceptions[] = array('option' => 'users', 'action' => 'resetPassword');
$auth_exceptions[] = array('option' => 'users', 'action' => 'sendMailConfirmation');
$auth_exceptions[] = array('option' => 'users', 'action' => 'registration');
$auth_exceptions[] = array('option' => 'users', 'action' => 'confirmMail');
$auth_exceptions[] = array('option' => 'users', 'action' => 'logout');
$auth_exceptions[] = array('option' => 'notification', 'action' => 'all');
$auth_exceptions[] = array('option' => 'mail', 'action' => 'all');
$auth_exceptions[] = array('option' => 'pdf', 'action' => 'all');
define('AUTH_EXCEPTIONS', serialize($auth_exceptions));
?>