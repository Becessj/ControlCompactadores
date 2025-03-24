$(document).ready(function () {
    listar_compactadores();
    $('#txt_fecha_expiracion').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        minDate: moment(),
        icons: {
            time: "far fa-clock",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
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
var tbl_compactador;
function listar_compactadores() {
    tbl_compactador = $('#tabla_compactadores').DataTable({
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
       "ajax": {
            "url": "../Controller/compactador/controller_compactador.php",
            "type": "POST",
            "data": { action: "listar" },
            "dataSrc": "data"
        },
        "columns": [
     
            { "data": "CODIGO" },
            { "data": "DESCRIPCION" },
            { "data": "MARCA" },
            {
              data: "ESTADO_DOCUMENTOS",
              render: function (data, type, row) {
                  let color = "btn-secondary"; // Gris si no tiene documentos
                  if (data === "AL DÍA") color = "btn-success";  // 🟢 Verde
                  else if (data === "INCOMPLETO") color = "btn-warning";  // 🟠 Naranja
                  else if (data === "VENCIDO") color = "btn-danger";  // 🔴 Rojo

                  return `<button style='font-size:13px;' type='button' class='ver_datosdocumento btn btn-sm ${color}'>
                              <span><i class='fa fa-search' aria-hidden='true'></i></span>
                          </button>`;
              }
          },
            { "data": "MODELO" },
            {"data":"ESTADO",
				render: function (data, type, row ) {
					if(data=='INACTIVO'){
						return '<span class="badge bg-danger bg-lg">'+data+'</span>';
					}else{
						return '<span class="badge bg-success bg-lg">'+data+'</span>';
					}
		
			}
		  },
            {
                "data": null,
                render: function (data, type, row ) {
                    return "<button class='editar btn btn-primary  btn-sm'  type='button' ><i class='fas fa-edit'></i><b>&nbsp;Editar</b></button>";
         
         }
            }
        ],
        "language":idioma_espanol
    });
      $('#tabla_compactadores').on('click','.editar',function(){
        var data = tbl_compactador.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
        if(tbl_compactador.row(this).child.isShown()){//Cuando esta en tamaño responsivo
            var data = tbl_compactador.row(this).data();
           }   
           $("#modal_editar_compactador").modal('show');
           $("#txt_id_editar").val(data.ID_COMPACTADOR);
           document.getElementById('txt_placa_editar').value = data.CODIGO;
           document.getElementById('txt_descripcion_editar').value = data.DESCRIPCION;
           document.getElementById('txt_marca_editar').value = data.MARCA;
           document.getElementById('txt_modelo_editar').value = data.MODELO;
           $("#cbm_estatus").val(data.ESTADO).trigger("change");
      })
  
      $("#tabla_compactadores").on("click", ".ver_datosdocumento", function () {
        var data = tbl_compactador.row($(this).parents("tr")).data(); //Detecta a que fila hago click y me captura los datos en la variable data.
        if (tbl_compactador.row(this).child.isShown()) {
            //Cuando esta en tamaño responsivo
            var data = tbl_compactador.row(this).data();
        }
            (txt_id_compactador = data.ID_COMPACTADOR),
            (txt_codigo = data.CODIGO),
            (txt_descripcion = data.DESCRIPCION),
            (txt_marca = data.MARCA),
            (txt_modelo = data.MODELO),
            (txt_estado = data.ESTADO),
            listar_documentos_compactador(txt_id_compactador);
            $("#id_compactador_doc").val(txt_id_compactador);
            
            $("#txt_descripcion_ver").val(txt_descripcion);
            $("#txt_marca_ver").val(txt_marca);
            $("#txt_modelo_ver").val(txt_modelo);
            $("#txt_estado_ver").val(txt_estado);
            $("#lbl_codigo").text(txt_codigo); 
         
        $("#modal_ver_documento").modal("show");
      });
     
  }

  

function AbrirModalRegistro(){
    LimpiarCampos();
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro").modal('show');
  }
  
  function LimpiarCampos(){
    $("#txt_placa").val("");
    $("#txt_descripcion").val("");
    $("#txt_marca").val("");
    $("#txt_modelo").val("");
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    
  }
  
  function Registrar_Compactador() {
    var placa = $("#txt_placa").val();
    var descripcion = $("#txt_descripcion").val();
    var marca = $("#txt_marca").val();
    var modelo = $("#txt_modelo").val();

    if (!validarCamposFormulario("modal_registro")) {
        return; // No continuar si hay campos vacíos
    }

    $.ajax({
        url: "../Controller/compactador/controller_compactador.php",
        type: 'POST',
        dataType: 'json',
        data: {
            action: "registrar",
            placa: placa,
            descripcion: descripcion,
            marca: marca,
            modelo: modelo
        },
        success: function (resp) {
            if (resp.success) {
                LimpiarCampos();
                Swal.fire("Mensaje de Confirmación", "Datos correctamente registrados, <b>nuevo compactador registrado</b>", "success")
                    .then(() => {
                        listar_compactadores();
                        $("#modal_registro").modal('hide');
                    });
            } else if (resp.duplicado) {
                Swal.fire("Mensaje de Advertencia", "El número de placa ya está registrado en nuestra base de datos", "warning");
            } else {
                Swal.fire("Mensaje de Error", "No se pudo completar el registro", "error");
            }
        },
        error: function () {
            Swal.fire("Mensaje de Error", "Error en la conexión con el servidor", "error");
        }
    });
}

function Modificar_Compactador() {
    if (!validarCamposFormulario("modal_editar_compactador")) {
        return; // No continuar si hay campos vacíos
    }
    var id = $("#txt_id_editar").val(); // Capturar el ID del compactador
    var placa = $("#txt_placa_editar").val();
    var descripcion = $("#txt_descripcion_editar").val();
    var marca = $("#txt_marca_editar").val();
    var modelo = $("#txt_modelo_editar").val();
    var estatus = $("#cbm_estatus").val(); 

    $.ajax({
        url: '../Controller/compactador/controller_compactador.php',
        type: 'POST',
        dataType: 'json', // Asegurar que la respuesta es JSON
        data: {
            action: "editar",
            id: id, // Asegurar que se envía el ID
            placa: placa,
            descripcion: descripcion,
            marca: marca,
            modelo: modelo,
            estatus: estatus
        },
        success: function (resp) {
            if (resp.success) {
                LimpiarCampos();
                Swal.fire("Mensaje de Confirmación", "Datos actualizados correctamente", "success")
                    .then(() => {
                        listar_compactadores();
                        $("#modal_editar_compactador").modal('hide');
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

  function ValidacionInput(txt_placa,txt_descripcion,txt_marca,txt_modelo){
    Boolean($("#"+txt_placa).val().length>0) ? $("#"+txt_placa).removeClass('is-invalid').addClass("is-valid") : $("#"+txt_placa).removeClass('is-valid').addClass("is-invalid"); 
  
    Boolean($("#"+txt_descripcion).val().length>0) ? $("#"+txt_descripcion).removeClass('is-invalid').addClass("is-valid") : $("#"+txt_descripcion).removeClass('is-valid').addClass("is-invalid"); 
  
    Boolean($("#"+txt_marca).val().length>0) ? $("#"+txt_marca).removeClass('is-invalid').addClass("is-valid") : $("#"+txt_marca).removeClass('is-valid').addClass("is-invalid"); 
  
    Boolean($("#"+txt_modelo).val().length>0) ? $("#"+txt_modelo).removeClass('is-invalid').addClass("is-valid") : $("#"+txt_modelo).removeClass('is-valid').addClass("is-invalid"); 
  
  }

  function listar_documentos_compactador(id_compactador) {
    table_documentos = $("#tabla_documentos").DataTable({
      ordering: false,
      pageLength: 10,
      destroy: true,
      responsive: true,
      autoWidth: false,
      ajax: {
        method: "POST",
        url: "../Controller/documento/controller_documento.php",
        data: {
          action: "listar_documentos",
          id_compactador: id_compactador,
        },
      },
      columns: [
        { defaultContent: "" },
        { data: "TIPO_DOCUMENTO" },
        {
          data: "NOMBRE_ARCHIVO",
          render: function (data, type, row) {
            if (data != "") {
                return (
                  "" +
                  '<button class="btn btn-warning  btn-xs" title="Clic para descargar Archivo" type="button" ><a style="cursor:pointer" name="' +row.NOMBRE_ARCHIVO +"*" +row.NOMBRE_ARCHIVO.split(".")[1] +'" onclick="abrirarchivo(this)"><i style="color:" class="fas fa-2x fa-file-pdf"></i></a></button>' +
                  '<button class="btn"  title="Clic para ver Archivo"  onclick="verarchivo(this)" name="' +row.NOMBRE_ARCHIVO +"*" + row.NOMBRE_ARCHIVO.split(".")[1] +'"> <i class="fa fa-eye"></i> </button>'
                );
              }
          },
        },
        { 
            data: "FECHA_EXPIRACION",
            render: function (data) {
                return data ? moment(data, "YYYY-MM-DD").format("DD/MM/YYYY") : "No especificado";
            }
        },
        { 
            data: "FECHA_EXPIRACION",
            render: function (data) {
                let hoy = moment().format("YYYY-MM-DD"); // 📆 Fecha actual
                let estado = data && moment(data).isBefore(hoy) ? "VENCIDO" : "VIGENTE";
                
                return estado === "VENCIDO" 
                    ? '<span class="badge bg-danger">VENCIDO</span>' 
                    : '<span class="badge bg-success">VIGENTE</span>';
            }
        },
        {
          data: null,
          render: function (data, type, row) {
            return `
              <button class="btn btn-danger btn-sm eliminar_documento" data-id="${row.ID_DOCUMENTO}" title="Eliminar">
                <i class="fa fa-trash"></i>
              </button>
            `;
          },
        },
      ],
      fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        // $($(nRow).find("td")).css("text-align", "center");
        // $($(nRow).find("td")).css("word-wrap", "break-word");
      },
      language: idioma_espanol,
   
    
    });
  
    // ✅ Enumerar filas automáticamente
    table_documentos.on("draw.dt", function () {
      var PageInfo = $("#tabla_documentos").DataTable().page.info();
      table_documentos.column(0, { page: "current" }).nodes().each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });  
    // ✅ Evento para eliminar el documento
    $("#tabla_documentos").on("click", ".eliminar_documento", function () {
      let id_documento = $(this).data("id");
     
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Este documento será eliminado permanentemente.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          eliminar_documento(id_documento);
        }
      });
    });
  }
  function Subir_Documento() {
    let id_compactador = $("#id_compactador_doc").val();
    let tipo_documento = $("#tipo_documento").val();
    let txt_fecha_expiracion = $("#txt_fecha_expiracion").val();
    let archivo = $("#archivo_documento")[0].files[0];

    // 🚨 Validaciones antes de enviar
    if (!id_compactador || !tipo_documento || !archivo) {
        Swal.fire("Error", "Todos los campos son obligatorios", "error");
        return;
    }

    let formData = new FormData();
    formData.append("action", "registrar");
    formData.append("id_compactador", id_compactador);
    formData.append("tipo_documento", tipo_documento);
    formData.append("txt_fecha_expiracion", txt_fecha_expiracion);
    formData.append("archivo", archivo);

    $.ajax({
        url: "../Controller/documento/controller_documento.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (resp) {
            if (resp.success) {
                Swal.fire("Éxito", "Documento cargado con éxito", "success");
                listar_documentos_compactador(id_compactador);
                tbl_compactador.ajax.reload(null, false);
                $("#modal_cargar_documento").modal("hide");
                limpiarDocumento();
            } else if (resp.error === "El archivo ya existe en la base de datos.") {
                Swal.fire("Advertencia", "Este documento ya ha sido registrado para este compactador.", "warning");
            } else {
                Swal.fire("Error", "Error al cargar el documento", "error");
            }
        },
        error: function () {
            Swal.fire("Error", "Error en la conexión con el servidor", "error");
        }
    });
}


  function AbrirModalVerDocumento(id, codigo, descripcion, marca, modelo, estado) {
    $("#id_compactador_doc").val(id);
    $("#lb_codigo").text(codigo);
    $("#txt_descripcion_ver").val(descripcion);
    $("#txt_marca_ver").val(marca);
    $("#txt_modelo_ver").val(modelo);
    $("#txt_estado_ver").val(estado);
    $("#lb_estado").text(estado);
  
    listar_documentos_compactador(id); // 🔥 Llama a la función para cargar los documentos
    $("#modal_ver_documento").modal("show");
  }
  function eliminar_documento(id_documento) {
    $.ajax({
      url: "../Controller/documento/controller_documento.php",
      type: "POST",
      data: { action: "eliminar_documento", id_documento: id_documento },
      success: function (resp) {
        let data = JSON.parse(resp);
        if (data.success) {
          Swal.fire("Eliminado", "Documento eliminado correctamente", "success");
          listar_documentos_compactador($("#id_compactador_doc").val());
          tbl_compactador.ajax.reload(null, false);
        } else {
          Swal.fire("Error", "No se pudo eliminar el documento", "error");
        }
      },
    });
  }

function verarchivo(archivo) {
    var datos_split = archivo.name;
    var datos = datos_split.split("*");
    $("#modal_archivo_ver").modal("show");
    $("#div_pdf").html(
      '<object data="../Controller/documento/uploads/' +
        datos[0] +
        '"#zoom=100" type="application/pdf" style="width: 100%; height: 100%; min-height: 750px;">'
    );
}

function abrirarchivo(archivo) {
    var datos_split = archivo.name;
    var datos = datos_split.split("*");
    //window.open("documento/"+archivo);
    //window.open("REPORTE/excel/generar_excel_checker.php?idempresa="+idempresa+"&origen="+origen
    window.open(
      "../Controller/documento/descargar.php?file=" + datos[0] + "&extension=" + datos[1]
    );
    //href="download.php?file=fichero.png"
  }
function limpiarDocumento() {
    $("#txt_fecha_expiracion").val(""); // Limpia el campo de fecha de expiración
    $("#archivo_documento").val(""); // Resetea el input de archivo
    $("#lb_archivo").html("Seleccionar Archivo"); // Restaura el label del archivo
}

