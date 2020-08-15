<?php 
include_once 'connect.php';
include_once 'include/header.php';
include_once 'include/asidpar.php';


$stmt=$con->prepare("select * from setting");
$stmt->execute();
$setting=$stmt->fetch();
?>
		
		<article class="col-md-9 col-lg-9 art_bg">
		<!-- start carousel -->
		
		<div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: 20px; margin-bottom: 30px;">
    
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
      <?php
          $stmt=$con->prepare("select * from posts where status='publish' order by id desc limit 0,4");
          $stmt->execute(array());
          $x=0;
          while($post=$stmt->fetch()){
           
          ?>
        <div class="item <?php if($x==0){echo 'active';}?>">
          <img src="<?php echo $post['img']?>" width="100%" style="height:350px">
           <div class="carousel-caption">
            <h3 class="carousel-h3"><a href="post.php?id=<?php echo $post['id']?>" style="color:#fff"><?php echo $post['title']?></a></h3>
            <p><?php echo $post['post']?></p>
          </div>
        </div><!-- End Item -->
 
       <?php
          $x++;
          }?>

                
      </div><!-- End Carousel Inner -->


    	<ul class="nav nav-pills nav-justified sliddd">
         
   <?php
            for($i=0;$i<5;$i++){
 echo ' <li data-target="#myCarousel" data-slide-to="'.$i.'" class="';if($i==0){echo 'active';}
     echo'"><a href="#"><i class="fas fa-star"></i></a></li>';
            }
            
            ?>
        </ul>


    </div>
	<!-- End Carousel -->
	
	<hr />
	
	<!-- category A -->
	<div class="row">
      
	<h2 class="tit_cat1">القسم الثاني</h2>
          <?php
        $stmt=$con->prepare('select * from posts where cat=3 and status="publish"  limit 5');
        $stmt->execute();
        $posts=$stmt->fetchAll();
    foreach($posts as $post){
        echo '
        <div class="col-sm-4 col-md-4" style="margin-bottom: 20px">
            <div class="post">
                <div class="post-img-content">
                    <img src="'.$post['img'].'" class="img-responsive" style="width: 100%;height: 200px;"/>
                    <span class="post-title"><b>العنوان الخاص بالمقال هنا</b>
                </div>
                <div class="content">
                    <div class="author">
                        بواسطة <a href="profile.php?user=2"><b>'.$post['auther'].'</b></a> |
                        بتاريخ <time datetime="2014-01-20">'.$post['regdata'].'</time>
                    </div>
                    <div class="text-justify">
                     '.strip_tags(substr($post['post'],0,50)).'
                    </div>
					<hr />
                    <div class="text-left">
                        <a href="#" class="btn btn-warning btn-sm">اقرأ المزيد &larr;</a>
                    </div>
                </div>
            </div>
        </div>

        
        ';
    }
        
        ?>


	</div> 
<hr />
	<!-- end category A -->
		<!-- tab -->
			<div class="col-md-12">
			<div class="row">
				<div class="tabbable-panel">
					<div class="tabbable-line">
						<ul class="nav nav-tabs ">
							<li class="active">
								<a href="#tab_default_1" data-toggle="tab">
								<?php echo $setting['tab1']?> </a>
							</li>
							<li>
								<a href="#tab_default_2" data-toggle="tab">
								<?php echo $setting['tab2']?> </a>
							</li>
							<li>
								<a href="#tab_default_3" data-toggle="tab">
								<?php echo $setting['tab3']?> </a>
							</li>
						</ul>
						<div class="tab-content">
                            
							<div class="tab-pane active" id="tab_default_1">
                                <?php
                            
                                  
                        $stmt=$con->prepare("select * from posts where status='publish' and cat=3 order by id desc limit 3");
                        $stmt->execute(array());
                        $tabs=$stmt->fetchAll();
                        
                            foreach($tabs as $tab){
                                echo '	<div class="bg_tab_topic">
									<div class="col-md-3">
											<img src="	'.$tab['img'].'" class="img-responsive" style="width: 100%;height: 150px;" />
										</div>
										<div class="col-md-9">
										<h3 class="col-md-12 text-justify" style="margin-top: 8px;background: #009688;padding: 8px;">
											<a href="#" class="a_1"> 	'.$tab['title'].'</a>
										</h3>
										<p class="col-md-12 text-justify">
										'.$tab['post'].'
										</p>
										</div>
									<div class="clearfix"></div>
								</div>';}
                            ?>
							</div>
							<div class="tab-pane" id="tab_default_2">
       <?php
                            
                                  
                        $stmt=$con->prepare("select * from posts where status='publish' and cat=2 order by id desc limit 3");
                        $stmt->execute(array());
                        $tabs=$stmt->fetchAll();
                        
                            foreach($tabs as $tab){
                                echo '	<div class="bg_tab_topic">
									<div class="col-md-3">
											<img src="	'.$tab['img'].'" class="img-responsive" style="width: 100%;height: 150px;" />
										</div>
										<div class="col-md-9">
										<h3 class="col-md-12 text-justify" style="margin-top: 8px;background: #009688;padding: 8px;">
											<a href="#" class="a_1"> 	'.$tab['title'].'</a>
										</h3>
										<p class="col-md-12 text-justify">
										'.$tab['post'].'
										</p>
										</div>
									<div class="clearfix"></div>
								</div>';}
                            ?>
							
								
								

								
								
							</div>
							<div class="tab-pane" id="tab_default_3">
                                   <?php
                            
                                  
                        $stmt=$con->prepare("select * from posts where status='publish' and cat=4 order by id desc limit 3");
                        $stmt->execute(array());
                        $tabs=$stmt->fetchAll();
                        
                            foreach($tabs as $tab){
                                echo '	<div class="bg_tab_topic">
									<div class="col-md-3">
											<img src="	'.$tab['img'].'" class="img-responsive" style="width: 100%;height: 150px;" />
										</div>
										<div class="col-md-9">
										<h3 class="col-md-12 text-justify" style="margin-top: 8px;background: #009688;padding: 8px;">
											<a href="#" class="a_1"> 	'.$tab['title'].'</a>
										</h3>
										<p class="col-md-12 text-justify">
										'.$tab['post'].'
										</p>
										</div>
									<div class="clearfix"></div>
								</div>';}
                            ?>
							
								
			</div>
			<!-- end Tabs -->

			<!-- start category B -->
			<div class="col-lg-12">
			<h2 class="tit_cat2"><?php echo $setting['sec2']?></h2>
			<div class="row  bg_cat2">
                   <?php
                            
                                  
                        $stmt=$con->prepare("select * from posts where status='publish' and cat=2 order by id desc limit 4");
                        $stmt->execute(array());
                        $tabs=$stmt->fetchAll();
                        
                            foreach($tabs as $tab){
                                echo '	<div class="bg_tab_topic col-md-6">
                    
					<div class="col-md-4">
						<img src="'.$tab['img'].'" width="100%" class="circle" />
					</div>
					<div class="col-md-8">
						<h3 class="col-md-12 text-justify" style="margin-right: -30px;margin-top: 8px;">
							<a href="post.php?id='.$tab['id'].'">'.$tab['title'].'</a>
						</h3>
					</div>
					<div class="clearfix"></div>
				</div>
				
				'
				;}
                            ?>
							
				
				
				<div class="clearfix"></div>
			</div>
			</div>
			<!-- end category B -->
		</article>
<?php include_once 'include/footer.php';?>