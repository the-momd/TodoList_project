<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?= SITE_TITLE ?></title>
  <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username"> Mohamad Amiri </span><img src="<?=BASE_URL?>/tpl/img.jpg" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
    <div class="title">Folders</div>
    <ul class="folder-list">
        <li class="<?= !isset($_GET['folder_id']) ? 'active' : '' ?>"> 
            <a style="text-decoration: none;" href="<?=site_url()?>">
                <i class="fa fa-folder"></i> All
            </a>
        </li>
        
        <?php foreach($folders as $folder): ?>
            <li class="<?= (isset($_GET['folder_id']) && $_GET['folder_id'] == $folder->id) ? 'active' : '' ?>">
                <a style="text-decoration: none;" href="<?=site_url("?folder_id=$folder->id")?>">
                    <i class="fa <?= (isset($_GET['folder_id']) && $_GET['folder_id'] == $folder->id) ? 'fa-folder-open' : 'fa-folder' ?>"></i> <?= $folder->name ?>
                </a>
                <a style="text-decoration: none;" class="remove" onclick="return confirm('Are you certain to delete this folder?\n<?= $folder->name ?>');" href="?delete_folder=<?= $folder->id ?>">
                    <i class="fa fa-trash-o"></i>
                </a>
            </li>
        <?php endforeach; ?>
      
    
      </ul>
</div>



      <div>
        <input type="text" id="addFolderInput" placeholder="Add New Folder" style="width: 70%; margin-left: 8%; border-radius: 3px;"/>
        <button class="btn clickable" id="addFolderBtn" style="padding: 5px 5px; border-radius: 3px; border: 1px solid #ccc; padding: 1px 7px; text-align: center;">+</button>
        </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title" style="width: 50%;">
        <input type="text" id="taskNameInput" placeholder="Add New Task" style="width: 100%; margin-left: 8%; border-radius: 3px; line-height:26px;">
        </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>

          <?php if(sizeof($tasks)): ?>
          <?php foreach($tasks as $task): ?>
            <li class="<?=$task->is_done ? 'checked' : '' ; ?>">
              <i data-taskId="<?=$task->id?>" class="isDone clickable <?=$task->is_done ? 'fa fa-check-square-o' : 'fa fa-square-o' ; ?>"></i>
              <span><?=$task->title?></span>
              <div class="info">
                <span style="font-size: 11px; margin-right: 12px;" class="created-at">Created At <?=$task->created_at?></span>
                <a style="text-decoration: none;" class="remove" onclick="return confirm('Are you certain to delete this task?\n<?= $task->title ?>');" href="?delete_task=<?=$task->id?>">                <i class="fa fa-trash-o"></i>
                </a>
              </div>
            </li>
          <?php endforeach; ?>
          <?php else: ?>
            <li>No Task Here</li>
          <?php endif;?>


           



          </ul>
        </div>
          
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>
  <script src="assets/js/script.js"></script>
  <script>
      $(document).ready(function(){

      $(document).on('click', '.isDone', function(e) {
        var tid = $(this).data('taskid');
          $.ajax({
              url: 'process/ajaxHandler.php',
              method: 'post',
              data: {action: "doneSwitch",taskId : tid},
              success: function(response){
                
                  location.reload();
               
              }
            });
      });


      $('#addFolderBtn').click(function(e){
        var input = $('input#addFolderInput');
        $.ajax({
          url: 'process/ajaxHandler.php',
          method: 'post',
          data: {action: "addFolder", folderName: input.val()},
          success: function(response){
            if(response == '1'){
              $('<li> <a style="text-decoration: none;" href="#"><i class="fa fa-folder"></i>'+input.val()+'</a></li>').appendTo('ul.folder-list');
            } else {
              alert(response);
            }
          }
        });
      });
    
      $('#taskNameInput').on('keypress',function(event) {
          event.stopPropagation();
          if (event.which == 13) {
            $.ajax({
            url: 'process/ajaxHandler.php',
            method: 'post',
            data: {action: "addTask",folderId : <?=$_GET['folder_id'] ?? 0 ?>, taskTitle: $('#taskNameInput').val()},
            success: function(response){
              if(response == '1'){
                location.reload();
              } else {
                alert(response);
              }
            }
          });
          }
      });
      $('#taskNameInput').focus();
    });
  </script>
</body>
</html>
