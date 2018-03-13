<nav class="navbar navbar-expand-md bg-light navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fa d-inline fa-lg fa-money"></i><b>  AppBancaria</b></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse text-center justify-content-between" id="navbar2SupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="${baseUrlServer}${endpoint_movimientos}"><i class="fa d-inline fa-lg far  fa-circle-thin"></i> Movimientos</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="${baseUrlServer}${endpoint_apertura_cuentas}"><i class="fa d-inline fa-lg  fa-circle-thin"></i> Apertura de Cuentas</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="${baseUrlServer}${endpoint_reintegros}"><i class="fa d-inline fa-lg  fa-circle-thin"></i> Ingresos y Reintegros</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="${baseUrlServer}${endpoint_cerrar_cuentas}"><i class="fa d-inline fa-lg  fa-circle-thin"></i> Cierre de cuentas</a>
                    </li>
                </ul>

            <#if loginOnFromServer??>
                <#if (loginOnFromServer.nombre)??>

            <a class="navbar-brand " href="#"  style="max-width: 7%;">

                <img src="https://i.imgur.com/aAQQ1oUt.jpg"class="rounded-circle  img-thumbnail img-fluid">
                </a>
            <form action="${baseUrlServer}${endpoint_index}" class=" ">


                <span class="navbar-text text-primary">
                            ${loginOnFromServer.nombre}
                    </span>

                <input type="hidden" class="form-control" name="ID" id="exampleInputEmail1" value="${loginOnFromServer.id}">




                <button class="btn btn-outline-info my-2 my-sm-0 btn-sm d-flex align-self-center" type="submit" name="ACTION" value="LOGOUT">Logout</button>

                </form>


                </#if>
            </#if>

            </div>
        </div>
    </nav>
<div id="build_modal" ></div>
