<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';
$msg='';
if(isset($_GET['stuts']) && isset($_GET['post'])){
    $stmt=$con->prepare("update comment set status=? where id=?");
    $stmt->execute(array($_GET['stuts'],$_GET['post']));
}
if(isset($_GET['delete'])){
    $stmt=$con->prepare("delete from comment where id=?");
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
          <th>عنوان التعليق</th>
          <th>الكاتب</th>
          <th>التعليق</th>
          <th>تاريخ النشر</th>
          <th>مشاهدة</th>
          <th>الحالة</th>
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
    
          $stmt=$con->prepare("select * from
          comment c 
          
          order by c.id desc limit $startfrom,$per_page");
          $stmt->execute();
          $posts=$stmt->fetchAll();
          foreach($posts as $post){
              echo'    <tr>
          <td>'.$post['id'].'</td>
          <td>'.substr($post['title'],0,10).'</td>
          <td>'.$post['auther'].'</td>
          <td>'.$post['comment'].'</td>
          <td>'.$post['regdata'].'</td>
          <td><a href="../post.php?id='.$post['id_post'].'" class="btn btn-primary" target="_blank">مشاهده المقال</td>
          <td>';
              if( $post['status']=='derft'){
                  echo 
 '<a class="btn btn-info" href="comment.php?stuts=publish&post='.$post['id'].'&page='.$page.'">    نشر       </a>';
              }
              
              if( $post['status']=='publish'){
  echo '<a class="btn btn-warning" href="comment.php?stuts=derft&post='.$post['id'].'&page='.$page.'">تعطيل</a>';
              }
              
              echo'</td>
          <td><a href="comment.php?delete='.$post['id'].'&page='.$page.'" class="btn btn-danger ">حذف</a></td>
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
          <li ';if($page==$i){echo'class="active"';}echo'><a href="comment.php?page='.$i.'">'.$i.'</a></li>';
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