<?php
require "../config/conexion.php";
class CapacitacionColaborador
{
        public function __contsructor(){  
    }
     
// método para insertar una capacitacion de un colaborador
    public function insertar($id_cap_col,$id_cap_cap){
        
        $sql ="INSERT INTO tbl_colaborador_capacitacion(id_cap_col,id_cap_cap,id_cap_cap_est)
                Values ('$id_cap_col','$id_cap_cap','A')";
        
        return ejecutarConsulta($sql);
    }
    //mérodo para editar una capacitacion de un colaborador
    
    public function editar($id_capcol,$id_cap_col,$id_cap_cap){
        $sql="UPDATE tbl_colaborador_capacitacion SET id_cap_col='$id_cap_col',id_cap_cap='$id_cap_cap' WHERE id_capcol='$id_capcol'";
		return ejecutarConsulta($sql);
    }
    // método para cambiar de estado de una capacitacion de un colaborador
    
    public function desactivar($id_capcol){
        $sql="UPDATE tbl_colaborador_capacitacion SET id_cap_cap_est='I' WHERE id_capcol='$id_capcol'";
		return ejecutarConsulta($sql);
    }
    
    //implmementa método para acticar estado de una capacitacion de un colaborador
    public function activar($id_capcol){
       $sql="UPDATE tbl_colaborador_capacitacion SET id_cap_cap_est='A' WHERE id_capcol='$id_capcol'";
		return ejecutarConsulta($sql);
    }
    
    // implemetar  método para mostrar una capacitacion de un colaborador
    
    public function mostrar($id_capcol){
        $sql="SELECT * FROM tbl_colaborador_capacitacion WHERE id_capcol='$id_capcol'";
		return ejecutarConsultaSimpleFila($sql);
    }
    
    //Implementar un método para listar una capacitacion de un colaborador
	public function listar()
	{
       $sql="SELECT cc.id_capcol,co.usu_col as colaborador,ca.nom_cap as capacitacion,cc.id_cap_cap_est 
            FROM tbl_colaborador_capacitacion cc 
            INNER JOIN tbl_colaborador co ON cc.id_cap_col=co.id_col 
            INNER JOIN tbl_capacitacion ca ON cc.id_cap_cap=ca.id_cap";
		return ejecutarConsulta($sql);	
	}
          public function eliminar($id_capcol){
         $sql="DELETE FROM tbl_colaborador_capacitacion WHERE id_capcol ='$id_capcol'";
        return ejecutarConsulta($sql);
    }
}