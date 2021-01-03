<?php 

include ("delete_modal.php");

    if(isset($_POST['checkBoxArray'])){

        foreach($_POST['checkBoxArray'] as $postValueId ){
                
            $bulk_option = $_POST['bulk_option'];
            
            switch($bulk_option){
                
                    case 'published':
                        
                        $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = '{$postValueId}' "; 
                        $update_to_published_status = mysqli_query($db_connect, $query) ;
                    
                    break;
                
                    case 'draft':
                        
                        $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = '{$postValueId}' "; 
                        $update_to_published_status = mysqli_query($db_connect, $query) ;
                    
                    break;
                
                    case 'delete':
                        
                        $query = "DELETE FROM posts WHERE post_id = {$postValueId}"; 
                        $update_to_published_status = mysqli_query($db_connect, $query) ;
                    
                    break;
                    
                    case 'clone':
                    
                    $query = "SELECT * FROM posts WHERE post_id= '{$postValueId}' ";
                    $select_post_query = mysqli_query($db_connect, $query);
                    
                    while($row = mysqli_fetch_assoc($select_post_query)){

                        $post_title = escape($row['post_title']);
                        $post_catagory_id = escape($row['post_category_id']);
                        $post_date = escape($row['post_date']);
                        $post_author = escape($row['post_author']);
                        $post_user = escape($row['post_user']);
                        $post_status = escape($row['post_status']);
                        $post_image = escape($row['post_image']);
                        $post_tags = escape($row['post_tags']);
                        $post_content = escape($row['post_content']);
                    
                        
                        if(empty($post_tags)){
                            
                            $post_tags = "No tag";                            
                        }
                        
                    }                            
            

                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status) ";

                    $query .= "VALUES({$post_catagory_id}, '{$post_title}', '{$post_author}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
                                          
                    $copy_query  =mysqli_query($db_connect, $query);
                    
                    if(!$copy_query){
                        die("<h1>QUERY FAILD</h1>" . mysqli_error($db_connect));
                    }
                    
                
                    break;      
            
            }
             
        }
        
        
    }


?>
      

   <form action="" method="post">
    <table class="table table-bordered table-hover">
    
    <div id="bulkOptionContainer" class="col-xs-4" style="padding: 0;">
   
        <select name="bulk_option" class="form-control" id="">
            <option value="">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
        
    </div>
    
    <div class="col-xs-4">
        
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="post.php?source=add_post">Add New</a>
        
    </div>
    

        <thead>
            <tr>
                   
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>No</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Pots views</th>
            
            </tr>
        </thead>

        <tbody>

            <!-- POST TABLE -->
            <?php
                            
        $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
        $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
        $query .= "FROM posts ";
        $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC ";
            
            
        $select_all_posts = mysqli_query($db_connect, $query);   
            
            $i = 1;
        while($row = mysqli_fetch_assoc($select_all_posts )){

            $post_id             = $row["post_id"];
            $post_author         = $row["post_author"];
            $post_user           = $row["post_user"];
            $post_title          = $row["post_title"];
            $post_category_id    = $row["post_category_id"];
            $post_status         = $row["post_status"];
            $post_image          = $row["post_image"];
            $post_tags           = $row["post_tags"];
            $post_comments_count = $row["post_comment_count"];
            $post_date           = $row["post_date"];
            $post_views_count    = $row["post_views_count"];
            $category_title      = $row['cat_title'];
            $category_id         = $row['cat_id'];
            

            echo "<tr>";
            ?>
            
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php  echo $post_id ; ?>"></td>
            
            <?php
            
            echo "<td>". $i++ . "</td>";
            
            if(!empty($post_author)){

                echo "<td>$post_author</td>";
                
            }
            elseif(!empty($post_user)){

                echo "<td>$post_user</td>";
                
            }
            
            
            echo "<td>{$post_title}</td>";
            
            //Displaing Category to post dynamically
        
            echo "<td>{$category_title}</td>";
            
            
            echo "<td>{$post_status}</td>";
            echo "<td><img width='100' src='../images/{$post_image}'></td>";
            echo "<td>{$post_tags}</td>";
            
            
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $send_comment_query = mysqli_query($db_connect, $query);
            
            while($row = mysqli_fetch_assoc($send_comment_query)){
                
                 $cmnt_id = $row['comment_id'];    
            }
            
            $count_comments = mysqli_num_rows($send_comment_query);
            
            echo "<td><a href='post_comment.php?id=$post_id'>{$count_comments}</a></td>";
    

            echo "<td>{$post_date}</td>";
            echo "<td><a class='btn btn-primary' href='../post.php?p_id=$post_id'>View Post</a></td>";
            echo "<td><a class='btn btn-info' href='post.php?source=edit_post&p_id=$post_id'><i class='fa fa-edit' style='font-size: 15px;'></a></td>";        
            echo "<td><a rel='$post_id' href='javascript:void(0)' class='btn btn-danger delete_link'><i class='fa fa-trash' style='font-size: 15px;'></i></a></td>";
            
            // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to Delete'); \" href='post.php?delete=$post_id'>Delete</a></td>";

            echo "<td><a href='post.php?reset=$post_id'>{$post_views_count}</a></td>" ;
            echo "</tr>";

        }

        ?>

            <!-- DELETE POST-->
            <?php  
        
            if(isset($_GET['delete'])){

                if(isset($_SESSION['user_role'])){

                    if($_SESSION['user_role']  == 'admin'){

                        $del_post_id = escape($_GET['delete']);

                        $query = "DELETE FROM posts WHERE post_id = {$del_post_id}";
                        $delete_post_query = mysqli_query($db_connect, $query);
                        header("Location: post.php");
                    }
                }
            }
            
            
            if(isset($_GET['reset'])){

                $reset_post_id = escape($_GET['reset']);

                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =".  mysqli_real_escape_string($db_connect, $reset_post_id) . "";
                $reset_query = mysqli_query($db_connect, $query);
                header("Location: post.php");

            }

        ?>



        </tbody>

    </table>


</form>

<script type="text/javascript">
    
    $(document).ready(function(){

        $(".delete_link").on('click', function(){

            var id = $(this). attr("rel");

            var delete_url = "post.php?delete=" + id +" ";

            $(".modal_delete_link").attr("href", delete_url);

            $("#myModal").modal('show');

        });
    });


</script>