<?php
// Uso de Interface Iterator archivo file104a.php

// uso de foreach sobre propiedades privadas

print "<B>Uso de interface Iterator (archivo file104a.php</U></B><BR><BR>";

class MiClase implements Iterator
{
    private $países = array();
    
    // implementa la interface Iterator:
    // debe implementar los siguientes métodos:
    // Iterator::rewind()
    // Iterator::current()
    // Iterator::key()
    // Iterator::next()
    // Iterator::valid()

    public function __construct($matriz)
    {
        // asigna los valores a la matriz privada
        if (is_array($matriz)) {
            $this->países = $matriz;
        }
    }

    public function rewind() {
        // reposiciona el puntero del array 
        reset($this->países);
    } 

    public function current() {
        // obtiene el elemento vigente         
        return current($this->países); 
    }

    public function key() {
        // devuelve la clave del elemento vigente
        return key($this->países); 
    }

    public function next() {
        // devuelve el elemento vigente
        return next($this->países);
    }

    public function valid() {
        // ¿elemento válido?
        return $this->current() !== false;
    }
}

$matriz = array("Francia" => "París", "Italia" => "Roma", "Uruguay" => "Montevideo");
$obj = new MiClase($matriz);

foreach ($obj as $clave => $valor) {
    print "clave $clave => valor $valor <BR>";
}
?> 
