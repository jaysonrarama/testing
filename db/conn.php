<?php

try{
     $pdo = new PDO('mysql:host=localhost;dbname=db_menus','root','',[PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
     echo "Connected";
}
catch(PDOException $e){
    echo "Connection failed".$e->getMessage();
    exit;
}
?>