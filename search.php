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

           
            <!--  Custom search engine  -->
        
               <?php
               
                
                if(isset($_POST['submit'])){
                    
                $search = $_POST['search'];
  
                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
        
                $search_query = mysqli_query($db_connect, $query);
                
                //If u find any error u this thing helping u.
                
                if(!$search_query){
                    
                    dei("QUERY FAILD" . mysqli_error($db_connect));
                    
                    }
                   
                
                //To bring results from the post_tag
                
                $count = mysqli_num_rows($search_query);
                
                if($count == 0){
                    
                 echo "<h2>NO RESULT FOUND.</h2>";

                }
                else{
                    
              
                while($row = mysqli_fetch_assoc($search_query)){
                    
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
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

             <?php  } 
                    
                    
                }
                 
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
