<?php

	class Recipe_View {

		public $recipe;

		function __construct($_recipe){
			$this->recipe = $_recipe;
		}

		public function render(){

			?>

			<div>

				<pre>

					<?php print_r($this->recipe) ?>

				</pre>
			</div>

			<?php

		}

	}

?>