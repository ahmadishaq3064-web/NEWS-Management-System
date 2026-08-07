<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php 
                    if(isset($_GET['cid'])){
                    $cat_id = $_GET['cid'];    
                    }
                    $query1 = "select * from category where category_id = {$cat_id}";
                    $sql1 = mysqli_query($conn,$query1);
                    $row = mysqli_fetch_assoc($sql1);
                    ?>
                    <h2 class="page-heading"><?php echo $row['category_name'];?></h2>
                   <?php 
                    include "config.php";
                    if(isset($_GET['cid'])){
                    $cat_id = $_GET['cid'];    
                    } 
                    if(isset($_GET['pages'])){
                    $pages = $_GET['pages'];
                    }else{
                    $pages = 1;
                    }
                    $limit = 3;
                    $offset = ($pages - 1) * $limit;
                    $query = "select * from post join category on post.category = category.category_id 
                    join user on user.user_id = post.author where post.category = {$cat_id} order by post.post_id desc limit {$offset},{$limit} "; 
                    $sql = mysqli_query($conn,$query);
                    if(mysqli_num_rows($sql) > 0){
                    while($rows = mysqli_fetch_assoc($sql)){
                    ?> 
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $rows['post_id']; ?>"><img src="admin/upload/<?php echo $rows['post_img']?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $rows['post_id']; ?>'><?php echo $rows['title'] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $rows['category'] ?>'><?php echo $rows['category_name'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $rows['author'] ?>'><?php echo $rows['username'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                               <?php echo $rows['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo substr($rows['description'],0,10) ."..."  ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $rows['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                        <?php }} 
                        if(mysqli_num_rows($sql1)>0){
                        $total_record = $row['post'];
                        $limit = 3; 
                        $total_pages = ceil($total_record/$limit);
                        echo "<ul class='pagination'>"; 
                        if($pages>1){
                        echo "<li><a href='index.php?cid=".$cat_id."&pages=".($pages - 1)."'>PREV</a></li>";    
                        }  
                        for($i=1;$i<=$total_pages;$i++){
                        if($pages == $i){
                        $active = "active";
                        }
                        else{
                        $active = "";
                        }    
                        echo "<li class='{$active}'><a href='index.php?cid=".$cat_id."&pages=$i'>$i</a></li>";
                        }
                        if($pages != $total_pages){
                        echo "<li><a href='index.php?cid=".$cat_id."&pages=".($pages + 1)."'>NEXT</a></li>";    
                        } 
                        } 
                        ?>
                        </ul>
                            
                        
                </div>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
