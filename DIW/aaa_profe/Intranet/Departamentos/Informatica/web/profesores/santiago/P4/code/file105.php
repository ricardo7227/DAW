<?php
//Definición de una clase que se carga por autoload (ejemplo file105.php) 

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
	public $sección;

	function __construct($id, $name, $sección){
		$this->identificador = $id;
		$this->nombre = $name;	
		$this->sección = $sección;	
	}
    function listar(){
		print "Id. empleado ". $this->identificador . 
         " -Nombre: " . $this->nombre . " -Sección: " . 
         $this->sección . "<BR>";	
	}
}	
	
?>