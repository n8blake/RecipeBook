<?php

	class Header {

	public $title = "";
	public $css = array();
	public $js = array();

	function __construct(){
		$this->title = "Plate";
	}

	public function setTitle($_title){
		$this->title = $_title;
	}

	public function setCSS($_css){
		$this->css = $_css;
	}

	public function setJS($_js){
		$this->js = $_js;
	}

	public function render(){

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<?php 
			foreach ($this->css as $cssFileName) {
				echo '<link rel="stylesheet" type="text/css" href="'. CSS_PATH .'/'. $cssFileName .'">';
			}
		?>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		
		<title><?php echo $this->title; ?></title>
	</head>
<body>

<?php

	}
}

?>