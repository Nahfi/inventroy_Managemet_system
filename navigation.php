<?php


if(!$_SESSION['id']){
     header("location:log.php");

}

$user_name=$_SESSION['name'];
$id=$_SESSION['id'];

include "auth/connect.php";
$con=connect();

$sq="UPDATE users SET last_log=CURRENT_TIMESTAMP() WHERE  id=$id";
           
$con->query($sq);
closecon($con);



?>



<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=10">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">


    <link rel="stylesheet" type="text/css" href="css/dash.css">
</head>

<body data-bs-spy="scroll" data-bs-target="#man" data-bs-offset="0">


    <section id="man">
        <nav class="navbar navbar-expand-lg  menu">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="p"><a href="logout.php"><span>Logged in as </span><b
                                    class="user"><?php echo $user_name; ?></b></a>
                        </li>
                        <li><a class="h" href="dashboard.php">MyInventory</a></li>
                        <li><a href="product.php">Products</a></li>
                        <li><a href="user.php">Users</a></li>
                        <li><a href="#">Customers</a></li>
                        <li class="p"><a href="logout.php"><button
                                    class="btn btn-danger navbar-btn pull-right btnx ">Logout</button></a></li>


                    </ul>
                    <?php echo $id; ?>
                </div>
            </div>
        </nav>
    </section>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>





</body>

</html>