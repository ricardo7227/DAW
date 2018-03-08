<?php

namespace model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rango
 *
 * @author Gato
 */
class Rango {

    public $id_cuenta;
    public $fecha_inicio;
    public $fecha_fin;

    public function __construct($id_cuenta, $fecha_ini, $fecha_fin) {
        $this->id_cuenta = $id_cuenta;
        $this->fecha_inicio = $fecha_ini;
        $this->fecha_fin = $fecha_fin;
    }

    public function getId_cuenta() {
        return $this->id_cuenta;
    }

    public function getFecha_inicio() {
        return $this->fecha_inicio;
    }

    public function getFecha_fin() {
        return $this->fecha_fin;
    }

    public function setId_cuenta($id_cuenta) {
        $this->id_cuenta = $id_cuenta;
    }

    public function setFecha_inicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function setFecha_fin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }

}
