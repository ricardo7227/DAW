<#assign charset="UTF-8">
<#assign title="Movimientos">

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
                        <h4>Lista de movimientos</h4>
                        </div>                    
                    </div>
                <div class="row">    
                    <div class="col-sm-12">    
                        <p>Filtrar movimientos por fechas</p>
                        <form>
                            Inicio:
                            <input type="date" name="fecha_ini" id="fecha_ini" required />
                            Fin:
                            <input type="date" name="fecha_fin" id="fecha_fin" required/>
                            <button id="ver_movimientos" type="submit" class="btn btn-primary">Ver Movimientos</button>
                            </form>
                        <div id="response">
                            <table class="table table-striped" id="table_response">
                                <thead>
                                    <tr>
                                        <th scope="col"># Cuenta</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Importe</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <tr id="row_response"/>
                                    </tbody>
                                </table>
                            </div>
                        <div id="response_client_js">
                            <div class="alert" id="alert_type" role="alert">
                                <span id="dialog_span"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <script>
            var end_point_movimientos = "/AppBancaria/movimientosServlet";
            <#include "/js/movimientos.js">
            </script>
        </body>
    </html>
