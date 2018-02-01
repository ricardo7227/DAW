<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of GenericResponse
 *
 * @author Gato
 */
class GenericResponse {

    public $code;
    public $description;

    public function __construct($code, $description) {
        $this->code = $code;
        $this->description = $description;
    }

    public function getCode() {
        return $this->code;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

}
