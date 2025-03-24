function listar_rutas() {
    $('#tabla_rutas').DataTable({
        destroy: true,  // Permite recargar correctamente la tabla
        order: [[0, "desc"]], // ✅ Ordena por ID_RUTA en orden descendente
        ajax: {
            url: "../Controller/rutas/controller_rutas.php",
            type: "POST",
            data: { action: "listar" },
            dataSrc: "data"
        },
        columns: [
            { data: "ID_RUTA" },
            { data: "NOMBRE" },
            { data: "DESCRIPCION" },
            {
                data: "ESTADO",
                render: function (data) {
                    return data === "INACTIVO"
                        ? '<span class="badge bg-danger bg-lg">' + data + '</span>'
                        : '<span class="badge bg-success bg-lg">' + data + '</span>';
                }
            },
            {
                data: null,
                render: function (data) {
                    return `<button class="btn btn-warning btn-sm editar_ruta" data-id="${data.ID_RUTA}">
                                <i class="fas fa-edit"></i> Editar
                            </button>`;
                }
            }
        ],
        language: idioma_espanol
    });
}


// ✅ Evento para abrir el modal de edición con los datos de la ruta
$("#tabla_rutas").on("click", ".editar_ruta", function () {
    let data = $('#tabla_rutas').DataTable().row($(this).parents("tr")).data();
    
    $("#id_ruta_editar").val(data.ID_RUTA);
    $("#nombre_ruta_editar").val(data.NOMBRE);
    $("#descripcion_ruta_editar").val(data.DESCRIPCION);
    $("#estado_ruta_editar").val(data.ESTADO);
    
    $("#modal_editar_ruta").modal("show");
});

// ✅ Registrar Ruta con AJAX
function Registrar_Ruta() {
    let nombre = $("#nombre_ruta").val();
    let descripcion = $("#descripcion_ruta").val();
    let estado = $("#estado_ruta").val();
    if (!validarCamposFormulario("modal_registrar_ruta")) {
        return; // No continuar si hay campos vacíos
    }
    $.post("../Controller/rutas/controller_rutas.php", {
        action: "registrar",
        nombre: nombre,
        descripcion: descripcion,
        estado: estado
    }, function (response) {
        let json = JSON.parse(response);
        if (json.status === "success") {
            Swal.fire("¡Éxito!", "Ruta registrada correctamente.", "success");
            $("#modal_registrar_ruta").modal("hide");
            $('#tabla_rutas').DataTable().ajax.reload();
        } else {
            Swal.fire("Error", "No se pudo registrar la ruta.", "error");
        }
    });
}
function Editar_Ruta() {
        if (!validarCamposFormulario("modal_editar_ruta")) {
        return; // No continuar si hay campos vacíos
    }
    let id_ruta = $("#id_ruta_editar").val();
    let nombre = $("#nombre_ruta_editar").val();
    let descripcion = $("#descripcion_ruta_editar").val();
    let estado = $("#estado_ruta_editar").val();

    $.post("../Controller/rutas/controller_rutas.php", {
        action: "editar",
        id_ruta: id_ruta,
        nombre: nombre,
        descripcion: descripcion,
        estado: estado
    }, function (response) {
        let json = JSON.parse(response);
        if (json.status === "success") {
            Swal.fire("¡Éxito!", "Ruta editada correctamente.", "success");
            $("#modal_editar_ruta").modal("hide");
            $('#tabla_rutas').DataTable().ajax.reload();
        } else {
            Swal.fire("Error", "No se pudo editar la ruta.", "error");
        }
    });
}
