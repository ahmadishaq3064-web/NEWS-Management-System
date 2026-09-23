<?php include "header.php"; 
if($_SESSION['role'] == '0'){
header("location: http://localhost/NEWS-Management-System/admin/post.php");
}?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" autocomplete="off">
                    <?php 
                    if(isset($_POST['save'])){
                    include "config.php";
                    $cat_post = mysqli_real_escape_string($conn,$_POST['cat']);
                    $query = "insert into category (category_name) values ('{$cat_post}')";
                    if(mysqli_query($conn,$query)){
                    header("location: http://localhost/NEWS-Management-System/admin/category.php");
                    }
                    }
                    ?>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
