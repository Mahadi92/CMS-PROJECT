            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>

                    <form action="search.php" method="post">

                        <div class="input-group">
                            <input name="search" type="text" class="form-control" placeholder="Enter your search...">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>

                    </form>               
                
                <!-- Log In -->
                <div class="well">
                   
                   <?php if(isset($_SESSION['user_role'])): ?>
                   
                    <h4>Log In as</h4><h2 class='bg-success'><?php echo $_SESSION['username']; ?> </h2>
                    <a href="includes/logout.php" class="btn btn-danger">Log Out</a>
                   
                   <?php  else: ?>
                    <h4>Log In</h4>

                    <form action="includes/login.php" method="post">

                        <div class="form-group">
                            <input name="username" type="text" class="form-control" placeholder="Enter Username">    
                        </div>
                        
                        <div class="input-group">
                            <input name="password" type="password" class="form-control" placeholder="Enter Password">
                            <span class="input-group-btn">
                                <button name="login" class="btn btn-primary" type="submit">Log In</button>
                            </span>
                        </div>    
                    </form>
                   <?php endif; ?>
                   
                   
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                
                                    //You can use "LIMIT 3" keyword, if you want to limit the category.
                                    //$query = "SELECT * FROM categories LIMIT 3";

                                    $query = "SELECT * FROM categories";
                                    $select_cetagories_sidebar = mysqli_query($db_connect, $query);
                                
                                    while($row = mysqli_fetch_assoc($select_cetagories_sidebar)){

                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];

                                        echo  "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";


                                          }    
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->

                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"?>

            </div>