function graficos_consumo_combustible() {
    $.ajax({
        url: "../Controller/reportes/controller_reportes.php",
        type: 'POST',
        data: { action: "listar_consumo_combustible" }
    }).done(function (resp) {
        let data_ = JSON.parse(resp);
        let deudas = [];
        let codigos = [];
        let colores = [
            '#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8', 
            '#6610f2', '#e83e8c', '#fd7e14', '#6f42c1', '#20c997'
        ]; // Paleta de colores variada

        let deuda_total = 0;

        for (let i = 0; i < data_.length; i++) {
            deudas.push(parseFloat(data_[i].TOTAL_LITROS));
            codigos.push(data_[i].CODIGO);
            deuda_total += parseFloat(data_[i].TOTAL_LITROS);
        }

        $("#deuda_limpieza").html("Litros Totales: " + deuda_total.toFixed(2));

        Highcharts.chart('container_consumo_combustible', {
            chart: { type: 'column' }, // ✅ Gráfico de barras verticales
            title: { text: 'Consumo de Combustible por Compactador', align: 'left' },
            xAxis: {
                categories: codigos, // ✅ Los compactadores estarán en el eje X
                title: { text: 'Compactadores' }
            },
            yAxis: {
                min: 0,
                title: { text: 'Litros Consumidos' },
                labels: { format: '{value} L' },
                stackLabels: {
                    enabled: true,
                    formatter: function () {
                        return 'Total: ' + deuda_total.toFixed(2) + ' L';
                    }
                }
            },
            tooltip: {
                headerFormat: '<b>{point.category}</b><br/>',
                pointFormat: '{series.name}: {point.y} L'
            },
            plotOptions: {
                column: { 
                    dataLabels: { enabled: true }
                }
            },
            series: [{
                name: 'Consumo de Combustible',
                data: deudas,
                colorByPoint: true, // ✅ Colores automáticos por barra
                colors: colores.slice(0, deudas.length) // ✅ Aplicando colores diferentes a cada barra
            }],
            credits: { enabled: false },
            legend: { enabled: false }
        });
    });
}


function graficos_repuestos_compactador() {
    $.ajax({
        url: "../Controller/reportes/controller_reportes.php",
        type: 'POST',
        data: { action: "listar_repuestos_compactador" }
    }).done(function (resp) {
        let data_ = JSON.parse(resp);
        let cantidades = [];
        let compactadores = [];
        let colores = [
            '#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8', 
            '#6610f2', '#e83e8c', '#fd7e14', '#6f42c1', '#20c997'
        ]; // 🎨 Paleta de colores variada

        let total_repuestos = 0;

        for (let i = 0; i < data_.length; i++) {
            cantidades.push(parseInt(data_[i].TOTAL_REPUESTOS));
            compactadores.push(data_[i].COMPACTADOR);
            total_repuestos += parseInt(data_[i].TOTAL_REPUESTOS);
        }

        $("#total_repuestos").html("Total de Repuestos Usados: " + total_repuestos);

        Highcharts.chart('container_repuestos_compactador', {
            chart: { type: 'column' }, // ✅ Se usa 'column' para barras verticales
            title: { text: 'Comparación de Repuestos Usados por Compactador', align: 'left' },
            xAxis: {
                categories: compactadores, // ✅ Los compactadores estarán en el eje X
                title: { text: 'Compactadores' }
            },
            yAxis: {
                min: 0,
                title: { text: 'Cantidad de Repuestos' },
                labels: { format: '{value}' },
                stackLabels: {
                    enabled: true,
                    formatter: function () {
                        return 'Total: ' + total_repuestos;
                    }
                }
            },
            tooltip: {
                headerFormat: '<b>{point.category}</b><br/>',
                pointFormat: '{series.name}: {point.y} repuestos'
            },
            plotOptions: {
                column: { // ✅ Configurar para barras verticales
                    dataLabels: { enabled: true }
                }
            },
            series: [{
                name: 'Repuestos Usados',
                data: cantidades,
                colorByPoint: true, // ✅ Permite colores distintos para cada barra
                colors: colores.slice(0, cantidades.length) // ✅ Aplicando colores diferentes a cada barra
            }],
            credits: { enabled: false },
            legend: { enabled: false }
        });
    });
}
function graficos_consumo_repuestos_tiempo() {
    $.ajax({
        url: "../Controller/reportes/controller_reportes.php",
        type: 'POST',
        data: { action: "listar_consumo_repuestos_tiempo" }
    }).done(function (resp) {
        let data_ = JSON.parse(resp);
        let fechas = [];
        let cantidades = [];

        for (let i = 0; i < data_.length; i++) {
            // Convertir la fecha al formato DD/MM/AAAA
            let fechaOriginal = data_[i].FECHA;
            let fechaFormateada = moment(fechaOriginal, "YYYY-MM-DD").format("DD/MM/YYYY");
            
            fechas.push(fechaFormateada);
            cantidades.push(parseInt(data_[i].TOTAL_REPUESTOS));
        }

        Highcharts.chart('container_repuestos_tiempo', {
            chart: { type: 'line' },
            title: { text: 'Consumo de Repuestos en el Tiempo', align: 'left' },
            xAxis: {
                categories: fechas, // ✅ Se muestran las fechas en formato DD/MM/AAAA
                labels: { style: { fontWeight: 'bold' } }
            },
            yAxis: {
                title: { text: 'Cantidad de Repuestos' }
            },
            tooltip: {
                headerFormat: '',
                pointFormat: '<b>Cantidad:</b><br/> {point.y} repuestos'
            },
            plotOptions: {
                line: {
                    dataLabels: { enabled: true },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Repuestos Usados',
                data: cantidades,
                color: '#007BFF'
            }],
            credits: { enabled: false }
        });
    });
}

