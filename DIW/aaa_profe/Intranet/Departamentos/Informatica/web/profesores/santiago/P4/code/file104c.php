<?php
// Uso de foreach sin iteradores archivo file104c.php

// uso de foreach sobre propiedades p�blicas

print "<B>Uso de foreach (archivo file104c.php)</U></B><BR><BR>";

class MiClase  
{
    public $pa�sesPublic = array();
    
    // este array no lo listar� porque es private
    private $pa�sesPrivate = array();
    
    public $prop1 = "mi propiedad p�blica 1";
    public $prop2 = "propiedad p�blica 2";
    public $prop3 = "propiedad p�blica 3";
    
    // a esta propiedad no la listar�
    protected $prop4 = "propiedad protected 2";
    
       
    public function __construct($matriz)
    {
        // asigna los valores a la matriz privada
        if (is_array($matriz)) {
            $this->pa�sesPublic = $matriz;
            $this->pa�sesPrivate = $matriz;
        }
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
