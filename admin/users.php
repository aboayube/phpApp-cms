<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';
$msg='';
if(isset($_GET['delete'])){
    $stmt=$con->prepare("delete from users where id=?");
    $stmt->execute(array($_GET['delete']));
$msg= '<div class="alert alert-danger">تم الحذف بنجاح</div>';

}
?>
    <article class="col-lg-9">
        <div class="row">
        <div class="col-md-12">
               <div class="panel panel-info">
  <div class="panel-heading">التصنيفات</div>    
<?php echo $msg?>    
  <div class="panel-body">
      <table class="table table-hover">
  <tr>
      <thead><tr>
          <th>#الرقم</th>
          <th>الصورة الرمزية</th>
          <th>اسم العضو</th>
          <th>البريد الالكتروني</th>
          <th>الجنس</th>
          <th>صفحة الشخصية</th>
          <th>تعديل البيانات</th>
          <th>حذف</th>
         </tr>
          </thead>
      
      <tbody class="top">
          <?php
    
    //عمل تعدد صفحات
    $per_page=5;
          if(!isset($_GET['page'])){
              $page=1;
          }else{
              $page=intval($_GET['page']);
          }
          $startfrom=($page-1)*$per_page;
    
          $stmt=$con->prepare("select * from users order by id desc limit $startfrom,$per_page");
          $stmt->execute();
          $users=$stmt->fetchAll();
          foreach($users as $user){
              echo'    <tr>
          <td style=" padding-top:20px;">'.$user['id'].'</td>
          <td ><img src="../'.$user['img'].'"  class="img-rounded" width="80px" height="50px"></td>
          <td  style="    padding-top:20px;">'.$user['username'].'</td>
          <td style="    padding-top:20px;">'.$user['email'].'</td>
          <td style="    padding-top:20px;">';if($user['gender']==1){ echo 'ذكر';}else{ echo 'انثي'; } echo'</td>
          <td style="    padding-top:20px;"><a href="" target="_blank">صفحة الشخصية</a></td>
   <td style="    padding-top:20px;"> <a href="editusers.php?user='.$user['id'].'" class="btn btn-warning  ">تعديل</a></td>
<td style="    padding-top:20px;"><a href="users.php?delete='.$user['id'].'" class="btn btn-danger ">حذف</a></td>
         </tr>
              
              ';
          }
          
          
          ?>
          
  
      
      
      </tbody>
</table>
      <?php
      $stmt=$con->prepare("select count(id) from users");
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
          <li ';if($page==$i){echo'class="active"';}echo'><a href="users.php?page='.$i.'">'.$i.'</a></li>';
      }
       ?>
          
          </ul>
      
      </nav>
  </div>
</div>
            </div>
        
        </div>
     
</article>
      
<?php
include 'inc/footer.php';

?>