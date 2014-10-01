<?php

	header("content-type: application/json");
	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	require_once("db_connect.php");

	$table = "WEIGH_IN_DATA";

	if (isset($_POST['newWeighInData'])) {
		$newWeighInData = $_POST["newWeighInData"];
		// echo "<div class=\"debug\">newWeighInData is: " . $newWeighInData . " (a string, presumably)</div>";

		$newWeighInData = json_decode($newWeighInData, true); // true = associative array of objects

		$user		= $newWeighInData['user'];
		$date		= $newWeighInData['date'];
		$weight	= $newWeighInData['weight'];

		/*
			echo "<div class=\"debug\">";
				echo "<p><strong>php variables set for each member in the json_decoded-newWeighInData:</strong></p>";
				echo "<p>\$user is: " . $user . "</p>";
				echo "<p>\$date is: " . $date . "</p>";
				echo "<p>\$weight is: " . $weight . "</p>";
			echo "</div>";
		*/

		$stmt = $mysqli->stmt_init();
		$query = "INSERT INTO $table
			(USER, DATE, WEIGHT)
			VALUES (?, ?, ?)
			ON DUPLICATE KEY UPDATE
			USER 		= VALUES(USER),
			DATE 		= VALUES(DATE),
			WEIGHT 	= VALUES(WEIGHT)
		";

		if ($stmt->prepare($query)) {
			$stmt -> bind_param("sss", $user, $date, $weight);
			// echo $query; // debug
			$stmt -> execute();

			if ($mysqli->errno) {
				echo "<div class=\"error\"><br />INSERT failed: (" . $mysqli->errno . ") " . $mysqli->error . "<br /><br /></div>";
			}
			else {
				// echo "Updated {$stmt->affected_rows} rows";
			}
		$stmt->close();
		} // if $stmt
	} // END if isset

?>
