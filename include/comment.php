<?php
session_start();
include '../connect.php';
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $title=$_POST['title'];
    $comment=strip_tags($_POST['comment']);

if(empty($title)){
    echo '<div class="alert alert-danger">يجيب ان تدخل عنوان التعليق</div>';
}else if(empty($comment)){
    echo '<div class="alert alert-danger">يجيب ان تدخل  التعليق</div>';
}else{  
    $stmt=$con->prepare("INSERT INTO `comment`( `id_post`, `auther`, `title`, `comment`, `regdata`,`status`) VALUES (?,?,?,?,now(),?)");
    $stmt->execute(array($id,$_SESSION['user'],$title,$comment,'derft'));
    echo '<div class="alert alert-success">تم اضافة التعليق بنجاح  </div>';
}

}