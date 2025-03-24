$(document).ready(function () {
    listar_combustible();
    combo_placa() ;
     // ✅ Evento para actualizar total en tiempo real en Registro
     $("#cantidad_litros, #precio_litro, input[name='igv_option']").on("input change", function () {
        calcularTotalRegistro();
    });

        // ✅ Evento para actualizar total en tiempo real en Edición
        $("#cantidad_litros_editar, #precio_litro_editar, input[name='igv_option_editar']").on("input change", function () {
            calcularTotalEditar();
        });
});

var tbl_combustible;
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

function listar_combustible() {
    tbl_combustible = $('#tabla_combustible').DataTable({
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
              "url":"../Controller/combustible/controller_combustible.php",
              type:'POST',
              "data": { action: "listar" },
  
          },
        "columns": [
            { "data": "ID_COMBUSTIBLE" },
            { "data": "COMPACTADOR" },
            { 
                "data": "FECHA_CARGA",
                "render": function(data, type, row) {
                    return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "";
                }
            },
            { "data": "CANTIDAD_LITROS" },
            { "data": "PRECIO_LITRO" },
            { "data": "TOTAL" },
            { "data": "BOLETA" },
            {"data":"ESTADO",
                render: function (data, type, row ) {
                    if(data=='INACTIVO'){
                        return '<span class="badge bg-danger bg-lg">'+data+'</span>';
                    }else{
                        return '<span class="badge bg-success bg-lg">'+data+'</span>';
                    }
        
            }},
            {
                "data": null,
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-primary" onclick="AbrirModalEditarCombustible(${row.ID_COMBUSTIBLE}, '${row.COMPACTADOR}', '${row.FECHA_CARGA}', ${row.CANTIDAD_LITROS}, ${row.PRECIO_LITRO}, '${row.BOLETA}', '${row.TOTAL}', '${row.ESTADO}')">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                    `;
                }
            }
        ],
        "language":idioma_espanol,
    });
    //Sirve para enumerar las tuplas #
      tbl_combustible.on('draw.td',function(){
        var PageInfo = $("#tabla_combustible").DataTable().page.info();
        tbl_combustible.column(0, {page: 'current'}).nodes().each(function(cell, i){
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });
  }

// ✅ Función para abrir el modal de registro
function AbrirModalRegistroCombustible() {
    LimpiarFormularioCombustible(); // Limpiar el formulario antes de abrir el modal
    $("#modal_registro_combustible").modal('show');
}

// ✅ Función para registrar combustible con validación
function Registrar_Combustible() {
    var id_compactador = $("#cmb_placa_registro").val();
    var fecha = $("#txt_fecha_registrar").val();
    var litros = $("#cantidad_litros").val();
    var precio = $("#precio_litro").val();
    var boleta = $("#boleta").val();
    var total = $("#total").val();

    if (!validarCamposFormulario("modal_registro_combustible")) {
        return; // No continuar si hay campos vacíos
    }

    if (isNaN(litros) || isNaN(precio) || litros <= 0 || precio <= 0) {
        Swal.fire("Error", "Los valores de litros y precio deben ser números positivos", "error");
        return;
    }
  
      $.ajax({
        url: "../Controller/combustible/controller_combustible.php",
        type: 'POST',
        data: { 
            action: "registrar",
            id_compactador: id_compactador,
            fecha: fecha,  // Ahora en formato YYYY-MM-DD
            litros: litros,
            precio: precio,
            boleta: boleta,
            total: total // Asegurar 2 decimales 
        },
        dataType: "json",
        success: function (resp) {
            if (resp.success) {
                // LimpiarCampos();
                Swal.fire("Mensaje de Confirmación", "Datos correctamente registrados, <b>nuevo comprobante de combustible registrado</b>", "success")
                    .then(() => {
                        listar_combustible();
                        $("#modal_registro_combustible").modal('hide');
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

// ✅ Función para abrir el modal de edición con datos cargados
function AbrirModalEditarCombustible(id, compactador, fecha, litros, precio, boleta, total,estado) {
    $("#select_compactador_editar").html(
        "<option value=''>" + compactador + "</option>"
    );
    $("#txt_id_combustible_editar").val(id);

    let fechaFormateada = moment(fecha, "YYYY-MM-DD").format("DD/MM/YYYY");
    $("#fecha_carga_editar").val(fechaFormateada);
    $("#cantidad_litros_editar").val(litros);
    $("#precio_litro_editar").val(precio);
    $("#boleta_editar").val(boleta);
    $("#cbm_estatus").val(estado).trigger("change");
    // ✅ Calcular el subtotal sin IGV
    let subtotal = (parseFloat(litros) * parseFloat(precio)).toFixed(2);
    
    // ✅ Calcular el total con IGV
    let totalConIGV = (subtotal * 1.18).toFixed(2);

    // ✅ Verificar si el total guardado es igual al total con IGV
    if (parseFloat(total).toFixed(2) === totalConIGV) {
        $("#rad_igv_si_editar").prop("checked", true);
    } else {
        $("#rad_igv_no_editar").prop("checked", true);
    }

    // ✅ Asignar el total
    $("#total_editar").val(parseFloat(total).toFixed(2));

    $("#modal_editar_combustible").modal("show");
}



// ✅ Función para modificar un registro de combustible
function Modificar_Combustible() {
    let id_combustible = $("#txt_id_combustible_editar").val();
    let fecha = $("#fecha_carga_editar").val();
    let litros = $("#cantidad_litros_editar").val();
    let precio = $("#precio_litro_editar").val();
    let boleta = $("#boleta_editar").val();
    var total = $("#total_editar").val();
    var estatus = $("#cbm_estatus").val(); 
    if (!validarCamposFormulario("modal_editar_combustible")) {
        return; // No continuar si hay campos vacíos
    }

    $.post("../Controller/combustible/controller_combustible.php", {
        action: "editar",
        id_combustible: id_combustible,
        fecha: fecha,
        litros: litros,
        precio: precio,
        total: total,
        boleta: boleta,
        estatus:estatus
    }, function (resp) {
        let data = JSON.parse(resp);
        if (data.success) {
            Swal.fire("Éxito", "Registro actualizado correctamente", "success");
            $("#modal_editar_combustible").modal("hide");
            listar_combustible();
        } else {
            Swal.fire("Error", "Hubo un problema al actualizar el registro", "error");
        }
    });
}

// ✅ Función para limpiar los formularios
function LimpiarFormularioCombustible() {
    $("#cmb_placa_registro").val("").trigger("change");
    $("#txt_fecha_registrar").val("");
    $("#cantidad_litros").val("");
    $("#precio_litro").val("");
    $("#boleta").val("");
    $("#total").val("");

    $("#select_compactador_editar").val("").trigger("change");
    $("#fecha_carga_editar").val("");
    $("#cantidad_litros_editar").val("");
    $("#precio_litro_editar").val("");
    $("#boleta_editar").val("");

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
}
function combo_placa() {
    $.ajax({
        url: '../Controller/compactador/controller_combo_placa_listar.php',
        type: 'POST',
    }).done(function(resp) {
        var data = JSON.parse(resp);
        var opciones = "<option value=''>Seleccione un compactador</option>"; // Opción por defecto

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

// ✅ Función para calcular total en REGISTRO
function calcularTotalRegistro() {
    let litros = parseFloat($("#cantidad_litros").val()) || 0;
    let precio = parseFloat($("#precio_litro").val()) || 0;
    let incluirIGV = $("#rad_igv_si").prop("checked");

    let subtotal = litros * precio;
    let total = incluirIGV ? subtotal * 1.18 : subtotal;

    $("#total").val(total.toFixed(2));
}

// ✅ Función para calcular total en EDICIÓN
function calcularTotalEditar() {
    let litros = parseFloat($("#cantidad_litros_editar").val()) || 0;
    let precio = parseFloat($("#precio_litro_editar").val()) || 0;
    let incluirIGV = $("#rad_igv_si_editar").prop("checked");

    let subtotal = litros * precio;
    let total = incluirIGV ? subtotal * 1.18 : subtotal;

    $("#total_editar").val(total.toFixed(2));
}