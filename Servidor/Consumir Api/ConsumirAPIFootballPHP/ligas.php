<?php

ini_set('display_errors', 'On');
require_once 'config/Config.php';

use controller\Constantes;

//recibe del formulario
//$id = filter_input(INPUT_GET, SqlQuery::ID);
$action = filter_input(INPUT_GET, Constantes::ACTION);

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

foreach ($json as $ligas) {
    echo '<tr>';
    echo '<td>' . $ligas->id . '</td>';
    echo '<td>' . $ligas->caption . '</td>';
    echo '<td>' . $ligas->league . '</td>';
    echo '<td>' . $ligas->year . '</td>';
    echo '<td>' . $ligas->currentMatchday . '</td>';
    echo '<td>' . $ligas->numberOfMatchdays . '</td>';
    echo '<td>' . $ligas->numberOfTeams . '</td>';
    echo '<td>' . $ligas->numberOfGames . '</td>';
    echo '<td>' . $ligas->lastUpdated . '</td>';
    echo '<td> <button class="btn btn-primary" onclick="cargarLiga('.$ligas->id.')">Ver Competición</button></td>';
    echo '</tr>';
}
echo '</table>';


