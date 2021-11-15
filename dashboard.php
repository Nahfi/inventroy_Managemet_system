<?php

session_start();
include 'navigation.php';

$con=connect();
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
                                  if($prod==true)
                                  {
                                     if(mysqli_num_rows($prod)>0){

                                        while($row=mysqli_fetch_assoc($prod))
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