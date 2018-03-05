<?php
//Our php code will be gose here.
$connection = mysqli_connect('localhost','root','','LMS');
if ($connection == false){
    echo mysqli_connect_errno();
    exit();
}else{
     $sql = "SELECT id,fname,lname,email FROM user";
     $stmt = mysqli_query($connection,$sql);
     if ($stmt == false){
         echo mysqli_error($connection);
         exit();
     }else{
         $result = mysqli_num_rows($stmt);
//         var_dump($stmt);
//         die();
         $data = mysqli_fetch_all($stmt,1);
//         var_dump($data);
//         die();
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
        <div class="panel-body">
               <table class="table table-striped">
                     <thead>
                         <tr>
                             <td>ID</td>
                             <td>FIRST NAME</td>
                             <td>LAST NAME</td>
                              <td>EMAIL</td>
                              <td>ACTION</td>
                         </tr>
                     </thead>
                   <tbody>
                      <?php
                         foreach ($data as $value){
                             ?>
                             <tr>
                                 <td><?php echo $value['id']; ?></td>
                                 <td><?php echo $value['fname']; ?></td>
                                 <td><?php echo $value['lname']; ?></td>
                                 <td><?php echo $value['email']; ?></td>
                                 <td>
                                     <a href="edit.php?id=<?php echo $value['id']; ?>">Edit</a> ||
                                     <a href="delete.php?id=<?php echo $value['id']; ?>" onclick="confirm('Are You Sure ?')">Delete</a>
                                 </td>

                             </tr>
                      <?php
                         }
                      ?>
                   </tbody>
               </table>
        </div>
        <div class="panel-footer">
            <p style="text-align: center">All Right Reverse &copy;  Daffodil Students</p>
        </div>
    </div>
</div>
</body>
</html>