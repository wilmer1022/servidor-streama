<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>NRamos Consumo REST</title>
</head>

<body>
<p><h1>Interfaz de prueba de consumo de Servicio WEB</h1></p>
<p><h2>Parcial Final <br/>Servicios Telemáticos<br/>Nathalia Ramos - Wilmer D. Guarín</h2></p>
<p><h3>Prueba de GET -&gt; <a href="index.php?get=1"> Clic Aquí</a></h3></p>
<form id="post" name="post" method="post" action="classLibro.php?post=1" enctype="multipart/form-data">
<p><h3>Prueba POST </h3> Titulo: <input type="text" name="titulo" /> <br />Autor: <input type="text" name="autor" /><br />Descripcion: <input type="text" name="descripcion" /> 
<br />
<input type="submit" name="Guardar" value="Guardar" />

</p>
</form>
<p>&nbsp;</p>
<?php 


 if(isset($_GET["get"])){   $get = $_REQUEST['get'];}else{$get= 0;}

	if ($get==1){
		echo "<p><h3>Prueba de DELETE y PUT</h3></p>";
		include ('classLibro.php');
		$libros = getLibros();
		$i=0;
		$resultado="<table border='1'><tr><th>ID</th><th>Titulo</th><th>Autor</th><th>Descripcion</th></tr>";
		foreach ( $libros as $array => $libro ) {
			$numLibro=$i+1;
			$i++;
			$resultado.= "<form id='post' name='put'".$libro['id']." method='post' action='classLibro.php?put=1' enctype='multipart/form-data'><tr><td><input type='hidden' name='id' value='".$libro['id']."' />".$libro['id']."</td><td><input type='text' name='titulo' value='".$libro['titulo']."'/></td><td><input type='text' name='autor' value='".$libro['autor']."'/></td><td><input type='text' name='descripcion' value='".$libro['descripcion']."'/></td><td><a href='classLibro.php?delete=1&id=".$libro['id']."'> DELETE </a></td><td><input type='submit' name='Guardar' value='PUT' /></td></tr></form>";
		}
		echo $resultado."</table>";
		?>
        
        <p><a href="index.php">Limpiar resultados</a></p>
        <?php
		}
?>

</body>
</html>
