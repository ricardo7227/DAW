<?php
// clase simple para crear una tabla HTML (file159.php)
Class MiTablaHTML {
    private $texto;
    
    function __construct($var) {
        $this->texto = $var;
    }

    public function imprimir(){
        print("<TABLE BORDER=3><TR><TD>");
        print($this->texto);
        print("</TD></TR></TABLE>");
    }
}

// crea una instancia del objeto
$obj = new miTablaHTML("texto para colocar en la tabla");

// uso de un método 
$obj->imprimir();


?>