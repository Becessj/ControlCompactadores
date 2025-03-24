<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Declaraciones</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active">Declaraciones</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de Declaraciones Juradas</h3>
                <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistro()"><i class="fas fa-plus"></i>&nbsp;Nuevo Registro</button>
            </div>
            <div class="card-body">
                <table id="tabla_declaraciones" class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Chofer</th>
                            <th>Placa</th>
                            <th>DNI</th>
                            <th>Peso Neto</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Archivo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Reporte de Declaraciones Juradas</h3>
                <div class="row justify-content-end mb-3 mr-1">
            <!-- Fecha inicio -->
            <div class="col-sm-4">
              <div class="form-group mb-0">
                <label>Desde:</label>
                <div class="input-group date" id="grupo_fecha_inicio" data-target-input="nearest">
                  <input type="text" id="fecha_inicio_reporte" class="form-control datetimepicker-input"
                        data-target="#grupo_fecha_inicio" data-toggle="datetimepicker"/>
                  <div class="input-group-append" data-target="#grupo_fecha_inicio" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Fecha fin -->
            <div class="col-sm-4">
              <div class="form-group mb-0">
                <label>Hasta:</label>
                <div class="input-group date" id="grupo_fecha_fin" data-target-input="nearest">
                  <input type="text" id="fecha_fin_reporte" class="form-control datetimepicker-input"
                        data-target="#grupo_fecha_fin" data-toggle="datetimepicker"/>
                  <div class="input-group-append" data-target="#grupo_fecha_fin" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
            </div>

  <!-- Botón -->
  <div class="col-sm-2 d-flex align-items-end">
    <button class="btn btn-info btn-block" onclick="reporteDeclaracionesEntreFechas()">
      <i class="fas fa-chart-bar"></i> Reporte
    </button>
  </div>
</div>

            </div>

        </div>
    </div>
