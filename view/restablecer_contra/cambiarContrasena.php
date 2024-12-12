<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="login.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jquery.js"></script>
    <script src="js/restablecercontrasena.js"></script>
</head>
<body>
    <div class="container">
        <div class="frame">
            <div class="nav">
                <ul>
                    <li class="signin-active"><a class="btn">Restablecer Contraseña</a></li>
                </ul>
            </div>

            <!-- Formulario para enviar el correo -->
            <div id="resetPasswordForm" class="form-signin" style="display: block;">
                <form id="emailForm" method="POST" action="<?php echo getUrl('restablecer_contra', 'restablecer_contra', 'EnviarToken'); ?>">
                    <div class="divsesion">
                        <img src="../img/email-email-marketing.gif" alt="Restablecer contraseña" class="iniciarsesion">
                    </div>
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="form-styling" required placeholder="Ingresa tu correo electrónico">
                    <div class="btn-animate">
                        <button type="submit" class="btn-signin">Enviar código de restablecimiento</button>
                    </div>
                </form>
            </div>

            <!-- Formulario para verificar el código -->
            <div id="verifyCodeForm" class="form-signin" style="display:none;">
                <form id="codeForm" method="POST" action="<?php echo getUrl('restablecer_contra', 'restablecer_contra', 'verificarToken'); ?>">
                    <div class="divsesion">
                        <img src="../img/verify-code.png" alt="Verificar código" class="iniciarsesion">
                    </div>
                    <label for="code">Código de Verificación</label>
                    <input type="text" id="code" name="code" class="form-styling" required placeholder="Ingresa el código de verificación">
                    <div class="btn-animate">
                        <button type="submit" class="btn-signin">Verificar Código</button>
                    </div>
                </form>
            </div>

            <!-- Formulario para cambiar la contraseña -->
            <div id="newPasswordForm" class="form-signin" style="display:none;">
                <form id="passwordForm" method="POST" action="<?php echo getUrl('restablecer_contra', 'restablecer_contra', 'restablecer_contrasena'); ?>">
                    <div class="divsesion">
                        <img src="../img/reset-password.png" alt="Nueva contraseña" class="iniciarsesion">
                    </div>
                    <label for="password">Nueva Contraseña</label>
                    <input type="password" id="password" name="password" class="form-styling" required placeholder="Nueva contraseña">
                    <label for="confirmPassword">Confirmar Contraseña</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-styling" required placeholder="Confirmar nueva contraseña">
                    <div class="btn-animate">
                        <button type="submit" class="btn-signin">Cambiar Contraseña</button>
                    </div>
                </form>
            </div>

            <div class="forgot">
                <a href="login.php" id="btnVolver" class="btn-volver">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
</body>
</html>