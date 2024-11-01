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
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username"> Mohamad Amiri </span><img src="tpl/img.jpg" width="40" height="40"/></div>
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
          <?php foreach($folders as $folder): ?>
          <li>
          <a style="text-decoration: none;" href="?folder_id=<?= $folder->id ?>"><i class="fa fa-folder"></i> <?= $folder->name ?> </a>
          <a style="text-decoration: none;" class="remove" href="?delete_folder=<?= $folder->id ?>">x</a>
          </li>
          <?php endforeach; ?>
          <li class="active"> <i class="fa fa-folder-open"></i>Current Folder</li>
        </ul>
      </div>
      <div>
        <input type="text" id="addFolderInput" placeholder="Add New Folder" style="width: 70%; margin-left: 8%; border-radius: 3px;"/>
        <button class="btn clickable" id="addFolderBtn" style="padding: 5px 5px; border-radius: 3px; border: 1px solid #ccc; padding: 1px 7px; text-align: center;">+</button>
        </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title">Manage Tasks</div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            <li class="checked"><i class="fa fa-check-square-o"></i><span>Update team page</span>
              <div class="info">
                <div class="button green">In progress</div><span>Complete by 25/04/2014</span>
              </div>
            </li>
            <li><i class="fa fa-square-o"></i><span>Design a new logo</span>
              <div class="info">
                <div class="button">Pending</div><span>Complete by 10/04/2014</span>
              </div>
            </li>
            <li><i class="fa fa-square-o"></i><span>Find a front end developer</span>
              <div class="info"></div>
            </li>
          </ul>
        </div>
        <div class="list">
          <div class="title">Tomorrow</div>
          <ul>
            <li><i class="fa fa-square-o"></i><span>Find front end developer</span>
              <div class="info"></div>
            </li>
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
      $('#addFolderBtn').click(function(e){
        var input = $('input#addFolderInput');
        $.ajax({
          url: 'process/ajaxHandler.php',
          method: 'post',
          data: {action: "addFolder", folderName: input.val()},
          success: function(response){
            if(response = '1'){
              $('<li> <a style="text-decoration: none;" href="#"><i class="fa fa-folder"></i>'+input.val()+'</a></li>').appendTo('ul.folder-list');
            } else {
              alert(response);
            }
          }
        });
      });
    });
  </script>
</body>
</html>
