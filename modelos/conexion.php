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
class conexion
{
	private $servidor="51.222.14.197";
	private $usuario="ucem-reg";
	private $clave="Ml7,7B3LxLI@d88ZXC8swn";
	private $base="ucemdb";
	public $conex;

	public function setServidor($s)
	{
		$this->servidor=$s;
	}
	public function getServidor()
	{
		return $this->servidor;
	}

	public function conectar($bd)
	{
		$misql=new mysqli($this->servidor,$this->usuario,$this->clave,$bd); 
		if($misql->connect_errno)
		{
			$mensaje="Error de conexion...".$misql->connect_error;
		}
		else
		{
			$mensaje="Conexion valida...";
			$this->conex=$misql;
		}
		return $mensaje;
	}
	// USUARIOS PRIVILEGIOS ADMINISTRADORES
	public function login($cnn,$Usuario,$Pass)
	{
		$resultado=mysqli_query($cnn,"CALL ucemdb.ValidarLogin('".$Usuario."','".$Pass."');");
		return $resultado;
	}

	// USUARIOS GENERALES {EMPLEADOS}
	public function loginEmpleados($cnn,$Usuario,$Pass)
	{
		$resultado=mysqli_query($cnn,"CALL ucemdb.ValidarLogin('$Usuario','$Pass');");
		return $resultado;
	}
}
// CONECTAR SISTEMA CON BASE DE DATOS {CONEXION PRINCIPAL TODO EL SISTEMA}
$con=new conexion();
$con->conectar("ucemdb");
$cnn=$con->conex;


// CONEXIONES SECUNDARIAS

/*
	--> CONEXIONES SECUNDARIAS: PROCESOS SECUNDARIOS
		{CONTEOS, GRAFICAS}
*/

/*
	--> VALIDO INDEX -> USUARIOS ADMINISTRADORES ESTRICTAMENTE
*/

// NUMERO USUARIOS ADMINISTRADORES REGISTRADOS
$con=new conexion();
$con->conectar("ucemdb");
$cnn1=$con->conex;		

// NUMERO USUARIOS EMPLEADOS REGISTRADOS
$con=new conexion();
$con->conectar("ucemdb");
$cnn2=$con->conex;

// NUMERO REPORTES PROBLEMAS REGISTRADOS
$con=new conexion();
$con->conectar("ucemdb");
$cnn3=$con->conex;

// NUMERO CASOS DE CLIENTES REGISTRADOS
$con=new conexion();
$con->conectar("ucemdb");
$cnn4=$con->conex;

/*
	--> VALIDO INDEX -> USUARIOS EMPLEADOS ESTRICTAMENTE
*/

// NUMERO CASOS DE CLIENTES ACTIVOS {EMPLEADOS} REGISTRADOS

// NUMERO CASOS DE CLIENTES PENDIENTES {EMPLEADOS} REGISTRADOS

// NUMERO CLIENTES REGISTRADOS

// PRODUCTOS REGISTRADOS
?>