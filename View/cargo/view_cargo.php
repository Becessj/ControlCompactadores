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
        <h1 class="m-0 text-dark">Asignación de Cargos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active">Cargos</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Listado de Cargos</h3>
        <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistroCargo()">
          <i class="fas fa-plus"></i>&nbsp;Nuevo Cargo
        </button>
      </div>
      <div class="card-body">
        <table id="tabla_cargos" class="table table-hover">
          <thead>
            <tr>
              <th> #</th>
              <th>Empleado</th>
              <th>Nombre Completo</th>
              <th>Cargo</th>
              <th>Área</th>
              <th>Dirección Fiscal</th>
              <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Modal para Registrar Cargo -->
<div class="modal fade" id="modal_registro_cargo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>REGISTRAR CARGO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 form-group">
            <label>Empleado (*):</label>
            <select class="select2-danger select2" id="select_empleado" style="width: 100%;">
              <option value="">Seleccione un empleado</option>
            </select>
          </div>
          
          <div class="col-sm-6">
            <div class="form-group">
              <label>Cargo (*):</label>
              <select class="select2-danger select2" id="select_cargo" style="width: 100%;" onchange="habilitarCampos()">
                <option value="">Seleccione un cargo</option>
                <option value="CONDUCTOR">Conductor</option>
                <option value="AYUDANTE">Ayudante</option>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label>Área (*):</label>
              <select class="select2-danger select2" id="select_area" style="width: 100%;">
                <option value="ALMACEN">ALMACEN</option>
              </select>
            </div>
          </div>
          <div class="row">
                <div class="col-md-6 form-group">
                    <label>Fecha Inicio(*):</label>
                    <div class="input-group date" data-target-input="nearest">
                        <input type="text" id="txt_fecha_inicio" class="form-control datetimepicker-input" data-target="#txt_fecha_inicio" data-toggle="datetimepicker"/>
                        <div class="input-group-append" data-target="#txt_fecha_inicio" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 form-group">
                    <label>Fecha Fin(*):</label>
                    <div class="input-group date" data-target-input="nearest">
                        <input type="text" id="txt_fecha_fin" class="form-control datetimepicker-input" data-target="#txt_fecha_fin" data-toggle="datetimepicker"/>
                        <div class="input-group-append" data-target="#txt_fecha_fin" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>

      <!-- Sección para Conductor (Oculta por defecto) -->
      <div id="conductorFields" style="display: none; width: 100%;">
        <div class="row">
        <div class="col-md-3">
            <div class="form-group">
              <label for="select_categoria">Categoría:</label>
              <select id="select_categoria" class="form-control">
                <option value="">Seleccione una categoría</option>
                <option value="A-I">A-I</option>
                <option value="A-II">A-II</option>
                <option value="A-IIC">A-IIC</option>
              </select>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="txt_brevete">Brevete:</label>
              <input type="text" id="txt_brevete" class="form-control">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="txt_fecha_vencimiento">Fecha Vencimiento:</label>
              <div class="input-group date" data-target-input="nearest">
                        <input type="text" id="txt_fecha_vencimiento" class="form-control datetimepicker-input" data-target="#txt_fecha_vencimiento" data-toggle="datetimepicker"/>
                        <div class="input-group-append" data-target="#txt_fecha_vencimiento" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
            </div>
          </div>
        </div>
      </div>


          <div class="col-lg-12 form-group" style="text-align: left;font-weight: bold;color: #9B0000">
            Campos Obligatorios (*)
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal">
          <i class="fa fa-times"></i><b> Cerrar</b>
        </button>
        <button type="button" onclick="Registrar_Cargo();" class="btn btn-sm btn-success">
          <i class="fa fa-plus"></i><b>&nbsp;Registrar</b>&nbsp;
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Editar Cargo -->
<div class="modal fade" id="modal_editar_cargo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>EDITAR CARGO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="txt_id_cargo_editar">

          <div class="col-md-6 form-group">
            <label>Empleado (*):</label>
            <select class="select2-danger select2" id="select_empleado_editar" style="width: 100%;"></select>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label>Cargo (*):</label>
              <select class="select2-danger select2" id="select_cargo_editar" style="width: 100%;" onchange="habilitarCamposEdit()">
                <option value="">Seleccione un cargo</option>
                <option value="CONDUCTOR">Conductor</option>
                <option value="AYUDANTE">Ayudante</option>
              </select>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label>Área (*):</label>
              <select class="select2-danger select2" id="select_area_editar" style="width: 100%;">
                <option value="ALMACEN">ALMACEN</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
                <div class="form-group">
                    <label>Fecha Inicio (*):</label>
                        <div class="input-group date"  data-target-input="nearest">
                            <input type="text" id="txt_fecha_inicio_editar" class="form-control datetimepicker-input" data-target="#txt_fecha_inicio_editar" data-toggle="datetimepicker"/>
                            <div class="input-group-append" data-target="#txt_fecha_inicio_editar" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Fecha Fin (*):</label>
                        <div class="input-group date"  data-target-input="nearest">
                            <input type="text" id="txt_fecha_fin_editar" class="form-control datetimepicker-input" data-target="#txt_fecha_fin_editar" data-toggle="datetimepicker"/>
                            <div class="input-group-append" data-target="#txt_fecha_fin_editar" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                </div>
            </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Estado (*):</label>
              <select class="form-control select2" id="cbm_estatus" style="width: 100%;">
                <option value="A">ACTIVO</option>
                <option value="I">INACTIVO</option>
              </select>
            </div>
          </div>

          <!-- Sección para Conductor (Oculta por defecto) -->
          <div id="conductorFieldsEdit" style="display: none; width: 100%;">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="select_categoria_edit">Categoría:</label>
                  <select id="select_categoria_edit" class="form-control">
                    <option value="">Seleccione una categoría</option>
                    <option value="A-I">A-I</option>
                    <option value="A-II">A-II</option>
                    <option value="A-IIC">A-IIC</option>
                  </select>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="txt_brevete_edit">Brevete:</label>
                  <input type="text" id="txt_brevete_edit" class="form-control">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="txt_fecha_vencimiento_edit">Fecha Vencimiento:</label>


                  <div class="input-group date"  data-target-input="nearest">
                            <input type="text" id="txt_fecha_vencimiento_edit" class="form-control datetimepicker-input" data-target="#txt_fecha_vencimiento_edit" data-toggle="datetimepicker"/>
                            <div class="input-group-append" data-target="#txt_fecha_vencimiento_edit" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>


                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 form-group" style="text-align: left;font-weight: bold;color: #9B0000">
            Campos Obligatorios (*)
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
          <i class="fa fa-times"></i> Cerrar
        </button>
        <button type="button" onclick="Editar_Cargo();" class="btn btn-sm btn-primary">
          <i class="fa fa-save"></i> Editar
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Fin Modal -->

<script src="../js/console_empleado.js"></script>
<script src="../js/console_webapi.js"></script>
