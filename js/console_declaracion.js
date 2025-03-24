$(document).ready(function () {
    $(".select2").select2();
    listar_declaraciones();
    cargarEmpleados();
    combo_placa();
    cargarTotalMesActual();
    $("#select_empleados").on("change", function () {
        let dniSeleccionado = $("#select_empleados option:selected").data("dni");
        $("#txt_dni").val(dniSeleccionado ? dniSeleccionado : ""); // Si el DNI existe, lo llena; si no, lo deja vacío
        let breveteSeleccionado = $("#select_empleados option:selected").data("brevete");
        $("#txt_brevete").val(breveteSeleccionado ? breveteSeleccionado : ""); 

    });
    // Evento para actualizar DNI y brevete en el formulario de edición
    $("#edit_select_empleados").on("change", function () {
        let dniSeleccionado = $("#edit_select_empleados option:selected").data("dni");
        $("#edit_txt_dni").val(dniSeleccionado ? dniSeleccionado : "");
        let breveteSeleccionado = $("#edit_select_empleados option:selected").data("brevete");
        $("#edit_txt_brevete").val(breveteSeleccionado ? breveteSeleccionado : "");
    });

    // 🟢 Evento para calcular la cantidad transportada en el formulario de REGISTRO
    $("#txt_peso_ingreso, #txt_peso_salida").on("input", function () {
        calcularCantidadTransportada("#txt_peso_ingreso", "#txt_peso_salida", "#txt_cantidad");
    });

    // 🟢 Evento para calcular la cantidad transportada en el formulario de EDICIÓN
    $("#edit_txt_peso_ingreso, #edit_txt_peso_salida").on("input", function () {
        calcularCantidadTransportada("#edit_txt_peso_ingreso", "#edit_txt_peso_salida", "#edit_txt_cantidad");
    });

    // 🔹 Función para calcular la cantidad transportada
    function calcularCantidadTransportada(inputIngreso, inputSalida, inputCantidad) {
        let pesoIngreso = parseFloat($(inputIngreso).val()) || 0;
        let pesoSalida = parseFloat($(inputSalida).val()) || 0;
        let cantidadTransportada = pesoIngreso - pesoSalida;
        $(inputCantidad).val(cantidadTransportada.toFixed(2)); // Mostrar con 2 decimales
    }
    $('#txt_fecha').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        // minDate: moment(),
        icons: {
            time: "far fa-clock",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    $('#edit_txt_fecha').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        // minDate: moment(),
        icons: {
            time: "far fa-clock",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    $("#txt_peso_ingreso, #txt_peso_salida").on("input", function () {
        calcularCantidadTransportada();
    });
    $('#grupo_fecha_inicio, #grupo_fecha_fin').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        icons: {
          time: 'far fa-clock',
          date: 'fa fa-calendar',
          up: 'fa fa-arrow-up',
          down: 'fa fa-arrow-down'
        }
      });
   // Evento: Actualizar la fecha mínima de "Fecha Hasta" cuando se seleccione "Fecha Desde"
    $("#grupo_fecha_inicio").on("change.datetimepicker", function (e) {
        let fechaDesde = e.date ? e.date.clone().startOf('day') : null;
        $('#grupo_fecha_fin').datetimepicker('minDate', fechaDesde);
    });

    // Evento: Validar que "Fecha Hasta" no sea menor que "Fecha Desde"
    $("#grupo_fecha_fin").on("change.datetimepicker", function (e) {
        let fechaDesde = $("#grupo_fecha_inicio").val();
        let fechaHasta = e.date ? e.date.format('DD/MM/YYYY') : null;

        if (fechaDesde && fechaHasta && moment(fechaHasta, 'DD/MM/YYYY').isBefore(moment(fechaDesde, 'DD/MM/YYYY'))) {
            Swal.fire("Error", "La fecha hasta no puede ser menor que la fecha desde", "error");
            $("#grupo_fecha_fin").val(""); // Limpiar el campo inválido
        }
    });
        
});

