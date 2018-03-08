<div class="p-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-home fa-home"></i>Cliente PHP</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link" href="movimientos.php">Movimientos</a>
                    </li>
                    <li class="nav-item">
                        <a href="recibos.php" class="active nav-link">Recibos</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="py-2">
    <div class="container">

        <div class="row">     
            <div class="col-md-12" >
                <div id="response_client_js">
                    <div class="alert" id="alert_type" role="alert">
                        <span id="dialog_span"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">                    
            <div class="col-md-12">

                <form class="flex-row d-flex justify-content-start align-self-center">
                    <div class="form-group m-1" > <label>Nº Cuenta</label>
                        <input type="text" name="input_ncuenta" class="form-control" placeholder="123456789" maxlength="10" required> <small class="form-text text-muted">Introduce un número de cuenta válido y existente.&nbsp;</small> </div>                    
                    <div class="form-group d-flex flex-column justify-content-around w-100 m-1"> <label class="">Descripción</label>
                        <input type="text" name="input_descripcion" class="form-control" placeholder="Tranferencia/Pagos/Remesas..." required> <small class="form-text text-muted">Escribe un concepto de la operación</small> </div>
                    <div class="form-group m-1"> <label class="">Importe</label>
                        <input type="text" name="input_importe" class="form-control" placeholder="500" required> </div>
                        <button type="submit" name="ACTION" value="NEW_MOVIMIENTO" class="btn btn-secondary btn-sm d-flex align-self-center" id="crear_movimiento" data-toggle="modal">Realizar Operación</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if ($messageToUser != NULL) {
    echo '
<div class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> Respuesta Servidor</div>
                    <div class="card-body">
                        <h5> 
          ';
    echo $messageToUser;
    echo '
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
}

?>