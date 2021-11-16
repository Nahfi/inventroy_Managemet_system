<?php

session_start();
include 'navigation.php';



$connection=connect();
$userid=$_SESSION['id'];



class single_tone_apply{


    public function __construct()
    {
        
    }
    public static function instance(){
        return new single_tone_apply();
    }
    public function fetch_user_info($userid,$connection)
    {


     $sql="SELECT * FROM users WHERE id=$userid";
     return mysqli_fetch_assoc($connection->query($sql));

     
    }
    public function fetch_product_info($connection)
    {
        $sql="SELECT * FROM  products ";
        return ($connection->query($sql));
    }



    public function fetch_total_product($connection)
    {
   $sql="SELECT count(*) as c FROM products; ";
   return mysqli_fetch_assoc($connection->query($sql))['c'];
    }


    public function fetch_total_product_baught($connection)
    {

        $sql="SELECT sum(bought) as c FROM products; ";
       return mysqli_fetch_assoc($connection->query($sql))['c'];
    }

    
    public function fetch_total_product_sold($connection)
    {

 $sql="SELECT sum(sold) as c FROM products; ";
   return mysqli_fetch_assoc($connection->query($sql))['c'];
    }
}
 
$userinfo=single_tone_apply::instance()->fetch_user_info( $userid,$connection);
$productinfo=single_tone_apply::instance()->fetch_product_info($connection);
$total_product=single_tone_apply::instance()->fetch_total_product($connection);
$total_product_bought=single_tone_apply::instance()->fetch_total_product_baught($connection);
$total_product_sold=single_tone_apply::instance()->fetch_total_product_sold($connection);





 
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>

</head>

<body>



    <section id="dash">




        <div class="leftc">

            <div class="cont">`
                <div class="row">
                    <div class="col-lg-3  col-sm-12 col-12">
                        <div class="card1">
                            <p>total product</p>
                            <h4 class="counter"><?php echo $total_product ; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 col-12">
                        <div class="card1 t2">
                            <p>products Baught</p>
                            <h4 class="counter"><?php echo $total_product_bought ; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-3   col-sm-12 col-12">
                        <div class="card1 t1">
                            <p>product sold</p>
                            <h4 class="counter"><?php echo $total_product_sold ; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-3   col-sm-12 col-12">
                        <div class="card1  t3">
                            <p> availavble stock</p>
                            <h4 class="counter"><?php echo $total_product_bought- $total_product_sold ; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cont co">
                <div class="row  mt-lg-5 co">
                    <div class="col-lg-12  co">
                        <div class="tex text-center " style="background: #000 ; color:#fff; padding:10px;">
                            <h3>products</h3>
                        </div>
                        <table class="table table-dark" id="table" data-toggle="table" data-search="true"
                            data-filter-control="true" data-show-export="true" data-click-to-select="true"
                            data-toolbar="#toolbar">

                            <thead class="thead-light">

                                <tr>

                                    <th data-field="date" data-filter-control="select" data-sortable="true">Product Name
                                    </th>
                                    <th data-field="examen" data-filter-control="select" data-sortable="true"> Bought
                                    </th>
                                    <th data-field="note" data-sortable="true">Sold</th>
                                    <th data-field="note" data-sortable="true">Available in Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  if($productinfo==true)
                                  {
                                     if(mysqli_num_rows($productinfo)>0){

                                        while($row=mysqli_fetch_assoc($productinfo))
                                        {
                                            $stk=$row["bought"]-$row["sold"];
                                            echo "<tr>";
                                            
                                            echo "<td>".$row['name']."</td>";
                                            echo "<td>".$row['bought']."</td>";
                                            echo "<td>".$row['sold']."</td>";
                                            echo "<td>".$stk."</td>";
                                            echo "</tr>";
                                            

                                        }
                                         
                                     }
                                  }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightc ">
            <div class="conti">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ab2">
                            <h3 class="text-center">About User</h3>
                            <div class="im">
                                <img src="<?php echo $userinfo['u_img'] ?>       " alt="uavtr"
                                    style="width:100px; height:100px; border-radius:50%;">

                            </div>
                            <div class="na">
                                <h4 class="text-center" style="color:#fff;font-size:18px">
                                    <?php echo $userinfo['name'] ?></h4>
                            </div>
                            <div class="na">
                                <h4 class="mt-2 text-center" style="color:#fff;font-size:16px">is working there
                                    since<?php echo $userinfo['create_at'] ?></h4>
                            </div>
                            <p class="mt-4"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="conti">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ab1">
                            <h3>owner text</h3>

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