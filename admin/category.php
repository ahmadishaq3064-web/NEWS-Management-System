<?php 
include "header.php"; 
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <div class="table-responsive-wrap">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        include "config.php";
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        }
                        else{
                        $page=1;
                        }
                        $limit = 2;
                        $offset = ($page-1)*$limit;
                        $query = "select * from category order by category_id desc limit {$offset},{$limit}";
                        $sql = mysqli_query($conn,$query);
                        if(mysqli_num_rows($sql) > 0){
                        while($rows = mysqli_fetch_assoc($sql)){
                        ?>
                        <tr>
                            <td class='id'><?php echo $rows['category_id'] ?></td>
                            <td><?php echo $rows['category_name'] ?></td>
                            <td><?php echo $rows['post'] ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $rows['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $rows['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php }}?>
                    </tbody>
                </table>
                </div>

                <?php 
                $query1 = "select * from category";
                $sql1 = mysqli_query($conn,$query1); 
                if(mysqli_num_rows($sql1) > 0){
                $total_records = mysqli_num_rows($sql1);
                $limit = 2;
                $total_pages = ceil($total_records/$limit);
                echo "<ul class='pagination admin-pagination'>";
                if($page > 1){echo "<li><a href='category.php?page=".($page - 1)."'>PREV</a></li>";}
                for($i=1;$i<=$total_pages;$i++){
                if($i == $page){
                $active = "active";    
                }
                else{
                $active = ""; 
                }
                echo "<li class='{$active}'><a href='category.php?page=$i'>$i</a></li>";    
                }
                if($page != $total_pages){echo "<li><a href='category.php?page=".($page + 1)."'>NEXT</a></li>";}
                echo "</ul>";
                }
                ?>
                
                    
                    
                    
                
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
