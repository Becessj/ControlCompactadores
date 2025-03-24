<?php
  session_start();
  if (!isset($_SESSION['S_ID'])) {
      header('Location: ../index.php');
  }
?>
<link rel="stylesheet" href="_Plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Combustible</h1>
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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
          <h3 class="card-title">Combustible</h3>
          <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistroCombustible()"><i class="fas fa-plus"></i>&nbsp;Nuevo registro</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table id="tabla_combustible" class="display" style="width:100%">
                    <thead>
                      <tr>
                      <th>#</th>
                            <th>Compactador</th>
                            <th>Fecha</th>
                            <th>Galones</th>
                            <th>Precio x Galon</th>
                            <th>Total</th>
                            <th>Vale</th>
                            <th>Estado</th>
                            <th>Acion</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>#</th>
                            <th>Compactador</th>
                            <th>Fecha</th>
                            <th>Galones</th>
                            <th>Precio x Galon</th>
                            <th>Total</th>
                            <th>Vale</th>
                            <th>Estado</th>
                            <th>Acion</th>
                        </tr>
                    </tfoot>
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


<!-- Modal para Registrar Combustible -->
<div class="modal fade" id="modal_registro_combustible">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>REGISTRAR CARGA DE COMBUSTIBLE</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>Compactador (*):</label>
              <select class="select2-danger select2" name="cmb_placa_registro" data-dropdown-css-class="select2-danger" id="cmb_placa_registro" style="width: 100%;">
              <option value="">Seleccione una placa</option>
                    </select>
                </div>
            </div>
              <!-- Fecha -->
          <div class="col-sm-6">
            <div class="form-group">
              <label>Fecha de Carga (*):</label>
              <div class="input-group date">
                <input type="text" id="txt_fecha_registrar" class="form-control datetimepicker-input" data-target="#txt_fecha_registrar" data-toggle="datetimepicker"/>
                <div class="input-group-append" data-target="#txt_fecha_registrar" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Cantidad de Galones (*):</label>
                <input type="number" class="form-control" placeholder="Ingresar cantidad de Galones" id="cantidad_litros" step="0.01">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                  <label>Precio por Galon (*):</label>
                  <input type="number" class="form-control" placeholder="Ingresar precio por Galon" id="precio_litro" step="0.01">
                </div>
            </div>
            <div class="col-12 row">
              <input type="text" hidden id="txt_igv" name="txt_igv">
              <div class="col-4 form-group clearfix">
                  <div class="icheck-success d-inline">
                      <input type="radio" id="rad_igv_si" value="si" name="igv_option" checked>
                      <label for="rad_igv_si" style="font-size: 15px !important;font-weight: normal;">CON IGV (18%)</label>
                  </div>
              </div>
              <div class="col-4 form-group clearfix">
                  <div class="icheck-danger d-inline">
                      <input type="radio" id="rad_igv_no" value="no" name="igv_option" >
                      <label for="rad_igv_no" style="font-size: 15px !important;font-weight: normal;">SIN IGV</label>
                  </div>
              </div>

            
            </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Total:</label>
                <input type="text" class="form-control" id="total" disabled>
            </div>
        </div>


            <div class="col-sm-6">
                <div class="form-group">
                <label>Vale (*):</label>
                <input type="text" class="form-control" placeholder="Ingresar número de Vale" id="boleta" maxlength="50">
                </div>
            </div>
           <!-- Estado -->
          <div class="col-sm-6">
            <div class="form-group">
              <label>Estado (*):</label>
              <select disabled class="form-control select2" style="width: 100%;">
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
          <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal"><i class="fa fa-times"></i><b> Cerrar</b></button>
          <button type="button" onclick="Registrar_Combustible();" class="btn btn-sm btn-success"><i class="fa fa-plus"></i><b>&nbsp;Registrar</b>&nbsp;</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->


<!-- Modal para Editar Combustible -->
<div class="modal fade" id="modal_editar_combustible">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>EDITAR CARGA DE COMBUSTIBLE</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="txt_id_combustible_editar">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>Compactador (*):</label>
                    <select disabled class="select2-danger select2" name="select_compactador_editar" id="select_compactador_editar" style="width: 100%;"></select>
                </div>
            </div>
                 <!-- Fecha -->
          <div class="col-sm-6">
            <div class="form-group">
              <label>Fecha de Carga (*):</label>
              <div class="input-group date">
                <input type="text" id="fecha_carga_editar" class="form-control datetimepicker-input" data-target="#fecha_carga_editar" data-toggle="datetimepicker"/>
                <div class="input-group-append" data-target="#fecha_carga_editar" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Cantidad de Galones (*):</label>
                <input type="number" class="form-control" id="cantidad_litros_editar" step="0.01">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Precio por Galon (*):</label>
                <input type="number" class="form-control" id="precio_litro_editar" step="0.01">
                </div>
            </div>
                <div class="col-12 row">
              <input type="text" hidden id="txt_igv_editar" name="txt_igv_editar">
              <div class="col-4 form-group clearfix">
                  <div class="icheck-success d-inline">
                      <input disabled type="radio" id="rad_igv_si_editar" value="si" name="igv_option">
                      <label for="rad_igv_si_editar" style="font-size: 15px !important;font-weight: normal;">CON IGV (18%)</label>
                  </div>
              </div>
              <div class="col-4 form-group clearfix">
                  <div class="icheck-danger d-inline">
                      <input disabled type="radio" id="rad_igv_no_editar" value="no" name="igv_option" >
                      <label for="rad_igv_no_editar" style="font-size: 15px !important;font-weight: normal;">SIN IGV</label>
                  </div>
              </div>

            
            </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Total:</label>
                <input type="text" class="form-control" id="total_editar" disabled>
            </div>
        </div>

            <div class="col-sm-6">
                <div class="form-group">
                <label>Vale (*):</label>
                <input type="text" class="form-control" id="boleta_editar" maxlength="50">
                </div>
            </div>
               <!-- Estado -->
          <div class="col-sm-6">
            <div class="form-group">
              <label>Estado (*):</label>
              <select class="form-control select2" style="width: 100%;" id="cbm_estatus">
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
        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal"><i class="fa fa-times"></i><b> Cerrar</b></button>
        <button type="button" onclick="Modificar_Combustible();" class="btn btn-sm btn-success"><i class="fa fa-pen-alt"></i><b>&nbsp;Actualizar</b>&nbsp;</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
<script>
  $(".select2").select2();
  $(document).ready(function () {
    // moment.locale('es');
    $('#txt_fecha_registrar').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        minDate: moment(),
        icons: {
            time: "far fa-clock",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });


    $('#fecha_carga_editar').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        // minDate: moment(),
        icons: {
            time: "far fa-clock",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
});
</script>
<script src="../js/console_combustible.js"></script>
<script src="../js/validador.js"></script>