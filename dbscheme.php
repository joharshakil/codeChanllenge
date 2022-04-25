<?php
 
 //set database credential
$servername = "localhost";
$username = "db";
$password = "Yg4BV6722GG55cqc";

//connection
$conn = new mysqli($servername, $username, $password);

//create db if not exist
$db_sql = "CREATE DATABASE IF NOT EXISTS codechallenge";
if ($conn->query($db_sql) === TRUE) {
$db_name = 'codechallenge';
}else{
  $db_name = 'codechallenge';
}

//set connection after create db
$conn = new mysqli($servername, $username, $password,$db_name);

//create table
		$sql = "CREATE TABLE IF NOT EXISTS event_booking  (
        participation_id INT(6)  UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        employee_name VARCHAR(20) NOT NULL,
        employee_mail VARCHAR(30) NOT NULL,
        event_id INT(5) NOT NULL,
        event_name VARCHAR(20) NOT NULL,
        participation_fee  DECIMAL(19,2)  NOT NULL,
        event_date  DATETIME,
        versions  VARCHAR(20) NOT NULL
        )";
		if ($conn->query($sql) === TRUE) {
		
//json data
			$getJSON = '[
          {
            "participation_id": "1",
            "employee_name": "Reto Fanzen",
            "employee_mail": "reto.fanzen@no-reply.rexx-systems.com",
            "event_id": 1,
            "event_name": "PHP 7 crash course",
            "participation_fee": "0",
            "event_date": "2019-09-04 08:00:00",
            "version": "1.0.17+42"
          },
          {
            "participation_id": "2",
            "employee_name": "Reto Fanzen",
            "employee_mail": "reto.fanzen@no-reply.rexx-systems.com",
            "event_id": 2,
            "event_name": "International PHP Conference",
            "participation_fee": "1485.99",
            "event_date": "2019-10-21 10:00:00",
            "version": "1.0.17+59"
          },
          {
            "participation_id": "3",
            "employee_name": "Leandro Bußmann",
            "employee_mail": "leandro.bussmann@no-reply.rexx-systems.com",
            "event_id": 2,
            "event_name": "International PHP Conference",
            "participation_fee": "657.50",
            "event_date": "2019-10-21 10:00:00",
            "version": "1.0.15+83"
          },
          {
            "participation_id": "4",
            "employee_name": "Hans Schäfer",
            "employee_mail": "hans.schaefer@no-reply.rexx-systems.com",
            "event_id": 1,
            "event_name": "PHP 7 crash course",
            "participation_fee": "0",
            "event_date": "2019-09-04 06:00:00",
            "version": "1.0.17+65"
          },
          {
            "participation_id": "5",
            "employee_name": "Mia Wyss",
            "employee_mail": "mia.wyss@no-reply.rexx-systems.com",
            "event_id": 1,
            "event_name": "PHP 7 crash course",
            "participation_fee": "0",
            "event_date": "2019-09-04 06:00:00",
            "version": "1.0.17+65"
          },
          {
            "participation_id": "6",
            "employee_name": "Mia Wyss",
            "employee_mail": "mia.wyss@no-reply.rexx-systems.com",
            "event_id": 2,
            "event_name": "International PHP Conference",
            "participation_fee": "657.50",
            "event_date": "2019-10-21 08:00:00",
            "version": "1.1.3"
          },
          {
            "participation_id": "7",
            "employee_name": "Reto Fanzen",
            "employee_mail": "reto.fanzen@no-reply.rexx-systems.com",
            "event_id": 3,
            "event_name": "code.talks",
            "participation_fee": "474.81",
            "event_date": "2019-10-24 08:00:00",
            "version": "1.0.17+59"
          },
          
          {
            "participation_id": "8",
            "employee_name": "Hans Schäfer",
            "employee_mail": "hans.schaefer@no-reply.rexx-systems.com",
            "event_id": 3,
            "event_name": "code.talks",
            "participation_fee": "534.31",
            "event_date": "2019-10-24 06:00:00",
            "version": "1.1.3"
          }
        ]';

      // Convert JSON string to Object
			$getJSON = json_decode($getJSON);

      //class for UTC Format and save into db
      require_once('classUTCFormat.php');
      $classUTC = new UTCFormat();
    
			foreach ($getJSON as $key => $jsonval) {

        $classUTC->saveDB($jsonval,$conn);
        
			}
		} else {
      echo "Error creating table: " . $conn->error;
    }

    if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


