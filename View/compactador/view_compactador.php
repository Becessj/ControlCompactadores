<?php
  session_start();
  if (!isset($_SESSION['S_ID'])) {
      header('Location: ../index.php');
  }
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Compactadores</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php" ><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active">Compactador</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Compactadores</h3>
            <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistro()">
                <i class="fas fa-plus"></i>&nbsp;Nuevo registro
            </button>
        </div>
        <div class="card-body">
            <div class="col-12" style="text-align: right;">
                <label><b>Estado de Documentos:</b></label>
                <span style="background-color: green; color: white; padding: 5px 10px; border-radius: 5px;">🟢 AL DÍA</span>
                <span style="background-color: #ff7e00; color: white; padding: 5px 10px; border-radius: 5px;">🟠 INCOMPLETO</span>
                <span style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px;">🔴 VENCIDO</span>
                <span style="background-color: gray; color: white; padding: 5px 10px; border-radius: 5px;">⚪ SIN DOCUMENTOS</span>
            </div>
            <table id="tabla_compactadores" class="table table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th style="width: 150px;word-wrap: break-word;">Descripción</th>
                        <th>Marca</th>
                        <th style="text-align: center;width: 30px;word-wrap: break-word;">Más Datos</th>
                        <th>Modelo</th>
                        <th>Estado</th>
                        <th align="center" style="text-align: center;width: 80px;word-wrap: break-word;">Acción</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Código</th>
                        <th style="width: 50px;word-wrap: break-word;">Descripción</th>
                        <th>Marca</th>
                        <th style="text-align: center;width: 30px;word-wrap: break-word;">Más Datos</th>
                        <th>Modelo</th>
                        <th>Estado</th>
                        <th align="center" style="text-align: center;width: 80px;word-wrap: break-word;">Acción</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_registro">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>REGISTRAR COMPACTADOR</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>Placa (*):</label>
                <input type="text" class="form-control" placeholder="Ingresar placa" id="txt_placa" maxlength="7"  >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Descripción (*):</label>
                <input type="text" class="form-control" placeholder="Ingresar descripción" id="txt_descripcion" maxlength="100"  onkeypress="return soloLetras(event)">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Marca (*):</label>
                <input type="text" class="form-control" placeholder="Ingresar marca" id="txt_marca" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Modelo (*):</label>
                <input type="text" class="form-control" placeholder="Ingresar modelo" id="txt_modelo" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Estado (*):</label>
                <input type="text" class="form-control" placeholder="ACTIVO" readonly="" style="text-align:center;">
                </div>
            </div>
            <div class="col-lg-12 form-group" style="text-align: left;font-weight: bold;color: #9B0000">
                Campos Obligatorios (*)
            </div> 
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal"><i class="fa fa-times"></i><b> Cerrar</b></button>
          <button type="button" style="cursor:pointer;" onclick="Registrar_Compactador();" class="btn btn-sm btn-success"><i class="fa fa-plus"></i><b>&nbsp;Registrar</b>&nbsp;</button>&nbsp;&nbsp;
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->

<!-- Modal -->
<div class="modal fade" id="modal_editar_compactador">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>MODIFICAR DATOS DEL COMPACTADOR</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <input type="text" id="txt_id_editar" hidden >
            <div class="col-sm-6">
                <div class="form-group">
                <label>Placa (*):</label>
                <input type="text" class="form-control" placeholder="Ingresar placa" id="txt_placa_editar" readonly>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Descripción (*):</label>
                <input type="text" class="form-control" placeholder="Ingresar descripción" id="txt_descripcion_editar" maxlength="100"  >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Marca (*):</label>
                <input type="text" class="form-control" placeholder="Ingresar marca" id="txt_marca_editar" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Modelo (*):</label>
                <input type="text" class="form-control" placeholder="Ingresar modelo" id="txt_modelo_editar" >
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Estatus (*):</label>
                    <select class="form-control select2" style="width: 100%;"  id="cbm_estatus">
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12 form-group" style="text-align: left;font-weight: bold;color: #9B0000">
                Campos Obligatorios (*)
            </div> 
        </div>
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal"><i class="fa fa-times"></i><b> Cerrar</b></button>
          <button type="button" style="cursor:pointer;" onclick="Modificar_Compactador();" class="btn btn-sm btn-success"><i class="fa fa-pen-alt"></i><b>&nbsp;Actualizar</b>&nbsp;</button>&nbsp;&nbsp;
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->

