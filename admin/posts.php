<?php include "includes/admin_header.php"?>
<?php
				if (isset($_GET['source'])){
				$source=$_GET['source'];
				}else{
					$source='view_all_posts';
				}
?>
	<div id="wrapper">



		<?php include "includes/admin_navigation.php"?>

			<div id="page-wrapper">

				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
				
							<h1 class="page-header">
                         
                            Welcome to Posts <small>
                           <?php $title=$source;
					$title=str_replace('_', ' ',$title);
					$title=ucwords($title);
					echo $title;
								?>
                            </small>
                        </h1>
<?php					
				switch($source){
					case 'add_post';
						include "includes/add_post.php";
						break;
					case 'edit_post';
						include "includes/edit_post.php";
						break;
					default:
						include "includes/view_all_posts.php";
				}
	

					?>
						</div>
					</div>
					<!-- /.row -->

				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->
			<?php include "includes/admin_footer.php"?>