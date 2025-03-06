// Función para cargar libros
function cargar_libros_normal() {
    $.ajax({
        url: DIR_API + "/obtenerLibros",
        type: "GET",
        dataType: "json"
    })
    .done(function(data) {
        if (data.error) {
            $('#errores').html(data.error);
            $('#principal').html("");
            localStorage.clear();
        } else {
            let html_libros = "";
            $.each(data.libros, function(key, tupla) {
                html_libros += "<div>";
                html_libros += "<img src='images/" + tupla.portada + "' alt='Portada' title='Portada'><br>";
                html_libros += tupla.titulo + " - " + tupla.precio + " €";
                html_libros += "</div>";
            });
            $('.contenedor_libros').html(html_libros);
        }
    })
    .fail(function(a, b) {
        $('#errores').html(error_ajax_jquery(a, b));
        $('#principal').html("");
        localStorage.clear();
    });
}

// Función para cargar libros en modo administrador 
function cargar_libros_admin() {
    if(((new Date()/1000) - localStorage.ultm_accion) < MINUTOS*60) 
    {
        // Si está la sesión activa se renueva 
        localStorage.setItem("ultm_accion",(new Date()/1000));
        
        $.ajax({
            url: DIR_API + "/obtenerLibros",
            type: "GET",
            dataType: "json",
            headers: { Authorization: "Bearer " + localStorage.token }
        })
        .done(function(data) {
            if (data.error) {
                $('#errores').html(data.error);
                $('#principal').html("");
                localStorage.clear();
            } 
            else if (data.no_auth || data.mensaje_baneo) {
                localStorage.clear();
                cargar_vista_login("No tiene permisos o ya no está registrado.");
            }
            else {
                if (data.token) {
                    localStorage.setItem("token", data.token);
                }
                localStorage.setItem("ultm_accion",(new Date()/1000));

                let html_libros = "<table class='centrado txt_centrado'>";
                html_libros += "<tr><th>Referencia</th><th>Título</th><th>Acción</th></tr>";
                $.each(data.libros, function(key, tupla) {
                    html_libros += "<tr>";
                    html_libros += "<td>" + tupla.referencia + "</td>";
                    html_libros += "<td><button class='enlace' onclick='mostrar_detalles(\"" + tupla.referencia + "\")'>" + tupla.titulo + "</button></td>";
                    html_libros += "<td>";
                    html_libros += "<button class='enlace' onclick='cargar_confirmar_borrado(\"" + tupla.referencia + "\")'>Borrar</button> - ";
                    html_libros += "<button class='enlace' onclick='montar_vista_editar(\"" + tupla.referencia + "\")'>Editar</button>";
                    html_libros += "</td>";
                    html_libros += "</tr>";
                });
                html_libros += "</table>";
                $('#libros').html(html_libros);
            }
        })
        .fail(function(a, b) {
            $('#errores').html(error_ajax_jquery(a, b));
            $('#principal').html("");
            localStorage.clear();
        });
    }
    else 
    {
        // Sesión expirada
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}

// Función para mostrar el formulario de agregar
function cargar_formulario_agregar() {
    if(((new Date()/1000)-localStorage.ultm_accion) < MINUTOS*60)
    {
        let html_form = "";
        html_form += "<h2>Agregar un nuevo libro</h2>";
        html_form += "<form id='formulario_agregar' enctype='multipart/form-data'>";
        html_form += "<div><label for='ref_libro'>Referencia: </label>";
        html_form += "<input type='text' id='ref_libro' name='referencia' required></div>";
        html_form += "<div><label for='titulo_libro'>Título: </label>";
        html_form += "<input type='text' id='titulo_libro' name='titulo' required></div>";
        html_form += "<div><label for='autor_libro'>Autor: </label>";
        html_form += "<input type='text' id='autor_libro' name='autor' required></div>";
        html_form += "<div><label for='desc_libro'>Descripción: </label>";
        html_form += "<textarea id='desc_libro' name='descripcion' rows='3' cols='30'></textarea></div>";
        html_form += "<div><label for='precio_libro'>Precio: </label>";
        html_form += "<input type='number' step='0.01' id='precio_libro' name='precio' required></div>";
        html_form += "<div><label for='portada_libro'>Portada (opcional): </label>";
        html_form += "<input type='file' id='portada_libro' name='portada' accept='image/*'></div>";
        html_form += "<input type='submit' value='Agregar'>";
        html_form += "</form>";
        html_form += "<div id='mensajes_agregar'></div>";

        $('#respuestas').html(html_form);

        $('#formulario_agregar').off('submit').on('submit', function (e) {
            e.preventDefault();

            if(((new Date()/1000)-localStorage.ultm_accion) >= MINUTOS*60)
            {
                localStorage.clear();
                cargar_vista_login("Su tiempo de sesión ha expirado");
                return;
            }

            let formElement = document.getElementById("formulario_agregar");
            let formData = new FormData(formElement);
            let referencia = $("#ref_libro").val();
            formData.append('referencia', referencia);

            // Verifica repe
            $.ajax({
                url: DIR_API + "/repetido/libros/referencia/" + referencia,
                type: "GET",
                dataType: "json",
                headers: { Authorization: "Bearer " + localStorage.token }
            })
            .done(function(dupData) {
                if (dupData.repetido) {
                    $('#mensajes_agregar').html("<span class='error'>La referencia ya existe.</span>");
                    return;
                } else {
                    // Subir imagen 
                    if ($('#portada_libro')[0].files.length > 0) {
                        $.ajax({
                            url: DIR_API + "/cargarPortada",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            headers: { Authorization: "Bearer " + localStorage.token }
                        })
                        .done(function(respPortada) {
                            if (respPortada.error) {
                                $('#mensajes_agregar').html("<span class='error'>" + respPortada.error + "</span>");
                                return;
                            }
                            // Actualizar formData con la imagen devuelta
                            formData.delete('portada');
                            formData.append('portada', respPortada.imagen);

                            // Crea el libro
                            $.ajax({
                                url: DIR_API + "/crearLibro",
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                dataType: "json",
                                headers: { Authorization: "Bearer " + localStorage.token }
                            })
                            .done(function(respCrear) {
                                if (respCrear.token) {
                                    localStorage.setItem("token", respCrear.token);
                                }
                                localStorage.setItem("ultm_accion",(new Date()/1000));

                                if (respCrear.error) {
                                    $('#mensajes_agregar').html("<span class='error'>" + respCrear.error + "</span>");
                                } else {
                                    $('#mensajes_agregar').html("<span class='mensaje'>" + respCrear.mensaje + "</span>");
                                    if (typeof cargar_libros_admin === "function") {
                                        cargar_libros_admin();
                                    }
                                    formElement.reset();
                                }
                            })
                            .fail(function(a,b){
                                $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a,b) + "</span>");
                            });
                        })
                        .fail(function(a,b){
                            $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a,b) + "</span>");
                        });
                    }
                    else
                    {
                        // Si no se ha subido una imagen se pone la de por defecto
                        formData.set('portada', "no_imagen.jpg");

                        $.ajax({
                            url: DIR_API + "/crearLibro",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            headers: { Authorization: "Bearer " + localStorage.token }
                        })
                        .done(function(respCrear2) {
                            if (respCrear2.token) {
                                localStorage.setItem("token", respCrear2.token);
                            }
                            localStorage.setItem("ultm_accion",(new Date()/1000));

                            if (respCrear2.error) {
                                $('#mensajes_agregar').html("<span class='error'>" + respCrear2.error + "</span>");
                            } else {
                                $('#mensajes_agregar').html("<span class='mensaje'>" + respCrear2.mensaje + "</span>");
                                formElement.reset();
                            }
                        })
                        .fail(function(a,b){
                            $('#mensajes_agregar').html("<span class='error'>" + error_ajax_jquery(a,b) + "</span>");
                        });
                    }
                }
            })
            .fail(function(a,b){
                $('#mensajes_agregar').html("<span class='error'>Error al verificar duplicado: " + error_ajax_jquery(a,b) + "</span>");
            });
        });
    }
    else
    {
        // Sesión expirada
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}

