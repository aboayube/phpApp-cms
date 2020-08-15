<?php
include '../connect.php';
session_start();
if(isset($_POST['login'])){
$user=$_POST['user'];
$pass=md5($_POST['pass']);
    
    if(empty($user)){
        echo '<div class="alert alert-danger">رجاء ادخل اسم المستخدم</div>';
    }else if(empty($_POST['pass'])){
        echo '<div class="alert alert-danger">رجاء ادخل كلمة السر</div>';
}else{
        $stmt=$con->prepare('select * from users where (username=? or email=?) and password=?');
        $stmt->execute(array($user,$user,$pass));
        $count=$stmt->rowCount();
        if($count>0){
            $user=$stmt->fetch();
             $_SESSION['user']=$user['username'];
             $_SESSION['id']=$user['id'];
             $_SESSION['email']=$user['email'];
             $_SESSION['img']=$user['img'];
             $_SESSION['twit']=$user['twit'];
             $_SESSION['face']=$user['face'];
             $_SESSION['yout']=$user['yout'];
             $_SESSION['about']=$user['about'];
             $_SESSION['roll']=$user['roll'];
                        
        echo '<div class="alert alert-success">تم تسجيلك بنجاح</div>';
                            //طريقة للانتقال الي صفحة الرئيسية
                            echo '<meta http-equiv="refresh" content="3; \'index.php\' ">';
        }else{
        echo '<div class="alert alert-danger"> اسم المستخدم او كلمة السر غير صحيحة</div>';
            
        }
    }
}

?>