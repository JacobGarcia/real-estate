<?php include "conexion.php"; ?>
<!DOCTYPE HTML>
<html>
	<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="UTF-8" />
		<title>Dynasty | Publicar</title>
        
   <!-- Change Div Function -->
		<script>
			$(document).ready(function(){
			  $("#inmueble").click(function(){
			    $("#div1").load("alta.php");
			  });
			});

			$(document).ready(function(){
			  $("#noticias").click(function(){
			    $("#div1").load("altaNoticia.php");
			  });
			});
		</script>
        
		<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>

    <!-- Our CSS stylesheet file for DropFile-->
    <link rel="stylesheet" href="assets/css/styles.css?v=1" />

		<script type="text/javascript">
		tinymce.init({
		    selector: "textarea"
		 });
		</script>

    <!-- General CSS File-->
    <link rel="stylesheet" href="css/stylesheet.css?v=2">
   
	</head>
<form action="altaNoticia.php" method="post" enctype="multipart/form-data" name="formulario"  encccept-charset="UTF-8" >

  <label>Título de la Noticia</label>
  <input type="text" name="titulo" placeholder="Microsoft compra un nuevo edificio en Querétaro" size="30" maxlength="70" required>

  <label>Fecha de la Noticia</label>
  <input type = "date" name = "fecha" size = "20" maxlength = "50" required pattern="[0-9]{2}[/]{1}[0-9]{2}[/]{1}[0-9]{4}" placeholder="DD/MM/YYYY" title="DD/MM/YYYY (No olvides los guiones)">

<script>
function content() {
  var contenido = tinyMCE.get("noticia").getContent();
    alert(contenido);
   document.getElementById("area").value = contenido;
}
</script>

 <br>
    <label>Noticia</label><br>
    <textarea name="noticia" style="width:100%; height:240px" id="noticia"></textarea>
    

  <br><label>Fotografías</label>
    <div id="dropbox" name="drop">
            <span class="message">Arrastra aquí las fotografías de tu propiedad<br /><i>(sólo puedes subir 3 fotos como máximo)</i></span>
    </div>

    <label>Liga a video de YouTube</label>
    <input type="url" name="video" size="30" maxlength="100" required placeholder="https://www.youtube.com/watch?v=lxgelwqe8-E">

        <!-- Including The jQuery Library -->
    <script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
    
    <!-- Including the HTML5 Uploader plugin -->
    <script src="assets/js/jquery.filedrop.js"></script>
    
    <!-- The main script file -->
    <script>
    $(function(){
  
  var dropbox = $('#dropbox'),
    message = $('.message', dropbox);
    maxarchivos = 1;
  
  dropbox.filedrop({
    // The name of the $_FILES entry:
    paramname:'pic',
    
    maxfiles: 3,
      maxfilesize: 1,
    url: 'post_file.php',
    
    uploadFinished:function(i,file,response){
      $.data(file).addClass('done');
      // response is the JSON object that post_file.php returns
    },
    
      error: function(err, file) {
      switch(err) {
        case 'BrowserNotSupported':
          showMessage('Tu navegador web no soporta subidas de archivos basadas en HTML5!');
          break;
        case 'TooManyFiles':
          alert('Sólo puedes insertar máximo 3 fotos a la vez.');
          break;
        case 'FileTooLarge':
          alert(file.name+' es demasiado grande. Por favor sube archivos de máximo 50MB.');
          break;
        default:
          break;
      }
    },
    
    // Called before each upload is started
    beforeEach: function(file){
      if(!file.type.match(/^image\//)){
        alert('Únicamente puedes subir imágenes.');
        
        // Returning false will cause the
        // file to be rejected
        return false;
      }
    },
    
    uploadStarted:function(i, file, len){
      if(maxarchivos <= 3){
        createImage(file);
        maxarchivos++;
      }
      else
        alert("Máximo 3 fotos.");
    },
    
    progressUpdated: function(i, file, progress) {
      $.data(file).find('.progress').width(progress);
    }
       
  });

  var template = '<div class="preview">'+
            '<span class="imageHolder">'+
              '<img />'+
              '<span class="uploaded"></span>'+
            '</span>'+
            '<div class="progressHolder">'+
              '<div class="progress"></div>'+
            '</div>'+
          '</div>'; 
  
  
  function createImage(file){

    var preview = $(template), 
      image = $('img', preview);
      
    var reader = new FileReader();
    
    image.width = 100;
    image.height = 100;
    
    reader.onload = function(e){
      
      // e.target.result holds the DataURL which
      // can be used as a source of the image:
      
      image.attr('src',e.target.result);
      if(maxarchivos == 2)
        document.getElementById("foto1").value = file.name;
      if(maxarchivos == 3)
        document.getElementById("foto2").value = file.name;
      if(maxarchivos == 4)
        document.getElementById("foto3").value = file.name;
    };
    
    // Reading the file as a DataURL. When finished,
    // this will trigger the onload function above:
    reader.readAsDataURL(file);
    
    message.hide();
    preview.appendTo(dropbox);
    
    // Associating a preview container
    // with the file, using jQuery's $.data():
    
    $.data(file,preview);
  }

  function showMessage(msg){
    message.html(msg);
  }
});

</script>

  <input type="submit" value="Publicar" id="enviar" name="enviar" onclick="content()" /> 
  <input type="text" name="area" id="area" />
  <input type="text" name="foto1" id="foto1"/>
  <input type="text" name="foto2" id="foto2"/>
   <input type="text" name="foto3" id="foto3" />
  </form>
  
 <?php
//Inserción de Datos
if(isset($_POST['enviar'])){
  $id = 0;
  echo $titulo  = $_POST['titulo'];
	echo $fecha = $_POST['fecha'];
  echo $noticia  = $_POST['area'];
  echo $foto1  = $_POST['foto1'];
  echo $foto2  = $_POST['foto2'];
  echo $foto3  = $_POST['foto3'];
	echo $video  = $_POST['video'];

	mysql_query("INSERT INTO noticias VALUES('$id', '$titulo', '$fecha', '$noticia', '$foto1', '$foto2', '$foto3', '$video')");
?>
<p>Datos Insertados</p>
<?php } ?>

</html>