       <script>
            if (document.getElementById("fecha_nacimiento").type !== "date") { //if browser doesn't support input type="date", initialize date picker widget:
                $(function () {
                    // Find any date inputs and override their functionality
                    $('input[type="date"]').datepicker({dateFormat: 'yy-mm-dd'});
                });
            }

            function comprobarInputNota() {
                var formulario = document.getElementsByTagName("input")[0].value;
                if (formulario.length == 0 || !isInt(formulario)) {

                    alert("No has introducido una nota válida!");
                    return false;

                }
            }
            function isInt(value) {
                return !isNaN(value) &&
                        parseInt(Number(value)) == value &&
                        !isNaN(parseInt(value, 10));
            }

        </script>
    </body>
</html>
