<?php

namespace api;

use api\ApikeyClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use utilidades\Constantes;
use utilidades\EndPoints;
use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotasApi
 *
 * @author Gato
 */
class NotasApi {

    private $client;
    private static $instancia;

    public function __construct() {
        $this->client = new Client(['base_uri' => EndPoints::$BASE_URL, 'headers' => ['apikey' => ApikeyClient::apikeyClient]]);
    }

    public static function getInstance() {
        if (!self::$instancia instanceof self) {
            self::$instancia = new self;
        }
        return self::$instancia;
    }

    public function getNota($nota) {
        try {
            $response = $this->client->get(EndPoints::$NOTA_END_POINT, [
                'query' => [
                    'nota' => json_encode($nota)
            ]]);
            $respuesta = json_decode($response->getBody());
        } catch (RequestException $e) {
            if ($e->getCode() == Constantes::CodeNotFound) {
                $respuesta = $e->getCode();
            }
        } finally {

            return $respuesta;
        }
    }

    public function insertNota($nota) {
        $response = $this->client->put(EndPoints::$NOTA_END_POINT, [
            'query' => [
                'nota' => json_encode($nota)
        ]]);
        return json_decode($response->getBody());
    }

    public function updateNota($nota) {
        $response = $this->client->post(EndPoints::$NOTA_END_POINT, [
            'form_params' => [
                'nota' => json_encode($nota)
            ]
        ]);
        return json_decode($response->getBody());
    }

    public function deleteNota($nota, $force) {

        try {
            $response = $this->client->delete(EndPoints::$NOTA_END_POINT, [
                'query' => [
                    'nota' => json_encode($nota), 'delete_force' => ($force) ? 'true' : 'false'
            ]]);

            $respuesta = json_decode($response->getBody());
        } catch (RequestException $e) {
            if ($e->getCode() == Constantes::CodeConflict) {
                $respuesta = $e->getCode();
            }
        } finally {

            return $respuesta;
        }
    }

}
