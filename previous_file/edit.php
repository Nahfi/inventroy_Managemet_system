<?php

session_start();
include 'navigation.php';

$con=connect();

if(isset($_GET['id'])){
    $idd=$_GET['id'];
    $quer="SELECT * FROM  products WHERE id='$idd' ";
    if($con->query($quer)==true){
        $ti=mysqli_fetch_assoc($con->query($quer));
      
    }
}else if(isset($_POST['id']))
{

    $ii=$_POST["id"];
    $naa=$_POST["name"];
    $boo=(int)$_POST["boughti"];
    $soo=(int)$_POST["sold"];
    if($soo>$boo)
    {
        header("location:edit.php?id=$ii ");
    }
    else{
        if(isset($_POST["submit"])){
          
            $sqii="UPDATE products SET name='$naa',bought='$boo',sold='$soo' WHERE id='$ii'  ";
            if($con->query($sqii)==true){
                header("location:product.php");
            }
            else{
                echo "fail";
            }
        }
}
}

$date=date('y-m-d',strtotime("-7 days"));
 $sql="SELECT * FROM  products WHERE update_at>$date";
 $sqx="SELECT sum(bought) as bt FROM products; ";
 $sq="SELECT count(*) as c FROM products; ";
 $sqw="SELECT sum(sold) as st FROM products; ";
 $my=mysqli_fetch_assoc($con->query($sq))["c"];    
 $m1=mysqli_fetch_assoc($con->query($sqw))["st"];    
 $count=$con->query($sqx);
 if($count==true  ){
     $str=mysqli_fetch_assoc($count);
     $x=$str['bt'];

 }

 $prod=$con->query($sql);
 $av=$x-$m1;


 
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="css/edit.css">
</head>

<body>



    <section id="dash">




        <div class="leftc">

            <div class="cont">`
                <div class="row">
                    <div class="col-lg-3  col-sm-12 col-12">
                        <div class="card1">
                            <p>total product</p>
                            <h4 class="counter"><?php echo $my ; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 col-12">
                        <div class="card1 t2">
                            <p>products Baught</p>
                            <h4 class="counter"><?php echo $x ; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-3   col-sm-12 col-12">
                        <div class="card1 t1">
                            <p>product sold</p>
                            <h4 class="counter"><?php echo $m1 ; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-3   col-sm-12 col-12">
                        <div class="card1  t3">
                            <p> availavble stock</p>
                            <h4 class="counter"><?php echo $av ; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cont co">
                <div class="row  mt-lg-5 co">
                    <div class="col-lg-12  co">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tex text-center " style="background: #000 ; color:#fff; padding:10px;">
                                    <h3>products details</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row  bgc">
                            <div class="col-lg-6">

                                <div class="imin text-center mt-lg-5 mb-lg-5">
                                    <img src="<?php echo $ti["image"];?>" class="img-fluid " alt="product_images">
                                </div>

                            </div>
                            <div class="col-lg-6 justify-content-center">
                                <div class="pq mt-lg-5 mb-lg-5 text-center justify-content-center">




                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="alexx text-end">
                                                <div class="one">
                                                    <h4 class="">name: </h4>
                                                </div>
                                                <div class="one">
                                                    <h4 class="">buy_quantity: </h4>
                                                </div>
                                                <div class="one">
                                                    <h4 class="">Sell_Quantity: </h4>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-lg-5">

                                            <div class="poi text-start">

                                                <form action="edit.php" method="post" enctype="multipart/form-datas">
                                                    <div class="val">
                                                        <input type="text" name="name"
                                                            value="<?php echo $ti["name"];?>">
                                                    </div>
                                                    <div class="val">
                                                        <input type="text" name="boughti"
                                                            value="<?php echo $ti["bought"];?>">
                                                    </div>
                                                    <div class="val">
                                                        <input type="text" name="sold"
                                                            value="<?php echo $ti["sold"];?>">
                                                    </div>
                                                    <div class="val">
                                                        <input type="hidden" name="id" value="<?php echo $ti["id"];?>">
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6 justify-content-center text-center">
                                            <div class="btt  mt-lg-4">
                                                <button type="submit" name="submit"
                                                    class="btn btn-warning">Update</button>


                                            </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="rightc ">
            <div class="conti">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ab2">
                            <h3>About us</h3>
                            <div class="im">
                                <img src="" alt="">
                                <p>
                                    img
                                </p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, saepe?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="conti">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ab1">
                            <h3>owner info</h3>

                            <p>some text</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <footer id="foot">
        <h3>All rights reserved @<a href="https://www.facebook.com/0nafiz/">nafiz khan</a></h3>
    </footer>



    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>




</body>

</html>