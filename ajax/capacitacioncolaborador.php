<?php 
require_once "../models/CapacitacionColaborador.php";

$capacitacioncolaborador = new CapacitacionColaborador();

$id_capcol=isset($_POST["id_capcol"])? limpiarCadena($_POST["id_capcol"]):"";
$id_cap_cap=isset($_POST["id_cap_cap"])? limpiarCadena($_POST["id_cap_cap"]):"";
$id_cap_col=isset($_POST["id_cap_col"])? limpiarCadena($_POST["id_cap_col"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($id_capcol)){
			$rspta=$capacitacioncolaborador->insertar($id_cap_col,$id_cap_cap);
			echo $rspta ? "Capacitacion del Colaborador registrado" : "Capacitacion del Colaborador no se pudo registrar";
		}
		else {
			$rspta=$capacitacioncolaborador->editar($id_capcol,$id_cap_col,$id_cap_cap);
			echo $rspta ? "Capacitacion del Colaborador actualizado" : "Capacitacion del Colaborador no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$capacitacioncolaborador->desactivar($id_capcol);
 		echo $rspta ? "Capacitacion del Colaborador Desactivada" : "Capacitacion del Colaborador no se puede desactivar";
 		break;


	case 'activar':
		$rspta=$capacitacioncolaborador->activar($id_capcol);
 		echo $rspta ? "Capacitacion del Colaboradora activada" : "Capacitacion del Colaborador no se puede activar";
 		break;
	

	case 'mostrar':
		$rspta=$capacitacioncolaborador->mostrar($id_capcol);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
                        	      
        case 'eliminar':
            $rspta = $capacitacioncolaborador->eliminar($id_capcol);
            echo $rspta ? "Capacitacion del Colaborador eliminado": "Capacitacion del Colaborador no eliminado";
            break;


	case 'listar':
		$rspta=$capacitacioncolaborador->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->id_cap_cap_est=="A")?'<button class="btn btn-primary" onclick="mostrar('.$reg->id_capcol.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-success" onclick="desactivar('.$reg->id_capcol.')"><i class="fa fa-toggle-on" title="Desactivar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_capcol.')"><i class="fa fa-close" title="Eliminar"></i></button>':
 					'<button class="btn btn-primary" onclick="mostrar('.$reg->id_capcol.')"><i class="fa fa-pencil" title="Editar"></i></button>'.
 					' <button class="btn btn-warning" onclick="activar('.$reg->id_capcol.')"><i class="fa fa-toggle-off" title="Activar"></i></button>'.
                                        ' <button class="btn btn-danger" onclick="eliminar('.$reg->id_capcol.')"><i class="fa fa-close" title="Eliminar"></i></button>',
                                    "1"=>$reg->colaborador,
                                    "2"=>$reg->capacitacion,
                                    "3"=>($reg->id_cap_cap_est=="A")?'<span class="label bg-green">Activado</span>':
                                    '<span class="label bg-yellow">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
                
            case 'selectColaborador':
            require_once'../models/Colaboradores.php';
            $colaboradores=new Colaboradores();
            $rspta=$colaboradores->select();
            echo '<option selected disabled>-- Selecionar Colaborador --</option>';
            while($reg=$rspta->fetch_object()){
                echo'<option value='.$reg->id_col.'>'.$reg->usu_col.'</option>';
            }  
        break;  
        case 'selectCapacitacion':
            require_once'../models/Capacitacion.php';
            $capacitacion=new Capacitacion();
            $rspta=$capacitacion->select();
            echo '<option selected disabled>-- Selecionar Capacitacion --</option>';
            while($reg=$rspta->fetch_object()){
                echo'<option value='.$reg->id_cap.'>'.$reg->nom_cap.'</option>';
            }  
        break;   
        
}
?>