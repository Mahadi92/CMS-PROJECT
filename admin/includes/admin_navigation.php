<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">MH Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
<!--               <li><a href="#">User Online: <?php //echo user_online(); ?> </a></li>-->
               
                <!-- Usesr Online Count -->
<!--                <li><a href="">Users Online: <span class="usersonline"></span></a></li>-->
               
               
               <li><a href="../index.php">HOME</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                    
                    <?php 
                        if(isset($_SESSION['username'])){
                            
                            echo $_SESSION['username'] ; 
                            
                        }
                    ?>

                        
                    
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fas fa-sign-out-alt" style="font-size: 20px;"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard" style="font-size: 20px;"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fas fa-clipboard" style="font-size: 20px;"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="post.php"><i class="fas fa-eye" style="font-size: 20px;"></i> View all posts</a>
                            </li>
                            <li>
                                <a href="post.php?source=add_post"><i class="fas fa-fw fa-plus-circle" style="font-size: 20px;"></i> Add Post</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="category.php"><i class="fas fa-list-alt" style="font-size: 20px;"></i> Categories</a>
                    </li>

                    <li>
                        <a href="comment.php"><i class="fas fa-comment" style="font-size: 20px;"></i> Comments</a>
                    </li>                    
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-user-circle" style="font-size: 20px;"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="user.php"><i class="fas fa-users-cog" style="font-size: 20px;"></i> View all Users</a>
                            </li>
                            <li>
                                <a href="user.php?source=add_user"> <i class="fas fa-user-plus" style="font-size: 20px;"></i> Add User</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="profile.php"><i class="fas fa-id-badge" style="font-size: 20px;"></i> Profile</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>