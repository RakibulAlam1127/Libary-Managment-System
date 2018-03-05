<?php
 //Our php code will be gose here.
$errors = [];
$fname = $lnmae = $email = $password = '';
if (isset($_POST['submit'])){
    function validation($data){
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }
    if (empty($_POST['fname'])){
        $errors['fname'] = 'First Name Field Is Required';
    }else{
        $fname = validation($_POST['fname']);
    }
    if (empty($_POST['lname'])){
        $errors['lname'] = 'Last Name Field Is Required';
    }else{
        $lname = validation($_POST['lname']);
    }
    if (empty($_POST['email'])){
        $errors['email'] = 'Email Field Is Required';
    }else{
        $email = validation($_POST['email']);
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email Must Be Valid';
        }
    }
    if (empty($_POST['password'])){
        $errors['password'] = 'Password Field Is Required';
    }else{
        $password = validation($_POST['password']);
        if (strlen($password) < 7){
            $errors['password'] = 'Password must be 8 Character';
        }else{
            $password = password_hash($password,PASSWORD_BCRYPT);
        }
//        var_dump($fname,$lname,$email,$password);
//        die();
    }
    if (empty($errors)){
        //Our database connection will be gose here.
          $connection = mysqli_connect('localhost','root','','LMS');
          if ($connection == false){
              echo mysqli_connect_errno();
              exit();
          }else{
              $sql = "INSERT INTO user(fname,lname,email,password)VALUES ('$fname','$lname','$email','$password')";
              $stmt = mysqli_query($connection,$sql);
               if ($stmt === true){
                  // $success = 'Your Registration is Successfull';
                   header('Location:login.php');
               }else{
                   echo mysqli_error($connection);
                   exit();
               }
          }
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
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
                         <input type="text" name="fname" class="form-control" placeholder="First Name" autofocus>
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
                         <input type="text" name="lname" class="form-control" placeholder="Lirst Name" autofocus>
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
                         <input type="email" name="email" class="form-control" placeholder="example@diu.edu.bd" autofocus>
                         <?php
                         if (isset($errors['email'])){
                             ?>
                             <div class="alert alert-danger"><?php echo $errors['email']; ?></div>
                             <?php
                         }
                         ?>
                     </div>
                     <div class="form-group">
                         <label for="password">Password</label>
                         <input type="password" name="password" class="form-control" placeholder="Password" autofocus>
                         <?php
                         if (isset($errors['password'])){
                             ?>
                             <div class="alert alert-danger"><?php echo $errors['password']; ?></div>
                             <?php
                         }
                         ?>
                     </div>
                     <div class="form-group">

                         <input type="submit" name="submit" class="form-control btn btn-primary" value="Registration" >
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