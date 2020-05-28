<?php

//connect to DB with PDO
//just the beginning

try {
    $dbh = new PDO("mysql:dbname=zfrehner_grc",
    "zfrehner_grcuser", "password123");
    echo 'Connected to Database';
}
catch(PDOException $e) {
    echo $e->getMessage();
}