
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>APLICATIVO WEB  DE RESERVAS DE ARTICULOS</title>
<!-- Core CSS - Include with every page -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="css/pace-theme-big-counter.css" rel="stylesheet" />
<link href="css/style-login.css" rel="stylesheet" />
<link href="css/main-style.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.js"></script>

</head>

<body class="body-Login-back">

<div class="container">

<div class="row">
<div class="col-md-4 col-md-offset-4 text-center logo-margin ">
<h1 class="text-default"><em>RESERVAS ONLINE</em> </h1>
</div>
<div class="col-md-4 col-md-offset-4">
<div class="login-panel panel panel-default">                  
<div class="panel-heading">
<h3 class="panel-title">INGRESO</h3>
</div>
<div class="panel-body">
<form  autocomplete="Off" method="POST" action="script_acceso_usuario.php"> 
<fieldset>
<div class="form-group">
<input class="form-control" placeholder="usuario" 
 maxlength="8" name="usuario" type="text" autofocus required>
</div>
<div class="form-group">
<input class="form-control" placeholder="contraseña" name="contrasena" 
 maxlength="8" type="password" required>
</div>
<div class="checkbox">
<label>
<input name="remember" type="checkbox" value="Remember Me">Recordar
</label>
</div>
<!-- Change this to a button or input when using this as a form -->
<button class="btn btn-lg btn-success btn-block">INGRESAR</button>
</fieldset>
</form>
</div>
</div>
</div>
</div>
</div>

<!-- Core Scripts - Include with every page -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>
