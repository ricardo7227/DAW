<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

foreach ($_REQUEST as $color => $valor) {
    echo '<h1 style="color:' . $color . '">';

    echo ($color . "=" . $valor);
    ?> </h1>
    <?php
}
