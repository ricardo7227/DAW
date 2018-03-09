<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css"> </head>

    <body>
        <#include "/MenuAppTemplate.ftl">
        <div class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Cierre de Cuentas</h3>
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
                        <form class="" id="check_num_cuenta_form">
                            <div class="form-group m-1"> <label>Nº Cuenta</label>
                                <input type="text" class="form-control"  id="input_ncuenta" placeholder="123456789" maxlength="10"> <small class="form-text text-muted">Introduce un número de cuenta válido y existente.&nbsp;</small> </div>
                            <input type="submit" name="num_cuenta_sub" id="input_ncuenta_sub" style="display: none;"/>
                            <button type="button" id="cerrar_cuenta" class="btn btn-secondary btn-sm d-flex align-self-center" data-toggle="modal">Cerrar Cuenta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 10px;right:10px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:180px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo&nbsp;&nbsp;
        <img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16">
        </pingendo>



    <#include "/libreria.ftl">
    <script language="javascript" type="text/javascript" src="../js/CerrarCuentas.js"></script>    
    </body>

</html>