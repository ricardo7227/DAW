<?php
print "<B><U>Definici�n de funciones de usuario (ejemplo file070.php)</U></B><BR><BR>";

// esta definici�n puede estar en cualquier parte del c�digo
function prueba1() {
    echo "<B>�Estamos dentro de la funci�n prueba!</B><BR><BR>";
}	

// aqu� empieza el c�digo principal
echo "<BR>Empieza el c�digo principal<BR><BR>";
// llamamos a la funci�n
prueba1();

echo "Estamos nuevamente en el c�digo principal<BR><BR>";	
// llamamos a otra funci�n
prueba2(); 

// observar que el mensaje de la funci�n prueba3 no sale nunca
// una funci�n act�a s�lo si la llamamos (y en este caso no lo hacemos)

echo "Fin y no hubo mensaje de la funci�n prueba3<BR>";

// esta definici�n puede estar en cualquier parte del c�digo
function prueba2() {
    echo "<B>�Estamos dentro de la funci�n prueba2!</B><BR>";
    echo "<B>�Esto verifica que la definici�n de la funci�n puede estar antes o despu�s de la llamada!</B><BR><BR>";
}	
// esta definici�n puede estar en cualquier parte del c�digo
function prueba3() {
    echo "<B>�Estamos dentro de la funci�n prueba3!</B><BR>";
}	  
?>