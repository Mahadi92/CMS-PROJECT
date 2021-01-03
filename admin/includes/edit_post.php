<?php

    if(isset($_GET['p_id'])){
        $get_post_id = $_GET['p_id'];
    
        $query = "SELECT * FROM posts WHERE post_id = '{$get_post_id}' ";
        $select_posts_by_id = mysqli_query($db_connect, $query);

        while($row = mysqli_fetch_assoc($select_posts_by_id )){

            $post_id = escape($row['post_id']);
            $post_user = escape($row['post_user']);
            $post_title = escape($row['post_title']);
            $post_category_id = escape($row['post_category_id']);
            $post_status = escape($row['post_status']);
            $post_image = escape($row['post_image']);
            $post_content = escape($row['post_content']);
            $post_tags = escape($row['post_tags']);
            $post_comments_count = escape($row['post_comment_count']);
            $post_date = escape($row['post_date']);
    }        
       
    }
            
    if(isset($_POST['update_post'])) {
        
        $post_user = escape($_POST['post_user']);
        $post_title = escape($_POST['post_title']);
        $post_category_id = escape($_POST['post_category']);
        $post_status = escape($_POST['post_status']);
     
        $post_image = escape($_FILES['image']['name']);
        $post_image_temp = escape($_FILES['image']['tmp_name']);
        
        $post_content = escape($_POST['post_content']);
        $post_tags = escape($_POST['post_tags']);
        
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        if(empty($post_image)){
            
            $query = "SELECT *FROM posts WHERE post_id = $get_post_id ";
            $select_image = mysqli_query($db_connect, $query);
            
            while($row = mysqli_fetch_assoc($select_image)){
                $post_image = $row['post_image'];
            }
            
        }
        
  
        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_user = '{$post_user}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$get_post_id} ";
        
        $update_query = mysqli_query($db_connect, $query);
        
        confirm($update_query);    
        
         echo "<h2 class='bg-success'>POST UPDATED.</h2>" . " " . "<a href='../post.php?p_id={$get_post_id}' class='btn btn-primary'>Visit Post</a>" . " <span >OR </span> " . "<a href='post.php' class='btn btn-primary'>Edit More Post</a>" ;
    }
            
            
            
            
            
?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label>
        
        <select class="selectpicker" name="post_category" id="">
           
       <?php  

        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($db_connect, $query);

       confirm($select_categories);

        while($row = mysqli_fetch_assoc($select_categories)){

            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];


            if($cat_id == $post_category_id){

                echo "<option selected value='{$cat_id}'>{$cat_title}</option>" ;

            }
            else{    
                
                echo  "<option value='$cat_id'>{$cat_title}</option>";
            }

        }

        ?>

           
        </select>
    </div>


 <div class="form-group">
     
         <label for="post_category">User</label>
        <select name="post_user" id="">
        <?php  
            echo  "<option value='$post_user'>$post_user</option>";    
        ?>
       
        <?php  

        $query = "SELECT * FROM users";
        $select_user = mysqli_query($db_connect, $query);

       confirm($select_user);

        while($row = mysqli_fetch_assoc($select_user)){

            $user_id = $row['user_id'];
            $username = $row['username'];


        echo  "<option value='$username'>$username</option>";
        }


        ?>
            
           
        </select>
    </div>


<!--
    <div class="form-group">
        <label for="post_user">Post Author</label>
        <input value="<?php// echo $post_user; ?>"type="text" class="form-control" name="post_user">
    </div>
-->

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" class="selectpicker" id="">

            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>

            <?php 

                 if($post_status == 'published'){

                    echo  "<option value='draft'>Draft</option>";

                 }else{

                     echo "<option value='published'>Published</option>" ;
                 }

                 ?>

        </select>

    </div>

<!--
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>"type="text" class="form-control" name="post_status">
    </div>
-->

    <div class="form-group">
       <label for="post_image">Post Image</label>
        <img width="100" src="../images/<?php  echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>"type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo str_replace('\r\n', '</br>', $post_content); ?> </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>