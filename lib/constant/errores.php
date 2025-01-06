<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

</body>

</html>
<?php
include_once '../lib/helpers.php';

if (isset($_SESSION['errores']['iniciarsesion'])) {
    if (isset($_SESSION['errores'])) { // Sin paréntesis adicionales
?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Usuario y/o contraseña incorrectos"
            });
        </script>
    <?php
    }
}
if (isset($_SESSION['errores']['registrar'])) {
    if (isset($_SESSION['errores']['registrar']['aceptado'])) { // Sin paréntesis adicionales
    ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "Completado",
                text: "Se hizo el registro con éxito"
            });
        </script>
<?php
    } elseif (isset($_SESSION['errores']['registrar']['denegado'])) { // Sin paréntesis adicionales
        ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "No se pudo completar el registro"
            });
        </script>
        <?php
    }
}
unset($_SESSION['errores']);
?>
