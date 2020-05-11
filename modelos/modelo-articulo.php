<?php
if($_POST['accion'] == 'insertar'){
        require_once('../conn/conexion.php');
        
        $nombre =$_POST['nombre'];
        $descripcion =$_POST['descripcion'];
        $status=$_POST['status'];
        $existencia =$_POST['existencia'];
        $precio =$_POST['precio'];
        $fecha=date("Y-m-d H:i:s");
        $modelo=$_POST['modelo'];
        $familia=$_POST['familia'];
        $imagen=$_POST['imagen'];
        $img='imagenes/articulos/'.$imagen;
    
        try{
            $stmt = $conn->prepare("INSERT INTO articulo (ART_NOMBRE, ART_DESCRIPCION, 
            ART_ESTATUS, ART_EXISTENCIAS, ART_PRECIO, ART_FECHA_REG, MOD_CVE_MODELO,
            FAM_CVE_FAMILIA, ART_RUTA_IMAGEN) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssssss",$nombre,$descripcion,$status,$existencia,$precio,$fecha,$modelo,$familia,$img);
            $stmt->execute();
            if($stmt->affected_rows == 1) {
                $respuesta = array(
                    'respuesta'=>'correcto',
                    'datos'=>array(
                        'nombre'=>$nombre,
                        'descripcion'=>$descripcion,
                        'status'=>$status,
                        'existencia'=>$existencia,
                        'precio'=>$precio,
                        'fecha'=>$fecha,
                        'modelo'=>$modelo,
                        'familia'=>$familia,
                        'imagen'=>$img,
                        'id_insertado' => $stmt->insert_id
                    )
                );
            }
            $stmt->close();
            $conn->close();
        }catch(Exception $e){
            $respuesta = array (
                'error'=> $e->getMessage()
            );
        }
        echo json_encode($respuesta);
}
