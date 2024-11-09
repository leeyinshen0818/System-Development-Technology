<?php

$servername = "localhost" ;
$username = "root";
$password = "" ;
$dbname = "student_info";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Failed Connection: ". mysqli_connect_error());
}

?>