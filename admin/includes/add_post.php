
<?php 	$post_author_id=$_SESSION['u_id'];
if(isset($_POST['create_post'])){
		$post_id=null;
		$post_cat_id=$_POST['post_cat_id'];
		$post_title=$_POST['post_title'];
		$post_author=$_POST['post_author'];
		$post_date=date('Y-m-d');
		$post_image=$_FILES['image']['name'];
		$post_image_temp=$_FILES['image']['tmp_name'];
		$post_content=$_POST['post_content'];
		$post_tags=$_POST['post_tags'];
		$post_comment_count=0;
		$post_status=$_POST['post_status'];
		$post_views_count=null;
	

	
	
	move_uploaded_file($post_image_temp, "../images/$post_image");
	
		$query="INSERT INTO posts(post_id,post_category_id, post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status,post_views_count,author_id) VALUES (NULL,'{$post_cat_id}','{$post_title}','{$post_author}','{$post_date}','{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}',NULL,$post_author_id)";
	
		$result=mysqli_query($connection,$query);
		confirm($result);
		header("Location: posts.php");
}

?>
<form action="" method="post" enctype="multipart/form-data">

	<label for="post_cat_id">Post Category</label>
	<div class="form-group">
		<select id="post_cat_id" name="post_cat_id" class="btn btn-primary">
			<?php getCatID();?>
		</select>
	</div>
	<label for="post_title">Post Title</label>
	<div class="form-group">
		<input type="text" name="post_title" class="form-control">
	</div>
	<label for="post_author">Post Author</label>
	<div class="form-group">
		<input type="text" name="post_author" value="<?php echo $fullname?>" class="form-control" readonly="readonly">
	</div>
	<label for="post_image">Post Image</label>
	<div class="form-group">
		<span class="btn btn-primary btn-file" id="upload">
		<input type="file" name="image" id="file" class="coverimage" ></span>
	</div>
	<div id="image_container">
	</div>	
	<label for="post_cat_id">Post Tags</label>
	<div class="form-group">
		<input type="text" name="post_tags" class="form-control">
	</div>
	<label for="post_status">Post Status</label>
	<div class="form-group">
		<select class="btn btn-primary" id="post_status" name="post_status">
			<option value="draft">Draft</option>
			<option value="published">Published</option>
		</select>
	</div>
	<label for="post_cat_id">Post Content</label>
	<div class="form-group">
		<textarea name="post_content" class="form-control" rows="10"></textarea>
	</div>
	<input class="btn btn-primary" type="submit" value="Publish Post" name="create_post">
	<a href="posts.php"><button type="button" class="btn btn-primary">Discard</button></a>
</form>
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
	             };
        	 } 
		});
	});
});
</script>