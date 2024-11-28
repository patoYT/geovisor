<div class="mt-5">
    <h3 class="display4">Actualizar Usuarios</h3>
</div>

<?php
    foreach($usuarios as $usuario)
    {
?>
<form action="<?php echo getUrl("Usuarios","Usuarios","postUpdate"); ?>" method="post">
    <div class="row mt-5">
        <div class="col-md-4">
            <label for="usu_nombre">
                Nombre
            </label>
            <input type="text" name="usu_nombre" class="form-control" placeholder="Nombre" value="<?php
                echo $usuario['usu_nombre'];

            ?>">
            <input type="hidden" name="usu_id" class="form-control" placeholder="id" value="<?php
                echo $usuario['usu_id'];

            ?>">
        </div>
        <div class="col-md-4">
            <label  for="usu_apellido">
                Apellido
            </label>
            <input type="text" name="usu_apellido" class="form-control" placeholder="Apellido" value="<?php
                echo $usuario['usu_apellido'];
            ?>"> 
        </div>

        <div class="col-md-4">
            <label for="usu_td">tipo de documento</label>
            <select name="usu_td" id="" class="form-control">
                <option value="" >Seleccione...</option>
                <?php 
                    foreach($tipodedocumento as $tipo){
                        if($tipo['td_id']==$usuario['usu_td']){
                            $selected="selected";
                        }else{
                            $selected="";
                        }
                        echo "<option value='".$tipo['td_id']."'$selected>".$tipo['td_nombre']."</option>";
                    }
                ?>
            </select>
        </div>

        <div class="col-md-4">
            <label  for="usu_numerodocumento">
                Numero de documento
            </label>
            <input type="text" name="usu_numerodocumento" class="form-control" placeholder="Numero de documento" value="<?php
                echo $usuario['usu_numerodocumento'];
            ?>"> 
        </div>

        <div class="col-md-4">
            <label  for="usu_correo">
                Correo electronico
            </label>
            <input type="email" name="usu_correo" class="form-control" placeholder="Correo electronico" value="<?php
                echo $usuario['usu_correo'];
            ?>"> 
        </div>
        <div class="col-md-4">
            <label  for="usu_clave">
                Contraseña 
            </label>
            <input type="password" name="usu_clave" class="form-control" placeholder="Contraseña" value="<?php
                echo $usuario['usu_password'];
            ?>"> 
        </div>
        <div class="col-md-4">
            <label  for="usu_apellido">
                Telefono
            </label>
            <input type="text" name="usu_telefono" class="form-control" placeholder="Telefono" value="<?php
                echo $usuario['usu_telefono'];
            ?>"> 
        </div>
        
    <div class="mt-5">
        <h3 class="display4">Direccion</h3>
    </div>

        <div class="col-md-4">
            <label for="usu_tipo_via">tipo de via</label>
            <select name="usu_tipo_via" id="" class="form-control">
                <option value="" >Seleccione...</option>
                <?php 
                    foreach($tipoDeVia as $tipoVia){
                        if($tipoVia['tv_id']==$usuario['usu_tipo_via']){
                            $selected="selected";
                        }else{
                            $selected="";
                        }
                        echo "<option value='".$tipoVia['tv_id']."'$selected>".$tipoVia['tv_nombre']."</option>";
                    }
                ?>
            </select>
        </div>

        <div class="col-md-4">
            <label  for="usu_numero_via">
                Numero de via
            </label>
            <input type="text" name="usu_numero_via" class="form-control" placeholder="Numero de via" value="<?php
                echo $usuario['usu_numero_via'];
            ?>"> 
        </div>

        <div class="col-md-4">
            <label for="usu_tipo_via_interseccion">tipo de via de interseccion</label>
            <select name="usu_tipo_via_interseccion" id="" class="form-control">
                <option value="" >Seleccione...</option>
                <?php 
                    foreach($tipoDeVia as $tipoVia){
                        if($tipoVia['tv_id']==$usuario['usu_tipo_via_interseccion']){
                            $selected="selected";
                        }else{
                            $selected="";
                        }
                        echo "<option value='".$tipoVia['tv_id']."'$selected>".$tipoVia['tv_nombre']."</option>";
                    }
                ?>
            </select>
        </div>

        <div class="col-md-4">
            <label  for="usu_numero_adicional">
                Numero adiccional
            </label>
            <input type="text" name="usu_numero_adicional" class="form-control" placeholder="Numero adiccional" value="<?php
                echo $usuario['usu_numero_adicional'];
            ?>"> 
        </div>

        <div class="col-md-4">
            <label for="usu_barrio">Barrio</label>
            <select name="usu_barrio" id="" class="form-control">
                <option value="" >Seleccione...</option>
                <?php 
                    foreach($barrios as $barrio){
                        if($barrio['id_barrio']==$usuario['usu_barrio']){
                            $selected="selected";
                        }else{
                            $selected="";
                        }
                        echo "<option value='".$barrio['id_barrio']."'$selected>".$barrio['nombre_barrio']."</option>";
                    }
                ?>
            </select>
        </div>

        <div class="col-md-4">
            <label  for="usu_complemento">
                Complemento
            </label>
            <input type="text" name="usu_complemento" class="form-control" placeholder="Complemento" value="<?php
                echo $usuario['usu_complemento'];
            ?>"> 
        </div>

        <div class="mt-5">
            <h3 class="display4">Rol</h3>
        </div>

        <div class="col-md-4">
            <label for="usu_rol">Rol</label>
            <select name="usu_rol" id="" class="form-control">
                <option value="" >Seleccione...</option>
                <?php 
                    foreach($roles as $rol){
                        if($rol['rol_id']==$usuario['usu_rol']){
                            $selected="selected";
                        }else{
                            $selected="";
                        }
                        echo "<option value='".$rol['rol_id']."'$selected>".$rol['rol_nombre']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="mt-5">
        <input type="submit" value="enviar" class="btn btn-success">
    </div>
</form>
<?php
    }
?>