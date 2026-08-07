<?php include "header.php"; 
if($_SESSION['role'] == '0'){
header("location: http://localhost/news-110-124/admin/post.php");
}?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Website Settings</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="save-setting.php" method ="POST" enctype="multipart/form-data">
                    <?php 
                    include "config.php";
                    $query = "select * from settings";
                    $sql = mysqli_query($conn,$query);
                    if(mysqli_num_rows($sql) > 0){   
                    while($rows = mysqli_fetch_assoc($sql)){
                    ?>
                          <div class="form-group">
                          <label>website Name</label>
                          <input type="text" name="websitename" class="form-control" value="<?php echo $rows['websitename'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                            <label for="logo">Website logo</label>
                            <input type="file" name="logo">
                            <img  src="images/<?php echo $rows['logo'];?>" >
                            <input type="hidden" name="old-image" value="<?php echo $rows['logo']; ?>">
                        </div>
                      <div class="form-group">
                          <label>Footer description</label>
                          <input type="text" name="footerdesc" class="form-control" value="<?php echo $rows['footerdesc'] ?>" placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="SAVE" required />
                      <?php }}?>
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
