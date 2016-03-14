<?php include "includes/admin_header.php"?>
<style>
	body{
		color:white;
	}
	h1{
		font-size:100px;
	}
</style>
<h1 align="center">Not Authenticated.</h1>
<?php 
	if(isset($_POST['submit'])){ //check for post set

   global $connection; //get database connection
   if (!$connection){      //in no connection, die.
      die("Could not connect to database");
   }
   	$username=$_POST['username']; //set username from post
    $password=$_POST['password'];   //set password from post
    $errormsg="Not authenticated."; //set error message

    mysqli_real_escape_string($connection,$username); //clean sql injections
    mysqli_real_escape_string($connection,$password); //clean sql injections
    $query="SELECT * FROM users WHERE user_name='$username' and user_password='$password'";//Select users that match post criteria
   	$result = mysqli_query($connection,$query);
	$validate=mysqli_num_rows($result);
	  if($validate === 1){
      $_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
       $_SESSION['loggedin'] = true;
		  header("Location: index.php");
	  }else{  
        	echo "<h1 align='center'>".$errormsg."</h1>";
	  }
   
	}


?>