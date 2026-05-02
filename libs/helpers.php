<<<<<<< HEAD
<?php
<<<<<<< HEAD
defined('BASE_PATH') OR die("Permision Denied !");
=======
>>>>>>> 0d95f51 (build-project-structure)
=======
<?php defined('BASE_PATH') OR die("Permision Denied!");

>>>>>>> 6d70a91 (add-tasks-finished)
function getCurrentUrl(){
    return 1;
}

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 6d70a91 (add-tasks-finished)
function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true;
    }
    return false;
}

<<<<<<< HEAD
function diepage($msg){
    echo $msg;
    die();
}

function dd($var){
    echo "<pre style='color: red;
    position: relative;
    z-index: 999;
    padding: 10px;
    margin: 10px;
    border-radius: 10px;
    background: white;' >";
    var_dump($var);
    echo "</pre>";
}

=======
function power($b,$p){
    return $b**$p;
=======
=======

>>>>>>> 6d70a91 (add-tasks-finished)
function diePage($msg){
    echo "<div style='padding: 30px; width: 80%; margin: 50px auto; background: #f9dede; border: 1px solid #cca4a4; color: #521717; border-radius: 5px; font-family: sans-serif;'>$msg</div>";
    die();
>>>>>>> 6a9e222 (folders-read-and-delete-is-ok)
}
<<<<<<< HEAD
>>>>>>> 0d95f51 (build-project-structure)
=======


function dd($var){
    echo "<pre style='color: #9c4100; background: #fff; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #c56705;'>";
    var_dump($var);
    echo "</pre>";
}
>>>>>>> 6d70a91 (add-tasks-finished)
