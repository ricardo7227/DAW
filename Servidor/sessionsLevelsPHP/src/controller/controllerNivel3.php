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

    public function processRequest3() {

        //Sessiones anteriores
        if (!isset($_SESSION[\Constantes::nivel1]) || !isset($_SESSION[\Constantes::num3])) {
            
            $this->setMessage(\Constantes::messageLevelJumpError);
        } else {

            $paramNivel3 = $_REQUEST[\Constantes::nivel3];
            if (isset($paramNivel3) && strlen($paramNivel3) > 0) {//parametros vacios
                if (\Constantes::passNivel3 === $paramNivel3) {

                    $_SESSION[\Constantes::nivel3] = $paramNivel3;
                    $this->setMessage(\Constantes::messageCongratulations);
                } else {
                    $this->setMessage(sprintf(\Constantes::messageLevelError, \Constantes::nivel3));
                }
            } else {

                $this->setMessage(\Constantes::messageParametrosVacios);
            }
        }

        $this->setPageDestino(\Constantes::pageDestino);

        include $this->pageDestino;
    }

//fin processRequest

    function getMessage() {
        return $this->message;
    }

    function getPageDestino() {
        return $this->pageDestino;
    }

    function setMessage($message) {
        $this->message = $message;
        if (strstr($message, \Constantes::error)) {
            //session_destroy(); //destruye toda la session si enviamos un mensaje de error            
        }
    }

    function setPageDestino($pageDestino) {
        $this->pageDestino = $pageDestino;
    }

}

//fin controllerNivel3
