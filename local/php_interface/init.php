<?php



if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/Entity.php")){
    require_once($_SERVER['DOCUMENT_ROOT'] . "/local/php_interface/Entity.php");
}

$filenames=scandir($_SERVER['DOCUMENT_ROOT'] . "/local/crm_handler");
foreach ($filenames as $filename) {
    $path = $_SERVER['DOCUMENT_ROOT'] . "/local/crm_handler/"  . $filename;
    if (is_file($path)) {
        require $path;
    }
}
$filenames=scandir($_SERVER['DOCUMENT_ROOT'] . "/local/task_handler");
foreach ($filenames as $filename) {
    $path = $_SERVER['DOCUMENT_ROOT'] . "/local/task_handler/"  . $filename;
    if (is_file($path)) {
        require $path;
    }
}


