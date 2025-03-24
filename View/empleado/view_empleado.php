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
        <h1 class="m-0 text-dark">Empleados</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php" ><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active">Empleados</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Empleados</h3>
            <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistroEmpleado()"><i class="fas fa-plus"></i>&nbsp;Nuevo registro</button>
          </div>
            <div class="card-body">
                <table id="tabla_empleados" class="table table-hover">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nombre Completo</th>
                        <!-- <th>Cargo</th> -->
                        <th>Dirección Fiscal</th>
                        <th>Tipo Documento</th>
                        <th>Nro Documento</th>
                            <th align="center" style="text-align: center;width: 80px;word-wrap: break-word;">Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                </tbody>
                <tfoot>
                    <tr>
                    <th>#</th>
                   <th>Código</th>
                        <th>Nombre Completo</th>
                        <!-- <th>Cargo</th> -->
                        <th>Dirección Fiscal</th>
                        <th>Tipo Documento</th>
                        <th>Nro Documento</th>
                      <th align="center" style="text-align: center;width: 80px;word-wrap: break-word;">Acci&oacute;n</th>
                    </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal para Registrar Empleado -->
<div class="modal fade" id="modal_registro_empleado">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>REGISTRAR EMPLEADO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                    <div class="col-lg-6 form-group">
                        <label id="xprogress"></label>
                        <label>Buscar Reniec (*):</label>
                        <div class="input-group margin">
                            <input class="form-control" type="text" placeholder="Ingresar dni" maxlength="8" id="txtdni" name="txtdni" onkeypress="return soloNumeros(event)" onkeyup="if(event.keyCode == 13) Buscar_reniec_GPA('registro')">
                            <span class="input-group-btn">
                                <button onclick="Buscar_reniec_GPA('registro')" id="btn_reniec" title="Buscar por reniec" type="button" class="btn bg-gradient-primary btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Nombre (*):</label>
                        <input class="form-control" type="text" placeholder="Ingresar nombre" maxlength="150" id="txt_nombres" name="txt_nombres" onkeypress="return soloLetras(event)" onkeyup="ActualizarNombreCompleto()" >
                    </div>
                    <div class="col-lg-6 form-group">
                        <label>Apellido Paterno (*):</label>
                        <input class="form-control" type="text" placeholder="Ingresar apellido paterno" maxlength="70" id="txt_apellido_paterno" name="txt_apellido_paterno" onkeypress="return soloLetras(event)" onkeyup="ActualizarNombreCompleto()" >
                    </div>
                    <div class="col-lg-6 form-group">
                        <label>Apellido Materno (*):</label>
                        <input class="form-control" type="text" placeholder="Ingresar apellido materno" maxlength="70" id="txt_apellido_materno" name="txt_apellido_materno" onkeypress="return soloLetras(event)" onkeyup="ActualizarNombreCompleto()" >
                    </div>

            <!-- Nombre Completo -->
            <div class="col-sm-8">
                <div class="form-group">
                    <label>Nombre Completo:</label>
                    <input type="text" class="form-control" id="txt_nombre_completo" readonly>
                </div>
            </div>
             <!-- Celular -->
             <div class="col-sm-4">
                <div class="form-group">
                    <label>Celular (*):</label>
                    <input type="text" class="form-control" id="txt_celular" placeholder="Ingresar Celular">
                </div>
            </div>
             <!-- Email -->
             <div class="col-sm-6">
                <div class="form-group">
                    <label>Email (*):</label>
                    <input type="text" class="form-control" id="txt_email" placeholder="Ingresar Email">
                </div>
            </div>
            <!-- Dirección Fiscal -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Dirección Fiscal (*):</label>
                    <input type="text" class="form-control" id="txt_direccion" placeholder="Ingresar Dirección Fiscal">
                </div>
            </div>
            <!-- Tipo Documento -->
            <!-- <div class="col-sm-6">
                <div class="form-group">
                    <label>Tipo Documento (*):</label>
                    <select class="form-control" id="select_tipo_doc">
                        <option value="">Seleccione Tipo</option>
                        <option value="DNI">DNI</option>
                        <option value="CARNET EXTRANJERÍA">Carnet Extranjería</option>
                    </select>
                </div>
            </div> -->
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-success btn-sm" data-dismiss="modal">
              <i class="fa fa-times"></i> Cerrar
          </button>
          <button type="button" onclick="Registrar_Empleado();" class="btn btn-success btn-sm">
              <i class="fa fa-plus"></i> Registrar
          </button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->



