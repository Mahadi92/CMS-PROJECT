<?php 
if(isset($_POST['creat_user'])){
    
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $username = escape($_POST['username']);
    $user_role = escape($_POST['user_role']);

    
//    $post_image = $_FILES['image']['name'];
//    $post_image_temp = $_FILES['image']['tmp_name'];
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);

//    $post_date = date('d-m-y');

//    move_uploaded_file($post_image_temp, "images/$post_image");
    
    
    $user_password = password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 10));
    
    $query = "INSERT INTO users(user_firstname, user_lastname, username, user_role, user_email, user_password)";
    
    $query .= "VALUES( '{$user_firstname}', '{$user_lastname}', '{$username}', '{$user_role}', '{$user_email}', '{$user_password}') ";
    
    $creat_user_query = mysqli_query($db_connect, $query);
    
    confirm($creat_user_query);
    
    
    echo "<h2>USER ADDED.</h2>" . " " . "<a href='user.php' class='btn btn-primary'>View User</a>" ;
    
    
}


?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_author">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
          <option value="subscriber">Select Option</option>
          <option value="admin">Admin</option>
          <option value="subscriber">Subscriber</option>
           
        </select>
    </div>
    

<!--
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>
-->

    <div class="form-group">
        <label for="post_content">Username</label>
        <input type="text" class="form-control" name="username"> 
    </div>
    
    <div class="form-group">
        <label for="post_tags">E-mail</label>
        <input type="text" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="creat_user" value="Add User">
    </div>

</form>