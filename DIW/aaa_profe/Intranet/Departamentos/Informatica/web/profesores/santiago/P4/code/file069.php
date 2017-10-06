<?php
print "<B><U>Pr�cticas con funciones para trabajar con HTML(ejemplo file069.php)</U></B><BR>";

// htmlentities(pcadena): convierte caracteres que deben 
// reemplazarse por entidades HTML
// reemplaza letras acentuadas, comillas, <, >, �mpersan
print "<BR><B>1. htmlentities():</B> reemplaza ciertos caracteres por entidades HTML<BR>"; 
$var1 = "A es id�ntico a B y > a C pero < D";
print "Cadena original: <B> $var1 </B><BR>";
print "Longitud de la cadena original: " . strlen($var1) . " caracteres<BR>";
$var2 = htmlentities($var1); // convierte la cadena  
print $var2 . "<BR>"; 
// Conversi�n: A es id&eacute;ntico a B y &gt; a C pero &lt; a D
print "Longitud es  ". strlen($var2) . " (ver la conversi�n en el comentario del programa)<BR>";

// htmlespecialchars() es m�s limitada que htmlentities()

// reemplaza s�lo �mpersan, comillas dobles , <, >
$var1 = "P�rez & co."; // cadena con e acentuada y &  
$var2 = htmlspecialchars($var1); // convierte la cadena 
print "<BR><B>2. htmspecialchars():</B> reemplaza s�lo 4 caracteres especiales (&,<,>,\") por entidades HTML<BR>"; 
print "Cadena original: <B> $var1 </B><BR>";
print "Longitud de la cadena original: " . strlen($var1) . " caracteres<BR>";
print "$var2<BR>"; 
// Conversi�n:  P�rez &amp; co. (La e acentuada no cambia)) 
print "Longitud es ". strlen($var2) . " (ver la conversi�n en el comentario del programa)<BR>";

// nl2br() convierte salto a nueva l�nea por <BR>
//  
$var1 = "primera l�nea.\n segunda l�nea"; // cadenas con nueva l�nea
$var2 = nl2br($var1); // convierte la cadena 
print "<BR><B>3. nl2br():</B> salto de l�nea a saltos de HTML <BR>"; 
print "Cadena original: <B> $var1 </B><BR>";
print "Longitud de la cadena original: " . strlen($var1) . " caracteres<BR>";
print "$var2<BR>"; // Conversi�n: primera l�nea.<br /> segunda l�nea 
print "Longitud es ". strlen($var2) . " (ver la conversi�n en el comentario del programa)<BR>";
 
// html_entity_decode() convierte las entidades HTML 
// a los caracteres de origen; es la inversa a htmlentities() 
$var1 = "���o�&<>"; // algunos de los caracteres que se 
                  //convierten a entidades HTML 
print "<BR><B>4. html_entity_decode():</B> invertir la conversi�n <BR>"; 
print "Cadena original: <B> $var1 </B><BR>";
print "Longitud de la cadena original:  " . strlen($var1) . " caracteres<BR>";

$var2 = htmlentities("���o�&<>"); // Convierte a: &aacute;&eacute;&iacute;o&uacute;&amp;&lt;&gt;
print "<BR>htmlentities(): cadena con entidades HTML: $var2<BR>";
print "Longitud es  ". strlen($var2) . " (ver la conversi�n en el comentario del programa)<BR>";

$var3 = html_entity_decode($var2); // Reconvierte a: ���o�&<>
print "<BR>html_entity_decode(): cadena reconvertida sin entidades: $var3<BR>";
print "Longitud es  ". strlen($var3) . " (ver la conversi�n en el comentario del programa)<BR>";
?>
  