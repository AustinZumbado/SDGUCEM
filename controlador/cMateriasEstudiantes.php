<?php
session_start();
require('../modelos/conexion.php');
require('../modelos/mMateriasEstudiantes.php');
$Usuarios = new MateriasEstudiante();
if (isset($_GET['acc'])) {
    $accion = $_GET['acc'];
} else {
    $accion = 1; // por defecto
}
switch ($accion) {
    //CONSULTAR MATERIAS
    case 1:
        if ($_SESSION['vsTipo'] == 'Estudiante') {
            $consulta = $Usuarios->ConsultarMateriasEstudiante($cnn, $_SESSION['vsCedula']);
            require('../vistas/usuarios/MateriasMatriculadas.php');
        } elseif ($_SESSION['vsTipo'] == 'Administrativo') {
            header('location:../index.php');
        } else {
            header('location:../index.php');
        }
    case 2:
        if ($_SESSION['vsTipo'] == 'Estudiante') {
            $consulta = $Usuarios->ConsultarGanadasEstudiante($cnn, $_SESSION['vsCedula']);
            require('../vistas/usuarios/MateriasGanadas.php');
        } elseif ($_SESSION['vsTipo'] == 'Administrativo') {
            header('location:../index.php');
        } else {
            header('location:../index.php');
        }

    case 3:
        if ($_SESSION['vsTipo'] == 'Estudiante') {
            $consulta = $Usuarios->ConsultarPendientesEstudiante($cnn, $_SESSION['vsCedula']);
            require('../vistas/usuarios/MateriasPendientes.php');
        } elseif ($_SESSION['vsTipo'] == 'Administrativo') {
            header('location:../index.php');
        } else {
            header('location:../index.php');
        }
}
?>