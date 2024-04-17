<?php

header('Content-Type: application/json');

$datas=json_decode(file_get_contents("php://input"),true);

$name = $datas['sname'];
$age = $datas['sage'];
$city = $datas['scity'];
$email = $datas['semail'];
$phone = $datas['sphone'];
$pass = $datas['spass'];

include "confing.php";  


$sql = "INSERT INTO student_foam(student_name, student_age, city, student_email, student_phone, student_pass) VALUES ('$name','$age','$city','$email','$phone','$pass')";


$run = $conn->query($sql);
