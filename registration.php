<?php

include 'auth/connect.php';



function apply_proxy_pattern(){
    $connection=connect();
    if(isset($_POST['submit'])){

        interface create_users{

        public function user_registration($name,$username,$mail,$password,$match_password,$connection);
       }
   
                  
            class create_new_users implements create_users{

                public function match_password($password,$match_password){
                            if($password==$match_password){
                                return true;
                            }
                            else{
                                return false;
                            }
                }
                public function password_hashing($password){
                    return password_hash($password,PASSWORD_DEFAULT);
                }
                public function database_insertion($password,$name,$username,$mail,$connection){
                         
                        $sql="INSERT INTO users(name,username,mail,password)VALUES('$name','$username','$mail','$password')";
                        if($connection->query($sql)==true){
                            header("location:log.php");
                        }
                        else{
                       echo "no connection";
                        }
                }
            public function user_registration($name,$username,$mail,$password,$match_password,$connection){
              




                    if($this->match_password($password,$match_password)){

                        $password=$this->password_hashing($password);
                        $this->database_insertion($password,$name,$username,$mail,$connection);
                
        
                    }
                    else{
                    
                        echo"password doesnot match";
                    }
            }
       }

       class proxy_pattern {

        public $proxy_object;
     


       public function __construct()
       {
           $this->proxy_object=new create_new_users();


       }
       public function access_create_user($name,$username, $user_mail,$password,$match_password,$connection){


        
           $this->proxy_object->user_registration($name,$username, $user_mail,$password,$match_password,$connection);



       }
       }

       $objet_of_proxy_class=new proxy_pattern();
    $user_mail=$_POST['mail']?$_POST['mail']:"no mail";
       $objet_of_proxy_class->access_create_user($_POST['name'],$_POST['uname'], $user_mail,$_POST['pass'],$_POST['rpass'],$connection);
  
    }

   

    
}


apply_proxy_pattern();


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>register</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/register.css">

</head>

<body>

    <?php

?>

    <section id-"regi">
        <div class="container px-lg-0 mt-lg-4">
            <div class="row  justify-content-center mt-lg-4">
                <div class="col-lg-7 ">
                    <div class="frm">
                        <form action="registration.php" method="post">
                            <h1 class="mb-lg-4">Registration form</h1>
                            <div class="mb-lg-4">
                                <label>Your Name<span>*</span></label>
                                <input name="name" id="name" type="text" placeholder="Enter Your Name" required>
                            </div>


                            <div class="mb-lg-4">
                                <label>Your username<span>*</span></label>
                                <input name="uname" id="uname" type="text" placeholder="Enter Your username" required>
                            </div>
                            <div class="mb-lg-4">
                                <label>Your mail<span>*</span></label>
                                <input name="mail" id="mail" type="email" placeholder="Enter Your email">
                            </div>
                            <div class="mb-lg-4">
                                <label>Your password<span>*</span></label>
                                <input name="pass" id="pass" type="password" placeholder="Enter Your password" required>
                            </div>
                            <div class="mb-lg-4">
                                <label>confirm Your password<span>*</span></label>
                                <input name="rpass" id="rpass" type="password" placeholder="reEnter Your password"
                                    required>
                            </div>

                            <div class="trems text-center">
                                <p> <span>***</span> by creating an account you agree to our terms and condition</p>
                            </div>
                            <div class="sub">
                                <input type="submit" class="btn  btn-sucess" name="submit" value="submit">

                            </div>
                            <div class="trems text-center">
                                <p> <span>***</span> already have an account? <a href="login.php"> sign in</a></p>
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