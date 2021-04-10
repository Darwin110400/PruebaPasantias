    <?php
require "../config/Conexion.php";
class Colaboradores {
     public function __construct() {
        
    }
    public function insertar($usu_col,$pass_col,$id_per_col)
	{
		$sql="INSERT INTO tbl_colaborador (usu_col,pass_col,id_per_col)
		VALUES ('$usu_col','$pass_col','$id_per_col','A')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($id_col,$usu_col,$pass_col,$id_per_col)
	{
		$sql="UPDATE tbl_colaborador SET usu_col='$usu_col',pass_col='$pass_col',id_per_col='$id_per_col' WHERE id_col='$id_col'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($id_col)
	{
		$sql="UPDATE tbl_colaborador SET est_col='I' WHERE id_col='$id_col'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($id_col)
	{
		$sql="UPDATE tbl_colaborador SET est_col='A' WHERE id_col='$id_col'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_col)
	{
		$sql="SELECT * FROM tbl_colaborador WHERE id_col='$id_col'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tbl_colaborador";
		return ejecutarConsulta($sql);		
	}
       public function verificar($login,$clave)
    {
        $sql="SELECT id_col,usu_col,pass_col,id_per_col,est_col,id_cap_col FROM tbl_colaborador WHERE usu_col='$login' AND pass_col='$clave' AND est_col='A'";  	
        return ejecutarConsulta($sql);  
    }
}
