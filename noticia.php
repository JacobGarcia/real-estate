<!doctype html>
<html lang="en">
<head>
	<?php $i=1; include('conexion.php'); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" >
	<title>Noticia | Terraza </title>
	<!--start estilos generales -->
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/estilos.css">
	<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Share+Tech' rel='stylesheet' type='text/css'>
	<!-- end estilos generales -->

	<!-- start jquery -->
	
	<!-- Important Owl stylesheet -->
	<link rel="stylesheet" href="css/owl.carousel.css">
	 
	<!-- Default Theme -->
	<link rel="stylesheet" href="css/owl.theme.css">
	 
	<!--  jQuery 1.7+  -->
	<script src="js/jquery-1.9.1.min.js"></script>
	 
	<!-- Include js plugin -->
	<script src="js/owl.carousel.js"></script>
  	<!-- end jquery -->

	<!-- inicializar el slider -->

  	<script>

  		$(document).ready(function() {
 
	  		$("#owl-demo").owlCarousel({
	 
		      autoPlay: 3000, //Set AutoPlay to 3 seconds
		 
		      items : 4,
		      itemsDesktop : [1199,3],
		      itemsDesktopSmall : [979,3]
 
 			});
 
		});
  	</script>

  <!-- terminar inicializar slider -->

</head>
<body>
	<!-- start header -->
	<?php include('header.php'); ?>
	<!-- end header -->
	<!-- start buscador -->
	<?php include('buscador.php'); ?>
	<!-- end buscador -->
	<?php 
	$id = @$_GET['id']; //Obtener id de la casa
	if ($id == "" || $id == NULL) {
		?>
		
		<div class="message_error">
			¿Estás buscando una noticia?, consúltalas en <a href="noticias.php">noticias</a>
		</div>
	<?php }
	else
	{
		$sql = @mysql_query("SELECT * FROM noticias WHERE id = '$id'");
		while($row = mysql_fetch_object($sql)){
	?>
	<!-- start slider -->
	<div id="owl-demo">
      <?php mysql_query("SET NAMES utf8");?>
	  <div class="item"><a href="noticia.php?id=<?php echo $row->id;?>"><img src="admin/uploads/<?php echo $row->foto1;?>" alt=""></a></div>
	  <div class="item"><a href="noticia.php?id=<?php echo $row->id;?>"><img src="admin/uploads/<?php echo $row->foto2;?>" alt=""></a></div>
	  <div class="item"><a href="noticia.php?id=<?php echo $row->id;?>"><img src="admin/uploads/<?php echo $row->foto3;?>" alt=""></a></div>

	</div>
	<!-- end slider -->
	
	<!-- start descripcion -->
	<div id="contenido">
		<div class="descripcion">
			<div class="caracteristicas">
			<?php mysql_query("SET NAMES utf8");?>
				<?php echo utf8_encode ($row->fecha);?>
			</div>
			<h2 class="titulo_descripcion">
				<?php echo utf8_encode ($row->titulo);?>
			</h2>
			
			<div class="contenido_descripcion">
				<?php  echo utf8_encode ($row->noticia);?>
			</div>
			<iframe title="YouTube video player" class="youtube-player" type="text/html" 
				width="98%" height="320" src="//www.youtube.com/embed/<?php echo $row->video;?>" frameborder="0" allowfullscreen>
			</iframe>
			<div class="datos_persona">
				<a href="#" class="autor"><?php echo utf8_encode ($row->autor);?></a>
				<a href="#" class="correo"><?php echo utf8_encode ($row->email);?></a>
			</div>
		</div>
	</div>
	<!-- end descripcion -->
	<?php } } ?>

<!-- start recientes -->
	
	<section id="contenido">
	<?php 
  	$c = @$_POST['buscar'];
  	$sql = @mysql_query("SELECT * FROM noticias order by id desc");
  	
	while ($row = mysql_fetch_object($sql))
	{  
		$i++
	?>	
		<?php if ($i<=6) {	
		?>
		<article class="item">
			<figure class="imagen_item">
				<a href="noticia.php?id=<?php echo $row->id;?>"><img src="admin/uploads/<?php echo $row->foto1;?>" /></a>
			</figure>
			<h2 class="titulo_item">
				<a href="noticia.php?id=<?php echo $row->id;?>">
					<?php echo $row->titulo;?>
				</a>
			</h2>

			<div class="estado_item">
				<?php echo $row->fecha;?>
			</div>

		</article>
		<?php }?>
	<?php } ?>
	<!-- end similares -->
</section>

	<!-- start footer -->
	<?php include('footer.php'); ?>
	<!-- end footer -->
		
</body>
</html>
