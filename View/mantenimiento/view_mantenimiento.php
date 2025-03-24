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
        <h1 class="m-0 text-dark">Mantenimientos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php" ><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active">Empleado</li>
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
          <h3 class="card-title">Listado de Mantenimientos</h3>
          <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistro()"><i class="fas fa-plus"></i>&nbsp;Nuevo registro</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table id="tabla_mantenimientos" class="display" style="width:100%">
                    <thead>
                      <tr>
                      <th>#</th>
                    <th>Placa</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Repuestos</th>
                    <th>Categoría</th>             
                    <th>Fecha programada</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>#</th>
                    <th>Placa</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Repuestos</th>
                    <th>Categoría</th>             
                    <th>Fecha programada</th>
                    <th>Estado</th>
                    <th>Acciones</th>
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


<!-- Modal -->
<div class="modal fade" id="modal_registro">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>REGISTRAR MANTENIMIENTO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-6 form-group">
            <label>Compactador (*)</label>
                <div class="d-flex">
                    <select class="select2-danger select2" name="cmb_placa_registro" data-dropdown-css-class="select2-danger" id="cmb_placa_registro" style="width: 100%;" onchange="mostrarBotonVerCambios()">
                        <option value="">Seleccione una placa</option>
                    </select>
                    <button id="btn_ver_cambios" class="btn btn-success ml-2" style="display: none;" onclick="verCambiosPlaca()">
                        <i class="fa fa-search"></i> 
                    </button>
                </div>
            </div>

            <div class="col-md-12">
              <div class="col-12 row">
                  <label>Tipo (*)</label>
              </div>
              <div class="col-12 row">
                  <input type="text" hidden id="txt_tipo_registro" name="txt_tipo_registro">
                  <div class="col-4 form-group clearfix">
                      <div class="icheck-danger d-inline">
                          <input type="radio" id="rad_tipo1" value="PREVENTIVO" name="tipo_registro" checked>
                          <label for="rad_tipo1" style="font-size: 15px !important;font-weight: normal;">PREVENTIVO</label>
                      </div>
                  </div>
                  <div class="col-4 form-group clearfix">
                      <div class="icheck-primary d-inline">
                          <input type="radio" id="rad_tipo2" value="CORRECTIVO" name="tipo_registro">
                          <label for="rad_tipo2" style="font-size: 15px !important;font-weight: normal;">CORRECTIVO</label>
                      </div>
                  </div>
                  <div class="col-4 form-group clearfix">
                      <div class="icheck-success d-inline">
                          <input type="radio" id="rad_tipo3" value="DESINFECCIÓN" name="tipo_registro">
                          <label for="rad_tipo3" style="font-size: 15px !important;font-weight: normal;">DESINFECCIÓN</label>
                      </div>
                  </div>
              </div>
          </div>

            <div class="col-sm-6">
                <div class="form-group">
                      <label>Categoría (*)</label>
              <select class="select2-danger select2" name="cmb_categoria_registro" data-dropdown-css-class="select2-danger" id="cmb_categoria_registro" style="width: 100%;">
              <option value="">Seleccione una categoría</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Fecha de Mantenimiento (*):</label>
                        <div class="input-group date"  data-target-input="nearest">
                            <input type="text" id="txt_fecha" class="form-control datetimepicker-input" data-target="#txt_fecha" data-toggle="datetimepicker"/>
                            <div class="input-group-append" data-target="#txt_fecha" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                </div>
            </div>
      
            <div class="col-sm-12">
                <div class="form-group">
                <label>Descripción (*):</label>
                <textarea class="form-control" placeholder="Ingresar descripción" id="txt_descripcion" rows="4"></textarea>

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
          <button type="button" style="cursor:pointer;" onclick="Registrar_Mantenimiento();" class="btn btn-sm btn-success"><i class="fa fa-plus"></i><b>&nbsp;Registrar</b>&nbsp;</button>&nbsp;&nbsp;
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
<!-- Modal para Editar Mantenimiento -->
<div class="modal fade" id="modal_editar_mantenimiento">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>EDITAR MANTENIMIENTO</b></h5>
        <button type="button" class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="txt_id_editar">
          <input type="hidden" id="txt_idplaca_editar">
          <input type="hidden" id="txt_idcategoria_editar">

          <!-- Compactador -->
          <div class="col-md-6 form-group">
            <label>Compactador (*)</label>
            <select class="select2-danger select2" id="cmb_placa_editar" style="width: 100%;" disabled></select>
          </div>

          <!-- Tipo de Mantenimiento con Radio Buttons -->
          <div class="col-md-12">
            <div class="col-12 row">
              <label>Tipo (*)</label>
            </div>
            <div class="col-12 row">
              <div class="col-4 form-group clearfix">
                <div class="icheck-danger d-inline">
                  <input disabled type="radio" id="rad_tipo_editar1" value="PREVENTIVO" name="tipo_editar">
                  <label for="rad_tipo_editar1" style="font-size: 15px;">PREVENTIVO</label>
                </div>
              </div>
              <div class="col-4 form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input disabled type="radio" id="rad_tipo_editar2" value="CORRECTIVO" name="tipo_editar">
                  <label for="rad_tipo_editar2" style="font-size: 15px;">CORRECTIVO</label>
                </div>
              </div>
              <div class="col-4 form-group clearfix">
                <div class="icheck-success d-inline">
                  <input disabled type="radio" id="rad_tipo_editar3" value="DESINFECCIÓN" name="tipo_editar">
                  <label for="rad_tipo_editar3" style="font-size: 15px;">DESINFECCIÓN</label>
                </div>
              </div>
            </div>
          </div>

          <!-- Categoría -->
          <div class="col-sm-6">
            <div class="form-group">
              <label>Categoría (*)</label>
              <select disabled class="select2-danger select2" id="cmb_categoria_editar" style="width: 100%;"></select>
            </div>
          </div>

          <!-- Fecha -->
          <div class="col-sm-6">
            <div class="form-group">
              <label>Fecha de Mantenimiento (*):</label>
              <div class="input-group date">
                <input type="text" id="txt_fecha_editar" class="form-control datetimepicker-input" data-target="#txt_fecha_editar" data-toggle="datetimepicker"/>
                <div class="input-group-append" data-target="#txt_fecha_editar" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>

          <!-- Descripción -->
          <div class="col-sm-12">
            <div class="form-group">
              <label>Descripción (*):</label>
              <textarea class="form-control" id="txt_descripcion_editar" rows="4"></textarea>
            </div>
          </div>

          <!-- Estado -->
          <div class="col-sm-6">
            <div class="form-group">
              <label>Estado (*):</label>
              <select class="form-control select2" id="cbm_estatus">
                <option value="ACTIVO">ACTIVO</option>
                <option value="INACTIVO">INACTIVO</option>
              </select>
            </div>
          </div>

          <div class="col-lg-12 form-group" style="text-align: left; font-weight: bold; color: #9B0000;">
            Campos Obligatorios (*)
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-success" data-dismiss="modal">
          <i class="fa fa-times"></i><b> Cerrar</b>
        </button>
        <button type="button" onclick="Modificar_Mantenimiento();" class="btn btn-sm btn-success">
          <i class="fa fa-pen-alt"></i><b>&nbsp;Actualizar</b>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
