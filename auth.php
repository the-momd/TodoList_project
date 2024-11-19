<?php

include "bootstrap/init.php";

// dd($_SERVER['REQUEST_METHOD']);

// if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//     echo '<pre>';
//     var_dump($_POST); // Check if POST data is being received
//     echo '</pre>';
//     die();
// }
$home_url = site_url();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET['action'];
    $params = $_POST;

    if ($action == 'register') {
        try {
            $result = register($params);
            if ($result === true) {
                message("Welcome! Your account has been successfully created.<br>
                <a href='{$home_url}auth.php'>Please login</a>", 'success');
            } else {
                message("Error: an error in Registration!");
            }
        } catch (Exception $e) {
            message("Error: " . $e->getMessage());
        }
    } else if ($action == 'login') {
        $result = login($params['email'], $params['password']);
        if ($result) {
            // message("<a href='{$home_url}auth.php'>Manage your tasks</a>", 'success');
            redirect(site_url()); // Correctly redirects after successful login
        } else {
            message("Error: Email or Password is incorrect!");
        } 
    }
}







include "tpl/tpl-auth.php";
