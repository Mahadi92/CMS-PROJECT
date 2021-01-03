<?php

    //this array for secure data.
    $db['db_host'] = "localhost";
    $db['db_user'] = "root";
    $db['db_pass'] = "";
    $db['db_name'] = "cms";


    //this loop for highly secure data.
    foreach($db as $key => $value){
        
        define(strtoupper($key), $value);
            
    }

    $db_connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    //you can write this way but this is not secure

    //$connect = mysqli_connect('localhost','root','', 'cms');


    if(!$db_connect){
        echo "<h2 style = 'color:red;'>Database Not Connected. Please try again</h2>";
    
    }
    
    
    
    
    


?>