<HTML>
<HEAD>
<Title>Bienvenidos al curso de PHP 6</Title>
<BODY>
    <H1>FILE001.PHP</H1>
Estas líneas están escritas directamente en código HTML (código estático).
<BR>
Ésta es una línea incluida dentro de la etiqueta BODY.
<BR>
<BR>
<?php
/* empieza un comentario de varias líneas
   continua el comentario
   los comentarios no salen en la página HTML */   
$expresion = "1";
// aquí se hace la evaluación
if ($expresion == "1") {
	print ("1) Empiezan líneas generadas por PHP<BR>");
	print ("2) texto está por instrucción print de PHP (código a 
          dinámico)");
} 
# Otro Comentario:  estilo shell
?>
</BODY> 
</HEAD>
</HTML>