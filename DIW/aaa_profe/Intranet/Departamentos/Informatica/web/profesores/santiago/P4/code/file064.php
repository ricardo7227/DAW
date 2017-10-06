<?php
print "<B><U>Prácticas con funciones para trabajar con subcadenas cadenas  (ejemplo file064.php)</U></B><BR>";

// la función substr(pcadena, pinicio [,plong])
Print "<BR><B>Función substr(): trabajo con subcadenas</B><BR>";
$var1 = "Ésta es una cadena completa";
$var2 = substr($var1,5,6); // separa la palabra 'es una'
print "subcadena:$var2 <BR>";

// la posición de inicio puede ser negativa 
// (significa que se cuenta desde el final)
// si no usa el parámetro plong, asume hasta el final
$var2 = substr($var1,-8); // separa la palabra 'completa'
print "subcadena:$var2 <BR>"; 
// si se indica un parámetro plong negativo se especifica
// la cantidad de caracteres que no se considerarán desde el final
$var2 = substr($var1,-8, -4); // separa la palabra 'comp'
print "subcadena:$var2 <BR>"; 

// la función substr_replace(pcadena1, pcadena2, pinicio [,plong])
Print "<BR><B>Función substr_replace(): reemplazo de cadenas</B><BR>";
$var1 = "Ésta es una cadena completa";
$var2 = substr_replace($var1,'sería una gran',5,6); // cambia el texto
print "subcadena:$var2 <BR>";
// la posición de inicio puede ser negativa 
// (significa que se cuenta desde el final)
// si no usa el parámetro plong, asume hasta el final
$var2 = substr_replace($var1,'larguísima',-8); // cambia el texto
print "subcadena:$var2 <BR>"; 
// si se indica un parámetro plong negativo se especifica
// la cantidad de caracteres que no se considerarán desde el final
$var2 = substr_replace($var1,'obso',-8, -4); // cambia el texto
print "subcadena:$var2 <BR>"; 

// la función str_replace(pbusca, preemplaza, pcadena)
Print "<BR><B>Función str_replace(): reemplazo de partes de la cadena</B><BR>";
$var1 = "Texas (USA), Florida(USA), Nueva York(USA), California(usa)";
// usa no lo cambia porque está en minúsculas
$var2 = str_replace("USA","EEUU",$var1); 
// cambia el texto (pero diferencia mayúsculas de minúsculas)
print "cadena:$var2 <BR>";

// la función strtr(pcadena, pbusca, preemplaza)
// reemplaza los caracteres de pbusca por el 
// correspondiente en preemplaza
Print "<BR><B>Función strtr(): traducción de caracteres</B><BR>";
$var1 = "Éste es sólo un parámetro único"; // saca los acentos
$var2 = strtr($var1,"áéíóúÁÉÍÓÚ","aeiouAEIOU"); // 
print "cadena:$var2 <BR>";


// la función strtr(pcadena, pmatriz)
// la matriz, las claves tiene los datos a traducir y los
//  valores son los reemplazos
Print "<BR><B>Función strtr(): traducción desde una matriz</B><BR>";
$mat = array(","=>":", "Estimado"=>"Dear", "señor"=>"mr.", "Gracias"=>"Thanks you", "Lo veré pronto"=>"I will see you soon");
$var1 = "Estimado señor Jones, <BR>Lo veré pronto. <BR>Gracias. Luis"; // 
$var2 = strtr($var1,$mat); // 
print "cadena:<BR>$var2 <BR>"; 


// la función substr_count(pcadena, pbusca)
// cuenta la cantidad de veces que aparece una subcadena en 
// una cadena
// diferencia mayúsculas de minúsculas
Print "<BR><B>Función substr_count()cuenta apariciones de subcadenas</B><BR>";
$var1 = "Estimado señor Jones, <BR>Lo veré pronto. <BR>Gracias. Luis"; // saca los acentos
$var2 = substr_count($var1,"<BR>"); // cuenta saltos de línea 
print "saltos de línea:$var2 <BR>"; 
?>