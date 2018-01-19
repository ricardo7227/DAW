<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';

use utilidades\Constantes;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

//recibe del formulario
$action = filter_input(INPUT_GET, Constantes::ACTION);
$ligaId = filter_input(INPUT_GET, Constantes::LIGA_ID);
$equipoAPI = filter_input(INPUT_GET, Constantes::HREF_EQUIPO_API);
$nombreEquipo = filter_input(INPUT_GET, Constantes::NOMBRE_EQUIPO);
$crestUri = filter_input(INPUT_GET, Constantes::CREST_URI);


switch ($action) {
    case Constantes::VIEW_LEAGUE:
        $header = array('headers' => array('X-Auth-Token' => 'b56d7f32fff346eeb2b860766c5eb4d6'));
        $client = new GuzzleHttp\Client($header);
        try {

            $response = $client->request('GET', 'http://api.football-data.org/v1/' . 'competitions/' . $ligaId . '/leagueTable');

            $json = json_decode($response->getBody());
            echo '<h5>' . $json->leagueCaption . '</h5>';
            echo '<h6> Jornada: ' . $json->matchday . '</h6>';
            if ($ligaId != 464) {
                echo '<table class="table table-striped">'
                . '<tr>'
                . '<th>position</th>'
                . '<th>crestURI</th>'
                . '<th>teamName</th>'
                . '<th>playedGames</th>'
                . '<th> points</th>'
                . '<th> goals</th>'
                . '<th>goalsAgainst</th>'
                . '<th> goalDifference</th>'
                . '<th> wins</th>'
                . '<th>draws</th>'
                . '<th>losses</th>'
                . '<th></th>'
                . '</tr>';

                foreach ($json->standing as $equipo) {
                    echo '<tr>';
                    echo '<td>' . $equipo->position . '</td>';
                    echo '<td><img src="' . $equipo->crestURI . '" class="img-thumbnail"></td>';
                    echo '<td>' . $equipo->teamName . '</td>';
                    echo '<td>' . $equipo->playedGames . '</td>';
                    echo '<td>' . $equipo->points . '</td>';
                    echo '<td>' . $equipo->goals . '</td>';
                    echo '<td>' . $equipo->goalsAgainst . '</td>';
                    echo '<td>' . $equipo->goalDifference . '</td>';
                    echo '<td>' . $equipo->wins . '</td>';
                    echo '<td>' . $equipo->draws . '</td>';
                    echo '<td>' . $equipo->losses . '</td>';
                    echo '<td> <button class="btn btn-primary" onclick=\'cargarEquipo("' . $equipo->crestURI . '","' . $equipo->teamName . '","' . $equipo->_links->team->href . '")\'>Ver Equipo</button></td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                var_dump($json);
            }
        } catch (RequestException $e) {
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }

        break;
    case Constantes::VIEW_TEAM:
        $client = new GuzzleHttp\Client(['base_uri' => $equipoAPI . '/']);
        $header = array('headers' => array('X-Auth-Token' => 'b56d7f32fff346eeb2b860766c5eb4d6'));
        $response = $client->get('players', $header);
        $json = json_decode($response->getBody());
        echo '<img src="' . $crestUri . '"class="img-thumbnail rounded float-right" style="height: 100px; width:auto;"> ';
        echo '<h5>Equipo : ' . $nombreEquipo . '</h5>';
        echo '<h5>Jugadores : ' . $json->count . '</h5>';
        echo '<table class="table table-striped">'
        . '<tr>'
        . '<th>name</th>'
        . '<th>position</th>'
        . '<th>jerseyNumber</th>'
        . '<th>dateOfBirth</th>'
        . '<th> nationality</th>'
        . '<th> contractUntil</th>'
        . '<th>marketValue</th>'
        . '</tr>';

        foreach ($json->players as $jugador) {
            echo '<tr>';
            echo '<td>' . $jugador->name . '</td>';
            echo '<td>' . $jugador->position . '</td>';
            echo '<td>' . $jugador->jerseyNumber . '</td>';
            echo '<td>' . $jugador->dateOfBirth . '</td>';
            echo '<td>' . $jugador->nationality . '</td>';
            echo '<td>' . $jugador->contractUntil . '</td>';
            echo '<td>' . $jugador->marketValue . '</td>';
            echo '</tr>';
        }
        echo '</table>';


        break;
    default :

        $client = new GuzzleHttp\Client(['base_uri' => 'http://api.football-data.org/v1/']);
        $header = array('headers' => array('X-Auth-Token' => 'b56d7f32fff346eeb2b860766c5eb4d6'));
        $response = $client->get('competitions/?season=2017', $header);
        $json = json_decode($response->getBody());

        echo '<table class="table table-striped">'
        . '<tr>'
        . '<th>ID</th>'
        . '<th>Caption</th>'
        . '<th>League</th>'
        . '<th>Year</th>'
        . '<th>Current Match Day</th>'
        . '<th>number Of Match days</th>'
        . '<th>number Of Teams</th>'
        . '<th>number Of Games</th>'
        . '<th>last Updated</th>'
        . '<th></th>'
        . '</tr>';

        foreach ($json as $liga) {
            echo '<tr>';
            echo '<td>' . $liga->id . '</td>';
            echo '<td>' . $liga->caption . '</td>';
            echo '<td>' . $liga->league . '</td>';
            echo '<td>' . $liga->year . '</td>';
            echo '<td>' . $liga->currentMatchday . '</td>';
            echo '<td>' . $liga->numberOfMatchdays . '</td>';
            echo '<td>' . $liga->numberOfTeams . '</td>';
            echo '<td>' . $liga->numberOfGames . '</td>';
            echo '<td>' . $liga->lastUpdated . '</td>';
            echo '<td> <button class="btn btn-primary" onclick="cargarLiga(' . $liga->id . ')">Ver Competición</button></td>';
            echo '</tr>';
        }
        echo '</table>';

        break;
}



