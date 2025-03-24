$(document).ready(function () {
    listar_asignaciones();
    cargarCompactadores();
    cargarEmpleados();
    cargarRutas();
    combo_placa();
});
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

window.empleadosSeleccionados = window.empleadosSeleccionados || [];


function listar_asignaciones() {
    let tabla = $('#tabla_asignaciones').DataTable({
        "destroy": true,
        "ajax": {
            "url": "../Controller/asignacion/controller_asignacion.php",
            "type": "POST",
            "data": { action: "listar" },
            "dataType": "json",
            "dataSrc": function(json) {
                return json.data.map(asignacion => ({
                    ...asignacion,
                    EMPLEADOS: asignacion.EMPLEADOS ? asignacion.EMPLEADOS : [] // Siempre inicializa EMPLEADOS
                }));
            }
        },
        "columns": [
            {
                "className": 'dt-control',
                "orderable": false,
                "data": null,
                "defaultContent": '<button class="btn btn-sm btn-info toggle-row"><i class="fas fa-eye"></i></button>'
            },
            { "data": "COMPACTADOR" },
            { 
                "data": "FECHA_INICIO",
                "render": function(data) {
                    return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
                }
            },
            { 
                "data": "FECHA_FIN",
                "render": function(data) {
                    return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
                }
            },
            { "data": "TURNO" },
            { "data": "RUTA" },
            {
                "data": "ESTADO",
                "render": function(data) {
                    let badgeClass = data === 'FINALIZADO' ? 'danger' : 'success';
                    return `<span class="badge bg-${badgeClass}">${data}</span>`;
                }
            }
            
        ],
        "language": idioma_espanol
    });

    // Expandir fila al hacer clic en el botón de ojo
    $('#tabla_asignaciones tbody').on('click', '.toggle-row', function (event) {
        event.stopPropagation();
        let tr = $(this).closest('tr');
        let row = tabla.row(tr);
        toggleRow(row, tr);
    });

    // Expandir fila al hacer clic en cualquier parte de la fila
    $('#tabla_asignaciones tbody').on('click', 'tr', function () {
        let tr = $(this);
        let row = tabla.row(tr);
        toggleRow(row, tr);
    });

    // Función para expandir/contraer la fila y mostrar empleados con cargos
    function toggleRow(row, tr) {
        let data = row.data();

        if (!data || !Array.isArray(data.EMPLEADOS)) {
            return;
        }

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            let empleadosHtml = data.EMPLEADOS.length > 0
                ? data.EMPLEADOS.map(emp => `<tr><td>${emp.nombre}</td><td>${emp.cargo}</td></tr>`).join('')
                : "<tr><td colspan='2'>No hay empleados asignados</td></tr>";

            let detalle = `
                <div>
                    <strong>Empleados Asignados:</strong>
                    <table class="table table-bordered mt-1">
                        <thead>
                            <tr><th>Nombre</th><th>Cargo</th></tr>
                        </thead>
                        <tbody>${empleadosHtml}</tbody>
                    </table>
                </div>`;

            row.child(detalle).show();
            tr.addClass('shown');
        }
    }
}
function cambiarEstado(id, estado) {
    $.post("../Controller/controller_asignacion.php", { action: "actualizar_estado", idAsignacion: id, estado: estado, usuario: "admin" }, function (resp) {
        let data = JSON.parse(resp);
        if (data.success) {
            alert("Estado actualizado");
            listar_asignaciones();
        }
    });
}

function eliminarAsignacion(id) {
    if (confirm("¿Seguro que deseas eliminar esta asignación?")) {
        $.post("../Controller/controller_asignacion.php", { action: "eliminar", idAsignacion: id }, function (resp) {
            let data = JSON.parse(resp);
            if (data.success) {
                alert("Asignación eliminada");
                listar_asignaciones();
            }
        });
    }
}

function AbrirModalRegistroAsignacion(){
    // LimpiarCampos();
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_asignacion").modal('show');
  }
  function validarPaso(step) {
    let isValid = true;

    if (step === 1) {
        // Validar selección de Compactador
        if (!$("#select_compactador").val()) {
            $("#select_compactador").addClass("is-invalid").removeClass("is-valid");
            isValid = false;
        } else {
            $("#select_compactador").addClass("is-valid").removeClass("is-invalid");
        }
    } 
    else if (step === 2) {
        // Validar que haya al menos un empleado seleccionado
        if (empleadosSeleccionados.length === 0) {
            $("#select_empleados").addClass("is-invalid").removeClass("is-valid");
            isValid = false;
            Swal.fire("Error", "Debe seleccionar al menos un empleado", "error");
        } else {
            $("#select_empleados").addClass("is-valid").removeClass("is-invalid");
        }
    } 
    else if (step === 3) {
        // Validar fechas, turno y ruta
        if (!$("#txt_fecha_desde").val()) {
            $("#txt_fecha_desde").addClass("is-invalid").removeClass("is-valid");
            isValid = false;
        } else {
            $("#txt_fecha_desde").addClass("is-valid").removeClass("is-invalid");
        }

        if (!$("#txt_fecha_hasta").val()) {
            $("#txt_fecha_hasta").addClass("is-invalid").removeClass("is-valid");
            isValid = false;
        } else {
            $("#txt_fecha_hasta").addClass("is-valid").removeClass("is-invalid");
        }

        if (!$("#turno").val()) {
            $("#turno").addClass("is-invalid").removeClass("is-valid");
            isValid = false;
        } else {
            $("#turno").addClass("is-valid").removeClass("is-invalid");
        }

        if (!$("#ruta").val()) {
            $("#ruta").addClass("is-invalid").removeClass("is-valid");
            isValid = false;
        } else {
            $("#ruta").addClass("is-valid").removeClass("is-invalid");
        }
    }

    return isValid;
}

