<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of Movimiento
 *
 * @author Gato
 */
class Movimiento {

    public $mo_ncu;
    public $mo_des;
    public $mo_imp;

    public function __construct($ncuenta, $ndescripcion, $importe) {
        $this->mo_ncu = $ncuenta;
        $this->mo_des = $ndescripcion;
        $this->mo_imp = $importe;
    }

    public function getMo_ncu() {
        return $this->mo_ncu;
    }

    public function getMo_des() {
        return $this->mo_des;
    }

    public function getMo_imp() {
        return $this->mo_imp;
    }

    public function setMo_ncu($mo_ncu) {
        $this->mo_ncu = $mo_ncu;
    }

    public function setMo_des($mo_des) {
        $this->mo_des = $mo_des;
    }

    public function setMo_imp($mo_imp) {
        $this->mo_imp = $mo_imp;
    }

}