// Evento para actualizar gráfico cuando se cambia el mes o año
$(document).ready(function () {
    $("#select_mes, #select_anio").change(function () {
        graficos_mantenimientos_tipo_por_fecha();
    });

    graficos_mantenimientos_tipo_por_fecha(); // Carga inicial
});
function graficos_mantenimientos_tipo_por_fecha() {
    let mes = $("#select_mes").val();
    let anio = $("#select_anio").val();

    $.ajax({
        url: "../Controller/reportes/controller_reportes.php",
        type: 'POST',
        data: { action: "listar_mantenimientos_tipo_por_fecha", mes: mes, anio: anio }
    }).done(function (resp) {
        let data_ = JSON.parse(resp);
        let tipos = [];
        let cantidades = [];
        let colores = [];

        for (let i = 0; i < data_.length; i++) {
            tipos.push(data_[i].TIPO);
            cantidades.push(parseInt(data_[i].TOTAL_MANTENIMIENTOS));

            // Asignar colores por tipo de mantenimiento
            if (data_[i].TIPO === "PREVENTIVO") {
                colores.push('#007BFF'); // Azul para preventivo
            } 
            else if (data_[i].TIPO === "DESINFECCIÓN") {
                colores.push('#ffa500'); // Azul para preventivo
            }
            else {
                colores.push("#FF5733"); // Rojo para correctivo
            }
        }

        Highcharts.chart('container_mantenimientos_tipo_por_fecha', {
            chart: { type: 'bar' },
            title: { text: `Cantidad de Mantenimientos por Tipo (${mes}/${anio})`, align: 'left' },
            xAxis: {
                categories: tipos,
                title: { text: 'Tipo de Mantenimiento' },
                labels: { style: { fontWeight: 'bold' } }
            },
            yAxis: {
                title: { text: 'Cantidad de Mantenimientos' }
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: 'Cantidad: {point.y} mantenimientos'
            },
            plotOptions: {
                bar: {
                    dataLabels: { enabled: true }
                }
            },
            series: [{
                name: 'Mantenimientos',
                data: cantidades,
                colorByPoint: true,
                colors: colores
            }],
            credits: { enabled: false }
        });
    });
}
function graficos_documentos_proximos_a_expirar() {
    $.ajax({
        url: "../Controller/reportes/controller_reportes.php",
        type: 'POST',
        data: { action: "listar_documentos_proximos_a_expirar" }
    }).done(function (resp) {
        let data_ = JSON.parse(resp);
        let meses = [];
        let compactadores = {};
        let series = [];

        for (let i = 0; i < data_.length; i++) {
            let fecha = data_[i].MES_EXPIRACION;
            let partes = fecha.split("-");
            let mesNombre = obtenerNombreMes(parseInt(partes[1])) + " " + partes[0];

            if (!meses.includes(mesNombre)) {
                meses.push(mesNombre);
            }

            let compactador = data_[i].COMPACTADOR;
            let cantidad = parseInt(data_[i].TOTAL_DOCUMENTOS);

            if (!compactadores[compactador]) {
                compactadores[compactador] = Array(meses.length).fill(0);
            }
            
            let index = meses.indexOf(mesNombre);
            compactadores[compactador][index] = cantidad;
        }

        for (let compactador in compactadores) {
            series.push({
                name: compactador,
                data: compactadores[compactador]
            });
        }

        Highcharts.chart('container_documentos_proximos_a_expirar', {
            chart: { type: 'column' },
            title: { text: 'Documentos Próximos a Expirar en los Próximos 6 Meses', align: 'left' },
            xAxis: {
                categories: meses,
                title: { text: 'Mes de Expiración' },
                labels: { style: { fontWeight: 'bold' } }
            },
            yAxis: {
                title: { text: 'Cantidad de Documentos' }
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y} documentos'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: { enabled: true }
                }
            },
            series: series,
            credits: { enabled: false }
        });
    });
}
function obtenerNombreMes(numeroMes) {
    const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    return meses[numeroMes - 1];
}
function graficos_compactadores_documentacion() {
    $.ajax({
        url: "../Controller/reportes/controller_reportes.php",
        type: 'POST',
        data: { action: "listar_compactadores_documentacion" }
    }).done(function (resp) {
        let data_ = JSON.parse(resp);
        let al_dia = 0;
        let incompletos = 0;
        let vencidos = 0;

        let compactadores_al_dia = [];
        let compactadores_incompletos = [];
        let compactadores_vencidos = [];

        for (let i = 0; i < data_.length; i++) {
            let compactador = data_[i].COMPACTADOR;
            let estado = data_[i].ESTADO;

            if (estado === "AL DÍA") {
                al_dia++;
                compactadores_al_dia.push(compactador);
            } else if (estado === "INCOMPLETO") {
                incompletos++;
                compactadores_incompletos.push(compactador);
            } else if (estado === "VENCIDO") {
                vencidos++;
                compactadores_vencidos.push(compactador);
            }
        }

        // Mostrar la lista de compactadores debajo del gráfico
        $("#lista_compactadores").html(`
            <h4>Compactadores por Estado</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Compactadores</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="color: #28a745;"><b>Al Día</b></td>
                        <td>${compactadores_al_dia.join(", ") || "Ninguno"}</td>
                    </tr>
                    <tr>
                        <td style="color: #ffc107;"><b>Incompletos</b></td>
                        <td>${compactadores_incompletos.join(", ") || "Ninguno"}</td>
                    </tr>
                    <tr>
                        <td style="color: #dc3545;"><b>Vencidos</b></td>
                        <td>${compactadores_vencidos.join(", ") || "Ninguno"}</td>
                    </tr>
                </tbody>
            </table>
        `);

        Highcharts.chart('container_compactadores_documentacion', {
            chart: { type: 'pie' },
            title: { text: 'Estado de Documentación de Compactadores', align: 'left' },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}: {point.y}'
                    }
                }
            },
            series: [{
                name: 'Compactadores',
                colorByPoint: true,
                data: [
                    { name: 'Al Día', y: al_dia, color: '#28a745' },
                    { name: 'Incompletos', y: incompletos, color: '#ffc107' },
                    { name: 'Vencidos', y: vencidos, color: '#dc3545' }
                ]
            }],
            credits: { enabled: false }
        });
    });
}


