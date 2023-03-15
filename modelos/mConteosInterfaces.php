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
	// IMPORTANDO ARCHIVO DE CONEXION
	require 'conexion.php';
	/*
		--> VALIDO INDEX -> USUARIOS ADMINISTRADORES ESTRICTAMENTE
	*/
	// CONTEO USUARIOS REGISTRADOS
	function NumeroUsuariosRegistrados($cnn1){
		$resultado=mysqli_query($cnn1,"call ucemdb.ConsultarUsuarios();");
		if(mysqli_num_rows($resultado)>0){
			$ImpresionConteo=mysqli_num_rows($resultado);

			return $ImpresionConteo;
		}else{
			$ImpresionConteo = 0;
		}
	}
	// CONTEO MATERIAS MATRICULADAS ESTUDIANTES
	function NumeroCursosMatriculadosEstudiante($cnn2,$CedulaUser){
		$resultado=mysqli_query($cnn2,"call ucemdb.ConsultarCartaEstudiante('".$CedulaUser."');");
		if(mysqli_num_rows($resultado)>0){
			$NumeroMatriculadosEstudiante=mysqli_num_rows($resultado);	
			echo json_encode($NumeroMatriculadosEstudiante);
		}else{
			$NumeroMatriculadosEstudiante = 0;
		}
	}
	// CONTEO MATERIAS GANADAS ESTUDIANTES
	function NumeroCursosPendientesEstudiante($cnn3,$CedulaUser){
		$resultado=mysqli_query($cnn3,"CALL ConsultasPendientesEstudiante('".$CedulaUser."');");
		if(mysqli_num_rows($resultado)>0){
			$NumeroPendientesEstudiante=mysqli_num_rows($resultado);	
			return($NumeroPendientesEstudiante);
		}else{
			$NumeroPendientesEstudiante = 0;
		}
	}
	// CONTEO MATERIAS GANADAS ESTUDIANTES
	function NumeroCursosGanadasEstudiante($cnn4,$CedulaUser){
		$resultado=mysqli_query($cnn4,"CALL ConsultarGanadasEstudiante('".$CedulaUser."');");
		if(mysqli_num_rows($resultado)>0){
			$NumeroGanadasEstudiante=mysqli_num_rows($resultado);	
			return($NumeroGanadasEstudiante);
		}else{
			$NumeroGanadasEstudiante = 0;
		}
	}
	/*
		--> VALIDO INDEX -> USUARIOS EMPLEADOS ESTRICTAMENTE
	*/
	// CONTEO CASOS DE CLIENTES REGISTRADOS EN PROCESO
?>