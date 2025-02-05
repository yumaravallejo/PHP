const DIR_API = "http://localhost/PHP/Tema4-ServiciosWeb/Teor_SW/API";
const DIR_API2 =
  "http://localhost/PHP/Tema4-ServiciosWeb/Actividad1_2/Actividad1/servicios_rest";

//Esto se hará nada más cargar la página
$(function () {
  obtener_productos();
});

function obtener_productos() {
  $.ajax({
    url: DIR_API2 + "/productos",
    dataType: "json",
    type: "GET",
  })
    .done(function (data) {
      //Si hubiese un mensaje de que no hay productos también habría que añadirlo
      if (data.error) {
        $("#respuesta").html(data.error);
      } else {
        //Creamos en una variable todo el código de la tabla concatenando en una variable
        let tabla = "<table>";
        tabla += "<tr><th>COD</th><th>Nombre Corto</th><th>PVP (€)</th><th><Button class='enlace' onclick='agregarProducto()'>Agregar +</Button></th></tr>";

        $.each(data.productos, function (key, tupla) {
          tabla += "<tr>";
          //Es necesario poner comillas literales \" la barra es para poner lo q quieras poner del tiron
          tabla +=
            "<td><button class='enlace' onclick='verDetalles(\""+tupla["cod"]+"\")'>"+tupla["cod"]+"</button></td>";
          tabla += "<td>" + tupla["nombre_corto"] + "</td>";
          tabla += "<td>" + tupla["PVP"] + "</td>";
          tabla += "<td><Button class='enlace' onclick='borrarProducto(\""+tupla["cod"]+"\")'>Borrar</Button> - <Button class='enlace' onclick='editarProducto(\""+tupla["cod"]+"\")'>Editar</Button></td>";
          tabla += "</tr>";
        });

        $("#tabla").html(tabla);
      }
    })
    .fail(function (a, b) {
      $("#respuesta").html(error_ajax_jquery(a, b));
    });
}

function verDetalles(id) {
  $.ajax({
    url: DIR_API2 + "/producto/" + id,
    dataType: "json",
    type: "GET",
  })
    .done(function (data) {
      //Si hubiese un mensaje de que no hay productos también habría que añadirlo
      if (data.error) {
        $("#respuesta").html(data.error);
      } else if (data.mensaje) {
        $("#respuesta").html(data.mensaje);
      } else {
        // Comprobar que alguno sea null
        let respuesta = "<p>";
        respuesta += "<strong>Cod: </strong>";
        respuesta += data.producto.cod == null ? "" : data.producto.cod;

        respuesta += "<br><strong>Nombre corto: </strong>";
        respuesta += data.producto.nombre_corto == null ? "" : data.producto.nombre_corto;
        
        respuesta += "<br><strong>Nombre: </strong>";
        respuesta += data.producto.nombre == null ? "" : data.producto.nombre;

        respuesta += "<br><strong>Descripción: </strong>";
        respuesta += data.producto.descripcion == null ? "" : data.producto.descripcion;

        respuesta += "<br><strong>PVP: </strong>";
        respuesta += data.producto.PVP == null ? "" : data.producto.PVP;

        respuesta += "<br><strong>Familia: </strong>" + data.producto.familia;
        respuesta += data.producto.familia == null ? "" : data.producto.familia;

        respuesta += "</p>";
        $("#respuesta").html(respuesta);
      }
    })
    .fail(function (a, b) {
      $("#respuesta").html(error_ajax_jquery(a, b));
    });
}

function llamada_get1() {
  $.ajax({
    url: DIR_API + "/saludo",
    dataType: "json",
    type: "GET",
  })
    .done(function (data) {
      $("#respuesta").html(data.mensaje);
    })
    .fail(function (a, b) {
      $("#respuesta").html(error_ajax_jquery(a, b));
    });
  // .always({
  //      Esto se realizará siempre independientemente del resultado
  // })
}

function llamada_get2() {
  const nombre_envio = "María José";
  $.ajax({
    url: DIR_API + "/saludo/" + nombre_envio, //encodeURI sería redundante porque JQuery lo hace solo
    dataType: "json",
    type: "GET",
  })
    .done(function (data) {
      $("#respuesta").html(data.mensaje);
    })
    .fail(function (a, b) {
      $("#respuesta").html(error_ajax_jquery(a, b));
    });
}

function llamada_post() {
  const nombre_envio = "María José";
  $.ajax({
    url: DIR_API + "/saludo", //encodeURI sería redundante porque JQuery lo hace solo
    dataType: "json",
    type: "POST",
    data: { name: nombre_envio },
    // headers:{"Authorization":"Bearer (token)"}
  })
    .done(function (data) {
      $("#respuesta").html(data.mensaje);
    })
    .fail(function (a, b) {
      $("#respuesta").html(error_ajax_jquery(a, b));
    });
}

function llamada_delete() {
  const id = "9";
  $.ajax({
    url: DIR_API + "/borrar_saludo/" + id,
    dataType: "json",
    type: "DELETE",
  })
    .done(function (data) {
      $("#respuesta").html(data.mensaje);
    })
    .fail(function (a, b) {
      $("#respuesta").html(error_ajax_jquery(a, b));
    });
}

function llamada_put() {
  const id = "9";
  const nuevo_nombre = "Mario Casas";
  $.ajax({
    url: DIR_API + "/actualizar_saludo/" + id,
    dataType: "json",
    type: "PUT",
    data: { name: nombre_envio },
  })
    .done(function (data) {
      $("#respuesta").html(data.mensaje);
    })
    .fail(function (a, b) {
      $("#respuesta").html(error_ajax_jquery(a, b));
    });
}

function error_ajax_jquery(jqXHR, textStatus) {}
