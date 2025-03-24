var desinfeccionID = null; 
$(document).ready(function () {
    listar_mantenimiento();
    cargarCalendario();

});

function cargarCalendario() {
    var calendarEl = document.getElementById('calendar');
    if (!calendarEl) {
        console.error("No se encontró el elemento #calendar");
        return;
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es', // 🔥 Cambia el idioma a español
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        titleFormat: { // 🔥 Personalizar el título del calendario
            month: 'long',  // "Febrero 2025"
            year: 'numeric'
        },
        buttonText: { // 🔥 Configuración en español
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            list: 'Agenda'
        },
        allDayText: 'Todo el día',
        noEventsText: 'No hay eventos para mostrar',
        weekText: 'Sm',
        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: '../Controller/mantenimiento/controller_cronograma.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log("Eventos cargados:", response);
                    successCallback(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error al cargar eventos:", error);
                    failureCallback(error);
                }
            });
        },
        eventClick: function(info) {
            var evento = info.event;

            Swal.fire({
                title: `<h4><b>${evento.title}</b></h4>`,
                html: `<b>Descripción:</b> ${evento.extendedProps.descripcion}<br>
                       <b>Estado:</b> ${evento.extendedProps.estado}<br>
                       <b>Tipo:</b> ${evento.extendedProps.tipo}`,
                icon: "info"
            });
        }
    });

    calendar.render();
}
var tbl_mantenimiento;
var idioma_espanol = {
   
  "lengthMenu": "Mostrar _MENU_ registros",
  "zeroRecords": "No se encontraron resultados",
  "emptyTable": "Ningún dato disponible en esta tabla",
  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
  "search": "Buscar:",
  "infoThousands": ",",
  "loadingRecords": "Cargando...",
  "paginate": {
      "first": "Primero",
      "last": "Último",
      "next": "Siguiente",
      "previous": "Anterior"
  },
  "aria": {
      "sortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sortDescending": ": Activar para ordenar la columna de manera descendente"
  },
  "buttons": {
      "copy": "Copiar",
      "colvis": "Visibilidad",
      "collection": "Colección",
      "colvisRestore": "Restaurar visibilidad",
      "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
      "copySuccess": {
          "1": "Copiada 1 fila al portapapeles",
          "_": "Copiadas %ds fila al portapapeles"
      },
      "copyTitle": "Copiar al portapapeles",
      "csv": "CSV",
      "excel": "Excel",
      "pageLength": {
          "-1": "Mostrar todas las filas",
          "_": "Mostrar %d filas"
      },
      "pdf": "PDF",
      "print": "Imprimir",
      "renameState": "Cambiar nombre",
      "updateState": "Actualizar",
      "createState": "Crear Estado",
      "removeAllStates": "Remover Estados",
      "removeState": "Remover",
      "savedStates": "Estados Guardados",
      "stateRestore": "Estado %d"
  },
  "autoFill": {
      "cancel": "Cancelar",
      "fill": "Rellene todas las celdas con <i>%d<\/i>",
      "fillHorizontal": "Rellenar celdas horizontalmente",
      "fillVertical": "Rellenar celdas verticalmentemente"
  },
  "decimal": ",",
  "searchBuilder": {
      "add": "Añadir condición",
      "button": {
          "0": "Constructor de búsqueda",
          "_": "Constructor de búsqueda (%d)"
      },
      "clearAll": "Borrar todo",
      "condition": "Condición",
      "conditions": {
          "date": {
              "after": "Despues",
              "before": "Antes",
              "between": "Entre",
              "empty": "Vacío",
              "equals": "Igual a",
              "notBetween": "No entre",
              "notEmpty": "No Vacio",
              "not": "Diferente de"
          },
          "number": {
              "between": "Entre",
              "empty": "Vacio",
              "equals": "Igual a",
              "gt": "Mayor a",
              "gte": "Mayor o igual a",
              "lt": "Menor que",
              "lte": "Menor o igual que",
              "notBetween": "No entre",
              "notEmpty": "No vacío",
              "not": "Diferente de"
          },
          "string": {
              "contains": "Contiene",
              "empty": "Vacío",
              "endsWith": "Termina en",
              "equals": "Igual a",
              "notEmpty": "No Vacio",
              "startsWith": "Empieza con",
              "not": "Diferente de",
              "notContains": "No Contiene",
              "notStartsWith": "No empieza con",
              "notEndsWith": "No termina con"
          },
          "array": {
              "not": "Diferente de",
              "equals": "Igual",
              "empty": "Vacío",
              "contains": "Contiene",
              "notEmpty": "No Vacío",
              "without": "Sin"
          }
      },
      "data": "Data",
      "deleteTitle": "Eliminar regla de filtrado",
      "leftTitle": "Criterios anulados",
      "logicAnd": "Y",
      "logicOr": "O",
      "rightTitle": "Criterios de sangría",
      "title": {
          "0": "Constructor de búsqueda",
          "_": "Constructor de búsqueda (%d)"
      },
      "value": "Valor"
  },
  "searchPanes": {
      "clearMessage": "Borrar todo",
      "collapse": {
          "0": "Paneles de búsqueda",
          "_": "Paneles de búsqueda (%d)"
      },
      "count": "{total}",
      "countFiltered": "{shown} ({total})",
      "emptyPanes": "Sin paneles de búsqueda",
      "loadMessage": "Cargando paneles de búsqueda",
      "title": "Filtros Activos - %d",
      "showMessage": "Mostrar Todo",
      "collapseMessage": "Colapsar Todo"
  },
  "select": {
      "cells": {
          "1": "1 celda seleccionada",
          "_": "%d celdas seleccionadas"
      },
      "columns": {
          "1": "1 columna seleccionada",
          "_": "%d columnas seleccionadas"
      },
      "rows": {
          "1": "1 fila seleccionada",
          "_": "%d filas seleccionadas"
      }
  },
  "thousands": ".",
  "datetime": {
      "previous": "Anterior",
      "next": "Proximo",
      "hours": "Horas",
      "minutes": "Minutos",
      "seconds": "Segundos",
      "unknown": "-",
      "amPm": [
          "AM",
          "PM"
      ],
      "months": {
          "0": "Enero",
          "1": "Febrero",
          "10": "Noviembre",
          "11": "Diciembre",
          "2": "Marzo",
          "3": "Abril",
          "4": "Mayo",
          "5": "Junio",
          "6": "Julio",
          "7": "Agosto",
          "8": "Septiembre",
          "9": "Octubre"
      },
      "weekdays": [
          "Dom",
          "Lun",
          "Mar",
          "Mie",
          "Jue",
          "Vie",
          "Sab"
      ]
  },
  "editor": {
      "close": "Cerrar",
      "create": {
          "button": "Nuevo",
          "title": "Crear Nuevo Registro",
          "submit": "Crear"
      },
      "edit": {
          "button": "Editar",
          "title": "Editar Registro",
          "submit": "Actualizar"
      },
      "remove": {
          "button": "Eliminar",
          "title": "Eliminar Registro",
          "submit": "Eliminar",
          "confirm": {
              "_": "¿Está seguro que desea eliminar %d filas?",
              "1": "¿Está seguro que desea eliminar 1 fila?"
          }
      },
      "error": {
          "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
      },
      "multi": {
          "title": "Múltiples Valores",
          "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
          "restore": "Deshacer Cambios",
          "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
      }
  },
  "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
  "stateRestore": {
      "creationModal": {
          "button": "Crear",
          "name": "Nombre:",
          "order": "Clasificación",
          "paging": "Paginación",
          "search": "Busqueda",
          "select": "Seleccionar",
          "columns": {
              "search": "Búsqueda de Columna",
              "visible": "Visibilidad de Columna"
          },
          "title": "Crear Nuevo Estado",
          "toggleLabel": "Incluir:"
      },
      "emptyError": "El nombre no puede estar vacio",
      "removeConfirm": "¿Seguro que quiere eliminar este %s?",
      "removeError": "Error al eliminar el registro",
      "removeJoiner": "y",
      "removeSubmit": "Eliminar",
      "renameButton": "Cambiar Nombre",
      "renameLabel": "Nuevo nombre para %s",
      "duplicateError": "Ya existe un Estado con este nombre.",
      "emptyStates": "No hay Estados guardados",
      "removeTitle": "Remover Estado",
      "renameTitle": "Cambiar Nombre Estado"
  }
}
function listar_mantenimiento() {
  tbl_mantenimiento = $('#tabla_mantenimientos').DataTable({
          aoColumns: [
        null,
        null,
        null,
        null,
        null
     ],
        "ordering":true,   
        "bLengthChange":true,
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'print',
            title: 'REPORTE DE LISTADO DE RESPONSABLES',
            //permite imprimir solo las columnas seleccionadas cuando hay numeracion cuenta como 0
            exportOptions: {
              columns: [  1, 2, 3 ]
          },
            className: "pdf fa fa-print",
            customize: function ( win ) {
                $(win.document.body)
                    .css( 'font-size', '10pt' )
                    .prepend(
                      '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                    );

                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( 'font-size', 'inherit' );
            }
        },
        {
          extend: 'csv',
          className: "csv 	fas fa-file-csv",
          
      },
      {
        extend: 'excel',
        className: "excel fas fa-file-excel"
    }
      
      ],
      "ordering": true,
      "pageLength": 10,
      "destroy": true,
      "responsive": true,
      "autoWidth": false,
        "ajax":{
            "url":"../Controller/mantenimiento/controller_mantenimiento.php",
            type:'POST',
            "data": { action: "listar" },

        },
      "columns": [
        {"defaultContent":""},
        { "data": "PLACA" },
        { "data": "TIPO" },
        { "data": "DESCRIPCION" },
        {
            data: "ID",
            render: function (data, type, row) {
                if (data != "") {
                    return `
                        <button class="btn btn-warning" title="Clic para ver Repuestos" 
                                onclick="AbrirModalRepuestos(${data}, '${row.FECHA_PROGRAMADA}', '${row.ID_COMPACTADOR}')">
                            <i class="fa fa-wrench"></i>
                        </button>
                    `;
                }
            },
        }        
        ,
        { "data": "CATEGORIA" },
        { 
            "data": "FECHA_PROGRAMADA",
            "render": function(data, type, row) {
                return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
            }
        },
        {"data":"ESTADO",
            render: function (data, type, row ) {
                if(data=='INACTIVO'){
                    return '<span class="badge bg-danger bg-lg">'+data+'</span>';
                }else{
                    return '<span class="badge bg-success bg-lg">'+data+'</span>';
                }
    
        }
      },
        {"data":null,
			render: function (data, type, row ) {
				       return "<button class='editar btn btn-primary  btn-sm'  type='button' ><i class='fas fa-edit'></i><b>&nbsp;Editar</b></button>";
			
			}
		 }
      ],
      "language":idioma_espanol,
  });
  //Sirve para enumerar las tuplas #
    tbl_mantenimiento.on('draw.td',function(){
      var PageInfo = $("#tabla_mantenimientos").DataTable().page.info();
      tbl_mantenimiento.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
    $('#tabla_mantenimientos').on('click', '.editar', function () {
        var data = tbl_mantenimiento.row($(this).parents('tr')).data(); // Captura los datos de la fila
        if (tbl_mantenimiento.row(this).child.isShown()) { // Maneja el modo responsivo
            data = tbl_mantenimiento.row(this).data();
        }

        $("#modal_editar_mantenimiento").modal('show');
        $("#txt_id_editar").val(data.ID);
        $("#txt_idplaca_editar").val(data.CODIGO);
        $("#txt_idcategoria_editar").val(data.ID_CATEGORIA);
    
        // Llenar el campo de Placa
        $("#cmb_placa_editar").html(
            "<option value=''>" + data.PLACA + "</option>"
        );
    
        // Llenar el campo de Categoría
        $("#cmb_categoria_editar").html(
            "<option value=''>" + data.CATEGORIA + "</option>"
        );
    
        // Convertir la fecha de "YYYY-MM-DD" a "DD/MM/YYYY"
        let fechaFormateada = moment(data.FECHA_PROGRAMADA, "YYYY-MM-DD").format("DD/MM/YYYY");
        document.getElementById('txt_fecha_editar').value = fechaFormateada;
        document.getElementById('txt_descripcion_editar').value = data.DESCRIPCION;
        $("#cbm_estatus").val(data.ESTADO).trigger("change");
       
        // ✅ SELECCIONAR AUTOMÁTICAMENTE EL RADIO BUTTON DEL TIPO DE MANTENIMIENTO
        $("input[name='tipo_editar']").prop("checked", false); // Desmarca todos los radios
        $("input[name='tipo_editar'][value='" + data.TIPO + "']").prop("checked", true).trigger("change");
    });
}
function AbrirModalRegistro(){
  LimpiarCampos();
  combo_placa();
  combo_categoria() 
  $('.form-control').removeClass("is-invalid").removeClass("is-valid");
  $("#modal_registro").modal('show');
}
function LimpiarCampos(){
  $("#cmb_placa_registro").val("");
  $("#cmb_tipo_registro").val("");
  $("#cmb_categoria_registro").val("");
  $("#txt_fecha").val("");
  $("#txt_descripcion").val("");
  $('.form-control').removeClass("is-invalid").removeClass("is-valid");
  
}
function Registrar_Mantenimiento() {
    var placa = $("#cmb_placa_registro").val();
    var tipo = $("input[name='tipo_registro']:checked").val(); // ✅ Obtener el radio seleccionado
    var categoria = $("#cmb_categoria_registro").val();
    var fecha = $("#txt_fecha").val();
    var descripcion = $("#txt_descripcion").val();

    if (!validarCamposFormulario("modal_registro")) {
        return; // No continuar si hay campos vacíos
    }

    $.ajax({
        url: "../Controller/mantenimiento/controller_mantenimiento.php",
        type: 'POST',
        data: { 
            action: "registrar",
            placa: placa,
            tipo: tipo,  
            categoria: categoria,
            fecha: fecha, 
            descripcion: descripcion
        },
        dataType: "json",
        success: function (resp) {
            if (resp.success) {
                LimpiarCampos();
                Swal.fire("Mensaje de Confirmación", "Datos correctamente registrados, <b>nuevo mantenimiento registrado</b>", "success")
                    .then(() => {
                        listar_mantenimiento();
                        $("#modal_registro").modal('hide');
                    });
            } else {
                Swal.fire("Mensaje de Error", "No se pudo completar el registro", "error");
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            Swal.fire("Mensaje de Error", "Error en la conexión con el servidor", "error");
        }
    });
}

function combo_placa() {
    $.ajax({
        url: '../Controller/compactador/controller_combo_placa_listar.php',
        type: 'POST',
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var opciones = "<option value=''>Seleccione una placa</option>"; // Opción por defecto

        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                opciones += `<option value='${data[i].ID_COMPACTADOR}'>${data[i].CODIGO}</option>`;
            }
        } else {
            opciones = "<option value=''>No hay placas</option>";
        }

        // Llenar los select con las opciones
        $("#cmb_placa_registro").html(opciones);
        

    }).fail(function(xhr, status, error) {
        console.error("Error al cargar placas:", error);
    });
}
function combo_categoria() {
    $.ajax({
        url: '../Controller/compactador/controller_combo_categoria_listar.php',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if (data.length > 0) {
                let opciones = "<option value=''>Seleccione una categoría</option>";
                data.forEach(categoria => {
                    opciones += `<option value="${categoria.ID}">${categoria.CATEGORIA}</option>`;
                    if (categoria.CATEGORIA.toUpperCase() === "DESINFECCIÓN") {
                        desinfeccionID = categoria.ID; // Guardamos el ID de DESINFECCIÓN
                    }
                });

                $("#cmb_categoria_registro").html(opciones);
            } else {
                $("#cmb_categoria_registro").html("<option value=''>No se encontraron registros</option>");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error al cargar categorías:", error);
        }
    });
}
function Modificar_Mantenimiento() {
    var id = $("#txt_id_editar").val();
    var idplaca = $("#txt_idplaca_editar").val();
    var idcategoria = $("#txt_idcategoria_editar").val();
    // var tipo = $("input[name='tipo_editar']:checked").val();
    var fecha = $("#txt_fecha_editar").val();
    var descripcion = $("#txt_descripcion_editar").val(); 
    var estatus = $("#cbm_estatus").val(); 

    // 🔥 Convierte fecha "DD/MM/YYYY" a "YYYY-MM-DD"
    var fechaArray = fecha.split("/");
    if (fechaArray.length === 3) {
        fecha = `${fechaArray[2]}-${fechaArray[1]}-${fechaArray[0]}`;
    } else {
        Swal.fire("Mensaje de Error", "Formato de fecha incorrecto", "error");
        return;
    }
    if (!validarCamposFormulario("modal_editar_mantenimiento")) {
        return; // No continuar si hay campos vacíos
    }
    $.ajax({
        url: '../Controller/mantenimiento/controller_mantenimiento.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: "editar",
            id: id,
            idplaca: idplaca,
            // tipo: tipo,
            idcategoria: idcategoria,
            fecha: fecha,
            descripcion: descripcion,
            estatus: estatus
        },
        success: function (resp) {
            if (resp.success) {
                LimpiarCampos();
                Swal.fire("Mensaje de Confirmación", "Datos actualizados correctamente", "success")
                    .then(() => {
                        listar_mantenimiento();
                        $("#modal_editar_mantenimiento").modal('hide');
                    });
            } else {
                Swal.fire("Mensaje de Advertencia", "Error al actualizar los datos", "warning");
            }
        },
        error: function () {
            Swal.fire("Mensaje de Error", "No se pudo completar la actualización", "error");
        }
    });
}
repuestosBD = [];
function listar_repuestos(id_mantenimiento) {
    $('#txt_id_mantenimiento').val(id_mantenimiento);
    $('#tabla_repuestos').DataTable().destroy();

    repuestosBD = []; // 🔥 LIMPIAR la lista en lugar de volver a declararla

    $('#tabla_repuestos').DataTable({
        "pageLength": 4,
        "ajax": {
            "url": "../Controller/repuesto/controller_repuesto.php",
            "type": "POST",
            "data": { action: "listar", id_mantenimiento: id_mantenimiento },
            "dataSrc": function (json) {
                json.data.forEach(repuesto => {
                    repuestosBD.push({
                        producto: repuesto.ID,
                        descripcion: repuesto.DESCRIPCION,
                        cantidad: repuesto.CANTIDAD,
                        fecha: repuesto.FECHA_USO ? moment(repuesto.FECHA_USO, "YYYY-MM-DD").format("DD/MM/YYYY") : ""
                    });
                });
                return json.data;
            }
        },
        "columns": [
            { "data": "DESCRIPCION" },
            { "data": "CANTIDAD" },
            { 
                "data": "FECHA_USO",
                "render": function(data) {
                    return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
                }
            },
            {
                "data": "ID",
                "render": function (data) {
                    return `<button class="btn btn-danger btn-sm" onclick="EliminarRepuesto(${data})"><i class="fa fa-trash"></i></button>`;
                }
            }
        ],
        "language": idioma_espanol
    });
}



