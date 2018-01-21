<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Twitter ASUKA</title>
        <style>
            div{
                /*border: 1px solid black;*/
            }
            .page {
                float:left;                                                
                width: 100%;
                height:100vh;
            }
            .page .front {
                display: block;
                z-index: 5;
                position: relative;
            }
            .bar-tweet{                
                background-color: rgba(74, 81, 121, 0.6);
            }
            .front{
                margin-top: 10em;
            }
            .page {
                margin-top: 1em;
                transition: margin 1s;
            }

            .page:hover {
                margin-top: 10em;
                transition: margin 1s;
            }
            html{
                background-size:cover;                
                background:url('https://i.imgur.com/7uR67pI.jpg') center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            .page .behind_container {
                height: 100%;
                position: relative;
                top: -10em;
            }

        </style>
        <script>


        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="page">
            <div class="front">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">

                            <div class=" bar-tweet border border-info font-weight-normal text-white rounded border-bottom border-right" >


                                <div class="form-group ">
                                    <label for="exampleFormControlTextarea1">Qué quieres contar?</label>
                                    <textarea name="message" id="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <input type="hidden" id="ACTION" name="ACTION" value="UPDATE"/>
                                <button type="submit" id="botonId" class="btn btn-primary">Twittear</button>
                            </div>
                            <div id="respuesta">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="behind_container">
                
            </div>


            <script>
            var targetResponseId = "#respuesta";
            var botonId = "#botonId";
            var messageId = "#message";

            $(document).ready(function () {
                $(botonId).click(loadAjax);
                $(targetResponseId).hide();
                $(messageId).keypress(81, function (e) {
                    if (e.ctrlKey) {
                        $(botonId).click(loadAjax());
                    }

                });
                console.log("Ready");
            });

            function loadAjax() {
                $(targetResponseId).load("euphonium.php", {message: $("#message").val(), ACTION: $("#ACTION").val()}, function (respuesta) {
                    $("#message").val('');
                    $(targetResponseId).show(1000);
                    console.log("primer respose");
                    setTimeout(function () {
                        $(targetResponseId).hide(1000);
                    }, 20000);
                    console.log(respuesta);


                });
            }

            </script>
        </div>
    </body>
</html>
