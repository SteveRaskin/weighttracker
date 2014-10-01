<?php

	//session_start();

	$db_name = "weighttracker";
	//$db_cnxn = new mysqli('localhost', 'root', '', $db_name); // Sequence matters & $db_name optional
	$db_cnxn = new mysqli("localhost", "root", "", $db_name); // Sequence matters & $db_name optional

	echo "<p>wtf: " . $db_cnxn->host_info . "</p>";

	$table = "WEIGH_IN_DATA"; // escape hyphenated table name using `backtick`



	if ($db_cnxn->connect_error) {
		die('Connect Error (' . $db_cnxn->connect_errno . ') ' . $db_cnxn->connect_error);
	}
	else {
		echo "<div class=\"debug\">Connected to MySQL</div>";
			echo 'Success... ' . $db_cnxn->host_info . "\n";
			$db_cnxn->close();
		/*
			https://stackoverflow.com/questions/25145574/create-mysql-table-if-it-doesnt-exist#comment39143265_25145574
			Fred-ii: (https://stackoverflow.com/users/1415724/fred-ii)
		*/


		$query = "SELECT * FROM " . $table;
		$result = mysqli_query($db_cnxn, $query);

		if(empty($result)) {
			echo "<p>" . $table . " table does not exist; creating one ...</p>";
			$query = mysqli_query($db_cnxn,"CREATE TABLE IF NOT EXISTS ". $table . " (
				id INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(id),
				USER		SMALLINT(4) UNSIGNED NOT NULL,
				DATE		DATE NOT NULL,
				WEIGHT	SMALLINT(4) UNSIGNED NOT NULL
			)");
		}
		else {
			// echo $table . " table exists";
		}
	} // outer else
?>
