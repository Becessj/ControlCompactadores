$(document).ready(function () {
    $(".select2").select2();
    validarFechas();
    listar_empleado();
    listar_cargo();
    moment.locale('es');
    // Inicializar datetimepicker para Fecha Desde con restricción mínima al día actual
    $('#txt_fecha_inicio').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        minDate: moment(), // Establecer la fecha mínima como el día actual
        icons: {
            time: "far fa-clock",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });

    // Inicializar datetimepicker para Fecha Hasta sin permitir fechas anteriores a "Fecha Desde"
    $('#txt_fecha_fin').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        useCurrent: false, // Evita que "Fecha Hasta" tome la misma fecha de "Fecha Desde"
        icons: {
            time: "far fa-clock",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    // Inicializar datetimepicker para Fecha Hasta sin permitir fechas anteriores a "Fecha Desde"
    $('#txt_fecha_vencimiento').datetimepicker({
      format: 'DD/MM/YYYY',
      locale: 'es',
      useCurrent: false, // Evita que "Fecha Hasta" tome la misma fecha de "Fecha Desde"
      icons: {
          time: "far fa-clock",
          date: "fa fa-calendar",
          up: "fa fa-arrow-up",
          down: "fa fa-arrow-down"
      }
  });
    
    // Evento: Actualizar la fecha mínima de "Fecha Hasta" cuando se seleccione "Fecha Desde"
    $("#txt_fecha_inicio").on("change.datetimepicker", function (e) {
        let fechaDesde = e.date ? e.date.clone().startOf('day') : null;
        $('#txt_fecha_fin').datetimepicker('minDate', fechaDesde);
    });

    // Evento: Validar que "Fecha Hasta" no sea menor que "Fecha Desde"
    $("#txt_fecha_fin").on("change.datetimepicker", function (e) {
        let fechaDesde = $("#txt_fecha_inicio").val();
        let fechaHasta = e.date ? e.date.format('DD/MM/YYYY') : null;

        if (fechaDesde && fechaHasta && moment(fechaHasta, 'DD/MM/YYYY').isBefore(moment(fechaDesde, 'DD/MM/YYYY'))) {
            Swal.fire("Error", "La fecha hasta no puede ser menor que la fecha desde", "error");
            $("#txt_fecha_fin").val(""); // Limpiar el campo inválido
        }
    });
});
var tbl_empleado;
var tbl_cargo;
function validarFechas(){
  moment.locale('es');
  // Inicializar datetimepicker para Fecha Desde con restricción mínima al día actual
  $('#txt_fecha_inicio').datetimepicker({
      format: 'DD/MM/YYYY',
      locale: 'es',
      minDate: moment(), // Establecer la fecha mínima como el día actual
      icons: {
          time: "far fa-clock",
          date: "fa fa-calendar",
          up: "fa fa-arrow-up",
          down: "fa fa-arrow-down"
      }
  });

  // Inicializar datetimepicker para Fecha Hasta sin permitir fechas anteriores a "Fecha Desde"
  $('#txt_fecha_fin').datetimepicker({
      format: 'DD/MM/YYYY',
      locale: 'es',
      useCurrent: false, // Evita que "Fecha Hasta" tome la misma fecha de "Fecha Desde"
      icons: {
          time: "far fa-clock",
          date: "fa fa-calendar",
          up: "fa fa-arrow-up",
          down: "fa fa-arrow-down"
      }
  });
// Inicializar datetimepicker para Fecha Desde con restricción mínima al día actual
$('#txt_fecha_inicio_editar').datetimepicker({
      format: 'DD/MM/YYYY',
      locale: 'es',
      minDate: moment(), // Establecer la fecha mínima como el día actual
      icons: {
          time: "far fa-clock",
          date: "fa fa-calendar",
          up: "fa fa-arrow-up",
          down: "fa fa-arrow-down"
      }
  });

  // Inicializar datetimepicker para Fecha Hasta sin permitir fechas anteriores a "Fecha Desde"
  $('#txt_fecha_fin_editar').datetimepicker({
      format: 'DD/MM/YYYY',
      locale: 'es',
      useCurrent: false, // Evita que "Fecha Hasta" tome la misma fecha de "Fecha Desde"
      icons: {
          time: "far fa-clock",
          date: "fa fa-calendar",
          up: "fa fa-arrow-up",
          down: "fa fa-arrow-down"
      }
  });
  $('#txt_fecha_vencimiento_edit').datetimepicker({
    format: 'DD/MM/YYYY',
    locale: 'es',
    useCurrent: false, // Evita que "Fecha Hasta" tome la misma fecha de "Fecha Desde"
    icons: {
        time: "far fa-clock",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down"
    }
});
  // Evento: Actualizar la fecha mínima de "Fecha Hasta" cuando se seleccione "Fecha Desde"
  $("#txt_fecha_inicio").on("change.datetimepicker", function (e) {
      let fechaDesde = e.date ? e.date.clone().startOf('day') : null;
      $('#txt_fecha_fin').datetimepicker('minDate', fechaDesde);
  });

  // Evento: Validar que "Fecha Hasta" no sea menor que "Fecha Desde"
  $("#txt_fecha_fin").on("change.datetimepicker", function (e) {
      let fechaDesde = $("#txt_fecha_inicio").val();
      let fechaHasta = e.date ? e.date.format('DD/MM/YYYY') : null;

      if (fechaDesde && fechaHasta && moment(fechaHasta, 'DD/MM/YYYY').isBefore(moment(fechaDesde, 'DD/MM/YYYY'))) {
          Swal.fire("Error", "La fecha hasta no puede ser menor que la fecha desde", "error");
          $("#txt_fecha_fin").val(""); // Limpiar el campo inválido
      }
  });
  // Evento: Actualizar la fecha mínima de "Fecha Hasta" cuando se seleccione "Fecha Desde"
  $("#txt_fecha_inicio_editar").on("change.datetimepicker", function (e) {
      let fechaDesde = e.date ? e.date.clone().startOf('day') : null;
      $('#txt_fecha_fin_editar').datetimepicker('minDate', fechaDesde);
  });

  // Evento: Validar que "Fecha Hasta" no sea menor que "Fecha Desde"
  $("#txt_fecha_fin_editar").on("change.datetimepicker", function (e) {
      let fechaDesde = $("#txt_fecha_inicio_editar").val();
      let fechaHasta = e.date ? e.date.format('DD/MM/YYYY') : null;

      if (fechaDesde && fechaHasta && moment(fechaHasta, 'DD/MM/YYYY').isBefore(moment(fechaDesde, 'DD/MM/YYYY'))) {
          Swal.fire("Error", "La fecha hasta no puede ser menor que la fecha desde", "error");
          $("#txt_fecha_fin_editar").val(""); // Limpiar el campo inválido
      }
  });
 }
