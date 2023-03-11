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
// CARGANDO MODELO DE USUARIOS ADMINISTRADORES
require('../modelos/mUsuariosAdministradores.php');
$Usuarios=new Usuarios();
// ACC -> ACCION CONTROLADOR {URL} 
if(isset($_GET['acc']))
{
	$accion=$_GET['acc']; // ENVIO GET DE VALOR ACCION {URL}
}
else
{
	$accion=1; // VALOR POR DEFECTO
    
}
switch ($accion) 
{
    // CONSULTAR USUARIOS
    case 1:
        if($_SESSION['vsTipo']== 'Administrativo'){
		  $consulta=$Usuarios->ConsultarUsuarios($cnn);
		  require('../vistas/BusquedaAvanzadaUsuariosAdmin.php');
        }else if($_SESSION['vsTipo']== 2){
            header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // REGISTRAR USUARIOS {FORMULARIO DE REGISTRO}    
    case 2: 
        if($_SESSION['vsTipo']== 'Administrativo'){
		  require('../vistas/RegistroAdministradores.php'); 
        }else if($_SESSION['vsTipo']== 'Estudiante'){
            header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;  
    // REGISTRAR NUEVOS USUARIOS -> ENVIO A BASE DE DATOS     	
    case 3: 
        if($_SESSION['vsTipo'] == 'Administrativo'){
        	$CedulaUsuario=$_POST['cedulaUser']; // CEDULA USUARIO
        	$PassUsuario=md5($_POST['passUser']); // CONTRASEÑA USUARIO
        	$EstadoUsuario=$_POST['estadoUser']; // ESTADO USUARIO
        	$TipoUsuario=$_POST['tipoUser']; // TIPO DE USUARIO
            $NombreUsuario=$_POST['nombreUser'];
            $ApellidosUsuario=$_POST['apellidosUser'];
            $CorreoElectronicoUsuario=$_POST['correoElectronicoUser'];
            $CodigoUsuario=$_POST['codigoUser'];
        	// SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($CedulaUsuario || $PassUsuario || $TipoUsuario || $EstadoUsuario || $NombreUsuario || $ApellidosUsuario || $CorreoElectronicoUsuario || $CodigoUsuario )){
                header('location:../controlador/cUsuariosAdministradores.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
    		  $consulta=$Usuarios->InsertarUsuarios($cnn,$CedulaUsuario,$PassUsuario,$TipoUsuario,$EstadoUsuario,$NombreUsuario,$ApellidosUsuario,$CorreoElectronicoUsuario,$CodigoUsuario); 
            }
        }else if($_SESSION['vsTipo'] == 2){
           header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1'); 
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    	break;
    // GESTIONAR USUARIOS    
    case 4:
        if($_SESSION['vsTipo']== 'Administrativo'){ 
            $consulta=$Usuarios->ConsultarUsuarios($cnn);
            require('../vistas/GestionarUsuariosAdmin.php'); 
        }else if($_SESSION['vsTipo']== 2){
            header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // EXPORTAR USUARIOS     
    case 5: 
        if($_SESSION['vsTipo']=="Administrativo"){
            $consulta=$Usuarios->ConsultarUsuarios($cnn);
            require('../vistas/ExportarUsuariosAdmin.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
        break; 
    // REGRESAR AL INICIO DE LA APLICACION    
    case 6: 
        if($_SESSION['vsTipo']=="Administrativo"){
            require('../vistas/AdministracionAdmin.php'); 
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
        break;
    // PERFIL DE USUARIO      
    case 7:
        if($_SESSION['vsTipo']=="Administrativo"){
            $consulta=$Usuarios->ConsultarUsuarios($cnn);
            require ('../vistas/PerfilUsuario.php');
        }else if($_SESSION['vsTipo']=="Estudiante"){
            $consulta=$Usuarios->ConsultarUsuarios($cnn);
            require ('../vistas/usuarios/PerfilEstudiantes.php');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // CIERRE DE SESION
    case 8:
        if($_SESSION['vsTipo']=="Administrativo"){
            header('location: ../vistas/Logout.php');
        }else if($_SESSION['vsTipo']=="Estudiante"){
            header('location: ../vistas/Logout.php');
        }else{
            header ('location:../vistas/index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;  
    // MODIFICAR PERFIL DE USUARIO ADMINISTRADORES
    case 9:
        if($_SESSION['vsTipo']== 'Administrativo'){
            $IdUsuario=$_POST['IdUser']; // ID USUARIO
            $CorreoElectronicoUsuario=$_POST['CorreoUser']; // CORREO ELECTRONICO
            $PassUsuario=$_POST['PassUser']; // CONTRASEÑA USUARIO
            $ConfirPassUser=$_POST['ConfirPassUser']; // CONTRASEÑA USUARIO
            $FotoUsuario=$_FILES['FotoPerfilUsuarios']['name']; // FOTO DE PERFIL
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($PassUsuario || $ConfirPassUser )){
                    header('location:../controlador/cUsuariosAdministradores.php?acc=7');
            }elseif(empty($CorreoElectronicoUsuario)){
                header('location:../controlador/cUsuariosAdministradores.php?acc=7');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                if(empty($FotoUsuario)){
                    if($PassUsuario == $ConfirPassUser){
                        // SI USUARIO NO INGRESA FOTO NUEVA, LLAMA SP NORMAL SIN ENVIO DE FOTO
                        $consulta=$Usuarios->ModificarPerfilUsuarios($cnn,$IdUsuario,md5($PassUsuario),$CorreoElectronicoUsuario);
                    }else{
                        header('location:../vistas/MensajesUsuarios/RegistroNoModificadoPerfilAdmins.html');
                    }
                    
                }else{// CASO CONTRARIO, LLAMA SP PERSONALIZADO CON ENVIO DE FOTO
                    // NOMBRE DE FOTO A SUBIR
                    $FotoUsuario=$_FILES['FotoPerfilUsuarios']['name'];
                    $destino='../vistas/dist/fotosperfiles/'.$FotoUsuario;
                    $typ=$_FILES['FotoPerfilUsuarios']['type']; // EXTENSION ARCHIVO
                    $consulta=$Usuarios->ModificarPerfilUsuariosFotos($cnn,$IdUsuario,md5($PassUsuario),$CorreoElectronicoUsuario,$FotoUsuario);
                    copy($_FILES['FotoPerfilUsuarios']['tmp_name'],$destino);
                    // ACTUALIZAR VARIABLE DE SESION CON NUEVA FOTO DE PERFIL INSERTADA
                    $_SESSION['vsFotosPerfilesUs']=$FotoUsuario;
                }
            }// CIERRE if(empty($FotoUsuarioAdmins))
        }else if($_SESSION['vsTipo']=="Estudiante"){
            $IdUsuario=$_POST['IdUser']; // ID USUARIO
            $CorreoElectronicoUsuario=$_POST['CorreoUser']; // CORREO ELECTRONICO
            $PassUsuario=md5($_POST['PassUser']); // CONTRASEÑA USUARIO
            $ConfirPassUser=md5($_POST['ConfirPassUser']); // CONTRASEÑA USUARIO
            $FotoUsuario=$_FILES['FotoPerfilUsuarios']['name']; // FOTO DE PERFIL
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($PassUsuario || $ConfirPassUser )){
                    header('location:../controlador/cUsuariosAdministradores.php?acc=7');
            }elseif(empty($CorreoElectronicoUsuario)){
                header('location:../controlador/cUsuariosAdministradores.php?acc=7');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                if(empty($FotoUsuario)){
                    if($PassUsuario == $ConfirPassUser){
                        // SI USUARIO NO INGRESA FOTO NUEVA, LLAMA SP NORMAL SIN ENVIO DE FOTO
                        $consulta=$Usuarios->ModificarPerfilUsuarios($cnn,$IdUsuario,md5($PassUsuario),$CorreoElectronicoUsuario);
                    }else{
                        header('location:../vistas/MensajesUsuarios/RegistroNoModificadoPerfilAdmins.html');
                    }
                    
                }else{// CASO CONTRARIO, LLAMA SP PERSONALIZADO CON ENVIO DE FOTO
                    // NOMBRE DE FOTO A SUBIR
                    $FotoUsuario=$_FILES['FotoPerfilUsuarios']['name'];
                    $destino='../vistas/dist/fotosperfiles/'.$FotoUsuario;
                    $typ=$_FILES['FotoPerfilUsuarios']['type']; // EXTENSION ARCHIVO
                    $consulta=$Usuarios->ModificarPerfilUsuariosFotos($cnn,$IdUsuario,md5($PassUsuario),$CorreoElectronicoUsuario,$FotoUsuario);
                    copy($_FILES['FotoPerfilUsuarios']['tmp_name'],$destino);
                    // ACTUALIZAR VARIABLE DE SESION CON NUEVA FOTO DE PERFIL INSERTADA
                    $_SESSION['vsFotosPerfilesUs']=$FotoUsuario;
                }
            }
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break; 
    // ELIMINAR USUARIOS ADMINISTRADORES
    case 10:
        if($_SESSION['vsTipo']=="Administrativo"){
            $IdUsuario=$_GET['cod'];
            $consulta=$Usuarios->EliminarAdministradores($cnn,$IdUsuario);
            header('location:cUsuariosAdministradores.php?acc=4');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;  
    // MODIFICAR USUARIOS ADMINISTRADORES {FORMULARIO}
    case 11:
        if($_SESSION['vsTipo']== 'Administrativo'){
            $IdUsuario=$_GET['cod'];
            $consulta=$Usuarios->ConsultarUnUsuario($cnn,$IdUsuario);
            require('../vistas/ModificarAdministradores.php');
        }else if($_SESSION['vsTipo']== 2 ){
            header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;
    // MODIFICAR USUARIOS ADMINISTRADORES -> ENVIO A BASE DE DATOS
    case 12:
        if($_SESSION['vsTipo']== 'Administrativo' ){   
            $IdUsuario=$_POST['IdUser'];
            $CedulaUsuario=$_POST['CedulaUser']; // NOMBRE DE USUARIO
            $CodigoUsuario=$_POST['CodigoUser']; // CODIGO DE USUARIO
            $CorreoElectronicoUsuario=$_POST['CorreoUser']; // CORREO ELETRONICO DE USUARIO
            $NombreUsuario=$_POST['NombreUser']; // NOMBRE DE USUARIO
            $ApellidosUsuario=$_POST['ApellidosUser']; // APELLIDOS DE USUARIO
            $EstadoUsuario=$_POST['EstadoUser']; // ESTADO DE USUARIO
            $TipoUsuario=$_POST['TipoUser']; // TIPO DE USUARIO
            // SI USUARIO INTENTA ACCEDER A LA ACCION CON VARIABLES VACIAS, ENTONCES...
            if(empty($IdUsuario || $CedulaUsuario || $CodigoUsuario || $NombreUsuario || $ApellidosUsuario || $CorreoElectronicoUsuario || $TipoUsuario || $EstadoUsuario)){
                header('location:../controlador/cUsuariosAdministradores.php?acc=4');
            }else{
                // CASO CONTRARIO, INGRESA ACCION A BASE DE DATOS
                $consulta=$Usuarios->ModificarUsuarios($cnn,$IdUsuario,$CedulaUsuario,$CodigoUsuario,$NombreUsuario,$ApellidosUsuario,$CorreoElectronicoUsuario,$TipoUsuario,$EstadoUsuario); 
            }
        }else if($_SESSION['vsTipo']== 2 ){
           header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1'); 
        }else{
            header ('location:../index.php');
        }
        $cnn->close(); // CERRANDO CONEXION
    break;          
    default:
        if($_SESSION['vsTipo']== 'Administrativo'){ 
    	   require ('../vistas/MensajesUsuarios/404.shtml');
        }else if($_SESSION['vsTipo']=="Usuario"){
            header ('location:../vistas/Empleados/PrincipalEmpleados.php?acc=1');
        }else{
            header ('location:../index.php');
        }
    break;
}
?>