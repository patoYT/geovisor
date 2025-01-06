<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar solicitudes</title>
</head>
<body>
    <div class="mt-5">
        <h3 class="display-4">
            Consultar solicitudes
        </h3>

    </div>
    <div class="row">
        <div class="col-md-3 mt-4">
            <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Buscar por Nombre o Correo" data-url='<?php echo getUrl("Usuarios", "Usuarios", "buscar", false, "ajax") ?>' >
        </div>
        <div class="table-responsive mt-3">
        <table class="table table-primary table-hover">
            <thead>
                <tr>
                    <th>Estado Solicitud</th>
                    <th>Tipo de Solicitud</th>
                    <th>Nuevo/Reparacion</th>
                    <th>Ver detalles</th>
                </tr>
                

            </thead>
            <tbody>
                <?php
                    foreach($usuarios as $usuario){
                        echo"<tr>";
                            echo "<td>".$usuario['td_nombre']."</td>";
                            echo "<td>".$usuario['usu_numerodocumento']."</td>";
                            echo "<td>".$usuario['usu_nombre']." ".$usuario['usu_apellido']."</td>";
                            echo "<td>".$usuario['usu_correo']."</td>";
                            echo "<td>".$usuario['usu_telefono']."</td>";
                            echo "<td>".$usuario['tv_nombre']." ".$usuario['usu_numero_via']." ".$usuario['tipo_via_nombre']." ".$usuario['usu_numero_interseccion']." ".$usuario['usu_complemento']." ".$usuario['nombre_barrio']."</td>";
                            if ($usuario['usu_estado'] == 1){
                                $class = "btn btn-danger";
                                $texto = "Inhabilitar";
                            }elseif ($usuario['usu_estado'] == 2){
                                $class = "btn btn-success";
                                $texto = "Habilitar";
                            }

                            echo "<td>";
                            if (!empty($class))echo "<button type='button' class='$class' id='cambiar_estado' data-url='".getUrl("Usuarios","Usuarios","postUpdateStatus",false,"ajax")."' data-id='".$usuario['usu_estado']."' data-user='".$usuario['usu_id']."'>$texto</button>";

                            echo "</td>";                            
                            echo "<td>"
                                ."<a href ='".getUrl("Usuarios","Usuarios","getUpdate",array("usu_id"=>$usuario['usu_id']))."'>"
                                    ."<button class='btn btn-primary'>Editar</button>"
                                ."</a>"
                            ."</td>";    
                            echo "<td>"
                                ."<a href ='".getUrl("Usuarios","Usuarios","getDelete",array("usu_id"=>$usuario['usu_id']))."'>"
                                    ."<button class = 'btn btn-danger'>Eliminar</button>"
                                ."</a>"
                            ."</td>";                       
                        echo"</tr>";
                    }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>