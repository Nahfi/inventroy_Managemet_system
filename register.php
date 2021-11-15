<?php
$m=" ";
include 'auth/connect.php';
$conn=connect();

if(isset($_POST['submit'])){

    $name=$_POST['name'];
    $uname=$_POST['uname'];
    $mail=$_POST['mail']?$_POST['mail']:"no mail";
    $pass=$_POST['pass'];
    $rpass=$_POST['rpass'];
    if($pass===$rpass){
        $pass=password_hash($pass,PASSWORD_DEFAULT);
        $sql="INSERT INTO users(name,username,mail,password)VALUES('$name','$uname','$mail','$pass')";
        if($conn->query($sql)==true){
            header("location:login.php");
        }
        else{
            $m="no connection";
        }

    }
    else{
    
        $m="password doesnot match";
    }



}
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
if($m!=' ')
{
    echo $m;
}
?>

    <section id-"regi">
        <div class="container px-lg-0 mt-lg-4">
            <div class="row  justify-content-center mt-lg-4">
                <div class="col-lg-7 ">
                    <div class="frm">
                        <form action="register.php" method="post">
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