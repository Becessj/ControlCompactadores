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

        // Validar input type="radio"
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
        // Validar input type="checkbox"
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
        // Validar input type="email"
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
        // Validar input type="file"
        else if (elemento.attr("type") === "file") {
            if (elemento[0].files.length === 0) {
                // Buscar <small> justo después del input que contenga el nombre del archivo actual
                var small = elemento.siblings("small").text().trim();

                if (small.toLowerCase().includes("archivo actual") && small.length > 0) {
                    elemento.addClass("is-valid").removeClass("is-invalid");
                } else {
                    elemento.addClass("is-invalid").removeClass("is-valid");
                    camposVacios = true;
                    var label = $("label[for='" + elemento.attr("id") + "']").text().trim();
                    camposFaltantes.push(label || elemento.attr("name") || "Archivo requerido");
                }
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