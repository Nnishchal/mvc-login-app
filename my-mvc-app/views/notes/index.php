<?php
session_start();

// DB connection (adjust as needed)
require_once('core/db.php'); // assumes you have Db::getInstance() inside

// Autoload models
spl_autoload_register(function ($class_name) {
    $file = 'models/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
});

// Routing logic
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'home':
        require_once('controllers/home_controller.php');
        $controllerInstance = new HomeController();
        break;

    case 'login':
        require_once('controllers/login_controller.php');
        $controllerInstance = new LoginController();
        break;

    case 'notes':
        require_once('controllers/notes_controller.php');
        $controllerInstance = new NotesController();
        break;

    default:
        die("Unknown controller: $controller");
}

// Call the action method
if (method_exists($controllerInstance, $action)) {
    $controllerInstance->$action();
} else {
    die("Unknown action: $action");
}
