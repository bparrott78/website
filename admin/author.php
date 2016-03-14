<?php include "includes/admin_header.php"?>



    <div id="wrapper">



        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin <small>Author</small>
                        </h1>

                      <div class="col-xs-6">

                        <label for="author_name">Author Name</label>
                        <form action="" method="post">
                        <div class="form group">
                            <input type="text" name="author_name" class="form-control">
                        </div>
                        <div class="form group">
                            <input type="submit" name="add_author" class="btn btn-primary" value="Add Author">
                        </div>
                        <?php insertAuthor();?>
                    </form><!--exit category form-->
                        <form action="" method="post">
                         <div class="form group">
                        <label for="author_name">Edit Author</label>
						
                        <?php
						if (isset($_GET['edit'])){
							$author_id = $_GET['edit'];
							include "includes/update_author.php";
						}?>
                        </div>
                        <div class="form group">
                            <input type="submit" name="update_author" class="btn btn-primary" value="Update Author">
                        </div>
                    </form>

                        </div><!-- exit column-xs-6-->
                    <div class="col-xs-6">
                      <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Author ID</th>
                                    <th>Author Name</th>
                                    <th>Function</th>
								    <th>Function</th>
                                </tr>

						  </thead>
                            <tbody>
                                <tr>
		
			<?php 
				global $connection;
				$query = "SELECT * FROM authors";
				$select_authors = mysqli_query($connection,$query);
				while($row = mysqli_fetch_assoc($select_authors )) {
				$author_name = $row['author_name'];
				$author_id = $row['author_id'];
				echo "<tr>";
				echo "<td>{$author_id}</td>";
				echo "<td>{$author_name}</td>";
				echo "<td><a href='author.php?delete={$author_id}'>Delete</a></td>";;
				echo "<td><a href='author.php?edit={$author_id}'>Edit</a></td>";
				echo "</tr>";
				}?>
			<?php deleteAuthor();?>
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
