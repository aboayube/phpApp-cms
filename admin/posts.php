<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';
$msg='';
if(isset($_GET['stuts']) && isset($_GET['post'])){
    $stmt=$con->prepare("update posts set status=? where id=?");
    $stmt->execute(array($_GET['stuts'],$_GET['post']));
}
if(isset($_GET['delete'])){
    $stmt=$con->prepare("delete from posts where id=?");
    $stmt->execute(array($_GET['delete']));
 $msg='<div class="alert  alert-danger">delete is done</div>';
}
?>
    <article class="col-lg-9">
        <div class="panel panel-info">
  <div class="panel-heading">Panel heading without title</div>
  <div class="panel-body">
      
      <table class="table table-hover">
          <?php echo $msg?>
  <tr>
      <thead><tr>
          <th>#الرقم</th>
          <th>عنوان المقال</th>
          <th>صورة المقال</th>
          <th>الكاتب</th>
          <th>التصنيف</th>
          <th>تاريخ النشر</th>
          <th>مشاهدة</th>
          <th>الحالة</th>
          <th>تعديل</th>
          <th>حذف</th>
         </tr>
          </thead>
      
      <tbody>
          <?php
    //عمل تعدد صفحات
    $per_page=5;
          if(!isset($_GET['page'])){
              $page=1;
          }else{
              $page=intval($_GET['page']);
          }
          $startfrom=($page-1)*$per_page;
    
          $stmt=$con->prepare("select * from posts order by id desc limit $startfrom,$per_page");
          $stmt->execute();
          $posts=$stmt->fetchAll();
          foreach($posts as $post){
              echo'    <tr>
          <td>'.$post['id'].'</td>
          <td>'.substr($post['title'],0,10).'</td>
          <td><img src="../'.$post['img'].'" class="img-rounded" width="80px" height="50px"></td>
          <td>'.$post['auther'].'</td>
          <td>'.$post['cat'].'</td>
          <td>'.$post['regdata'].'</td>
          <td><a href="../post.php?id='.$post['id'].'" class="btn btn-primary" target="_blank">مشاهده المقال</td>
          <td>';
              if( $post['status']=='derft'){
                  echo 
 '<a class="btn btn-info" href="posts.php?stuts=publish&post='.$post['id'].'&page='.$page.'">    نشر       </a>';
              }
              
              if( $post['status']=='publish'){
  echo '<a class="btn btn-warning" href="posts.php?stuts=derft&post='.$post['id'].'&page='.$page.'">تعطيل</a>';
              }
              
              echo'</td>
          <td><a href="editpost.php?post='.$post['id'].'" class="btn btn-warning ">تعديل</a></td>
          <td><a href="posts.php?delete='.$post['id'].'&page='.$page.'" class="btn btn-danger ">حذف</a></td>
         </tr>
              ';
          }
          
          
          ?>
          
  
      
      
      </tbody>
</table>
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
          <li ';if($page==$i){echo'class="active"';}echo'><a href="posts.php?page='.$i.'">'.$i.'</a></li>';
      }
       ?>
          
          </ul>
      
      </nav>
  </div>
</div>
        
        </article>
      
<?php
include 'inc/footer.php';

?>