<?php

	//This is the home controller.

	//include ('./views/header.php');
	//include ('./views/footer.php');

	
	$isJSON = false;
	$response = "";

	include './views/header.php';
	include './views/footer.php';

	include ('./views/home_view.php');
	$header = new Header();

	$header->css_files = array("");
	$header->js_files = array("");

	$view = new Home_View();
	$footer = new Footer();


	if($isJSON){

		$JSON = json_encode($response);
		echo $JSON;

	} else {

		$header->render();
		$view->render();
		$footer->render();
	}

?>