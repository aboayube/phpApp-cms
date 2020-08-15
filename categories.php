<?php include_once 'include/header.php';
include_once 'include/asidpar.php';



?>


<article class="col-md-9 col-lg-9 ">
    
<ol class="breadcrumb">
  <li><a href="index">الرئيسية</a></li>
  <li><a href="#">عنوان المقال</a></li>
</ol>
<div class="col-lg-12 art_bg">
    <div class="row">
        <?php
    //عمل تعدد صفحات
    $per_page=5;
          if(!isset($_GET['page'])){
              $page=1;
          }else{
              $page=intval($_GET['page']);
          }
          $startfrom=($page-1)*$per_page;
        
$stmt=$con->prepare("select * from posts  where status='publish' order by id desc limit $startfrom, $per_page");
$stmt->execute();
$posts=$stmt->fetchAll();
        foreach($posts as $post){
            echo '
        <div class="cat-post">
    <div class="col-md-3">
        
        <img src="'.$post['img'].'"  class="img-responsive" style="width: 100%;height: 150px;">
        </div>
    <div class="col-md-9">
        <h2 class="cat_h2">'.$post['title'].'</h2>
        <p>'.$post['post'].'...</p>
       
        </div>
            <div class="col-md-12">
             <hr style="margin-bottom:5px">
        <a class="btn btn-warning pull-left" href="post.php?id='.$post['id'].'" >اقراء المزيد</a>
        <p class="pull-right"><i class="fas fa-user"></i>:<a href="profile.php?user='.$post['auther'].'">'.$post['auther'].'</a>|<i class="far fa-clock"></i>'.$post['regdata'].'</p>
            
            </div>
            <div class="clearfix"></div>
    </div>';
        }
        
        ?>
        
        
    </div>
      <?php
      $stmt=$con->prepare("select count(id) from posts");
      $stmt->execute(array());
      $count=$stmt->fetchColumn();
      //تقريب للاكبر
      $totle=ceil($count/$per_page);
      ?>
      <nav class="text-center">
      <ul class="pagination">
         <?php
      for($i=1;$i<=$totle;$i++){
          echo '
          <li ';if($page==$i){echo'class="active"';}echo'><a href="categories.php?page='.$i.'">'.$i.'</a></li>';
      }
       ?>
    </div>
</article>


<?php include_once 'include/footer.php';?>