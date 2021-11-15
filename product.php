<?php

session_start();
include 'navigation.php';

$con=connect();


$id=$_SESSION["id"];
if(!$id){
    header("location:login.php");
}
// echo $id;
$qq="SELECT * FROM users WHERE id='$id'";
$my=$con->query($qq);
$my1=mysqli_fetch_assoc($my);
$is=$my1["is_admin"];


if(isset($_POST['submit']))
{
    $pn=$_POST['proname'];
    $bou=$_POST['baught'];
    $img= $_FILES['pimage'];
    $imname=$img["name"];
    $location1=$img["tmp_name"];
    $arr= explode(".",$imname);
    $orname=strtolower($arr[0]);
    $otype=strtolower($arr[1]);
    $acctyp=['jpg','png','jepg'];
 
        $location="uploads/".$orname.'.'.$otype;

        $sqq="INSERT INTO products (name,bought,image, create_at) VALUES('$pn','$bou','$location',CURRENT_TIMESTAMP()  ) ";
        if($con->query($sqq)==true)
        {
            move_uploaded_file($location1,$location);
        }
        else{
            echo"not";
        }
        
    }


    
    

   //  print_r($_FILES);


    

















$date=date('y-m-d',strtotime("-7 days"));
 $sql="SELECT * FROM  products WHERE update_at>$date";
 $sqx="SELECT sum(bought) as bt FROM products; ";
 $sq="SELECT count(*) as c FROM products; ";
 $sqw="SELECT sum(sold) as st FROM products; ";
 $my=mysqli_fetch_assoc($con->query($sq))["c"];    
 $m1=mysqli_fetch_assoc($con->query($sqw))["st"];    
 $count=$con->query($sqx);

     $str=mysqli_fetch_assoc($count);
     $x=$str['bt'];


 

 $prod=$con->query($sql);
 $av=$x-$m1;


 
 closecon($con);
 
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
                        <div class="mod text-center" style="background: #000 ; color:#fff; padding:10px;">
                            <!-- ===========================================================================
                                         modal start
                              ============================================================================= -->
                            <button type="button" class="btn btn-primary cn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-bs-whatever="@mdo">add product</button>


                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header justify-content center modi">
                                            <h5 class="modal-title text-center"
                                                style="color:#000; text-align:center !important;"
                                                id="exampleModalLabel">add product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="product.php" enctype="multipart/form-data">
                                                <div class="mb-3 pd">
                                                    <label for="recipient-name" class="">product
                                                        name:</label>
                                                    <input type="text" name="proname" class="" id="recipient-name"
                                                        placeholder="product name" required>
                                                </div>
                                                <div class="mb-3 pd">
                                                    <label for="recipient-name" class="">product
                                                        baught </label>
                                                    <input type="text" name="baught" class="" style=""
                                                        id="recipient-name" placeholder="product baught" required>
                                                </div>
                                                <div class="f">
                                                    <label for="recipient-name" class="" style="color:black;">images
                                                    </label>
                                                    <input type="file" name="pimage">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary">Insert</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- ===========================================================================
                                         modal end
                              ============================================================================= -->


                        </div>
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
                                    <th data-field="note" data-sortable="true">action</th>
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
                                            echo "<td> <a href='view.php?id=". $row['id']." '> ". " <i class='fas fa-eye mrs' style='   color: white!important;
                                            margin-right: 4px !important;' ></i>    </a>";
                                            echo " <a href='edit.php?id=". $row['id']." '> ". " <i class='far fa-edit mrs ' style='   color: green !important;
                                            margin-right: 4px !important;'></i>    </a>";
                                            if($is!=0)
                                           { echo " <a href='delete.php?id=". $row['id']." '> ". " <i class='fas fa-trash-alt mrs' style='   color: red!important;
                                            margin-right: 4px !important;'></i>    </a>";
                                           }
                                            echo "</td>";
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