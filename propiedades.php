<!doctype html>
	<html>
 	<?php
 			//Conectar a la base de datos
 			include 'conexion.php'; 
 			mysql_connect("localhost", "root", "") or die ("No hay nada");
 			mysql_select_db("bienesraices") or die ("No hay base");
 	 ?>
	<head>
 		<meta charset="utf-8">
 		<meta name="description" content="El hogar de los inmuebles">
 		<title>Pulse | Inmuebles</title>
 		<link rel="stylesheet" href="css/normalize.css">
 		<link rel="stylesheet" href="css/estilos.css">
 		<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,900' rel='stylesheet' type='text/css'>
	</head>
 	
	<body>
 		<!-- header -->
 		<?php include ('header.php'); ?>
 		<!-- buscador -->
 		<?php include ('buscador.php'); ?>


	<h1> Catálogo De Propiedades </h1>
	<section id="contenido">
		<?php 
  		$sql = @mysql_query("SELECT * FROM inmuebles");
		while ($row = mysql_fetch_object($sql))

		{
		?>
		<article class="item">
			<figure class="imagen_item">
				<img src="images/inmuebles/<?php echo $row->foto1; ?>">
			</figure>
			<h2 class="titulo_item">
				<a href="#">
					<?php echo $row->titulo;?>
				</a>
			</h2>

			<div class="estado_item">
				<?php echo $row->localidad;?>
			</div>
			
			<div class="precio_item">
				$ <?php echo $row->precio;?> MXN
			</div>

			<div class="datos_item">
				<a href="#" class="tipo"><?php echo $row->tipo;?></a>
			</div>

		</article> 		
<?php 	} ?>
<footer>
		<p>
			<strong>Pulse 2014</strong>
		</p>
</footer>
</body>
</html>