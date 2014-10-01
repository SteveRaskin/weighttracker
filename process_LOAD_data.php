<?php

	header("content-type: application/json");
	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	require_once("db_connect.php");

	$table = "`WEIGH_IN_DATA`"; // *** hyphen must be escaped; use 'backtick' (tilde key, not apostrophe/single quote) ***

	if ($mysqli) {

		$user = $_GET['selUser'];
		$limit = preg_replace('#[^0-9]#', '', $_GET['limit']);

		$i = 0;
		$jsonData = '{"WEIGH-INS": [';

			$stmt = $mysqli->stmt_init();
			// sure, we can filter by db query, but the excercise is to filter in the js once the data is returned ... OR IS IT?!?!
			// $query = "SELECT * FROM $table WHERE USER = '$user' LIMIT $limit"; // limited to first $limit # of IDs
			// $query = "SELECT * FROM $table"; // unlimited
			$query = "SELECT * FROM $table WHERE USER = '$user'";
			$result = $mysqli->query($query) or die("Error in the query (?)" . mysqli_error($mysqli));

			while($row = mysqli_fetch_array($result)) {
				$i++;
				$id = $row["id"];
				$user = $row["USER"];
				$date = $row["DATE"];
				$weight = $row["WEIGHT"];

				$jsonData .= '{"id": "'.$id.'", "user": "'.$user.'", "date": "'.$date.'", "weight": "'.$weight.'" },';
			}

			$jsonData = chop($jsonData, ","); // kill the trailing comma
			$jsonData .=']}';
			// json_encode($jsonData); // this seems to have no affect on jsonData, as it's returned to JSON_07_ajaxPostJsonPhp_mysql.php
			echo $jsonData;
	} // if

?>
