<?php

class databaseConnect{

	//Database connection parameters  
	private $host=getenv('OPENSHIFT_MYSQL_DB_HOST');
	private $user=getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	private $password=getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	private $database="smartenergy";
	private $connection;
	
	
	
	
	//connect to database 
	function connectToDatabase(){
		$this->connection=mysql_connect($this->host,$this->user,$this->password);
		
		if(!$this->connection){
			//die("Database Connection failed.<br>");
		}
		
		else{
			//echo "Connection successful<br>";
		}
	}
		
	//select the database
	function selectDatabase(){
		mysql_select_db($this->database);
		
		if(mysql_error()){
			//Die("Database ".$this->database."Not found<br>");
		}
		
		else{
			//echo "Database ".$this->database." selected<br>";
		}
	}
	
	//insert data into database
	function insertData($selectTag,$isSemi,$isHall,$isVehi,
				$Fname,$Lname,$Email,$Department,$Telephone,$RegNo,$Association,
				$SemRoomNo,$Capacity,$Availability,$HallNo,$Capacityhalls,$Projectors,$Availabilityhalls,$VehiRegNo,$CapacityVehi,$Type,$AvailabilityVehi
				,$Reserve_onSemi,$TimeSemi,$DurationSemi,$Reserve_onHall,$TimeHall,$DurationHall,$Reserve_onVehi,$TimeVehi){
		if (!$this->connection){
			//echo "connection fail<br>";
		}
		else {
			if($selectTag==1){
			$attributes= " (Fname,Lname,Email,Department) ";
			$values="VALUES ('".$Fname."','".$Lname."','".$Email."','".$Department."')";
			$statement="INSERT INTO LECTURER".$attributes.$values;
				
		   }else{
		  	//$attributes= " (Fname,Lname,Email,RegNo,Association,Telephone) ";
			//$values="VALUES ('".$Fname."','".$Lname."','".$Email."','".$RegNo."','".$Association."','".$Telephone."')";
			$attributes= " (StuRegiNum,Email,Association,Telephone) ";
			$values="VALUES ('".$RegNo."','".$Email."','".$Association."','".$Telephone."')";
			$statement="INSERT INTO STUDENT".$attributes.$values;
		   }
		    mysql_query($statement);
			if($isSemi==1){
				if($selectTag==1){
					$attributesSEMI= " (SemRoomNumber,Reserve_on,Time,LecturerFirstName,LecturerLastName) ";
					$valuesSEMI="VALUES ('".$SemRoomNo."','".$Reserve_onSemi."','".$TimeSemi."','".$Fname."','".$Lname."')";
					$statementSEMI="INSERT INTO RESERVE_FOR_SEMINAR_ROOM_LECTURE".$attributesSEMI.$valuesSEMI;
					mysql_query($statementSEMI);
				}else{
					$attributesSEMI= " (SemRoomNumber,Reserve_on,Time,StuRegiNum) ";
					$valuesSEMI="VALUES ('".$SemRoomNo."','".$Reserve_onSemi."','".$TimeSemi."','".$RegNo."')";
					$statementSEMI="INSERT INTO RESERVE_FOR_SEMINAR_ROOM_STUDENT".$attributesSEMI.$valuesSEMI;
					mysql_query($statementSEMI);
				}
			}
			if($isHall==1){
				if($selectTag==1){
					$attributesHalls= " (HallNo,Reserve_on,Time,LecturerFirstName,LecturerLastName) ";
					$valuesHalls="VALUES ('".$HallNo."','".$Reserve_onHall."','".$TimeHall."','".$Fname."','".$Lname."')";
					$statementHalls="INSERT INTO RESERVE_FOR_LECTURE_HALL_LECTURE".$attributesHalls.$valuesHalls;
					mysql_query($statementHalls);
				}else{
					$attributesHalls= " (HallNo,Reserve_on,Time,StuRegiNum) ";
					$valuesHalls="VALUES ('".$HallNo."','".$Reserve_onHall."','".$TimeHall."','".$RegNo."')";
					$statementHalls="INSERT INTO RESERVE_FOR_LECTURE_HALL_STUDENT".$attributesHalls.$valuesHalls;
					mysql_query($statementHalls);
				}
			
			} 
			if($isVehi==1){
				if($selectTag==1){
					$attributesVehi= " (VehiRegNumber,Reserve_on,Time,LecturerFirstName,LecturerLastName) ";
					$valuesVehi="VALUES ('".$VehiRegNo."','".$Reserve_onVehi."','".$TimeVehi."','".$Fname."','".$Lname."')";
					$statementVehi="INSERT INTO RESERVE_FOR_VEHICLE_LECTURE".$attributesVehi.$valuesVehi;
					mysql_query($statementVehi);
				}else{
					$attributesVehi= " (VehiRegNumber,Reserve_on,Time,StuRegiNum) ";
					$valuesVehi="VALUES ('".$VehiRegNo."','".$Reserve_onVehi."','".$TimeVehi."','".$RegNo."')";
					$statementVehi="INSERT INTO RESERVE_FOR_VEHICLE_STUDENT".$attributesVehi.$valuesVehi;
					mysql_query($statementVehi);
				}
			
			}
			if(mysql_error()){
				Die("Insetion failed<br>");
			}
			else{
				echo "Insetion Successful<br>";
			}
		  
		  }
	}	
	
		
	//delete a data from database
	function deleteData($id){

		if (!$this->connection){
			echo "Connection fail<br>";
		}
		
		else {
			
			
			$statement="DELETE FROM orders  WHERE orderNo =".$id;
			mysql_query($statement);
			
			if(mysql_error()){
				Die("Deleting failed<br>");
			}
			else{
				echo "Successfully deleted data <br>";
			}	
		}
	}


	//close the connection
	function closeConenction(){
		mysql_close($this->connection);
		//echo "Connection closed\n";
	}
	
}

?>	
		
