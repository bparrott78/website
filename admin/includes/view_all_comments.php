
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Comment ID</th>
			<th>Post ID</th>
			<th>Comment Author</th>
			<th>Author Email</th>
			<th>Content</th>
			<th>Status</th>
			<th>Date</th>
		
		</tr>
	</thead>

	<tbody>
<?php
	global $connection;
	$query=$query = "SELECT * FROM comments";
	$select_comments = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($select_comments)) {
	$comment_id = $row['comment_id'];
	$comment_post_id = $row['comment_post_id'];
	$comment_author = $row['comment_author'];
	$comment_email = $row['comment_email'];
	$comment_content = $row['comment_content'];
	$comment_status = $row['comment_status'];
	$comment_date = $row['comment_date'];
	if (strlen($comment_content)>25){
	$comment_content = substr($comment_content,0,25) . "...";
	}
	echo "<tr>";
	echo "<td>{$comment_id}</td>";

	$query="SELECT * FROM comments WHERE comment_id = {$comment_id}";
	$get_comments=mysqli_query($connection,$query);
	while ($row=mysqli_fetch_assoc($get_comments)){
		$comment_id=$row['comment_id'];
		$comment_post_id=$row['comment_post_id'];
	echo "<td>{$comment_post_id}</td>";
	}
		echo "<td>{$comment_author}</td>";
		echo "<td>{$comment_email}</td>";
		echo "<td>{$comment_content}</td>";
		echo "<td>{$comment_status}</td>";
		echo "<td>{$comment_date}</td>";
		echo "<td><a href='comments.php?source=edit_comment&c_id={$comment_id}'>Edit</a></td>";
		echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
		
	echo "</tr>";
	}
?>

	</tbody>
</table>
<a href="comments.php?source=add_comment"><button class="btn btn-primary btn-block">Add New Comment</button></a>

