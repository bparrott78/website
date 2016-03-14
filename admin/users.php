<?php include "includes/admin_header.php"?>
<?php
				if (isset($_GET['source'])){
				$source=$_GET['source'];
				}else{
					$source='view_all_users';
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
                            Users <small>
				<?php $title=$source;
					$title=str_replace('_', ' ',$title);
					$title=ucwords($title);
					echo $title;
								?>
		
	</small>
                        </h1>
<?php switch($source){
					case 'add_user';
						include "includes/add_user.php";
						break;
					case 'edit_user';
						include "includes/edit_user.php";
						break;
					default:
						include "includes/view_all_users.php";
						
				}
?>
<?php deleteUser();?>
							
	

						</div>
					</div>
					<!-- /.row -->

				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->
			<?php include "includes/admin_footer.php"?>
			