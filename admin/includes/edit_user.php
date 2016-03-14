
<?php
	if (isset($_GET['u_id'])){
	$the_user_id = $_GET['u_id'];	
	$query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
	$select_user = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($select_user)) {
	$user_id=$row['user_id'];
		$user_name=$row['user_name'];
		$user_password=$row['user_password'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		$user_image = $row['user_image'];
		$user_email=$row['user_email'];
		$user_level=$row['user_level'];
	}
}
	if(isset($_POST['update_user'])){
		$user_id=null;
		$user_name=escape($_POST['user_name']);
		$user_password=escape($_POST['user_password']);
		$first_name=escape($_POST['first_name']);
		$last_name=escape($_POST['last_name']);
		$user_image=escape($_FILES['user_image']['name']);
		$user_image_temp=escape($_FILES['user_image']['tmp_name']);
		$user_email=escape($_POST['user_email']);
		$user_level=escape($_POST['user_level']);
		if(empty($user_image)){
			$query="SELECT * FROM users WHERE user_id='{$the_user_id}'";
			$select_image=mysqli_query($connection,$query);
			while ($row=mysqli_fetch_assoc($select_image)){
				$user_image = $row['user_image'];
			}	
		}
		$user_password = escape(password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10)));
		move_uploaded_file($user_image_temp, "../images/$user_image");
		$query ="UPDATE users SET ";
		$query .= "user_name = '{$user_name}', ";
		$query .= "user_password = '{$user_password}', ";
		$query .= "first_name = '{$first_name}', ";
		$query .= "last_name = '{$last_name}', ";
		$query .= "user_image = '{$user_image}', ";
		$query .= "user_email = '{$user_email}', ";
		$query .= "user_level = '{$user_level}' ";
		$query .= "WHERE user_id = '{$the_user_id}' ";
		 
		$updateQuery=mysqli_query($connection,$query);
		confirmQuery($updateQuery);
		if(!$updateQuery){
			echo "Query failed " . mysqli_error($connection);
		}else{
		header("Location:users.php");
		}
	}
?>

<form action="" method="post" enctype="multipart/form-data">
	<label for="user_name">User name</label>
	<div class="form-group">
		<div class="form-group">
		<input value="<?php echo $user_name?>" type="text" name="user_name" class="form-control">
	</div>
	<label for="user_password">Password</label>
	<div class="form-group">
		<input value="<?php echo $user_password?>" type="text" name="user_password" class="form-control">
	</div>
	<label for="first_name">First Name</label>
	<div class="form-group">
		<input value="<?php echo $first_name?>" type="text" name="first_name" class="form-control">
	</div>
	<label for="first_name">Last Name</label>
	<div class="form-group">
		<input value="<?php echo $last_name?>" type="text" name="last_name" class="form-control">
	</div>
	<label for="post_image">Post Image</label>
	<div class="form-group">
		<span class="btn btn-primary btn-file">
		<input type="file" name="user_image" id="file" class="coverimage" ></span>
	</div>
	<div class="form-group">
	<img src="../images/<?php echo $user_image ?>" alt="Click to Zoom" title="click to zoom" id="pic" width="300px"> 
	</div>
	<div id="image_container">
	</div>	
	
	<label for="user_email">Email</label>
	<div class="form-group">
		<input type="email" name="user_email" class="form-control" value="<?php echo $user_email?>">
	</div>
	
	<label for="user_level">User Level</label>
	<div class="form-group">
		<select class="btn btn-primary" id="user_level" name="user_level">
			<option value="1"<?php if($user_level == 1){echo 'selected';}?>>1</option>
			<option value="2"<?php if($user_level == 2){echo 'selected';}?>>2</option>
			<option value="3"<?php if($user_level == 3){echo 'selected';}?>>3</option>
			<option value="4"<?php if($user_level == 4){echo 'selected';}?>>4</option>
			<option value="5"<?php if($user_level == 5){echo 'selected';}?>>5</option>
		</select>
	</div>
	<input class="btn btn-primary" type="submit" value="Submit Edits" name="update_user">
	<a href="users.php"><button type="button" class="btn btn-primary">Discard</button></a>
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

