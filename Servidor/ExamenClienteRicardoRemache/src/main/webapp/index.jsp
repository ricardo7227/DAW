<%-- 
    Document   : resultadosJsp
    Created on : 02-nov-2017, 21:26:26
    Author     : Gato
--%>

<%@page import="utils.Constantes"%>


<%@page import="java.util.ArrayList"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/functions" prefix = "fn" %>


<%@page contentType="text/html" pageEncoding="UTF-8" language="java"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">        
        <title>Alumnos List</title>
        <link rel="stylesheet prefetch" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css">
        <style>
            body {text-align: center}
            table {
                margin-left: auto;
                margin-right: auto;
            }
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
        <script>
            function cargarAlumno(id, nombre, fecha_nacimiento, mayor_edad) {
                document.getElementById("id").value = id;
                document.getElementById("nombre").value = nombre;
                document.getElementById("fecha_nacimiento").value = fecha_nacimiento;

                if (mayor_edad === true) {
                    document.getElementById("mayor_edad_true").checked = true;
                } else {
                    document.getElementById("mayor_edad_false").checked = true;
                }
            }

        </script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    </head>
    <body>
        
        <c:if test="${not empty alumnoResult}">
            <form action="alumnos">
                <h3><c:out value="${resultado}"/></h3>
                <input type="hidden" name="id" value="${alumnoResult.id}" ><br>           
                <button name="action" name="action" value="delete_force" type="submit">Borrar Completamente</button>
                <button name="action" name="action" value="CANCEL" type="submit">Cancelar</button>

            </form>

        </c:if>

        <c:if test="${empty alumnoResult}">
            <c:out value="${resultado}"/>

        </c:if>
        <br>
        <table class="table">
            <tr>
                
                <th>Nombre</th>
                <th>pass</th>                
                <th></th>
            </tr>
            <c:forEach var="alumno" items="${alumnosList}">
                <tr>
                    
                    <td contenteditable="true">
                        <c:out value="${alumno.name}"/>
                    </td>
                    <td contenteditable="true">
                        <c:out value="${alumno.password}"/>
                    </td>

                </tr>
            </c:forEach>
        </table>
        <form action="usuarios" >
            <input type="hidden" name="id" id="id" ><br>
            Nombre:
            <input type="text" name="name" id="nombre" ><br>
            Password:
            <input type="text" name="password" id="nombre" ><br>            
            <br>
            <input type="submit" name="action" value="INSERT">
            <input type="submit" name="action" value="GET">
            <input type="submit" name="action" value="UPDATE">
            <input type="submit" name="action" value="DELETE">
            <button  name="action" value="delete_force" type="submit">Delete Force</button>
        </form>  


        <p>Nº usuarios: 
            <c:out value="${fn:length(alumnosList)}"/>
        </p>

        <script>
            if (document.getElementById("fecha_nacimiento").type !== "date") { //if browser doesn't support input type="date", initialize date picker widget:
                $(function () {
                    // Find any date inputs and override their functionality
                    $('input[type="date"]').datepicker({dateFormat: 'yy-mm-dd'});
                });
            }

        </script>
    </body>
</html>
