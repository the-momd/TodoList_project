<?php

include "bootstrap/init.php";
// use Hekmatinasser\Verta\Verta;
// echo verta::now();

if(isset($_GET['logout'])){
    logout();
}

if(!isLoggedIn()){
    // redirect to auth form
    header("Location:" . site_url('auth.php'));
}

# user is LoggedIn
$user = getLoggedInUser();

if (isset ($_GET['delete_folder']) &&  is_numeric($_GET['delete_folder'])){
    $deletedCount =  deleteFolder($_GET['delete_folder']);
    // echo "$deletedCount folders succesfully deleted";
}

if (isset ($_GET['delete_task']) &&  is_numeric($_GET['delete_task'])){
    $deletedCount =  deleteTask($_GET['delete_task']);
    // echo "$deletedCount Tasks succesfully deleted";
}

# connect to db and get tasks
$folders = getFolders();


$tasks = getTasks();

include "tpl/tp-index.php";