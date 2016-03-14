<?php

function confirm($result){
if(!$result){
	global $connection;
			echo "Query failed ". mysqli_error($connection);
		}
}
function incrementComments($post_id){
	global $connection;
$query="SELECT post_comment_count FROM posts WHERE post_id = {$post_id}";
			$result=mysqli_query($connection,$query);
			while($row=mysqli_fetch_assoc($result)){
			$comment_count=$row['post_comment_count'];
			}
			$comment_count=$comment_count +1;

			$increase_comment_count_query="UPDATE `posts` SET `post_comment_count` = '{$comment_count}' WHERE `posts`.`post_id` = {$post_id}";
			$send_count=mysqli_query($connection,$increase_comment_count_query);
			if(!$send_count){
				die("Query Failed").mysqli_error($connection);
			}
}
function decrementComments($post_id){
	global $connection;
$query="SELECT post_comment_count FROM posts WHERE post_id = {$post_id}";
			$result=mysqli_query($connection,$query);
			while($row=mysqli_fetch_assoc($result)){
			$comment_count=$row['post_comment_count'];
			}
			$comment_count=$comment_count -1;

			$increase_comment_count_query="UPDATE `posts` SET `post_comment_count` = '{$comment_count}' WHERE `posts`.`post_id` = {$post_id}";
			$send_count=mysqli_query($connection,$increase_comment_count_query);
			if(!$send_count){
				die("Query Failed").mysqli_error($connection);
			}
}
function confirmQuery($result){
if(!$result){
	global $connection;
			echo "Query failed ". mysqli_error($connection);
		}
}
function insertAuthor(){
	global $connection;
	if(isset($_POST['add_author'])){
		$author_name=$_POST['author_name'];
		$author_name=ucwords($author_name);
		if($author_name== ""|| empty($author_name)){
			echo "<h5>This field can not be blank</h5> <br>";
		} else {
		 $query="INSERT INTO authors (author_name) VALUE('{$author_name}')";
		$create_author_query = mysqli_query($connection,$query);
			if(!$create_author_query){
				die('Query failed'. mysqli_error($connection));
				header("Location: author.php");
			}
		}
	}
	
}
function escape($array){
   global $connection;
	return array_map('mysqli_real_escape_string', $array);
}

function editCatID(){
	global $connection;
	$query="SELECT * FROM categories";
	$edit_categories=mysqli_query($connection,$query);
	while ($row=mysqli_fetch_assoc($edit_categories)){
		$cat_title=$row['cat_title'];
		$cat_id=$row['cat_id'];
	echo "<option value='{$cat_id}'>{$cat_title}</option>";
	}
}
function deleteAuthor(){
	global $connection;
if(isset($_GET['delete'])){
	$the_author_id=$_GET['delete'];
	$query = "DELETE FROM authors WHERE author_id = {$the_author_id}";
	$delete_query=mysqli_query($connection,$query);
	header("Location: author.php");
}
}

function getCatID(){
	global $connection;
	$query="SELECT * FROM categories";
	$get_categories=mysqli_query($connection,$query);
	while ($row=mysqli_fetch_assoc($get_categories)){
		$cat_name=$row['cat_title'];
		$cat_id=$row['cat_id'];
	echo "<option value='{$cat_id}'>{$cat_name}</option>";
	}
}
function getAuthor(){
	global $connection;
	$query="SELECT * FROM authors";
	$select_author=mysqli_query($connection,$query);
	while ($row=mysqli_fetch_assoc($select_author)){
		$author_name=$row['author_name'];
	echo "<option value='{$author_name}'>{$author_name}</option>";
	}
}

function getPost(){
global $connection;
	$query = "SELECT * FROM posts";
	$select_posts = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($select_posts)) {
	$post_id = $row['post_id'];			
	$post_title = $row['post_title'];
	$post_author = $row['post_author'];
	$post_date = $row['post_date'];
	$post_image = $row['post_image'];


	echo "<tr>";
		echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
		echo "<td><a href='posts.php?edit={$post_id}'>Edit</a></td>";	
		echo "<td>{$post_id}</td>";
		echo "<td>{$post_title}</td>";
		echo "<td>{$post_author}</td>";
		echo "<td>{$post_date}</td>";
		echo "<td><img src='../images/{$post_image}' alt='{$post_image}' class='img-responsive' width='100px'></td>";
	echo "</tr>";
	}
}
function deletePost(){
	global $connection;
if (isset($_GET['delete'])){
	$the_post_id=$_GET['delete'];
	$query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
	$delete_query=mysqli_query($connection,$query);
	$query = "DELETE FROM comments WHERE comment_post_id = {$the_post_id}";
	$delete_query=mysqli_query($connection,$query);
	if(!$delete_query){
		die("Query Failed" . mysqli_error($connection));
	}
	header("Location: posts.php");
}
}

function deleteCategory(){
	global $connection;
if(isset($_GET['delete'])){
	$the_cat_id=$_GET['delete'];
	$query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
	$delete_query=mysqli_query($connection,$query);
   header("Location: categories.php");
}
}

function insertCategories(){
	global $connection;
	if(isset($_POST['submit'])){
		$cat_title=$_POST['cat_title'];
		$cat_title=ucwords($cat_title);
		if($cat_title== ""|| empty($cat_title)){
			echo "<h5>This field can not be blank</h5> <br>";
		} else {
		 $query="INSERT INTO categories (cat_title) VALUE('{$cat_title}')";
		$create_category_query = mysqli_query($connection,$query);
			if(!$create_category_query){
				die('Query failed'. mysqli_error($connection));
			}
		}
	}
}

function getCategories(){
	global $connection;
	$query = "SELECT * FROM categories";
	$select_categories_sidebar = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($select_categories_sidebar )) {
	$cat_title = $row['cat_title'];
	$cat_id = $row['cat_id'];
	echo "<tr>";
	echo "<td>{$cat_id}</td>";
	echo "<td>{$cat_title}</td>";
	echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";;
	echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
	echo "</tr>";
	}
}


?>







