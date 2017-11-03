<%-- 
    Document   : resultadosJsp
    Created on : 02-nov-2017, 21:26:26
    Author     : Gato
--%>

<%@page import="utils.Constantes"%>
<%@page import="dao.AlumnosDAO"%>
<%@page import="model.Alumno"%>
<%@page import="java.util.ArrayList"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/functions" prefix = "fn" %>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Alumnos List</title>
        <style>
            body {text-align: center}
            table {
                margin-left: auto;
                margin-right: auto;
            }
        </style>
        <script>
            function cargarAlumno(id, nombre, fecha_nacimiento, mayor_edad) {
                document.getElementById("id").value = id;
                document.getElementById("nombre").value = nombre;
                document.getElementById("fecha_nacimiento").value = fecha_nacimiento;
                document.getElementById("mayor_edad").value = mayor_edad;
            }
        </script>
    </head>
    <body>

        <table class="table">
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Fecha</th>                
                <th></th>
            </tr>
            <c:forEach var="alumno" items="${alumnosList}">
                <tr>
                    <td>
                        <button id="cargarAlumno" onClick="
                                cargarAlumno(${alumno.id}, '${alumno.nombre}', '${alumno.fecha_nacimiento}',
                                        '${alumno.mayor_edad}')">Cargar</button>
                    </td>
                    <td contenteditable="true">
                        <c:out value="${alumno.nombre}"/>
                    </td>
                    <td contenteditable="true">
                        <c:out value="${alumno.fecha_nacimiento}"/>
                    </td>

                </tr>
            </c:forEach>
        </table>
        <form target="">
            <input type="hidden" name="id" id="id" value="1"><br>
            Nombre:
            <input type="text" name="nombre" id="nombre" value="Mickey"><br>
            Fecha Nacimiento:
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="25-05-1999"><br>
            Mayor de edad:
            <input type="text" name="mayor_edad" id="mayor_edad" value="NO">
            <br>
            <input type="submit" name="action" value="INSERT">
            <input type="submit" name="action" value="UPDATE">
            <input type="submit" name="action" value="DELETE">
        </form>  



        <c:out value="${fn:length(alumnosList)}"/>



    </body>
</html>
