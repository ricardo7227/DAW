<?php
// Uso de foreach sin iteradores archivo file104c.php

// uso de foreach sobre propiedades públicas

print "<B>Uso de foreach (archivo file104c.php)</U></B><BR><BR>";

class MiClase  
{
    public $paísesPublic = array();
    
    // este array no lo listará porque es private
    private $paísesPrivate = array();
    
    public $prop1 = "mi propiedad pública 1";
    public $prop2 = "propiedad pública 2";
    public $prop3 = "propiedad pública 3";
    
    // a esta propiedad no la listará
    protected $prop4 = "propiedad protected 2";
    
       
    public function __construct($matriz)
    {
        // asigna los valores a la matriz privada
        if (is_array($matriz)) {
            $this->paísesPublic = $matriz;
            $this->paísesPrivate = $matriz;
        }
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
