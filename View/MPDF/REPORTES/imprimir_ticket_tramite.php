<?php
require_once '../conexion.php';
$codigo=htmlspecialchars($_GET['codigo'],ENT_QUOTES,'UTF-8');
$query="SELECT
documento.documento_id,
documento.doc_dniremitente,
documento.doc_nombreremitente,
documento.doc_apepatremitente,
documento.doc_apematremitente,
documento.doc_celularremitente,
documento.doc_emailremitente,
documento.doc_direccionremitente,
documento.doc_representacion,
documento.doc_ruc,
documento.doc_empresa,
documento.tipodocumento_id,
documento.doc_nrodocumento,
documento.doc_folio,
documento.doc_asunto,
documento.doc_archivo,
documento.doc_fecharegistro,
documento.area_id,
documento.doc_estatus,
tipo_documento.tipodo_descripcion
FROM
documento
INNER JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id
where
documento.documento_id = '".$codigo."'";
$query2 = "SELECT
empresa.empresa_id,
UPPER(empresa.emp_razon) emp_razon,
empresa.emp_email,
empresa.emp_direccion,
empresa.emp_logo,
IFNULL(empresa.emp_cod,'') emp_cod,
IFNULL(empresa.emp_telefono,'')emp_telefono
FROM
empresa
LIMIT 1
";
  date_default_timezone_set('America/Lima');
$resultado = $mysqli->query($query);
$resultado2 = $mysqli->query($query2);
$razon    = "";
$telefono = "";
$email    = "";
$codigo   = "";
$logo     = "";
while($row2 = $resultado2->fetch_assoc()){
  $razon    = $row2['emp_razon'];
  $cod_cel  = $row2['emp_cod'];
  $celular  = $row2['emp_telefono'];
  $email    = $row2['emp_email'];
  $logo     = $row2['emp_logo'];

$cadena_telefono = '<i class="fa fa-phone-volume"></i>&nbsp;&nbsp;&nbsp;';
$cadena_telefono1 = "";
$cadena_telefono2 = "";
$cadena_telefono3 = "";

$cadena_telefono3 .= ' <label style="margin-bottom: 0rem;" class="verde">('.$row2['emp_cod'].') '.$row2['emp_telefono'].' </label>';
}
//$("#lb_telefono_footer").html($cadena_telefono+$cadena_telefono1+$cadena_telefono2+$cadena_telefono3);

while($row = $resultado->fetch_assoc()){
$html.='<style>
@page {
    margin: 10mm;
    margin-header: 0mm;
    margin-footer: 0mm;
    odd-footer-name: html_myFooter1;
}
</style>
    <table width="100%">
        <tr>
            <td align="center">
                <img width="30%" align="center" src="../../usuario/'.$logo.'">
            </td>
        </tr>
    </table  >

    <span style="font-size:12px"><b><br>Número de Expediente:
        </b> '.$row['documento_id'].'
    </span><br>
    <span style="font-size:12px"><b>Número de trámite:
        </b> '.$row['doc_nrodocumento'].'
    </span><br>
    <span style="font-size:12px"><b>Fecha - Hora:
        </b> '. date('d-m-Y H:i:s', strtotime($row['doc_fecharegistro'])).'
    </span><br>
    <span style="font-size:12px"><b>Tipo:
        </b> '.strtoupper(substr(utf8_encode($row['tipodo_descripcion']),0,32)).'
    </span><br>
    <span style="font-size:12px"><b>DNI:
        </b> '.$row['doc_dniremitente'].'
    </span><br>
    <span style="font-size:12px"><b>Remitente:<br>
        </b> '.strtoupper(substr(utf8_encode($row['doc_nombreremitente']),0,32)).' '.strtoupper(substr(utf8_encode($row['doc_apepatremitente']),0,32)).' '.strtoupper(substr(utf8_encode($row['doc_apematremitente']),0,32)).'
    </span><br><br><hr>
    <table class="items" width="100%" cellpadding="8">
        <thead>
            <tr>        
                <td class="barcodecell" align="center"><barcode code="'.$row['documento_id'].'" type="QR" class="barcode" size="1.0" error="M" disableborder="1"/></td>
            </tr>
        </thead>
    </table>
<htmlpagefooter name="myFooter1" style="display:none;">
    <table width="100%" border="0" style="text-align:center;">
        <tr>
            <td width="50%" style="text-align:left;font-size:12px;">
               '.$cadena_telefono3.'
            </td>
            <td width="50%" style="text-align:right;font-size:12px;">
                '.$email.'
            </td>
        </tr>
    </table>
</htmlpagefooter>
';
}
require_once __DIR__ . '/../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(
['mode' => 'UTF-8', 'format' => [80,130]]
);

$mpdf->WriteHTML($html);
$mpdf -> Output('ticket.pdf', 'D');