<!-- Modal para Editar Empleado -->
<div class="modal fade" id="modal_editar_empleado">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>EDITAR EMPLEADO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <div class="row">
        <input type="hidden" id="txt_id_empleado_editar">
                    <div class="col-lg-6 form-group">
                        <label id="xprogress"></label>
                        <label>Buscar Reniec (*):</label>
                        <div class="input-group margin">
                            <input class="form-control" type="text" placeholder="Ingresar dni" maxlength="8" id="txt_nro_doc_editar" name="txt_nro_doc_editar" onkeypress="return soloNumeros(event)" onkeyup="if(event.keyCode == 13) Buscar_reniec_GPA('edicion')">
                            <span class="input-group-btn">
                                <button onclick="Buscar_reniec_GPA('edicion')" id="btn_reniec" title="Buscar por reniec" type="button" class="btn bg-gradient-primary btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Nombre (*):</label>
                        <input class="form-control" type="text" placeholder="Ingresar nombre" maxlength="150" id="txt_nombres_editar" name="txt_nombres_editar" onkeypress="return soloLetras(event)" onkeyup="ActualizarNombreCompleto()" >
                    </div>
                    <div class="col-lg-6 form-group">
                        <label>Apellido Paterno (*):</label>
                        <input class="form-control" type="text" placeholder="Ingresar apellido paterno" maxlength="70" id="txt_apellido_paterno_editar" name="txt_apellido_paterno_editar" onkeypress="return soloLetras(event)" onkeyup="ActualizarNombreCompleto()" >
                    </div>
                    <div class="col-lg-6 form-group">
                        <label>Apellido Materno (*):</label>
                        <input class="form-control" type="text" placeholder="Ingresar apellido materno" maxlength="70" id="txt_apellido_materno_editar" name="txt_apellido_materno_editar" onkeypress="return soloLetras(event)" onkeyup="ActualizarNombreCompleto()" >
                    </div>

            <!-- Nombre Completo -->
            <div class="col-sm-7">
                <div class="form-group">
                    <label>Nombre Completo:</label>
                    <input type="text" class="form-control" id="txt_nombre_completo_editar" readonly>
                </div>
            </div>
             <!-- Celular -->
             <div class="col-sm-5">
                <div class="form-group">
                    <label>Celular (*):</label>
                    <input type="text" class="form-control" id="txt_celular_editar" placeholder="Ingresar Celular">
                </div>
            </div>
             <!-- Email -->
             <div class="col-sm-6">
                <div class="form-group">
                    <label>Email (*):</label>
                    <input type="text" class="form-control" id="txt_email_editar" placeholder="Ingresar Email">
                </div>
            </div>
            <!-- Dirección Fiscal -->
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Dirección Fiscal (*):</label>
                    <input type="text" class="form-control" id="txt_direccion_editar" placeholder="Ingresar Dirección Fiscal">
                </div>
            </div>
            <!-- Tipo Documento -->
            <!-- <div class="col-sm-6">
                <div class="form-group">
                    <label>Tipo Documento (*):</label>
                    <select class="form-control" id="select_tipo_doc">
                        <option value="">Seleccione Tipo</option>
                        <option value="DNI">DNI</option>
                        <option value="CARNET EXTRANJERÍA">Carnet Extranjería</option>
                    </select>
                </div>
            </div> -->
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-success btn-sm" data-dismiss="modal">
              <i class="fa fa-times"></i> Cerrar
          </button>
          <button type="button" onclick="Modificar_Empleado();" class="btn btn-success btn-sm">
              <i class="fa fa-plus"></i> Actualizar
          </button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
<script src="../js/validador.js"></script>
<script src="../js/console_empleado.js"></script>

   