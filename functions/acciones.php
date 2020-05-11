<?php
function obtener(){
    include 'conn/conexion.php';
    try{
        return $conn->query("SELECT articulo.ART_CVE_ARTICULO, articulo.ART_NOMBRE,articulo.ART_DESCRIPCION,
        articulo.ART_ESTATUS,articulo.ART_EXISTENCIAS,articulo.ART_PRECIO, articulo.ART_FECHA_REG,
        CONCAT (articulo.MOD_CVE_MODELO,' - ',modelo.MOD_NOMBRE)AS modelo,CONCAT (articulo.FAM_CVE_FAMILIA,' - ',
        familia.FAM_NOMBRE) AS familia, articulo.ART_RUTA_IMAGEN FROM ARTICULO JOIN familia 
        ON articulo.FAM_CVE_FAMILIA=familia.FAM_CVE_FAMILIA JOIN modelo ON articulo.MOD_CVE_MODELO = modelo.MOD_CVE_MODELO 
        ORDER BY articulo.ART_CVE_ARTICULO");
    }catch(Exception $e){
        echo "error";
        return false;
    }
}

//OBTENER UN CONTACTO
function obtenerArticulo($id){
    include 'conn/conexion.php';
    try{
        return $conn->query("SELECT articulo.ART_CVE_ARTICULO, articulo.ART_NOMBRE,articulo.ART_DESCRIPCION,
        articulo.ART_ESTATUS,articulo.ART_EXISTENCIAS,articulo.ART_PRECIO,
        articulo.MOD_CVE_MODELO,modelo.MOD_NOMBRE,articulo.FAM_CVE_FAMILIA,
        familia.FAM_NOMBRE, articulo.ART_RUTA_IMAGEN FROM ARTICULO JOIN familia 
        ON articulo.FAM_CVE_FAMILIA=familia.FAM_CVE_FAMILIA JOIN modelo ON articulo.MOD_CVE_MODELO = modelo.MOD_CVE_MODELO WHERE articulo.ART_CVE_ARTICULO =$id");
    }catch(Exception $e){
        echo "error";
        return false;
    }
}
?>