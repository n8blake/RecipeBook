<?php

	class Recipe_View {

		public $recipe;

		function __construct($_recipe){
			$this->recipe = $_recipe;
		}

		public function render(){

			?>

			<div class="container">

				<div class="well">
					Bootstrap loaded.
				</div>

				<pre>

					<?php print_r($this->recipe) ?>

				</pre>
			</div>

			<?php

		}

	}

?>