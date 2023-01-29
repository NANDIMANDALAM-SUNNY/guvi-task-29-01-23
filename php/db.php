<?php

// mysql server configuration
$user = "root";
$password="@Sunny170911";
$server="localhost";
$db="guvitask";

// mysql connection
$conn = mysqli_connect($server,$user,$password,$db);



if($conn){
   echo "Connection Successful";
}
else{
   echo "Connection Failure";
}

?>