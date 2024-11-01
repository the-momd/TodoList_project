<?php

include "bootstrap/init.php";
// use Hekmatinasser\Verta\Verta;
// echo verta::now();

if (isset ($_GET['delete_folder']) &&  is_numeric($_GET['delete_folder'])){
    $deletedCount =  deleteFolder($_GET['delete_folder']);
    // echo "$deletedCount folders succesfully deleted";
}

# connect to db and get tasks
$folders = getFolders();
$tasks = getTasks();
include "tpl/tp-index.php";