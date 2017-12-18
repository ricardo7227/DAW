<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace database;

/**
 * Description of credentialsDatabase
 *
 * @author Gato
 */
class credentialsDatabase {

    public $servername = "localhost:3306";
    public $username = "root";
    public $password = "nohay2sin3";
    public $database = "examen1";

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
