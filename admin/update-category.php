<?php include "header.php";
if($_SESSION['role'] == '0'){
header("location: http://localhost/news-110-124/admin/post.php");
}
if(isset($_POST['submit'])){
include "config.php";
$cat_id = mysqli_real_escape_string($conn,$_POST['cat_id']);
$cat_post = mysqli_real_escape_string($conn,$_POST['cat_name']);
$query = "update category set category_name = '{$cat_post}' where category_id = {$cat_id}";
if(mysqli_query($conn,$query)){
header("location: http://localhost/news-110-124/admin/category.php");
}
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method ="POST">
                    <?php 
                          include "config.php";
                          $cat_id = $_GET['id'];
                          $query = "select * from category where category_id = '{$cat_id}'";
                          $sql = mysqli_query($conn,$query);
                          if(mysqli_num_rows($sql) > 0){
                          while($rows = mysqli_fetch_assoc($sql)){
                          ?>
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $rows['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $rows['category_name'] ?>"  placeholder="" required>
                          <?php }} ?> 
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
