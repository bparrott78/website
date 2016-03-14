<?php
	$fname=$_SESSION['firstname'];
	$lname=$_SESSION['lastname'];
	$fullname=$fname." ".$lname;
	if (isset($_GET['p_id'])){
	$the_post_id = $_GET['p_id'];	
	$query=$query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
	$select_posts = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($select_posts)) {
	$post_id = $row['post_id'];
	$post_cat_id = $row['post_category_id'];
	$post_title = $row['post_title'];
	$post_author = $row['post_author'];
	$post_date = $row['post_date'];
	$post_image = $row['post_image'];
	$post_tags = $row['post_tags'];
	$post_content = $row['post_content'];
	$post_comment_count = $row['post_comment_count'];
	$post_status = $row['post_status'];
	}
}
	if(isset($_POST['update_post'])){
		$post_id=null;
		$post_cat_id=$_POST['post_cat_id'];
		$post_title=$_POST['post_title'];
		$post_author=$_POST['post_author'];
		$post_date=date('Y-m-d');
		$post_image=$_FILES['image']['name'];
		$post_image_temp=$_FILES['image']['tmp_name'];
		$post_content=$_POST['post_content'];
		$post_tags=$_POST['post_tags'];
		$post_comment_count=4;
		$post_status=$_POST['post_status'];
		$post_views_count=null;
	move_uploaded_file($post_image_temp, "../images/$post_image");
		if(empty($post_image)){
			$query="SELECT * FROM posts WHERE post_id='{$the_post_id}'";
			$select_image=mysqli_query($connection,$query);
			while ($row=mysqli_fetch_assoc($select_image)){
				$post_image = $row['post_image'];
			}	
		}
		$query ="UPDATE posts SET ";
		$query .= "post_title = '{$post_title}', ";
		$query .= "post_category_id = '{$post_cat_id}', ";
		$query .= "post_date = '{$post_date}', ";
		$query .= "post_author = '{$post_author}', ";
		$query .= "post_status = '{$post_status}', ";
		$query .= "post_tags = '{$post_tags}', ";
		$query .= "post_content = '{$post_content}', ";
		$query .= "post_image = '{$post_image}' ";
		$query .= "WHERE post_id = '{$the_post_id}' ";
		 
		$updateQuery=mysqli_query($connection,$query);
		confirmQuery($updateQuery);
		if(!$updateQuery){
			echo "Query failed " . mysqli_error($connection);
		}else{
		header("Location: posts.php");
		}
	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<label for="post_cat_id">Post Category</label>
	<div class="form-group">
		<select id="post_cat_id" name="post_cat_id" class="btn btn-primary" value="{$post_cat_id}">
			<?php 
	global $connection;
	$query="SELECT * FROM categories";
	$edit_categories=mysqli_query($connection,$query);
	while ($row=mysqli_fetch_assoc($edit_categories)){
		$cat_title=$row['cat_title'];
		$cat_id=$row['cat_id'];
	if ($cat_id == $post_cat_id){
	echo "<option value='{$cat_id}'selected>{$cat_title}</option>";
	}else{
	echo "<option value='{$cat_id}'>{$cat_title}</option>";	
}
	}?>
		</select>
	</div>
	<label for="post_title">Post Title</label>
	<div class="form-group">
		<input value="<?php echo $post_title?>" type="text" name="post_title" class="form-control">
	</div>
	<label for="post_author">Post Author</label>
	<div class="form-group">
	<input type="text" name="post_author" value="<?php echo $post_author?>" class="form-control" readonly="readonly">

	</div>
	
	<label for="post_image">Post Image</label>
	<div class="form-group">
		<span class="btn btn-primary btn-file">
		<input type="file" name="image" id="file" class="coverimage" ></span>
	</div>
	<div class="form-group">
	<img src="../images/<?php echo $post_image ?>" alt="Click to Zoom" title="click to zoom" id="pic" width="300px"> 
	</div>
	<div id="image_container">
	</div>	
	
	<label for="post_cat_id">Post Tags</label>
	<div class="form-group">
		<input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags?>">
	</div>
	
	<label for="post_status">Post Status</label>
	<div class="form-group">
		<select class="btn btn-primary" id="post_status" name="post_status">
			<option value="draft"<?php if($post_status == 'draft'){echo 'selected';}?>>Draft</option>
			<option value="published"<?php if($post_status == 'published'){echo 'selected';}?>>Published</option>
		</select>
	</div>
	
	<label for="post_content">Post Content</label>
	<div class="form-group">
		<textarea name="post_content" class="form-control" rows="10"><?php echo $post_content?></textarea>
	</div>
	<input class="btn btn-primary" type="submit" value="Submit Edits" name="update_post">
	<a href="posts.php"><button type="button" class="btn btn-primary">Discard</button></a>

</form>
<script>
$(document).ready(function(){
         $('img').click(function () {
            $('img').not(this).animate({width: "500px"}, 'fast');
            var $this = $(this),
                flag = !$this.data('flag');
    
            $this.stop().animate({width: (flag ? "500px" : "300px")}, 'fast')
                 .data('flag', flag);
          });
    });
</script>
<script>
$(document).ready(function($){
	images = new Array();
	$(document).on('change','.coverimage',function(){
		 files = this.files;
		 $.each( files, function(){
			 file = $(this)[0];
			 if (!!file.type.match(/image.*/)) {
	        	 var reader = new FileReader();
	             reader.readAsDataURL(file);
	             reader.onloadend = function(e) {
	            	img_src = e.target.result; 
	            	html = "<img class='img-thumbnail' style='width:300px;margin:20px;' src='"+img_src+"'>";
	            	$('#image_container').append( html );
					 document.getElementById('pic').style.display = 'none'; 
	             };
        	 } 
		});
	});
});
</script>

