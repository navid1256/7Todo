<?php
include "bootstrap/init.php";
<<<<<<< HEAD
// use Hekmatinasser\Verta\Verta;
<<<<<<< HEAD
// echo(verta::now());
if (isset($_GET['delete_folder'])&& is_numeric($_GET['delete_folder'])) {
    $deletedCount = deleteFolder($_GET['delete_folder']);
    echo "$deletedCount Folders Succesfully Deleted";
}

if (isset($_GET['delete_task'])&& is_numeric($_GET['delete_task'])) {
    $deletedCount = deleteTask($_GET['delete_task']);
    echo "$deletedCount Tasks Succesfully Deleted";
}

$folders = getFolders();

$tasks = getTasks();
// dd($tasks);

include "views/view-index.php";
=======
// var_dump(Verta::now());
=======


if(isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])){
    $deletedCount = deleteFolder($_GET['delete_folder']);
    // echo "$deletedCount folders succesfully deleted!";
}

<<<<<<< HEAD
>>>>>>> 6a9e222 (folders-read-and-delete-is-ok)
=======
if(isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
    $deletedCount = deleteTask($_GET['delete_task']);
    // echo "$deletedCount Tasks succesfully deleted!";
}

>>>>>>> 6d70a91 (add-tasks-finished)

# connect to db and get tasks
$folders = getFolders();


$tasks = getTasks();
<<<<<<< HEAD
 
include "tpl/tpl-index.php";
>>>>>>> 0d95f51 (build-project-structure)
=======

include "tpl/tpl-index.php";
>>>>>>> 6a9e222 (folders-read-and-delete-is-ok)
