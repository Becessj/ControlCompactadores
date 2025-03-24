$(document).ready(function () {
    listarAsistencia();
});

function listarAsistencia() {
    $("#tabla_asistencia").DataTable().destroy();

    $("#tabla_asistencia").DataTable({
        "ajax": {
            "url": "../Controller/asistencia/controller_asistencia.php",
            "type": "POST",
            "data": { action: "listar_asistencia" },
            "dataSrc": "data"
        },
        "columns": [
            { "data": "ID_ASISTENCIA" },
            { "data": "PERSONA" },
            { "data": "FECHA" },
            { "data": "HORA_ENTRADA" },
            { "data": "HORA_SALIDA" },
            { "data": "ESTADO" },
            {
                "data": "ID_ASISTENCIA",
                "render": function (data) {
                    return `<button onclick="marcarSalida(${data})">Salida</button>`;
                }
            }
        ],
        "language": { "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json" }
    });
}

function marcarEntrada() {
    alert("xd")
    let id_asignacion = 1; 
    let persona = "PER0000002";  
    let firma_entrada = obtenerFirmaDigital(); 

    $.post("../Controller/asistencia/controller_asistencia.php", {
        action: "registrar_entrada",
        id_asignacion: id_asignacion,
        persona: persona,
        firma_entrada: firma_entrada
    }, function (response) {
        listarAsistencia();
    }, "json");
}

function marcarSalida(id_asistencia) {
    let firma_salida = obtenerFirmaDigital(); 

    $.post("../Controller/asistencia/controller_asistencia.php", {
        action: "registrar_salida",
        id_asistencia: id_asistencia,
        firma_salida: firma_salida
    }, function (response) {
        listarAsistencia();
    }, "json");
}

function obtenerFirmaDigital() {
    let canvas = document.getElementById("firmaCanvas");
    return canvas.toDataURL("image/png").split(',')[1]; 
}
