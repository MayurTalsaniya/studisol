<?php session_start();
    $server="localhost";
    $user="root";
    $password="";
    $dbname="studisol";

    $con=mysqli_connect($server,$user,$password,$dbname);
    if(!$con)
    {
        echo "connection unsuccessfull";
    }
?>