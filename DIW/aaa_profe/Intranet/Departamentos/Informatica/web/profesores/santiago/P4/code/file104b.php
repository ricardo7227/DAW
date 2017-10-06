<?php
// Uso de Interface IteratorAggregate archivo file104b.php

// uso de foreach sobre propiedades p�blicas

print "<B>Uso de interface IteratorAggregate (archivo file104b.php)</U></B><BR><BR>";

class MiClase implements IteratorAggregate
{
    public $pa�sesPublic = array();
    
    // este array no lo listar� porque es private
    private $pa�sesPrivate = array();
    
    public $prop1 = "mi propiedad p�blica 1";
    public $prop2 = "propiedad p�blica 2";
    public $prop3 = "propiedad p�blica 3";
    
    // a esta propiedad no la listar�
    protected $prop4 = "propiedad protected 2";
    
    // implementa la interface IteratorAggregate:
    // debe implementar m�todo siguiente:
    // IteratorAggregate::getIterator()
   
    public function __construct($matriz)
    {
        // asigna los valores a la matriz privada
        if (is_array($matriz)) {
            $this->pa�sesPublic = $matriz;
            $this->pa�sesPrivate = $matriz;
        }
    }

    public function getIterator() {
       $var =  new ArrayIterator($this);
       // la ventaja de este enfoque respecto
       // al foreach simple sin Iterator
       // es que aqu� podemos manipular los valores
       // mediante los m�todos del objeto ArrayIterator
       // por ejemplo:  
       //  $var->offsetSet();
       // $var->offUnset();
       return $var;
    } 

   
}

$matriz = array("Francia" => "Par�s", "Italia" => "Roma", "Uruguay" => "Montevideo");
$obj = new MiClase($matriz);

foreach ($obj as $clave => $valor) {
    print "<BR>clave $clave => valor $valor <BR>";
    if (is_array($valor))
        print_r ($valor);
}

 

?> 
