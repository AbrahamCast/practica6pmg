<?php
    include "functions/acciones.php"; 
   $id=filter_var($_GET['id'],FILTER_VALIDATE_INT);

   if(!$id){
       die('No es valido');
   }
   $resultado= obtenerArticulo($id);
   $articulo=$resultado->fetch_assoc();

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/normalize.css">
    <title>Document</title>
</head>

<body>

    <header class="site-header">
        <div class="barra contenedor">
            <h3>Sistema de Inventario</h3>
            <h3>Mendoza Gaspar Paola</h3>
        </div>
    </header>
    
    <main>
           <div class="contenido-editar">
            <div class="datos-editar">
                <h3>Administrar Artículos</h3>
                <div class="formulario">
                    <form id="formEdit" action="#">
                        <label for="clave">Clave :</label>
                        <input type="text"  id="clavee" placeholder="Ingresa La Clave" readonly="readonly" 
                        value="<?php echo($articulo['ART_CVE_ARTICULO']) ? $articulo['ART_CVE_ARTICULO'] : ''; ?>"
                        >
                        <label for="nombre">Nombre :</label>
                        <input type="text"  id="nombree" placeholder="Ingresa El Nombre" 
                        value="<?php echo($articulo['ART_NOMBRE']) ? $articulo['ART_NOMBRE'] : ''; ?>"
                        >
                        <label for="descripcion">Descripción :</label>
                        <textarea  id="descripcione" placeholder="Ingresa la Descripción del Producto">
                            <?php echo($articulo['ART_DESCRIPCION']) ? $articulo['ART_DESCRIPCION'] : ''; ?>
                        </textarea>
                        <label for="status">Estatus :</label>
                        <select  id="statuse" >
                        <option value="<?php echo($articulo['ART_ESTATUS']); ?>" selected><?php echo($articulo['ART_ESTATUS']); ?></option>
                            <option value="Existencia">Existencia</option>
                            <option value="Agotado">Agotado</option>
                        </select>
                        <label for="existencia">Existencia :</label>
                        <input type="number"  id="existenciae" placeholder="0" 
                            value="<?php echo($articulo['ART_EXISTENCIAS']) ? $articulo['ART_EXISTENCIAS'] : ''; ?>"
                        >
                        <label for="precio">Precio :</label>
                        <input type="text"  id="precioe" placeholder="$ 0.00" 
                            value="<?php echo($articulo['ART_PRECIO']) ? $articulo['ART_PRECIO'] : ''; ?>"    
                        >
                        <label for="modelo">Modelo :</label>
                        <select  id="modeloe">
                            <option value="<?php echo($articulo['MOD_CVE_MODELO']); ?>" selected><?php echo($articulo['MOD_NOMBRE']); ?></option>
                            <?php

                                include 'conn/conexion.php';

                                $q =  mysqli_query($conn,"SELECT MOD_CVE_MODELO, MOD_NOMBRE from modelo");
                        
                                while ($row = mysqli_fetch_row($q)){
                                    echo "<option value='$row[0]'>$row[1]</option>";
                                }
                                    mysqli_free_result ($q);  
                                    mysqli_close($conn); 

                            ?>
                        </select>
                        <label for="familia">Familia :</label>
                        <select  id="familiae" >
                        <option value="<?php echo($articulo['FAM_CVE_FAMILIA']); ?>" selected><?php echo($articulo['FAM_NOMBRE']); ?></option>
                            <?php

                                include 'conn/conexion.php';

                                $q2 =  mysqli_query($conn,"SELECT FAM_CVE_FAMILIA, FAM_NOMBRE from familia");

                                while ($row = mysqli_fetch_row($q2)){
                                    echo "<option value='$row[0]'>$row[1]</option>";
                                }
                                    mysqli_free_result ($q2);  
                                    mysqli_close($conn);  
                            ?>
                        </select>
                        <label for="imagen">Ruta de imagen :</label>
                        <input type="text" id="imagene"
                            value="<?php echo($articulo['ART_RUTA_IMAGEN']) ? $articulo['ART_RUTA_IMAGEN'] : ''; ?>"    
                        >
                        
                        <div class="botones">
                            <?php if(isset($articulo['ART_CVE_ARTICULO'])){ ?>
                                <input type="hidden" id="ART_CVE_ARTICULO" value="<?php echo $articulo['ART_CVE_ARTICULO']; ?>">
                            <?php }?>
                            <input type="submit" id="accionn" value="actualizar">
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </main>
    <footer class="site-footer">
        <div class="footer-barra contenedor">
            <h3>Mendoza Gaspar Paola</h3>
            <div class="iconos">
                <i class="fab fa-facebook-square"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-twitter-square"></i>
                <i class="fab fa-facebook-messenger"></i>
            </div>
        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/actions.js"></script>
</body>
</html>