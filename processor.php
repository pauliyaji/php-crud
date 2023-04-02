<?php 
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require 'config.php';

    $name = $email = $phone = $address = $photo = '';
    $name_err = $email_err = $phone_err = $address_err = $photo_err = '';
    $validation_err = [];

    //Validating fields for both create and update
     //validate name
     $input_name = trim($_POST['name']);
     if(empty($input_name)){
         $name_err = "Please enter name.";
         array_push($validation_err, $name_err);
     } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP,
         array("options"=>array("regexp"=>"/^[a-zA-Z\s-]+$/")))){
             $name_err = "Please enter a valid name.";
             array_push($validation_err, $name_err);
     }else{
         $name = $input_name;
     }

       //validate email
       $input_email = trim($_POST['email']);
       if(empty($input_email)){
           $email_err = "Please enter email.";
           array_push($validation_err, $email_err);
       }else{
           $email = $input_email;
       }

     //validate address
     $input_address = trim($_POST['address']);
     if(empty($input_address)){
         $address_err = "Please enter address.";
         array_push($validation_err, $address_err);
     }else{
         $address = $input_address;
     }

     //validate phone
     $input_phone = trim($_POST['phone']);
     if(empty($input_phone)){
         $phone_err = "Please enter a phone.";
         array_push($validation_err, $phone_err);
     } else{
         $phone = $input_phone;
     }


    // Creating a new employee
    if(isset($_POST['save_employee']))
    {
               //validate photo
        $targetDir = "photos/";
        $filename = $_FILES['photo']['name'];
        $targetFilePath = $targetDir.$filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if(empty($filename)){
                $photo_err = "Please upload a photo.";
                array_push($validation_err, $photo_err);
            }elseif(!in_array($fileType, $allowedTypes)){
                //allow certain file formats

                $photo_err = "Wrong file format, please only JPG, JPEG, PNG or GIF are allowed. ";
                array_push($validation_err, $photo_err);
            }else{
                //store image in the server and add name to photo variable
                move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath);
                $photo = $filename;
            }

            if(empty($name_err) && empty($address_err) && empty($phone_err) & empty($email_err)
             && empty($photo_err))
             {
                 $sql = "INSERT INTO employees(name, email, phone, address, photo ) VALUES (?,?,?,?,?)";

                 if(isset($mysqli)){
                     if($stmt = $mysqli->prepare($sql)){
                         //Bind variables to the prepared statement
                         $stmt->bind_param("sssss", $param_name, $param_email, $param_phone, $param_address, $param_photo);
                        // Set Parameters
                        $param_name = $name;
                        $param_email = $email;
                        $param_phone = $phone;
                        $param_address = $address;
                        $param_photo = $photo;

                            if($stmt->execute()){
                                $_SESSION['message'] = "Employee Record Created Successfully";
                                header("location: index.php");
                                exit(0);
                            }else{
                                $_SESSION['message'] = "Oops! something went wrong. Employee Record not created";
                                header("location: create.php");
                                exit(0);
                            }

                        }else{
                            $_SESSION['message'] = "Please address the Errors";
                            header("location: create.php");
                            exit(0);
                        }
                     
                    }else{
                        $_SESSION['message'] = "Please check your Connection to the db";
                        header("location: create.php");
                        exit(0);
                 }
                } else
                    {
                        $_SESSION['message'] = implode("<br/>",$validation_err);
                        header("location: create.php");
                        //header("location: create.php?name=$name&email=$email&phone=$phone&address=$address");
                        exit(0);
                    }


    }
    // Updating an Employee Record
    elseif(isset($_POST['update_employee']))
   
    {
        $id = $_POST['id'];
        if(isset($_FILES['photo']) && !empty($_FILES['photo']['name'])){
            $targetDir = "photos/";
            $filename = $_FILES['photo']['name'];
            $targetFilePath = $targetDir.$filename;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
            if(empty($filename)){
                $photo_err = "Please upload a photo.";
                array_push($validation_err, $photo_err);
            }elseif(!in_array($fileType, $allowedTypes)){
                //allow certain file formats
                $photo_err = "Wrong file format, please only JPG, JPEG, PNG or GIF are allowed. ";
                array_push($validation_err, $photo_err);
            }else{
                //store image in the server and add name to photo variable
                move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath);
                $photo = $filename;
            }
    
        }else {
            $photo = $_POST['old_photo'];
        }

        if(empty($name_err) && empty($email_err) && empty($address_err) && empty($phone_err) && empty($photo_err)){
            $sql = "UPDATE employees SET name=?, email=?, address=?, phone=?, photo=? WHERE id=?";

            if(isset($mysqli)){
                if($stmt = $mysqli->prepare($sql)){
                    $stmt->bind_param("sssssi", $param_name, $param_email, $param_address, $param_phone, $param_photo, $param_id);
                    
                    $param_name = $name;
                    $param_email = $email;
                    $param_address = $address;
                    $param_phone = $phone;
                    $param_photo = $photo;
                    $param_id = $id;

                    if($stmt->execute()){
                        $_SESSION['message'] = "Employee Record successfully updated. ";
                        header("location: index.php");
                        exit(0);
                    }else{
                        $_SESSION['message'] = "Oops! something went wrong, try again later. ";
                        header("location: index.php");
                        exit(0);
                    }
                }else{
                    $_SESSION['message'] = "Oops! something went wrong, please check your sql query for update. ";
                    header("location: index.php");
                    exit(0); 
                }
            } else{
                $_SESSION['message'] = "Oops! something went wrong, please check your database connection. ";
                        header("location: index.php");
                        exit(0);
            }
        }else{
            $_SESSION['message'] = "Please resolve all empty fields";
            header('location: edit.php');
            exit(0);
        }

     }
     elseif(isset($_POST['delete_employee']))
    {
        $id = trim($_POST['delete_employee']);
        $sql = "DELETE FROM employees WHERE id=?";
        if(isset($mysqli)){
            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("i", $param_id);
                $param_id = $id;
                if($stmt->execute()){
                    $_SESSION['message'] = "Record successfully deleted";
                    header('location: index.php');
                    exit(0);
                }else{
                    $_SESSION['message'] = "Oops! something went wrong, please try again later. ";
                    header('location: index.php');
                    exit(0);
                }

            }else{
                $_SESSION['message'] = "Check your query!";
                header('location: index.php');
                exit(0);
            }
        } else{
            $_SESSION['message'] = "Check DB connection error. ";
            header('location: index.php');
            exit(0);
        }
    }





?>