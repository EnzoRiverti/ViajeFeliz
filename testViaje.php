<?php

include "Viaje.php";

/**
 * Módulo que muestra un menú y pide una opción por teclado.
 * @return int La opción seleccionada.
 */
function opcionesMenu(){
    echo "----------MENU----------\n1) Cargar información\n2) Modificar información\n3) Ver datos del viaje\n4) Salir\n";
    $respuestaMenu = trim(fgets(STDIN));
    while($respuestaMenu < 1 || $respuestaMenu > 4 || !ctype_digit($respuestaMenu)){
        echo "Error: seleccione una opción válida (1-4): ";
        $respuestaMenu = trim(fgets(STDIN));
    }
    return intval($respuestaMenu);
}


/**
 * modulo que valida y guarda el destino del viaje
 * @param
 * @return string
 */
function cargarDestino(){
    echo "Ingrese destino: ";
    $destino = trim(fgets(STDIN));
    $destino = validacionString($destino);
    return $destino;
}

/**
 * modulo que valida y guarda la cant maxima de pasajeros
 * @param
 * @return int
 */
function cantMaximaPasajeros(){
    echo "Cantidad maxima de pasajeros: ";
    $cantMax = trim(fgets(STDIN));
    $cantMax = validacionEnteroPositivo($cantMax);

    return $cantMax;
}

/**
 * modulo que valida y guarda los datos de los pasajeros en un array
 * @param int $cantidadMaxima
 * @return array
 */
function datosPasajeros($cantidadMaxima){
    $pasajeros = array();
    echo "Cuantos pasajeros va ingresar: ";
    $cantPasajeros = trim(fgets(STDIN));
    $cantPasajeros = validacionEnteroPositivo($cantPasajeros);
    while($cantPasajeros > $cantidadMaxima){
        echo "La cantidad de pasajeros no puede ser mayor a la cantidad maxima del viaje. Ingrese una cantidad valida: ";
        $cantPasajeros = trim(fgets(STDIN));
    }
    for($i = 1;$i <= $cantPasajeros;$i++){
        $nombre = readline("Ingrese el nombre del pasajero: ");
        $nombre = validacionString($nombre);
        $apellido = readline("Ingrese el apellido del pasajero: ");
        $apellido = validacionString($apellido);
        $dni = readline("Ingrese el numero de documento del pasajero: ");
        $dni = validacionEnteroPositivo($dni);
        $datos_pasajeros = array(
            "Nombre" => $nombre,
            "Apellido" => $apellido,
            "Numero de Documento" => $dni
        );
        array_push($pasajeros, $datos_pasajeros);
    }
    return $pasajeros;
}
/**
 * Módulo para validar una cadena de caracteres que no esté vacía y no contenga números.
 * @param string $cadena La cadena a validar
 * @return string La cadena validada
 */
function validacionString($cadena) {
    while (empty($cadena) || !preg_match('/^[a-zA-Z ]+$/', $cadena)) {
        echo "ERROR: El valor ingresado no es válido. Ingrese un valor alfanumérico: ";
        $cadena = trim(fgets(STDIN));
    }
    return $cadena;
}

/**
 * modulo para validar numeros enteros positivos
 * @param int $esPositivo
 * @return int
 */
 function validacionEnteroPositivo($esPositivo){
    while($esPositivo <= 0 || !ctype_digit($esPositivo)){
        echo "ERROR:la cantidad no puede ser menor o igual 0 y tiene que ser un numero entero.Ingrese una cantidad valida: ";
        $esPositivo = trim(fgets(STDIN));
    }
    return $esPositivo;
 }
/**
 * Modulo que setea el nuevo codigo
 * @param Viaje $viaje
 * @return Viaje
 */
function cambiarCod($viaje){
    $newCodigo = readline("Ingrese el nuevo codigo: ");
    $viaje->setCodigo($newCodigo);
    return $viaje;
}
/**
 * Modulo que setea el nuevo destino
 * @param Viaje $viaje
 * @return Viaje
 */

 function cambiarDest($viaje){
    $newDestino = readline("Ingresar el nuevo destino: ");
    $newDestino = validacionString($newDestino);
    $viaje->setDestino($newDestino);
    return $viaje;
 }
/**
 * Modulo que setea la nueva cantMax
 * @param Viaje $viaje
 * @return Viaje
 */
function cambiarCantMax($viaje, $cantPasajeros){
    $newCantMax = readline("Ingresar la nueva cantidad maxima de pasajeros: ");
    $newCantMax = validacionEnteroPositivo($newCantMax);
    while($newCantMax < $cantPasajeros){
        echo "Error:La nueva cantidad maxima no puede ser menor a la cantidad de pasajeros existentes.\n";
        $newCantMax = readline("Ingresar la nueva cantidad maxima de pasajeros: ");
        $newCantMax = validacionEnteroPositivo($newCantMax);
    }
    $viaje->setCantMax($newCantMax);
    return $viaje;
}

/**
 * Modulo que setea nuevos datos para los pasajeros
 * @param Viaje $viaje
 * @param int $cantidadMaxima
 * @return
 */
