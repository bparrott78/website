<?php
    $db_host='localhost';
    $db_user='braeden';
    $db_pass='ab7Habuk';
    $db_name='cms';
    $connection=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    if (!$db_connect){
        echo "cannot connect to database" . mysqli_error($connection);
    }

	


?>