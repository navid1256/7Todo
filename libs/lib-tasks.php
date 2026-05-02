<<<<<<< HEAD
<?php
<<<<<<< HEAD
<<<<<<< HEAD

// defined('BASE_PATH') or die("Permision Denied !");
// if (!defined('BASE_PATH')) {
//     echo "Permission Denied !";
//     die();
// }

defined('BASE_PATH') or die("Permission Denied !");
/****Folder Function ***/
function newFolders(string $foldername)
{
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "INSERT INTO folders (name,user_id) VALUES (:foldername,:user_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':foldername' => $foldername, ':user_id' => $current_user_id]);
    return $stmt->rowCount();
}

function deleteFolder(int $folder_id)
{
    global $pdo;
    $sql = "DELETE FROM folders WHERE id = :folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folder_id' => $folder_id]);
    return $stmt->rowCount();
}

// function getCurrentUserId(){
//     return 1;
// }
function getFolders()
{
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "SELECT * FROM folders WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => $current_user_id]);
=======
=======
<?php defined('BASE_PATH') OR die("Permision Denied!");
// alternative to top code
// if(!defined('BASE_PATH')){
//     echo "Permision Denied!";
//     die();
// }
>>>>>>> 6d70a91 (add-tasks-finished)

/*** Folder Function ***/
function deleteFolder($folder_id){
    global $pdo;
    $sql = "delete from folders where id = $folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addFolder($folder_name){
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "INSERT INTO `folders` (name,user_id) VALUES (:folder_name,:user_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folder_name'=>$folder_name,':user_id'=>$current_user_id]);
    return $stmt->rowCount();
}

function getFolders(){
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "select * from folders where user_id = $current_user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
>>>>>>> 6a9e222 (folders-read-and-delete-is-ok)
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

<<<<<<< HEAD
/***Tasks Function***/
function deleteTask(int $task_id)
{
    global $pdo;
    $sql = "DELETE FROM tasks WHERE id = :task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':task_id' => $task_id]);
    return $stmt->rowCount();
}

function addTask(string $taskTitle, int $folderId)
{
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "INSERT INTO `tasks` (title,user_id,folder_id) VALUES (:title,:user_id,:folder_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':title' => $taskTitle, ':user_id' => $current_user_id, ':folder_id' => $folderId]);
    return $stmt->rowCount();
}
function getTasks()
{
    global $pdo;
    $folder = $_GET['folder_id'] ?? null;
    $current_user_id = getCurrentUserId();

    if (isset($folder) && is_numeric($folder)) {
        $sql = "SELECT * FROM tasks WHERE user_id = :user_id AND folder_id = :folder_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $current_user_id, ':folder_id' => $folder]);
    } else {
        $sql = "SELECT * FROM tasks WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $current_user_id]);
    }

    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}
=======
function getTasks(){
    return [1,2,3,4,5];
}
>>>>>>> 0d95f51 (build-project-structure)
=======
/*** Tasks Function ***/
function deleteTask($task_id){
    global $pdo;
    $sql = "delete from tasks where id = $task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addTask($taskTitle,$folderId){
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "INSERT INTO `tasks` (title,user_id,folder_id) VALUES (:title,:user_id,:folder_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':title'=>$taskTitle,':user_id'=>$current_user_id,':folder_id'=>$folderId]);
    return $stmt->rowCount();
}

function getTasks(){
<<<<<<< HEAD
    return 1;
}
>>>>>>> 6a9e222 (folders-read-and-delete-is-ok)
=======
    global $pdo;
    $folder = $_GET['folder_id'] ?? null;
    $folderCondition = '';
    if(isset($folder) and is_numeric($folder)){
        $folderCondition = " and folder_id=$folder";
    }

    $current_user_id = getCurrentUserId();
    $sql = "select * from tasks where user_id = $current_user_id $folderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}
>>>>>>> 6d70a91 (add-tasks-finished)
