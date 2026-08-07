<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
            include "config.php";
            $query = "select * from settings";
            $sql = mysqli_query($conn,$query);
            if(mysqli_num_rows($sql) > 0){   
            while($rows = mysqli_fetch_assoc($sql)){
            echo "<span>".$rows['footerdesc']."</span>";    
            }}
            ?>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
