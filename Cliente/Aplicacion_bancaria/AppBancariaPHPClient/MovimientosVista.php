<div class="p-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-home fa-home"></i>Cliente PHP</a>
                    </li>
                    <li class="nav-item">
                        <a class="active nav-link" href="movimientos.php">Movimientos</a>
                    </li>
                    <li class="nav-item">
                        <a href="recibos.php" class="nav-link">Recibos</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="p-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="" id="for,m_movimientos">
                    <div class="form-group form-row d-flex align-self-start"> <label class="col-sm-2 col-form-label">Número Cuenta</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="input_ncuenta" placeholder="123456789" required="required" id="input_ncuenta">
                        </div> <small class="form-text text-muted">Introduce un número de cuenta válido</small> </div>
                    <div class="form-group form-row"> <label class="col-sm-2 col-form-label">Fecha inicial</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control form-control-sm" name="input_fecha_inicial" id="input_fecha_inicial" required="required">
                        </div>
                    </div>
                    <div class="form-group form-row"> <label class="col-sm-2 col-form-label">Fecha Final</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control form-control-sm" name="input_fecha_fin" id="input_fecha_fin" required="required">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="ACTION" value="GET_MOVIMIENTOS" id="input_button">Consultar</button>
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
if ($cargaMovimientos) {
    echo '
   <div class="py-1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th>#cuenta</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Descripción</th>
                <th>Importe</th>                
              </tr>
            </thead>
            <tbody>
              
';
    foreach ($rangoMovimiento as &$movi) {
        echo '<tr>';
        echo '      <td>' . $movi->mo_ncu . '</td>
                <td>' . $movi->mo_fec . '</td>
                <td>' . $movi->mo_hor . '</td>
                <td>' . $movi->mo_des . '</td>
                <td>' . $movi->mo_imp . '</td>
              </tr>              ';
    }
    unset($movi);
}
echo '</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
';
?>