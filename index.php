<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	session_start();

	include ('models/recipe.php');
	include ('views/recipe.php');

	$myRecipe = new Recipe(1);

	$view = new Recipe_View($myRecipe);

	$view->render();


?>