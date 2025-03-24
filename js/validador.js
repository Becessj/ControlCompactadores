/******************** validarCamposFormulario ********************/
function validarCamposFormulario(formularioID) {
    var formulario = $("#" + formularioID);
    var camposVacios = false;
    var camposFaltantes = [];

    formulario.find("input, select, textarea").each(function () {
        var elemento = $(this);
        // Ignorar los campos deshabilitados, de solo lectura, ocultos o no visibles
        if (elemento.prop("disabled") || elemento.prop("readonly") || elemento.attr("type") === "hidden" || !elemento.is(":visible")) {
            elemento.addClass("is-valid").removeClass("is-invalid");
            return; // Saltar este campo
        }
        // Validar radio buttons
        if (elemento.is(":radio")) {
            var name = elemento.attr("name");
            // Validar solo una vez por grupo de radio buttons
            if ($("input[name='" + name + "']").first().data("checked-validated")) {
                return;
            }

            if ($("input[name='" + name + "']:checked").length === 0) {
                $("input[name='" + name + "']").addClass("is-invalid").removeClass("is-valid");
                camposVacios = true;
                camposFaltantes.push(name);
            } else {
                $("input[name='" + name + "']").addClass("is-valid").removeClass("is-invalid");
            }
            // Marcar este grupo como validado
            $("input[name='" + name + "']").first().data("checked-validated", true);
        }
        // Validar checkboxes (deben estar marcados si son obligatorios)
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
        // Validar emails (formato correcto)
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
        // Validar otros campos (text, select, textarea)
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
        Swal.fire("Error", "Todos los campos son obligatorios", "error");
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