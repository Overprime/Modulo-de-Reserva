<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CONSULTA DE ÁRTICULOS</title>
<?php include('../header.php'); ?>
</head>
<body>
<div class="container">
<div class="row clearfix">
<div class="col-md-12 column">
<h1>Búsqueda de Articulos</h1>
</div>
</div>
<div class="row clearfix">
<div class="col-md-4 column">
<input type="text" id="bus" name="bus" onkeyup="loadXMLDoc()" class="form-control" required
placeholder='Ingrese el código o descripción del articulo' />
</div>
</div>

<div id="myDiv"></div>
</div>
</body>
</html>