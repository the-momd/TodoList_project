<?php

include "bootstrap/init.php";
// use Hekmatinasser\Verta\Verta;
// echo verta::now();
# connect to db and get tasks
$folders = getFolders();
$tasks = getTasks();
include "tpl/tp-index.php";