<?php


$m=' ';
include "auth/connect.php";
$con=connect();
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $pass=$_POST['pass'];

   
    $sql="SELECT * FROM USERS WHERE  username='$name'";
    $row=mysqli_fetch_assoc($con->query($sql));
   if($row && password_verify($pass,$row['password']))
   {
 
           $arr=$row;
           $iie=$arr["id"];

           $sq="UPDATE users SET last_log=CURRENT_TIMESTAMP() WHERE  id=$iie";
           
           if($con->query($sq)==true)
           {
            session_start();
            $_SESSION["name"]=" ";
            $_SESSION["id"]=" ";
            $_SESSION["name"]=$arr["name"];
           $_SESSION["id"]=$arr["id"];
           header("location:dashboard.php");
           }
 
           
        
       
       else{
           $m="no user found";
       }
   }
   else{
    $m="not connected";
   }

}

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
if($m!=' ')
{
    echo $m;
}


?>
    <section id="log">

        <div class="container px-lg-0 mt-lg-5 pi">
            <div class="row justify-content-center  ">
                <div class="col-lg-6">


                    <div class="fm">
                        <div class="lo">
                            <h2><span>Log</span>In</h2>
                        </div>

                        <form action="login.php" method="post" enctype="mulipart/form-data">


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
                                <p> not a user <a href="register.php">Sign UP now</a></p>
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