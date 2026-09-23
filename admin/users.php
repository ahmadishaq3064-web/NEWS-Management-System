<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                <?php 
                include "config.php";
                if(isset($_GET['page'])){
                $page = $_GET['page'];
              }
              else{
              $page = 1;
              }
                $limit = 3;
                $offset = ($page - 1) * $limit;
                $query = "select * from user order by user_id desc limit {$offset},{$limit}"; 
                $sql = mysqli_query($conn,$query);   
                if(mysqli_num_rows($sql) > 0){ 
                ?>
                  <div class="table-responsive-wrap">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php 
                        while($rows = mysqli_fetch_assoc($sql)){
                        ?> 
                          <tr>
                              <td class='id'><?php echo $rows['user_id'] ?></td>
                              <td><?php echo $rows['first_name'] . " " . $rows['last_name'] ?></td>
                              <td><?php echo $rows['username']?></td>
                              <td><?php  if($rows['role'] == 1){
                                echo "admin"; 
                              }
                              else{
                              echo "normal user";      
                              } 
                              ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $rows['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $rows['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          
                        <?php } ?>  
                      </tbody>
                  </table>
                  </div>
                  <?php } 
                  $query1 = "select * from user";
                  $sql1 = mysqli_query($conn,$query1);
                  if(mysqli_num_rows($sql1) > 0){
                  $total_records = mysqli_num_rows($sql1);
                  $limit = 3;
                  $total_pages = ceil($total_records/$limit);
                  echo "<ul class='pagination admin_pagination'>";
                  if($page>1){
                  echo "<li><a href='users.php?page=".($page-1)."'>PREV</a></li>";
                  }
                  for($i=1;$i<=$total_pages;$i++){
                  if($i == $page){
                  $active = "active"; 
                  }
                  else{
                  $active = "";  
                  }
                echo "<li class = '$active'><a href='users.php?page=$i'>$i</a></li>";
              }
              if($page != $total_pages){
                  echo "<li><a href='users.php?page=".($page+1)."'>NEXT</a></li>";
                  }
                  echo "</ul>";
                  }
                  ?>
                  
                      
                      
                  
              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
