<%-- 
    Document   : nextStep
    Created on : 19-oct-2017, 12:39:42
    Author     : daw
--%>

<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<jsp:useBean id="cons" class="utils.Constante" scope="session"/>
<%@page import="utils.Constante"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><c:out value="${currentlevel}"/></title>
    </head>


    <body style="background-color: <c:out value="${color}"/>">



        <h1>
            <c:out value="${resultmessage}" />
            <c:out value="${leveltarget}" />


        </h1>


        <c:if test="${resultlevel == 'crashlevel'}">
            <h1>
                <c:out value="${cons.getPassWrong()}"/>  

            </h1>


        </c:if>    

    </body>
</html>
