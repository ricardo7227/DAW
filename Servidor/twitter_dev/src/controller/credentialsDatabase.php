<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;

/**
 * Description of credentialsDatabase
 *
 * @author Gato
 */
class credentialsDatabase {

    public $servername = "discutivo.com";
    public $username = "discu351_test";
    public $password = "nohay2sin3";
    public $database = "discu351_test";

    public function getServername() {
        return $this->servername;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDatabase() {
        return $this->database;
    }

}//fin clase
