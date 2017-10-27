<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>next page</title>
    </head>
    <body><h2>
            <?php
            echo $this->message;
            if ($this->message == Constantes::messageCongratulations){
                echo '</br><img src="../vista/image.png" style="width: 30%;height: auto"/>';
            }
                
            ?>
        </h2>
        
    </body>
</html>
