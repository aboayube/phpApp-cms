<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';


if(isset($_POST['submit'])){
    
    $name=$_POST['name'];
    $slid=$_POST['slid'];
    $nslid=$_POST['nslid'];
    $sec1=$_POST['sec1'];
    $nsec1=$_POST['sec1'];
    $sec2=$_POST['sec2'];
    $nsec2=$_POST['sec2'];
    $tab1=$_POST['tab1'];
    $ntab1=$_POST['ntab1'];
    $tab2=$_POST['tab2'];
    $ntab2=$_POST['ntab2'];
    $tab3=$_POST['tab3'];
    $ntab3=$_POST['ntab3'];
    $face=$_POST['face'];
    $twit=$_POST['twit'];
    $yout=$_POST['yout'];
    $inst=$_POST['inst'];
    $stmt=$con->prepare('select * from setting');
    $stmt->execute();
    $count=$stmt->rowCount();
    if($count!=1){
        //insert
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
                        $new_name=uniqid('logo',false).'.'.$img_exe;
                        $image_dir='../images/'.$new_name;
                        $img_db='images/post/'.$new_name;
                        //sure the photo is move
                        if(move_uploaded_file($img_temp,$image_dir)){
                   
                       
         $stmt= $con->prepare("INSERT INTO `setting`(`name`, `logo`, `slid`, `nslid`, `sec1`, `nsec1`, `sec2`, `nsec2`, `tab1`, `ntab1`, `tab2`, `ntab2`, `tab3`, `ntab3`, `face`, `twit`, `yout`, `inst`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->execute(array(
   $name,$img_db,$slid,$nslid,$sec1,$nsec1,$sec2,$nsec2,$tab1,$ntab1,$tab2,$ntab2,
    $tab3,$ntab3,$face,$twit,$yout,$inst));
        echo '<div class="alert alert-success">تم انشاء  اعدادت الموقع</div>';
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
                        
                       
         $stmt= $con->prepare("INSERT INTO `setting`(`name`, `logo`, `slid`, `nslid`, `sec1`, `nsec1`, `sec2`, `nsec2`, `tab1`, `ntab1`, `tab2`, `ntab2`, `tab3`, `ntab3`, `face`, `twit`, `yout`, `inst`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->execute(array(
   $name,$img_db,$slid,$nslid,$sec1,$nsec1,$sec2,$nsec2,$tab1,$ntab1,$tab2,$ntab2,
    $tab3,$ntab3,$face,$twit,$yout,$inst));
        echo '<div class="alert alert-success">تم انشاء  اعدادت الموقع</div>';
                            //طريقة للانتقال الي صفحة الرئيسية
                            echo '<meta http-equiv="refresh" content="3; \'index.php\' ">';
                      
                      
        } 
    }else{
        //update
          //insert
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
                        $new_name=uniqid('logo',false).'.'.$img_exe;
                        $image_dir='../images/'.$new_name;
                        $img_db='images/post/'.$new_name;
                        //sure the photo is move
                        if(move_uploaded_file($img_temp,$image_dir)){
                   
                       
         $stmt= $con->prepare("UPDATE `setting` SET `name`=?,`logo`=?,`slid`=?,`nslid`=?,`sec1`=?,`nsec1`=?,`sec2`=?,`nsec2`=?,`tab1`=?
         ,`ntab1`=?,`tab2`=?,`ntab2`=?,`tab3`=?,`ntab3`=?,`face`=?,`twit`=?,`yout`=?,`inst`=? WHERE id=1");
$stmt->execute(array(
   $name,$img_db,$slid,$nslid,$sec1,$nsec1,$sec2,$nsec2,$tab1,$ntab1,$tab2,$ntab2,
    $tab3,$ntab3,$face,$twit,$yout,$inst));
        echo '<div class="alert alert-success">تم تعديل  اعدادت الموقع</div>';
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
                        
                       
         $stmt= $con->prepare("UPDATE `setting` SET `name`=?,`logo`=?,`slid`=?,`nslid`=?,`sec1`=?,`nsec1`=?,`sec2`=?,`nsec2`=?,`tab1`=?
         ,`ntab1`=?,`tab2`=?,`ntab2`=?,`tab3`=?,`ntab3`=?,`face`=?,`twit`=?,`yout`=?,`inst`=? WHERE id=1");
$stmt->execute(array(
   $name,$img_db,$slid,$nslid,$sec1,$nsec1,$sec2,$nsec2,$tab1,$ntab1,$tab2,$ntab2,
    $tab3,$ntab3,$face,$twit,$yout,$inst));
        echo '<div class="alert alert-success">تم تعديل  اعدادت الموقع</div>';
                            //طريقة للانتقال الي صفحة الرئيسية
                            echo '<meta http-equiv="refresh" content="3; \'index.php\' ">';
                      
                      
        } 
    }
    
}
$stmt=$con->prepare("select * from setting");
$stmt->execute();
$set=$stmt->fetch();
function categore($x){
    global $con;
    $stmt=$con->prepare('select * from categories');
    $stmt->execute();
    $cats=$stmt->fetchAll();
    foreach($cats as $cat){
        echo '<option value="'.$cat['cat'].'"  ';if($x==$cat['cat']){echo'selected';}
        echo '>'.$cat['cat'].'</option>';
    }
}
?>
    <article class="col-lg-9">
        <div class="panel panel-info">
  <div class="panel-heading"><b>اعدادت الموقع</b></div>
  <div class="panel-body">
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">اسم الموقع</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3"  name="name" value="<?php echo $set['name']?>">
    </div>
  </div>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">شعار الموقع</label>
    <div class="col-sm-5">
      <input type="file" class="form-control" id="inputEmail3"  name="img" >
    </div>
  </div>
        <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">سليد شو</label>
    <div class="col-sm-5">
    <select class="form-control" name="slid">
        <?php categore($set['slid']);?>
        
        </select>
    </div>
    <label for="inputEmail3" class="col-sm-2 control-label">عدد المقالات</label>
    <div class="col-sm-1">
      <input type="number" class="form-control" id="inputEmail3"  name="nslid" min="3" max="10"
             value="<?php echo $set['nslid']?>">
    </div>
  </div>
          <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">القسم الاول</label>
    <div class="col-sm-5">
    <select class="form-control" name="sec1">
        <?php categore($set['sec1']);?>
        
        </select>
    </div>
         <label for="inputEmail3" class="col-sm-2 control-label">عدد المقالات</label>
    <div class="col-sm-1">
      <input type="number" class="form-control" id="inputEmail3"  name="nsec1" min="3" max="10"     value="<?php echo $set['nsec1']?>">
    </div>     
  </div>
          <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">القسم الثاني</label>
    <div class="col-sm-5">
    <select class="form-control" name="sec2">
        <?php categore($set['sec2']);?>
        
        </select>
    </div>
              <label for="inputEmail3" class="col-sm-2 control-label">عدد المقالات</label>
    <div class="col-sm-1">
      <input type="number" class="form-control" id="inputEmail3"  name="nsec2" min="3" max="10"
             value="<?php echo $set['nsec2']?>">
    </div>
       
  </div>
          <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">التاب الاول</label>
    <div class="col-sm-5">
    <select class="form-control" name="tab1">
        <?php categore($set['tab1']);?>
        
        </select>
    </div>
              <label for="inputEmail3" class="col-sm-2 control-label">عدد المقالات</label>
    <div class="col-sm-1">
      <input type="number" class="form-control" id="inputEmail3"  name="ntab1" min="3" max="10"
             value="<?php echo $set['ntab1']?>">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">التاب الثاني</label>
    <div class="col-sm-5">
    <select class="form-control" name="tab2">
        <?php categore($set['tab2']);?>
        
        </select>
    </div>
             <label for="inputEmail3" class="col-sm-2 control-label">عدد المقالات</label>
    <div class="col-sm-1">
      <input type="number" class="form-control" id="inputEmail3"  name="ntab2" min="3" max="10"
              value="<?php echo $set['ntab2']?>">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">التاب الثالث</label>
    <div class="col-sm-5">
    <select class="form-control" name="tab3">
        <?php categore($set['tab3']);?>
        
        </select>
    </div>
             <label for="inputEmail3" class="col-sm-2 control-label">عدد المقالات</label>
    <div class="col-sm-1">
      <input type="number" class="form-control" id="inputEmail3"  name="ntab3" min="3" max="10"
              value="<?php echo $set['ntab3']?>">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">facebook</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3"  name="face"         value="<?php echo $set['face']?>">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">twiter</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3"  name="twit" value="<?php echo $set['twit']?>">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">youtube</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3"  name="yout" value="<?php echo $set['yout']?>">
    </div>
  </div>
         <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">instgram</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3"  name="inst" value="<?php echo $set['inst']?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="submit">Sign in</button>
    </div>
  </div>
</form>
  </div>
</div>
        
        </article>
      
<?php
include 'inc/footer.php';

?>