function listar_empleado() {
  tbl_empleado = $('#tabla_empleados').DataTable({
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
            "url":"../Controller/empleado/controller_listar_empleados.php",
            type:'POST'
        },
      "columns": [
        { defaultContent: "" },
        {"data":"PERSONA"},
        {"data":"NOMBRE_COMPLETO"},
        // {"data":"CARGO"},
        {"data":"DIRECCION_FISCAL"},
        {"data":"TIPO_DOC"},
        {"data":"NRO_DOC"},
        {
          "data": null,
          "render": function (data, type, row) {
              return `
                  <button class="editar btn btn-primary btn-sm" onclick="AbrirModalEditarEmpleado('${row.PERSONA}', '${row.AP}', '${row.AM}', '${row.NOMBRES}', '${row.DIRECCION_FISCAL}', '${row.TIPO_DOC}', '${row.NRO_DOC}', '${row.CELULAR}', '${row.EMAIL}')">
                      <i class="fas fa-edit"></i><b>&nbsp;Editar</b>
                  </button>`;
          }
      }
      ],
      "language":idioma_espanol,
  });

  //Sirve para enumerar las tuplas #
    tbl_empleado.on('draw.td',function(){
      var PageInfo = $("#tabla_empleados").DataTable().page.info();
      tbl_empleado.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });

}
function Registrar_Empleado() {
  let apellidoPaterno = $("#txt_apellido_paterno").val().trim();
  let apellidoMaterno = $("#txt_apellido_materno").val().trim();
  let nombres = $("#txt_nombres").val().trim();
  let direccion = $("#txt_direccion").val().trim();
  // let tipoDoc = $("#select_tipo_doc").val();
  let tipoDoc = 'DNI';
  let celular = $("#txt_celular").val();
  let email = $("#txt_email").val();
  let tipo_persona = 'N';
  let nroDoc = $("#txtdni").val().trim();
  let usuarioCrea = 'ADMINWEB'; // Obtener usuario creador si aplica

  // 🔹 Generar automáticamente el campo `nombreCompleto`
  let nombreCompleto = `${apellidoPaterno} ${apellidoMaterno} ${nombres}`.trim();

  // /** EMPLEADOS **/
  if (!validarCamposFormulario("modal_registro_empleado")) {
      return; // No continuar si hay campos vacíos
  }

  // 🔥 Validar longitud del documento (Ejemplo: DNI con 8 dígitos)
  if (tipoDoc === "DNI" && nroDoc.length !== 8) {
      Swal.fire("Error", "El DNI debe tener 8 dígitos", "error");
      return;
  }

  // 🔥 Enviar datos al servidor mediante AJAX
  $.post("../Controller/empleado/controller_empleado.php", {
      action: "registrar",
      ap: apellidoPaterno,       // Cambiado para coincidir con el modelo
      am: apellidoMaterno,
      nombres: nombres,
      nombreCompleto: nombreCompleto, // Ahora se genera dinámicamente
      direccion: direccion,
      tipo_doc: tipoDoc,
      tipo_persona:tipo_persona,
      celular:celular,
      email:email,
      nro_doc: nroDoc,
      usuario_crea: usuarioCrea
  }, function (resp) {
      let data = JSON.parse(resp);
      if (data.success) {
          Swal.fire("Éxito", "Empleado registrado con éxito", "success");
          $("#modal_registro_empleado").modal('hide');
          listar_empleado();
      } else {
          Swal.fire("Error", "Hubo un problema al registrar el empleado", "error");
      }
  });
}
// ✅ Función para abrir el modal de registro de empleados
function AbrirModalRegistroEmpleado() {
  // Limpiar el formulario antes de abrir el modal
  LimpiarFormularioEmpleado();

  // Mostrar el modal
  $("#modal_registro_empleado").modal("show");
}

