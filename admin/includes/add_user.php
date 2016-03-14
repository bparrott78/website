
<?php 
global $connection;
if(isset($_POST['create_user'])){
		$user_id=null;
		$user_name=escape($_POST['user_name']);
		$user_password=escape($_POST['user_password']);
		$first_name=escape($_POST['first_name']);
		$last_name=escape($_POST['last_name']);
		$user_image=escape($_FILES['user_image']['name']);
		$user_image_temp=escape($_FILES['user_image']['tmp_name']);
		$user_email=escape($_POST['user_email']);
		$user_level=escape($_POST['user_level']);
	
		$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
	move_uploaded_file($user_image_temp, "../images/$user_image");
	
		$query="INSERT INTO users(user_id,user_name, user_password,first_name,last_name,user_image,user_email,user_level) VALUES (NULL,'{$user_name}','{$user_password}','{$first_name}','{$last_name}','{$user_image}','{$user_email}','{$user_level}' )";
		$result=mysqli_query($connection,$query);
		confirm($result);
		header:("Location: users.php");
		}

?>
<form action="" method="post" enctype="multipart/form-data">
	<label for="user_name">Username</label>
	<div class="form-group">
		<input type="text" name="user_name" class="form-control">
	</div>
	<label for="user_password">Password</label>
	<div class="form-group">
		<input type="password" name="user_password" class="form-control">
	</div>
	<label for="first_name">First Name</label>
	<div class="form-group">
		<input type="text" name="first_name" class="form-control">
	</div>
	<label for="last_name">Last Name</label>
	<div class="form-group">
		<input type="text" name="last_name" class="form-control">
	</div>
	<label for="user_image">User Image</label>
	<div class="form-group">
		<span class="btn btn-primary btn-file" id="upload">
		<input type="file" name="user_image" id="file" class="coverimage" ></span>
	</div>
	<div id="image_container">
	</div>	
	<label for="user_email">Email Address</label>
	<div class="form-group">
		<input type="email" name="user_email" class="form-control">
	</div>
	<label for="user_level">User Level</label>
	<div class="form-group">
		<select class="form-control" name="user_level">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5" selected>5</option>
		</select>
	</div>
	<input class="btn btn-primary" type="submit" value="Create User" name="create_user">
	<a href="users.php"><button type="button" class="btn btn-primary">Discard</button></a>
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