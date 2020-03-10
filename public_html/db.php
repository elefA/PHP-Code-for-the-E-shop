<?php
include "config.php";

//
//new PDO("mysql:host=localhost;db_name=mairak;port=3306", "mairak", "dasdsa");
try{
    $db = new PDO("mysql:host=" . DB_HOST .
        ";dbname=" . DB_NAME .
        ";port=" . DB_PORT,DB_USER,DB_PASS);

    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch (Exception $e){
    echo "Database Connection Error.";
    exit;
}