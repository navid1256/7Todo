<?php
<<<<<<< HEAD
include "constant.php";
include BASE_PATH."bootstrap/config.php";

include BASE_PATH."libs/helpers.php";

include BASE_PATH."vendor/autoload.php";

try {
    $pdo = new PDO("mysql:dbname=$database_config->db; host={$database_config->host}", $database_config->user, $database_config->pass);
} catch (PDOException $e) {
    diepage('Connection failed :' . $e->getMessage()) ;
}
include BASE_PATH."libs/lib-auth.php";
include BASE_PATH."libs/lib-tasks.php";
=======
include "constants.php";
include BASE_PATH . "bootstrap/config.php";
include BASE_PATH . "vendor/autoload.php";
include BASE_PATH . "libs/helpers.php";

try {
    $pdo = new PDO("mysql:dbname=$database_config->db;host={$database_config->host}", $database_config->user, $database_config->pass);
} catch (PDOException $e) {
    diePage('Connection failed: ' . $e->getMessage());
}

include BASE_PATH . "libs/lib-auth.php";
include BASE_PATH . "libs/lib-tasks.php";

// echo "Connection to Database is OK!";

>>>>>>> 0d95f51 (build-project-structure)
