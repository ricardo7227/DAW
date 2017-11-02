<%-- 
    Document   : resultadosJsp
    Created on : 02-nov-2017, 21:26:26
    Author     : Gato
--%>

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
        <title>JSP Page</title>
    </head>
    <body>
        <%
            AlumnosDAO alumno = (AlumnosDAO) request.getAttribute("alumnos");
            ArrayList<Alumno> list = (ArrayList<Alumno>) alumno.getAllAlumnos();
            for (int i = 0; i < list.size() ; i++) {
                out.print("</br>" + list.get(i).getNombre() + " " + list.get(i).getFecha_nacimiento());    
                }
            

        %>
        <c:out value="${fn:length(param)}"/>



    </body>
</html>
