<?php


	//This is the 404 controller

	include './views/header.php';
	include './views/footer.php';
	include './views/404.php';

	$header = new Header();
	$footer = new Footer();
	$view = new Unknown_View($path, $PATH_COUNT);

	$header->render();
	$view->render();
	$footer->render();

?>