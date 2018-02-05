<?php

namespace api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use utilidades\EndPoints;
use api\ApikeyClient;
use function GuzzleHttp\json_decode;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AsignaturasApi
 *
 * @author Gato
 */
class AsignaturasApi {

    private $client;
    private static $instancia;
    

    public function __construct() {
        $this->client = new Client(['base_uri' => EndPoints::$BASE_URL,'headers'=>['apikey'=> ApikeyClient::apikeyClient]]);        
    }

    public static function getInstance() {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }

    public function getAllAsignaturas() {

        $response = $this->client->get(EndPoints::$ASIGNATURA_END_POINT);
        return json_decode($response->getBody());
    }

    public function insertAsignatura($asignatura) {
        $response = $this->client->put(EndPoints::$ASIGNATURA_END_POINT, [
            'query' => [
                'asignatura' => json_encode($asignatura)
    ]]);
        return json_decode($response->getBody());
    }

    public function updateAsignatura($asignatura) {
        $response = $this->client->post(EndPoints::$ASIGNATURA_END_POINT, [
            'form_params' => [
                'asignatura' => json_encode($asignatura)
            ]
        ]);
        return json_decode($response->getBody());
    }

   
    public function deleteAsignatura($asignatura,$force) {
       
        try {
            $response = $this->client->delete(EndPoints::$ASIGNATURA_END_POINT, [
                'query' => [
                    'asignatura' => json_encode($asignatura),'delete_force'=>($force)?'true':'false'
            ]]);

            $respuesta = json_decode($response->getBody());
            
        } catch (RequestException $e) {
            if ($e->getCode() == \utilidades\Constantes::CodeConflict) {
                $respuesta = $e->getCode();
            }
        } finally {
            
            return $respuesta;
        }
    }

}
