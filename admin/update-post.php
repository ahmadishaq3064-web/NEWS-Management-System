<?php 
include "header.php"; 
if($_SESSION['role'] == 0){
include "config.php";
$post_id = $_GET['id'];
$query2 = "select author from post where post_id = {$post_id}";
$sql2 = mysqli_query($conn,$query2);
$rows2 = mysqli_fetch_assoc($sql2);
if($_SESSION['user_id'] != $rows2['author']){
header("location: http://localhost/NEWS-Management-System/admin/post.php");
}}
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
         
         <?php 
        include "config.php";
        $post_id = $_GET['id'];
        $query = "select * from post join category on post.category = category.category_id
        join user on user.user_id = post.author where post.post_id = {$post_id}";
        $sql = mysqli_query($conn,$query);
        if(mysqli_num_rows($sql) > 0){
        while($rows = mysqli_fetch_assoc($sql)){
        ?>

        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $rows['post_id'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $rows['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                    <?php echo $rows['description'] ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">

                <?php 
                include "config.php";
                $query1 = "select * from category";
                $sql1 = mysqli_query($conn,$query1);
                if(mysqli_num_rows($sql1) > 0){
                while($rows1 = mysqli_fetch_assoc($sql1)){
                if($rows['category'] == $rows1['category_id']){
                $selected = "selected";
                }    
                else{
                $selected = "";
                }
                echo "<option {$selected} value='{$rows1['category_id']}'>{$rows1['category_name']}</option>";
                }
                }
                ?>  

                </select>
                <input type="hidden" name="old-category" value="<?php echo $rows['category'] ?>">
            </div>
            <div class="form-group">
                <label for=""></label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $rows['post_img'] ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $rows['post_img'] ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php }} ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