// ✅ Función para limpiar los campos del formulario de empleados
function LimpiarFormularioEmpleado() {
  $("#txt_apellido_paterno").val("");
  $("#txt_apellido_materno").val("");
  $("#txt_nombres").val("");
  $("#txt_nombre_completo").val("");
  $("#txt_direccion").val("");
  $("#select_tipo_doc").val("").trigger("change");
  $("#txt_celular").val("");
  $("#txt_email").val("");
  $("#txtdni").val("");
  $('.form-control').removeClass("is-invalid").removeClass("is-valid");
}


// ✅ Función para abrir el modal de edición con datos cargados
function AbrirModalEditarEmpleado(id, ap, am, nombres, direccion, tipo_doc, nro_doc, celular, email) {
  $("#txt_id_empleado_editar").val(id);
  $("#txt_apellido_paterno_editar").val(ap);
  $("#txt_apellido_materno_editar").val(am);
  $("#txt_nombres_editar").val(nombres);
  $("#txt_nombre_completo_editar").val(`${ap} ${am} ${nombres}`);
  $("#txt_direccion_editar").val(direccion);
  $("#select_tipo_doc_editar").val(tipo_doc).trigger("change");
  $("#txt_nro_doc_editar").val(nro_doc);
  $("#txt_celular_editar").val(celular);
  $("#txt_email_editar").val(email);

  $("#modal_editar_empleado").modal("show");
}

