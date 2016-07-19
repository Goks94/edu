<?php

$user_name = "u290199998_root";
$password = "mydatabase";
$database = "u290199998_db";
$server = "mysql.2freehosting.com";

    //Create Database connection

    $db = mysql_connect($server, $user_name, $password);

    if (!$db) {

        die('Could not connect to db: ' . mysql_error());

    }

  

    //Select the Database

    mysql_select_db($database,$db);

     

    //Replace * in the query with the column names.

    $result = mysql_query("select * from teacher", $db); 

     

    //Create an array

    $json_response = array();
	
	if(mysql_num_rows($result)){
	while($row=mysql_fetch_assoc($result)){
	$json_response['internals'][]=$row;
	}
	}

     

    /*while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

        $row_array['username'] = $row['username'];

        $row_array['EN501'] = $row['EN501'];

        $row_array['EN502'] = $row['EN502'];

        $row_array['EN503'] = $row['EN503'];

        $row_array['EN504'] = $row['EN504'];

        $row_array['EN505'] = $row['EN505'];
		
		$row_array['EN506'] = $row['EN506'];
		
		$row_array['EN507'] = $row['EN508'];
		

         

        //push the values in the array

        array_push($json_response,$row_array);

    }*/

    echo json_encode($json_response);

     

    //Close the database connection

    mysql_close($db);

  

?>
