<?php
ini_set("pcre.backtrack_limit", "5000000");
require_once __DIR__ . '/../vendor/autoload.php';
require '../conexion.php';
$nombrepdf="";
$mpdf = new \Mpdf\Mpdf(['mode' => 'UTF-8', 'format' => 'A4']);
    /*    $query1 = "SELECT
documento.documento_id,
documento.doc_fecharegistro
FROM
documento
where (DATE_FORMAT(documento.doc_fecharegistro,'%Y-%m-%d') BETWEEN '".$_GET['fecnainicio']."' AND '".$_GET['fecnafin']."')
AND documento.doc_estatus LIKE '".$_GET['estado']."%' ";*/
$query2 = "SELECT
empresa.empresa_id,
UPPER(empresa.emp_razon) as emp_razon,
empresa.emp_email,
empresa.emp_cod,
empresa.emp_telefono,
empresa.emp_direccion,
empresa.emp_logo
FROM
empresa
LIMIT 1
";
  date_default_timezone_set('America/Lima');

      //$resultado1 = $mysqli->query($query1);
      $resultado2 = $mysqli->query($query2);
      $razon    = "";
      $telefono = "";
      $email    = "";
      $codigo   = "";
      $logo     = "";
      while($row2 = $resultado2->fetch_assoc()){
          $razon    = utf8_encode($row2['emp_razon']);
          $telefono = $row2['emp_telefono'];
          $email    = $row2['emp_email'];
          $codigo   = $row2['emp_cod'];
          $logo     = $row2['emp_logo'];
      }
      $nro_seguimiento = '';
      $nro_documento   = '';
      $tipo_documento  = '';
      $folio           = '';
      $dni  = '';
      $anio = '';
      $html = '';  
        $html .= '
        <html>
        <head>
        <style>
            @page {
                
                size: auto;
                odd-header-name: html_myHeader1;
                /*odd-footer-name: html_myFooter1;*/
                margin-top: 145px; /* <any of the usual CSS values for margins> */
                margin-bottom: 40px;
                margin-left: 20px;
                margin-right: 20px;
            }
            table{
                table-layout: fixed;
                border-collapse: collapse;
            }

            #table2 {
              border-collapse: collapse;
              table-layout: fixed;
            }
            th, td {
                border-collapse: collapse;
                word-wrap: break-word;
            }
            .logo{
              width: 120px;
              height:100px;
            }
            body {
               font-family: Arial !important;
            }
            .derecha{
              width:359px;
              float: right;
            }
            .barcodecell {
             text-align: center;
             vertical-align: middle;
             padding: 0;
            }
            .barcode {
               padding: 1.5mm;
               padding-left: 0px;
               margin: 0;
               vertical-align: top;
               color: #000000;
            }
            span{
              font-size:17px
            }
            td{
              font-size:15px
            }
            body {
             font-family: Times, Georgia, "Times New Roman", serif !important;
            }
        </style>
        </head>

        <body >

          <htmlpageheader name="myHeader1" style="display:none;">
            <table width="100%" border="0">
                <tr>
                  <th style="width:100px">
                    <img src="escudo2.png" style="width:80px" alt="s">
                  </th>
                  <th  valign="top" style="width:300px;border-right: 0px;vertical-align: middle;font-size:16px;text-align:center">
                    <span style="font-size:22px;">SISTEMA TR&Aacute;MITE DOCUMENTARIO</span>
                  
                  <br>
                    &nbsp;&nbsp;'.utf8_encode($razon).'
                  </th>
                  <th  valign="top" style="width:100px;vertical-align: middle;">
                    <img src="../../usuario/'.$logo.'" style="width:80px" alt=" ">
                  </th>
                </tr>
              </table>
            <hr style="color:black;height:0.3%;">
            
          </htmlpageheader>
          <br>
          <table id="table2" style="table-layout:fixed;width: 100%;font-size:10px;" cellpadding="0">
           ';
           $contador=0;
           //while($row1 = $resultado1->fetch_assoc()){
            //$nombrepdf=$row1['documento_id'];
            
            $contador++;
                //$contador=0;
            $query2 = "SELECT
            documento.documento_id,
            documento.doc_nrodocumento,
            CONCAT_WS(' ',
                            documento.doc_nombreremitente,
                            documento.doc_apepatremitente,
                            documento.doc_apematremitente) AS solicitante,
            documento.doc_asunto,
            destino.area_nombre,
            tipo_documento.tipodo_descripcion,
            documento.doc_folio,
            date_format(documento.doc_fecharegistro,'%d/%m/%Y %H:%i:%s') AS doc_fecharegistro,
            IF(documento.area_origen = 0,'EXTERIOR','INTERNO') AS area_origen,
            documento.doc_estatus,
            documento.doc_dniremitente,
            YEAR(documento.doc_fecharegistro) AS anio,
            recepcion.area_nombre as area_recepcion,
            IF(IFNULL(origen.area_nombre,'')='','TRÁMITE EXTERNO','TRÁMITE INTERNO') modalidad,
            CONCAT_WS(' ',
            empl_recepcion.emple_nombre,
            empl_recepcion.emple_apepat,
            empl_recepcion.emple_apemat) recepcionista
            FROM
            documento
            INNER JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id
            INNER JOIN area AS destino ON documento.area_id = destino.area_cod
            INNER JOIN area AS recepcion ON documento.area_destino = recepcion.area_cod
            LEFT JOIN area AS origen ON origen.area_cod = documento.area_origen
            INNER JOIN usuario ON usuario.area_id = recepcion.area_cod
            INNER JOIN empleado AS empl_recepcion ON usuario.empleado_id = empl_recepcion.empleado_id
                where documento.documento_id='".$_GET['documento_id']."'
                limit 1
                ";
                $resultado2 = $mysqli->query($query2);
                while($row2 = $resultado2->fetch_assoc()){
                  $nro_seguimiento = $row2['documento_id'];
                  $nro_documento   = $row2['doc_nrodocumento'];
                  $tipo_documento  = $row2['tipodo_descripcion'];
                  $folio           = $row2['doc_folio'];
                  $dni             = $row2['doc_dniremitente'];
                  $anio            = $row2['anio'];
                  $html.='
                  <tr>
                    <td style="width:210px;text-align:center;border:1px solid black;">
                      TR&Aacute;MITE DOCUMENTARIO
                      <br><br>
                      <span style="font-weight:bold">HOJA DE RUTA</span>
                    </td>
                    <td style="width:290px;border:1px solid black;"  colspan=2>
                      <table style="width:100%">
                        <tr style="">
                          <td style="width:40%;border-bottom:1px solid black;padding:3px">
                            DOCUMENTO
                          </td>
                          <td style="width:60%;border-bottom:1px solid black;padding:3px">
                          : OFICIO N° '.$row2['doc_nrodocumento'].' 
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;padding:3px">
                            Remitente
                          </td>
                          <td style="width:60%;padding:3px">
                          <span style="font-size:14px"> : '.$row2['solicitante'].' </span>
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;padding:3px">
                            Asunto
                          </td>
                          <td style="width:60%;padding:3px">
                            <span style="font-size:14px"> : '.$row2['doc_asunto'].' </span>
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;padding:3px">
                            Fecha y Hora
                          </td>
                          <td style="width:60%;padding:3px">
                          <span style="font-size:14px"> : '.$row2['doc_fecharegistro'].' </span>
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;padding:3px">
                            Folios
                          </td>
                          <td style="width:60%;padding:3px">
                          <span style="font-size:14px"> : '.$row2['doc_folio'].'</span>
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;padding:3px">
                            Modalidad tr&aacute;mite
                          </td>
                          <td style="width:60%;padding:3px">
                          <span style="font-size:14px"> : '.$row2['modalidad'].'</span>
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;padding:3px">
                            Tipo de tr&aacute;mite
                          </td>
                          <td style="width:60%;padding:3px">
                          <span style="font-size:14px"> : '.$row2['tipodo_descripcion'].'</span>
                          </td>
                        </tr>
                        <tr>
                          <td style="width:40%;padding:3px">
                            Recepcionado Por
                          </td>
                          <td style="width:60%;padding:3px">
                          <span style="font-size:14px"> : '.$row2['recepcionista'].'</span>
                          </td>
                        </tr>


                      </table>
                    </td>
                    <td style="width:200px;text-align:center;border:1px solid black;">
                      <barcode code="'.$nro_seguimiento.'" type="QR" class="barcode" size="1.5" error="M" disableborder="1"/>
                      <br>
                      Exp. N° '.$nro_seguimiento.'
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">PASE A:<br>&nbsp;</span>
                    </td>
                    
                    <td style="width:290px;border:1px solid black;padding:3px;" valign="top" rowspan=4 colspan=2>
                      PARA:
                    </td>
                    <td style="width:200px;text-align:left;border:1px solid black;padding:3px;" valign="top" rowspan=2>
                      N° FOLIOS
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">ENVIADO POR:<br>&nbsp;</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">RECIBIDO POR:<br>&nbsp;</span>
                    </td>
                    <td style="width:200px;text-align:left;border:1px solid black;padding:3px;" valign="top" rowspan=2>
                      FECHA DE ENVIO
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">FECHA Y HORA POR:<br>&nbsp;</span>
                    </td>
                  </tr>

                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">PASE A:<br>&nbsp;</span>
                    </td>
                    
                    <td style="width:290px;border:1px solid black;padding:3px;" valign="top" rowspan=4 colspan=2>
                      PARA:
                    </td>
                    <td style="width:200px;text-align:left;border:1px solid black;padding:3px;" valign="top" rowspan=2>
                      N° FOLIOS
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">ENVIADO POR:<br>&nbsp;</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">RECIBIDO POR:<br>&nbsp;</span>
                    </td>
                    <td style="width:200px;text-align:left;border:1px solid black;padding:3px;" valign="top" rowspan=2>
                      FECHA DE ENVIO
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">FECHA Y HORA POR:<br>&nbsp;</span>
                    </td>
                  </tr>


                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">PASE A:<br>&nbsp;</span>
                    </td>
                    
                    <td style="width:290px;border:1px solid black;padding:3px;" valign="top" rowspan=4 colspan=2>
                      PARA:
                    </td>
                    <td style="width:200px;text-align:left;border:1px solid black;padding:3px;" valign="top" rowspan=2>
                      N° FOLIOS
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">ENVIADO POR:<br>&nbsp;</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">RECIBIDO POR:<br>&nbsp;</span>
                    </td>
                    <td style="width:200px;text-align:left;border:1px solid black;padding:3px;" valign="top" rowspan=2>
                      FECHA DE ENVIO
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">FECHA Y HORA POR:<br>&nbsp;</span>
                    </td>
                  </tr>


                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">PASE A:<br>&nbsp;</span>
                    </td>
                    
                    <td style="width:290px;border:1px solid black;padding:3px;" valign="top" rowspan=4 colspan=2>
                      PARA:
                    </td>
                    <td style="width:200px;text-align:left;border:1px solid black;padding:3px;" valign="top" rowspan=2>
                      N° FOLIOS
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">ENVIADO POR:<br>&nbsp;</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">RECIBIDO POR:<br>&nbsp;</span>
                    </td>
                    <td style="width:200px;text-align:left;border:1px solid black;padding:3px;" valign="top" rowspan=2>
                      FECHA DE ENVIO
                    </td>
                  </tr>
                  <tr>
                    <td style="width:210px;text-align:left;border:1px solid black;padding:3px">
                      <span style="font-weight:normal;font-size:15px">FECHA Y HORA POR:<br>&nbsp;</span>
                    </td>
                  </tr>
                  ';
                
          $html.='</table><br>
          <table>
            <tr>
              <td style="width:30%;text-align:center" rowspan="5">
                <barcode code="'.$nro_seguimiento.'" type="QR" class="barcode" size="1.5" error="M" disableborder="1"/>
              </td>
              <td style="width:25%;">
                <span style="font-weight:bold;">DETALLE DEL TR&Aacute;MITE</span>
              </td>
              <td style="width:35%;">
                <span style="font-weight:bold;">: Exp. N° '.$nro_seguimiento.'</span>
              </td>
            </tr>
            <tr>
              <td style="width:25%;">
                <span>N° de Expediente</span>
              </td>
              <td style="width:35%;">
                <span>: '.$nro_seguimiento.'</span>
              </td>
            </tr>
            <tr>
              <td style="width:25%;">
                <span>Tipo Documento</span>
              </td>
              <td style="width:35%;">
                <span>: '.$tipo_documento.'</span>
              </td>
            </tr>
            <tr>
              <td style="width:25%;">
                <span>N° de Documento</span>
              </td>
              <td style="width:35%;">
                <span>: '.$nro_documento.'</span>
              </td>
            </tr>
            <tr>
              <td style="width:25%;">
                <span>Folios</span>
              </td>
              <td style="width:35%;">
                <span>: '.$folio.'</span>
              </td>
            </tr>
          </table>
          <table cellpadding=5>
            <tr>
              <td style="width:35%;">
                <span>Asunto</span>
              </td>
              <td style="width:65%;">
                <span>: '.$row2['doc_asunto'].'</span>
              </td>
            </tr>
            <tr>
              <td style="width:30%;">
                <span>Remitente</span>
              </td>
              <td style="width:70%;">
                <span>: '.$row2['solicitante'].'</span>
              </td>
            </tr>
            <tr>
              <td style="width:30%;">
                <span>Modalidad de tr&aacute;mite</span>
              </td>
              <td style="width:70%;">
                <span>: '.$row2['modalidad'].'</span>
              </td>
            </tr>
          
            <tr>
              <td style="width:30%;">
                <span>Adjuntos</span>
              </td>
              <td style="width:70%;">
                :
              </td>
            </tr>
            <tr>
              <td style="width:30%;">
                <span>Observaciones</span>
              </td>
              <td style="width:70%;">
              :
              </td>
            </tr>
            <tr>
              <td style="width:30%;">
                <span>Recepcionado por</span>
              </td>
              <td style="width:70%;">
                <span>: '.$row2['recepcionista'].' - Responsable de '. $row2['area_recepcion'] . '</span>
              </td>
            </tr>
            ';
            }
          $html.='
          </table>
          <span><br>&nbsp;RECEPCI&Oacute;N DEL EXPEDIENTE (Este cargo no es señal de conformidad del trámite)</span>
        </body>
        </html>';

$mpdf->WriteHTML($html);
$mpdf -> Output('Hoja de Ruta del Exp. N° '.$nro_seguimiento.'.pdf', 'D');
?>
