<?php
session_start();

function redirect($url)
{   
    echo "<script type='text/javascript'>"
        . "window.location.href='$url'"
        . "</script>";

    //Funcion para redireccionar a la pagina
}
function dd($var)
{
    echo "<pre>"; //organiza datos de forma vertical 
    die(print_r($var));
}

function getUrl($modulo, $controlador, $funcion, $parametros = false, $pagina = false)
{ //funcion que obtiene la url

    if ($pagina == false) {
        $pagina = "index";
    }
    $url = "$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
    if ($parametros != false) {
        foreach ($parametros as $key => $value) {
            $url .= "&$key=$value";   //clave indice valor
        }
    }
    return $url;
}

function resolve()
{ //Funcion que realiza las validaciones
    $modulo = ucwords($_GET['modulo']); //Tarea
    $controlador = ucwords($_GET['controlador']); //TareaController.php
    $funcion = $_GET['funcion']; //getTareas()
    //modulo == carpeta en controlador
    //controlador == archivo en el modulo 
    //funcion == metodo del controlador

    if (is_dir("../controller/$modulo")) { //valida si la carpeta/modulo existe

        if (file_exists("../controller/$modulo/" . $controlador . "Controller.php")) { //valida si el archivo/controlador existe

            include_once "../controller/$modulo/" . $controlador . "Controller.php";

            $nombreClase = $controlador . "Controller"; //TareaController
            $objClase = new $nombreClase();

            if (method_exists($objClase, $funcion)) {
                $objClase->$funcion();
            } else {
                echo "La funcion especificada no existe";
            }
        } else {
            echo "El controlador especificado no existe";
        }
    } else {
        echo "El modulo expecificado no existe";
    }

}
//query  street parameter
//camel case
function ValidarCampoLetras($input)
{
    $patron = "/^[a-zA-Z\s]+$/";
    return preg_match($patron, $input) == 1;
}
function ValidarCampoNumeros($input)
{
    $patron = "/^[0-9]+$/";
    return preg_match($patron, $input) == 1;
}
?>