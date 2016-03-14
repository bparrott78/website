<?php include "includes/admin_header.php"?>
<?php
	global $connection;
if(isset($_GET['delete'])){
	$the_comment_id=$_GET['delete'];
	$post_id="SELECT comment_post_id FROM comments WHERE comment_id = '{$the_comment_id}'";
	$result=mysqli_query($connection,$post_id);
	while($row=mysqli_fetch_assoc($result)){
		$comment_post_id=$row['comment_post_id'];
	}
	decrementComments($comment_post_id);
	$query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
	$delete_query=mysqli_query($connection,$query);

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
                            Welcome to Admin <small>Author</small>
                        </h1>

							<?php
				if (isset($_GET['source'])){
				$source=$_GET['source'];
				}else{
					$source='';
				}
				switch($source){
					case 'add_comment';
						include "includes/add_comment.php";
						break;
					case 'edit_comment';
						include "includes/edit_comment.php";
						break;
					default:
						include "includes/view_all_comments.php";
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