function AbrirModalRepuestos(id_mantenimiento, fecha_programada, id_compactador) {
    $("#txt_id_mantenimiento").val(id_mantenimiento);
    $("#txt_id_compactador").val(id_compactador);
    $("#txt_fecha_mante_repuesto").val(fecha_programada ? moment(fecha_programada, "YYYY-MM-DD").format("DD/MM/YYYY") : "");

    repuestosTemp = []; // 🔥 Limpiar la tabla temporal antes de cargar nuevos datos
    actualizarTablaTemporal(); // 🔥 Asegurar que la tabla del modal esté vacía antes de cargar datos

    listar_repuestos(id_mantenimiento); // 🔥 Cargar los repuestos desde la BD y agregarlos a la tabla temp

    $.ajax({
        url: "../Controller/repuesto/controller_repuesto.php",
        type: "POST",
        data: { action: "listar_productos" },
        dataType: "json",
        success: function (response) {
            let opciones = "<option value=''>Seleccione un repuesto</option>";
            response.forEach(producto => {
                opciones += `<option value="${producto.PRODUCTO}">${producto.DESCRIPCION}</option>`;
            });
            $("#cmb_repuesto").html(opciones);
        },
        error: function () {
            Swal.fire("Error", "No se pudieron cargar los repuestos disponibles", "error");
        }
    });

    $("#modal_repuesto").modal("show");

    setTimeout(() => {
        $('#tabla_repuestos').DataTable().columns.adjust().draw();
    }, 500);
}

