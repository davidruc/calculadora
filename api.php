<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <form action="api.php" method="post">
        <input type="text" name="operacion">
        <input type="submit" value="=">
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
        echo $suma;

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
        echo $resta;
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
        echo $resta;

    }
    public function producto(){
        global $entrada;
        $datos = explode('*', $entrada);
        $multiplicacion = array_reduce($datos, function($acumulado, $valor){
            return $acumulado*$valor;
        }, 1);
        echo $multiplicacion;
    }
    public function division(){
        global $entrada;
        $datos = explode('/', $entrada);
        $division = array_reduce($datos, function($acumulado, $valor){
            return $acumulado%$valor;
        }, 1);
        echo $division;
    }
    public function validacion(){
        global $entrada;
        $validacion;
        if(strpos($entrada, "+") && strpos($entrada, "-")){
            return $validacion = 1;
        }
        elseif (strpos($entrada, "+")){
            return $validacion = 3;
        } 
        elseif(strpos($entrada, "-")){
            return $validacion = 2;
        } 
        elseif(strpos($entrada, "*")){
            return $validacion = 4;
        } 
        elseif(strpos($entrada, "/")){
            return $validacion = 5;
        } 
    }
}
$respuesta = new calculadora;

$i = $respuesta->validacion();
switch ($i) {
    case '1':
        $respuesta->mezcla();
        break;
    case '2':
        $respuesta->resta();
        break;
    case '3':
        $respuesta->suma();
        break;
    case '4':
        $respuesta->producto();
        break;
    case '5':
        $respuesta->division();
        break;
    default:
        # code...
        break;
}








?>