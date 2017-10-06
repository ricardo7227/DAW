<?php
// Uso de Interface IteratorAggregate archivo file104b.php

// uso de foreach sobre propiedades públicas

print "<B>Uso de interface IteratorAggregate (archivo file104b.php)</U></B><BR><BR>";

class MiClase implements IteratorAggregate
{
    public $paísesPublic = array();
    
    // este array no lo listará porque es private
    private $paísesPrivate = array();
    
    public $prop1 = "mi propiedad pública 1";
    public $prop2 = "propiedad pública 2";
    public $prop3 = "propiedad pública 3";
    
    // a esta propiedad no la listará
    protected $prop4 = "propiedad protected 2";
    
    // implementa la interface IteratorAggregate:
    // debe implementar método siguiente:
    // IteratorAggregate::getIterator()
   
    public function __construct($matriz)
    {
        // asigna los valores a la matriz privada
        if (is_array($matriz)) {
            $this->paísesPublic = $matriz;
            $this->paísesPrivate = $matriz;
        }
    }

    public function getIterator() {
       $var =  new ArrayIterator($this);
       // la ventaja de este enfoque respecto
       // al foreach simple sin Iterator
       // es que aquí podemos manipular los valores
       // mediante los métodos del objeto ArrayIterator
       // por ejemplo:  
       //  $var->offsetSet();
       // $var->offUnset();
       return $var;
    } 

   
}

$matriz = array("Francia" => "París", "Italia" => "Roma", "Uruguay" => "Montevideo");
$obj = new MiClase($matriz);

foreach ($obj as $clave => $valor) {
    print "<BR>clave $clave => valor $valor <BR>";
    if (is_array($valor))
        print_r ($valor);
}

 

?> 
