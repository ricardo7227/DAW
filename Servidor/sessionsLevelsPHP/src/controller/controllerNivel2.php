<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

/**
 * Description of controllerNivel2
 *
 * @author Gato
 */
class controllerNivel2 {

    private $message = "Default Message";
    private $DestinoPage = "Default Page";

    public function processRequest() {

        if (isset($_SESSION[\Constantes::nivel1])) {




            $param1 = $_REQUEST[\Constantes::num1];
            if (\Constantes::passNum1 == $param1) {//primera entrada
                $_SESSION[\Constantes::num1] = $param1;

                $this->setMessage(sprintf(\Constantes::messageLevelNextNum, \Constantes::num2));
            } else if (isset($_SESSION[\Constantes::num1])) {//segunda entrada
                
                $param2 = $_REQUEST[\Constantes::num2];
                if (\Constantes::passNum2 == $param2) {

                    $_SESSION[\Constantes::num2] = $param2;

                    $this->setMessage(sprintf(\Constantes::messageLevelNextNum, \Constantes::num3));
                } else if (isset($_SESSION[\Constantes::num2])) {//tercera entrada
                    $param3 = $_REQUEST[\Constantes::num3];
                    if (\Constantes::passNum3 == $param3) {

                        $_SESSION[\Constantes::num3] = $param3;

                        $this->setMessage(\Constantes::messageLevelCompleted . \Constantes::nivel3);
                    } else {
                        $this->setMessage(sprintf(\Constantes::messageLevelError, \Constantes::nivel2));

                        //pendiente error en las sessiones nivel 2
                        // session.invalidate();
                    }
                } else {
                    $this->setMessage(sprintf(\Constantes::messageLevelError, \Constantes::nivel2));


                    //session.invalidate();
                }
            } else {
                $this->setMessage(sprintf(\Constantes::messageLevelError, \Constantes::nivel2));

                //session.invalidate();
            }
        } else {
            
            $this->setMessage(\Constantes::messageLevelJumpError);
        }
        $this->setDestinoPage(\Constantes::pageDestino);
        include $this->DestinoPage;
    }

    function getMessage() {
        return $this->message;
    }

    function getDestinoPage() {
        return $this->DestinoPage;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setDestinoPage($DestinoPage) {
        $this->DestinoPage = $DestinoPage;
    }

}
