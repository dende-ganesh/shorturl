<?php
  $domain = "localhost:8080/";
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "url";

    $conn = mysqli_connect($host, $user, $pass, $db);
    if(!$conn){
        echo "Database connection error".mysqli_connect_error();
    }
?>
