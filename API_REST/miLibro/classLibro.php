<?php

require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;
	

function getLibros()
{
return json_decode(file_get_contents('http://localhost/libros/'),true);;
}

function deleteLibro($id)
{
$result = file_get_contents('http://localhost/libros/?id='.$id,false,stream_context_create(array('http' => array('method' => 'DELETE' ))));
echo "<SCRIPT LANGUAGE=\"JavaScript\">";
				echo "alert('Libro eliminado exitosamente');";
				echo "location.href=\"index.php?get=1\";";
				echo "</SCRIPT>";
}

function addLibro($titulo, $autor, $descripcion)
{
	
	
	
	
$client = new Client([
    'base_uri' => 'http://localhost/libros/',
    'timeout'  => 5.0,
]);


// =============================================
//Hago la llamada al servicio rest, para insertar un libro
$libro = ['titulo'=>$titulo,
             'autor'=>$autor,
             'descripcion'=>$descripcion
            ];
			
$res = $client->request('POST', '', ['form_params' => $libro]);
if ($res->getStatusCode() == '200') //Verifico que me retorne 200 = OK
{
  echo "<SCRIPT LANGUAGE=\"JavaScript\">";
				echo "alert('Se inserta nuevo libro');";
				echo "location.href=\"index.php?get=1\";";
				echo "</SCRIPT>";
}else{
	
	echo "<SCRIPT LANGUAGE=\"JavaScript\">";
				echo "alert('Error al consumir el servicio POST');";
				echo "location.href=\"index.php?get=1\";";
				echo "</SCRIPT>";
	}

// =============================================

}

function editLibro($id, $titulo, $autor, $descripcion)
{
	
	
$client = new Client([
    'base_uri' => 'http://localhost/libros/',
    'timeout'  => 5.0,
]);

	
	//Actualizar un libro usando PUT
$actualizar = ['titulo'=>$titulo,
             'autor'=>$autor,
             'descripcion'=>$descripcion,
			 'id'=>$id
            ];
	

$res = $client->request('PUT',null,[
    'query' => $actualizar
]);
if ($res->getStatusCode() == '200') //Verifico que me retorne 200 = OK
{
  echo "<SCRIPT LANGUAGE=\"JavaScript\">";
				echo "alert('Se actualiza libro');";
				echo "location.href=\"index.php?get=1\";";
				echo "</SCRIPT>";
}else{
	
	echo "<SCRIPT LANGUAGE=\"JavaScript\">";
				echo "alert('Error al consumir el servicio PUT');";
				echo "location.href=\"index.php?get=1\";";
				echo "</SCRIPT>";
	
}

}



if(isset($_GET["post"])){   $post = $_REQUEST['post'];}else{$post= 0;}

if($post==1){
	if(isset($_POST["titulo"])){     $titulo  = $_REQUEST['titulo'];}else{$titulo=0;}
	if(isset($_POST["autor"])){     $autor  = $_REQUEST['autor'];}else{$autor=0;}
	if(isset($_POST["descripcion"])){     $descripcion  = $_REQUEST['descripcion'];}else{$descripcion=0;}
	addLibro($titulo,$autor,$descripcion);
	}
	
	

if(isset($_GET["put"])){   $put = $_REQUEST['put'];}else{$put= 0;}

if($put==1){
	
	if(isset($_POST["id"])){     $id  = $_REQUEST['id'];}else{$id=0;}
	if(isset($_POST["titulo"])){     $titulo  = $_REQUEST['titulo'];}else{$titulo=0;}
	if(isset($_POST["autor"])){     $autor  = $_REQUEST['autor'];}else{$autor=0;}
	if(isset($_POST["descripcion"])){     $descripcion  = $_REQUEST['descripcion'];}else{$descripcion=0;}
	editLibro($id, $titulo,$autor,$descripcion);
	}	
	

if(isset($_GET["delete"])){   $delete = $_REQUEST['delete'];}else{$delete= 0;}

if($delete==1){
	if(isset($_GET["id"])){   $id = $_REQUEST['id'];}else{$id= -1;}
	if($id!=-1){
		deleteLibro($id);
		}
	}


?>