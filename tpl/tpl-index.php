<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?=SITE_TITLE?></title>
  <link rel="stylesheet" href="<?= site_url('assets/vendor/Font%20Awesome/css/fa-solid-subset.css') ?>">
  <link rel="stylesheet" href="<?= site_url('assets/vendor/Font%20Awesome/css/fa-regular-subset.css') ?>">
  <link rel="stylesheet" href="<?=BASE_URL?>assets/css/style.css">

</head>
<body>
<?php
$folders = $folders ?? [];
$tasks = $tasks ?? [];
?>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel">
    <a href="<?= site_url("?logout=1")?>" class="logout-link"><i class="fas fa-sign-out-alt"></i></a>
    <span class="username"><?= esc($user->username ?? 'Unknown'); ?></span>
    <img src="<?= esc($user->image ?? ''); ?>" width="40" height="40"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fas fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folder-list">
          <li class="<?=isset($_GET['folder_id']) ? '' : 'active'?>">
          <a href="<?= site_url() ?>"><i class="fas fa-folder"></i>All</a>
          </li>

          <?php foreach ($folders as $folder): ?>
          <li class="folder-item <?=(isset($_GET['folder_id']) && $_GET['folder_id'] == $folder->id) ? 'active' : ''?>">
          <a href="<?= site_url("?folder_id=$folder->id") ?>"><i class="fas fa-folder"></i><?=esc($folder->name)?></a>
          <form action="<?= site_url() ?>" method="post" class="remove-form">
            <input type="hidden" name="action" value="delete_folder">
            <input type="hidden" name="folder_id" value="<?= (int)$folder->id ?>">
            <input type="hidden" name="csrf_token" value="<?= esc(getCsrfToken()) ?>">
            <button type="submit" class="remove" onclick="return confirm('Are You Sure to delete this Item?\n<?=esc($folder->name)?>');"><i class="fas fa-trash-alt"></i></button>
          </form>
          </li>
          <?php endforeach;?>

        </ul>
      </div>
      <div>
        <input type="text" id="addFolderInput" style='width: 65%;margin-left:3%' placeholder="Add New Folder"/>
        <button id="addFolderBtn" class="btn clickable">+</button>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title" style="width: 50%;">
        <input type="text" id="taskNameInput" style="width: 100%;margin-left:3%;line-height: 30px;" placeholder="Add New Task">
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
          <?php if (sizeof($tasks)): ?>
          <?php foreach ($tasks as $task): ?>
            <li class="<?=$task->is_done ? 'checked' : '';?>">
              <i data-taskId="<?=$task->id?>" class="isDone clickable <?=$task->is_done ? 'fas fa-check-square' : 'far fa-square';?> "></i>
              <span><?=esc($task->title)?></span>
              <div class="info">
                <span class='created-at'>Created At <?=esc($task->created_at)?></span>
                <form action="<?= site_url() ?>" method="post" class="remove-form">
                  <input type="hidden" name="action" value="delete_task">
                  <input type="hidden" name="task_id" value="<?= (int)$task->id ?>">
                  <input type="hidden" name="csrf_token" value="<?= esc(getCsrfToken()) ?>">
                  <button type="submit" class="remove" onclick="return confirm('Are You Sure to delete this Item?\n<?=esc($task->title)?>');"><i class="fas fa-trash-alt"></i></button>
                </form>
              </div>
            </li>
            <?php endforeach;?>
          <?php else: ?>
            <li>No Task Here ..</li>
          <?php endif;?>

          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="assets/js/script.js"></script>
  <script>
    $(document).ready(function(){
      function escapeHtml(text) {
        return $('<div>').text(text).html();
      }

      function bindDoneSwitch($scope) {
        $scope.find('.isDone').off('click').on('click', function(){
          var $icon = $(this);
          var tid = $icon.attr('data-taskId');
          $.ajax({
            url : "process/ajaxHandler.php",
            method : "post",
            dataType: "json",
            data : {action: "doneSwitch",taskId : tid, csrf_token: "<?= esc(getCsrfToken()) ?>"},
            success : function(response){
              if(!response || !response.ok){
                alert(response && response.message ? response.message : 'Error');
                return;
              }
              if(response.data && parseInt(response.data.isDone, 10) === 1){
                $icon.removeClass('far fa-square').addClass('fas fa-check-square');
                $icon.closest('li').addClass('checked');
              }else{
                $icon.removeClass('fas fa-check-square').addClass('far fa-square');
                $icon.closest('li').removeClass('checked');
              }
            }
          });
        });
      }

      function buildTaskItem(task){
        var iconClass = parseInt(task.isDone, 10) === 1 ? 'fas fa-check-square' : 'far fa-square';
        return '' +
          '<li>' +
            '<i data-taskId="' + task.id + '" class="isDone clickable ' + iconClass + '"></i>' +
            '<span>' + escapeHtml(task.title) + '</span>' +
            '<div class="info">' +
              '<span class="created-at">Created At ' + escapeHtml(task.createdAt) + '</span>' +
              '<form action="<?= site_url() ?>" method="post" class="remove-form">' +
                '<input type="hidden" name="action" value="delete_task">' +
                '<input type="hidden" name="task_id" value="' + task.id + '">' +
                '<input type="hidden" name="csrf_token" value="<?= esc(getCsrfToken()) ?>">' +
                '<button type="submit" class="remove" onclick="return confirm(\'Are You Sure to delete this Item?\\n' + escapeHtml(task.title).replace(/'/g, "\\'") + '\');"><i class="fas fa-trash-alt"></i></button>' +
              '</form>' +
            '</div>' +
          '</li>';
      }

      bindDoneSwitch($(document));

      $('#addFolderBtn').click(function(e){
          var input = $('input#addFolderInput');
          var val = $.trim(input.val());
          if(val.length < 3){
            alert('نام فولدر باید بزرگتر از 2 حرف باشد.');
            return;
          }
          $.ajax({
            url : "process/ajaxHandler.php",
            method : "post",
            dataType: "json",
            data : {action: "addFolder",folderName: val, csrf_token: "<?= esc(getCsrfToken()) ?>"},
            success : function(response){
              if(response && response.ok){
                location.reload();
              }else{
                alert(response && response.message ? response.message : 'Error');
              }
            }
          });
      });

      $('#taskNameInput').on('keypress',function(e) {
          e.stopPropagation();
          if(e.which == 13) {
              var $input = $('#taskNameInput');
              var title = $.trim($input.val());
              if(title.length < 3){
                alert('عنوان تسک باید بزرگتر از 2 حرف باشد.');
                return;
              }
              $.ajax({
                url : "process/ajaxHandler.php",
                method : "post",
                dataType: "json",
                data : {action: "addTask",folderId : <?= (int)($_GET['folder_id'] ?? 0) ?> ,taskTitle: title, csrf_token: "<?= esc(getCsrfToken()) ?>"},
                success : function(response){
                  if(response && response.ok){
                    var $list = $('.main .view .content .list ul');
                    $list.find('li').filter(function(){
                      return $(this).text().trim() === 'No Task Here ..';
                    }).remove();
                    var html = buildTaskItem(response.data);
                    $list.prepend(html);
                    bindDoneSwitch($list);
                    $input.val('');
                  }else{
                    alert(response && response.message ? response.message : 'Error');
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