// 🔹 REGISTRAR DECLARACIÓN JURADA
function Registrar_Declaracion() {
    let chofer = $("#select_empleados").val();
    let dni = $("#txt_dni").val();
    let breve_nro = $("#txt_brevete").val();
    let placa = $("#cmb_placa_registro").val();
    let fecha = $("#txt_fecha").val();
    let hora_ingreso = $("#txt_hora_ingreso").val();
    let hora_salida = $("#txt_hora_salida").val();
    let peso_ingreso = $("#txt_peso_ingreso").val();
    let peso_salida = $("#txt_peso_salida").val();
    let cantidad = $("#txt_cantidad").val();
    let observaciones = $("#txt_observaciones").val();
    let archivo = $("#archivo_documento")[0].files[0];

    if (!validarCamposFormulario("modal_registro")) {
        return; // No continuar si hay campos vacíos
    }

    let formData = new FormData();
    formData.append("action", "registrar");
    formData.append("chofer", chofer);
    formData.append("dni", dni);
    formData.append("breve_nro", breve_nro);
    formData.append("placa", placa);
    formData.append("fecha", fecha);
    formData.append("hora_ingreso", hora_ingreso);
    formData.append("hora_salida", hora_salida);
    formData.append("peso_ingreso", peso_ingreso);
    formData.append("peso_salida", peso_salida);
    formData.append("cantidad", cantidad);
    formData.append("observaciones", observaciones);
    formData.append("archivo", archivo);

    $.ajax({
        url: "../Controller/declaracion/controller_declaracion.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (resp) {
            if (resp.success) {
                Swal.fire("Éxito", "Declaración registrada con éxito", "success");
                listar_declaraciones();
                $("#modal_registro").modal("hide");
                limpiarFormularioRegistro();
            } else {
                Swal.fire("Error", resp.error || "Error al registrar la declaración", "error");
            }
        },
        error: function () {
            Swal.fire("Error", "Error en la conexión con el servidor", "error");
        }
    });
}
// 🧹 Función para limpiar el formulario después del registro
function limpiarFormularioRegistro() {
    $("#form_registro")[0].reset();
    $("#select_empleados").val("").trigger("change");
    $("#cmb_placa_registro").val("").trigger("change");
}

