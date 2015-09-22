<!DOCTYPE html>
<html lang="es">

<head><title>BÚSQUEDA DE ARTICULOS</title>
<meta charset="UTF-8" />
<script type="text/javascript" src="ajax.js"></script>
<?php include('../header.php'); ?>
</head>

<body>
<div class="container">


<div class="row clearfix">

<div class="col-md-12 column">
<h1 class="text-success"><b>BÚSQUEDA DE ARTICULOS</b></h1>
<input type="text" id="bus" name="bus" onkeyup="loadXMLDoc()" class="form-control" required
placeholder='Ingrese la descripción del árticulo para la búsqueda' />


</div>
</div>
<P>	</P>
<div id="myDiv"></div>
</div>



</body>

</html>