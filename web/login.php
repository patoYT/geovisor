<?php
    include_once '../lib/helpers.php';
    include_once '../view/partials/header.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="mt-5">
            <div>
                <?php
                //Aqui verifico si hay errores almacenados en la variable de $_SESSION
    
                if (isset($_SESSION['errores'])) {
                    echo "<div class='alert alert-danger' roles='alert'>";
                    foreach ($_SESSION['errores'] as $error) {
                        echo $error . "<br>";
                    }
                    echo "</php";
                    //Con este elimino los errores de la variable de session para que no se muestren cada que cargo la pagina
                    unset($_SESSION['errores']);
                }
                ?>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Iniciar Sesión</h2>
                        <form action="<?php echo getUrl("Acceso","Acceso","postCreation",false,"ajax"); ?>" method="post" id="form">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="user" name="user" placeholder="nombre@ejemplo.com"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                                
                            </div>
                        </form>
                        <!-- <div class="text-center mt-3">
                            <a href="#" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>