<?php

	class Unknown_View {

		public $request;
		public $count;


		function __construct($_r, $_c){
			$this->request = $_r;
			$this->count = $_c;
		}

		public function render(){

			?>

				<div id="content" class="container">
					<div class="alert alert-danger">
						<strong>404!</strong>
						<p>The page you have requested could not be found. If you feel you have reached this page by mistake, please contact the system administrator.
							But it probably won't do you much good because he really doesn't give a shit.</p>
						<pre><?php 
						print_r($this->request);
						print_r($this->count);
						?></pre>
					</div>
				</div>

			<?php
		}
	}

?>