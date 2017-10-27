<?php

namespace controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author daw
 */
class controllerNivel1 {

    public $message = "Default message";
    public $pageDestino = "Default Page";

    public function processRequest($password) {
//echo get_current_user();

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

    function getMessage() {
        return $this->message;
    }

    function getPageDestino() {
        return $this->pageDestino;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setPageDestino($pageDestino) {
        $this->pageDestino = $pageDestino;
    }

}
