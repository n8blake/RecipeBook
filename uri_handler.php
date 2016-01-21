<?php

	//URI HANDLER

	function handleURI($_URI){

		$path = explode('/', $_URI['path']);

		//print_r($path);
		// Array ( [0] => [1] => RecipeBook [2] => controller [3] => action [4] => param )
		/*  URL SHOULD BE FORMATTED LIKE:
		*	(http://etc.com/ php /) / APP_NAME / CONTROLLER /  ACTION / PRAMETERS
		*	This will have to be adjusted based on your initial directory set up.
		*/

		///////////////////////////////////////////////////////////////////////////////////////////////////
		//  BASE_URL WILL NEED TO BE RESET IF YOUR DIRECTORY STRUCTURE IS DIFFERENT... PAY ATTENTION!!!  //
		///////////////////////////////////////////////////////////////////////////////////////////////////

		define('BASE_URL', '/RecipeBook/' . APP_NAME );

		$REQUESTED_CONTROLLER  = '';
		$PATH_COUNT = count($path);

		if (count($path) <= 3){

			$REQUESTED_CONTROLLER = 'home';

		} elseif (count($path) == 4) {

			$REQUESTED_CONTROLLER = $path[2];

		} elseif (count($path) == 5) {

			$REQUESTED_CONTROLLER = $path[2];
			$REQUESTED_ACTION = $path[3];

		} elseif (count($path) >= 6) {

			$REQUESTED_CONTROLLER = $path[2];
			$REQUESTED_ACTION = $path[3];
			$REQUESTED_PARAMETERS = $path[4];

		} else {

			$REQUESTED_CONTROLLER = 'UNKNOWN';

		}

		//print_r($path);


		
		if(isset($REQUESTED_CONTROLLER)){
			
			//echo "Requested Controller: $REQUESTED_CONTROLLER <br>";
			//include('./views/header.php');
			//include('./views/footer.php');

			if(file_exists('./controllers/'. $REQUESTED_CONTROLLER .'.php')){
				//echo "Found $REQUESTED_CONTROLLER <br>";

				include './controllers/'. $REQUESTED_CONTROLLER .'.php';

			} else {

				include './controllers/404.php';

			}

		} else {

			echo '{"Status":"Error","Message":"Contoller router error."}';

		}

	}

?>