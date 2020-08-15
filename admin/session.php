<?php
session_start();
include '../connect.php';
if(isset($_SESSION['id'])){
    $stmt=$con->prepare("select * from users where id=? and roll=1");
    $stmt->execute(array($_SESSION['id']));
    $count=$stmt->rowCount();
    if($count>0){
        
    }else{
        
    header("Location:../index.php");
    }
    
}else{
    header("Location:../index.php");
}


?>