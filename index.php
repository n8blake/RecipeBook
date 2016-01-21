<?php

	//report errors for debugging...
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	//include the custom functions library...
	include('./other/custom_functions.php');

	//include the MySQL database connection settings...
	include('../db/db_settings.php');

	//get the filepath and split on '/', then use the current directory name as APP_NAME
	$file = dirname(__FILE__);
	$dir = explode('/', $file);
	
	define('APP_NAME', $dir[count($dir) - 1]);

	//lazy load all models
	$modelsDir = './models/';
	$modelsArr = scandir($modelsDir);

	foreach ($modelsArr as $model) {
		if($model != '.' && $model != '..'){
			include ('./models/'. $model);
		}
	}

	$uri = parse_url($_SERVER['REQUEST_URI']);

	include('uri_handler.php');

	handleURI($uri);

	//print_r($uri);
	
?>