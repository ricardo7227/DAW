<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        ini_set('display_errors', 'On');
        require_once 'vendor/autoload.php';
        use controller\Config;
        $varia = new Config();
        $nue = $varia ->nombre("dddd");
        echo $nue;
        ?>
    </body>
</html>
