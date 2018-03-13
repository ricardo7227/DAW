<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        </head>

    <body class="">

        <#include "/MenuAppTemplate.ftl">
        <div id="response_from_server" ></div>
        <div class="py-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 contenteditable="true">Ingresos y Reintegros</h3>
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
                    <div class="col-md-2" >
                        <form class="" id="check_num_cuenta_form">
                            <div class="form-group m-1" > <label>Nº Cuenta</label>
                                <input type="text" name="input_ncuenta" id="input_ncuenta" class="form-control" placeholder="123456789" maxlength="10" required> <small class="form-text text-muted">Introduce un número de cuenta válido y existente.&nbsp;</small> </div>
                            <input type="submit" name="num_cuenta_sub" id="input_ncuenta_sub" style="display: none;"/>
                            </form>
                        </div>
                    <div class="col-md-10">
                        <form class="flex-row d-flex justify-content-start align-self-center" id="cuerpo_ing_rei_form">
                            <div class="form-group d-flex flex-column justify-content-around w-100 m-1"> <label class="">Descripción</label>
                                <input type="text" id="input_descripcion" name="input_descripcion" class="form-control" placeholder="Tranferencia/Pagos/Remesas..." required> <small class="form-text text-muted">Escribe un concepto de la operación</small> </div>
                            <div class="form-group m-1"> <label class="">Importe</label>
                                <input type="text" name="input_importe" id="input_importe" class="form-control" placeholder="500" required> </div>
                            <button type="button" class="btn btn-secondary btn-sm d-flex align-self-center" id="crear_movimiento" data-toggle="modal">Realizar Operación</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <script
            src="http://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   

    <script language="javascript" type="text/javascript" src="../js/ingresos.js"></script>    
    <#include "/libreria.ftl">


    </body>

</html>