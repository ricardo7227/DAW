<%-- 
    Document   : chatGoogle
    Created on : 17-feb-2018, 21:34:40
    Author     : Gato
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Chat Room</title>
    </head>
    <body>
        <div id="output"></div> 
        <script language="javascript" type="text/javascript" src="websocket.js">
        </script>

        <div style="text-align: center;">
            <form action="">     
                <input id="user" value="<c:out value="${user}" />" type="hidden" ><br>
                <h2>Chat</h2>
                <input onclick="sayHello();" value="Say Hello" type="button"> 
                <input id="destino" value="Juan" type="text">
                <input id="myField" value="WebSocket" type="text"><br>
            </form>
        </div>
        
        <script>

            conectar();
        </script>
    </body>
</html>
