<?php

	class Header {

	public $title = "";
	public $css = array();
	public $js = array();

		function __construct(){
			$this->title = "Plate";
		}


	public function render(){

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="/RecipeBook/includes/css/styles.css">
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
	<div class="container">
		
		<div class="row" id="header_container">
			<div class="col-sm-12 col-md-9">
				<div id="main_logo_container">
					<img id="main_logo" src="/RecipeBook/includes/assests/plate-logo1b.png" class="center-block">
				</div>
			</div>
			<div class="input-group col-md-3">
				<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span>
				<input class="form-control" type="text" placeholder="SEARCH"/>
			</div>
			
			<div class="pull-right">
				<span class="btn btn-default">LOGIN</span>
			</div>
		</div>
	</div>

<?php

	}
}

?>