function cambiarPasajeros($viaje, $cantidadMaxima){
    $arrayPasajeros = $viaje->getPasajeros();
    $opcion = readline("(1)Desea ingresar todos los pasajeros de 0 o (2) desea cambiar un pasajero: ");
    $opcion = validacionEnteroPositivo($opcion);
    while($opcion != 1 && $opcion != 2){
        $opcion = readline("ERROR:Debe ingresar (1) para ingresar todos los pasajeros o (2) para cambiar uno solo: ");
    }
    if($opcion == 1){
        $newPasajeros = array();
    echo "Cuantos pasajeros va ingresar: ";
    $cantPasajeros = trim(fgets(STDIN));
    while($cantPasajeros > $cantidadMaxima){
        echo "La cantidad de pasajeros no puede ser mayor a la cantidad maxima del viaje. Ingrese una cantidad valida: ";
        $cantPasajeros = trim(fgets(STDIN));
    }
    for($i = 1;$i <= $cantPasajeros;$i++){
        $nombre = readline("Ingrese el nombre del pasajero: ");
        $nombre = validacionString($nombre);
        $apellido = readline("Ingrese el apellido del pasajero: ");
        $apellido = validacionString($apellido);
        $dni = readline("Ingrese el numero de documento del pasajero: ");
        $dni = validacionEnteroPositivo($dni);
        $datos_pasajeros = array(
            "Nombre" => $nombre,
            "Apellido" => $apellido,
            "Numero de Documento" => $dni
        );
        array_push($newPasajeros, $datos_pasajeros);
    }
    $viaje->setPasajeros($newPasajeros);
    return $viaje;
    }elseif($opcion == 2){
        print_r($arrayPasajeros);
        echo "Ingrese el indice del pasajero que desee cambiar: ";
        $indicePasajero = trim(fgets(STDIN));
        //$indicePasajero = validacionEnteroPositivo($indicePasajero);
        while($indicePasajero < 0 || $indicePasajero > count($arrayPasajeros)){
            $indicePasajero = readline("ERROR:ingrese un indice valido: ");
        }
        $clave = readline("Que desea cambiar(Nombre , Apellido o Numero de Documento): ");
        $clave = validacionString($clave);
        while($clave != "Nombre" && $clave != "Apellido" && $clave != "Numero de Documento"){
            $clave = readline("ERROR:tiene que ser igual a como esta escrito en los parentesis.Que desea cambiar(Nombre , Apellido o Numero de Documento): ");
        }
        echo "Ingrese el nuevo " . $clave . ": ";
        $newDato = trim(fgets(STDIN));
        if($clave == "Nombre"){
            $newDato = validacionString($newDato);
            $viaje->setNombre($indicePasajero, $newDato);
        }elseif($clave == "Apellido"){
            $newDato = validacionString($newDato);
            $viaje->setApellido($indicePasajero, $newDato);
        }elseif($clave == "Numero de Documento"){
            $newDato = validacionEnteroPositivo($newDato);
            $viaje->setDni($indicePasajero, $newDato);
        }
           return $viaje;
    }
    
}
    function menuSet(){
        echo "1.Codigo" . "\n" . "2.Destino " . "\n" . "3.Cantidad max de pasajeros" . "\n" . "4.Pasajeros" .  "\n" . "Que desea cambiar: ";
        $respuestaSet = trim(fgets(STDIN));
        $respuestaSet = validacionEnteroPositivo($respuestaSet);
        while($respuestaSet < 1 || $respuestaSet > 4){
            "Error: tiene que ser una de las opciones validas: ";
            $respuestaSet = trim(fgets(STDIN));
            $respuestaSet = validacionEnteroPositivo($respuestaSet);
        }
        return $respuestaSet;
    }








/**
* Programa principal
*/

$respuestaDelMenu = opcionesMenu();
while($respuestaDelMenu >= 1 & $respuestaDelMenu <=3){
if($respuestaDelMenu == 1){
    echo "Ingrese el codigo del viaje: ";
    $codigo = trim(fgets(STDIN));
    $destiny = cargarDestino();
    $cantMaxima = cantMaximaPasajeros();
    $arregloPasajeros = datosPasajeros($cantMaxima);
    $objViaje = new Viaje($codigo, $destiny, $cantMaxima, $arregloPasajeros);
}elseif($respuestaDelMenu == 2){
    $deseaSetear = menuSet();
    if($deseaSetear == 1){
        $objViaje = cambiarCod($objViaje);
    }elseif($deseaSetear == 2){
        $objViaje = cambiarDest($objViaje);
    }elseif($deseaSetear == 3){
        $countDePasajeros = count($arregloPasajeros);
        $objViaje = cambiarCantMax($objViaje, $countDePasajeros);
    }elseif($deseaSetear == 4){
        $objViaje = cambiarPasajeros($objViaje, $cantMaxima);
    }
}elseif($respuestaDelMenu == 3){
    echo $objViaje . "\n";
}else{
echo "Programa finalizado";
}
$respuestaDelMenu = opcionesMenu();
}





