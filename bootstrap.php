<?php
require 'vendor/autoload.php';
require 'config.php';

define('PROJECT_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
//echo PROJECT_PATH;
//echo $DB_NAME.':'.$DB_HOST.':'.$DB_USER.':'.$DB_PASS;

$app = new \Slim\Slim(array(
	'mode'  			=> 'development',
	'debug' 			=> true,
	'log.enable' 		=> true,
	'templates.path'	=> 'tpl'
));

\Slim\Extras\Views\Twig::$twigOptions = array(
	'charset' => 'utf-8',
	'cache'	=> realpath('./tpl_cache'),
	'auto_reload' => true,
	'strict_variables' => false,
	'autoescape' => true
);

$app->view(new \Slim\Extras\Views\Twig());

require 'app.php';
$app->run(); 

