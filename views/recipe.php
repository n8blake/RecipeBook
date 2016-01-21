<?php

	class Recipe_View {

		public $recipeID;

		function __construct($_id){
			$this->recipeID = $_id;
		}

		public function render(){

			?>
			<script>window.recipeIDinit = <?php echo $this->recipeID;?>;</script>
			<div class="container" id="content">

				<div class="well"><?php echo $this->recipeID;?></div>

			</div>

			<?php
		}
	}
?>