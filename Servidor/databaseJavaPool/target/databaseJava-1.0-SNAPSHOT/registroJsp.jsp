<%-- 
    Document   : registroJSP
    Created on : 30-nov-2017, 18:30:09
    Author     : Gato
--%>

<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@taglib prefix="fn" uri="http://java.sun.com/jsp/jstl/functions" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>

<jsp:useBean id="cons" class="utils.UrlsPaths" scope="session"/>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registro Usuarios</title>
        <link rel="stylesheet prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css">
        <style>
            .container {
                margin: 0 auto;
                text-align: center;
                width: 100%;
            }
            .container a {
                padding-left: 20px;
                font-size: 1.5em;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <c:set var="baseURL" value="${fn:replace(pageContext.request.requestURL, pageContext.request.requestURI, pageContext.request.contextPath)}" />

            <a href="<c:out value="${baseURL}${cons.getAlumnos()}"/>">alumnos</a>
            <a href="<c:out value="${baseURL}${cons.getAsignaturas()}"/>">asignaturas</a>
            <a href="<c:out value="${baseURL}${cons.getNotas()}"/>">notas</a>
            <a href="<c:out value="${baseURL}${cons.getRegistro()}"/>">registro</a>

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            Registrar Usuarios:
                        </p>

                        <form action="${baseURL}${cons.getRegistro()}">
                            Nombre:<input name="NOMBRE" placeholder="Username" required="" type="text" /><br />
                            Email:<input name="EMAIL" placeholder="user@gmail.com" required="" type="email" /><br />
                            Contraseña:<input name="PASSWORD" placeholder="password" required="" type="password" /><br />
                            <input name="action" type="submit" value="REGISTRAR" />
                        </form>
                    </div>
                    <div class="col-md-6">
                        <p>
                            Login Usuarios:
                        </p>



                        <form action="${baseURL}${cons.getRegistro()}">
                            Nombre:<input name="NOMBRE" placeholder="Username" required="" type="text" /><br />                            
                            Contraseña:<input name="PASSWORD" placeholder="password" required="" type="password" /><br />
                            <input name="action" type="submit" value="LOGIN" />
                        </form>

                    </div>
                </div>
            </div>
            <c:if test="${not empty messageFromServer}">
                <div class="alert alert-info" role="alert">
                    <p>
                        <c:out value="${messageFromServer}"/>               
                    </p>
                </div>

            </c:if>
            <c:if test="${not empty sessionScope.loginOnFromServer}">
                <div class="alert alert-success" role="alert">
                    <p>
                        Bienvenido, <c:out value="${sessionScope.loginOnFromServer.nombre}"/>.
                        <br>
                        Estás Logueado correctamente!
                        <br>
                        <%-- <jsp:setProperty name="cons" property="logout" value="Nuevo valor" />--%>
                        <a class="btn btn-primary" href="${baseURL}<jsp:getProperty name="cons" property="logout" />" role="button">Cerrar Sesión</a>
                    </p>
                </div>

            </c:if>
        </div>
    </body>
</html>