function agregarRepuestoATabla() {
    let producto = $("#cmb_repuesto").val();
    let descripcion = $("#cmb_repuesto option:selected").text();
    let cantidad = $("#txt_cantidad").val();

    // Obtener solo la fecha del mantenimiento sin modificar el campo
    let fecha_programada = $("#txt_fecha_mante_repuesto").val(); 

    if (!producto || cantidad <= 0) {
        return Swal.fire("Mensaje de Advertencia", "Complete todos los campos", "warning");
    }

    // Verificar si el repuesto ya está en la tabla temporal
    let existe = repuestosTemp.some(item => item.producto === producto);
    if (existe) {
        return Swal.fire("Mensaje de Advertencia", "Este repuesto ya ha sido agregado", "warning");
    }

    // Agregar repuesto al array temporal con la fecha programada
    repuestosTemp.push({ producto, descripcion, cantidad, fecha: fecha_programada });

    // Limpiar el campo de cantidad después de agregar
    $("#txt_cantidad").val("");
    $("#cmb_repuesto").val("").trigger("change");

    // Actualizar la tabla del modal
    actualizarTablaTemporal();
}


// Función para actualizar la tabla del modal con la fecha incluida
function actualizarTablaTemporal() {
    let tbody = $("#tabla_repuestos tbody");
    tbody.empty();

    repuestosTemp.forEach((item, index) => {
        tbody.append(`
            <tr>
                <td>${item.descripcion}</td>
                <td>${item.cantidad}</td>
                <td>${item.fecha}</td> <!-- 🔥 Agregar la fecha aquí -->
                <td>
                    <button class="btn btn-danger btn-sm" onclick="eliminarRepuestoTemp(${index})">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        `);
    });
}


