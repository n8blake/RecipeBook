<?php

	class Recipe {

		public $id;
		public $recipe;
		public $ingredients;
		public $directions;
		public $sql_all;
		public $recipe_sql;
		public $directions_sql;
		public $ingredients_sql;

//HEY JOHN IT'S NATE :) 

		function __construct($_id){
			$this->id = $_id;

			
			$this->sql_all = "SELECT r.recipeName, r.tips, r.servings, u.userName, t.label, s.orderNumber, s.text, i.ingredientName, IXR.quantity, IXR.unit 
							FROM 
							recipes r
							JOIN users u ON u.userID=r.author
							JOIN types t ON t.typeID=r.typeID
							JOIN directions d ON d.recipeID=r.recipeID
							JOIN ingredientsXrecipe IXR ON IXR.recipeID=r.recipeID
							JOIN ingredients i ON i.ingredientID=IXR.ingredientID
							JOIN steps s ON s.`stepID`=d.stepID
						WHERE r.recipeID='$_id'";
			$this->recipe_sql = "SELECT r.recipeName, r.tips, r.servings, u.userName, t.label
							FROM 
								recipes r
								JOIN users u ON u.userID=r.author
								JOIN types t ON t.typeID=r.typeID
							WHERE r.recipeID='$_id'";
			$this->directions_sql = "SELECT s.orderNumber, s.text
							FROM
								recipes r
								JOIN directions d on d.recipeID=r.recipeID
								JOIN steps s ON s.`stepID`=d.stepID
							WHERE r.recipeID='$_id'";
			$this->ingredients_sql = "SELECT i.ingredientName, IXR.quantity, IXR.unit
							FROM
								recipes r
								JOIN ingredientsXrecipe IXR on IXR.recipeID=r.recipeID
								JOIN ingredients i on i.ingredientID=IXR.ingredientID
							WHERE r.recipeID='$_id'";

			$this->recipe = $this->runStandardQuery($this->recipe_sql);
			$this->ingredients = $this->runStandardQuery($this->ingredients_sql);
			$this->directions = $this->runStandardQuery($this->directions_sql);

		}




		function runStandardQuery($_sql){

			$host = $GLOBALS['MySQL_SERVER'];
			$pass = $GLOBALS['MySQL_SERVER_PASS'];
			$user = $GLOBALS['MySQL_SERVER_USER'];
			$db = "RecipesDB";

			//SELECT recipes.*, users.name FROM recipes JOIN users ON users.userID=recipes.author 

			//$sql = "SELECT * FROM recipes WHERE `recipeID`='$_id'";

			

			$conn = new mysqli($host, $user, $pass, $db);

			$result = $conn->query($_sql);

			if($result->num_rows > 0 ){
				if ($result->num_rows == 1){
					return $result->fetch_assoc();
				} else {
					$rows = array();
					while($row = $result->fetch_assoc()){
						array_push($rows, $row);
					}
					return $rows;
				}
			} else {
				return "No recipe found for id: $_id";
			}
		}


	}


?>
