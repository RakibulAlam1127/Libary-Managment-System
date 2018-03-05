<?php
//Our php code will be gose here.
$errors = [];
$email = $password = '';
if (isset($_POST['submit'])){
    function validation($data){
        $data = htmlspecialchars($data);
        $data = htmlentities($data);
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }
    if (empty($_POST['email'])){
        $errors['email'] = 'Email Field Is Required';
    }else{
        $email = validation($_POST['email']);
    }
    if (empty($_POST['password'])){
        $errors['password'] = 'Password Field Is Required';
    }else{
        $password = validation($_POST['password']);

    }
    if (empty($errors)){
        //Our database connection will be gose here.
        $connection = mysqli_connect('localhost','root','','LMS');
        if ($connection == false){
            echo mysqli_connect_errno();
            exit();
        }else{
               $sql = "SELECT id,email,password FROM user WHERE email = '$email'";
               $stmt = mysqli_query($connection,$sql);
               if ($stmt == true){

                  $result  = mysqli_num_rows($stmt);
                  $data = mysqli_fetch_assoc($stmt);
//                  var_dump($data);
//                  die();
                      if ($result === 0){
                          $errors[] = 'Email address is Not Found';
                      }else{
                          $password = password_verify($password,$data['password']);
                          if ($password == true){
                              header('Location:view.php');
                          }
                      }
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
              <?php
                 if (!empty($errors)){
                     ?>
                     <div class="alert alert-danger">
                         <?php
                            foreach ($errors as $error){
                                ?>
                                <ul>
                                    <li><?php echo $error; ?></li>
                                </ul>
                         <?php
                            }
                         ?>
                     </div>
            <?php
                 }
              ?>
            <div class="panel-body">
                <div class="form-group">
                    <label for="email">University E-Mail Address</label>
                    <input type="email" name="email" class="form-control" placeholder="example@diu.edu.bd" autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" autofocus>

                </div>
                <div class="form-group">

                    <input type="submit" name="submit" class="form-control btn btn-primary" value="Log In" >
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