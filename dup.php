<?php

include"auth/connect.php";
$con=connect();
if(isset($_POST['username'])){
    $use=$_POST["username"];
  
    $ret['suc']=false;
 $sql="SELECT * FROM users WHERE username='$use'; ";
 
 if($con->query($sql)==true){
     if(mysqli_num_rows($con->query($sql))>0){
        $ret['suc']=true;
     }
   
 }
 echo json_encode($ret);
}

?>