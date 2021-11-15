<?php

function connect(){
    $dbhost="localhost";
    $user="root";
    $password="root";
    $dbname="inventory";
    $connect=new mysqli($dbhost,$user,$password,$dbname);
    return $connect;
    
}
function closecon($con){
$con->close();
}

?>