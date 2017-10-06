<?php
print "<B><U>Definición de funciones de usuario (ejemplo file070.php)</U></B><BR><BR>";

// esta definición puede estar en cualquier parte del código
function prueba1() {
    echo "<B>¡Estamos dentro de la función prueba!</B><BR><BR>";
}	

// aquí empieza el código principal
echo "<BR>Empieza el código principal<BR><BR>";
// llamamos a la función
prueba1();

echo "Estamos nuevamente en el código principal<BR><BR>";	
// llamamos a otra función
prueba2(); 

// observar que el mensaje de la función prueba3 no sale nunca
// una función actúa sólo si la llamamos (y en este caso no lo hacemos)

echo "Fin y no hubo mensaje de la función prueba3<BR>";

// esta definición puede estar en cualquier parte del código
function prueba2() {
    echo "<B>¡Estamos dentro de la función prueba2!</B><BR>";
    echo "<B>¡Esto verifica que la definición de la función puede estar antes o después de la llamada!</B><BR><BR>";
}	
// esta definición puede estar en cualquier parte del código
function prueba3() {
    echo "<B>¡Estamos dentro de la función prueba3!</B><BR>";
}	  
?>