<?php
include_once '../lib/helpers.php';
include_once '../controller/restablecer_contra/restablecer_contraController.php';

$restablecer_contraController = new restablecer_contraController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una respuesta inicial
    $response = array('success' => false, 'message' => '');

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $result = $restablecer_contraController->EnviarToken();
        $response = $result;
    } elseif (isset($_POST['code'])) {
        $code = $_POST['code'];
        $result = $restablecer_contraController->verificarToken();
        $response = $result;
    } elseif (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        $result = $restablecer_contraController->restablecer_contrasena();
        $response = $result;
    } else {
        $response['message'] = 'Acción no válida';
    }

    // Cabecera para indicar tipo de contenido
    header('Content-Type: application/json');

    // Convertir el array a JSON manualmente (alternativa para JSON en PHP 5.2.5)
    echo json_encode($response);
    exit;
}

// Incluir la vista
include_once '../view/restablecer_contra/cambiarContrasena.php';
?>
