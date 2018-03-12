<nav class="navbar navbar-expand-md bg-light navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fa d-inline fa-lg fa-cloud"></i><b>  AppBancaria</b></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse text-center justify-content-between" id="navbar2SupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="${baseUrlServer}${endpoint_movimientos}"><i class="fa d-inline fa-lg fa-square"></i> Movimientos</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="${baseUrlServer}${endpoint_apertura_cuentas}"><i class="fa d-inline fa-lg fa-square"></i> Apertura de Cuentas</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="${baseUrlServer}${endpoint_reintegros}"><i class="fa d-inline fa-lg fa-square"></i> Ingresos y Reintegros</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="${baseUrlServer}${endpoint_cerrar_cuentas}"><i class="fa d-inline fa-lg fa-square"></i> Cierre de cuentas</a>
                    </li>
                </ul>

            <#if loginOnFromServer??>
                <#if (loginOnFromServer.nombre)??>


            <form action="${baseUrlServer}${endpoint_index}" class="form-inline my-2 my-lg-0">
                <span class="navbar-text text-primary">

                            ${loginOnFromServer.nombre}

                    <input type="hidden" class="form-control" name="ID" id="exampleInputEmail1" value="${loginOnFromServer.id}">

                    </span>
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit" name="ACTION" value="LOGOUT">Logout</button>
                </form>


                </#if>
            </#if>

            </div>
        </div>
    </nav>
<div id="build_modal" ></div>
