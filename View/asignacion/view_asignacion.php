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
      <h1>Programación</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php" ><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active">Programación</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
          <h3 class="card-title">Programación</h3>
          <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistroAsignacion()"><i class="fas fa-plus"></i>&nbsp;Nuevo registro</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table id="tabla_asignaciones" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th></th> <!-- Columna para la expansión de filas -->
                        <th>Compactador</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Turno</th>
                        <th>Ruta</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
         
          <div class="card-body">
          <div class="row">
          <div class="col-md-4">
                  <label>Seleccione el COMPACTADOR:</label>
                  <select class="select2-danger select2" name="select_compactador_rep" data-dropdown-css-class="select2-danger" id="select_compactador_rep" style="width: 100%;">
                        <option value="">Seleccione una placa</option>
                    </select>
              </div>
    
              <div class="col-md-4">
                  <label>Seleccione el mes:</label>
                  <select id="select_mes" class="form-control">
                                <?php
                                $meses = [
                                    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                                    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                                ];

                                for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT); ?>" <?= ($i == date('m')) ? 'selected' : ''; ?>>
                                        <?= $meses[$i - 1]; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
              </div>
              <div class="col-md-4">
                  <label>&nbsp;</label>
                  <button class="btn btn-primary btn-block" onclick="generarReporte()">
                      <i class="fas fa-file-pdf"></i> Generar Reporte PDF
                  </button>
              </div>
          </div>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</section>





<!-- Modal -->
<div class="modal fade" id="modal_registro_asignacion">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>REGISTRAR ASIGNACIÓN</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="wizard">
          <!-- Paso 1: Selección de Compactador -->
          <div class="step" id="step1">
            <h4>Paso 1: Seleccionar Compactador</h4>
            <select class="select2-danger select2" id="select_compactador" data-dropdown-css-class="select2-danger" style="width: 100%;">
              <option value="">Seleccione un Compactador</option>
            </select>
            <button class="btn btn-primary mt-3" onclick="nextStep(1)">Siguiente</button>
          </div>

        <!-- Paso 2: Selección de Empleados (Múltiple) -->
        <div class="step d-none" id="step2">
          <h4>Paso 2: Seleccionar Empleados</h4>
          <select class="select2-danger select2" id="select_empleados" data-dropdown-css-class="select2-danger" style="width: 100%;" onchange="agregarEmpleado()">
            <option value="">Seleccione un Empleado</option>
          </select>
          <table class="table mt-3">
            <thead>
              <tr>
                <th>Empleado</th>
                <th>Cargo</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody id="empleados_seleccionados">
            </tbody>
          </table>
          <button class="btn btn-secondary mt-3" onclick="prevStep(2)">Anterior</button>
          <button class="btn btn-primary mt-3" onclick="nextStep(2)">Siguiente</button>
        </div>


          <!-- Paso 3: Confirmación -->
          <div class="step d-none" id="step3">
            <h4>Paso 3: Confirmación</h4>
            <p><strong>Compactador:</strong> <span id="confirm_compactador"></span></p>
            <table class="table mt-3">
              <thead>
                <tr>
                  <th>Empleado</th>
                  <th>Cargo</th>
                </tr>
              </thead>
              <tbody id="confirm_empleados">
              </tbody>
            </table>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Fecha Desde(*):</label>
                    <div class="input-group date" data-target-input="nearest">
                        <input type="text" id="txt_fecha_desde" class="form-control datetimepicker-input" data-target="#txt_fecha_desde" data-toggle="datetimepicker"/>
                        <div class="input-group-append" data-target="#txt_fecha_desde" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Fecha Hasta(*):</label>
                    <div class="input-group date" data-target-input="nearest">
                        <input type="text" id="txt_fecha_hasta" class="form-control datetimepicker-input" data-target="#txt_fecha_hasta" data-toggle="datetimepicker"/>
                        <div class="input-group-append" data-target="#txt_fecha_hasta" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group">
                  <label>Turno(*):</label>
                  <select class="select2-danger select2" id="turno" data-dropdown-css-class="select2-danger" style="width: 100%;">
                      <option value="" selected disabled>Seleccione un Turno</option>
                      <option value="Mañana">Mañana</option>
                      <option value="Tarde">Tarde</option>
                      <option value="Noche">Noche</option>
                  </select>
              </div>

              <div class="col-md-6 form-group">
                <label><i class="fas fa-route"></i> Ruta (*)</label>
                <select class="select2 select2-danger form-control" id="ruta" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option value="" selected disabled>Seleccione una Ruta</option>
                </select>
            </div>

          </div>


            <button class="btn btn-secondary mt-3" onclick="prevStep(3)">Anterior</button>
            <button class="btn btn-success mt-3" onclick="guardarAsignacion()">Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->

<script>
      $(".select2").select2();
      $(document).ready(function () {
            moment.locale('es');

            // Inicializar datetimepicker para Fecha Desde con restricción mínima al día actual
            $('#txt_fecha_desde').datetimepicker({
                format: 'DD/MM/YYYY',
                locale: 'es',
                minDate: moment(), // Establecer la fecha mínima como el día actual
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });

            // Inicializar datetimepicker para Fecha Hasta sin permitir fechas anteriores a "Fecha Desde"
            $('#txt_fecha_hasta').datetimepicker({
                format: 'DD/MM/YYYY',
                locale: 'es',
                useCurrent: false, // Evita que "Fecha Hasta" tome la misma fecha de "Fecha Desde"
                icons: {
                    time: "far fa-clock",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                }
            });

            // Evento: Actualizar la fecha mínima de "Fecha Hasta" cuando se seleccione "Fecha Desde"
            $("#txt_fecha_desde").on("change.datetimepicker", function (e) {
                let fechaDesde = e.date ? e.date.clone().startOf('day') : null;
                $('#txt_fecha_hasta').datetimepicker('minDate', fechaDesde);
            });

            // Evento: Validar que "Fecha Hasta" no sea menor que "Fecha Desde"
            $("#txt_fecha_hasta").on("change.datetimepicker", function (e) {
                let fechaDesde = $("#txt_fecha_desde").val();
                let fechaHasta = e.date ? e.date.format('DD/MM/YYYY') : null;

                if (fechaDesde && fechaHasta && moment(fechaHasta, 'DD/MM/YYYY').isBefore(moment(fechaDesde, 'DD/MM/YYYY'))) {
                    Swal.fire("Error", "La fecha hasta no puede ser menor que la fecha desde", "error");
                    $("#txt_fecha_hasta").val(""); // Limpiar el campo inválido
                }
            });
});



</script>

<script src="../js/console_asignacion.js"></script>
