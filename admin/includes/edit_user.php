<?php 
    if(isset($_GET['edit_user'])){
    $get_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = '{$get_user_id}' ";
    $select_user_by_id = mysqli_query($db_connect, $query);

    while($row = mysqli_fetch_assoc($select_user_by_id )){
        
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        
    }        
       


if(isset($_POST['edit_user'])){
    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $post_date = date('d-m-y');


    
    
    if(!empty($user_password)){
        $query_password = "SELECT user_password FROM users WHERE user_id = $get_user_id"; 
        $get_user_query = mysqli_query($db_connect, $query_password);
        confirm($get_user_query);

        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row['user_password'];
        
    }

    if($db_user_password !== $user_password){
        
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        
    

        //UPDATE QUERY
        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "username = '{$username}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$hashed_password}' ";
        $query .= "WHERE user_id = {$get_user_id} ";

        $update_query = mysqli_query($db_connect, $query);

        confirm($update_query);      

         echo "<h2 class='bg-success'>USER UPDATED.</h2>" . " " . "<a href='user.php' class='btn btn-success'>View User</a>" ;
    
        }
    }
}else{
        header("Location: index.php");
    }

?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_author">First Name</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role" id="">

            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
        <?php 
        
            if($user_role == 'admin'){
              echo "<option value='subscriber'>Subscriber</option>" ;  

            }else{
                echo "<option value='admin'>Admin</option>" ;
            }
        
        ?>


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
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_tags">E-mail</label>
        <input value="<?php echo $user_email; ?>" type="text" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>

</form>