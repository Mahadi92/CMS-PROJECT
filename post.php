<!--Database Connect-->
<?php include "includes/db.php";?>

<!--Header-->
<?php include "includes/header.php";?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
                
                if(isset($_GET['p_id'])){
                    
                    $get_post_id = $_GET['p_id'];
                    
                    $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $get_post_id ";
                    $send_query = mysqli_query($db_connect, $view_query);
                    if(!$send_query){
                        die('<h1>QUERY FAILD</h1>' . mysqli_error($db_connect));
                    }
                
                //Dynamically insert data
                    
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    
                    $query = "SELECT * FROM posts WHERE post_id = $get_post_id ";     
                
                }else{
                    
                    $query = "SELECT * FROM posts WHERE post_id = $get_post_id AND post_status == 'published' ";
                    
                }
   
                $select_all_posts_query = mysqli_query($db_connect, $query);
                    
                if(mysqli_num_rows($select_all_posts_query) < 1){

                    echo "<h1 class='text-center'>No post Available!!!</h1>";
                
                }else{
                
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                
                ?>


            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>

            <hr>

            <?php 
                }    
            ?>


            <!-- Blog Comments -->

            <?php  
                
                if(isset($_POST['create_comment'])){
                    
                    $get_post_id = $_GET['p_id'];
                    
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                        
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $query.= "VALUES ($get_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved', now())";
                    
                        $create_comment_query = mysqli_query($db_connect, $query);
                    
                        if(!$create_comment_query){
                        
                            die('<h1>QUERY FAILD</h1>' . mysqli_error($db_connect));
                        
                        }
                    
//                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
//                        $query .= "WHERE post_id = $get_post_id";
//                        $update_comment_count_query = mysqli_query($db_connect, $query);                 
//                        
                        
                        
                    }else{
                        
                        echo "<script>alert('Fild cannot be empty')</script>" ;
                        
                    }
                    
 
                }
                
                ?>


            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input type="text" class="form-control" name="comment_author" placeholder="Enter your Name...">
                    </div>

                    <div class="form-group">
                        <label for="comment_email">E-mail</label>
                        <input type="email" class="form-control" name="comment_email" placeholder="Enter your e-mail...">
                    </div>

                    <div class="form-group">
                        <textarea name="comment_content" class="form-control" rows="3" placeholder="Enter your comment here..."></textarea>
                    </div>
                    <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php  
                
                $query = "SELECT * FROM comments WHERE comment_post_id = {$get_post_id} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($db_connect, $query);
                if(!$select_comment_query){
                    die('APPROVE QUERY FAILD' . mysqli_error($db_connect));
                }
                   while($row = mysqli_fetch_assoc($select_comment_query)){
                       
                       $comment_date = $row['comment_date'];
                       $comment_content = $row['comment_content'];
                       $comment_author = $row['comment_author'];
                    
               ?>


            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>


            <?php } } }else{
                    header("Location: index.php");
                }
            ?>






        </div>



        <!-- Sidebar-->
        <?php include "includes/sidebar.php";?>


    </div>
    <!-- /.row -->

    <hr>

    <!--   Footer-->
    <?php include "includes/footer.php";?>