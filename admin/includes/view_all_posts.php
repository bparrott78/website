<?php deletePost();?>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Category</th>
			<th>Title</th>
			<th>Author</th>
			<th>Date</th>
			<th>Image</th>
			<th>Tags</th>
			<th>Comments</th>
			<th>Status</th>
		</tr>
	</thead>

	<tbody>
<?php
	global $connection;
	$query=$query = "SELECT * FROM posts";
	$select_posts = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($select_posts)) {
	$post_id = $row['post_id'];
	$post_cat_id = $row['post_category_id'];
	$post_title = $row['post_title'];
	$post_author = $row['post_author'];
	$post_date = $row['post_date'];
	$post_image = $row['post_image'];
	$post_tags = $row['post_tags'];
	$post_comment_count = $row['post_comment_count'];
	$post_status = $row['post_status'];

	echo "<tr>";
	echo "<td>{$post_id}</td>";

	$query="SELECT * FROM categories WHERE cat_id = {$post_cat_id}";
	$get_categories=mysqli_query($connection,$query);
	while ($row=mysqli_fetch_assoc($get_categories)){
	$cat_name=$row['cat_title'];
	echo "<td>{$cat_name}</td>";
	}
		
		echo "<td>{$post_title}</td>";
		echo "<td>{$post_author}</td>";
		echo "<td>{$post_date}</td>";
		echo "<td><a href='../images/{$post_image}'><img src='../images/{$post_image}' alt='{$post_image}' class='img-responsive' width='100px'></a></td>";
		echo "<td>{$post_tags}</td>";
		echo "<td>{$post_comment_count}</td>";
		echo "<td>{$post_status}</td>";
		echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
		echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
		
	echo "</tr>";
	}
   ?>

	</tbody>
</table>
<a href="posts.php?source=add_post"><button class="btn btn-primary btn-block">Add New Post</button></a>
