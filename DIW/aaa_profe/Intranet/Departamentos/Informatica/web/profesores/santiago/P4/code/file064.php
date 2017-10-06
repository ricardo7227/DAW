<?php
print "<B><U>Pr�cticas con funciones para trabajar con subcadenas cadenas  (ejemplo file064.php)</U></B><BR>";

// la funci�n substr(pcadena, pinicio [,plong])
Print "<BR><B>Funci�n substr(): trabajo con subcadenas</B><BR>";
$var1 = "�sta es una cadena completa";
$var2 = substr($var1,5,6); // separa la palabra 'es una'
print "subcadena:$var2 <BR>";

// la posici�n de inicio puede ser negativa 
// (significa que se cuenta desde el final)
// si no usa el par�metro plong, asume hasta el final
$var2 = substr($var1,-8); // separa la palabra 'completa'
print "subcadena:$var2 <BR>"; 
// si se indica un par�metro plong negativo se especifica
// la cantidad de caracteres que no se considerar�n desde el final
$var2 = substr($var1,-8, -4); // separa la palabra 'comp'
print "subcadena:$var2 <BR>"; 

// la funci�n substr_replace(pcadena1, pcadena2, pinicio [,plong])
Print "<BR><B>Funci�n substr_replace(): reemplazo de cadenas</B><BR>";
$var1 = "�sta es una cadena completa";
$var2 = substr_replace($var1,'ser�a una gran',5,6); // cambia el texto
print "subcadena:$var2 <BR>";
// la posici�n de inicio puede ser negativa 
// (significa que se cuenta desde el final)
// si no usa el par�metro plong, asume hasta el final
$var2 = substr_replace($var1,'largu�sima',-8); // cambia el texto
print "subcadena:$var2 <BR>"; 
// si se indica un par�metro plong negativo se especifica
// la cantidad de caracteres que no se considerar�n desde el final
$var2 = substr_replace($var1,'obso',-8, -4); // cambia el texto
print "subcadena:$var2 <BR>"; 

// la funci�n str_replace(pbusca, preemplaza, pcadena)
Print "<BR><B>Funci�n str_replace(): reemplazo de partes de la cadena</B><BR>";
$var1 = "Texas (USA), Florida(USA), Nueva York(USA), California(usa)";
// usa no lo cambia porque est� en min�sculas
$var2 = str_replace("USA","EEUU",$var1); 
// cambia el texto (pero diferencia may�sculas de min�sculas)
print "cadena:$var2 <BR>";

// la funci�n strtr(pcadena, pbusca, preemplaza)
// reemplaza los caracteres de pbusca por el 
// correspondiente en preemplaza
Print "<BR><B>Funci�n strtr(): traducci�n de caracteres</B><BR>";
$var1 = "�ste es s�lo un par�metro �nico"; // saca los acentos
$var2 = strtr($var1,"����������","aeiouAEIOU"); // 
print "cadena:$var2 <BR>";


// la funci�n strtr(pcadena, pmatriz)
// la matriz, las claves tiene los datos a traducir y los
//  valores son los reemplazos
Print "<BR><B>Funci�n strtr(): traducci�n desde una matriz</B><BR>";
$mat = array(","=>":", "Estimado"=>"Dear", "se�or"=>"mr.", "Gracias"=>"Thanks you", "Lo ver� pronto"=>"I will see you soon");
$var1 = "Estimado se�or Jones, <BR>Lo ver� pronto. <BR>Gracias. Luis"; // 
$var2 = strtr($var1,$mat); // 
print "cadena:<BR>$var2 <BR>"; 


// la funci�n substr_count(pcadena, pbusca)
// cuenta la cantidad de veces que aparece una subcadena en 
// una cadena
// diferencia may�sculas de min�sculas
Print "<BR><B>Funci�n substr_count()cuenta apariciones de subcadenas</B><BR>";
$var1 = "Estimado se�or Jones, <BR>Lo ver� pronto. <BR>Gracias. Luis"; // saca los acentos
$var2 = substr_count($var1,"<BR>"); // cuenta saltos de l�nea 
print "saltos de l�nea:$var2 <BR>"; 
?>