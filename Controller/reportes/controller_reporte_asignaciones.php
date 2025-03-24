<?php
require '../../View/MPDF/vendor/autoload.php'; // Ruta correcta de MPDF
require '../../Model/model_asignacion.php'; // Modelo de asignaciones

$mes = $_GET['mes'] ?? date('m'); // Si no se selecciona mes, usa el actual
$compactadorID = $_GET['compactador'] ?? null; // Compactador específico o todos

if ($compactadorID === '') {
    $compactadorID = null; // Si es vacío, se interpreta como "Todos"
}

$asignacion = new Modelo_Asignacion();
$data = json_decode($asignacion->Listar_AsignacionesPorMes($mes, $compactadorID), true)['data'];

// Crear instancia de MPDF
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle("Cronograma de Asignaciones - Mes " . $mes);
$mpdf->SetMargins(10, 10, 10);

// Encabezado del reporte
$html = '
<h2 style="text-align:center;">PROGRAMACIÓN DE SERVICIO EN LAS ZONAS YA INDICADAS</h2>
<h3 style="text-align:center;">PARA CONDUCTORES Y AYUDANTES</h3>
<h4 style="text-align:center;">FECHA DEL 01/' . $mes . '/2024</h4>';

if (empty($data)) {
    $html .= '<p style="text-align:center; color:red;"><b>No hay asignaciones para este mes.</b></p>';
} else {
    foreach ($data as $fila) {
        // Encabezado del compactador y ruta
        $html .= '<br><h4 style="text-align:center;">CAMIÓN COMPACTADOR PLACA DE RODAJE: ' . strtoupper($fila["COMPACTADOR"]) . '</h4>';
        $html .= '<p style="text-align:center;"><b>' . strtoupper($fila["RUTA"]) . '</b></p>';

        // Tabla de empleados
        $html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">
            <tr>
                <th width="70%" align="center">Nombre</th>
                <th width="30%" align="center">Cargo</th>
            </tr>';

        foreach ($fila["EMPLEADOS"] as $empleado) {
            $html .= '<tr>
                <td align="center">' . strtoupper($empleado["nombre"]) . '</td>
                <td align="center">' . strtoupper($empleado["cargo"]) . '</td>
            </tr>';
        }

        $html .= '</table>';
    }
}

$html .= '<br><p style="text-align:center;">Fin del reporte.</p>';

// Generar PDF
$mpdf->WriteHTML($html);
$mpdf->Output("Cronograma_Mes_$mes.pdf", "I");
?>
