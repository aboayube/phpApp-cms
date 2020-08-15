<?php include_once 'include/header.php';
include_once 'include/asidpar.php';
$stmt=$con->prepare('select * from posts where id=? and status=?');
$id=$_GET['id'];
$stmt->execute(array($id,"publish"));
$post=$stmt->fetch();


?>


<article class="col-md-9 col-lg-9 ">
    
<ol class="breadcrumb">
  <li><a href="index">الرئيسية</a></li>
  <li><a href="#">عنوان القسم</a></li>
  <li><a href="#">عنوان المقال</a></li>
</ol>
<div class="col-lg-12 art_bg">
    <div class="row">
        <div class="cat-post">
    <div class="col-md-12">
            
        <h2 class="cat_h2 text-center"><?php echo $post['title']?></h2>
        
        <img src="<?php echo $post['img']?>"  width="100%"  height="400px">
        </div>
    <div class="col-md-12">
  
        
         <p class="pull-right"><i class="fas fa-user"></i>:<a href="#">وجيه</a>|<i class="far fa-clock"></i><?php echo $post['regdata']?></p>
        <hr>
        <p><?php echo $post['post']?>
        </div>
            <div class="clearfix"></div>
    </div>
        
        
    </div>
    </div>
    
    <div class="col-md-12">
    <div class="row">
        <?php
        $stmt=$con->prepare("select * from comment where  status='publish' and id_post=? order by id desc ");
            $stmt->execute(array($_GET['id']));
            $coms=$stmt->fetchAll();
            
            foreach($coms as $com){
                echo '
        <div class="cat-post">
    <div class="col-md-3">
        
        <img src="images/user.png" width="100px">
        </div>
    <div class="col-md-9">
        <h2 class="cat_h2"><i class="far fa-comment"></i>'.$com['title'].'</h2>
        <p>'.$com['comment'].'</p>
       
        </div>
            <div class="col-md-12">
             <hr style="margin-bottom:5px">
                <p class="pull-right">تم التعليق بواسطه:<a href="#">'.$com['auther'].'</a></p>
                
                <p class="pull-left"><i class="far fa-clock"></i>'.$com['regdata'].'</p>
            
            </div>
            <div class="clearfix"></div>
    </div>';
            }
        
        ?>
        
        
        
        </div>
    
    
    </div>
    
    
    
    <div class="col-lg-12 art_bg" style="margin-top:20px;padding:10px">
        <h2><i class="fas fa-comments" style="color:red"></i>اضافة تعليق</h2><hr>
        <?php
        if(isset($_SESSION['id'])){
        ?>
        <form class="form-horizontal" id="comments" action="include/comment.php" method="post">
  <div class="form-group">
      <div class="col-md-2"></div>
    <label for="inputEmail3" class="col-sm-2 control-label">عنوان التعليق</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Email" name="title">
    </div>
  </div>
  
   <div class="form-group" >
      <div class="col-md-2"></div>
    <label for="inputEmail3" class="col-sm-2 control-label"> التعليق</label>
    <div class="col-sm-6">
        <textarea class="form-control" name="comment"></textarea>
    </div>
  </div>
  <div class="form-group">
      <div class="col-md-4"></div>
    <div class=" col-sm-6">
        <div id="comment"></div>
        <input type="hidden" value="<?php echo $id?>" name="id">
      <button type="submit" class="btn btn-danger" name="submit">اضف التعليق</button>
    </div>
  </div>
</form>
        <?php }else{
        echo '<div class="alert alert-info">يجيب ان تسجيل في الموقع حتي  تستطيع اضافة تعليق</div>';
        }?>
    </div>
</article>


<?php include_once 'include/footer.php';?>