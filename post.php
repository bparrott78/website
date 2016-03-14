<!--database connection-->
<?php include "includes/db.php"?>
	<!--header-->
	<?php include "includes/header.php"; ?>

		<!--navigation-->
		<?php include "includes/navigation.php";?>

			<!--page content-->
			<div class="container">
				<div class="row">
					<!--main entries-->
					<div class="col-md-8">
<!--blog entries column-->
		<?php
			if(isset($_GET['p_id'])){ // check if post id is set
				$the_post_id=$_GET['p_id']; //set post id
				}?>
						<?php
			$query = "SELECT * FROM posts WHERE post_id = $the_post_id "; //get all posts that match post_id tag
			$select_all_posts_query = mysqli_query($connection,$query); 
				while($row=mysqli_fetch_assoc($select_all_posts_query)){
				$post_id=$row['post_id'];
				$post_title=$row['post_title'];
				$post_author=$row['post_author'];
				$post_date=$row['post_date'];
				$post_image=$row['post_image'];
				$post_content=$row['post_content'];
				?>
	
			<h1 class="inline"><a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title;?></a></h1>
			<p class="lead inline" id="top">by <a href="index.php"><?php echo $post_author?></a></p>

		<p><span class="glyphicon glyphicon-time"></span> Posted on
			<?php echo $post_date?>
		</p>
		<hr>
	
			<img class="img-responsive" src="images/<?php echo $post_image;?>">
		
			<hr>
			
			<p style="font-size:16px;"><?php echo $post_content?>
			</p>

			<hr>
			
				<?php } ?>
	<h3>Comments:</h3>
	<hr>
	<?php global $connection;
	$query=$query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id}";
	$select_comments = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($select_comments)) {
	$comment_id = $row['comment_id'];
	$comment_post_id = $row['comment_post_id'];
	$comment_author = $row['comment_author'];
	$comment_email = $row['comment_email'];
	$comment_content = $row['comment_content'];
	$comment_status = $row['comment_status'];
	$comment_date = $row['comment_date'];
	$comment_author=ucwords($comment_author);
	if ($comment_status == 'unapproved'){
		
	}else{
		echo "<div class='well' id='comment'>";
		echo "<h2 class='inline'>{$comment_author} </h2>";
		echo "(<span class='small'>{$comment_email}) <p><span class='glyphicon glyphicon-time'> </span><span class='small'> {$comment_date}</span></p>";
		echo "<p class='bigger' id='content'>{$comment_content}</p>";
		echo "</div>";
		}
	}
						?>
					<br>
		<div class="well"style="clear:'both'">
            <h4>Leave a Comment:</h4>
				<form action="#" method="post" role="form">
					<div class="form-group">
					 <label for="Author">Author</label>
					  <input type="text" name="comment_author" class="form-control" name="comment_author">
					</div>

					 <div class="form-group">
					 <label for="Author">Email</label>
					  <input type="email" name="comment_email" class="form-control" name="comment_email">
					</div>

					<div class="form-group">
						<label for="comment">Your Comment</label>
						<textarea name="comment_content" class="form-control" rows="3"></textarea>
					</div>
					<button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
				</form>
                </div>
</div>
		
					
	
		<?php
		if(isset($_POST['create_comment'])){
		$comment_id=null;
		$comment_post_id=$the_post_id;
		$comment_author=$_POST['comment_author'];
		$comment_email=$_POST['comment_email'];
		$comment_content=$_POST['comment_content'];
		$comment_status="unapproved";
		$comment_date=date('Y-m-d');
		
	
	
		$query="INSERT INTO comments(comment_post_id, comment_author,comment_email,comment_content,comment_status,comment_date) VALUES ('{$comment_post_id}','{$comment_author}','{$comment_email}','{$comment_content}','{$comment_status}','{$comment_date}')";
		$createQuery=mysqli_query($connection,$query);
		incrementComments($the_post_id);
		if(!$createQuery){
			die("Query failed ") . mysqli_error($connection);
		}else{
			header("Location: post.php?p_id={$the_post_id}");	
		}
	}
?>
		<!--sidebar-->
<?php include "includes/sidebar.php";?>
	</div>

<!--footer-->
<?php include "includes/footer.php"; ?>
<!--exit container-->
</div>

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