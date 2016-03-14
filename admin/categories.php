<?php include "includes/admin_header.php"?>



    <div id="wrapper">



        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                        </h1>

                      <div class="col-xs-6">

                        <label for="cat_title">Category Title</label>
                        <form action="" method="post">
                        <div class="form group">
                            <input type="text" name="cat_title" class="form-control">
                        </div>
                        <div class="form group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Add category">
                        </div>
                    </form><!--exit category form-->
                        <form action="" method="post">
                         <div class="form group">
                        <label for="cat_title">Edit Category</label>

                        <?php
						if (isset($_GET['edit'])){
							$cat_id = $_GET['edit'];
							include "includes/update_categories.php";
						}?>
                        </div>
                        <div class="form group">
                            <input type="submit" name="update_category" class="btn btn-primary" value="Update Category">
                        </div>
                    </form>

                        </div><!-- exit column-xs-6-->
                    <div class="col-xs-6">
                      <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                    <th>Function</th>
								    <th>Function</th>
                                </tr>

						  </thead>
                            <tbody>
                                <tr>
			<?php insertCategories();?>
			<?php getCategories();?>
			<?php deleteCategory();?>
                                </tr>
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
