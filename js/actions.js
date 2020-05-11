const formularioArticulos = document.querySelector('#formart'),
    formularioEditar = document.querySelector('#formEdit'),
    listadoArticulos = document.querySelector('#listadoArticulos tbody'),
    inputBuscardor = document.querySelector('#buscar');


eventListeners();

function eventListeners() {
    //cuando el formulario de crear se ejecuta
    if (formularioArticulos) {
        formularioArticulos.addEventListener('submit', leerFormulario);
        numeroArticulos();
    }
    //editar
    if (formularioEditar) {
        formularioEditar.addEventListener('submit', leerFormularioE);
    }
    //boton eliminar
    if (listadoArticulos) {
        listadoArticulos.addEventListener('click', eliminarArticulo);
        numeroArticulos();
    }
    //buscardor
    if (inputBuscardor) {
        inputBuscardor.addEventListener('input', buscarArticulos);
        numeroArticulos();
    }
    //contador

}

function leerFormulario(e) {
    var d = new Date();
    var hora = d.getFullYear() + '-' + d.getMonth() + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
    e.preventDefault()
        //leer datos
    const clave = document.querySelector('#clave').value,
        nombre = document.querySelector('#nombre').value,
        descripcion = document.querySelector('#descripcion').value,
        status = document.querySelector('#status').value,
        existencia = document.querySelector('#existencia').value,
        precio = document.querySelector('#precio').value,
        fecha = hora,
        modelo = document.querySelector('#modelo').value,
        familia = document.querySelector('#familia').value,
        imagen = document.querySelector('#imagen').value,
        accion = document.querySelector('#accion').value;
    if (imagen) {
        var startIndex = (imagen.indexOf('\\') >= 0 ? imagen.lastIndexOf('\\') : imagen.lastIndexOf('/'));
        var filename = imagen.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
    }
    if (clave === '' || nombre === '' || descripcion === '' || status === '' || existencia === '' ||
        precio === '' || fecha === '' || modelo === '' || familia === '' || imagen === '') {
        Notificaciones();
    } else {
        const infArticulo = new FormData();
        infArticulo.append('nombre', nombre);
        infArticulo.append('descripcion', descripcion);
        infArticulo.append('status', status);
        infArticulo.append('existencia', existencia);
        infArticulo.append('precio', precio);
        infArticulo.append('fecha', fecha);
        infArticulo.append('modelo', modelo);
        infArticulo.append('familia', familia);
        infArticulo.append('imagen', filename);
        infArticulo.append('accion', accion);
        //console.log(...infArticulo);
        if (accion === 'insertar') {
            insertarBD(infArticulo);
        } else {}
    }
}

function leerFormularioE(e) {
    e.preventDefault()
        //leer datos
    const clave = document.querySelector('#clavee').value,
        nombre = document.querySelector('#nombree').value,
        descripcion = document.querySelector('#descripcione').value,
        status = document.querySelector('#statuse').value,
        existencia = document.querySelector('#existenciae').value,
        precio = document.querySelector('#precioe').value,
        modelo = document.querySelector('#modeloe').value,
        familia = document.querySelector('#familiae').value,
        imagen = document.querySelector('#imagene').value,
        accion = document.querySelector('#accionn').value;


    const infArticuloE = new FormData();
    infArticuloE.append('nombre', nombre);
    infArticuloE.append('descripcion', descripcion);
    infArticuloE.append('status', status);
    infArticuloE.append('existencia', existencia);
    infArticuloE.append('precio', precio);
    infArticuloE.append('modelo', modelo);
    infArticuloE.append('familia', familia);
    infArticuloE.append('imagen', imagen);
    infArticuloE.append('accion', accion);

    if (accion === 'actualizar') {
        const idRegistro = document.querySelector('#ART_CVE_ARTICULO').value;
        infArticuloE.append('id', idRegistro);
        actualizarRegistro(infArticuloE);
    } else {
        //leer id

    }

}
//insetarBD con Ajax
function insertarBD(datos) {
    //llamado

    //objeto
    const xhr = new XMLHttpRequest();
    //conexion
    xhr.open('POST', 'modelos/modelo-articulo.php', true);
    //pasar datos
    xhr.onload = function() {
            if (this.status === 200) {
                console.log(JSON.parse(xhr.responseText));
                //leer respuesta de php
                const respuesta = JSON.parse(xhr.responseText);
                //console.log(respuesta.fecha);

                //insertar registro a una tabla
                const nuevoArticulo = document.createElement('tr');
                nuevoArticulo.innerHTML = `
                <td>${respuesta.datos.id_insertado}</td>
                <td>${respuesta.datos.nombre}</td>
                <td>${respuesta.datos.descripcion}</td>
                <td>${respuesta.datos.status}</td>
                <td>${respuesta.datos.existencia}</td>
                <td>${respuesta.datos.precio}</td>
                <td>${respuesta.datos.fecha}</td>
                <td>${respuesta.datos.modelo}</td>
                <td>${respuesta.datos.familia}</td>
                <td><img src="${respuesta.datos.imagen}"></td>
                `;
                //botones
                const contenedorAcciones = document.createElement('td');
                //btn editar
                const btneditar = document.createElement('a');
                btneditar.setAttribute('id', respuesta.datos.id_insertado);
                btneditar.href = `editar.php?id=${respuesta.datos.id_insertado}`;
                btneditar.setAttribute('onclick', 'actualizar()');
                /*btneditar.setAttribute('value', 'editar');*/
                btneditar.innerHTML = 'Editar';

                btneditar.classList.add('btn-editar');

                //agregar a contenedor
                contenedorAcciones.appendChild(btneditar);

                //btn eliminar
                const btneliminar = document.createElement('a');
                btneliminar.setAttribute('data-id', respuesta.datos.id_insertado);
                /*btneliminar.setAttribute('value', 'borrar');*/
                btneliminar.innerHTML = 'Borrar';
                btneliminar.classList.add('btn-borrar');

                //agregar a contenedor
                contenedorAcciones.appendChild(btneliminar);

                //agregar a tr
                nuevoArticulo.appendChild(contenedorAcciones);
                //agregar a articulos
                listadoArticulos.appendChild(nuevoArticulo);

                //reiniciar formulario
                document.querySelector('form').reset();
                //notificacion
                correcto();
                numeroArticulos();
            }
        }
        //enviar datos
    xhr.send(datos);
}

