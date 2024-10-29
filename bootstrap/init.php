<?php

include "bootstrap/constans.php";
include "bootstrap/config.php";
include "vendor/autoload.php";
include "libs/lib-helpers.php";


try {
    $pdo = new PDO("mysql:dbname={$database_config->db};host={$database_config->host}", $database_config->user, $database_config->pass);
} catch (PDOException $e) {
    diePage("Connection failed: " . $e->getMessage());
    
}
// echo "Connection to the database is OK";

include "libs/lib-auth.php";
include "libs/lib-tasks.php";

