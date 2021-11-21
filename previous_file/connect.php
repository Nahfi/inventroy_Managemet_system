<?php




function connect(){

   $connect=new mysqli("localhost","root","root","inventory");
  
    return $connect;
    
}

function closecon($con){
$con->close();
}

?>