</section>
<!-- Modal para Registrar Declaración Jurada -->
<div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="modalLabelRegistro" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalLabelRegistro">Registrar Declaración Jurada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_registro" enctype="multipart/form-data">
          <div class="row">
            <!-- Chofer -->
            <div class="col-sm-6">
              <label>Chofer:</label>
              <select class="select2-danger select2" id="select_empleados" name="chofer" data-dropdown-css-class="select2-danger" style="width: 100%;">
                <option value="">Seleccione un Empleado</option>
              </select>
            </div>

            <!-- DNI -->
            <div class="col-sm-3">
              <label>DNI:</label>
              <input type="text" class="form-control" id="txt_dni" name="dni" maxlength="8" required readonly>
            </div>
            <!-- Brevete -->
            <div class="col-sm-3">
              <label>Brevete N°:</label>
              <input type="text" class="form-control" id="txt_brevete" name="breve_nro" required readonly>
            </div>
            <!-- Placa -->
            <div class="col-sm-12">
              <label>Placa:</label>
              <select class="select2-danger select2" id="cmb_placa_registro" name="placa" data-dropdown-css-class="select2-danger" style="width: 100%;">
                <option value="">Seleccione una placa</option>
              </select>
            </div>

          

            <!-- Fecha -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Fecha (*):</label>
                        <div class="input-group date"  data-target-input="nearest">
                            <input type="text" id="txt_fecha" class="form-control datetimepicker-input" data-target="#txt_fecha" data-toggle="datetimepicker"/>
                            <div class="input-group-append" data-target="#txt_fecha" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                </div>
            </div>

            <!-- Hora de Ingreso -->
            <div class="col-sm-3">
              <label>Hora de Ingreso:</label>
              <input type="time" class="form-control" id="txt_hora_ingreso" name="hora_ingreso" required>
            </div>

            <!-- Hora de Salida -->
            <div class="col-sm-3">
              <label>Hora de Salida:</label>
              <input type="time" class="form-control" id="txt_hora_salida" name="hora_salida" required>
            </div>

            <!-- Peso de Ingreso -->
            <div class="col-sm-4">
              <label>Peso de Ingreso (Kg):</label>
              <input type="number" class="form-control" id="txt_peso_ingreso" name="peso_ingreso" required>
            </div>

            <!-- Peso de Salida -->
            <div class="col-sm-4">
              <label>Peso de Salida (Kg):</label>
              <input type="number" class="form-control" id="txt_peso_salida" name="peso_salida" required>
            </div>

            <!-- Cantidad Transportada -->
            <div class="col-sm-4">
              <label>Cantidad Transportada (Kg):</label>
              <input type="number" class="form-control" id="txt_cantidad" name="cantidad" readonly>
            </div>

            <!-- Observaciones -->
            <div class="col-sm-12">
              <label>Observaciones:</label>
              <textarea class="form-control" id="txt_observaciones" name="observaciones" rows="2"></textarea>
            </div>

            <!-- Subir Documento -->
            <div class="col-sm-12">
              <label>Subir Documento (PDF):</label>
              <input type="file" class="form-control" id="archivo_documento" name="archivo" accept=".pdf" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="Registrar_Declaracion()">Registrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal para Editar Declaración Jurada -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="modalLabelEditar" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title" id="modalLabelEditar">Editar Declaración Jurada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_editar" enctype="multipart/form-data">
          <input type="hidden" id="edit_id_declaracion" name="id_declaracion"> <!-- ID para editar -->

          <div class="row">
            <!-- Chofer -->
            <div class="col-sm-6">
              <label>Chofer:</label>
              <select class="select2-danger select2" id="edit_select_empleados" name="chofer" data-dropdown-css-class="select2-danger" style="width: 100%;">
                <option value="">Seleccione un Empleado</option>
              </select>
            </div>

            <!-- DNI -->
            <div class="col-sm-3">
              <label>DNI:</label>
              <input type="text" class="form-control" id="edit_txt_dni" name="dni" maxlength="8" readonly>
            </div>
            <!-- Brevete -->
            <div class="col-sm-3">
              <label>Brevete N°:</label>
              <input type="text" class="form-control" id="edit_txt_brevete" name="breve_nro" readonly>
            </div>

            <!-- Placa -->
            <div class="col-sm-12">
              <label>Placa:</label>
              <select class="select2-danger select2" id="edit_cmb_placa" name="placa" data-dropdown-css-class="select2-danger" style="width: 100%;">
                <option value="">Seleccione una placa</option>
              </select>
            </div>

            <!-- Fecha -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Fecha (*):</label>
                        <div class="input-group date"  data-target-input="nearest">
                            <input type="text" id="edit_txt_fecha" class="form-control datetimepicker-input" data-target="#edit_txt_fecha" data-toggle="datetimepicker"/>
                            <div class="input-group-append" data-target="#edit_txt_fecha" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                </div>
            </div>

            <!-- Hora de Ingreso -->
            <div class="col-sm-3">
              <label>Hora de Ingreso:</label>
              <input type="time" class="form-control" id="edit_txt_hora_ingreso" name="hora_ingreso">
            </div>

            <!-- Hora de Salida -->
            <div class="col-sm-3">
              <label>Hora de Salida:</label>
              <input type="time" class="form-control" id="edit_txt_hora_salida" name="hora_salida">
            </div>

            <!-- Peso de Ingreso -->
            <div class="col-sm-4">
              <label>Peso de Ingreso (Kg):</label>
              <input type="number" class="form-control" id="edit_txt_peso_ingreso" name="peso_ingreso">
            </div>

            <!-- Peso de Salida -->
            <div class="col-sm-4">
              <label>Peso de Salida (Kg):</label>
              <input type="number" class="form-control" id="edit_txt_peso_salida" name="peso_salida">
            </div>

            <!-- Cantidad Transportada -->
            <div class="col-sm-4">
              <label>Cantidad Transportada (Kg):</label>
              <input type="number" class="form-control" id="edit_txt_cantidad" name="cantidad" readonly>
            </div>

            <!-- Observaciones -->
            <div class="col-sm-12">
              <label>Observaciones:</label>
              <textarea class="form-control" id="edit_txt_observaciones" name="observaciones" rows="2"></textarea>
            </div>

            <!-- Mostrar documento actual -->
          <div class="col-sm-12">
              <label>Documento Actual:</label>
              <div id="archivo_actual"></div>
              <input type="hidden" id="edit_archivo_actual" name="archivo_actual">
          </div>

          <!-- Subir Nuevo Documento -->
          <!-- Subir Nuevo Documento -->
          <div class="col-sm-12">
              <label>Actualizar Documento (PDF):</label>
              <input type="file" class="form-control" id="edit_archivo_documento" name="archivo" accept=".pdf">
              <small id="nombre_archivo_actual" class="form-text text-muted"></small>
          </div>


          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="Editar_Declaracion()">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal_archivo_ver_declaracion" >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content form-horizontal" >
            <div class="modal-header">
                
                <h4 class="modal-title"><label >DECLARACIÓN JURADA:&nbsp; </label><label  id="lb_nombrearchivo"></label></h4>
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
                <button class="btn btn-default" type="button" data-dismiss="modal"> <i class="fa fa-close" aria-hidden="true"></i>&nbsp;<b>Cerrar</b></button>
            </div>
        </div>
    </div>
</div>


<script src="../js/console_declaracion.js"></script>
<script src="../js/validador.js"></script>