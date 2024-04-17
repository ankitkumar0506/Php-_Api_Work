<?php

header('Content-Type: application/json');


include "confing.php";

$sql = "SELECT * FROM student_foam";
$result = mysqli_query($conn, $sql) ;

if(mysqli_num_rows($result) > 0 ){
	
	$output = mysqli_fetch_all($result, MYSQLI_ASSOC);
	echo json_encode($output);

}else{

 echo json_encode(array('message' => 'No Record Found.', 'status' => false));

}


?>