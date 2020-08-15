<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';
$post='';
$title='';
if(isset($_POST['add'])){
    $title=$_POST['title'];
     $post=$_POST['post'];  
    $cat=$_POST['cat']; 
    $status=$_POST['status'];
    
    if(empty($title)){
$msg= '<div class="alert alert-danger">يجيب انت تدخل عنوان المقال</div>';
    }else if(empty($post)){
$msg= '<div class="alert alert-danger">يجيب انت تدخل  المقال</div>';
}else{
               $img=$_FILES['img'];
        $img_name=$img['name'];
        $img_error=$img['error'];
        $img_temp=$img['tmp_name'];
        $img_size=$img['size'];
        if($img_name !=''){
        $img_exe=explode('.',$img_name);
        $img_exe=strtolower(end($img_exe));
            
        $allow=array('png','gif','jpeg','jpg');
            
            if(in_array($img_exe,$allow)){
                //must dont be error 
                if($img_error===0){
                    //must the size less 2 maga
                    if($img_size<=2000000){
                        //new name to image
                        $new_name=uniqid('post',false).'.'.$img_exe;
                        $image_dir='../images/post/'.$new_name;
                        $img_db='images/post/'.$new_name;
                        //sure the photo is move
                        if(move_uploaded_file($img_temp,$image_dir)){
                   
                       
         $stmt= $con->prepare("INSERT INTO `posts`(  `title`,`post`,`cat`, `img`, `auther`, `status`, `regdata`) VALUES (?,?,?,?,?,?,now())");
$stmt->execute(array($title,$post,$cat,$img_db,$_SESSION['user'],$status));            
        echo '<div class="alert alert-success">تم اضافة المقال بنجاح</div>';
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
            $img='images/w.jpg';
                $stmt= $con->prepare("INSERT INTO `posts`(  `title`,`post`,`cat`, `img`, `auther`, `status`, `regdata`) VALUES (?,?,?,?,?,?,now())");
$stmt->execute(array($title,$post,$cat,$img,$_SESSION['user'],$status));            
        echo '<div class="alert alert-success">تم اضافة المقال بنجاح</div>';
                            //طريقة للانتقال الي صفحة الرئيسية
                            echo '<meta http-equiv="refresh" content="3; \'index.php\' ">';
                       
        }
    }
    
}
?>
    <article class="col-lg-9">
        <div class="row">
            <div class="col-md-1"></div>
        <div class="col-md-10">
            <?php if(isset($msg)){echo $msg;}?>
               <div class="panel panel-info">
  <div class="panel-heading"><b>اضافة مقال جديد</b></div>
  <div class="panel-body">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">عنوان المقال</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="title"  name="title" value="<?php echo $title;?>">
    </div>
  </div>
      <div class="form-group">
    <label for="title" class="col-sm-2 control-label"> المقال</label>
    <div class="col-sm-5">
    <textarea rows="8" name="post" class="form-control"  ><?php echo $title;?></textarea>
    </div>
  </div>
      <div class="form-group">
    <label for="title" class="col-sm-2 control-label"> اختر التصنيف</label>
    <div class="col-sm-4">
    <select name="cat" class="form-control" >
        <?php
        $stmt=$con->prepare("select * from categories");
        $stmt->execute();
        $cats=$stmt->fetchAll();
        foreach($cats as $cat){
            echo ' <option value="'.$cat['id'].'">'.$cat['cat'].'</option>';
        }
        ?>
        
        </select>
    </div>
  </div>
    <div class="form-group">
    <label for="img" class="col-sm-2 control-label">صوره المقال</label>
    <div class="col-sm-5">
      <input type="file" class="form-control" id="img"  name="img">
    </div>
  </div>
     <div class="form-group">
    <label for="s" class="col-sm-2 control-label">الحالة</label>
    <div class="col-sm-4">
    <select name="status" class="form-control" >
        <option value="derft">تعطيل </option>
        <option value="publish">نشر</option>
     
     
        </select>
    </div>
  </div>
 <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger"  name="add">اضافة المقال</button>
    </div>
  </div>

</form>
  </div>
</div>
            </div>
   
        
        </div>
     
</article>
      
<?php
include 'inc/footer.php';

?>