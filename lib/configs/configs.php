<?php

define('PORT', (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://');
define('DOM_NAME',     'localhost');
define('SUBDOM_NAME',  '');


//define('LANGUAGE', !empty($_GET['lang']) ? $_GET['lang'] : substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

define('PATH',           PORT.SUBDOM_NAME.DOM_NAME.'/github/noname/');
define('BASE_PATH',      PATH);
define('CURRENT_PATH',   PORT.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
define('ABS_PATH',       dirname(dirname(dirname(__FILE__))).'/');

//way to the motor
define("MOTOR_ABS_PATH", dirname(dirname(dirname(__FILE__))).'/tsi_engine_v4.2/');
define("MOTOR_PATH",     PATH.'tsi_engine_v4.2/');

define('SESSION_NAME', 'noname');

define('MAIL_FROM',    'contact@domain.com');
define('MAIL_NAME',    'Contact');

define('SUPER_ADMIN', 8);
define('ADMIN',       4);
define('CLIENT',      2);
define('USER',        1);
define('UNKNOWN',     0);

//define salt and new user auth
define('NEW_USER_AUTH', CLIENT);
define('SALT', '4815e52a7ab91460692726ba590a7a1697208607');

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