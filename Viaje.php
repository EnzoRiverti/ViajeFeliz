<?php

class Viaje{
    //Atributos
    private $codigo;
    private $destino;
    private $cantMax;
    private $pasajeros;
    //METODOS
    public function __construct($codigoP, $destinoP, $cantMaxP, $pasajerosP){
        $this->codigo = $codigoP;
        $this->destino = $destinoP;
        $this->cantMax = $cantMaxP;
        $this->pasajeros = $pasajerosP;
    }
    //Get y set de los atributos
    //Retorna valor codigo
    public function getCodigo(){
        return $this->codigo;
    }
    //Setea el codigo
    public function setCodigo($codigoP){
        $this->codigo = $codigoP;
    }
    //Retorna valor destino
    public function getDestino(){
        return $this->destino;
    }
    //setea el el destino
    public function setDestino($destinoP){
        $this->destino = $destinoP;
    }
    //Retorna valor cantidad maxima de pasajeros
    public function getCantMax(){
        return $this->cantMax;
    }
    //setea la cantidad max de pasajeros
    public function setCantMax($cantMaxP){
        $this->cantMax = $cantMaxP;
    }
    //Retorna los datos de los pasajeros 
    public function getPasajeros(){
        return $this->pasajeros;
    }
    //Setea la informacion de los pasajeros
    public function setPasajeros($pasajerosP){
        $this->pasajeros = $pasajerosP;
    }
    //Muestra por pantalla
    public function __toString(){
        return ("Datos del viaje: " . "\n" . "Codigo: " . $this->getCodigo() . "\n" . "Destino: " . $this->getDestino() . "\n" . "Cantidad maxima de pasajeros: " . $this->getCantMax() . "\n" . "Informacion del pasajero: " . "\n" . $this->deArrayAString());
    }
    //Metodo para cambiar el dato segun el indice 
    public function nuevoDato($indicePasajero, $clave, $datoNuevo){
        $this->pasajeros[$indicePasajero][$clave] = $datoNuevo;
    }
    //Metodo para hacer del array un string
    private function deArrayAString(){
        $pasajerosString = "";
        foreach($this->pasajeros as $datos){
            $pasajerosString .="\n" . "Numero del pasajero: " . $datos["N°Pasajero"] . "\n" . "Nombre: " . $datos["Nombre"] . "\n" . "Apellido: " . $datos["Apellido"] . "\n" . "Numero de documento: " . $datos["Numero de Documento"]. "\n";
        }
        return $pasajerosString;
    }
    
    public function setNombre($indicePasajero, $nuevoDato){
    $this->pasajeros[$indicePasajero]["Nombre"] = $nuevoDato;
}
     
public function setApellido($indicePasajero, $nuevoDato){
    $this->pasajeros[$indicePasajero]["Apellido"] = $nuevoDato;
}

public function setDni($indicePasajero, $nuevoDato){
    $this->pasajeros[$indicePasajero]["Numero de Documento"] = $nuevoDato;
}


}

