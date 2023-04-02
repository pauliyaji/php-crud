<?php 
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!--    bootstrap cdn-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <title>PHP Simple CRUD</title>
</head>
<body>
    
<div class="container mt-4">
    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Employee Details 
                        <a href="create.php" class="btn btn-primary float-end">Add Employee</a>
                    </h4> 
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Photo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                require 'config.php';

                                $sql = "SELECT * FROM employees";
                                    

                                if(isset($mysqli)){
                                    if($result = $mysqli->query($sql)){
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_array()){ ?>
                                                <tr>
                                                        <td><?php echo $row['id'] ?></td>
                                                        <td><?php echo $row['name'] ?></td>
                                                        <td><?php echo $row['email'] ?></td>
                                                        <td><?php echo $row['phone'] ?></td>
                                                        <td><?php echo $row['address'] ?></td>
                                                        <td><img src="photos/<?php echo $row['photo'] ?>" width="50px" height="50px" ></td>
                                                       <td>
                                                            <a href="show.php?id=<?php echo$row['id'] ?>" class="btn btn-success btn-sm">Show</a>
                                                            <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-info btn-sm">Edit</a>
                                                            <form action="processor.php" method="post" class="d-inline">
                                                            <button type="submit" name="delete_employee" value="<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">
                                                            Delete </button> 
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    }
                                } 
                                else 
                                {
                                    echo "<h5> No Record Found </h5>";
                                }

                                ?>
                            </tbody>
                        </table>          
                   
                </div>
            </div>
        </div>
    </div>
</div>
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>