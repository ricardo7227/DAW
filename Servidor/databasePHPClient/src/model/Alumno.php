<?php
namespace model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alumno
 *
 * @author Gato
 */
class Alumno {
    private $id;
    private $nombre;
    private $fecha_nacimiento;
    private $mayor_edad;
    public function __construct($id, $nombre, $fecha_nacimiento, $mayor_edad) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->mayor_edad = $mayor_edad;
    }
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFecha_nacimiento() {
        return $this->fecha_nacimiento;
    }

    public function getMayor_edad() {
        return $this->mayor_edad;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setFecha_nacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function setMayor_edad($mayor_edad) {
        $this->mayor_edad = $mayor_edad;
    }



    
}
