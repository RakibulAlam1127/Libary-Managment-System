<?php
//Our php code will be gose here.
 $id = $_GET['id'];
 $id = ((int) $id);
// var_dump($id);
// die();
  if ($id == 0){
      header('Location:register.php');
  }
$connection = mysqli_connect('localhost','root','','LMS');
if (isset($_POST['update'])){
    function validation ($data){
        $data = htmlentities($data);
        $data = htmlentities($data);
        $data = stripslashes($data);
        $data = trim($data);
        return $data;
    }
    if (empty($_POST['fname'])){
        $errors['fname'] = 'First Name is Required';
    }else{
        $fname = validation($_POST['fname']);
    }
    if (empty($_POST['lname'])){
        $errors['lname'] = 'Last Name is Required';
    }else{
        $lname = validation($_POST['lname']);
    }
    if (empty($_POST['email'])){
        $errors['email'] = 'Email Address is Required';
    }else{
        $email = validation($_POST['email']);

    }
    if (empty($errors)){
        $query = "UPDATE user SET fname = '$fname',lname = '$lname',email= '$email' WHERE id='$id'";
        $up_query = mysqli_query($connection,$query);
        if ($up_query == true){
//            $success = 'Profile Update Successfully';
            header('Location:view.php');
        }else{
            echo mysqli_error($connection);
            exit();
        }
    }
}
if ($connection == false){
    echo mysqli_connect_errno();
    exit();
}else{
    $sql = "SELECT fname,lname,email FROM user WHERE  id='$id'";
    $stmt = mysqli_query($connection,$sql);
    if ($stmt == false){
        echo mysqli_error($connection);
        exit();
    }else{
        if (mysqli_num_rows($stmt) === 0){
            header('Location:register.php');
        }
        $data = mysqli_fetch_assoc($stmt);
    }

 }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .container{
            margin-left: 330px;
        }
    </style>
</head>
<body>
<div class="container col-md-6" >
    <div class="panel panel-info">
        <div class="panel-heading">
            <img src="image/logo.png" alt="invalid image">
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $_GET['id']; ?>" method="post">
            <?php
            if (isset($success)){
                ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
                <?php
            }
            ?>
            <div class="panel-body">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" class="form-control" value="<?php echo $data['fname']; ?>" placeholder="First Name" autofocus>
                    <?php
                    if (isset($errors['fname'])){
                        ?>
                        <div class="alert alert-danger"><?php echo $errors['fname']; ?></div>
                        <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="lname">Lirst Name</label>
                    <input type="text" name="lname" class="form-control" value="<?php echo $data['lname']; ?>" placeholder="Lirst Name" autofocus>
                    <?php
                    if (isset($errors['lname'])){
                        ?>
                        <div class="alert alert-danger"><?php echo $errors['lname']; ?></div>
                        <?php
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="email">University E-Mail Address</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" placeholder="example@diu.edu.bd" autofocus>
                    <?php
                    if (isset($errors['email'])){
                        ?>
                        <div class="alert alert-danger"><?php echo $errors['email']; ?></div>
                        <?php
                    }
                    ?>
                </div>

                <div class="form-group">

                    <input type="submit" name="update" class="form-control btn btn-primary" value="Update" >
                </div>
            </div>
        </form>
        <div class="panel-footer">
            <p style="text-align: center">All Right Reverse &copy;  Daffodil Students</p>
        </div>
    </div>
</div>
</body>
</html>