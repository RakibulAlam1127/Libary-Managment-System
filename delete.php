<?php
 //Our dalete code will be gode here.
$id = $_GET['id'];
$id = ((int) $id);
if ($id === 0){
    header('Location:register.php');
}else{
    $connection = mysqli_connect('localhost','root','','LMS');
    if ($connection == false){
        echo mysqli_connect_errno();
        exit();
    }else{
        $delete_query = "DELETE FROM user WHERE id='$id'";
        $stmt = mysqli_query($connection,$delete_query);
        if ($stmt == true){
            header('Location:view.php');
        }else{
            echo mysqli_error($connection);
            exit();
        }
    }
}

?>