// ✅ Función para modificar un empleado
function Modificar_Empleado() {
  let persona = $("#txt_id_empleado_editar").val();
  let apellidoPaterno = $("#txt_apellido_paterno_editar").val().trim();
  let apellidoMaterno = $("#txt_apellido_materno_editar").val().trim();
  let nombres = $("#txt_nombres_editar").val().trim();
  let direccion = $("#txt_direccion_editar").val().trim();
  let tipoDoc = 'DNI';
  let nroDoc = $("#txt_nro_doc_editar").val().trim();
  let celular = $("#txt_celular_editar").val().trim();
  let email = $("#txt_email_editar").val().trim();
  let usuarioModifica = "ADMINWEB"; // Se puede obtener del sistema de sesiones
  let tipo_persona = 'N';
  let nombreCompleto = `${apellidoPaterno} ${apellidoMaterno} ${nombres}`.trim();

  // 🔥 Validaciones antes de enviar el formulario
    if (!validarCamposFormulario("modal_editar_empleado")) {
      return; // No continuar si hay campos vacíos
  }

  if (tipoDoc === "DNI" && nroDoc.length !== 8) {
      Swal.fire("Error", "El DNI debe tener 8 dígitos", "error");
      return;
  }

  // 🔥 Enviar datos al servidor mediante AJAX
  $.post("../Controller/empleado/controller_empleado.php", {
      action: "editar",
      persona: persona,
      ap: apellidoPaterno,
      am: apellidoMaterno,
      nombres: nombres,
      nombreCompleto: nombreCompleto,
      direccion: direccion,
      tipo_doc: tipoDoc,
      nro_doc: nroDoc,
      celular: celular,
      email: email,
      usuario_modifica: usuarioModifica,
      tipo_persona:tipo_persona
  }, function (resp) {
      let data = JSON.parse(resp);
      if (data.success) {
          Swal.fire("Éxito", "Empleado actualizado correctamente", "success");
          $("#modal_editar_empleado").modal("hide");
          listar_empleado();
      } else {
          Swal.fire("Error", "Hubo un problema al actualizar el empleado", "error");
      }
  });
}



// Función para concatenar el nombre completo automáticamente
function ActualizarNombreCompleto() {
  let apellidoPaterno = $("#txt_apellido_paterno").val().trim();
  let apellidoMaterno = $("#txt_apellido_materno").val().trim();
  let nombres = $("#txt_nombres").val().trim();
  $("#txt_nombre_completo").val(`${apellidoPaterno} ${apellidoMaterno} ${nombres}`.trim());
}

function ActualizarNombreCompletoEditar() {
  let apellidoPaterno = $("#txt_apellido_paterno_editar").val().trim();
  let apellidoMaterno = $("#txt_apellido_materno_editar").val().trim();
  let nombres = $("#txt_nombres_editar").val().trim();
  $("#txt_nombre_completo_editar").val(`${apellidoPaterno} ${apellidoMaterno} ${nombres}`.trim());
}


