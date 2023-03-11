<?php
/*  
    ------------------------------------------------
          INFORMACION TECNICA DEL SISTEMA
    ------------------------------------------------
        -> Autor: Daniel Rivera  
            https://github.com/DanielRivera03
    
        -> Sistema gestion de Casos [CRM]
            PHP Puro / MVC
        
        -> Inspirado bajo el software de codigo
            abierto VTiger Real, este sistema no
            tiene ninguna relacion directa con 
            el sistema mencionado previamente

        -> Creditos logo: https://www.vtiger.com/
    ---------------------------------------------------
    COMPARTIDO Y LIBERADO CON FINES ACADEMICOS 
    ---------------------------------------------------   
*/
class Usuarios{
	// VARIABLES DE GESTION
	private $Cedula;
	private $Codigo;
	private $Nombre;
	private $Apellidos;
	private $CorreoElectronico;
	private $Contrasenias;
	private $Estado;
	private $TipoUsuarios;
	private $FotoUsuario;
	
	
	// CORREO ELECTRONICO
	public function setCorreoElectronic($n){
		$this->CorreoElectronico=$n;
	}

	public function getCorreoElectronico(){
		return $this->CorreoElectronico;
	}
	// APELLIDOS
	public function setApellidos($n){
		$this->Apellidos=$n;
	}

	public function getApellidos(){
		return $this->Apellidos;
	}
	// CODIGO
	public function setCodigo($n){
		$this->Codigo=$n;
	}

	public function getCodigo(){
		return $this->Codigo;
	}

	// CEDULA
	public function setCedulaU($n){
		$this->Cedula=$n;
	}
	public function getCedulaU(){
		return $this->Cedula;
	}

	// NOMBRE DE USUARIO
	public function setNombre($n){
		$this->Nombre=$n;
	}

	public function getNombre(){
		return $this->Nombre;
	}

	// CONTRASEÑA
	public function setPass($n){
		$this->Contrasenias=$n;
	}

	public function getPass(){
		return $this->Contrasenias;
	}

	// ESTADO USUARIO
	public function setEstados($n){
		$this->Estado=$n;
	}

	public function getEstados(){
		return $this->Estado;
	}

	// TIPO USUARIO
	public function setTipoUser($n){
		$this->TipoUsuarios=$n;
	}

	public function getTipoUser(){
		return $this->TipoUsuarios;
	}
	// FOTO PERFIL
	public function setFotoUser($n){
		$this->FotoUsuario=$n;
	}

	public function getFotoUser(){
		return $this->FotoUsuario;
	}

	// CONSULTAR TODOS LOS USUARIOS -> ADMINISTRADORES
	public function ConsultarUsuarios($cnn)
	{
		$resultado=mysqli_query($cnn,"call ucemdb.ConsultarUsuarios()");
		return $resultado;
	}

	// CONSULTA ESPECIFICA UN ADMINISTRADOR POR REGISTROS {GESTIONAR USUARIOS ADMINISTRADORES}
	public function ConsultarUnUsuario($cnn,$IdUsuario){
		$resultado=mysqli_query($cnn,"CALL ucemdb.CosultarUsuariosEspecificamente('".$IdUsuario."');");
		$Usuarios=mysqli_fetch_array($resultado);
		$this->setCodigo($Usuarios['Codigo']);
		$this->setCedulaU($Usuarios['Cedula']);
		$this->setNombre($Usuarios['Nombre']);
		$this->setApellidos($Usuarios['Apellidos']);
		$this->setEstados($Usuarios['Estado']);
		$this->setTipoUser($Usuarios['Tipo usuario']);
		$this->setCorreoElectronic($Usuarios['Correo electronico']);
	}

	// INSERTAR NUEVOS USUARIOS ADMINISTRADORES
	public function InsertarUsuarios($cnn,$Cedula,$PassUsuario,$TipoUsuario,$EstadoUsuario,$NombreUsuario,$ApellidosUsuario,$CorreoElectronicoUsuario,$CodigoUsuario)
	{
		$resultado=mysqli_query($cnn,"CALL ucemdb.InsertarUsuarios('".$Cedula."','".$PassUsuario."','".$TipoUsuario."','"
		.$EstadoUsuario."','".$NombreUsuario."','".$ApellidosUsuario."','".$CorreoElectronicoUsuario."','".$CodigoUsuario."');");
		if($resultado)
		{
			include ('../vistas/MensajesUsuarios/RegistroInsertado.html');
		}else
		{
			include ('../vistas/MensajesUsuarios/RegistroNoInsertado.html');
		}	
	}

	// MODIFICAR PERFIL USUARIOS ADMINISTRADORES {SIN FOTO DE PERFIL}
	public function ModificarPerfilUsuarios($cnn,$IdUsuario,$PassUsuario,$CorreoElectronicoUsuario)
	{
		$resultado=mysqli_query($cnn,"call ucemdb.ModificarPerfilUsuarios('".$IdUsuario."','".$PassUsuario."','".$CorreoElectronicoUsuario."');");
		if($resultado)
		{
			include ('../vistas/MensajesUsuarios/RegistroModificadoPerfilAdmins.html');
		}else
		{
			include ('../vistas/MensajesUsuarios/RegistroNoModificadoPerfilAdmins.html');
		}	
	}

	// MODIFICAR PERFIL USUARIOS ADMINISTRADORES {CON FOTO DE PERFIL}
	public function ModificarPerfilUsuariosFotos($cnn,$IdUsuario,$PassUsuario,$CorreoElectronicoUsuario,$FotoUsuario)
	{
		$resultado=mysqli_query($cnn,"call ucemdb.ModificarPerfilUsuariosFotoIncluida('".$IdUsuario."','".$PassUsuario."','".$CorreoElectronicoUsuario."','".$FotoUsuario."');");
		if($resultado)
		{
			include ('../vistas/MensajesUsuarios/RegistroModificadoPerfilAdmins.html');
		}else
		{
			include ('../vistas/MensajesUsuarios/RegistroNoModificadoPerfilAdmins.html');
		}	
	}

	// ELIMINAR USUARIOS ADMINISTRADORES
	public function EliminarAdministradores($cnn,$IdUsuario)
	{
		$resultado=mysqli_query($cnn,"call ucemdb.EliminarUsuarios('".$IdUsuario."');");
		return $resultado;
	}	

	// MODIFICAR USUARIOS ADMINISTRADORES {FOTO DE PERFIL OBLIGATORIA}
	public function ModificarUsuarios($cnn,$IdUsuario,$CedulaUsuario,$CodigoUsuario,$NombreUsuario,$ApellidosUsuario,$CorreoElectronicoUsuario,$TipoUsuario,$EstadoUsuario)
	{
		$resultado=mysqli_query($cnn,"CALL ucemdb.ModificarUsuarios('".$IdUsuario."','".$CedulaUsuario."','".$CodigoUsuario."','".$NombreUsuario."','".$ApellidosUsuario."','".$CorreoElectronicoUsuario."','".$TipoUsuario."','".$EstadoUsuario."');");
		if($resultado)
		{
			include ('../vistas/MensajesUsuarios/RegistroModificadoUsuariosAdmins.html');
		}else
		{
			include ('../vistas/MensajesUsuarios/RegistroNoModificadoUsuariosAdmins.html');
		}	
	}
} // CIERRE DE CLASE USUARIOS ADMIN
?>