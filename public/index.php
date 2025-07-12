<?php
require_once __DIR__ . '/../app/Autoloader.php';

$controllerName = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerPath = __DIR__ . '/../app/controllers/' . $controllerClass . '.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        if (method_exists($controller, $action)) {
            $controller->$action();
            exit;
        }
    }
}
// Jika tidak ditemukan, fallback ke login
require_once __DIR__ . '/../app/controllers/AuthController.php';
$auth = new AuthController();
$auth->login();
