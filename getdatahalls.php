<?php header('content-type:application/javascript; charset=utf-8');
    //$cour=$_GET['search'];
	include ('database.php'); 	
    
	
	$database=new databaseConnect(); // new object
	$database->connectToDatabase(); //connect
	$database->selectDatabase(); 
	$query='SELECT E.HallNo,E.Reserve_on,E.Time,E.LecturerFirstName AS PERSON FROM RESERVE_FOR_LECTURE_HALL_LECTURE E UNION ALL
				SELECT H.HallNo,H.Reserve_on,H.Time,H.StuRegiNum
				FROM RESERVE_FOR_LECTURE_HALL_STUDENT H';
	$result=mysql_query($query);
	while ($row= mysql_fetch_array($result,MYSQL_ASSOC)) {
		$rows[]=$row;
	}
	
	echo json_encode($rows);
	$database->closeConenction();

?>