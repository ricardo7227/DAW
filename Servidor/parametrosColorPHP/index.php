<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Parametros Color</title>
    </head>
    <body>
        <?php
        echo 'url:?blue=azul';
        foreach ($_REQUEST as $key => $val) {
            
                echo '<h1 style="color:' .$key.'">';
                
                echo ($key . "=" . $val);
                ?> </h1>
            <?php
        }
        ?>
    </body>
</html>
