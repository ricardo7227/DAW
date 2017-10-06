<?php
print "<B><U>Pr�cticas con marcado de caracteres especiales (ejemplo file068.php)</U></B><BR>";

// addslashes(pcadena)
// devuelve una cadena con barras invertidas para marcar los 
// caracteres que se deben enmascarar 
 
$var1 = " D'Andrea\Edgar\"";
print "<BR>Cadena original: <B> $var1 </B><BR>";
print "en hexadecimal:" . bin2hex ($var1) . "<BR>";
print "Longitud de la cadena original:" . strlen($var1) . " caracteres<BR>";

$var2 = addslashes($var1); // a�ade barras invertidas
print "<BR>1. addslashes(): Marca los caracteres que se deben enmascarar (comillas, comilla simple, barra invertida)<BR>"; 
print addslashes($var1) ."<BR>"; 
   
$var3 = stripslashes($var2); // quita barras invertidas  
print "<BR>2. stripslashes(): Quita las barras invertidas de marcas (comillas, comilla simple, barra invertida)<BR>"; 
print stripslashes($var2) ."<BR>"; 

// addcslashes es m�s flexible ya que permite definir una 
// lista de los caracteres que se quieren enmascarar en el
//  segundo par�metro 
// hace diferencia entre may�sculas y min�sculas (p.ej., a<>A )
$var2 = addcslashes($var1,"DAndre"); 
// a�ade barras invertidas a las letras que se definen 
// en el par�metro
print "<BR>3. addcslashes(): Permite definir los caracteres que se deben enmascarar<BR>"; 
print addcslashes($var1,"DAndre") . "<BR>"; 

// stripcslashes() quita las barras invertidas   
$var3 = stripcslashes($var2); // quita barras invertidas, pero...  
print "<BR>4. stripcslashes(): Quita las barras invertidas de marcas de lo obtenido en el ejemplo 3<BR>"; 
print stripcslashes($var2) ."<BR>"; 
Print "�Qu� sucedi�? �No es lo esperado?<BR>";
Print "Atenci�n �lo que reconoce como s�mbolos enmascarados los reemplaza por los s�mbolos correspondientes!<BR>";
Print "La barra con n es nueva l�nea: hex 0a, barra con r es control de carro: hex 0d<BR>";
Print "Por eso no volvemos a obtener <B>D'Andrea\Edgar</B><BR>";

print "en hexadecimal:" . bin2hex ($var3) . "<BR>";
print "Longitud es ". strlen($var3) . "<BR>"; 

// quotemeta() devuelve una cadena con barras invertidas adelante de
// un conjunto de caracteres: . \\ + * [ ] $ ( ) 
$var2 = quotemeta("Prueba quotemeta+\\"); // a�ade barras invertidas  
print "<BR>5. quotemeta(): Coloca barras invertidas<BR>"; 
print quotemeta("Prueba quotemeta+\\"). "<BR>"; 
 
?>