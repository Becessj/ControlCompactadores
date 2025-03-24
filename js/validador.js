/******************** validarCamposFormulario ********************/
function validarCamposFormulario(formularioID) {
    var formulario = $("#" + formularioID);
    var camposVacios = false;
    var camposFaltantes = [];

    formulario.find("input, select, textarea").each(function () {
        var elemento = $(this);

        // Ignorar campos deshabilitados, readonly, hidden o no visibles
        if (
            elemento.prop("disabled") ||
            elemento.prop("readonly") ||
            elemento.attr("type") === "hidden" ||
            !elemento.is(":visible")
        ) {
            elemento.addClass("is-valid").removeClass("is-invalid");
            return;
        }

        // Validar radio buttons
        if (elemento.is(":radio")) {
            var name = elemento.attr("name");
            if ($("input[name='" + name + "']").first().data("checked-validated")) return;

            if ($("input[name='" + name + "']:checked").length === 0) {
                $("input[name='" + name + "']").addClass("is-invalid").removeClass("is-valid");
                camposVacios = true;
                camposFaltantes.push(name);
            } else {
                $("input[name='" + name + "']").addClass("is-valid").removeClass("is-invalid");
            }

            $("input[name='" + name + "']").first().data("checked-validated", true);
        }
        // Validar checkboxes
        else if (elemento.is(":checkbox")) {
            if (!$("input[name='" + elemento.attr("name") + "']:checked").length) {
                elemento.addClass("is-invalid").removeClass("is-valid");
                camposVacios = true;
                if (!camposFaltantes.includes(elemento.attr("name"))) {
                    camposFaltantes.push(elemento.attr("name"));
                }
            } else {
                elemento.addClass("is-valid").removeClass("is-invalid");
            }
        }
        // Validar emails
        else if (elemento.attr("type") === "email") {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(elemento.val().trim())) {
                elemento.addClass("is-invalid").removeClass("is-valid");
                camposVacios = true;
                camposFaltantes.push("Correo inválido: " + elemento.val().trim());
            } else {
                elemento.addClass("is-valid").removeClass("is-invalid");
            }
        }
        // Validar archivos
        else if (elemento.attr("type") === "file") {
            var tieneArchivo = elemento[0].files.length > 0;

            // Buscar etiqueta visual con clase .custom-file-label
            var label = formulario.find("label.custom-file-label[for='" + elemento.attr("id") + "']");
            var textoLabel = label.text().trim();

            // Validar si hay archivo o al menos se muestra algo en el label
            if (!tieneArchivo && (textoLabel === "" || textoLabel.toLowerCase() === "seleccione archivo")) {
                elemento.addClass("is-invalid").removeClass("is-valid");
                camposVacios = true;
                camposFaltantes.push("Archivo requerido");
            } else {
                elemento.addClass("is-valid").removeClass("is-invalid");
            }
        }
        // Otros campos
        else if (elemento.val().trim().length === 0) {
            elemento.addClass("is-invalid").removeClass("is-valid");
            camposVacios = true;
            var label = $("label[for='" + elemento.attr("id") + "']").text().trim();
            camposFaltantes.push(label || elemento.attr("name") || "Campo sin nombre");
        } else {
            elemento.addClass("is-valid").removeClass("is-invalid");
        }
    });

    if (camposVacios) {
        console.warn("Errores en el formulario:", camposFaltantes);
        Swal.fire("Error", "Tiene campos vacíos o inválidos:\n" + camposFaltantes.join(", "), "error");
        return false;
    }
    return true;
}
// window.validarFormulario = validarFormulario;
/******************** validarCamposFormulario ********************/

/** MANTENIMIENTO **/

// if (!validarCamposFormulario("modal_registro")) {
//     return; // No continuar si hay campos vacíos
// }

// if (!validarCamposFormulario("modal_editar_mantenimiento")) {
//     return; // No continuar si hay campos vacíos
// }
// /** COMBUSTIBLE **/
// if (!validarCamposFormulario("modal_editar_combustible")) {
//     return; // No continuar si hay campos vacíos
// }

// if (!validarCamposFormulario("modal_registro_combustible")) {
//     return; // No continuar si hay campos vacíos
// }

// /** EMPLEADOS **/
// if (!validarCamposFormulario("modal_registro_empleado")) {
//     return; // No continuar si hay campos vacíos
// }

// if (!validarCamposFormulario("modal_editar_empleado")) {
//     return; // No continuar si hay campos vacíos
// }

// /** ASIGNACION **/
// if (!validarCamposFormulario("modal_registro_asignacion")) {
//     return; // No continuar si hay campos vacíos
// }