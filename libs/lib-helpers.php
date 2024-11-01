<?php

function getCurrentUrl(){
    return 1;
}

function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // This is an AJAX request
        return true;
    } else {
        // This is not an AJAX request
        return false;
    }
        
}

function diePage($msg){
    echo "<div style='padding: 30px; width: 80%; margin: 0 auto; background: #f68d8d; border-radius: 5px; border: 1px solid; border-color: red; font-family: sans-serif; text-align: center;'>$msg</div>";
    die();
}

