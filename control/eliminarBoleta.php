<?php

include '../conexion.php';


//reciviendo datos del formulario
$id = $_GET['id'];;
if (!isset($id) ) {
    header("location:../page-ver-boletas.php");
}
$actualiza="UPDATE boleta SET BoletaEstReg='*' WHERE BoletaId='$id'";
if($conexion->query($actualiza) === TRUE){
    echo '1';
}else{
    echo '0';
}
$conexion->close();