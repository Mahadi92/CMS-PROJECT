<?php 
if(isset($_POST['creat_post'])){
    
    $post_title = escape($_POST['title']);
    $post_user = escape($_POST['post_user']);
    $post_catagory_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);
    
    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']);

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');


    move_uploaded_file($post_image_temp, "images/$post_image");
    
    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status)";
    
    $query .= "VALUES({$post_catagory_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
    
    $creat_post_query = mysqli_query($db_connect, $query);
    
    confirm($creat_post_query); 
    
    $get_post_id = mysqli_insert_id($db_connect);
    
     echo "<h2 class='bg-success'>POST ADDED.</h2>" . " " . "<a href='../post.php?p_id={$get_post_id}' class='btn btn-success'>Visit Post</a>" . " <span >OR </span> " . "<a href='post.php?source=add_post' class='btn btn-primary'>Add More Post</a>" ;
            
}


?>




<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

 <div class="form-group">
     
         <label for="post_category">Post Category</label>
        <select name="post_category" id="">
           
           <?php  
            
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($db_connect, $query);

           confirm($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)){

                $cat_id = escape($row['cat_id']);
                $cat_title = escape($row['cat_title']);
           
            
            echo  "<option value='$cat_id'>{$cat_title}</option>";
            }
            
           
            ?>
            
           
        </select>
    </div>

 <div class="form-group">
     
         <label for="post_category">User</label>
        <select name="post_user" id="">
           
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
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
-->

    <div class="form-group">
        <label for="post_status">Post Status</label>
          
           <select name="post_status" id="">
               <option value="draft">Select Post Status</option>
               <option value="published">Publish</option>
               <option value="draft">Draft</option>
           </select>
        
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="creat_post" value="Publish Post">
    </div>

</form>