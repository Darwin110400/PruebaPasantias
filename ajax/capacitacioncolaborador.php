<?php 
require_once "../models/CapacitacionColaborador.php";

$capacitacioncolaborador = new CapacitacionColaborador();

$id_capcol=isset($_POST["id_capcol"])? limpiarCadena($_POST["id_capcol"]):"";
$usu_cap=isset($_POST["usu_cap"])? limpiarCadena($_POST["usu_cap"]):"";
$nom_cap=isset($_POST["nom_cap"])? limpiarCadena($_POST["nom_cap"]):"";
switch ($_GET["op"]){
    case 'listar':
		$rspta=$capacitacioncolaborador->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->id_cap_cap_est=="A")?'<button class="btn btn-success" onclick="desactivar('.$reg->id_capcol.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>':
 					'<button class="btn btn-warning" onclick="activar('.$reg->id_capcol.')"><i class="fa fa-toggle-off" title="Activar"></i></button>',  
                                    "1"=>$reg->usu_col,
                                    "2"=>$reg->nom_cap,
                                    "3"=>($reg->id_cap_cap_est=="A")?'<span class="label bg-green">Activado</span>':
                                    '<span class="label bg-yellow">Desactivado</span>',
                                    '<span class="label bg-blue">En Proceso</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
break;

}

?>

}