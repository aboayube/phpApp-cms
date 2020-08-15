<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';

$msg='';
$id=intval($_GET['user']);
$stmt=$con->prepare("select * from users where id=?");
$stmt->execute(array($id));
$getuser=$stmt->fetch();
if(isset($_POST['edit'])){
    $id=$_POST['id'];
    $user=$_POST['user'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $repass=$_POST['repass'];
    $sex=$_POST['sex'];
    $privleg=$_POST['privleg'];
    $disc=$_POST['disc'];
    $face=$_POST['face'];
    $twt=$_POST['twt'];
    $you=$_POST['you'];
    $roll=$_POST['privleg'];
    
    if(empty($user)){
           $msg= '<div class="alert alert-danger">يجيب ان تدخل اسم المستخدم</div>';
    }else if(empty($email)){
           $msg= '<div class="alert alert-danger">يجيب ان تدخل ايميل </div>';
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL) ){
           $msg= '<div class="alert alert-danger">يجيب ان تدخل ايميل صحيح </div>';
   }else{
        $stmt=$con->prepare("select * from users where username=? or email=?");
        $stmt->execute(array($user,$email));
        $count=$stmt->rowCount();
        if($count>0){
            //ينعي بس يغير كلمة السر هنا
    if($user==$getuser['username'] && $email==$getuser['email']){ 
        if($pass!='' && $repass!=''){
            if($pass!=$repass){
           $msg= '<div class="alert alert-danger">يجيب ان تكون كلمات السر متطابقة </div>';
           }else{
               $img=$_FILES['img'];
            $img_name=$img['name'];  
            $img_tmp=$img['tmp_name']; 
            $img_size=$img['size']; 
            $img_error=$img['error'];
                
            if($img_name!=''){
            $img_exe=explode('.',$img_name) ;
            $img_exe=strtolower(end($img_exe));
            $allow=array('png','jpg','gif');    
                if(in_array($img_exe,$allow)){
                    if($img_error ==0){
                        if($img_size<=3000000){
                            $new_name=uniqid('user',false).'.'.$img_exe;
                            $img_dr='../images/user'.$new_name;
                            $img_db='images/user'.$new_name;
                            if(move_uploaded_file($img_tmp,$img_dr)){
                                $pa=md5($pass);
   $stmt=$con->prepare('UPDATE `users` SET `password`=?,`gender`=?,`img`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($pa,$sex,$img_db,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
                            }else{
           $msg= '<div class="alert alert-danger">حذث خطا اثناء نقل الملف الرجاء اعادة الارسال</div>';
                                
                            }
                            
                        }else{
           $msg= '<div class="alert alert-danger">حجم الصورة كبير  جدا</div>';
                            
                        }
                    }else{
           $msg= '<div class="alert alert-danger">هناك مشكله في الصوره الرجاء اعادة التحميل</div>';
                        
                    }
                }else{
           $msg= '<div class="alert alert-danger">يجيب انت تدخل صوره </div>';
                }
                
                
            }else{
                
                 $pa=md5($pass);
   $stmt=$con->prepare('UPDATE `users` SET `password`=?,`gender`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($pa,$sex,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
            }    
                
            }
        }else{
                    $img=$_FILES['img'];
            $img_name=$img['name'];  
            $img_tmp=$img['tmp_name']; 
            $img_size=$img['size']; 
            $img_error=$img['error'];
                
            if($img_name!=''){
            $img_exe=explode('.',$img_name) ;
            $img_exe=strtolower(end($img_exe));
            $allow=array('png','jpg','gif');    
                if(in_array($img_exe,$allow)){
                    if($img_error ==0){
                        if($img_size<=3000000){
                            $new_name=uniqid('user',false).'.'.$img_exe;
                            $img_dr='../images/user'.$new_name;
                            $img_db='images/user'.$new_name;
                            if(move_uploaded_file($img_tmp,$img_dr)){
   $stmt=$con->prepare('UPDATE `users` SET `gender`=?,`img`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($sex,$img_db,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
                            }else{
           $msg= '<div class="alert alert-danger">حذث خطا اثناء نقل الملف الرجاء اعادة الارسال</div>';
                                
                            }
                            
                        }else{
           $msg= '<div class="alert alert-danger">حجم الصورة كبير  جدا</div>';
                            
                        }
                    }else{
           $msg= '<div class="alert alert-danger">هناك مشكله في الصوره الرجاء اعادة التحميل</div>';
                        
                    }
                }else{
           $msg= '<div class="alert alert-danger">يجيب انت تدخل صوره </div>';
                }
                
                
            }else{
                
   $stmt=$con->prepare('UPDATE `users` SET  `gender`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($sex,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
            }
            
        }
        
    }else if($user!=$getuser['username'] && $email==$getuser['email']){
        $stmt=$con->prepare("select username from users where username=?");
        $stmt->execute(array($user));
        $count=$stmt->rowCount();
        if($count>0){
           $msg= '<div class="alert alert-danger">اسم المستخدم مسجل بلفعل</div>';
}else{
               if($pass!='' && $repass!=''){
            if($pass!=$repass){
           $msg= '<div class="alert alert-danger">يجيب ان تكون كلمات السر متطابقة </div>';
           }else{
               $img=$_FILES['img'];
            $img_name=$img['name'];  
            $img_tmp=$img['tmp_name']; 
            $img_size=$img['size']; 
            $img_error=$img['error'];
                
            if($img_name!=''){
            $img_exe=explode('.',$img_name) ;
            $img_exe=strtolower(end($img_exe));
            $allow=array('png','jpg','gif');    
                if(in_array($img_exe,$allow)){
                    if($img_error ==0){
                        if($img_size<=3000000){
                            $new_name=uniqid('user',false).'.'.$img_exe;
                            $img_dr='../images/user'.$new_name;
                            $img_db='images/user'.$new_name;
                            if(move_uploaded_file($img_tmp,$img_dr)){
                                $pa=md5($pass);
   $stmt=$con->prepare('UPDATE `users` SET `username`=? ,
  `password`=?,`gender`=?,`img`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($user,$pa,$sex,$img_db,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
                            }else{
           $msg= '<div class="alert alert-danger">حذث خطا اثناء نقل الملف الرجاء اعادة الارسال</div>';
                                
                            }
                            
                        }else{
           $msg= '<div class="alert alert-danger">حجم الصورة كبير  جدا</div>';
                            
                        }
                    }else{
           $msg= '<div class="alert alert-danger">هناك مشكله في الصوره الرجاء اعادة التحميل</div>';
                        
                    }
                }else{
           $msg= '<div class="alert alert-danger">يجيب انت تدخل صوره </div>';
                }
                
                
            }else{
                
                 $pa=md5($pass);
   $stmt=$con->prepare('UPDATE `users` SET `username`=? ,`password`=?,`gender`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($user,$pa,$sex,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
            }    
                
            }
        }else{
                    $img=$_FILES['img'];
            $img_name=$img['name'];  
            $img_tmp=$img['tmp_name']; 
            $img_size=$img['size']; 
            $img_error=$img['error'];
                
            if($img_name!=''){
            $img_exe=explode('.',$img_name) ;
            $img_exe=strtolower(end($img_exe));
            $allow=array('png','jpg','gif');    
                if(in_array($img_exe,$allow)){
                    if($img_error ==0){
                        if($img_size<=3000000){
                            $new_name=uniqid('user',false).'.'.$img_exe;
                            $img_dr='../images/user'.$new_name;
                            $img_db='images/user'.$new_name;
                            if(move_uploaded_file($img_tmp,$img_dr)){
   $stmt=$con->prepare('UPDATE `users` SET `username`=? ,`gender`=?,`img`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($user,$sex,$img_db,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
                            }else{
           $msg= '<div class="alert alert-danger">حذث خطا اثناء نقل الملف الرجاء اعادة الارسال</div>';
                                
                            }
                            
                        }else{
           $msg= '<div class="alert alert-danger">حجم الصورة كبير  جدا</div>';
                            
                        }
                    }else{
           $msg= '<div class="alert alert-danger">هناك مشكله في الصوره الرجاء اعادة التحميل</div>';
                        
                    }
                }else{
           $msg= '<div class="alert alert-danger">يجيب انت تدخل صوره </div>';
                }
                
                
            }else{
                
   $stmt=$con->prepare('UPDATE `users` SET `username`=? ,`gender`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($user,$sex,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
            }
            
        }     
            
            
        }
        
        
    }else if($user==$getuser['username'] && $email!=$getuser['email']){
        $stmt=$con->prepare("select username from users where email=?");
        $stmt->execute(array($user));
        $count=$stmt->rowCount();
        if($count>0){
           $msg= '<div class="alert alert-danger">ايميل مسجل بلفعل</div>';
}else{
               if($pass!='' && $repass!=''){
            if($pass!=$repass){
           $msg= '<div class="alert alert-danger">يجيب ان تكون كلمات السر متطابقة </div>';
           }else{
               $img=$_FILES['img'];
            $img_name=$img['name'];  
            $img_tmp=$img['tmp_name']; 
            $img_size=$img['size']; 
            $img_error=$img['error'];
                
            if($img_name!=''){
            $img_exe=explode('.',$img_name) ;
            $img_exe=strtolower(end($img_exe));
            $allow=array('png','jpg','gif');    
                if(in_array($img_exe,$allow)){
                    if($img_error ==0){
                        if($img_size<=3000000){
                            $new_name=uniqid('user',false).'.'.$img_exe;
                            $img_dr='../images/user'.$new_name;
                            $img_db='images/user'.$new_name;
                            if(move_uploaded_file($img_tmp,$img_dr)){
                                $pa=md5($pass);
   $stmt=$con->prepare('UPDATE `users` SET `username`=?,`email`=? ,
  `password`=?,`gender`=?,`img`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($user,$email,$pa,$sex,$img_db,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
                            }else{
           $msg= '<div class="alert alert-danger">حذث خطا اثناء نقل الملف الرجاء اعادة الارسال</div>';
                                
                            }
                            
                        }else{
           $msg= '<div class="alert alert-danger">حجم الصورة كبير  جدا</div>';
                            
                        }
                    }else{
           $msg= '<div class="alert alert-danger">هناك مشكله في الصوره الرجاء اعادة التحميل</div>';
                        
                    }
                }else{
           $msg= '<div class="alert alert-danger">يجيب انت تدخل صوره </div>';
                }
                
                
            }else{
                
                 $pa=md5($pass);
   $stmt=$con->prepare('UPDATE `users` SET `username`=?,`email`=? ,`password`=?,`gender`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($user,$email,$pa,$sex,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
            }    
                
            }
        }else{
                    $img=$_FILES['img'];
            $img_name=$img['name'];  
            $img_tmp=$img['tmp_name']; 
            $img_size=$img['size']; 
            $img_error=$img['error'];
                
            if($img_name!=''){
            $img_exe=explode('.',$img_name) ;
            $img_exe=strtolower(end($img_exe));
            $allow=array('png','jpg','gif');    
                if(in_array($img_exe,$allow)){
                    if($img_error ==0){
                        if($img_size<=3000000){
                            $new_name=uniqid('user',false).'.'.$img_exe;
                            $img_dr='../images/user'.$new_name;
                            $img_db='images/user'.$new_name;
                            if(move_uploaded_file($img_tmp,$img_dr)){
   $stmt=$con->prepare('UPDATE `users` SET `username`=?,`email`=? ,`gender`=?,`img`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($user,$email,$sex,$img_db,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
                            }else{
           $msg= '<div class="alert alert-danger">حذث خطا اثناء نقل الملف الرجاء اعادة الارسال</div>';
                                
                            }
                            
                        }else{
           $msg= '<div class="alert alert-danger">حجم الصورة كبير  جدا</div>';
                            
                        }
                    }else{
           $msg= '<div class="alert alert-danger">هناك مشكله في الصوره الرجاء اعادة التحميل</div>';
                        
                    }
                }else{
           $msg= '<div class="alert alert-danger">يجيب انت تدخل صوره </div>';
                }
                
                
            }else{
                
   $stmt=$con->prepare('UPDATE `users` SET `username`=?,`email`=? ,`gender`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($user,$email,$sex,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
            }
            
        }     
            
            
        }
        
}else{
           $msg= '<div class="alert alert-danger">اسم المستخدم او ايميل مسجل بلفعل</div>';
        
    }
        }else{
            //قام المستخدم بتغير الاسم وبريد الالكتروني
                 if($pass!='' && $repass!=''){
            if($pass!=$repass){
           $msg= '<div class="alert alert-danger">يجيب ان تكون كلمات السر متطابقة </div>';
           }else{
               $img=$_FILES['img'];
            $img_name=$img['name'];  
            $img_tmp=$img['tmp_name']; 
            $img_size=$img['size']; 
            $img_error=$img['error'];
                
            if($img_name!=''){
            $img_exe=explode('.',$img_name) ;
            $img_exe=strtolower(end($img_exe));
            $allow=array('png','jpg','gif');    
                if(in_array($img_exe,$allow)){
                    if($img_error ==0){
                        if($img_size<=3000000){
                            $new_name=uniqid('user',false).'.'.$img_exe;
                            $img_dr='../images/user'.$new_name;
                            $img_db='images/user'.$new_name;
                            if(move_uploaded_file($img_tmp,$img_dr)){
                                $pa=md5($pass);
   $stmt=$con->prepare('UPDATE `users` SET `password`=?,`gender`=?,`img`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($pa,$sex,$img_db,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
                            }else{
           $msg= '<div class="alert alert-danger">حذث خطا اثناء نقل الملف الرجاء اعادة الارسال</div>';
                                
                            }
                            
                        }else{
           $msg= '<div class="alert alert-danger">حجم الصورة كبير  جدا</div>';
                            
                        }
                    }else{
           $msg= '<div class="alert alert-danger">هناك مشكله في الصوره الرجاء اعادة التحميل</div>';
                        
                    }
                }else{
           $msg= '<div class="alert alert-danger">يجيب انت تدخل صوره </div>';
                }
                
                
            }else{
                
                 $pa=md5($pass);
   $stmt=$con->prepare('UPDATE `users` SET `password`=?,`gender`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($pa,$sex,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
            }    
                
            }
        }else{
                    $img=$_FILES['img'];
            $img_name=$img['name'];  
            $img_tmp=$img['tmp_name']; 
            $img_size=$img['size']; 
            $img_error=$img['error'];
                
            if($img_name!=''){
            $img_exe=explode('.',$img_name) ;
            $img_exe=strtolower(end($img_exe));
            $allow=array('png','jpg','gif');    
                if(in_array($img_exe,$allow)){
                    if($img_error ==0){
                        if($img_size<=3000000){
                            $new_name=uniqid('user',false).'.'.$img_exe;
                            $img_dr='../images/user'.$new_name;
                            $img_db='images/user'.$new_name;
                            if(move_uploaded_file($img_tmp,$img_dr)){
   $stmt=$con->prepare('UPDATE `users` SET `gender`=?,`img`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($sex,$img_db,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
                            }else{
           $msg= '<div class="alert alert-danger">حذث خطا اثناء نقل الملف الرجاء اعادة الارسال</div>';
                                
                            }
                            
                        }else{
           $msg= '<div class="alert alert-danger">حجم الصورة كبير  جدا</div>';
                            
                        }
                    }else{
           $msg= '<div class="alert alert-danger">هناك مشكله في الصوره الرجاء اعادة التحميل</div>';
                        
                    }
                }else{
           $msg= '<div class="alert alert-danger">يجيب انت تدخل صوره </div>';
                }
                
                
            }else{
                
   $stmt=$con->prepare('UPDATE `users` SET  `gender`=?,`about`=?,`twit`=?,
   `face`=?,`yout`=?,`roll`=? WHERE `id`=?');
  $stmt->execute(array($sex,$disc,$twt,$face,$you,$roll,$id));  
           $msg= '<div class="alert alert-success">تم التعديل بنجاح</div>';      

                            
            }
            
        }
        
            
        }
    }
}

$id=intval($_GET['user']);
$stmt=$con->prepare("select * from users where id=?");
$stmt->execute(array($id));
$getuser=$stmt->fetch();
?>
    <article class="col-lg-9">
        <?php echo $msg?>
        <div class="panel panel-info">
  <div class="panel-heading">تعديل البيانات العضو <?php echo $getuser['username']?></div>
  <div class="panel-body " ><div class="col-lg-9">
   <form class="form-horizontal"   method="post"  id="edit"
          enctype="multipart/form-data" >
 <input type="hidden" name="id" value="<?php echo $getuser['id']?>">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">اسم المستخدم</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail3" name="user" value="<?php echo $getuser['username']?>">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail4" class="col-sm-2 control-label">البريد الالكتروني</label>
    <div class="col-sm-7">
       
      <input type="email" class="form-control" id="inputEmail4"  name="email"
             value="<?php echo $getuser['email']?>">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail5" class="col-sm-2 control-label">كلمة المرور</label>
    <div class="col-sm-7">
      <input type="password" class="form-control" id="inputEmail5"  name="pass">
        <input type="hidden" name="oldpass" value="">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail6" class="col-sm-2 control-label">تاكيد كلمة المرور</label>
    <div class="col-sm-7">
      <input type="password" class="form-control" id="inputEmail6"  name="repass">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail7" class="col-sm-2 control-label">صورة شخصية</label>
    <div class="col-sm-7">
      <input type="file" class="form-control" id="inputEmail7"  name="img">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">الجنس</label>
    <div class="col-sm-3">
     <select class="form-control" id="importEmail20" name="sex">
        
        <option value="1" <?php if($getuser['gender']==1){echo 'selected';}?>>دكر</option>
        <option value="0" <?php if($getuser['gender']==0){echo 'selected';}?>>انثي</option>
        
        </select>
    </div>
  </div>
       
       <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">الصلاحية</label>
    <div class="col-sm-3">
     <select class="form-control" id="importEmail20" name="privleg">
        
        <option value="0" <?php if($getuser['roll']==0){echo 'selected';}?>>مستخدم</option>
        <option value="1" <?php if($getuser['roll']==1){echo 'selected';}?>>ادمن</option>
        
        </select>
    </div>
  </div>
       <div class="form-group">
    <label for="inputEmail10" class="col-sm-2 control-label">وصف مختصر عنك</label>
    <div class="col-sm-7">
      <textarea class="form-control" name="disc"><?php echo $getuser['about']?></textarea>
    </div>
  </div>
          <div class="form-group">
    <label for="inputEmail20" class="col-sm-2 control-label"><i class="fab fa-facebook fa-2x"></i></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail20" placeholder="Email" name="face"
              value="<?php echo $getuser['face']?>">
    </div>
  </div>
          <div class="form-group">
    <label for="inputEmail30" class="col-sm-2 control-label"><i class="fab fa-twitter-square fa-2x"></i></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail30" placeholder="Email" name="twt"
              value="<?php echo $getuser['twit']?>">
    </div>
  </div>
          <div class="form-group">
    <label for="inputEmail40" class="col-sm-2 control-label"><i class="fab fa-youtube fa-2x"></i></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail40" placeholder="Email" name="you"
              value="<?php echo $getuser['yout']?>">
    </div>
  </div>
        <div class="col-md-2"></div>
        <div class=" col-md-5 text-right">
             <div id="rs">
        
        </div></div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-danger btn-block" name="edit">تسجيل</button>
    </div>
  </div>
      </form></div>
      <div class="panel panel-default col-md-3">
  <div class="panel-body">
      <img src="../<?php echo $getuser['img']?>" width="100%">
  </div>
</div>
  </div>
</div>
        
        </article>
      
<?php
include 'inc/footer.php';

?>