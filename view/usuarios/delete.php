<div class="mt-5">
    <h3 class="display4">Actualizar Usuarios</h3>
</div>

<?php
    foreach($usuarios as $usuario)
    {
?>
<form action="<?php echo getUrl("Usuarios","Usuarios","postDelete"); ?>" method="post">
    <div class="row mt-5">
        <div class="col-md-4">
            <label for="usu_nombre">
                Nombre
            </label>
            <input type="text" name="usu_nombre" class="form-control" placeholder="Nombre" readonly value="<?php
                echo $usuario['NOMBRE_USUARIO'];

            ?>">
            <input type="hidden" name="usu_id" class="form-control" placeholder="id" readonly value="<?php
                echo $usuario['ID_USUARIO'];

            ?>">
        </div>
        <div class="col-md-4">
            <label  for="usu_apellido">
                Apellido
            </label>
            <input type="text" name="usu_apellido" class="form-control" placeholder="Apellido" readonly value="<?php
                echo $usuario['APELLIDO_USUARIO'];
            ?>"> 
        </div>
        <div class="col-md-4">
            <label  for="usu_correo">
                Correo electronico
            </label>
            <input type="email" name="usu_correo" class="form-control" placeholder="Correo electronico" readonly value="<?php
                echo $usuario['CORREO_USUARIO'];
            ?>"> 
        </div>
        <div class="col-md-4">
            <label  for="usu_clave">
                Contraseña 
            </label>
            <input type="password" name="usu_clave" class="form-control" placeholder="Contraseña" readonly value="<?php
                echo $usuario['CLAVE_USUARIO'];
            ?>"> 
        </div>
        <div class="col-md-4">
            <label for="usu_rol">Rol</label>
            <input type="email" name="usu_rol" class="form-control" placeholder="Rol" readonly value="<?php
                echo $usuario['rol_nombre'];
            ?>"> 
        </div>
    </div>
    <div class="mt-5">
        <input type="submit" value="enviar" class="btn btn-success">
    </div>
</form>
<?php
    }
?>