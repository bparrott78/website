<?php
	if (isset($_GET['c_id'])){

	$the_comment_id = $_GET['c_id'];


	$query="SELECT * FROM comments WHERE comment_id = {$the_comment_id}";
	$get_comments = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($get_comments)) {
	$comment_id = $row['comment_id'];
	$comment_post_id = $row['comment_post_id'];
	$comment_author = $row['comment_author'];
	$comment_email = $row['comment_email'];
	$comment_content = $row['comment_content'];
	$comment_status = $row['comment_status'];
	$comment_date = $row['comment_date'];
	}
}

	if(isset($_POST['update_comment'])){
		$comment_id=$the_comment_id;
		$comment_post_id=$_POST['comment_post_id'];
		$comment_author=$_POST['comment_author'];
		$comment_content=$_POST['comment_content'];
		$comment_status=$_POST['comment_status'];
		$comment_date=date('Y-m-d');
		
		$query ="UPDATE comments SET ";
		$query .="comment_id = '{$the_comment_id}', ";
		$query .= "comment_post_id = '{$comment_post_id}', ";
		$query .= "comment_author = '{$comment_author}', ";
		$query .= "comment_email = '{$comment_email}', ";
		$query .= "comment_content = '{$comment_content}', ";
		$query .= "comment_status = '{$comment_status}', ";
		$query .= "comment_date = '{$comment_date}' ";
		$query .= "WHERE comment_id = '{$the_comment_id}' ";
		 
		$updateQuery=mysqli_query($connection,$query);
		confirmQuery($updateQuery);
		if(!$updateQuery){
			die("Query failed ") . mysqli_error($connection);
		}else{
		header("Location: comments.php");
		}
	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<label for="comment_post_id">Comment Post ID</label>
	<div class="form-group">
		<input value="<?php echo $comment_post_id?>" type="text" name="comment_post_id" class="form-control">
	</div>
	<label for="comment_author">Comment Author</label>
	<div class="form-group">
		<input value="<?php echo $comment_author?>" type="text" name="comment_author" class="form-control">
	</div>
	<label for="comment_email">Comment Email</label>
	<div class="form-group">
		<input value="<?php echo $comment_email?>" type="text" name="comment_email" class="form-control">
	</div>
	<label for="post_content">Comment Content</label>
	<div class="form-group">
		<textarea name="comment_content" class="form-control" rows="10"><?php echo $comment_content?></textarea>
	</div>
	
	<label for="comment_status">Comment Status</label>
	<div class="form-group">
		<select class="btn btn-primary" id="comment_status" name="comment_status">
			<option value="unapproved" <?php if($comment_status == 'unapproved'){echo 'selected';}?>>Unapproved</option>
			<option value="approved" <?php if($comment_status == 'approved'){echo 'selected';}?>>Approved</option>
		</select>
	</div>
	<input class="btn btn-primary" type="submit" value="Update Comment" name="update_comment">
</form>