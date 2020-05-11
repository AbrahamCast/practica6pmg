<?php
if($_GET['accion'] == 'borrar'){
    require_once('../conn/conexion.php');
    $id=$_GET['id'];
    try{
        $llf=$conn->prepare("SET foreign_key_checks = 0");
        $llf->execute();
        $stmt=$conn->prepare("DELETE FROM articulo WHERE ART_CVE_ARTICULO =?");
        $stmt->bind_param("s",$id);
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
?>