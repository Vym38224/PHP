<?php 
/** 
* Připojení k databázi
*
* @return object - reprezentující připojení k databázi
*/ 

function connectionDB(){
    $db_host = "localhost";
    $db_user = "jaroslavvymetal";
    $db_password = "heslo";
    $db_name = "skola";

    $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    }
    return $connection;
}
