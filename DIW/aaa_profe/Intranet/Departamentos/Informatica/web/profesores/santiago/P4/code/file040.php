<?php
// Constructor array() matrices multidimensionales (ejemplo file040.php)  

// Matriz escalar de dos dimensiones creada con array
$Estad1 = array(array("Alemania","Berl�n",557046,78420000),
                array("Austria","Viena",83849,7614000),
		array("B�lgica","Bruselas",30518,9932000));
	
// Esto es lo mismo que haber hecho esto:
// fila 0
$Estad2 [0] [0] = "Alemania";
$Estad2 [0] [1] = "Berl�n";
$Estad2 [0] [2] = 557046;	
$Estad2 [0] [3] = 7842000;
// fila 1
$Estad2 [1] [0] = "Austria"; 
$Estad2 [1] [1] = "Viena";
$Estad2 [1] [2] = 83849;	
$Estad2 [1] [3] = 7614000;
// fila 2
$Estad2 [2] [0] = "B�lgica"; 
$Estad2 [2] [1] = "Bruselas";
$Estad2 [2] [2] = 30518;	
$Estad2 [2] [3] = 9932000;

// Matriz asociativa de dos dimensiones creada con array
$Estad3 = array(
	  "Alemania" => array(
			"Capital" => "Berl�n",
			"Extensi�n" => 557046,
			"Habitantes" => 78420000
			),
	  "Austria" => array(
	   		"Capital" => "Viena",
			"Extensi�n" => 83849,
			"Habitantes" => 7614000
			),
	  "B�lgica" => array(
	   		"Capital" => "Bruselas",
			"Extensi�n" => 30518,
			"Habitantes" => 9932000
			)
);
			
// Esto es lo mismo que haber hecho esto:
$Estad4 ["Alemania"] ["Capital"] = "Berl�n";
$Estad4 ["Alemania"] ["Extensi�n"] = 557046;	
$Estad4 ["Alemania"] ["Habitantes"] = 7842000;

$Estad4 ["Austria"] ["Capital"] = "Viena";
$Estad4 ["Austria"] ["Extensi�n"] = 83849;	
$Estad4 ["Austria"] ["Habitantes"] = 7614000;

$Estad4 ["B�lgica"] ["Capital"] = "Bruselas";
$Estad4 ["B�lgica"] ["Extensi�n"] = 30518;	
$Estad4 ["B�lgica"] ["Habitantes"] = 9932000;	 
?>