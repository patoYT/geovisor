
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script src="js/jquery.js"></script>
    <script src="js/global.js"></script>

</head>
<?php
    include_once '../controller/Usuarios/UsuariosController.php';
?>
<div class="container">
    <div class="frame">
        <div class="nav">
            <ul>
                <li class="signin-active"><a class="btn">Iniciar sesion</a></li>
                <li class="signup-inactive"><a class="btn">Registrate</a></li>
            </ul>
        </div>
        <div ng-app ng-init="checked = false">
            <form class="form-signin" action="<?php echo getUrl("Acceso", "Acceso", "postCreation", false, "ajax"); ?>" method="post" name="form-sigin" id="form-sigin">
                <div class="divsesion">
                    <img src="../img/iniciar-sesion.png" alt="Iniciar secion" class="iniciarsesion">
                </div>
                <label for="user">Usuario</label>
                <input class="form-styling" type="email" name="user" id="user" placeholder="" require />
                <label for="password">Contraseña</label>
                <input class="form-styling" type="password" name="pass" id="pass" placeholder="" />
                <div class="btn-animate">
                    <button type="submit" class="btn-signin">Iniciar sesion</button>
                </div>
                <div class="forgot">
                    <a href="#">Olvidates tu contraseña?</a>
                </div>
            </form>

            <form class="form-signup" action="<?php echo getUrl("Usuarios", "Usuarios", "postCreate", false, "ajax"); ?>" method="post" name="form-signup" id="form-signup">
                <div class="juntardos">
                    <div>
                        <label for="fullname">Nombres</label>
                        <input class="form-styling-two" type="text" name="nombre" id="nombre" placeholder="" />
                    </div>
                    <div>
                        <label for="fullname">Apellidos</label>
                        <input class="form-styling-two" type="text" name="apellido" id="apellido" placeholder="" />
                    </div>
                </div>
                <div class="juntardos">
                    <div class="col-md-4">
                        <label for="td[]">Tipo de documento</label>
                        <select name="td" id="td" class="form-styling-two">
                            <option value="">Seleccione...</option>
                            <?php
                            foreach ($tipodedocumentos as $tipodedocumento) {
                                echo "<option value='" . $tipodedocumento['td_id'] . "'>" . $tipodedocumento['td_nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="numerodocumento">N° de documento</label>
                        <input class="form-styling-two" type="text" name="numerodocumento" placeholder="" />
                    </div>
                </div>
                <div class="juntardos">
                    <div>
                        <label for="telefono">Telefono</label>
                        <input class="form-styling-two" type="text" name="telefono" id="telefono" placeholder="" />
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input class="form-styling-two" type="email" name="email" id="email" placeholder="" />
                    </div>
                </div>
                <div class="juntardos">
                    <div>
                        <label for="password">Password</label>
                        <input class="form-styling-two" type="password" name="password" id="password" placeholder="" />
                    </div>
                    <div>
                        <label for="confirmpassword">Confirm password</label>
                        <input class="form-styling-two" type="password" name="confirmpassword" placeholder="" />
                    </div>
                </div>
                <div>
                    <label for="direccion">
                        <p><b>Direccion</b></p>
                    </label>
                </div>
                <div class="juntardos">
                    <div>
                        <label for="tipovia">Tipo de via</label>
                        <select name="tipovia" class="form-styling-select">
                            <option value="">Seleccione...</option>
                            <?php
                            foreach ($tipo_vias as $tipo_via) {
                                echo "<option value='" . $tipo_via['tv_id'] . "'>" . $tipo_via['tv_nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="numero">numero</label>
                        <input class="form-styling-num" type="text" name="numeroprincipal" placeholder="" />
                    </div>
                    <div>
                        <label for="letra">Complemento</label>
                        <select name="letra" class="form-styling-select">
                            <option value="">Seleccione...</option>
                            <option value="0">Norte</option>
                            <option value="1">Sur</option>
                            <option value="2">Este</option>
                            <option value="3">Oeste</option>
                            <option value="4">A</option>
                            <option value="5">B</option>
                            <option value="6">D</option>
                            <option value="7">F</option>
                        </select>
                    </div>
                    <div>
                        <label for="tipovia">Tipo de via interseccion</label>
                        <select name="tipovia" class="form-styling-select">
                            <option value="">Seleccione...</option>
                            <?php
                            foreach ($tipo_vias as $tipo_via) {
                                echo "<option value='" . $tipo_via['tv_id'] . "'>" . $tipo_via['tv_nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="numero">numero</label>
                        <input class="form-styling-num" type="text" name="numeroprincipal" placeholder="" />
                    </div>
                    <div>
                        <label for="letra">Letra</label>
                        <select name="letra" class="form-styling-select">
                            <option value="">Seleccione...</option>
                            <option value="0">-</option>
                            <option value="1">A</option>
                            <option value="2">AS</option>
                            <option value="3">N</option>
                            <option value="4">A</option>
                            <option value="5">B</option>
                            <option value="6">D</option>
                            <option value="7">F</option>
                        </select>
                    </div>
                    <div>
                        <label for="numero">numero</label>
                        <input class="form-styling-num" type="text" name="numeroprincipal" placeholder="" />
                    </div>
                </div>
                <div class="juntardos">
                    <div>
                        <label for="complemento">Complemento</label>
                        <input class="form-styling-two" type="text" name="numeroprincipal" placeholder="" />
                    </div>
                    <div>
                        <label for="barrio">Barrio</label>
                        <select name="barrio" class="form-styling-two">
                            <option value="">Seleccione...</option>
                            <?php
                            foreach ($barrios as $barrio) {
                                echo "<option value='" . $barrio['id_barrio'] . "'>" . $barrio['nombre_barrio'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <button type="submit" class="btn-signup">Registrate</button>
            </form>
        </div>
    </div>
    </body>

</html>|