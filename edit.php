<?php

session_start();
include 'navigation.php';

$con=connect();
$userid=$_SESSION['id'];
$user_connection=[$con,$userid];


class single_tone_for_product_info_edit{


    public function __construct()
    {
        
    }
    public static function single_instance(){
        return new single_tone_for_product_info_edit ();
    }
    public function check_sql_connection($sql,$user_connection){
        return $user_connection[0]->query($sql);
    }
    public function fetch_single_product_info($product_id,$user_connection){
       $sql="SELECT * FROM  products WHERE id='$product_id' ";
     
    if($this->check_sql_connection($sql,$user_connection)==true){
       return mysqli_fetch_assoc($user_connection[0]->query($sql));
      
     }
    }
    public function update_product_info($update_product_id,$name,$bought_product,$sold_product,$user_connection)
    {
        if($sold_product>$bought_product){
            header("location:edit.php?id=$update_product_id");
        }
        else{
            $sql="UPDATE products SET name='$name',bought='$bought_product',sold='$sold_product' WHERE id='$update_product_id'  ";
            if($this->check_sql_connection($sql,$user_connection)==true){
             
                header("location:product.php");
              }
              else{
                  echo "fail";
              }
        }
    }
}

$single_instance= single_tone_for_product_info_edit::single_instance();

if(isset($_GET['id'])){
    $product_id=$_GET['id'];
   $product_info=$single_instance->fetch_single_product_info($product_id,$user_connection);
}

else if(isset($_POST['id']))
{

    $update_product_id=$_POST["id"];
    $name=$_POST["name"];
    $bought_product=(int)$_POST["boughti"];
    $sold_product=(int)$_POST["sold"];
    $single_instance->update_product_info($update_product_id,$name,$bought_product,$sold_product,$user_connection);
}






        interface information{
            public function fetch_information($connection);
        }

        class user_info implements information{
    
             public function fetch_information($user_connection){
                $userid=$user_connection[1];
              $sql="SELECT * FROM users WHERE id=$userid";
              return mysqli_fetch_assoc($user_connection[0]->query($sql));

            }
        }


        class count_total_product implements information{
    
             public function fetch_information($user_connection){
                $sql="SELECT count(*) as c FROM products; ";
                return mysqli_fetch_assoc($user_connection[0]->query($sql))['c'];

            }
        }

        
        class total_baught  implements information{
    
             public function fetch_information($user_connection){
              
        $sql="SELECT sum(bought) as c FROM products; ";
        return mysqli_fetch_assoc($user_connection[0]->query($sql))['c'];

            }
        }
        class total_sold  implements information{
    
             public function fetch_information($user_connection){
              
        $sql="SELECT sum(bought) as c FROM products; ";
        return mysqli_fetch_assoc($user_connection[0]->query($sql))['c'];

            }
        }


        class facade{
            public information $user_info;
            public information $count_product_total;
            public information $count_product_baught;
            public information $count_product_sold;
            public function __construct()
            {
                $this->user_info= new user_info();
                $this->count_product_total= new count_total_product();
                $this->count_product_baught= new total_baught();
                $this->count_product_sold= new total_sold();
            }
            public function users_data($user_connection){
                return $this->user_info->fetch_information($user_connection);
            }
            public function count_product($user_connection){
                return $this->count_product_total->fetch_information($user_connection);
            }
            public function  product_baught($user_connection){
                return $this->count_product_baught->fetch_information($user_connection);
            }
            
            public function  product_sold($user_connection){
                return $this->count_product_sold->fetch_information($user_connection);
            }
            
        }
    

        $facade=new facade();
        $userinfo= $facade->users_data($user_connection);
        $total_product= $facade->count_product($user_connection);
        $total_baught= $facade->product_baught($user_connection);
        $total_sold= $facade->product_sold($user_connection);
    
    


 
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
                            <h4 class="counter"><?php echo $total_product; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 col-12">
                        <div class="card1 t2">
                            <p>products Baught</p>
                            <h4 class="counter"><?php echo $total_baught ; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-3   col-sm-12 col-12">
                        <div class="card1 t1">
                            <p>product sold</p>
                            <h4 class="counter"><?php echo $total_sold ; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-3   col-sm-12 col-12">
                        <div class="card1  t3">
                            <p> availavble stock</p>
                            <h4 class="counter"><?php echo $total_baught-$total_sold ; ?></h4>
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
                                    <img src="<?php echo $product_info["image"];?>" class="img-fluid "
                                        alt="product_images">
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
                                                            value="<?php echo $product_info["name"];?>">
                                                    </div>
                                                    <div class="val">
                                                        <input type="text" name="boughti"
                                                            value="<?php echo $product_info["bought"];?>">
                                                    </div>
                                                    <div class="val">
                                                        <input type="text" name="sold"
                                                            value="<?php echo $product_info["sold"];?>">
                                                    </div>
                                                    <div class="val">
                                                        <input type="hidden" name="id"
                                                            value="<?php echo $product_info["id"];?>">
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