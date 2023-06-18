<?php
    if(isset($_GET["id"])){
        $id = $_GET["id"];

         // connect to database
         $servername = "localhost";
         $username = "root";
         $password = "";
         $database = "crud_operation"; 
 
         //create connection
         $connection = new mysqli($servername, $username, $password, $database);

         $sql = "DELETE FROM `client` WHERE id=$id";
         $connection->query($sql);

    }

    // TO ALLOW USER TO REDIRECT TO INDEX.PHP FILE
    header("location: /CRUD-Operation/index.php");
    exit;

?>