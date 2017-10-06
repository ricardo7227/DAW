<?php
Print "<B>Navegación por las propiedades de un objeto con foreach (ejemplo file131.php) </B><BR><BR>";
class miObjeto
{
    // las propiedades públicas son accesibles desde dentro y
    // desde fuera de la clase
    public $prop1 = 'contenido de la propiedad public prop1';
    public $prop2 = 'contenido de la propiedad public prop2';

    // estas propiedades no son visibles desde la sentencia foreach
    // externa de la clase
    protected $prop3 = 'contenido de la propiedad protected prop3';
    private   $prop4 = 'contenido de la propiedad private prop4';

    // método interno que utiliza foreach para
    // obtener la lista de todas las propiedades
    // del objeto
    function foreachInterno() {
       print "miObjeto foreach interno de la clase" . "<BR>";
       foreach($this as $key => $value) {
           print "$key => $value" . "<BR>";
       }
    }
}

// se crea un objeto de la clase miObjeto
$obj = new miObjeto();

// se recorren todas las propiedades públicas
// del objeto 
foreach($obj as $key => $value) {
    print "$key => $value" .  "<BR>";
}
print "<BR>";

// ahora se llama al método de la clase
// que también usa la sentencia foreach
$obj->foreachInterno();

?> 
