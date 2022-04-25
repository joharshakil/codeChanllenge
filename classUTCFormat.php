<?php

//define version as global constant
 define("check_version","1.0.17+60");


//Class get values and save in db and change format
class UTCFormat {

	function __construct() {

    }
    
   // save in database
	public function saveDB($jsonval,$conn) {

		if($jsonval->version < constant('check_version')){

			$event_date  = $this->formatUTC($jsonval->event_date);

		}else{
			$event_date = $jsonval->event_date;
		}

		//Check User Already
		$get_record = "SELECT count(*) FROM event_booking WHERE  event_id = '$jsonval->event_id' AND employee_name = '$jsonval->employee_name'";
		$result = $conn->query($get_record);
			// output data of each row if not exist so insert in db
			while($row = $result->fetch_assoc()) {
				if($row['count(*)'] < 1){
					$sql_query = "INSERT INTO event_booking (employee_name, employee_mail, event_id,event_name,participation_fee,event_date,versions)
                   VALUES ('$jsonval->employee_name', '$jsonval->employee_mail', '$jsonval->event_id','$jsonval->event_name','$jsonval->participation_fee','$event_date','$jsonval->version')";

					if ($conn->query($sql_query) === TRUE) {
					} else {
						echo "Error creating table: " . $conn->error;
					}
				} 
			}	
			 
		} 	

//Convert date format 
	public function formatUTC($event_date) {
		$event_date  = date('Y-m-d H:i:s',strtotime($event_date." UTC"));
		return  $event_date ;
	}

}
