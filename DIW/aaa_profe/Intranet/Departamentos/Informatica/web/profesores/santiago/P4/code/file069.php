<?php
print "<B><U>Prácticas con funciones para trabajar con HTML(ejemplo file069.php)</U></B><BR>";

// htmlentities(pcadena): convierte caracteres que deben 
// reemplazarse por entidades HTML
// reemplaza letras acentuadas, comillas, <, >, ámpersan
print "<BR><B>1. htmlentities():</B> reemplaza ciertos caracteres por entidades HTML<BR>"; 
$var1 = "A es idéntico a B y > a C pero < D";
print "Cadena original: <B> $var1 </B><BR>";
print "Longitud de la cadena original: " . strlen($var1) . " caracteres<BR>";
$var2 = htmlentities($var1); // convierte la cadena  
print $var2 . "<BR>"; 
// Conversión: A es id&eacute;ntico a B y &gt; a C pero &lt; a D
print "Longitud es  ". strlen($var2) . " (ver la conversión en el comentario del programa)<BR>";

// htmlespecialchars() es más limitada que htmlentities()

// reemplaza sólo ámpersan, comillas dobles , <, >
$var1 = "Pérez & co."; // cadena con e acentuada y &  
$var2 = htmlspecialchars($var1); // convierte la cadena 
print "<BR><B>2. htmspecialchars():</B> reemplaza sólo 4 caracteres especiales (&,<,>,\") por entidades HTML<BR>"; 
print "Cadena original: <B> $var1 </B><BR>";
print "Longitud de la cadena original: " . strlen($var1) . " caracteres<BR>";
print "$var2<BR>"; 
// Conversión:  Pérez &amp; co. (La e acentuada no cambia)) 
print "Longitud es ". strlen($var2) . " (ver la conversión en el comentario del programa)<BR>";

// nl2br() convierte salto a nueva línea por <BR>
//  
$var1 = "primera línea.\n segunda línea"; // cadenas con nueva línea
$var2 = nl2br($var1); // convierte la cadena 
print "<BR><B>3. nl2br():</B> salto de línea a saltos de HTML <BR>"; 
print "Cadena original: <B> $var1 </B><BR>";
print "Longitud de la cadena original: " . strlen($var1) . " caracteres<BR>";
print "$var2<BR>"; // Conversión: primera línea.<br /> segunda línea 
print "Longitud es ". strlen($var2) . " (ver la conversión en el comentario del programa)<BR>";
 
// html_entity_decode() convierte las entidades HTML 
// a los caracteres de origen; es la inversa a htmlentities() 
$var1 = "áéíoú&<>"; // algunos de los caracteres que se 
                  //convierten a entidades HTML 
print "<BR><B>4. html_entity_decode():</B> invertir la conversión <BR>"; 
print "Cadena original: <B> $var1 </B><BR>";
print "Longitud de la cadena original:  " . strlen($var1) . " caracteres<BR>";

$var2 = htmlentities("áéíoú&<>"); // Convierte a: &aacute;&eacute;&iacute;o&uacute;&amp;&lt;&gt;
print "<BR>htmlentities(): cadena con entidades HTML: $var2<BR>";
print "Longitud es  ". strlen($var2) . " (ver la conversión en el comentario del programa)<BR>";

$var3 = html_entity_decode($var2); // Reconvierte a: áéíoú&<>
print "<BR>html_entity_decode(): cadena reconvertida sin entidades: $var3<BR>";
print "Longitud es  ". strlen($var3) . " (ver la conversión en el comentario del programa)<BR>";
?>
  