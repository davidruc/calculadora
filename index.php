<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="form" action="index.php" method="post">
        <h1 class="titulo"> Calculadora: </h1>
        <div class="cuadroEntrada">
            <input class="input" type="text" name="operacion">
            <input type="submit" value="=">
        </div>
    </form>
</body>
</html>
<?php

$data = $_POST;
$entrada = array_values($data)[0];
class calculadora{
    
    public function suma(){
        global $entrada;
        $datos = explode('+', $entrada);
        $suma = array_sum($datos);
        echo "<p class='p'> Resultado: $suma </p>";
    }
    public function resta(){
        global $entrada;
        $datos = explode('-', $entrada);
        $resta = $datos[0];
        foreach($datos as $key => $val){
            if($key > 0){
                $resta -= $val;
            }
        }
        echo "<p class='p'> Resultado: $resta </p>";
    }

    public function mezcla3(){
        global $entrada;
        if ($entrada === "0/0"){
            $division = "Indeterminado";
        }else {
            $datos = explode('/', $entrada);
            $datos_sin_0 = array_shift($datos);
            $division = array_reduce($datos, function($acumulado, $valor){
                return $acumulado/$valor;
            }, $datos_sin_0);
        }
        var_dump($division);
        $datos = explode('+', $entrada);
        $datos[0] = $division;
        $suma = array_sum($datos);
        $datos = explode('-', $entrada);
        $resta = $suma;
        foreach($datos as $key => $val){
            if($key > 0){
                $resta -= $val;
            }
        }
        echo "<p class='p'> Resultado: $resta </p>";
    }


    public function mezcla2(){
        global $entrada;
        $datos = explode("*", $entrada);
        $multiplicacion = array_reduce($datos, function($acumulado, $valor){
            return $acumulado*$valor;
        }, 1);
        $datos = explode('+', $entrada);
        $datos[0] = $multiplicacion;
        $suma = array_sum($datos);
        $datos = explode('-', $entrada);
        $resta = $suma;
        foreach($datos as $key => $val){
            if($key > 0){
                $resta -= $val;
            }
        }
        echo "<p class='p'> Resultado: $resta </p>";
    }

    public function mezcla(){
        global $entrada;
        $datos = explode('+', $entrada);
        $suma = array_sum($datos);
        $datos = explode('-', $entrada);
        $resta = $suma;
        foreach($datos as $key => $val){
            if($key > 0){
                $resta -= $val;
            }
        }
        echo "<p class='p'> Resultado: $resta </p>";

    }
    public function producto(){
        global $entrada;
        $datos = explode('*', $entrada);
        $multiplicacion = array_reduce($datos, function($acumulado, $valor){
            return $acumulado*$valor;
        }, 1);
        echo "<p class='p'> Resultado: $multiplicacion </p>";
    }
    public function division(){
        global $entrada;
        if ($entrada === "0/0"){
            $division = "Indeterminado";
        }else {
            $datos = explode('/', $entrada);
            $datos_sin_0 = array_shift($datos);
            $division = array_reduce($datos, function($acumulado, $valor){
                return $acumulado/$valor;
            }, $datos_sin_0);
        }
        echo "<p class='p'> Resultado: $division </p>";
    }
    public function validacion(){
        global $entrada;
        $validacion;
        if(strpos($entrada, "+") && strpos($entrada, "-") && strpos($entrada, "*")){
            return $validacion = 9;
        } else if(strpos($entrada, "+") && strpos($entrada, "-") && strpos($entrada, "/")){
            return $validacion = 8;
        }
        elseif(strpos($entrada, "+") && strpos($entrada, "-")){
            return $validacion = 10;
        } 
        elseif (strpos($entrada, "+")){
            return $validacion = 11;
        } 
        elseif(strpos($entrada, "-")){
            return $validacion = 12;
        } 
        elseif(strpos($entrada, "*")){
            return $validacion = 13;
        } 
        elseif(strpos($entrada, "/")){
            return $validacion = 14;
        } 
    }
}
$respuesta = new calculadora;
//!Mirar la posibilidad de no hacer esto si no de simplemente poner unos condicionales en cascada donde se retornen los valores

$i = $respuesta->validacion();
switch ($i) {
    case '8':
        $respuesta->mezcla3();
        break;
    case '9':
        $respuesta->mezcla2();
        break;
    case '10':
        $respuesta->mezcla();
        break;
    case '12':
        $respuesta->resta();
        break;
    case '11':
        $respuesta->suma();
        break;
    case '13':
        $respuesta->producto();
        break;
    case '14':
        $respuesta->division();
        break;
    default:
        echo "error";
        break;
}
?>