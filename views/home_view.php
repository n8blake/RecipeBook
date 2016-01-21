<?php

	class Home_View {

		function __construct(){}

		public function render(){
		?>
			<div id="content" class="container">

				<div class="row">
					<div class="col-md-3">
						Recipe 1
					</div>
					<div class="col-md-3">
						Recipe 2
					</div>
					<div class="col-md-3">
						Recipe 3
					</div>
					<div class="col-md-3">
						Recipe 4
					</div>
				</div>
				<!--
				<div class="row">
					<div class="col-md-8">

						This is where the recipe will be.

					</div>

					<div class="col-md-4">
						<div class="list-group">
							<a class="list-group-item" href="#">Lamb Chops</a>
							<a class="list-group-item" href="#">Deviled Eggs</a>
							<a class="list-group-item" href="#">French Toast</a>
							<a class="list-group-item" href="#">Baked Brie</a>
						</div>
					</div>

				</div>-->

			</div>
		<?php
		}
	}
?>