function listar_cargo() {
  tbl_cargo = $('#tabla_cargos').DataTable({
    aoColumns: [
      null,
      null,
      null,
      null,
      null
    ],
    "ordering": true,
    "bLengthChange": true,
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'print',
        title: 'REPORTE DE LISTADO DE CARGOS',
        exportOptions: {
          columns: [1, 2, 3]
        },
        className: "pdf fa fa-print",
        customize: function (win) {
          $(win.document.body)
            .css('font-size', '10pt')
            .prepend(
              '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
            );

          $(win.document.body).find('table')
            .addClass('compact')
            .css('font-size', 'inherit');
        }
      },
      {
        extend: 'csv',
        className: "csv fas fa-file-csv",
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
    "ajax": {
      "url": "../Controller/empleado/controller_listar_cargos.php",
      type: 'POST'
    },
    "columns": [
      { defaultContent: "" },
      { "data": "PERSONA" },
      { "data": "NOMBRE_COMPLETO" },
      { "data": "CARGO" },
      { "data": "AREA" },
      { "data": "DIRECCION_FISCAL" },
      {
        "data": "F_INICIO",
        "render": function (data) {
          return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
        }
      },
      {
        "data": "F_FINAL",
        "render": function (data) {
          return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
        }
      },
      {
        "data": "E",
        render: function (data, type, row) {
            if (data === 'I') {
                return '<span class="badge bg-danger bg-lg">INACTIVO</span>';
            } else if (data === 'A') {
                return '<span class="badge bg-success bg-lg">ACTIVO</span>';
            } else {
                return '<span class="badge bg-secondary bg-lg">DESCONOCIDO</span>'; // Para otros valores inesperados
            }
        }
    }
    
  ,
      {
        "data": null,
        "render": function (data, type, row) {
            return `
                   <button class="editar btn btn-primary btn-sm" onclick="AbrirModalEditarCargo('${row.DET_CARGO}', '${row.PERSONA}', '${row.NOMBRE_COMPLETO}', '${row.CARGO}','${row.BREVETE}','${row.CATEGORIA}','${row.FECHA_VENCIMIENTO}', '${row.AREA}', '${row.F_INICIO}', '${row.F_FINAL}', '${row.E}')">
                    <i class="fas fa-edit"></i><b>&nbsp;Editar</b>
                </button>`;
        }
    }

      

    ],
    "language": idioma_espanol,
  });
   //Sirve para enumerar las tuplas #
   tbl_cargo.on('draw.td',function(){
    var PageInfo = $("#tabla_cargos").DataTable().page.info();
    tbl_cargo.column(0, {page: 'current'}).nodes().each(function(cell, i){
      cell.innerHTML = i + 1 + PageInfo.start;
    });
  });
}

// ✅ Función para abrir el modal de registro de cargo
function AbrirModalRegistroCargo() {
  LimpiarFormularioCargo(); // Limpiar campos antes de abrir el modal
  cargarComboEmpleados();   // Cargar empleados en el select
  cargarComboCargos();      // Cargar lista de cargos en el select
  cargarComboAreas();       // Cargar lista de áreas en el select
  $("#modal_registro_cargo").modal("show"); // Mostrar modal
}

// ✅ Función para limpiar los campos del formulario de cargos
function LimpiarFormularioCargo() {
  $("#select_empleado").val("").trigger("change");
  $("#select_cargo").val("").trigger("change");
  $("#select_area").val("").trigger("change");
  $("#txt_fecha_inicio").val("");
  $("#txt_fecha_fin").val("");
}

// ✅ Función para cargar empleados en el select
function cargarComboEmpleados() {
  $.ajax({
      url: '../Controller/empleado/controller_listar_empleados.php',
      type: 'POST',
      data: { action: "listar" }
  }).done(function (resp) {
      let data = JSON.parse(resp);
      let opciones = "<option value=''>Seleccione un empleado</option>";
      data.data.forEach(emp => {
          opciones += `<option value='${emp.PERSONA}'>${emp.NOMBRE_COMPLETO}</option>`;
      });
      $("#select_empleado").html(opciones);
  }).fail(function (xhr, status, error) {
      console.error("Error al cargar empleados:", error);
  });
}

// ✅ Función para cargar cargos en el select
function cargarComboCargos() {
  let opciones = `
      <option value="">Seleccione un cargo</option>
      <option value="CONDUCTOR">CONDUCTOR</option>
      <option value="AYUDANTE">AYUDANTE</option>`;
  $("#select_cargo").html(opciones);
}

// ✅ Función para cargar áreas en el select
function cargarComboAreas() {
  let opciones = `
      <option value="">Seleccione un área</option>
      <option value="ALMACEN">ALMACEN</option>`;
  $("#select_area").html(opciones);
}



