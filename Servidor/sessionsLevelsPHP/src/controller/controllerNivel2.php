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
    public function processRequest($paramNivel2) {
        
        if (isset($_SESSION[\Constantes::nivel1])) {
            echo $paramNivel2;
            if ($paramNivel2 == "num1" || isset($_SESSION["num1"])){
                $_SESSION["num1"] = "confirm";
                echo $paramNivel2;
            }
            
        } else {
            $this->setDestinoPage(\Constantes::pageDestino);
            $this->setMessage(\Constantes::messageLevelJumpError);
        }
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
