

<?php

include ('database.php'); 	
    $jsonAsData =$_POST["dataset"];
	$ARRAY = json_decode($jsonAsData,TRUE);
	$database=new databaseConnect(); // new object
	$database->connectToDatabase(); //connect
	$database->selectDatabase(); 
	$database->insertData($ARRAY[0],$ARRAY[1],$ARRAY[2],$ARRAY[3],$ARRAY[4],$ARRAY[5],$ARRAY[6],$ARRAY[7],$ARRAY[8],$ARRAY[9],
	$ARRAY[10],$ARRAY[11],$ARRAY[12],FALSE,$ARRAY[14],$ARRAY[15],FALSE,FALSE,$ARRAY[18],$ARRAY[19],$ARRAY[20],$ARRAY[21],$ARRAY[22]
	,$ARRAY[23],$ARRAY[24],$ARRAY[25],$ARRAY[26],$ARRAY[27],$ARRAY[28],$ARRAY[29],$ARRAY[30]);//set database
	$database->closeConenction();
?>