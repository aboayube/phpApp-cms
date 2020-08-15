<?php

    include '../connect.php';
session_start();
if(isset($_POST['submit'])){
    
    $user=strip_tags($_POST['user']);
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $repass=$_POST['repass'];
    $sex=$_POST['sex'];
    $disc=strip_tags($_POST['disc']);
    $face=htmlspecialchars($_POST['face']);
    $twt=htmlspecialchars($_POST['twt']);
    $you=htmlspecialchars($_POST['you']);
    
    
    if(empty($user)){
        echo '<div class="alert alert-danger">الرجاء ادخال اسم المستخدم</div>';
    }else if(empty($email)){
        echo '<div class="alert alert-danger">الرجاء ادخال الايميل</div>';
    }else if(! filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo '<div class="alert alert-danger">الرجاء ادخال الايميل صحيح</div>';
    }else if(empty($pass)){
        echo '<div class="alert alert-danger">الرجاء ادخال كلمة السر</div>';
    }else if(empty($repass)){
        echo '<div class="alert alert-danger">الرجاء ادخال تاكيد كلمة السر</div>';
    }else if($pass!=$repass){
        echo '<div class="alert alert-danger">يجيب ان تكون كلمة السر ممتاطبقة</div>';
    }else{
        
        $suser=$con->prepare("select username from users where username=?");
        $suser->execute(array($user));
        
        $semail=$con->prepare("select email from users where email=?");
        $semail->execute(array($email));
        $countu=$suser->rowCount();
        $counte=$semail->rowCount();
        if($countu>0){
        echo '<div class="alert alert-danger">مستخدم موجود</div>';
        }else if($counte>0){
        echo '<div class="alert alert-danger">البريد مسجل</div>';
        }else{
            
        if(isset($_FILES['img'])){
        $img=$_FILES['img'];
        $img_name=$img['name'];
        $img_error=$img['error'];
        $img_temp=$img['tmp_name'];
        $img_size=$img['size'];
        
        $img_exe=explode('.',$img_name);
        $img_exe=strtolower(end($img_exe));
            
        $allow=array('png','gif','jpeg','jpg');
            
            if(in_array($img_exe,$allow)){
                //must dont be error 
                if($img_error===0){
                    //must the size less 2 maga
                    if($img_size<=2000000){
                        //new name to image
                        $new_name=uniqid('user',false).'.'.$img_exe;
                        $image_dir='../images/user/'.$new_name;
                        $img_db='images/user/'.$new_name;
                        //sure the photo is move
                        if(move_uploaded_file($img_temp,$image_dir)){
                            $sha=md5($pass);
                       
         $stmt= $con->prepare("insert into users(`username`,`email`,`password`,`gender`,
                 `img`,`about`,`twit`,`face`,`yout`,`regdata`,`roll`) 
                 VALUES(?,?,?,?,?,?,?,?,?,now(),0)");
$stmt->execute(array($user,$email,$sha,$sex,$img_db,$disc,$twt,$face,$you));            
         
        $sel=$con->prepare('select * from users where username=?');
        $sel->execute(array($user));
       $user=$sel->fetch();
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
                             echo '<div class="alert alert-danger">فشل رفع الصوره</div>';
                        }
                        
                        
                    }else{
                     echo '<div class="alert alert-danger">حجم الصورة كبير جدا</div>';
                        
                    }
                }else{
                     echo '<div class="alert alert-danger">حدث خطا غير متوقع اثناء رفع الصورة </div>';
}
              }else{
                echo '<div class="alert alert-danger">الرجاء اختيار صورة صحيحة</div>';
            }
            
        }else{
         //لم يدخل صوره   
                    $sha=md5($pass);
                       $img='images/w.jpg';
         $stmt= $con->prepare("insert into users(`username`,`email`,`password`,`gender`,
                 `img`,`about`,`twit`,`face`,`yout`,`regdata`,`roll`) 
                 VALUES(?,?,?,?,?,?,?,?,?,now(),0)");
$stmt->execute(array($user,$email,$sha,$sex,$img,$disc,$twt,$face,$you));            
            $sel=$con->prepare('select * from users where username=?');
        $sel->execute(array($user));
       $user=$sel->fetch();
             $_SESSION['user']=$user['username'];
             $_SESSION['id']=$user['id'];
             $_SESSION['email']=$user['email'];
             $_SESSION['img']=$user['img'];
             $_SESSION['twit']=$user['twit'];
             $_SESSION['face']=$user['face'];
             $_SESSION['yout']=$user['yout'];
             $_SESSION['about']=$user['about'];
                        
        echo '<div class="alert alert-success">تم تسجيلك بنجاح</div>';
                            //طريقة للانتقال الي صفحة الرئيسية
                            echo '<meta http-equiv="refresh" content="3; \'index.php\' ">';
                      
                      
        }
        }
        
    }
    
}




?>