function habilitarCampos() {
  let cargo = $("#select_cargo").val();
  
  if (cargo === "CONDUCTOR") {
      $("#conductorFields").slideDown(); // Mostrar los campos de conductor
  } else {
      $("#conductorFields").slideUp(); // Ocultar los campos de conductor
      $("#txt_brevete, #txt_categoria, #txt_fecha_vencimiento").val(""); // Limpiar los valores
  }
}

function Registrar_Cargo() {
  let persona = $("#select_empleado").val();
  let cargo = $("#select_cargo").val();
  let area = $("#select_area").val();
  let fechaInicio = $("#txt_fecha_inicio").val();
  let fechaFin = $("#txt_fecha_fin").val();
  let brevete = $("#txt_brevete").val();
  let categoria = $("#select_categoria").val();
  let fechaVencimiento = $("#txt_fecha_vencimiento").val();
  let usuarioCrea = 'ADMINWEB'; 

  if (!persona || !cargo || !area || !fechaInicio) {
      Swal.fire("Error", "Todos los campos obligatorios deben ser completados", "error");
      return;
  }

  // Enviar datos al servidor
  $.post("../Controller/empleado/controller_cargo.php", {
      action: "registrar",
      persona: persona,
      cargo: cargo,
      area: area,
      fechaInicio: fechaInicio,
      fechaFin: fechaFin,
      brevete: brevete,
      categoria: categoria,
      fechaVencimiento: fechaVencimiento,
      usuario_crea: usuarioCrea
  }, function (resp) {
      let data = JSON.parse(resp);
      if (data.success) {
          Swal.fire("Éxito", "Cargo asignado correctamente", "success");
          $("#modal_registro_cargo").modal('hide');
          listar_cargo();
      } else {
          Swal.fire("Error", "Hubo un problema al asignar el cargo", "error");
      }
  });
}


// // ✅ Función para abrir el modal de edición con datos cargados
// function AbrirModalEditarCargo(id, empleado, nombrecompleto, cargo, area, fechaInicio, fechaFin, E) {
//   $("#cbm_estatus").val(E).trigger("change");
//   $("#txt_id_cargo_editar").val(id);
//   $("#select_empleado_editar").html(`<option value="${empleado}">${nombrecompleto}</option>`).prop("disabled", true);
//   $("#select_cargo_editar").html(`<option value="${cargo}">${cargo}</option>`).prop("disabled", true);
//   $("#select_area_editar").val(area).trigger("change");

//   // Convertir fechas al formato adecuado para la edición
//   let fechaInicioFormateada = fechaInicio ? moment(fechaInicio, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
//   let fechaFinFormateada = fechaFin ? moment(fechaFin, "YYYY-MM-DD").format("DD/MM/YYYY") : "";

//   $("#txt_fecha_inicio_editar").val(fechaInicioFormateada);
//   $("#txt_fecha_fin_editar").val(fechaFinFormateada);

//   // Asegurar que el modal está correctamente cerrado antes de abrirlo
//   $("#modal_editar_cargo").modal("hide");

//   // Mostrar el modal después de un pequeño delay
//   setTimeout(() => {
//     $("#modal_editar_cargo").modal("show");
//   }, 200);
// }


function AbrirModalEditarCargo(id, empleado, nombrecompleto, cargo, brevete, categoria, fecha_vencimiento, area, fecha_inicio, fecha_fin, estado) {
  // Llenar los campos con los datos del registro seleccionado
  $("#txt_id_cargo_editar").val(id);
  $("#select_empleado_editar").html(`<option value="${empleado}">${nombrecompleto}</option>`);
  $("#select_cargo_editar").html(`<option value="${cargo}">${cargo}</option>`);
  $("#select_area_editar").val(area).trigger('change');

  $("#txt_fecha_fin_editar").val(moment(fecha_fin, "YYYY-MM-DD").format("DD/MM/YYYY"));
  $("#cbm_estatus").val(estado).trigger('change');

  // Si el cargo es CONDUCTOR, mostrar los campos adicionales
  if (cargo === "CONDUCTOR") {
    $("#conductorFieldsEdit").show();
    $("#txt_brevete_edit").val(brevete);
    $("#select_categoria_edit").val(categoria);
    $("#txt_fecha_vencimiento_edit").val(moment(fecha_vencimiento, "YYYY-MM-DD").format("DD/MM/YYYY"));

  } else {
    $("#conductorFieldsEdit").hide();
  }

  // Mostrar el modal de edición
  $("#modal_editar_cargo").modal("show");
}


