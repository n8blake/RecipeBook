<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	session_start();

	require_once('../db/db_settings.php');

	include ('models/recipe.php');
	include ('views/recipe.php');
	include ('views/header.php');
	include ('views/footer.php');

	define('CSS_PATH', './includes/css/');
	define('JS_PATH', './includes/js/');

	$myRecipe = new Recipe(1);

	$header = new Header();
	$footer = new Footer();

	$view = new Recipe_View($myRecipe);

	$header->render();
	$view->render();
	$footer->render();


?>