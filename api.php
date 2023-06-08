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
        <label> Calculadora: </label><br>
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
    public function mezcla2(){
        global $entrada;
        $datos = explode("*", $entrada);
        $multiplicacion = array_reduce($datos, function($acumulado, $valor){
            return $acumulado*$valor;
        }, 1);
        $datos = explode('+', $entrada);
        $suma = array_sum($datos);
        $datos = explode('-', $entrada);
        $resta = $suma;
        foreach($datos as $key => $val){
            if($key > 0){
                $resta -= $val;
            }
        }
        return ;
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
        if ($entrada === "0/0"){
            $division = "Indeterminado";
        }else {
            $datos = explode('/', $entrada);
            $datos_sin_0 = array_shift($datos);
            $division = array_reduce($datos, function($acumulado, $valor){
                return $acumulado/$valor;
            }, $datos_sin_0);
        }
        echo $division;
    }
    public function validacion(){
        global $entrada;
        $validacion;
        if(strpos($entrada, "+") && strpos($entrada, "-") && strpos($entrada, "*")){
            return $validacion = 9;
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

$i = $respuesta->validacion();
switch ($i) {
    case '9':
        echo "pepapig";
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