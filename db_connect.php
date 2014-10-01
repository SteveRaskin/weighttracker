<?php

	error_reporting(E_ALL);
	ini_set('display_errors',1); // go figure: shows errors that error_reporting(E_ALL); doesn't

	//session_start(); // login failed w/out this here, even when it was in login_process.php


	$db_name = "weighttracker";

	$mysqli = new mysqli("localhost", "root", "", $db_name);

	if ($mysqli->connect_error) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	else {
		// can't echo anything; this becomes part of the responseText from the process page
		// echo "<div class=\"debug\"><p>db_connect.php: connected to MySQL, " . $mysqli->host_info . "</p></div>";
	}
?>

