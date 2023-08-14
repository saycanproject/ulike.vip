<?php
session_start();
define('BASE_PATH', __DIR__);
spl_autoload_register(function($class_name){
    if(file_exists('m/' . $class_name . '.php')) {
        require_once 'm/' . $class_name . '.php';
    } else if(file_exists('c/' . $class_name . '.php')) {
        require_once 'c/' . $class_name . '.php';
    }
});
$controllerName = $_REQUEST['controller'] ?? 'User';
$actionName = $_REQUEST['action'] ?? 'login';
$controllerClass = ucfirst($controllerName) . "Controller";
if (!class_exists($controllerClass)) {
    die("Controller does not exist");
}
$controller = new $controllerClass;
if (!method_exists($controller, $actionName)) {
    die(msg("Action does not exist"));
}
$controller->$actionName();
function load_view($view, $data = []) {
    $view_path = BASE_PATH . "/v/{$view}.php";
    if (file_exists($view_path)) {
        extract($data);
        include($view_path);
    } else {
        die("View {$view} not found");
    }
}
function load_partial($partial_name) {
    $partial_path = BASE_PATH . '/v/partials/' . $partial_name . '.php';
    if(file_exists($partial_path)) {
        include($partial_path);
    } else {
        echo "Warning: Failed to include partial: " . $partial_path;
    }
}
function msg($message) {
    ob_start(); // start output buffering
    include(BASE_PATH . '/v/partials/header.php');
    echo $message;
    include(BASE_PATH . '/v/partials/footer.php');
    $output = ob_get_contents(); // get buffer content
    ob_end_clean(); // clean the buffer
    echo $output; // output the buffer content
}
