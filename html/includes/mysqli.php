<?php
	const DB_HOST = 'localhost';
	const DB_USER = 'pthorsten';
	const DB_PASSWORD = 'SubsidingPampers';
	const DB_NAME = 'forum';	
	try {
		$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	}
	catch(mysqli_sql_exception $e) {
		die("<p style=\"color: red;\">Could not connect to MySQL:<br>" . mysqli_connect_error() . "</p>");
	}
?>
