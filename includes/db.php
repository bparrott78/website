<?php
    $db['db_host'] = "localhost";
    $db['db_user'] = "braeden";
    $db['db_pass'] = "ab7Habuk";
    $db['db_name'] = "cms";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}


    $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if(!$connection){
            echo "No Connection to Database";
        }


?>