<?php
//default value set in database table
require_once "connection.php";
for($i=1;$i<=50;$i++){
    $stmt= $connection->prepare('INSERT INTO people (name,email) VALUES (:name,:email)');
    $stmt->execute([
        ":name"=>"suvo{$i}",
        ":email"=>"suvo{$i}@gmail.com",
    ]);
}
