<?php
ini_set("pcre.backtrack_limit", "5000000");
require_once __DIR__ . '/../vendor/autoload.php';
require '../conexion.php';
$nombrepdf="";
$mpdf = new \Mpdf\Mpdf(['mode' => 'UTF-8', 'format' => 'A4']);
//         $query1 = "SELECT
// documento.documento_id,
// documento.doc_fecharegistro
// FROM
// documento
// where (DATE_FORMAT(documento.doc_fecharegistro,'%Y-%m-%d') BETWEEN '".$_GET['fecnainicio']."' AND '".$_GET['fecnafin']."')
// AND documento.doc_estatus LIKE '".$_GET['estado']."%' ";

$query0 ="
            SELECT	
                    area.area_nombre AS destino
                    FROM
                    movimiento
                    LEFT JOIN area as origen ON movimiento.area_origen_id = origen.area_cod
                    LEFT JOIN area ON movimiento.areadestino_id = area.area_cod
                    INNER JOIN documento ON movimiento.documento_id = documento.documento_id
                    INNER JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id
                WHERE origen.area_cod LIKE '".$_GET['txtidarea_actual']."' AND movimiento.mov_estatus LIKE '".$_GET['estado']."'  AND
                (DATE_FORMAT(movimiento.mov_fecharegistro,'%Y-%m-%d') = '".$_GET['fecnainicio']."') AND
                area.area_cod LIKE '".$_GET['combo_area']."'
                ORDER BY 
                destino ASC";

