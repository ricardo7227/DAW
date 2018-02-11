
<#assign title="Apertura de cuentas">
<#assign charset="UTF-8">

<!DOCTYPE html>
<html>
    <head>
        <title>${title}</title>
        <meta charset="${charset}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <#include "/libreria.ftl">
        </head>
    <body>
        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-5">
                        <h4>
                            Apertura de Cuentas
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row justify-content-center">
            <div class="col-sm-4">

                <form id="check_num_cuenta_form" action="">
                    Nº Cuenta:<input id="ncuenta_input" maxlength="10" required="" type="text" value="" />
                    <input type="submit" name="num_cuenta_sub" id="num_cuenta_sub" value="ncuenta" style="display: none;"/>
                    </form>

                </div>
            <div class="col-sm-4">
                <div class="alert" id="alert_type">
                    <span id="dialog_span"></span>
                    </div>

                </div>
            </div>
        <div id="datos_dni_1">
            <div class="row justify-content-center">
                <div class="col-sm-5">
                    <form id="check_dni_titular_form" action="">
                        DNI titular: <input id="dni_input" name="dni_input" maxlength="9" required="" type="text" value="" />
                        <input type="submit" name="dni_titular_sub" id="dni_titular_sub" value="ncuenta" style="display: none;"/>
                        </form>
                    </div>
                <div class="col-sm-5">
                    <div id="response_dni">
                        <span id="response_dni_span"></span>
                        </div>
                    </div>
                </div>
            </div>
        <div id="datos_cliente_1">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <p>
                        Introduce los datos del Nuevo Cliente
                        </p>
                    </div>
                <div class="col-sm-5">
                    <form id="check_datos_titular_form" action="">                    
                        Nombre: <input id="nombre_input" name="nombre_input" required="" type="text" value="" /><br />
                        Dirección: <input id="dir_input" name="dir_input" required="" type="text" value="" /><br />
                        Teléfono: <input id="tel_input" name="tel_input" required="" type="text" value="" /><br />
                        E-mail: <input id="email_input" name="email_input" required="" type="email" value="" /><br />
                        Fecha Nacimiento:<input id="fecha_input"  name="fecha_input" required="" type="date" value="" />
                        </form>
                    </div>
                <div class="col-sm-5">
                    <div id="response_cliente_1">
                        <span id="response_cliente_1_span"></span>
                        </div>
                    </div>
                </div>
            </div>
        <div id="new_titular">
            <div class="row justify-content-center">
                <div class="col-sm-2">
                    <button class="btn btn-primary" id="add_titular" type="button">Añadir otro títular?</button>
                    </div>
                </div>
            </div>
        <div id="datos_dni_2">
            <div class="row justify-content-center">
                <div class="col-sm-5">
                    <form id="check_dni_titular_form_2" action="">
                        DNI 2º titular: <input id="dni_input_2" name="dni_input" maxlength="9" required="" type="text" value="" />
                        <input type="submit" name="dni_titular_sub" id="dni_titular_sub_2" value="dni2" style="display: none;"/>
                        </form>
                    </div>
                <div class="col-sm-5">
                    <div id="response_dni_2">
                        <span id="response_dni_span_2"></span>
                        </div>
                    </div>
                </div>
            </div>
        <div id="datos_cliente_2">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <p>
                        Introduce los datos del Segundo Títular
                        </p>
                    </div>
                <div class="col-sm-5">
                    <form id="check_datos_titular_form_2">      
                        Nombre: <input id="nombre_input_2" name="nombre_input" required="" type="text" value="" /><br />
                        Dirección: <input id="dir_input_2" name="dir_input" required="" type="text" value="" /><br />
                        Teléfono: <input id="tel_input_2" name="tel_input" required="" type="text" value="" /><br />
                        E-mail: <input id="email_input_2" name="email_input" required="" type="email" value="" /><br />
                        Fecha Nacimiento:<input id="fecha_input_2"  name="fecha_input" required="" type="date" value="" />                                                                
                        </form>
                    </div>
                <div class="col-sm-5">
                    <div id="response_cliente_2">
                        <span id="response_cliente_2_span"></span>
                        </div>
                    </div>
                </div>
            </div>
        <form id="check_importe_form">
            <div id="importe">            
                <div class="row justify-content-center">
                    <div class="col-sm-3">
                        <p>
                            Saldo de Apertura
                            </p>
                        <input id="importe_input" name="importe_input" required="" type="text" value="" />
                        <div id="response_importe"/>
                        </div>
                    </div>
                </div>
            <div id="crear_cuenta">
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <br /><button type="submit" class="btn btn-primary">Crear Nueva Cuenta</button>
                        </div>
                    </div>
                </div>
            </form>
        <script>
            var end_point_apertura_cuentas = "/AppBancaria/aperturaCuentas";
            <#include "/js/apertura_cuentas.js">
            </script>

        </body>
    </html>
