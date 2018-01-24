<?php

namespace db;

/**
 * Description of Database
 *
 * @author daw
 */
class Database {

    public static $host = "localhost";
    public static $user = "root";
    public static $password = "alumno";
    public static $database = "Banco";
    public static $conexion;

    /**
     * 
     * @param type $credenciales
     * @return type conexión con la base de datos
     */
    function conexionDB() {

        $this->$conexion = null;

        try {
        $this->$conexion = new PDO("mysql:host=$this->$host;dbname=$this->$database;charset=utf8", $this->$user, $this->$password);

            $this->$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //para las excepciones
        } catch (PDOException $e) {
            $e->getMessage();
            $this->$conexion = null;
        }

        return $this->$conexion;
    }

    function cerrarConexion() {
        $this->$conexion = NULL;
    }
    
    

}

//fin clase