$query1 = "SELECT
		documento.documento_id,
         movimiento.mov_estatus,
         documento.doc_nrodocumento as doc_nrodocumento,
		CONCAT_WS(' ',documento.doc_nombreremitente,documento.doc_apepatremitente,documento.doc_apematremitente) AS remitente,
        DATE_FORMAT(movimiento.mov_fecharegistro,'%d/%m/%Y') AS fecharegistro,
        /*origen.area_cod AS id_origen,*/
        documento.doc_folio as doc_folio,
        /*origen.area_nombre AS origen,*/
        IF(CONCAT_WS('',movimiento.area_origen_id,movimiento.areadestino_id)='11','EXTERIOR',origen.area_nombre ) AS origen,
        area.area_cod AS id_destino,
        area.area_nombre AS destino,
        /*documento.doc_fecharegistro,*/
        DATE_FORMAT(movimiento.mov_fecharegistro,'%d/%m/%Y %H:%i:%S') as mov_fecharegistro,
        tipo_documento.tipodo_descripcion,
        /*movimiento.area_origen_id,*/
  
        documento.doc_asunto
        /*origen.area_nombre AS  area_nombre_real*/
        FROM
        movimiento
        LEFT JOIN area as origen ON movimiento.area_origen_id = origen.area_cod
        LEFT JOIN area ON movimiento.areadestino_id = area.area_cod
        INNER JOIN documento ON movimiento.documento_id = documento.documento_id
        INNER JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id

    WHERE origen.area_cod LIKE '".$_GET['txtidarea_actual']."' AND movimiento.mov_estatus LIKE '".$_GET['estado']."'  AND
    (DATE_FORMAT(movimiento.mov_fecharegistro,'%Y-%m-%d') = '".$_GET['fecnainicio']."') AND
    area.area_cod LIKE '".$_GET['combo_area']."'
    ORDER BY 
    destino ASC";



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
      $resultado0 = $mysqli->query($query0);
      $resultado1 = $mysqli->query($query1);
      $resultado4 = $mysqli->query($query1);
      $resultado2 = $mysqli->query($query2);
      $razon    = "";
      $telefono = "";
      $email    = "";
      $codigo   = "";
      $logo     = "";
      while($row2 = $resultado2->fetch_assoc()){
          $razon    = $row2['emp_razon'];
          $telefono = $row2['emp_telefono'];
          $email    = $row2['emp_email'];
          $codigo   = $row2['emp_cod'];
          $logo     = $row2['emp_logo'];
      }
      while($row0 = $resultado0 -> fetch_assoc()){
        $destino = $row0['destino'];
      }
      while($row4 = $resultado4->fetch_assoc()){
        $area    = $row4['origen'];
        
    }
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

        <body>

          <htmlpageheader name="myHeader1" style="display:none;">
            <table width="100%" border="0">
                <tr>
                  <th style="width:50px">
                    <img src="http://localhost:8082/Sistema_MesaPartes_reniec_vs3/Vista/usuario/'.$logo.'" style="width:80px">
                  </th>
                  <th  valign="top" align="center" style="width:300px;border-right: 0px;vertical-align: middle;font-size:16px">
                    &nbsp;&nbsp;'.utf8_encode($razon).'
                  </th>
                  <th  valign="top"  align="center"  style="width:400px;border-left: 0px;">
                  <br>
                  </th>
                  <th style="width:50px"></th>
                  <th  valign="top" align="right" style="width:200px;vertical-align: middle;">
                    Page: {PAGENO}/{nbpg}<br>'.date('d / m / Y').' </th>
                  <th style="width:50px"></th>
                </tr>
                <tr>
                  <th colspan="6"><br></th> 
                </tr>
              </table>
              <table width="100%" border="0"> 
                <tr>
                  <th style="width:50px"></th>
                  <th style="width:100px"></th>
                    <th colspan="2" style="background-color:#DCDCDC;height:30px"> HOJA DE CARGO DIARIA - '.$area.'</th> 
                    <th style=""></th>
                    <th style="width:50px"></th>
                </tr>
                <tr>
                  <th colspan="6"><br></th> 
                </tr> 
            </table>
            <br>
          </htmlpageheader>
          <table border="0" id="table2" style="table-layout:fixed;width: 100%;font-size:10px;">
           ';
           $contador=0;
            
           
           while($row1 = $resultado1->fetch_assoc()){
                /*$nombrepdf=$row1['fecharegistro'];*/
                if($row1['id_destino'] == 2){
                      $contador++;
                            $html.='
                            <tr style="">
                              <td style="width:130px;text-align:left;border-top: 2px solid black;border-right: 0px;height:30px;"><b>Nº REGISTRO</b></td>
                              <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;">'.strtoupper(substr(utf8_encode($row1['documento_id']),0,32)).'</td>
                              <td style="width:200px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;"><b>ESTADO</b> <span style="color:#9B0000;">'.strtoupper(substr(utf8_encode($row1['mov_estatus']),0,32)).'</span></td>
                              <td  style="width:300px;text-align:center;height:30px;border-top: 2px solid black;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>Nº EXPDIENTE</b></td>
                              <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row1['doc_nrodocumento']),0,32)).'</td>
                              <td style="width:100px"><b>Nº FOLIOS</b> '.strtoupper(substr(utf8_encode($row1['doc_folio']),0,32)).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>SOLICITANTE</b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row1['remitente']),0,32)).'</td>
                              <td  style="width:400px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>ASUNTO</b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['doc_asunto']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>DERIVADO A </b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['destino']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>TIPO DOCUMENTO</b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['tipodo_descripcion']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>FECHA REGISTRO</b></td>
                              <td colspan="2" style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['fecharegistro']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>  
                            
                            ';
                                                       
                  }
                  else if($row1['id_destino'] == 3){
                    $contador++;
                            $html.='
                            <tr style="">
                              <td style="width:130px;text-align:left;border-top: 2px solid black;border-right: 0px;height:30px;"><b>Nº REGISTRO</b></td>
                              <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;">'.strtoupper(substr(utf8_encode($row1['documento_id']),0,32)).'</td>
                              <td style="width:200px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;"><b>ESTADO</b> <span style="color:#9B0000;">'.strtoupper(substr(utf8_encode($row1['mov_estatus']),0,32)).'</span></td>
                              <td  style="width:300px;text-align:center;height:30px;border-top: 2px solid black;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>Nº EXPDIENTE</b></td>
                              <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row1['doc_nrodocumento']),0,32)).'</td>
                              <td style="width:100px"><b>Nº FOLIOS</b> '.strtoupper(substr(utf8_encode($row1['doc_folio']),0,32)).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>SOLICITANTE</b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row1['remitente']),0,32)).'</td>
                              <td  style="width:400px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>ASUNTO</b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['doc_asunto']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>DERIVADO A </b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['destino']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>TIPO DOCUMENTO</b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['tipodo_descripcion']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>FECHA REGISTRO</b></td>
                              <td colspan="2" style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['fecharegistro']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>      
                          <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:1150px;"></td>
                              <td colspan="2" style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"></td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>  
                            
                            ';
                }
                  else if($row1['id_destino'] == 4){
                    $contador++;
                            $html.='
                            <tr style="">
                              <td style="width:130px;text-align:left;border-top: 2px solid black;border-right: 0px;height:30px;"><b>Nº REGISTRO</b></td>
                              <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;">'.strtoupper(substr(utf8_encode($row1['documento_id']),0,32)).'</td>
                              <td style="width:200px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;"><b>ESTADO</b> <span style="color:#9B0000;">'.strtoupper(substr(utf8_encode($row1['mov_estatus']),0,32)).'</span></td>
                              <td  style="width:300px;text-align:center;height:30px;border-top: 2px solid black;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>Nº EXPDIENTE</b></td>
                              <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row1['doc_nrodocumento']),0,32)).'</td>
                              <td style="width:100px"><b>Nº FOLIOS</b> '.strtoupper(substr(utf8_encode($row1['doc_folio']),0,32)).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>SOLICITANTE</b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row1['remitente']),0,32)).'</td>
                              <td  style="width:400px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>ASUNTO</b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['doc_asunto']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>DERIVADO A </b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['destino']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>TIPO DOCUMENTO</b></td>
                              <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['tipodo_descripcion']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>
                            <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>FECHA REGISTRO</b></td>
                              <td colspan="2" style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['fecharegistro']).'</td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>      
                          <tr>
                              <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:1150px;"></td>
                              <td colspan="2" style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"></td>
                              <td  style="width:300px;text-align:center;height:30px;"></td>
                            </tr>  
                            
                            ';
                }
                else if($row1['id_destino'] == 5){
                  $contador++;
                          $html.='
                          <tr style="">
                            <td style="width:130px;text-align:left;border-top: 2px solid black;border-right: 0px;height:30px;"><b>Nº REGISTRO</b></td>
                            <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;">'.strtoupper(substr(utf8_encode($row1['documento_id']),0,32)).'</td>
                            <td style="width:200px;text-align:left;border-left: 0px;border-right: 0px;height:30px;border-top: 2px solid black;font-weight:bold;"><b>ESTADO</b> <span style="color:#9B0000;">'.strtoupper(substr(utf8_encode($row1['mov_estatus']),0,32)).'</span></td>
                            <td  style="width:300px;text-align:center;height:30px;border-top: 2px solid black;"></td>
                          </tr>
                          <tr>
                            <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>Nº EXPDIENTE</b></td>
                            <td style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row1['doc_nrodocumento']),0,32)).'</td>
                            <td style="width:100px"><b>Nº FOLIOS</b> '.strtoupper(substr(utf8_encode($row1['doc_folio']),0,32)).'</td>
                            <td  style="width:300px;text-align:center;height:30px;"></td>
                          </tr>
                          <tr>
                            <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>SOLICITANTE</b></td>
                            <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.strtoupper(substr(utf8_encode($row1['remitente']),0,32)).'</td>
                            <td  style="width:400px;text-align:center;height:30px;"></td>
                          </tr>
                          <tr>
                            <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>ASUNTO</b></td>
                            <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['doc_asunto']).'</td>
                            <td  style="width:300px;text-align:center;height:30px;"></td>
                          </tr>
                          <tr>
                            <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>DERIVADO A </b></td>
                            <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['destino']).'</td>
                            <td  style="width:300px;text-align:center;height:30px;"></td>
                          </tr>
                          <tr>
                            <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>TIPO DOCUMENTO</b></td>
                            <td colspan="2" style="width:400px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['tipodo_descripcion']).'</td>
                            <td  style="width:300px;text-align:center;height:30px;"></td>
                          </tr>
                          <tr>
                            <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"><b>FECHA REGISTRO</b></td>
                            <td colspan="2" style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;">'.utf8_encode($row1['fecharegistro']).'</td>
                            <td  style="width:300px;text-align:center;height:30px;"></td>
                          </tr> 
                          <tr>
                          <td style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:1150px;"></td>
                          <td colspan="2" style="width:130px;text-align:left;border-left: 0px;border-right: 0px;height:30px;"></td>
                          <td  style="width:300px;text-align:center;height:30px;"></td>
                        </tr>      
                        
                          ';
              }
              
            }
            if ($contador==0) {
                    $html.='<tr><td style="text-align:center;font-weight:bold"><br><br><br>No se encontraron tr&aacute;mites en el rango de fecha seleccionado</td></tr>';
            }
              $html.='</table><br>
                      </body>
                      </html>';
$mpdf->WriteHTML($html);
$mpdf -> Output('reporte_tramites.pdf', 'D');


?>
