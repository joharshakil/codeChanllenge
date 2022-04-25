<?php
 require_once('dbscheme.php');

 $draw = $_POST['draw'];
 $row = $_POST['start'];
 $rowperpage = $_POST['length']; 
 $columnIndex = $_POST['order'][0]['column']; 
 $columnName = $_POST['columns'][$columnIndex]['data']; 
 $columnSortOrder = $_POST['order'][0]['dir']; 
 $searchValue = $_POST['search']['value']; 

//  Field value
$searchByEemployeeName = $_POST['searchByEmployeeName'];
$searchByEventName = $_POST['searchByEventName'];
$searchByDate = $_POST['searchByDate'];

// Search 
$searchQuery = " ";
if($searchByEemployeeName != ''){
   $searchQuery .= " and (employee_name like '%".$searchByEemployeeName."%' ) ";
}
if($searchByEventName != ''){
   $searchQuery .= " and (event_name like '%".$searchByEventName."%') ";
}

if($searchByDate != ''){
    $searchQuery .= " and (event_date like '%".$searchByDate."%') ";
 }


// records without filtering
$sel = ("select count(*) as allcount from event_booking");
$get_record = $conn->query($sel);
$records = mysqli_fetch_assoc($get_record);
$totalRecords = $records['allcount'];

//  records with filtering
$sel = ("select count(*) as allcount from event_booking WHERE 1 ".$searchQuery);
$get_record = $conn->query($sel);
$records = mysqli_fetch_assoc($get_record);
$totalRecordwithFilter = $records['allcount'];


// Fetch records
$empQuery = "select * from event_booking WHERE 1 ".$searchQuery." order by employee_name ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = $conn->query($empQuery);

$data = array();
$sum = 0;
while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array(
     "emp_name"=>$row['employee_name'],
     "email"=>$row['employee_mail'],
     "event_name"=>$row['event_name'],
     "event_fees"=>$row['participation_fee'],
     "event_date"=>$row['event_date']
   );

$sum += $row['participation_fee'];

}

// Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data,
  'sum' => $sum
);

echo json_encode($response);