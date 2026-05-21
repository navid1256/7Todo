<?php
include "bootstrap/init.php";

if(isset($_GET['logout'])){
    logout();
    redirect(site_url('auth.php'));
}

if(!isLoggedIn()){
    // redirect to aut form
    redirect(site_url('auth.php'));
}
# user is LoggedIn
$user = getLoggedInUser();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){
    if(!verifyCsrfToken($_POST['csrf_token'] ?? '')){
        diePage('Invalid CSRF token!');
    }
    if($_POST['action'] === 'delete_folder' && isset($_POST['folder_id']) && is_numeric($_POST['folder_id'])){
        deleteFolder((int)$_POST['folder_id']);
        redirect(site_url());
    }
    if($_POST['action'] === 'delete_task' && isset($_POST['task_id']) && is_numeric($_POST['task_id'])){
        deleteTask((int)$_POST['task_id']);
        redirect(site_url());
    }
}


# connect to db and get tasks
$folders = getFolders();


$tasks = getTasks();

include "tpl/tpl-index.php";
