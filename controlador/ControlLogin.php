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
session_start();
// CONEXION DE SISTEMA CRM -> IMPORTANDO ARCHIVO
require('../modelos/conexion.php');
require('../modelos/mMateriasEstudiantes.php');
$Usuarios = new MateriasEstudiante();
// ACC -> ACCION CONTROLADOR {URL} 
if(isset($_GET['acc']))
{
	$accion=$_GET['acc'];  // ENVIO GET DE VALOR ACCION {URL}
}
else
{
	$accion=1;  // VALOR POR DEFECTO
}
switch ($accion) 
{
    case 1:
		require('../index.php');
    	break;	
    case 2:
    	// VALIDANDO INICIO DE SESION
    	$usuario=$con->login($cnn,$_POST['Usuario'],md5($_POST['Clave']));
		$login=mysqli_fetch_array($usuario);
		if($login)
		{
			// INICIALIZANDO VARIABLES DE SESION
			$_SESSION['vsNombre'] = $login['Nombre']; // NOMBRE
			$_SESSION['vsApellidos'] = $login['Apellidos']; // APELLIDOS
			$_SESSION['vsCarrera'] = $login['Nombre Carrera']; //CARRERA
			$_SESSION['vsCorreoElectronico'] = $login['Correo electronico']; // CORREO ELECTRONICO
			$_SESSION['vsCedula'] = $login['Cedula']; // CEDULA
			$_SESSION['vsTipo'] = $login['Tipo usuario']; // TIPO DE USUARIO {ROL}
			$_SESSION['vsEstado'] = $login['Estado']; // TIPO DE USUARIO {ROL}
			$_SESSION['vsCodigo'] = $login['ID']; // ID
			$_SESSION['vsCodigoUser'] = $login['Codigo']; // CODIGO
			$_SESSION['vsFotosPerfilesUs']=$login['Foto perfil']; // FOTO DE PERFIL 
			if($login['Tipo usuario']=='Administrativo')
			{
				header ('location:../vistas/AdministracionAdmin.php?acc=1');
			}elseif($login['Tipo usuario']== 'Estudiante'){
				//$consulta = $Usuarios->ConsultarMateriasEstudiante($cnn, $_SESSION['vsCedula']);
				header ('location:../vistas/usuarios/PrincipalUsuarios.php?acc=1');	
			}
		}
		else
		{
				header ('location:../vistas/MensajeUsuarios.php');	
		}
    	break;
    	default:
    		header ('location:../vistas/MensajeUsuarios.php');
    	break;	
}
?>