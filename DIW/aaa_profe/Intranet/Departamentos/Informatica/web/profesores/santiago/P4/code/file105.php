<?php
//Definici�n de una clase que se carga por autoload (ejemplo file105.php) 

Class Persona {
	public $identificador;
	public $nombre;
	function __construct($id, $name){
		$this->identificador = $id;
		$this->nombre = $name;	
	}
    function listar(){
		print "Id. ". $this->identificador . " Nombre: " . $this->nombre . "<BR>";	
	}
}

Class Empleado {
	public $identificador;
	public $nombre;
	public $secci�n;

	function __construct($id, $name, $secci�n){
		$this->identificador = $id;
		$this->nombre = $name;	
		$this->secci�n = $secci�n;	
	}
    function listar(){
		print "Id. empleado ". $this->identificador . 
         " -Nombre: " . $this->nombre . " -Secci�n: " . 
         $this->secci�n . "<BR>";	
	}
}	
	
?>