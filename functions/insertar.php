<?php
    include '../conn/conexion.php';
    if(isset($_POST['insertar'])){
        $Clave = $_POST['clave'];
        $Nombre = $_POST['nombre'];
        $Descripcion = $_POST['descripcion'];
        $Status = $_POST['status'];
        $Existencia = $_POST['existencia'];
        $Precio = $_POST['precio'];
        $Fecha = $_POST['fecha'];
        $Modelo = $_POST['modelo'];
        $Familia = $_POST['familia'];
        $Imagen = $_POST['imagen'];
    }
     $img='imagenes/articulos/'.$Imagen;
     if($conn){
        $sql="INSERT INTO articulo (ART_NOMBRE, ART_DESCRIPCION, 
        ART_ESTATUS, ART_EXISTENCIAS, ART_PRECIO, ART_FECHA_REG, MOD_CVE_MODELO,
        FAM_CVE_FAMILIA, ART_RUTA_IMAGEN) VALUES
        ('$Nombre','$Descripcion','$Status','$Existencia','$Precio','$Fecha','$Modelo','$Familia','$img')";   
        
        if (mysqli_query($conn, $sql)) {
            header("location:../index.php");
            
              }      
    }
?> 
