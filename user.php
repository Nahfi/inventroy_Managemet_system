<?php

session_start();
$ji=$_SESSION["id"];
// echo $ji;
include 'navigation.php';

$con=connect();

$m="";
$sq="SELECT * FROM users WHERE id=$ji";
$fe=mysqli_num_rows($con->query($sq))>1?"yes":"no";
if($fe="yes"){
    $f1=mysqli_fetch_assoc($con->query($sq));
}
// $name-$_SESSION['name'];

if(isset($_POST['submit']))
{
 if($f1["password"]==$_POST['pass'])
{

 $sqlq="UPDATE users SET ";
    if(isset($_POST["uname"]))
    {

        // $m=$_POST["uname"];
      if($_POST["uname"]!=$f1["name"])
      {
        $nam=$_POST["uname"];
        $sqlq.="name='$nam',";
      }
    }
    if(isset($_POST["email"]))
    {

      if($_POST["email"]!=$f1["mail"])
      {
        $mail=$_POST["email"];
        $sqlq.="mail='$mail',";
      }
    }
    if(isset($_FILES['uavtr'])){


        $imna=$_FILES["uavtr"]["name"];
        $orlocat=$_FILES["uavtr"]["tmp_name"];
        $size=$_FILES["uavtr"]["size"];
        if($size<8000000){
            $all=['png','jpg','jepg','png'];
            $form=explode(".",$imna);
            $actualname=strtolower(  $form[0]);
            $actualformate=strtolower(  $form[1]);
            $loc="users/".$actualname.".".$actualformate;
            if(in_array($actualformate,$all)){
                $sqlq.="u_img='$loc',";
                move_uploaded_file($orlocat,$loc);
            }
        //  if($actualformate=="jpg" || $actualformate=="jpeg"){
        //      $immi=imagecreatefromjpeg($orlocat);
        //      $resize=imagescale($immi,200,300);
        //      imagejpeg( $resize,$loc,-1);
             
             
        //  }
        //  else if($actualformate=="png"){
        //     $immi=imagecreatefrompng( $orlocat);
        //     $resize=imagescale($immi,200,300);
        //     imagepng($resize,$loc,-1);
        //  }
        //  else if($actualformate=="gif"){
        //     $immi=imagecreatefromgif( $orlocat);
        //     $resize=imagescale($immi,200,300);
        //     imagegif( $resize,$loc,-1);
        //  }
   
        //  move_uploaded_file()
        }
        else{ 
            $m="image size shoud be lest than  8 mb";
        }
    }

    if(isset($_POST['npass']) && $_POST["npass"]!=" " && isset($_POST['cpass']) && $_POST["cpass"]!=" ")
    {
          if($_POST["npass"]==$_POST["cpass"])
          {
               $pa=$_POST["npass"];
               if($pa!=$f1["password"]){
                $sqlq.="password='$pa',";
               }
          }
    }
    $sqlq=substr($sqlq,0,-1);
    $sqlq.="WHERE id='$ji'  ";
    if($con->query($sqlq)==true){
        $m="updated";
    }
else{
    $m="not updated";
}
}
else{
    $m="not_matched";
}
    
}


//     $name=$_POST["name"];
//     $email=$_POST["email"];
//     $pass=$_POST["pass"];
//     $npass=$_POST["npass"];
//     $cpass=$_POST["npass"];
//     $avtr=$_FILES["uavtr"];
//    $avtrn=$avtr["name"];
//    $locat=$avtr["tmp_name"];
//    $aa=explode(".",$avtrn);
//    $orgname=strtolower($aa[0]);
//    $type=strtolower($aa[1]);
//    $avf=['jpg','jepg','png'];

//    $up="uploads/".$orgname.".".$type;
//    if($f1[""])

   
   
  



    
    

   //  print_r($_FILES);


    

