<!-- Modal Registro Repuesto-->
<!-- Modal Registro Repuesto-->
<div class="modal fade" id="modal_repuesto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestionar Repuestos del Mantenimiento</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="txt_id_mantenimiento">
                <input type="hidden" id="txt_id_compactador">

                <!-- Formulario para agregar repuestos -->
                <div class="row">
                <div class="col-lg-9 form-group">
                    <label for="cmb_repuesto">Repuesto</label>
                        <select class="select2-danger select2 form-control" name="cmb_repuesto" 
                            data-dropdown-css-class="select2-danger" id="cmb_repuesto" style="width: 100%;">

                        </select>
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="txt_cantidad">Cantidad</label>
                        <input type="number" id="txt_cantidad" class="form-control" placeholder="Ingresa cantidad" min="1">
                    </div>
                    <div class="col-lg-6 form-group">
                    <label>Fecha de Uso (*):</label>
                        <div class="input-group date"  data-target-input="nearest">
                            <input disabled type="text" id="txt_fecha_mante_repuesto" class="form-control datetimepicker-input" data-target="#txt_fecha_mante_repuesto" data-toggle="datetimepicker"/>
                            <div class="input-group-append" data-target="#txt_fecha_mante_repuesto" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                      </div>

                </div>
                <div class="mt-3 text-right">
                    <button type="button" class="btn btn-success" onclick="agregarRepuestoATabla()">
                        <i class="fa fa-plus"></i> Agregar
                    </button>
                </div>

                <hr>

              

                <div class="card-body">
            <div class="table-responsive">
                <table id="tabla_repuestos" class="display" style="width:100%">
                    <thead>
                      <tr>
            
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Fecha de Uso</th>
                                <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
         
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Fecha de Uso</th>
                                <th>Acciones</th>
                        </tr>
                    </tfoot>
                  </table>
            </div>
          </div>

          
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="guardarRepuestosBD()">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal para ver los cambios de la placa -->
<!-- Modal para ver los cambios de la placa -->
<div class="modal fade" id="modal_ver_cambios" tabindex="-1" role="dialog" aria-labelledby="modalVerCambiosLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Historial de Cambios de Repuestos</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="tabla_cambios_placa" class="display" style="width:100%">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Frecuencia de Cambio</th>
                <th>Último Uso</th>
              </tr>
            </thead>
            <tbody>
              <!-- Los datos se llenarán dinámicamente con JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">
          <i class="fa fa-times"></i> Cerrar
        </button>
      </div>
    </div>
  </div>
</div>



<script>
  $(".select2").select2();

  $(document).ready(function () {
    moment.locale('es');
    $('#txt_fecha').datetimepicker({
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

    $('#txt_fecha_editar').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        defaultDate: null,
        icons: {
            time: "far fa-clock",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    $('#txt_fecha_mante_repuesto').datetimepicker({
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
    $("input[name='tipo_registro']").change(function () {
        var tipoSeleccionado = $("input[name='tipo_registro']:checked").val();
        if (tipoSeleccionado === "DESINFECCIÓN") {
            // Buscar la opción correcta dentro del select
            var opcionDesinfeccion = $("#cmb_categoria_registro option").filter(function () {
                return $(this).text().trim().toLowerCase() === "desinfección"; // 🔥 Asegura que coincida correctamente
            }).val();

            if (opcionDesinfeccion) {
                $("#cmb_categoria_registro").val(opcionDesinfeccion).trigger("change");
            }

            $("#cmb_categoria_registro").prop("disabled", true); // Bloquea el select
        } else {
            $("#cmb_categoria_registro").val("").trigger("change"); // Resetea si cambia de opción
            $("#cmb_categoria_registro").prop("disabled", false); // Desbloquea el select
        }
    });
});


</script>

<script src="../js/console_mantenimiento.js"></script>
<script src="../js/validador.js"></script>
   