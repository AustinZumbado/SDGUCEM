<?php
class MateriasEstudiante{
    private $Id;
    private $Cedula;
    private $Nombre;
    private $Apellidos;
    private $IdCuatrimestre;
    private $CodigoCurso;
    private $NombreCurso;

    // ID
    public  function setId($n){
        $this->Id=$n;
    }
    public function getId(){
        return $this->Id;
    }
    // CEDULA
    public  function setCedula($n){
        $this->Cedula=$n;
    }
    public function getCedula(){
        return $this->Cedula;
    }
    // NOMBRE
    public  function setNombre($n){
        $this->Nombre=$n;
    }
    public function getNombre(){
        return $this->Nombre;
    }
    // APELLIDOS
    public  function setApellidos($n){
        $this->Apellidos=$n;
    }
    public function getApellidos(){
        return $this->Apellidos;
    }
    // IDCUATRIMESTRE
    public  function setIdCuatrimestre($n){
        $this->IdCuatrimestre=$n;
    }
    public function getIdCuatrimestre(){
        return $this->IdCuatrimestre;
    }
    // CODIGOCURSO
    public  function setCodigoCursos($n){
        $this->CodigoCurso=$n;
    }
    public function getCodigoCursos(){
        return $this->CodigoCurso;
    }
    // NOMBRE CURSOS
    public  function setNombreCurso($n){
        $this->NombreCurso=$n;
    }
    public function getNombreCurso(){
        return $this->NombreCurso;
    }
    //CONSULTAR LAS MATERIAS MATRICULADAS POR UN ESTUDIANTE
    public function ConsultarMateriasEstudiante($cnn,$CedulaUser)
    {
        $resultado=mysqli_query($cnn,"CALL ucemdb.ConsultarCartaEstudiante('".$CedulaUser."');");
        return $resultado;
    }
    public function ConsultarGanadasEstudiante($cnn,$CedulaUser)
    {
        $resultado=mysqli_query($cnn,"CALL ucemdb.ConsultarGanadasEstudiante('".$CedulaUser."');");
        return $resultado;
    }
    public function ConsultarPendientesEstudiante($cnn,$CedulaUser)
    {
        $resultado=mysqli_query($cnn,"CALL ucemdb.ConsultasPendientesEstudiante('".$CedulaUser."');");
        return $resultado;
    }
} 
?>