$date=date('y-m-d',strtotime("-7 days"));
 $sql="SELECT * FROM  users ";
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
    <link rel="stylesheet" href="css/user.css">
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
                                data-bs-target="#exampleModal" data-bs-whatever="@mdo">update info</button>


                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header justify-content center modi">
                                            <h5 class="modal-title text-center"
                                                style="color:#000; text-align:center !important;"
                                                id="exampleModalLabel">update info</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="user.php" enctype="multipart/form-data">
                                                <div class="form-group pt-20">
                                                    <div class="col-sm-4">
                                                        <label for="uname" class="pr-10"> User Name</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input name="uname" type="text" class="login-input"
                                                            placeholder="User Name" id="uname"
                                                            value="<?php echo $f1["name"] ;?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group pt-20">
                                                    <div class="col-sm-4">
                                                        <label for="email" class="mb-4"> Email </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input name="email" type="email" class="login-input"
                                                            placeholder="Email Address"
                                                            value="<?php echo $f1["mail"] ;?>" id="buy" required>
                                                    </div>
                                                </div>
                                                <div class="form-group pt-20">
                                                    <div class="col-sm-4">
                                                        <label for="uavtr" class="pr-10"> User Avatar</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="pl-20">
                                                            <input class="login-input" name="uavtr" type="file"
                                                                id="uavtr" alt="Upload Image">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group pt-20">
                                                    <div class="col-sm-4">
                                                        <label for="pass" class="pr-10"> Password</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input name="pass" class="login-input" type="password" id="pass"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group pt-20">
                                                    <div class="col-sm-4">
                                                        <label for="npass" class="pr-10">New Password</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input name="npass" class="login-input" type="text" id="npass">
                                                    </div>
                                                </div>
                                                <div class="form-group pt-20">
                                                    <div class="col-sm-4">
                                                        <label for="cpass" class="pr-10">Confirm New Password</label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input name="cpass" class="login-input" type="text" id="cpass">
                                                    </div>
                                                </div>
                                                <div class="form-group" style="text-align: center;">
                                                    <button type="submit" value="submit" name="submit"
                                                        class="btn btn-success">Change</button>
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
                            <h2 class="mb-4"> <?php
 echo $m;
 ?></h2>

                            <h3>products</h3>
                        </div>
                        <table class="table table-dark" id="table" data-toggle="table" data-search="true"
                            data-filter-control="true" data-show-export="true" data-click-to-select="true"
                            data-toolbar="#toolbar">

                            <thead class="thead-light">

                                <tr>

                                    <th data-field="date" data-filter-control="select" data-sortable="true">User Name
                                    </th>

                                    <th data-field="note" data-sortable="true">email</th>
                                    <!-- <th data-field="note" data-sortable="true">is_Active</th> -->
                                    <?php 
                                    if($f1["is_admin"]!=0){
                                        echo '<th data-field="note" data-sortable="true">is_Active</th>';
                                    }
                                    
                                    ?>
                                    <th data-field="note" data-sortable="true">last login time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  if($prod==true)
                                  {
                                     if(mysqli_num_rows($prod)>0){

                                        while($row=mysqli_fetch_assoc($prod))
                                        {    $a=$row['is_active']==1?'active':'inactive';
                                           
                                            echo "<tr>";
                                            
                                            echo "<td>".$row['name']."</td>";
                                            echo "<td>".$row['mail']."</td>";
                                            if($f1["is_admin"]!=0){
                                                $a=$row['is_active']==1?'active':'inactive';
                                            echo "<td>".$a."</td>";
                                            }
                                            echo "<td>".$row['last_log']."</td>";
                                           
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
                                <img src="<?php echo $f1['u_img'] ?>       " alt="uavtr"
                                    style="width:100px; height:100px; border-radius:50%;">

                            </div>
                            <div class="na">
                                <h4 class="text-center" style="color:#fff;font-size:18px"><?php echo $f1['name'] ?></h4>
                            </div>
                            <div class="na">
                                <h4 class="mt-2 text-center" style="color:#fff;font-size:16px">is working there
                                    since<?php echo $f1['create_at'] ?></h4>
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