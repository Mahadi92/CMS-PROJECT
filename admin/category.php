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
                        Welcome to Admin Panel.
                        <small>Author</small>
                    </h1>

                    <div class="col-xs-6">

                        <!-- Add Data in Category -->
                        <?php insert_category(); ?>
                        
                        <!-- DELETE DATA FROM CATEGORY -->
                        <?php delete_category() ?>


                        <!-- THIS FORM FOR ADD DATA -->

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Cetegory">

                            </div>
                        </form>


                        <!-- EDIT AND UPDATE DATA -->
                        <?php  
                        
                        if(isset($_GET['edit'])){
                            
                            $cat_id = $_GET['edit'];
                            include "includes/update_category.php";
                            
                        }
  
                        ?>
                     
                    </div>

                    <!-- Category table -->
                    <div class="col-xs-4">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <!-- CATEGORY TABLE -->
                                <?php category_table() ?>

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"?>