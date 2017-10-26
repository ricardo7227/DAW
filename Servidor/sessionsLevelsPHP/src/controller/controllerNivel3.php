<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

/**
 * Description of controllerNivel3
 *
 * @author daw
 */
class controllerNivel3 {

    public $message = "Default message";
    public $pageDestino = "Default Page";

    public function processRequest() {

        if (isset($password) && strlen($password) > 0) {//parametros vacios
            $nivel1 = \Constantes::nivel1;


            if (\Constantes::passNivel1 == $password) {

                $_SESSION[$nivel1] = $password;


                $this->setMessage(\Constantes::messageLevelCompleted . \Constantes::nivel2);
            } else {

                $this->setMessage(sprintf(\Constantes::messageLevelError, \Constantes::nivel1));
            }
        } else {

            $this->setMessage(\Constantes::messageParametrosVacios);
        }

        $this->setPageDestino(\Constantes::pageDestino);

        include $this->pageDestino;
    }

}

//fin controllerNivel3
