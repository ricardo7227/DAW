<?php
// uso de static:: (archivo file133b.php)
class cBase {
    public static function nombre() {
        echo "Soy de la clase: ". __CLASS__ . "<BR>";
    }
    public static function imprimir() {
        static::nombre();
    }
}

class cHija1 extends cBase {
    public static function nombre() {
        echo "Soy de la clase: ". __CLASS__ . "<BR>";
    }
}

class CHija2 extends cBase {
    public static function nombre() {
        echo "Soy de la clase: ". __CLASS__ . "<BR>";
    }
}
print "<BR>Uso del m�todo nombre() clase por clase .<BR>";
cBase::nombre();
cHija1::nombre();
cHija2::nombre();

print "<BR>Uso del m�todo imprimir() clase por clase .<BR>";
cBase::imprimir();
cHija1::imprimir();
cHija2::imprimir();
?> 
