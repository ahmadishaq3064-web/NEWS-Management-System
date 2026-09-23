<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                   <div class="post-container">
                   <?php 
                    include "config.php";
                    $post_id = $_GET['id'];    
                    $query = "select * from post join category on post.category = category.category_id 
                    join user on user.user_id = post.author where post_id = {$post_id}"; 
                    $sql = mysqli_query($conn,$query);
                    if(mysqli_num_rows($sql) > 0){
                    while($rows = mysqli_fetch_assoc($sql)){
                    ?> 
                    
                        <div class="post-content single-post">
                            <h3><?php echo $rows['title'] ?></h3>
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
                            <img class="single-feature-image" src="admin/upload/<?php echo $rows['post_img']?>" alt=""/>
                            <p class="description">
                               <?php echo $rows['description'] ?>
                            </p>
                        </div>
                    </div>
                    <?php }} ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
