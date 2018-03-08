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
 * Description of AlumnosApi
 *
 * @author Gato
 */
class OperacionesApi {

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

    public function getMovimientos($rango) {

        try {
            $response = $this->client->get(EndPoints::$OPERACIONES_END_POINT, [
                'query' => [
                    'rango' => json_encode($rango),
                    'operacion' => 'get_movimientos'
            ]]);
            $respuesta = json_decode($response->getBody());
        } catch (RequestException $e) {
            if ($e->getCode() == Constantes::CodeBadRequest) {
                preg_match_all('/\{(.*?)\}/', $e->getMessage(), $respuestaError);
                $respuesta = json_decode($respuestaError[0][0]);
            }
        } finally {

            return $respuesta;
        }
    }

    public function addRecibo($movimiento) {
        try {
            $response = $this->client->put(EndPoints::$OPERACIONES_END_POINT, [
                'query' => [
                    'movimiento' => json_encode($movimiento),
                    'operacion' => 'recibo'
            ]]);
            $respuesta = json_decode($response->getBody());
        } catch (RequestException $e) {
            if ($e->getCode() == Constantes::CodeBadRequest) {
                preg_match_all('/\{(.*?)\}/', $e->getMessage(), $respuestaError);
                $respuesta = json_decode($respuestaError[0][0]);
            }
        } finally {

            return $respuesta;
        }
    }

}
