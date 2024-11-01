<?php

/*** Folder Functions  ***/

function deleteFolder($folder_id){
    global $pdo;
    $sql = "DELETE  FROM folders where id = $folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addFolders($folder_name) {
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "INSERT INTO folders (name, user_id) VALUES (:folder_name, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':folder_name' => $folder_name,
        ':user_id' => $current_user_id
    ]);
    return $stmt->rowCount();
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

/*** Tasks Functions  ***/


function getTasks(){
    return [1,2,3,4,5];
}
function removeTasks(){
    return [1,2,3,4,5];
}
function AddTasks(){
    return [1,2,3,4,5];
}