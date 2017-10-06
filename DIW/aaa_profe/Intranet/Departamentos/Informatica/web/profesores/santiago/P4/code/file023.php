<?php
print "<B><U>Sentencia for (ejemplo file023.php)</U></B><BR>";

// Caso1:
// Las tres expresiones informadas
for ($var1 = 3; $var1 >= 1; $var1--) {
      print "Caso 1: " .$var1 . "<BR>";
}

// Caso 2:
// No hay inicializaci�n (se hace antes)
$var1 = 3;
for (;$var1 >= 1; $var1--) {
       print "Caso 2: " .$var1 . "<BR>";
}

//Caso 3:
// No hay expresi�n 2 (control de bucle)
for ($var1 = 3;;$var1--) {
	// al no haber expresi�n 2, debe haber una sentencia break
	// para que no haya bucle infinito
     if ($var1 == 2) {
	 	 print "Caso 3: sale por sentencia break<BR>";
         break;
     }
     print "Caso 3: " .$var1 . "<BR>";
}


//Caso 4:
// No hay expresiones expl�citas en la sentencia for: 
// se omiten las tres
// La expresi�n de inicializaci�n: se omite, por lo que
// la variable ser� cero (o el valor que traiga de antes)
// La expresi�n de control de bucle: se define dentro del bloque
// en este caso es if ($var2 == 2)
// La expresi�n de incremento/decremento: se omite, por lo que
// dentro del bloque se incluye la sentencia ++$var2
for (;;) {
	// al no haber expresi�n 2, debe haber una sentencia break
	// para que no haya bucle infinito
     if ($var2 == 2) {
	 	 print "Caso 4: sale por sentencia break<BR>";
         break;
     }
     print "Caso 4: " . ++$var2 . "<BR>";
}

//Caso 5:
// Sintaxis alternativa
for ($var1 = 3; $var1 >= 1; $var1--):
     print "Caso 5: " .$var1 . "<BR>";
endfor;

?>