// Función para mostrar detalles de un libro
function mostrar_detalles(referencia) {
    if (((new Date() / 1000) - localStorage.ultm_accion) < MINUTOS * 60) {
        $.ajax({
            url: DIR_API + "/obtenerLibro/" + referencia,
            type: "GET",
            dataType: "json",
            headers: { Authorization: "Bearer " + localStorage.token }
        })
        .done(function(data) {
            if (data.error) {
                $("#errores").html(data.error);
                $("#principal").html("");
            } 
            else if (data.no_auth) {
                localStorage.clear();
                cargar_vista_login("El tiempo de sesión de la API ha expirado.");
            } 
            else if (data.mensaje_baneo) {
                localStorage.clear();
                cargar_vista_login("Usted ya no se encuentra registrado en la BD.");
            } 
            else {
                if (data.token) {
                    localStorage.setItem("token", data.token);
                }
                localStorage.setItem("ultm_accion", (new Date() / 1000));

                let libro = data.libro;
                let html_detalles = "<h2>Detalles del Libro " + referencia + "</h2>";
                html_detalles += "<p>";
                html_detalles += "<strong>Título:</strong> " + (libro.titulo || "") + "<br>";
                html_detalles += "<strong>Autor:</strong> " + (libro.autor || "") + "<br>";
                html_detalles += "<strong>Descripción:</strong> " + (libro.descripcion || "") + "<br>";
                html_detalles += "<strong>Precio:</strong> " + (libro.precio || "") + " €<br>";
                html_detalles += "<img src='images/" + (libro.portada || "no_imagen.jpg") + "' alt='Portada' title='Portada'>";
                html_detalles += "</p>";
                html_detalles += "<p><button onclick='cargar_formulario_agregar()'>Volver</button></p>";
                $("#respuestas").html(html_detalles);
            }
        })
        .fail(function(a, b) {
            $("#errores").html(error_ajax_jquery(a, b));
            $("#principal").html("");
            localStorage.clear();
        });
    } else {
        // Sesión expirada
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}

// Función para borrar un libro
function borrarLibro(referencia) {
    if (((new Date() / 1000) - localStorage.ultm_accion) < MINUTOS * 60) {
        $.ajax({
            url: DIR_API + "/borrarLibro/" + referencia,
            type: "DELETE",
            dataType: "json",
            headers: { Authorization: "Bearer " + localStorage.token }
        })
        .done(function(data) {
            if (data.error) {
                $("#errores").html(data.error);
                $("#principal").html("");
            } 
            else if (data.no_auth || data.mensaje_baneo) {
                localStorage.clear();
                cargar_vista_login("El tiempo de sesión ha expirado o ya no se encuentra registrado en la BD.");
            } 
            else {
                if (data.token) {
                    localStorage.setItem("token", data.token);
                }
                localStorage.setItem("ultm_accion", (new Date() / 1000));

                $("#mensaje").html("<p class='mensaje txt_centrado'>Libro borrado correctamente.</p>");
                cargar_libros_admin();
            }
        })
        .fail(function(a, b) {
            $("#errores").html(error_ajax_jquery(a, b));
            $("#principal").html("");
        });
    } else {
        // Sesión expirada
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}

// Función para solicitar confirmación antes de borrar
function cargar_confirmar_borrado(referencia) {
    let html = "<p>¿Desea borrar el libro con referencia <strong>" + referencia + "</strong>?</p>";
    html += "<button onclick='borrarLibro(\"" + referencia + "\")'>Sí</button> ";
    html += "<button onclick='cargar_libros_admin()'>No</button>";
    $("#mensaje").html(html);
}

// Función para editar 
function montar_vista_editar(referencia) {
    if (((new Date() / 1000) - localStorage.ultm_accion) < MINUTOS*60) {
        $.ajax({
            url: DIR_API + "/obtenerLibro/" + referencia,
            type: "GET",
            dataType: "json",
            headers: { Authorization: "Bearer " + localStorage.token }
        })
        .done(function(data) {
            if (data.error) {
                $("#errores").html(data.error);
                $("#principal").html("");
            } 
            else if (data.no_auth) {
                localStorage.clear();
                cargar_vista_login("El tiempo de sesión ha expirado.");
            } 
            else if (data.mensaje_baneo) {
                localStorage.clear();
                cargar_vista_login("Usted ya no se encuentra registrado en la BD.");
            } 
            else {
                if (data.token) {
                    localStorage.setItem("token", data.token);
                }
                localStorage.setItem("ultm_accion", (new Date() / 1000));

                let libro = data.libro;
                let html = "<h2>Editar Libro " + referencia + "</h2>";
                html += "<form id='form_editar_libro'>";
                html += "<label for='edit_titulo'>Título: </label><br>";
                html += "<input type='text' id='edit_titulo' name='titulo' value='" + libro.titulo + "' required><br><br>";

                html += "<label for='edit_autor'>Autor: </label><br>";
                html += "<input type='text' id='edit_autor' name='autor' value='" + libro.autor + "' required><br><br>";

                html += "<label for='edit_descripcion'>Descripción: </label><br>";
                html += "<textarea id='edit_descripcion' name='descripcion' rows='3' cols='30'>";
                html += libro.descripcion ? libro.descripcion : "";
                html += "</textarea><br><br>";

                html += "<label for='edit_precio'>Precio: </label><br>";
                html += "<input type='number' step='0.01' id='edit_precio' name='precio' value='" + libro.precio + "' required><br><br>";
                html += "<input type='submit' value='Guardar cambios'>";
                html += "</form>";
                html += "<div id='mensaje_editar'></div>";
                $("#respuestas").html(html);

                $("#form_editar_libro").off("submit").on("submit", function(e) {
                    e.preventDefault();
                    let titulo = $("#edit_titulo").val();
                    let autor  = $("#edit_autor").val();
                    let desc   = $("#edit_descripcion").val();
                    let precio = $("#edit_precio").val();

                    $.ajax({
                        url: DIR_API + "/actualizarLibro/" + referencia,
                        type: "PUT",
                        dataType: "json",
                        data: { 
                            titulo: titulo,
                            autor: autor,
                            descripcion: desc,
                            precio: precio
                        },
                        headers: { Authorization: "Bearer " + localStorage.token }
                    })
                    .done(function(respTexto) {
                        if (respTexto.error) {
                            $("#mensaje_editar").html("<span class='error'>" + respTexto.error + "</span>");
                        } else {
                            if (respTexto.token) {
                                localStorage.setItem("token", respTexto.token);
                            }
                            localStorage.setItem("ultm_accion",(new Date()/1000));

                            $("#mensaje_editar").html("<span class='mensaje'>" + respTexto.mensaje + "</span>");
                            cargar_libros_admin();
                        }
                    })
                    .fail(function(a,b){
                        $("#mensaje_editar").html("<span class='error'>" + error_ajax_jquery(a,b) + "</span>");
                    });
                });
            }
        })
        .fail(function(a, b) {
            $("#errores").html(error_ajax_jquery(a, b));
            $("#principal").html("");
            localStorage.clear();
        });
    } 
    else {
        // Sesión expirada
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}
