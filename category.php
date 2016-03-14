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
<hr>
						<?php
			if(isset($_GET['category'])){
				$post_category_id=$_GET['category'];
				
			}
        $query = "SELECT * FROM posts WHERE post_category_id=$post_category_id";
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
			<p class="lead inline">by <a href="index.php"><?php echo $post_author?></a></p>

		<p><span class="glyphicon glyphicon-time"></span> Posted on
			<?php echo $post_date?>
		</p>
		<hr>
		<a href="#"><img class="img-responsive" src="images/<?php echo $post_image;?>"></a>
		<hr>
		<p>
		<?php if (strlen($post_content)>100){
				$post_content= substr($post_content,0,150);
				echo $post_content . "...";
			}else{
				echo $post_content;
			}
		?>
		</p>
		<a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
		<hr>

					
		<?php } ?>
		<!--    exit col-md-8    -->
		</div>
		<!--sidebar-->
<?php include "includes/sidebar.php";?>
	<!--exit row-->
	</div>

<!--footer-->
<?php include "includes/footer.php"; ?>
<!--exit container-->
</div>
<script>

</script>