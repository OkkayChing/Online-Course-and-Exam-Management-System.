<?php

class Database {

	// Function to the database and tables and fill them with the default data
	function check_database($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Close the connection
		$mysqli->close();

		return true;
	}

	// Function to the database and tables and fill them with the default data
	function create_database($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],'');

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Create the prepared statement
		$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['database']. " CHARACTER SET utf8 COLLATE utf8_general_ci");

		// Close the connection
		$mysqli->close();

		return true;
	}

	// Function to create the tables and fill them with the default data
	function create_tables($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Open the default SQL file
		$query = file_get_contents('assets/install.sql');
                
		// Execute a multi query
		$mysqli->multi_query($query);
                
        while($mysqli->more_results() && $mysqli->next_result()) {
            $extraResult = $mysqli->use_result();
            if($extraResult instanceof mysqli_result){
                $extraResult->free();
            }
        }
        if ($mysqli->error)
			return false;
                
		// Close the connection
		$mysqli->close();

		return true;
	}
}