function nextStep(currentStep) {
    if (!validarPaso(currentStep)) {
        Swal.fire("Error", "Complete los campos requeridos antes de avanzar", "error");
        return;
    }

    $("#step" + currentStep).addClass("d-none");
    $("#step" + (currentStep + 1)).removeClass("d-none");

    if (currentStep === 2) {
        actualizarConfirmacion();
    }
}

function prevStep(currentStep) {
    $("#step" + currentStep).addClass("d-none");
    $("#step" + (currentStep - 1)).removeClass("d-none");
}

function actualizarConfirmacion() {
    $("#confirm_empleados").empty(); // Limpiar la tabla antes de actualizar

    if (empleadosSeleccionados.length === 0) {
        $("#confirm_empleados").append("<tr><td colspan='2'>No hay empleados seleccionados</td></tr>");
    } else {
        empleadosSeleccionados.forEach(emp => {
            $("#confirm_empleados").append(`
                <tr>
                    <td>${emp.nombre ? emp.nombre : "Nombre no disponible"}</td>
                    <td>${emp.cargo ? emp.cargo : "Cargo no disponible"}</td>
                </tr>
            `);
        });
    }

    // También actualizar el compactador seleccionado
    let compactadorNombre = $("#select_compactador option:selected").text();
    $("#confirm_compactador").text(compactadorNombre ? compactadorNombre : "No seleccionado");
}
function cargarCompactadores() {
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
        $("#select_compactador").html(opciones);
        

    }).fail(function(xhr, status, error) {
        console.error("Error al cargar placas:", error);
    });
}
function cargarRutas() {
    $.post("../Controller/rutas/controller_rutas.php", { action: "listar" }, function (response) {
        let json = JSON.parse(response);
        let select = $("#ruta");

        select.empty();  // Limpiar opciones previas
        select.append('<option value="" selected disabled>Seleccione una Ruta</option>');

        json.data.forEach(function (ruta) {
            select.append(`<option value="${ruta.ID_RUTA}">${ruta.NOMBRE}</option>`);
        });

        // Volver a aplicar select2 para mejor presentación
        $(".select2").select2();
    });
}
function cargarEmpleados() {
    $.ajax({
        url: '../Controller/empleado/controller_combo_empleados_listar.php',
        type: 'POST',
        dataType: 'json',  // Asegurar que el tipo de respuesta es JSON
        success: function(resp) {
            let opciones = "<option value=''>Seleccione un empleado</option>";
            resp.forEach(emp => {
                opciones += `<option value="${emp.PERSONA}" data-cargo="${emp.CARGO}">${emp.NOMBRE_COMPLETO} - ${emp.CARGO}</option>`;
            });
            

            $("#select_empleados").html(opciones);
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar empleados:", error);
        }
    });
}
function agregarEmpleado() {
    let select = $("#select_empleados");
    let empleadoID = select.val();
    let empleadoNombre = $("#select_empleados option:selected").text();
    let empleadoCargo = $("#select_empleados option:selected").data("cargo"); // Obtener el cargo

    if (!empleadoID || empleadosSeleccionados.some(e => e.id === empleadoID)) {
        // alert("Debe seleccionar un empleado válido o evitar duplicados.");
        return;
    }

    // Asegurar que el objeto tenga las claves correctas
    let empleado = {
        id: empleadoID,
        nombre: empleadoNombre,
        cargo: empleadoCargo ? empleadoCargo : "Sin cargo" // Evitar undefined
    };

    // Agregar empleado al array
    empleadosSeleccionados.push(empleado);

    // Agregar fila a la tabla del Paso 2
    $("#empleados_seleccionados").append(`
        <tr id="empleado_${empleadoID}">
            <td>${empleadoNombre}</td>
            <td>${empleadoCargo ? empleadoCargo : "Sin cargo"}</td>
            <td><button class="btn btn-danger btn-sm" onclick="eliminarEmpleado('${empleadoID}')">Eliminar</button></td>
        </tr>
    `);
}
function eliminarEmpleado(empleadoID) {
    // Remover del array
    empleadosSeleccionados = empleadosSeleccionados.filter(emp => emp.id !== empleadoID);
    
    // Remover la fila de la tabla
    $(`#empleado_${empleadoID}`).remove();
}
function formatearFecha(fecha) {
    let partes = fecha.split("/");
    return `${partes[2]}-${partes[1]}-${partes[0]}`; // Formato YYYY-MM-DD
}
function guardarAsignacion() {
    if (!ValidacionInput()) {
        Swal.fire("Error", "Todos los campos marcados son obligatorios", "error");
        return;
    }

    let compactadorID = $("#select_compactador").val();
    let fechaInicio = formatearFecha($("#txt_fecha_desde").val());
    let fechaFin = formatearFecha($("#txt_fecha_hasta").val());
    let turno = $("#turno").val();
    let ruta = $("#ruta").val();

    $.ajax({
        url: "../Controller/asignacion/controller_asignacion.php",
        type: "POST",
        data: {
            action: "registrar",
            compactadorID: compactadorID,
            personas: JSON.stringify(empleadosSeleccionados),
            fechaInicio: fechaInicio,
            fechaFin: fechaFin,
            turno: turno,
            ruta: ruta,
            usuario: "ADMIN"
        },
        dataType: "json",
        success: function (resp) {
            if (resp.success) {
                Swal.fire("Mensaje de Confirmación", "Asignación guardada con éxito", "success")
                .then(() => {
                    listar_asignaciones();
                    setTimeout(() => {
                        RestaurarModalAsignacion(); // Restaurar los campos
                        $("#modal_registro_asignacion").modal('hide');
                    }, 100);
                });
            } else {
                Swal.fire("Error", "Hubo un problema al guardar la asignación", "error");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error AJAX:", error);
            Swal.fire("Error", "Error en la comunicación con el servidor", "error");
        }
    });
}
function ValidacionInput() {
    let isValid = true; // Bandera para saber si el formulario es válido

    // Validar Compactador
    if (!$("#select_compactador").val()) {
        $("#select_compactador").addClass("is-invalid").removeClass("is-valid");
        isValid = false;
    } else {
        $("#select_compactador").addClass("is-valid").removeClass("is-invalid");
    }

    // Validar Empleados Seleccionados
    if (empleadosSeleccionados.length === 0) {
        $("#select_empleados").addClass("is-invalid").removeClass("is-valid");
        isValid = false;
    } else {
        $("#select_empleados").addClass("is-valid").removeClass("is-invalid");
    }

    // Validar Fechas
    if (!$("#txt_fecha_desde").val()) {
        $("#txt_fecha_desde").addClass("is-invalid").removeClass("is-valid");
        isValid = false;
    } else {
        $("#txt_fecha_desde").addClass("is-valid").removeClass("is-invalid");
    }

    if (!$("#txt_fecha_hasta").val()) {
        $("#txt_fecha_hasta").addClass("is-invalid").removeClass("is-valid");
        isValid = false;
    } else {
        $("#txt_fecha_hasta").addClass("is-valid").removeClass("is-invalid");
    }

    // Validar Turno
    if (!$("#turno").val()) {
        $("#turno").addClass("is-invalid").removeClass("is-valid");
        isValid = false;
    } else {
        $("#turno").addClass("is-valid").removeClass("is-invalid");
    }

    // Validar Ruta
    if (!$("#ruta").val()) {
        $("#ruta").addClass("is-invalid").removeClass("is-valid");
        isValid = false;
    } else {
        $("#ruta").addClass("is-valid").removeClass("is-invalid");
    }

    return isValid;
}
function RestaurarModalAsignacion() {
    // Reiniciar el paso al inicio
    $(".step").addClass("d-none"); 
    $("#step1").removeClass("d-none");

    // Limpiar selects
    $("#select_compactador").val("").trigger('change');
    $("#select_empleados").val("").trigger('change');
    $("#turno").val("").trigger('change');
    $("#ruta").val("").trigger('change');

    // Limpiar inputs de fecha
    $("#txt_fecha_desde").val("");
    $("#txt_fecha_hasta").val("");

    // Limpiar la tabla de empleados seleccionados
    $("#empleados_seleccionados").empty();
    $("#confirm_empleados").empty();

    // Restablecer la lista de empleados seleccionados
    empleadosSeleccionados = [];

    // Limpiar el campo de confirmación de compactador
    $("#confirm_compactador").text("");

    // Remover clases de validación
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
}
function generarReporte() {
    let mes = document.getElementById("select_mes").value;
    let compactador = document.getElementById("select_compactador_rep").value;
    
    // Si compactador está vacío, enviamos una cadena vacía en la URL
    window.open(`../Controller/reportes/controller_reporte_asignaciones.php?mes=${mes}&compactador=${compactador}`, '_blank');
}


function combo_placa() {
    $.ajax({
        url: '../Controller/compactador/controller_combo_placa_listar.php',
        type: 'POST',
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var opciones = "<option value=''>TODOS</option>"; // Opción por defecto

        if (data.length > 0) {
            for (var i = 0; i < data.length; i++) {
                opciones += `<option value='${data[i].ID_COMPACTADOR}'>${data[i].CODIGO}</option>`;
            }
        } else {
            opciones = "<option value=''>No hay placas</option>";
        }

        // Llenar los select con las opciones
        $("#select_compactador_rep").html(opciones);
        

    }).fail(function(xhr, status, error) {
        console.error("Error al cargar placas:", error);
    });
}