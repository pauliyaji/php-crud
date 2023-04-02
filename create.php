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

    <title>Document</title>

</head>
<body>

<div class="container mt-5">
<?php include('message.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Employee
                        <a href="index.php" class="btn btn-info float-end">Back</a>
                    </h4>    
                </div>
                <div class="card-body">
                    <form action="processor.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control <?php echo(!empty($name_err)) ?
                                        'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $name_err;?></span>
                                </div>
                                <br />

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="<?php echo $email ?>" class="form-control <?php echo(!empty($email_err)) ?
                                        'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $email_err;?></span>
                                </div>
                                <br />

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="<?php echo $phone ?>" class="form-control <?php echo(!empty($phone_err)) ?
                                        'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $phone_err;?></span>
                                </div>
                                <br />

                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address"  class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>">
                                 <?php echo $address ?>
                                    </textarea><span class="invalid-feedback"><?php echo $address_err;?></span>
                                </div>
                                <br />

                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" name="photo" class="form-control" <?php echo(!empty($photo_err)) ? 'is-invalid' : ''; ?>">
                                    <span class="invalid-feedback"><?php echo $photo_err; ?></span>
                                </div>    
                                <br />
                                <input type="submit" name="save_employee" class="btn btn-primary" value="Submit">
                                <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>