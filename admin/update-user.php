<?php include "header.php"; 
if($_SESSION['role'] == '0'){
header("location: http://localhost/NEWS-Management-System/admin/post.php");
}
if(isset($_POST['submit'])){
include "config.php";
$user_id = mysqli_real_escape_string($conn,$_POST['user_id']);
$first_name = mysqli_real_escape_string($conn,$_POST['f_name']);
$last_name = mysqli_real_escape_string($conn,$_POST['l_name']);
$username = mysqli_real_escape_string($conn,$_POST['username']);
$role = mysqli_real_escape_string($conn,$_POST['role']);
$query = "update user set first_name = '{$first_name}',last_name = '{$last_name}',username = '{$username}',role = '{$role}' where user_id = {$user_id}"; 
if(mysqli_query($conn,$query)){
header("location: http://localhost/NEWS-Management-System/admin/users.php");
}
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                    <?php 
                    include "config.php";
                    $user_id = $_GET['id'];
                    $query = "select * from user where user_id = {$user_id}";
                    $sql = mysqli_query($conn,$query);
                    if(mysqli_num_rows($sql) > 0){   
                    while($rows = mysqli_fetch_assoc($sql)){
                    ?>
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $rows['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $rows['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $rows['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $rows['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">

                            <?php  
                            if($rows['role'] == 1){
                            echo "<option value='0'>normal User</option>
                            <option value='1' selected>Admin</option>"; 
                            }
                            else{
                            echo "<option value='0' selected >normal User</option>
                            <option value='1' >Admin</option>";     
                            } 
                            ?> 
                              
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                      <?php }}?>
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
