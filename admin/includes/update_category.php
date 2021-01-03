<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        
        <?php  
                            
        // Edit data in Category 

        if(isset($_GET['edit'])){

            $edit_cat_id = escape($_GET['edit']);
            $query = "SELECT * FROM categories WHERE cat_id = {$edit_cat_id} ";
            $edit_query = mysqli_query($db_connect, $query);

            if(!$edit_query){
                die("<h1>QUERY fAILD</h1>" . mysqli_error($db_connect));
            }

            while($row = mysqli_fetch_assoc($edit_query)){

                $cat_id = escape($row['cat_id']);
                $cat_title = escape($row['cat_title']);

        ?>
        <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">

        <?php                                      
                }

            }

        ?>

        <?php 
                                    
        /////// UPDATE DATA

        if(isset($_POST['update_category'])){

            $update_cat_title = escape($_POST['cat_title']);

            $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = '{$cat_id}' ";
            $update_query = mysqli_query($db_connect, $query);

            if(!$update_query){
                echo "<h1>QUERY FAILD.</h1>" . mysqli_error($db_connect);
            }

        }



        ?>

    </div>
    <div class="form-group">
        <input class="btn btn-success" type="submit" name="update_category" value="Update Cetegory">

    </div>
</form>