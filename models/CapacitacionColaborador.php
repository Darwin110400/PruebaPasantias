<?php
require "../config/conexion.php";
class CapacitacionColaborador {
        public function __contsructor()
    {
        
            
    }
    //Implementar un método para listar las capacitaciones
	public function listar()
	{
       $sql="SELECT cc.id_capcol,co.usu_col,ca.nom_cap,cc.id_cap_cap_est 
            FROM tbl_colaborador_capacitacion cc 
            INNER JOIN tbl_colaborador co ON cc.id_cap_col=co.id_col 
            INNER JOIN tbl_capacitacion ca ON cc.id_cap_cap=ca.id_capq";
		return ejecutarConsulta($sql);	
	}
}