// ✅ Función para modificar un cargo
function Editar_Cargo() {
  let id = $("#txt_id_cargo_editar").val();
  let cargo = $("#select_cargo_editar").val();
  let area = $("#select_area_editar").val();
  let fechaInicio = $("#txt_fecha_inicio_editar").val();
  let fechaFin = $("#txt_fecha_fin_editar").val();
  let estado = $("#cbm_estatus").val();
  
  // Variables adicionales si el cargo es "CONDUCTOR"
  let brevete = null;
  let categoria = null;
  let fechaVencimiento = null;

  if (cargo === "CONDUCTOR") {
      brevete = $("#txt_brevete_edit").val();
      categoria = $("#select_categoria_edit").val();
      fechaVencimiento = $("#txt_fecha_vencimiento_edit").val();
  }

  // Validaciones
  if (!cargo || !area || !fechaInicio) {
      Swal.fire("Error", "Todos los campos obligatorios deben ser completados", "error");
      return;
  }

  // Enviar datos al servidor
  $.post("../Controller/empleado/controller_cargo.php", {
      action: "editar",
      id_cargo: id,
      cargo: cargo,
      area: area,
      fecha_inicio: fechaInicio,
      fecha_fin: fechaFin,
      estado: estado,
      brevete: brevete,
      categoria: categoria,
      fecha_vencimiento: fechaVencimiento
  }, function (resp) {
      let data = JSON.parse(resp);
      if (data.success) {
          Swal.fire("Éxito", "Cargo actualizado correctamente", "success");
          $("#modal_editar_cargo").modal("hide");
          listar_cargo();
      } else {
          Swal.fire("Error", "Hubo un problema al actualizar el cargo", "error");
      }
  });
}