// Función para eliminar un repuesto de la tabla temporal
function eliminarRepuestoTemp(index) {
    repuestosTemp.splice(index, 1);
    actualizarTablaTemporal();
}

function guardarRepuestosBD() {
    let id_mantenimiento = $("#txt_id_mantenimiento").val();
    let id_compactador = $("#txt_id_compactador").val();
    if (repuestosTemp.length === 0) {
        return Swal.fire("Mensaje de Advertencia", "No hay repuestos para guardar", "warning");
    }

    // Enviar la fecha programada con cada repuesto
    let fecha_programada = $("#txt_fecha_mante_repuesto").val();
    repuestosTemp.forEach(item => {
        item.fecha = fecha_programada; // Agregar la fecha programada a cada repuesto
    });

    $.ajax({
        url: "../Controller/repuesto/controller_repuesto.php",
        type: "POST",
        data: {
            action: "registrar_todos",
            id_mantenimiento: id_mantenimiento,
            id_compactador:id_compactador,
            repuestos: JSON.stringify(repuestosTemp)
        },
        success: function (response) {
            let resp = JSON.parse(response);
            if (resp.success) {
                Swal.fire("Éxito", "Repuestos guardados correctamente", "success");
                repuestosTemp = []; // Limpiar la tabla temporal
                $("#txt_cantidad").val(""); // Limpiar campo de cantidad
                $("#modal_repuesto").modal("hide");
                listar_repuestos(id_mantenimiento); // Recargar la tabla desde la BD
            } else {
                Swal.fire("Error", "No se pudieron guardar los repuestos", "error");
            }
        },
        error: function () {
            Swal.fire("Error", "Problema en la conexión con el servidor", "error");
        }
    });
}

