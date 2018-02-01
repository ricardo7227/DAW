<?php

namespace api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use utilidades\EndPoints;
use function GuzzleHttp\json_decode;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlumnosApi
 *
 * @author Gato
 */
class AlumnosApi {

    private $client;
    private static $instancia;

    public function __construct() {
        $this->client = new Client(['base_uri' => EndPoints::$BASE_URL]);
    }

    public static function getInstance() {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }

    public function getAllAlumnos() {

        $response = $this->client->get(EndPoints::$ALUMNOS_END_POINT);
        return json_decode($response->getBody());
    }

    public function insertAlumno($alumno) {
        $response = $this->client->put(EndPoints::$ALUMNOS_END_POINT, [
            'query' => [
                'alumno' => json_encode($alumno)
        ]]);
        return json_decode($response->getBody());
    }

    public function updateAlumno($alumno) {
        $response = $this->client->post(EndPoints::$ALUMNOS_END_POINT, [
            'form_params' => [
                'alumno' => json_encode($alumno)
            ]
        ]);
        return json_decode($response->getBody());
    }

   
    public function deleteAlumno($alumno,$force) {
       
        try {
            $response = $this->client->delete(EndPoints::$ALUMNOS_END_POINT, [
                'query' => [
                    'alumno' => json_encode($alumno),'delete_force'=>$force
            ]]);

            $respuesta = json_decode($response->getBody());
            //var_dump($response->getStatusCode());
        } catch (RequestException $e) {
            if ($e->getCode() == \utilidades\Constantes::CodeConflict) {
                $respuesta = $e->getCode();
            }
        } finally {
            //var_dump($respuesta);
            return $respuesta;
        }
    }

}
