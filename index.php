<?php
    include "functions/acciones.php";    
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
    <div class="buscador">
    <input type="text" name="" id="buscar" placeholder="Ingresa tu busqueda">
    
    <h3 class="totalArticulos">Total de Articulos : <span></span></h3>
    </div>
        <div class="contenido">
            <div class="datos">
                <h3>Administrar Artículos</h3>
                <div class="formulario">
                    <form id="formart" action="#">
                        <label for="clave">Clave :</label>
                        <input type="text"  id="clave" placeholder="Ingresa La Clave" >
                        <label for="nombre">Nombre :</label>
                        <input type="text"  id="nombre" placeholder="Ingresa El Nombre" >
                        <label for="descripcion">Descripción :</label>
                        <textarea  id="descripcion" placeholder="Ingresa la Descripción del Producto" ></textarea>
                        <label for="status">Estatus :</label>
                        <select  id="status" >
                            <option selected="true" disabled="disabled">Selecciona un Status</option>
                            <option value="Existencia">Existencia</option>
                            <option value="Agotado">Agotado</option>
                        </select>
                        <label for="existencia">Existencia :</label>
                        <input type="number"  id="existencia" placeholder="0" >
                        <label for="precio">Precio :</label>
                        <input type="text"  id="precio" placeholder="$ 0.00" >
                        
                        <label for="modelo">Modelo :</label>
                        <select  id="modelo">
                            <option value="" selected="true" disabled="disabled">Selecciona un Modelo</option>
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
                        <select  id="familia" >
                            <option value="" selected="true" disabled="disabled">Selecciona una Famlia</option>
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
                        <label for="imagen">Seleccionar Imagen :</label>
                        <input type="file" id="imagen">
                        
                        <div class="botones">
                            <input type="reset" value="Limpiar">
                            <input type="submit" id="accion" value="insertar">
                        </div>
                    </form>
                </div>
            </div>
            <div class="mostrar">
                <h3>Artículos Registrados</h3>
                <div class="lista-alumn">
                    <table id="listadoArticulos" class="datos-tabla" >
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Estatus</th>
                                <th>Existencia</th>
                                <th>Precio</th>
                                <th>Fecha</th>
                                <th>Modelo</th>
                                <th>Familia</th>
                                <th>Ruta</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php $articulos = obtener();
                                if($articulos->num_rows){
                                    foreach($articulos as $articulo){?>
                                     <tr>
                                        <td width='5%'><?php echo $articulo['ART_CVE_ARTICULO']; ?></td>
                                        <td width='8%'><?php echo $articulo['ART_NOMBRE']; ?></td>
                                        <td width='10%'><?php echo $articulo['ART_DESCRIPCION']; ?></td>
                                        <td width='8%'><?php echo $articulo['ART_ESTATUS']; ?></td>
                                        <td width='8%'><?php echo $articulo['ART_EXISTENCIAS']; ?></td>
                                        <td width='7%'><?php echo $articulo['ART_PRECIO']; ?></td>
                                        <td width='10%'><?php echo $articulo['ART_FECHA_REG']; ?></td>
                                        <td width='10%'><?php echo $articulo['modelo']; ?></td>
                                        <td width='7%'><?php echo $articulo['familia']; ?></td>
                                        <td width='5%'><img src=<?php echo $articulo['ART_RUTA_IMAGEN']; ?>></td>
                                        <td>
                                            <a class='btn-editar' href="editar.php?id=<?php echo $articulo['ART_CVE_ARTICULO']; ?>" value='editar'>Editar</a><a  class='btn-borrar'  data-id="<?php echo  $articulo['ART_CVE_ARTICULO']; ?>">Borrar</a>
                                        </td>
                                    </tr>
                            <?php  } 
                            }?>
                        </tbody>
                    </table>
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
    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/actions.js"></script>

</body>
</html>