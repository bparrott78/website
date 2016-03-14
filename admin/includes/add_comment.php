
<?php 
global $connection;
if(isset($_POST['create_comment'])){
		$comment_id=null;
		$comment_post_id=$_POST['comment_post_id'];
		$comment_author=$_POST['comment_author'];
		$comment_email=$_POST['comment_email'];
		$comment_content=$_POST['comment_content'];
		$comment_status=$_POST['comment_status'];
		$comment_date=date('Y-m-d');
	
		$query="INSERT INTO comments(comment_post_id, comment_author,comment_email,comment_content,comment_status,comment_date) VALUES ('{$comment_post_id}','{$comment_author}','{$comment_email}','{$comment_content}','{$comment_status}','{$comment_date}')";
		$createQuery=mysqli_query($connection,$query);
		confirmQuery($createQuery);
		if(!$createQuery){
			die("Query failed ") . mysqli_error($connection);
		}else{
			header("Location: comments.php");
		
		}
	}
?>
<form action="" method="post" enctype="multipart/form-data">
	<label for="comment_post_id">Comment Post ID</label>
	<div class="form-group">
	<select class="btn btn-primary" id="post_comment_id" name="comment_post_id">
<?php //get all post ids
	global $connection;
	$post_id_query="SELECT * FROM posts";
	$result=mysqli_query($connection,$post_id_query);
	while($row=mysqli_fetch_assoc($result)){
		$post_id=$row['post_id'];
		echo "<option value='{$post_id}'>$post_id</option>";
	}
?></select>
<!--		<input type="text" name="comment_post_id" class="form-control">-->
	</div>
	<label for="comment_author">Comment Author</label>
	<div class="form-group">
		<input type="text" name="comment_author" class="form-control">
	</div>
	<label for="comment_email">Comment Email</label>
	<div class="form-group">
		<input type="text" name="comment_email" class="form-control">
	</div>
	<label for="post_content">Comment Content</label>
	<div class="form-group">
		<textarea name="comment_content" class="form-control" rows="10"></textarea>
	</div>
	
	<label for="comment_status">Comment Status</label>
	<div class="form-group">
		<select class="btn btn-primary" id="comment_status" name="comment_status">
			<option value="unapproved">Unapproved</option>
			<option value="approved">Approved</option>
		</select>
	</div>
	<input class="btn btn-primary" type="submit" value="Create Comment" name="create_comment">
</form>