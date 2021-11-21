<?php

class single_tone{


    public function __construct()
    {
        
    }
    public static function instance(){
        return new single_tone();
    }


    public function my_sql_connect($dbhost,$user,$password,$dbname){
     $connect=new mysqli($dbhost,$user,$password,$dbname);
     return $connect;
    }
}


function connect(){

    $single_object=single_tone::instance();
   $connect= $single_object->my_sql_connect("localhost","root","root","inventory");
  
    return $connect;
    
}

function closecon($con){
$con->close();
}

?>