function EliminarRepuesto(id_repuesto) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Una vez eliminado, no podrás recuperarlo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../Controller/repuesto/controller_repuesto.php",
                type: "POST",
                data: { action: "eliminar", id_repuesto: id_repuesto },
                success: function (response) {
                    let resp = JSON.parse(response);
                    if (resp.success) {
                        Swal.fire("Eliminado", "El repuesto ha sido eliminado", "success");
                        $('#tabla_repuestos').DataTable().ajax.reload(); // Recargar la tabla
                    } else {
                        Swal.fire("Error", "No se pudo eliminar el repuesto", "error");
                    }
                },
                error: function () {
                    Swal.fire("Error", "Problema en la conexión con el servidor", "error");
                }
            });
        }
    });
}

function mostrarBotonVerCambios() {
    let placaSeleccionada = $("#cmb_placa_registro").val();
    if (placaSeleccionada) {
        $("#btn_ver_cambios").show();
    } else {
        $("#btn_ver_cambios").hide();
    }
}
function verCambiosPlaca() {
    let id_compactador = $("#cmb_placa_registro").val(); 

    if (!id_compactador) {
        Swal.fire("Advertencia", "Debe seleccionar una placa", "warning");
        return;
    }

    // Destruir DataTable si ya está inicializado para evitar errores
    if ($.fn.DataTable.isDataTable("#tabla_cambios_placa")) {
        $("#tabla_cambios_placa").DataTable().destroy();
    }

    // Llamada AJAX para obtener los cambios de la placa
    $.ajax({
        url: "../Controller/repuesto/controller_repuesto.php",
        type: "POST",
        data: { action: "frecuencia_repuestos", id_compactador: id_compactador },
        dataType: "json",
        success: function(response) {
            // Inicializar DataTable con los nuevos datos
            $("#tabla_cambios_placa").DataTable({
                "data": response,
                "destroy": true,  // Permite volver a inicializar sin problemas
                "responsive": true,
                "autoWidth": false,
                "pageLength": 5,
                "order": [[2, "desc"]], // Ordenar por frecuencia de cambio
                "columns": [
                    { "data": "PRODUCTO", "title": "Producto" },
                    { "data": "NOMBRE_PRODUCTO", "title": "Descripción" },
                    { "data": "TOTAL_CANTIDAD", "title": "Cantidad" },
                    { "data": "FRECUENCIA_CAMBIO", "title": "Frecuencia de Cambio" },
                    { 
                        "data": "ULTIMO_USO",
                        "render": function(data, type, row) {
                            return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
                        }
                    }
                ],
                "language":idioma_espanol,
            });

            // Mostrar el modal después de cargar los datos
            $("#modal_ver_cambios").modal("show");
        },
        error: function() {
            Swal.fire("Error", "No se pudieron obtener los cambios de la placa", "error");
        }
    });
}
