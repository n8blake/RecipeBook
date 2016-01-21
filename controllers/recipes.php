<?php

	//recipe controller
	$isJSON = true;

	if(isset($REQUESTED_ACTION)){

		if($REQUESTED_ACTION == 'GET'){
			$JSON = "You made a get request!";
		} elseif ($REQUESTED_ACTION == 'display') {
			
			$isJSON = false;

			include './views/header.php';
			include './views/footer.php';
			include './views/recipe.php';

			$header = new Header();
			$footer = new Footer();
			$view = new Recipe_View($REQUESTED_PARAMETERS);

		} else {
			$JSON = '{"Status":"Error","Message":"Action not recognized."}';
		}

	} else {
		$JSON = '{"Status":"Error","Message":"Action not set."}';
	}

	if($isJSON){

		$JSON = json_encode($response);
		echo $JSON;

	} else {

		$header->render();
		$view->render();
		$footer->render();
	}


?>