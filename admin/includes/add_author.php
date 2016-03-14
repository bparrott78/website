<?php 
global $connection;
if(isset($_POST['add_author'])){
		$author_name=$_POST['author_name'];
		$author_name=ucwords($author_name);
		if($author_name== ""|| empty($author_name)){
			echo "<h5>This field can not be blank</h5> <br>";
		} else {
		 $query="INSERT INTO authors(author_name) VALUE('{$author_name}')";
		$create_author_query = mysqli_query($connection,$query);
			if(!$create_author_query){
				die('Query failed'. mysqli_error($connection));
			}
		}
	}


?>
<form action="" method="post" enctype="multipart/form-data">
	<label for="post_cat_id">Author Name:</label>
	<div class="form-group">
		<input type="text" name="author_name" class="form-control">
	</div>
	<input class="btn btn-primary" type="submit" value="Add Author" name="add_author">
</form>