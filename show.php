<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!--    bootstrap cdn-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <title>Employee Details</title>
</head>
<body>
<div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Employee Details
                            <a href="index.php" class="btn btn-info float-end">Back</a>
                        </h4>    
                    </div>
                    <div class="card-body">
                        <?php 
                          session_start();

                          ini_set('display_errors', 1);
                          ini_set('display_startup_errors', 1);
                          error_reporting(E_ALL);
                      
                          require 'config.php';
                            if(isset($_GET['id']) && !empty(trim($_GET['id']))){
                                $sql = "SELECT * FROM employees WHERE id = ?";
                                if(isset($mysqli)){
                                    if($stmt = $mysqli->prepare($sql)){
                                        $stmt->bind_param("i", $param_id);

                                        //set parameters
                                        $param_id = trim($_GET['id']);

                                        //Attempt to execute the prepared statement
                                        if($stmt->execute()){
                                            $result = $stmt->get_result();
                                            if($result->num_rows == 1){
                                                $row = $result->fetch_array(MYSQLI_ASSOC);

                                                // Retrieve individual field value
                                                $name = $row['name'];
                                                $email = $row['email'];
                                                $address = $row['address'];
                                                $phone = $row['phone'];
                                                $photo = $row['photo'];
                                                $id = $row['id'];
                                                ?>
                                <div class="mb-3">            
                                    <img src="photos/<?php echo $photo ?>" width="150px" height="150px"/>
                                </div>  

                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?php echo $name ?>" class="form-control" readonly>
                                </div>
                             

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="text" name="email" value="<?php echo $email ?>" class="form-control" readonly>
                                </div>
                               

                                <div class="mb-3">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="<?php echo $phone ?>" class="form-control" readonly>
                                </div>
                                

                                <div class="mb-3">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" readonly><?php echo $address ?>
                                    </textarea>
                                </div>
                            

                      
                                <?php
                                            }else{

                                            }
                                        }else {

                                        }
                                    }else{

                                    }  

                                }else{

                                }
                            }else {

                            }  

                                ?>
                                          
                        </div>
                                                
                                           
                    </div>
                </div>
            </div>
        </div>
</div>    

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>