function actualizarRegistro(datos) {
    //crear objeto
    const xhr = new XMLHttpRequest();
    //abrir conn
    xhr.open('POST', 'modelos/modelo-actualiza.php', true);
    //leer resp
    xhr.onload = function() {
            if (this.status === 200) {
                const respuesta = JSON.parse(xhr.responseText);
                //console.log(respuesta);
                if (respuesta.respuesta === 'correcto') {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Actualizado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2000);
            }

        }
        //enviar pet
    xhr.send(datos);
}

//eliminar articulo
function eliminarArticulo(e) {
    if (e.target.classList.contains('btn-borrar')) {
        //obtener id
        const id = e.target.getAttribute('data-id');
        //console.log(id);
        //preguntar a usuario
        Swal.fire({
            title: 'Are you sure?',
            text: "Si el registro es llave foranea es posible que NO se elimine!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                //llamado a ajx
                //crear obj
                const xhr = new XMLHttpRequest();
                //abrir conn
                xhr.open('GET', `modelos/modelo-elimina.php?id=${id}&accion=borrar`, true);
                //leer resp
                xhr.onload = function() {
                        if (this.status === 200) {
                            const resultado = JSON.parse(xhr.responseText);
                            if (resultado.respuesta === 'correcto') {
                                //Eliminar registro de DOM
                                console.log(e.target.parentElement.parentElement);
                                e.target.parentElement.parentElement.remove();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Esta accion es IRREVERSIBLE!'
                                });
                            }
                        }
                    }
                    //enviar pet
                xhr.send();

            }
        });
    }
}


function Notificaciones() {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!'
    });
}

function correcto() {
    Swal.fire(
        'Insertado!',
        'Se ha insertado correctamente!',
        'success'
    );
    location.reload();
}

function buscarArticulos(e) {
    const expresion = new RegExp(e.target.value),
        registros = document.querySelectorAll('tbody tr');

    registros.forEach(registro => {
        registro.style.display = 'none';

        //console.log(registro.childNodes[3].textContent.replace(/\s/g, " ").search(expresion) != -1);
        if (registro.childNodes[3].textContent.replace(/\s/g, " ").search(expresion) != -1) {
            registro.style.display = 'table-row';
        }
        numeroArticulos();
    })
}
//numero de articulos
function numeroArticulos() {
    const totalArticulos = document.querySelectorAll('tbody tr'),
        contenedorNumero = document.querySelector('.totalArticulos span');
    //console.log(totalArticulos.length);
    let total = 0;
    totalArticulos.forEach(articulo => {
        //console.log(articulo.style.display);
        if (articulo.style.display === '' || articulo.style.display === 'table-row') {
            total++;
        }
    });
    //console.log(total);
    contenedorNumero.textContent = total;
}