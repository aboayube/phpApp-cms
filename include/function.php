<?php

function register(){
    if(isset($_SESSION['id'])){
        
       echo '<div class="alert alert-danger">عذرا انت مسجل بلفعل</div>';
    }else{
        echo '
    <form class="form-horizontal" method="post" action="include/register.php" id="register"
          enctype="multipart/form-data">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">اسم المستخدم<span style="color:red">  *</span></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Email" name="user">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail4" class="col-sm-2 control-label">البريد الالكتروني<span style="color:red">  *</span></label>
    <div class="col-sm-7">
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail5" class="col-sm-2 control-label">كلمة المرور<span style="color:red">  *</span></label>
    <div class="col-sm-7">
      <input type="password" class="form-control" id="inputEmail5" placeholder="Email" name="pass">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail6" class="col-sm-2 control-label">تاكيد كلمة المرور<span style="color:red">  *</span></label>
    <div class="col-sm-7">
      <input type="password" class="form-control" id="inputEmail6" placeholder="Email" name="repass">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail7" class="col-sm-2 control-label">صورة شخصية<span style="color:red">  *</span></label>
    <div class="col-sm-7">
      <input type="file" class="form-control" id="inputEmail7" placeholder="Email" name="img">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">الجنس<span style="color:red">  *</span></label>
    <div class="col-sm-3">
     <select class="form-control" id="importEmail20" name="sex">
        
        <option value="1">دكر</option>
        <option value="1">انثي</option>
        
        </select>
    </div>
  </div>
       <div class="form-group">
    <label for="inputEmail10" class="col-sm-2 control-label">وصف مختصر عنك</label>
    <div class="col-sm-7">
      <textarea class="form-control" name="disc"></textarea>
    </div>
  </div>
          <div class="form-group">
    <label for="inputEmail20" class="col-sm-2 control-label"><i class="fab fa-facebook fa-2x"></i></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail20" placeholder="Email" name="face">
    </div>
  </div>
          <div class="form-group">
    <label for="inputEmail30" class="col-sm-2 control-label"><i class="fab fa-twitter-square fa-2x"></i></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail30" placeholder="Email" name="twt">
    </div>
  </div>
          <div class="form-group">
    <label for="inputEmail40" class="col-sm-2 control-label"><i class="fab fa-youtube fa-2x"></i></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="inputEmail40" placeholder="Email" name="you">
    </div>
  </div>
        <div class="col-md-2"></div>
        <div class=" col-md-5 text-right">
             <div id="result">
        
        </div></div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-danger btn-block" name="submit">تسجيل</button>
    </div>
  </div>
</form>
    
    ';
    }
}

function loginarea(){
    if(isset($_SESSION['id'])){
        echo '
            <div class="panel panel-default">
  <div class="panel-heading text-center"><b>اهلا وسهلا بك يا '. $_SESSION ['user'].'</b></div>
  <div class="panel-body">
      <div class="text-center " style="margin-bottom:10px">
      <img src="'. $_SESSION['img'].'" width="128px">
      </div>
      <hr>
 <div class="col-md-12">
      <div class="row">
     <p><b>البريد الالكتروني</b>:'. $_SESSION['email'].'</p>
     <p><b>روابط لديك</b>:
   <a href="'. $_SESSION['face'].'" target="_blank" style="margin:0 5px"><i class="fab fa-facebook-square"></i></a>
         <a href="'.$_SESSION['twit'].'" target="_blank" style="margin:0 5px"><i class="fab fa-twitter"></i></a>
         
         <a href="'. $_SESSION['yout'].'" target="_blank" style="margin:0 5px"><i class="fab fa-youtube"></i></a>
          
          </p>
     </div>
      
      
      </div>
      
  </div>
                
  <div class="panel-footer">
<div class="col-md-12">
      <div class="row">
          
          
          <div class="col-md-6">
          
    <a class="btn btn-info btn-sm pull-right" href="profile.php?user='.$_SESSION['id'].'">الصفحة الشخصية</a>
          </div>
          <div class="col-md-6">
          
          ';
        if($_SESSION['roll']==1){
              echo'
    <a class="btn btn-danger btn-sm pull-left" href="admin/index.php">لوحة التحكم</a>';
        }
        echo'
      
          
          </div>
    
    </div>
      </div>                
              
    <div class="clearfix"></div>  
                
                </div>
</div>
            ';
    }else{
        echo '
            <div class="panel panel-default">
  <div class="panel-heading text-center"><b>تسجيل الدخول</b></div>
  <div class="panel-body">
      <div class="text-center " style="margin-bottom:10px">
      <img src="images/user.png" width="128px">
      </div>
      <hr>
   <form class="form-horizontal" action="include/login.php" method="post"  id="login" >
  <div class="form-group">
    <label for="exampleInputEmail1" class="col-md-2"><i class="fa fa-user fa-2x"></i></label>
      <div class="col-md-10">
    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="دخل اسم المستخدم او ايميل" name="user">
  </div></div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="col-md-2"><i class="fa fa-lock fa-2x"></i></label>
      <div class="col-md-10">
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="ادخل كلمة المرور" name="pass">
      </div></div>
       <div id="resolt" style="text-align:center"></div>
  <div class="form-group">      <div class="col-sm-10 pull-left">
  <button type="submit" class="btn btn-info text-center pull-left" name="login">تسجيل الدخول</button>
      </div></div>
</form>
  </div>
                
  <div class="panel-footer"><i class="fas fa-exclamation-triangle" style="color:red"></i>اذا لم تكن مسجل لدينا <a href="register.php">اضغط هنا</a></div>
</div>
        
        ';
    }
} 
?>