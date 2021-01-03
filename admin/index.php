<?php include "includes/admin_header.php"?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin Panel                        
                        <small><?php echo $_SESSION['username'] ; ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->


            <!--        DASEBOARD  -->

            <!-- POSTS -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right"> 
                                
                                    <div class='huge'><?php echo $post_counts = recordCount('posts') ; ?> </div>
                                      
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="post.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- COMMENTS -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                   
                                    <div class='huge'><?php echo $comment_counts = recordCount('comments') ; ?> </div>
                                   
                                     <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comment.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- USERS -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                   
                                    <div class='huge'><?php echo $user_counts = recordCount('users') ; ?> </div>
                                   
                                     <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="user.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- CATEGORIES -->
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  
                                   <div class='huge'><?php echo $category_counts = recordCount('users') ; ?> </div>
                                  
                                      <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="category.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php 

            $post_published_count = checkStatus('posts', 'post_status', 'published');
        
            $post_draft_count = checkStatus('posts', 'post_status', 'subscriber');
            
            $unapproved_comments_count = checkStatus('comments', 'comment_status', 'unapproved');
                       
            $subscriber_count = checkUsreRole('users', 'user_role', 'subscriber');
            
            
            
            ?>


            <div class="row">


                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count', {
                                role: "stytle"
                            }],

                            <?php 
                
//            echo "['MH SITE', 'Active Posts', 'Comments', 'Users', 'Category'], ";
//            echo "['', $post_counts, 0, 0, 0], ";
//            echo "['', 0, $comment_counts, 0, 0], ";
//            echo "['', 0, 0, $user_counts, 0], ";
//            echo "['', 0, 0, 0, $category_counts] ";

                
                $element_text = ['All Posts', 'Active Post', 'Draft Posts' ,'Comments', 'Pandding comments' , 'Users', 'Subscribers' ,'Category'];
                $element_count = [$post_counts, $post_published_count, $post_draft_count, $comment_counts, $unapproved_comments_count, $user_counts, $subscriber_count, $category_counts];
                            
                $element_color = ['#0288D1', '#76FF03', '#FF6F00', '#C2185B', '#9C27B0', '#F50057', '#4527A0', '#00E676'];
                            
            for($i = 0; $i < 8; $i++){
                
//                echo "['{$element_text[$i]}'" . "," . "'{$element_count[$i]}'" . "," . "'{$element_color[$i]}' ], " ;
             
                echo "['$element_text[$i]', $element_count[$i], '$element_color[$i]' ],  " ;
                
            }
                
            ?>
                        ]);

                        var options = {
                            chart: {
                                title: 'About all posts',
                                subtitle: 'Dashboard',

                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


            </div>



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"?>
    
   
  <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
  
  <script>

            $(document).ready(function(){


              var pusher =   new Pusher('a202fba63a209863ab62', {

                  cluster: 'us2',
                  encrypted: true
              });


         });

    
    </script>

