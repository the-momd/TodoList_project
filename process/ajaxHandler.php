<?php 

include_once "../bootstrap/init.php";
if(!isAjaxRequest()){
    diePage("Invalid Request!");
}

if(!isset($_POST['action']) || empty($_POST['action'])){
    diePage("Invalid action!");
}

switch ($_POST['action']){
    
    case "doneSwitch";
    $task_id = $_POST['taskId']; 
    if(!isset($task_id) || !is_numeric($task_id)){
        echo "آی دی تسک معتبر نیست";
        die();
    }
    
    doneSwitch($task_id);

    break;
    
    case "addFolder";
        if(!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3){
            echo "نام فولدر باید بزرگ تر از دو حرف باشد";
            die();
        }
       echo addFolder($_POST['folderName']);
    break;
    
    case "addTask":
        $folderId = isset($_POST['folderId']) ? $_POST['folderId'] : null;
        $taskTitle = isset($_POST['taskTitle']) ? $_POST['taskTitle'] : null;
        
        if(empty($folderId)){
            echo "فولدر را انتخاب کنید";
            die();
        }
        
        if(empty($taskTitle) || strlen($taskTitle) < 3){
            echo "عنوان تسک باید بیشتر از سه حرف باشد";
            die();
        }
    
        echo addTask($taskTitle, $folderId);

        break;
    


    default:
        diePage("Invalid action!");
}

