<?php

function getCurrentUserId(){
    return 1;
}

function addFolders($data){
    global $pdo;
    $sql = "SELECT * FROM folders";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}
function getFolders(){
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "SELECT * FROM folders where user_id = $current_user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function getTasks(){
    return [1,2,3,4,5];
}