<?php
include_once '../lib/helpers.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script src="js/jquery.js"></script>
    <script src="js/login.js"></script>
</head>

<div class="container">
    <div class="frame">
        <div class="nav">
            <ul class"links">
                <li class="signin-active"><a class="btn">Iniciar sesion</a></li>
                <li class="signup-inactive"><a class="btn">Registrate</a></li>
            </ul>
        </div>
        <div ng-app ng-init="checked = false">
            <form class="form-signin" action="" method="post" name="form">
                <div class="divsesion">
                    <img src="../img/iniciar-sesion.png" alt="Iniciar secion" class="iniciarsesion">
                </div>
                <label for="username">Usuario</label>
                <input class="form-styling" type="text" name="username" placeholder="" />
                <label for="password">Contraseña</label>
                <input class="form-styling" type="password" name="password" placeholder="" />
                <div class="btn-animate">
                    <button type="submit" class="btn-signin">Iniciar sesion</button>
                </div>
                <div class="forgot">
                    <a href="#">Olvidates tu contraseña?</a>
                </div>
            </form>

            <form class="form-signup" action="" method="post" name="form">
                <div class="juntardos">
                    <div>
                        <label for="fullname">Nombres</label>
                        <input class="form-styling-two" type="text" name="nombre" placeholder="" />
                    </div>
                    <div>
                        <label for="fullname">Apellidos</label>
                        <input class="form-styling-two" type="text" name="apellido" placeholder="" />
                    </div>
                </div>
                <div class="juntardos">
                    <div class="col-md-4">
                        <label for="td">Tipo de documento</label>
                        <select name="td" class="form-styling-two">
                            <option value="">Seleccione...</option>
                            <?php
                            foreach ($tipodedocumentos as $tipodedocumento) {
                                echo "<option value='" . $tipodedocumentos['td_id'] . "'>" . $tipodedocumento['td_nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="numerodocumento">N° de documento</label>
                        <input class="form-styling-two" type="text" name="nombre" placeholder="" />
                    </div>
                </div>
                <div class="juntardos">
                <div>
                        <label for="telefono">Telefono</label>
                        <input class="form-styling-two" type="text" name="telefono" placeholder="" />
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input class="form-styling-two" type="email" name="email" placeholder="" />
                    </div>
                </div>
                <div class="juntardos">
                    <div>
                        <label for="password">Password</label>
                        <input class="form-styling-two" type="password" name="password" placeholder="" />
                    </div>
                    <div>
                        <label for="confirmpassword">Confirm password</label>
                        <input class="form-styling-two" type="password" name="confirmpassword" placeholder="" />
                    </div>
                </div>
                <button type="submit" class="btn-signup">Registrate</button>
            </form>
        </div>
    </div>
    </body>

</html>