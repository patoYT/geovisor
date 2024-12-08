<?php
include_once '../lib/helpers.php';
require_once '../controller/restablecer_contra/restablecer_contraController.php';

$controller = new restablecer_contra();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'request_reset':
            echo json_encode($controller->requestReset());
            break;
        case 'verify_code':
            echo json_encode($controller->verifyCode());
            break;
        case 'reset_password':
            echo json_encode($controller->resetPassword());
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Acción no reconocida.']);
            break;
    }
    exit;
}

include_once '../view/restablecer_contra/cambiarContrasena.php';

?>