<div class="modal fade" id="modal_ver_documento">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <!-- Encabezado del Modal -->
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">
          <i class="fas fa-truck"></i> Compactador con Placa de Rodaje: <span id="lbl_codigo"></span>
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="form_subir_documento" enctype="multipart/form-data">
          <input type="hidden" id="id_compactador_doc">

          <!-- Navegación entre pestañas -->
          <div class="card-header d-flex p-0 bg-light">
            <ul class="nav nav-pills ml-auto p-2">
              <li class="nav-item">
                <a class="nav-link active" href="#tab_1" data-toggle="tab">
                  <i class="fas fa-info-circle"></i> Información
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tab_2" data-toggle="tab">
                  <i class="fas fa-file-upload"></i> Subir Documento
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tab_3" data-toggle="tab">
                  <i class="fas fa-folder-open"></i> Documentos Adjuntos
                </a>
              </li>
            </ul>
          </div>

          <div class="card-body p-0">
            <div class="tab-content">

              <!-- Pestaña 1: Información del Compactador -->
              <div class="tab-pane fade show active" id="tab_1">
                <div class="card p-3 shadow-sm">
                  <h5><i class="fas fa-truck"></i> Información del Compactador</h5>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label><i class="fas fa-tag"></i> Descripción:</label>
                      <input type="text" class="form-control" id="txt_descripcion_ver" readonly style="background-color: white;">
                    </div>
                    <div class="col-md-6 form-group">
                      <label><i class="fas fa-industry"></i> Marca:</label>
                      <input type="text" class="form-control" id="txt_marca_ver" readonly style="background-color: white;">
                    </div>
                    <div class="col-md-6 form-group">
                      <label><i class="fas fa-car"></i> Modelo:</label>
                      <input type="text" class="form-control" id="txt_modelo_ver" readonly style="background-color: white;">
                    </div>
                    <div class="col-md-6 form-group">
                      <label><i class="fas fa-check-circle"></i> Estado:</label>
                      <input type="text" class="form-control" id="txt_estado_ver" readonly style="background-color: white;">
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pestaña 2: Subir Documento -->
              <div class="tab-pane fade" id="tab_2">
                <div class="card shadow-sm">
                  <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-file-upload"></i> Subir Nuevo Documento</h5>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <!-- Tipo de Documento -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><i class="fas fa-file-alt"></i> Tipo de Documento (*)</label>
                          <select class="form-control" id="tipo_documento">
                            <option value="SOAT">SOAT</option>
                            <option value="REVISION TECNICA">REVISIÓN TÉCNICA</option>
                            <option value="TARJETA DE PROPIEDAD">TARJETA DE PROPIEDAD</option>
                          </select>
                        </div>
                      </div>

                      <!-- Fecha de Expiración -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label><i class="fas fa-calendar-alt"></i> Fecha de Expiración (*)</label>
                          <div class="input-group">
                            <input type="text" id="txt_fecha_expiracion" class="form-control datetimepicker-input" data-target="#txt_fecha_expiracion" data-toggle="datetimepicker" placeholder="Seleccionar fecha">
                            <div class="input-group-append" data-target="#txt_fecha_expiracion" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Subida de Archivo -->
                    <div class="form-group">
                      <label><i class="fas fa-upload"></i> Adjuntar documento (PDF) (*)</label>
                      <div class="custom-file">
                        <input type="file" id="archivo_documento" accept=".pdf" class="custom-file-input form-control" required>
                        <label class="custom-file-label" id="lb_archivo" for="archivo_documento">Seleccionar Archivo</label>
                      </div>
                    </div>

                    <!-- Botón de Subir Documento -->
                    <div class="text-center mt-3">
                      <button type="button" class="btn btn-lg btn-success" onclick="Subir_Documento()">
                        <i class="fas fa-cloud-upload-alt"></i> Subir Documento
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pestaña 3: Documentos Adjuntos -->
              <div class="tab-pane fade" id="tab_3">
                <div class="card p-3 shadow-sm">
                  <h5><i class="fas fa-folder-open"></i> Lista de Documentos</h5>
                  <table id="tabla_documentos" class="table table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Archivo</th>
                        <th>Expiración</th>
                        <th>Estado</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>
        </form>
      </div>

      <!-- Pie del Modal -->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success btn-sm" data-dismiss="modal">
          <i class="fa fa-times"></i> Cerrar
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal_archivo_ver" >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content form-horizontal" >
            <div class="modal-header">
                
                <h4 class="modal-title"><label >Archivo:&nbsp; </label><label  id="lb_codigoventa"></label></h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="box-body">
                <div class="col-lg-12">
                    <div id="div_pdf"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal"> <i class="fa fa-close" aria-hidden="true"></i>&nbsp;<b>Close</b></button>
            </div>
        </div>
    </div>
</div>


<script src="../js/console_compactador.js"></script>
<script src="../js/validador.js"></script>
<script src="../View/_Plantilla/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
      $(document).ready(function() {
          $('input[type="file"]').on('change', function() {
              var archivo = $(this)[0].files[0]; // Obtiene el archivo
              if (!archivo) return; // Si no hay archivo, salir

              var ext = archivo.name.split('.').pop().toLowerCase(); // Obtiene la extensión en minúsculas
              console.log("Extensión del archivo:", ext);

              var extensionesPermitidas = ["pdf", "docx", "zip", "png", "jpg", "jpeg", "rar", "xlsx", "xls"];
              
              if (!extensionesPermitidas.includes(ext)) {
                  Swal.fire("Extensión no permitida: " + ext, "", "error");
                  limpiarArchivo();
                  return;
              }
              //if (archivo.size > 31457280) { //---- 30 MB 
              //if(archivo.size > 10485760){ // ---> 10 MB
              // Verifica el tamaño del archivo
              if (archivo.size > 1048576) { // 1MB
                  Swal.fire("El archivo seleccionado es demasiado pesado", "Seleccionar un archivo más liviano", "warning");
                  limpiarArchivo();
                  return;
              }

              // Si el archivo es válido, actualizar el nombre en el label y en el campo oculto
              $("#txtformato").val(ext);
              $("#lb_archivo").html(archivo.name); // Muestra el nombre del archivo en el label
          });

          function limpiarArchivo() {
              $("#txtformato").val("");
              $("#archivo_documento").val(""); // Resetea el input
              $("#lb_archivo").html("Seleccionar Archivo"); // Restablece el texto del label
          }
      });
</script>
</section>
