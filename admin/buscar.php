<!DOCTYPE html>
<html>
<?php
	//Conexión a la base de datos
	mysql_connect("localhost", "root", "") 
		or die ("Connection Failed");
	
	mysql_select_db("bienesraices")
		or die("Data Base is not available");
?>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" >
        <title>Busqueda | Terraza</title>
        <link rel="stylesheet" href="../css/normalize.css">
        <!-- <link rel="stylesheet" href="css/stylesheet.css?v=2"> -->
        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="stylesheet" href="css/admin.css">

        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Maven+Pro:400,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Share+Tech' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <?php include('header-admin.php'); ?>
        <?php include('buscador-admin.php'); ?>
    <!-- <form action="buscar.php" method="post" enctype="multipart/form-data">
    <div align="center">
    Búsqueda Por Email
    <input name="email" type="text" id="email" />
    <input name="Enviar" type="submit" id="Enviar" value="Enviar"/></div></form> -->

    <section id="consulta">
    <?php 
        $email = @$_POST['email'];
        $i =0;
        $sql = @mysql_query ("SELECT * FROM noticias WHERE email like '%$email%'");
        
        while($row = mysql_fetch_object($sql)){
        $i++
    ?>  
        <?php if ($i<=6) {  
        ?>
        <article class="item">
            <figure class="imagen_item">
                <a href="../noticia.php?id=<?php echo $row->id;?>"><img src="uploads/<?php echo $row->foto1; ?>" /></a>
            </figure>
            <h2 class="titulo_item">
                <a href="../noticia.php?id=<?php echo $row->id;?>">
                    <?php echo utf8_encode($row->titulo);?>
                </a>
            </h2>

            <div class="estado_item">
                <?php echo utf8_encode($row->autor); ?>
            </div>
            
            <div class="precio_item">
                <?php echo utf8_encode($row->email); ?> 
            </div>
                <?php echo utf8_encode($row->video); ?>
            <div class="datos_item">
                <a href="#" class="tipo"><?php echo utf8_encode ($row->fecha); ?></a>
            </div>
            <div class="datos_persona">
                <a href ="cambiosNoticias.php?&id=<?php echo $row->id; ?>" class="nombre">Modificar</a>
                <a href="borrar.php?id=<?php echo $row->id ?>&tipo=noticia " class="correo">Borrar</a>
                
            </div>

        </article>
        <?php }?>
    <?php } ?>
        

    <!-- casas -->

    
    <?php 
        $email = @$_POST['email'];
        $i =0;
        $sql = @mysql_query ("SELECT * FROM inmuebles WHERE email like '%$email%'");
        
        while($row = mysql_fetch_object($sql)){
        $i++
    ?>  
        <?php if ($i<=6) {  
        ?>
        <article class="item">
            <figure class="imagen_item">
                <a href="../propiedad.php?id=<?php echo $row->id;?>"><img src="uploads/<?php echo $row->foto1; ?>" /></a>
            </figure>
            <h2 class="titulo_item">
                <a href="../propiedad.php?id=<?php echo $row->id;?>">
                    <?php echo utf8_encode ($row->titulo);?>
                </a>
            </h2>

            <div class="estado_item">
                $<?php echo utf8_encode($row->precio); ?> <?php echo utf8_encode ($row->unidad); ?>
            </div>
            
            <div class="precio_item">
                <?php echo utf8_encode ($row->email); ?> 
            </div>
                <?php echo utf8_encode($row->direccion); ?>
            <div class="datos_item">
                <a href="#" class="tipo"><?php echo utf8_encode($row->localidad); ?></a>
            </div>
            <div class="datos_persona">
                <a href ="cambiosInmuebles.php?&id=<?php echo $row->id; ?>" class="nombre">Modificar</a>
                <a href="borrar.php?id=<?php echo $row->id ?>&tipo=casa" class="correo">Borrar</a>
                
            </div>

        </article>
        <?php }?>
    <?php } ?>
        

    </section>



    </body>
</html>
