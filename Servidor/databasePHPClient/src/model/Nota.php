<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of Nota
 *
 * @author Gato
 */
class Nota {

    public $id_alumno;
    public $id_asignatura;
    public $nota;

    public function __construct($id_alumno, $id_asignatura, $nota) {
        $this->id_alumno = $id_alumno;
        $this->id_asignatura = $id_asignatura;
        $this->nota = $nota;
    }

    public function getId_alumno() {
        return $this->id_alumno;
    }

    public function getId_asignatura() {
        return $this->id_asignatura;
    }

    public function getNota() {
        return $this->nota;
    }

    public function setId_alumno($id_alumno) {
        $this->id_alumno = $id_alumno;
    }

    public function setId_asignatura($id_asignatura) {
        $this->id_asignatura = $id_asignatura;
    }

    public function setNota($nota) {
        $this->nota = $nota;
    }

}
