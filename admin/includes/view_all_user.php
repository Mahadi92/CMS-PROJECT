<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>

            
        </tr>
    </thead>

    <tbody>

        <!-- USER TABLE-->
        <?php
                            
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($db_connect, $query);

        $i = 1;
        while($row = mysqli_fetch_assoc($select_users )){

            $user_id = escape($row['user_id']);
            $username = escape($row['username']);
            $user_password = escape($row['user_password']);
            $user_firstname = escape($row['user_firstname']);
            $user_lastname = escape($row['user_lastname']);
            $user_email = escape($row['user_email']);
            $user_image = escape($row['user_image']);
            $user_role = escape($row['user_role']);
            
            echo "<tr>";
            echo "<td>". $i++ . "</td>";;
            echo "<td>$username</td>";
            
//            //Displaing Category to post dynamically
//            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
//            $select_categories_id = mysqli_query($db_connect, $query);
//
//            while($row = mysqli_fetch_assoc($select_categories_id)){
//
//                $cat_id = $row['cat_id'];
//                $cat_title = $row['cat_title'];
//            
//            echo "<td>{$cat_title}</td>";
//            
//            }
//          
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
            
//            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
//            $select_post_id_query = mysqli_query($db_connect, $query);
//            
//            while($row = mysqli_fetch_assoc($select_post_id_query)){
//                
//            $post_id = $row['post_id'];    
//            $post_title = $row['post_title'];    
//                
//            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
//            }
            
            
           
            
  
            echo "<td><a class='btn btn-success' href='user.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a class='btn btn-warning' href='user.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
            echo "<td><a class='btn btn-info'href='user.php?source=edit_user&edit_user={$user_id}'><i class='fa fa-edit' style='font-size: 15px;'></a></td>";
            echo "<td><a class='btn btn-danger' href='user.php?delete={$user_id}'><i class='fa fa-trash' style='font-size: 15px;'></a></td>";
            echo "</tr>";

        }

        ?>



    </tbody>

</table>


<?php  
       

        //CHANGE TO ADMIN

        if(isset($_GET['change_to_admin'])){
            
            $get_user_id = escape($_GET['change_to_admin']);
            
            $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $get_user_id ";
            $approve_comment_query = mysqli_query($db_connect, $query);           
            header("Location: user.php");
        
        }        
        
        
        //CHANGE TO SUBSCRIBER

        if(isset($_GET['change_to_subscriber'])){
            
            $get_user_id = escape($_GET['change_to_subscriber']);
            
            $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $get_user_id ";
            $approve_comment_query = mysqli_query($db_connect, $query);           
            header("Location: user.php");
        
        }            


        //DELETE USERS

        if(isset($_GET['delete'])){

            if(isset($_SESSION['user_role'])){
                
                if($_SESSION['user_role']  == 'admin'){
            
                    $delete_user_id = escape($_GET['delete']);
                    
                    $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
                    $delete_user_query = mysqli_query($db_connect, $query);
                    header("Location: user.php");
                
                }
            }
        }
?>
