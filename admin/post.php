<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>

                    <?php 
                    include "config.php";
                    $limit=3;
                    if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    }
                    else{
                    $page = 1;
                    }
                    $offset = ($page - 1) * $limit; 
                    if($_SESSION['role'] == '1'){
                    $query = "select * from post join category
                    on post.category = category.category_id
                    join user on post.author = user.user_id
                    order by post.post_id desc limit {$offset},{$limit}";
                    }elseif($_SESSION['role'] == '0'){
                    $query = "select * from post join category
                    on post.category = category.category_id
                    join user on post.author = user.user_id
                    where post.author = {$_SESSION['user_id']} 
                    order by post.post_id desc limit {$offset},{$limit}";  
                    }
                    
                    $sql = mysqli_query($conn,$query);
                    if(mysqli_num_rows($sql) > 0){
                    $serial = $offset + 1;
                    while($rows = mysqli_fetch_assoc($sql)){
                     
                    
                    ?>

                      <tbody>
                          <tr>
                              <td class='id'><?php echo $serial; ?></td>
                              <td><?php echo $rows['title'] ?></td>
                              <td><?php echo $rows['category_name'] ?></td>
                              <td><?php echo $rows['post_date'] ?></td>
                              <td><?php echo $rows['username'] ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $rows['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $rows['post_id'] ?>&cat_id=<?php echo $rows['category'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php 
                    $serial++;
                    }
                    }
                    ?>
                      </tbody>
                    
                  </table>
                  <ul class='pagination admin-pagination'>
                
                  <?php
                  $query1 = "select * from post"; 
                  $sql1 = mysqli_query($conn,$query1);
                  if(mysqli_num_rows($sql1)>0){
                  $total_records = mysqli_num_rows($sql1);
                  $limit = 2;  
                  $total_page = ceil($total_records/$limit); 
                  
                  
                  if($page>1){
                        echo "<li><a href='post.php?page=".($page-1)."'>PREV</a></li>"; 
                  }
                  
                  for($i=1;$i<=$total_page;$i++){
                    if($page == $i){
                    $active = "active";
                    }    
                    else{
                    $active = "";
                    }
                    echo "<li class='{$active}'><a href='post.php?page=$i'>$i</a></li>";
                  }
                if($page != $total_page){
                        echo "<li><a href='post.php?page=".($page+1)."'>NEXT</a></li>"; 
                  }
                
                  }
                  ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
