<?php
// Uso de Interface Iterator archivo file104a.php

// uso de foreach sobre propiedades privadas

print "<B>Uso de interface Iterator (archivo file104a.php</U></B><BR><BR>";

class MiClase implements Iterator
{
    private $pa�ses = array();
    
    // implementa la interface Iterator:
    // debe implementar los siguientes m�todos:
    // Iterator::rewind()
    // Iterator::current()
    // Iterator::key()
    // Iterator::next()
    // Iterator::valid()

    public function __construct($matriz)
    {
        // asigna los valores a la matriz privada
        if (is_array($matriz)) {
            $this->pa�ses = $matriz;
        }
    }

    public function rewind() {
        // reposiciona el puntero del array 
        reset($this->pa�ses);
    } 

    public function current() {
        // obtiene el elemento vigente         
        return current($this->pa�ses); 
    }

    public function key() {
        // devuelve la clave del elemento vigente
        return key($this->pa�ses); 
    }

    public function next() {
        // devuelve el elemento vigente
        return next($this->pa�ses);
    }

    public function valid() {
        // �elemento v�lido?
        return $this->current() !== false;
    }
}

$matriz = array("Francia" => "Par�s", "Italia" => "Roma", "Uruguay" => "Montevideo");
$obj = new MiClase($matriz);

foreach ($obj as $clave => $valor) {
    print "clave $clave => valor $valor <BR>";
}
?> 
