<?php
include_once "../bootstrap/init.php";

if(!isAjaxRequest()){
    diePage("Invalid Request!");
}

if(!isset($_POST['action']) || empty($_POST['action'])){
    diePage("Invalid Action!");
}

if(!isLoggedIn()){
    diePage("Unauthorized!");
}

if(!verifyCsrfToken($_POST['csrf_token'] ?? '')){
    diePage("Invalid CSRF token!");
}

header('Content-Type: application/json; charset=utf-8');

function jsonResponse($ok, $message = '', $data = []){
    echo json_encode([
        'ok' => (bool)$ok,
        'message' => (string)$message,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);
    die();
}

switch($_POST['action']){
    case "doneSwitch":
        $task_id = $_POST['taskId'];
        if(!isset($task_id) || !is_numeric($task_id)){
            jsonResponse(false, "آیدی تسک معتبر نیست");
        }
        $updated = doneSwith((int)$task_id);
        if(!$updated){
            jsonResponse(false, "تسک پیدا نشد.");
        }
        $task = getTaskById((int)$task_id);
        jsonResponse(true, "ok", [
            'taskId' => (int)$task_id,
            'isDone' => isset($task->is_done) ? (int)$task->is_done : 0
        ]);
    break;
    case "addFolder":
        if(!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3){
            jsonResponse(false, "نام فولدر باید بزرگتر از 2 حرف باشد.");
        }
        $added = addFolder($_POST['folderName']);
        if(!$added){
            jsonResponse(false, "خطا در ایجاد فولدر.");
        }
        jsonResponse(true, "ok");
    break;
    case "addTask":
        $folderId = $_POST['folderId'];
        $taskTitle = $_POST['taskTitle'];
        if(!isset($folderId) || empty($folderId)){
            jsonResponse(false, "فولدر را انتخاب کنید.");
        }
        if(!isset($taskTitle) || strlen($taskTitle) < 3){
            jsonResponse(false, "عنوان تسک باید بزرگتر از 2 حرف باشد.");
        }
        $added = addTask($taskTitle,$folderId);
        if(!$added){
            jsonResponse(false, "افزودن تسک انجام نشد.");
        }
        $taskId = (int)$pdo->lastInsertId();
        $task = getTaskById($taskId);
        jsonResponse(true, "ok", [
            'id' => $taskId,
            'title' => esc($task->title ?? $taskTitle),
            'createdAt' => esc($task->created_at ?? date('Y-m-d H:i:s')),
            'isDone' => isset($task->is_done) ? (int)$task->is_done : 0
        ]);
    break;

    default:
        diePage("Invalid Action!");
}
