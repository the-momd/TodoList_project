<?php

include "bootstrap/init.php";

// dd($_SERVER['REQUEST_METHOD']);

// if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//     echo '<pre>';
//     var_dump($_POST); // Check if POST data is being received
//     echo '</pre>';
//     die();
// }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action = $_GET['action'];
    $params = $_POST;
    if('action' == 'register'){
       $result = register($params);
       dd($result);
    } else if('action' == 'login'){
        $result = login($params['email'],$params['password']);
        dd($result);
        
    }
}

include "tpl/tpl-auth.php";