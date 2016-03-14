<?php include "includes/db.php"?>
<?php include "functions.php";

$username = escape($_GET['username']);
escape ($username);
echo $username;

?>