// 🔍 LISTAR DECLARACIONES
var tbl_declaraciones;
function listar_declaraciones() {
    tbl_declaraciones = $('#tabla_declaraciones').DataTable({
        ordering: true,
        pageLength: 10,
        destroy: true,
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "../Controller/declaracion/controller_declaracion.php",
            type: "POST",
            data: { action: "listar" },
            dataSrc: "data"
        },
        columns: [
            { defaultContent: "" },
            { data: "CHOFER" },
            { data: "PLACA" },
            { data: "DNI" },
            { data: "PESO_NETO" },
            { 
                "data": "FECHA",
                "render": function(data, type, row) {
                    return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
                }
            },
            { 
                data: "ESTADO",
                render: function (data, type, row) {
                    return data === "ERROR PESO" 
                        ? '<span class="badge bg-danger">ERROR PESO</span>' 
                        : '<span class="badge bg-success">CORRECTO</span>';
                }
            },
            {
                data: "RUTA_ARCHIVO",
                render: function (data, type, row) {
                    if (data != "") {
                        return (
                            '<button class="btn btn-danger btn-sm" title="Ver Archivo" onclick="verarchivo(\'' + row.ID_DECLARACION + '\', \'' + row.RUTA_ARCHIVO + '\')"> <i class="fa fa-file"></i> </button>'
                        );
                    }
                    return "";
                },
            },
            { 
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class='btn btn-warning btn-sm' title='Editar' onclick='abrirModalEditar(${JSON.stringify(row)})'>
                            <i class='fas fa-edit'></i> Editar
                        </button>
                    `;
                }
            }
        ],
        language: idioma_espanol
    });
  //Sirve para enumerar las tuplas #
  tbl_declaraciones.on('draw.td',function(){
    var PageInfo = $("#tabla_declaraciones").DataTable().page.info();
    tbl_declaraciones.column(0, {page: 'current'}).nodes().each(function(cell, i){
      cell.innerHTML = i + 1 + PageInfo.start;
    });
  });
    $('#tabla_declaraciones').on('click', '.eliminar', function () {
        var data = $('#tabla_declaraciones').DataTable().row($(this).parents('tr')).data();

        Swal.fire({
            title: "¿Estás seguro?",
            text: "Esta acción no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "../Controller/declaracion/controller_declaracion.php",
                    type: "POST",
                    data: { action: "eliminar", id: data.ID_DECLARACION },
                    dataType: "json",
                    success: function (resp) {
                        if (resp.success) {
                            Swal.fire("Eliminado", "Registro eliminado con éxito", "success");
                            listar_declaraciones();
                        } else {
                            Swal.fire("Error", "No se pudo eliminar el registro", "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error", "Error en la conexión con el servidor", "error");
                    }
                });
            }
        });
    });
}
function cargarEmpleados() {
    $.ajax({
        url: '../Controller/empleado/controller_combo_empleados_listar.php',
        type: 'POST',
        dataType: 'json', 
        success: function(resp) {
            let opciones = "<option value=''>Seleccione un empleado</option>";
            resp.forEach(emp => {
                opciones += `<option value="${emp.PERSONA}" data-cargo="${emp.CARGO}" data-dni="${emp.NRO_DOC}" data-brevete="${emp.BREVETE}">
                                ${emp.NOMBRE_COMPLETO} - ${emp.CARGO}
                             </option>`;
            });

            $("#select_empleados").html(opciones);
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar empleados:", error);
        }
    });
}
function calcularCantidadTransportada() {
    let pesoIngreso = parseFloat($("#txt_peso_ingreso").val()) || 0;
    let pesoSalida = parseFloat($("#txt_peso_salida").val()) || 0;
    
    let cantidadTransportada = pesoIngreso - pesoSalida;

    // Si la cantidad es negativa, colocar 0
    $("#txt_cantidad").val(cantidadTransportada >= 0 ? cantidadTransportada : 0);
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
function verarchivo(id, archivo) {
    $("#modal_archivo_ver_declaracion").modal("show");
    $("#lb_nombrearchivo").text(id);
    $("#div_pdf").html(
      '<object data="../Controller/declaracion/uploads/declaracionesjuradas/' +
        archivo +
        '" type="application/pdf" style="width: 100%; height: 100%; min-height: 750px;"></object>'
    );
}
// 🔍 Abrir Modal de Edición con Datos del Row
function abrirModalEditar(data) {
    $("#modal_editar").modal("show");
    $("#edit_id_declaracion").val(data.ID_DECLARACION);
    // $("#edit_select_empleados").val(data.CHOFER).trigger("change");
    $("#edit_select_empleados").html(`<option value="${data.CHOFER}">${data.CHOFER}</option>`);
    $("#edit_txt_dni").val(data.DNI);
    $("#edit_txt_brevete").val(data.BREVE_NRO); // No está en el row, ajustar si es necesario
    // $("#edit_cmb_placa").val(data.PLACA).trigger("change");
    $("#edit_cmb_placa").html(`<option value="${data.ID_COMPACTADOR}">${data.PLACA}</option>`);
    let fechaFormateada = moment(data.FECHA, "YYYY-MM-DD").format("DD/MM/YYYY");
    $("#edit_txt_fecha").val(fechaFormateada);
    $("#edit_txt_hora_ingreso").val(formatearHora(data.HORA_INGRESO));
    $("#edit_txt_hora_salida").val(formatearHora(data.HORA_SALIDA));
    $("#edit_txt_peso_ingreso").val(data.PESO_INGRESO);
    $("#edit_txt_peso_salida").val(data.PESO_SALIDA);
    $("#edit_txt_cantidad").val(data.PESO_NETO);
    $("#edit_txt_observaciones").val(data.OBSERVACIONES);
    if (data.RUTA_ARCHIVO && data.RUTA_ARCHIVO !== "") {
        let rutaArchivo = `../Controller/declaracion/uploads/declaracionesjuradas/${data.RUTA_ARCHIVO}`; 
        $("#archivo_actual").html(
            `<a href="${rutaArchivo}" target="_blank" class="btn btn-sm btn-primary">Ver Documento Actual</a>
            <input type="hidden" id="edit_archivo_actual" name="archivo_actual" value="${data.RUTA_ARCHIVO}">`
        );

        // Mostrar nombre del archivo al costado del input file
        $("#nombre_archivo_actual").text(`Archivo actual: ${data.RUTA_ARCHIVO}`);
    } else {
        $("#archivo_actual").html(`<p class="text-muted">No hay documento adjunto.</p>`);
        $("#nombre_archivo_actual").text("");
    }

}
function formatearHora(hora) {
    if (!hora) return ""; // Evita errores si el valor es null o undefined
    return hora.substring(0, 5); // Extrae solo HH:mm de HH:mm:ss
}
// 🔄 Editar Declaración Jurada
function Editar_Declaracion() {
    let id_declaracion = $("#edit_id_declaracion").val();
    let chofer = $("#edit_select_empleados").val();
    let dni = $("#edit_txt_dni").val();
    let breve_nro = $("#edit_txt_brevete").val();
    let placa = $("#edit_cmb_placa").val();
    let fecha = $("#edit_txt_fecha").val();
    let hora_ingreso = $("#edit_txt_hora_ingreso").val();
    let hora_salida = $("#edit_txt_hora_salida").val();
    let peso_ingreso = $("#edit_txt_peso_ingreso").val();
    let peso_salida = $("#edit_txt_peso_salida").val();
    let cantidad = $("#edit_txt_cantidad").val();
    let observaciones = $("#edit_txt_observaciones").val();
    let archivo = $("#edit_archivo_documento")[0].files[0];
    let archivo_actual = $("#edit_archivo_actual").val(); // Campo oculto con el archivo actual


    if (!validarCamposFormulario("modal_editar")) {
        return; // No continuar si hay campos vacíos
    }
    let formData = new FormData();
    formData.append("action", "editar");
    formData.append("id_declaracion", id_declaracion);
    formData.append("chofer", chofer);
    formData.append("dni", dni);
    formData.append("breve_nro", breve_nro);
    formData.append("placa", placa);
    formData.append("fecha", fecha);
    formData.append("hora_ingreso", hora_ingreso);
    formData.append("hora_salida", hora_salida);
    formData.append("peso_ingreso", peso_ingreso);
    formData.append("peso_salida", peso_salida);
    formData.append("cantidad", cantidad);
    formData.append("observaciones", observaciones);
    formData.append("archivo_actual", archivo_actual); // Enviar la ruta del archivo actual

    // Si el usuario sube un nuevo archivo, lo agregamos
    if (archivo) {
        formData.append("archivo", archivo);
    }

    $.ajax({
        url: "../Controller/declaracion/controller_declaracion.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (resp) {
            if (resp.success) {
                Swal.fire("Éxito", "Declaración actualizada con éxito", "success");
                listar_declaraciones();
                $("#modal_editar").modal("hide");
            } else {
                Swal.fire("Error", resp.error || "Error al actualizar la declaración", "error");
            }
        },
        error: function () {
            Swal.fire("Error", "Error en la conexión con el servidor", "error");
        }
    });
}
function obtenerNombreMesActual() {
  const meses = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
  ];
  const hoy = new Date();
  return meses[hoy.getMonth()];
}
function cargarTotalMesActual() {
  $.ajax({
    url: "../Controller/declaracion/controller_declaracion.php",
    type: "POST",
    data: { action: "contar_mes_actual" },
    dataType: "json",
    success: function (resp) {
      $("#cargas_haquira").html(`<b>${resp.total}</b>`);
      const mesActual = obtenerNombreMesActual();
      $("#texto_mes_haquira").text(`Cargas a Haquira durante el mes de ${mesActual}`);
    },
    error: function () {
      console.error("Error al obtener total del mes actual.");
    }
  });
}
function reporteDeclaracionesEntreFechas() {
    let inicio = $("#fecha_inicio_reporte").val();
    let fin = $("#fecha_fin_reporte").val();

    if (!inicio || !fin) {
        Swal.fire("Aviso", "Debe seleccionar ambas fechas", "warning");
        return;
    }

    $.ajax({
        url: "../Controller/declaracion/controller_declaracion.php",
        type: "POST",
        data: {
            action: "contar_entre_fechas",
            inicio: inicio,
            fin: fin
        },
        dataType: "json",
        success: function (resp) {
            Swal.fire({
                title: "Resultado",
                text: `Total de declaraciones: ${resp.total}`,
                icon: "info"
            });
        },
        error: function () {
            Swal.fire("Error", "No se pudo obtener el reporte", "error");
        }
    });
}



