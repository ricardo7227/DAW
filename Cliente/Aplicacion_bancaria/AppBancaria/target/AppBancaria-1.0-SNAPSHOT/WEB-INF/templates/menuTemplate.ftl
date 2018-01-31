<#assign baseUrl="${baseUrlServer}">
<#assign super=1 admin=2 profe=3 alumno=4>

<#if loginOnFromServer??>
<#if (levelAccess)??>

<#switch levelAccess>
  <#case super>
<nav class="navbar navbar-expand-lg navbar-light bg-light  ">
    <a class="navbar-brand" href="${baseUrl}">CRUD SUPER</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">                      
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_notas}">Notas</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_administrador}">Administrador</a>
                </li>                                       
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_superuser}">Super Usuario</a>
                </li>                                       
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_tareas_profesor}">Crear Tareas</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_tareas_alumno}">Ver Tareas</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_notas_alumno}">Ver Notas</a>
                </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Asociar
                    </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="${baseUrl}${endpoint_alumno_asignaturas}">Alumnos - Asignaturas</a>
                    <a class="dropdown-item" href="${baseUrl}${endpoint_profesor_asignaturas}">Profesor - Asignatura</a> 
                    <a class="dropdown-item" href="${baseUrl}${endpoint_asignaturas}">Asignaturas - Cursos</a>
                    </div>
                </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Informes
                    </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="${baseUrl}${endpoint_informe_notas_asignaturas}">Notas Asignaturas</a>
                    <a class="dropdown-item" href="${baseUrl}${endpoint_informe_notas_alumnos}">Notas Alumnos</a>
                    <a class="dropdown-item" href="${baseUrl}${endpoint_informe_alumno_notas}">Notas Alumno</a>
                    </div>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_cambiar_password}">Cambiar Contraseña</a>
                </li>


            </ul>


        </div>
            <#if loginOnFromServer??>
                <#if (loginOnFromServer.nombre)??>
                    <#if (levelAccess)??>

    <form action="${baseUrl}${endpoint_index}" class="form-inline my-2 my-lg-0">
        <span class="navbar-text text-primary">

                            ${loginOnFromServer.nombre}

            <input type="hidden" class="form-control" name="ID" id="exampleInputEmail1" value="${loginOnFromServer.id}">

            </span>
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit" name="ACTION" value="LOGOUT">Logout</button>
        </form>

                    </#if>
                </#if>
            </#if>
    </nav>
     <#break>
  <#case admin>
<nav class="navbar navbar-expand-lg navbar-light bg-light  ">
    <a class="navbar-brand" href="${baseUrl}">CRUD ADMIN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">                      
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_notas}">Notas</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_administrador}">Administrador</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_superuser}">SuperUsuario</a>
                </li>            
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_tareas_profesor}">Crear Tareas</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_tareas_alumno}">Ver Tareas</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_notas_alumno}">Ver Notas</a>
                </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Asociar
                    </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="${baseUrl}${endpoint_alumno_asignaturas}">Alumnos - Asignaturas</a>
                    <a class="dropdown-item" href="${baseUrl}${endpoint_profesor_asignaturas}">Profesor - Asignatura</a> 
                    <a class="dropdown-item" href="${baseUrl}${endpoint_asignaturas}">Asignaturas - Cursos</a>
                    </div>
                </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Informes
                    </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="${baseUrl}${endpoint_informe_notas_asignaturas}">Notas Asignaturas</a>
                    <a class="dropdown-item" href="${baseUrl}${endpoint_informe_notas_alumnos}">Notas Alumnos</a>
                    <a class="dropdown-item" href="${baseUrl}${endpoint_informe_alumno_notas}">Notas Alumno</a>
                    </div>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_cambiar_password}">Cambiar Contraseña</a>
                </li>


            </ul>


        </div>
            <#if loginOnFromServer??>
                <#if (loginOnFromServer.nombre)??>
                    <#if (levelAccess)??>

    <form action="${baseUrl}${endpoint_index}" class="form-inline my-2 my-lg-0">
        <span class="navbar-text text-primary">

                            ${loginOnFromServer.nombre}

            <input type="hidden" class="form-control" name="ID" id="exampleInputEmail1" value="${loginOnFromServer.id}">

            </span>
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit" name="ACTION" value="LOGOUT">Logout</button>
        </form>

                    </#if>
                </#if>
            </#if>
    </nav>
     <#break>
  <#case profe>
<nav class="navbar navbar-expand-lg navbar-light bg-light  ">
    <a class="navbar-brand" href="${baseUrl}">CRUD PROFE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">                      
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_notas}">Notas</a>
                </li>                                                            
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_tareas_profesor}">Crear Tareas</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_informe_notas_alumnos}">Informe Notas Alumnos</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_cambiar_password}">Cambiar Contraseña</a>
                </li>          
            </ul>


        </div>
            <#if loginOnFromServer??>
                <#if (loginOnFromServer.nombre)??>
                    <#if (levelAccess)??>

    <form action="${baseUrl}${endpoint_index}" class="form-inline my-2 my-lg-0">
        <span class="navbar-text text-primary">

                            ${loginOnFromServer.nombre}

            <input type="hidden" class="form-control" name="ID" id="exampleInputEmail1" value="${loginOnFromServer.id}">

            </span>
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit" name="ACTION" value="LOGOUT">Logout</button>
        </form>

                    </#if>
                </#if>
            </#if>
    </nav>
     <#break>
  <#case alumno>
<nav class="navbar navbar-expand-lg navbar-light bg-light  ">
    <a class="navbar-brand" href="${baseUrl}">CRUD ALUMNO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">                                                                                
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_tareas_alumno}">Ver Tareas</a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_notas_alumno}">Ver Notas</a>
                </li>  
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_cambiar_password}">Cambiar Contraseña</a>
                </li> 
            </ul>


        </div>
            <#if loginOnFromServer??>
                <#if (loginOnFromServer.nombre)??>
                    <#if (levelAccess)??>

    <form action="${baseUrl}${endpoint_index}" class="form-inline my-2 my-lg-0">
        <span class="navbar-text text-primary">

                            ${loginOnFromServer.nombre}

            <input type="hidden" class="form-control" name="ID" id="exampleInputEmail1" value="${loginOnFromServer.id}">

            </span>
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit" name="ACTION" value="LOGOUT">Logout</button>
        </form>

                    </#if>
                </#if>
            </#if>
    </nav>
     <#break>
  <#default>
<nav class="navbar navbar-expand-lg navbar-light bg-light  ">
    <a class="navbar-brand" href="${baseUrl}">CRUD USER</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">                                                                                
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_index}">No tienes Privilegios para Acceder</a>
                </li>                     
            <li class="nav-item">
                <a class="nav-link" href="${baseUrl}${endpoint_cambiar_password}">Cambiar Contraseña</a>
                </li> 
            </ul>
        </div>
            <#if loginOnFromServer??>
                <#if (loginOnFromServer.nombre)??>
                    <#if (levelAccess)??>

    <form action="${baseUrl}${endpoint_index}" class="form-inline my-2 my-lg-0">
        <span class="navbar-text text-primary">

                            ${loginOnFromServer.nombre}

            <input type="hidden" class="form-control" name="ID" id="exampleInputEmail1" value="${loginOnFromServer.id}">

            </span>
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit" name="ACTION" value="LOGOUT">Logout</button>
        </form>

                    </#if>
                </#if>
            </#if>
    </nav>
</#switch>

</#if>
<#else>

</#if>




<!--Pendiente de Terminar -->

