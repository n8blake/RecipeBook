<?php

	//CUSTOM FUNCTIONS
	
	function runStandardQuery($_sql, $_specificResponse){

		$servername = $GLOBALS['MYSQL_SERVER'];
		$username = $GLOBALS['MYSQL_USERNAME'];
		$password = $GLOBALS['MYSQL_PASSWORD'];
		$dbname = $GLOBALS['MYSQL_APP_DATABASE'];

		$data = array();

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			$error = $conn->connect_error;
			$data["Error"] = ["Connection failed: $error"];
		    //die("Connection failed: " . $conn->connect_error);
		} 

		//$sql = "SELECT id, firstname, lastname FROM MyGuests";
		$result = $conn->query($_sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
		        array_push($data, $row);
		    }

		} else {
		    
			if(!isset($data['Error'])){

			    $_sr = "";

			    if(isset($_specificResponse)){
			    	$_sr = "for " . $_specificResponse;
			    }

			    $data["Error"] = ["No results found $_sr"];
		    
		    }
		}

		$conn->close();

		return $data;

	}

?>