<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of Asignatura
 *
 * @author Gato
 */
class Asignatura {

    public $id;
    public $nombre;
    public $curso;
    public $ciclo;

    public function __construct($id, $nombre, $curso, $ciclo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->curso = $curso;
        $this->ciclo = $ciclo;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCurso() {
        return $this->curso;
    }

    public function getCiclo() {
        return $this->ciclo;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCurso($curso) {
        $this->curso = $curso;
    }

    public function setCiclo($ciclo) {
        $this->ciclo = $ciclo;
    }

}
