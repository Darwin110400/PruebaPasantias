<?php
session_start();
require_once "../models/Colaboradores.php";

$colaboradores=new Colaboradores();

$id_col=isset($_POST["id_col"])? limpiarCadena($_POST["id_col"]):"";
$usu_col=isset($_POST["usu_col"])? limpiarCadena($_POST["usu_col"]):"";
$pass_col=isset($_POST["pass_col"])? limpiarCadena($_POST["pass_col"]):"";
$id_per_col=isset($_POST["id_per_col"])? limpiarCadena($_POST["id_per_col"]):"";
switch ($_GET["op"]){
    case 'guardaryeditar':

		if (empty($id_col)){
			$rspta=$colaboradores->insertar($usu_col,$pass_col,$id_per_col);
			echo $rspta ? "Colaborador registrado" : "No se pudo registrar el Colaborador";
		}
		else {
			$rspta=$colaboradores->editar($id_col,$usu_col,$pass_col,$id_per_col);
			echo $rspta ? "Colaborador actualizado" : "Colaborador no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$colaboradores->desactivar($id_col);
 		echo $rspta ? "Colaborador Desactivado" : "Colaborador no se puede desactivar";
	break;

	case 'activar':
		$rspta=$colaboradores->activar($id_col);
 		echo $rspta ? "Colaborador activado" : "Colaborador no se puede activar";
	break;

	case 'mostrar':
		$rspta=$colaboradores->mostrar($id_col);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$colaboradores->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->est_col=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_col.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_col.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_col.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_col.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_col.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_col.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                        
 				"1"=>$reg->usu_col,
 				"2"=>$reg->id_per_col,
 				"3"=>($reg->est_col=="A")?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
     break;
     case 'verificar':
            $logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];
		$rspta=$colaboradores->verificar($logina, $clavea);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['id_col']=$fetch->id_col;
	        $_SESSION['usu_col']=$fetch->usu_col;    
                $_SESSION['id_per_col']=$fetch->id_per_col;       
        }
          echo json_encode($fetch);
        break;
        case 'salir':
        //Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
    header("Location: ../index.php");

	break;
}
?>