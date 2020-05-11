<?php
if($_POST['accion'] == 'actualizar'){
    //echo json_encode($_POST);
  require_once('../conn/conexion.php');

        $nombre =$_POST['nombre'];
        $descripcion =$_POST['descripcion'];
        $status=$_POST['status'];
        $existencia =$_POST['existencia'];
        $precio =$_POST['precio'];
        $modelo=$_POST['modelo'];
        $familia=$_POST['familia'];
        $imagen=$_POST['imagen'];
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        try{
            $stmt = $conn->prepare("UPDATE articulo SET ART_NOMBRE=?, ART_DESCRIPCION=?, 
            ART_ESTATUS=?, ART_EXISTENCIAS=?, ART_PRECIO=?, MOD_CVE_MODELO=?,
            FAM_CVE_FAMILIA=?, ART_RUTA_IMAGEN=? WHERE ART_CVE_ARTICULO=?");
            $stmt->bind_param("sssssssss",$nombre,$descripcion,$status,$existencia,$precio,$modelo,$familia,$imagen,$id);
            $stmt->execute();
            if($stmt->affected_rows == 1){
                $respuesta = array(
                    'respuesta'=>'correcto'
                );
            }
            $stmt->close();
            $conn->close();
        }catch(Exception $e){
        $respuesta = array(
            'error'=>$e->getMessage()
        );
    }
    echo json_encode($respuesta);
}