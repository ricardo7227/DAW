<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$idalumno=$_GET['idalumno'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>dktable plugin advanced usage example</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.dktable.js"></script>
<!-- here is one of the default themes -->
<link href="css/dktable.css" type="text/css" rel="stylesheet"/>
<style></style>
</head>
<body>
<header id="header" class="info">
<h2>listado de partes para el alumno</h2>
</header>
<!-- container for dktable -->
<table id="example_table" width="1100px" class="dktable_default"></table>

<script type="text/javascript">

$(document).ready(function() {
	var options = {
		// columns titles
		headers: 		['edita','pdf','Id','asoc.grave','nombre/telf.padres','fecha-hora','tipo(L/G)','qué hizo','observaciones profesor','profesor que genera parte'],	
		// JSON source URL - this part of the request is unchangeable
		url: 			'informepartes.php?idalumno=<?=$idalumno?>',		
		// some special data to send - this can be changed latter with using of refresh method
		data:			{'price_prefix': 'dollars'},
		// number of rows to get during the init request
		defaultNumRows:	7,			
		//user can choose one of this values as number of rows to get		
		numRows:		[50,100,150],	
		// which columns should be sortable 			
		sortable: 		[4],
		// columns configuration						
		columns: [
			// this is a default type of column
                        {'type' : 'text', 'width': '10px'},
			{'type' : 'text', 'width': '10px'},
                        {'type' : 'text', 'width': '10px'},
			// you can specify width attribute
			{'type' : 'text', 'width': '20px'},
                        {'type' : 'text','width': '150px'},
                        {'type' : 'text','width': '100px'},
                        {'type' : 'text','width': '20px'},
                        {'type' : 'text','width': '250px'},
                        {'type' : 'text','width': '250px'},
                        {'type' : 'text','width': '200px'}			
		],
		// after all rows are showed you can make smth by specifying this callback
		onDrawComplete: function(area) {
			// you should always use area to search items to bind events...
			// especially if you use redrawRow method... otherwise you will get
			// events attached twice or more times :)
			$(".changestatus", area).click(function () {
				// all tr tabs have row_id attribute, you can get it
				var row_id = $(this).parent("td").parent("tr").attr('row_id');
				alert(row_id);
			});
		}
	};

	// initializing dktable
	$("#example_table").dktable(options);

	// just an example of how to programmly refresh table
	$("#refreshsmth").click(function() {
		$("#example_table").refresh();
	});

	// example of how to change additional params or how to send new params with the same URL
	$("#changesmth").click(function() {
		$("#example_table").refresh({'price_prefix' : 'euro'});
	});

	// example of how to refresh direct row by id
	$("#refreshrow").click(function() {
		$("#example_table").redrawRow('14');
	});

});

</script>
    <div>
        <label class="desc" id="l1"><a href='javascript:self.location="index.php"'>volver</a></label>
    </div>
    <br/>
    <div>
        <label class="desc" id="l1"><a href='javascript:self.location="report2.php?idalumno=<?=$idalumno?>"'>listado en PDF</a></label>
    </div>
</body>
</html>
