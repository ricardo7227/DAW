<HTML>
<HEAD>
<Title>Bienvenidos al curso de PHP 6</Title>
<BODY>
    <H1>FILE001.PHP</H1>
Estas l�neas est�n escritas directamente en c�digo HTML (c�digo est�tico).
<BR>
�sta es una l�nea incluida dentro de la etiqueta BODY.
<BR>
<BR>
<?php
/* empieza un comentario de varias l�neas
   continua el comentario
   los comentarios no salen en la p�gina HTML */   
$expresion = "1";
// aqu� se hace la evaluaci�n
if ($expresion == "1") {
	print ("1) Empiezan l�neas generadas por PHP<BR>");
	print ("2) texto est� por instrucci�n print de PHP (c�digo a 
          din�mico)");
} 
# Otro Comentario:  estilo shell
?>
</BODY> 
</HEAD>
</HTML>