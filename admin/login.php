<?php if(session_id()){
    session_destroy();
}?>
<?php include "includes/admin_header.php";?>

 <style>
.col-centered{
float:none;
margin:0 auto;
	}
body{
		 background-color:lightslategrey;
	 }
</style>
<?php 

if(isset($_POST['login'])) {
    

$username = $_POST['username'];
$password = $_POST['password'];
    
$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);
    
    
$query = "SELECT * FROM users WHERE user_name = '{$username}' ";
$select_user_query = mysqli_query($connection, $query);
if(!$select_user_query) {

    die("QUERY FAILED". mysqli_error($connection));

}
    
    
    
  while($row = mysqli_fetch_array($select_user_query)) {
      
      $db_user_id = $row['user_id'];
      $db_username = $row['user_name'];
      $db_user_password = $row['user_password'];
      $db_user_firstname = $row['first_name'];
      $db_user_lastname = $row['last_name'];
      $db_user_role = $row['user_level'];
  
  }  
    
    
// $new_password = crypt($password, $db_user_password);
    
    


if (password_verify($password,$db_user_password)) {
   
$_SESSION['username'] = $db_username;
$_SESSION['firstname'] = $db_user_firstname;
$_SESSION['lastname'] = $db_user_lastname;
$_SESSION['user_role'] = $db_user_role;
$_SESSION['u_id']=$db_user_id;
    
    


header("Location: index.php");

} else {


}
}
?>
