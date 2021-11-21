<?php



include "auth/connect.php";


function applications_of_single_tone(){

$connection=connect();
if(isset($_POST['submit'])){




class singletone{
 


    public function __construct()
    {
        
    }
      

    public  static function  getinstance(){
    
      return   new singletone();

    }

    public function login($name,$password,$connection){
         
    $sql="SELECT * FROM USERS WHERE  username='$name'";
    $row=mysqli_fetch_assoc($connection->query($sql));
    $this->verify_users($row,$connection,$password);
  

}
public function verify_users($row,$connection,$password){
    
   if($row && password_verify($password,$row['password']))
   {
 
           $user_info=$row;
           $userid=$user_info["id"];

           $sql_1="UPDATE users SET last_log=CURRENT_TIMESTAMP() WHERE  id=$userid";
           
           if($connection->query($sql_1)==true)
           {
        
            session_start();
            $_SESSION["name"]=" ";
            $_SESSION["id"]=" ";
            $_SESSION["name"]=$user_info["name"];
           $_SESSION["id"]=$user_info["id"];
           header("location:dashboard.php");
           }
 
           
        
       
       else{
        echo"no user found";
       }
   }
   else{
    echo"not connected";
   }

}
        
    }


    $object=singletone::getinstance();
    $name=mysqli_real_escape_string($connection,$_POST["name"])   ;
    $object->login(,$_POST["pass"],$connection);

   }
   


}


applications_of_single_tone();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/login.css">

    <title>login</title>
</head>

<body>

    <?php



?>
    <section id="log">

        <div class="container px-lg-0 mt-lg-5 pi">
            <div class="row justify-content-center  ">
                <div class="col-lg-6">


                    <div class="fm">
                        <div class="lo">
                            <h2><span>Log</span>In</h2>
                        </div>

                        <form action="log.php" method="post" enctype="mulipart/form-data">


                            <div class="in">
                                <input name="name" id="name" type="text" placeholder="Enter Your Name" required>
                                <i class="fa-solid fa-user"></i>
                            </div>



                            <div class="pas">
                                <input name="pass" id="pass" type="password" placeholder="Enter Your Password" required>
                                <span class="eye" id="xx">
                                    <i id="y" class="fas fa-eye">

                                    </i>

                                    <i id="x" class="fas fa-eye-slash">

                                    </i>


                                </span>
                            </div>
                            <div class="bt">
                                <button type="submit" name="submit" class="btn btn-success" id="btt">login</button>
                            </div>
                            <div class="alex mt-lg-3">
                                <p> not a user <a href="registration.php">Sign UP now</a></p>
                            </div>
                            <div class="fg mt-lg-3">
                                <a href="#">forgot password</a>
                            </div>


                        </form>
                    </div>

                </div>
            </div>


        </div>


    </section>


    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>



    <script src="js/script.js"></script>
</body>

</html>