function Buscar_reniec_GPA(origen) {
  // Determinar el origen del input y botón de búsqueda
  var dni, nombres, apellido_paterno, apellido_materno, nombre_completo, boton_buscar;

  if (origen === 'registro') {
      dni = $("#txtdni").val().trim();
      nombres = "#txt_nombres";
      apellido_paterno = "#txt_apellido_paterno";
      apellido_materno = "#txt_apellido_materno";
      nombre_completo = "#txt_nombre_completo";
      boton_buscar = "#btn_reniec_registro"; // Botón de registro
  } else if (origen === 'edicion') {
      dni = $("#txt_nro_doc_editar").val().trim();
      nombres = "#txt_nombres_editar";
      apellido_paterno = "#txt_apellido_paterno_editar";
      apellido_materno = "#txt_apellido_materno_editar";
      nombre_completo = "#txt_nombre_completo_editar";
      boton_buscar = "#btn_reniec_editar"; // Botón de edición
  } else {
      return console.error("Debe especificar 'registro' o 'edicion' como argumento.");
  }

  // Validar longitud del DNI
  if (!dni || dni.length < 8) {
      let input = origen === 'registro' ? "#txtdni" : "#txt_nro_doc_editar";
      $(input).focus().removeClass("is-valid").addClass("is-invalid");

      return Swal.fire(
          "Mensaje de Advertencia",
          "El campo <b>DNI</b> debe tener como mínimo 8 dígitos",
          "warning"
      );
  } else {
      $("#txtdni, #txt_nro_doc_editar").removeClass("is-invalid").addClass("is-valid");
  }

  // Obtener el token desde localStorage
  const token = localStorage.getItem('_token');

  // Verificar si el token existe
  if (!token) {
      return Swal.fire(
          "Mensaje de Advertencia",
          "No se encontró el token de autenticación. Por favor, inicie sesión.",
          "warning"
      );
  }

  // 🔄 Mostrar Loading antes de la consulta
  Swal.fire({
      title: "Buscando en RENIEC...",
      html: "Por favor, espere unos segundos.",
      allowOutsideClick: false,
      didOpen: () => {
          Swal.showLoading();
      }
  });

  // Realizar la solicitud AJAX
  $.ajax({
      url: "https://api-reniec-sunat.vercel.app/api/dniApi", 
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify({ numero: dni }), 
      headers: {
          "x-access-token": token // Manteniendo el encabezado solicitado
      },
  })
  .done(function (resp) {
      Swal.close(); // ❌ Cerrar loading al recibir la respuesta

      if (resp && resp.nombres) { // Verifica que haya datos válidos
          $(boton_buscar).prop("disabled", true); // 🔥 Solo deshabilita el botón correspondiente
          $(nombres).val(resp.nombres.replace("'", ""));
          $(apellido_paterno).val(resp.apellidoPaterno.replace("'", ""));
          $(apellido_materno).val(resp.apellidoMaterno.replace("'", ""));
          $(nombre_completo).val(resp.nombres + " " + resp.apellidoPaterno + " " + resp.apellidoMaterno);
      } else {
          limpiarCampos(nombres, apellido_paterno, apellido_materno, nombre_completo);
          Swal.fire({
              title: "Mensaje de Advertencia",
              html: "<b style='color:#9B0000'>EL N° DOCUMENTO INGRESADO NO ES VÁLIDO O PERTENECE A UN MENOR DE EDAD</b>",
              icon: "warning"
          }).then(() => {
              if (origen === 'registro') {
                  $("#txtdni").val("");
              } else {
                  $("#txt_nro_doc_editar").val("");
              }
          });
      }
  })
  .fail(function (jqXHR) {
      Swal.close(); // ❌ Cerrar loading al recibir error
      manejarErrores(jqXHR, origen);
  });
}

// Función para limpiar los campos
function limpiarCampos(nombres, apellido_paterno, apellido_materno, nombre_completo) {
  $(nombres).val("");
  $(apellido_paterno).val("");
  $(apellido_materno).val("");
  $(nombre_completo).val("");
}

// Función para manejar errores de la solicitud
function manejarErrores(jqXHR, origen) {
  if (jqXHR.status === 0) {
      Swal.fire(
          "Mensaje de Error",
          "<b>No se pudo procesar la solicitud,</b><b style='color:#9B0000;'> SIN ACCESO A INTERNET</b>",
          "error"
      );
  } else if (jqXHR.status === 401) {
      Swal.fire({
          title: "Mensaje de Advertencia",
          html: "<b style='color:#9B0000;font-size:20px'>Acceso no autorizado!!!</b><br><b style='font-size:14px'><b style='color:#9B0000;'>Membresía vencida</b>, Para mayor información comuníquese con su proveedor</b>",
          imageUrl: "img/reniec.png",
          imageWidth: 120,
          imageHeight: 115,
          imageAlt: "Cargando...",
      });
  } else {
      let input = origen === 'registro' ? "#txtdni" : "#txt_nro_doc_editar";
      limpiarCampos(
          origen === 'registro' ? "#txt_nombres" : "#txt_nombres_editar",
          origen === 'registro' ? "#txt_apellido_paterno" : "#txt_apellido_paterno_editar",
          origen === 'registro' ? "#txt_apellido_materno" : "#txt_apellido_materno_editar",
          origen === 'registro' ? "#txt_nombre_completo" : "#txt_nombre_completo_editar"
      );

      Swal.fire({
          title: "Mensaje de Advertencia",
          html: "<b style='color:#9B0000'>EL N° DOCUMENTO INGRESADO NO ES VÁLIDO O PERTENECE A UN MENOR DE EDAD</b>",
          icon: "warning"
      }).then(() => {
          $(input).val("");
      });
  }
}
