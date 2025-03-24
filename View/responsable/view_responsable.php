<?php
  session_start();

?>
  <link rel="stylesheet" href="../js/material-datetimepicker/bootstrap-material-datetimepicker.css" />
  
<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="modal_estado_cuenta" data-backdrop="static" data-keyboard="false"  id="MiModal" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>ESTADO DE CUENTA</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                    <div class="col-6">
                          <label for="">RESPONSABLE</label>
                        <input type="text" class="form-control" id="txt_responsable">
                  </div>
           
            </div>
            <table id="tabla_estado_cuenta" class="display nowrap" style="width:100%">
                      <thead>
                          <tr>
                              <!-- <th>CONTRIBUYENTE</th> -->
                              <th>PREDIO</th>
                              <th>CUENTA</th>
                              <th>E</th>
                              <th>GENERADOR</th>
                              <th>PERIODO</th>
                              <th>MONTO</th>
                              <th>SERENAZGO</th>
                              <th>INTERES</th>
                              <th>DESCUENTO</th>
                              <th>SUBTOTAL</th>
                              <th>CUENTA_PADRE</th>
                             
                              <th>OBS</th>
                              <th>FECHA</th>
                              <th>DESCRIPCION</th>
                              <th>USUARIO</th>
                              <th>__</th>
                          </tr>
                      </thead>
                  </table>
      </div>
  <!--     <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" style="background:white;color:#28a745">Cerrar</button>
        <button type="button" class="btn btn-success btn-sm" onclick="Imprimir()">Imprimir</button>
      </div> -->
    </div>
  </div>
</div>
<!-- Fin Modal -->
<!-- Modal -->
<div class="modal fade" id="modal_editar_responsable" data-backdrop="static" data-keyboard="false"  id="MiModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>MODIFICAR RESPONSABLE</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-6">
                    <label for="">RESPONSABLE</label>
                  <input type="text" class="form-control" id="txt_responsable_editar" disabled>
             </div>
      <div class="col-6">
                    <label for="">APELLIDO PATERNO</label>
                  <input type="text" class="form-control" id="txt_apaterno_editar" onkeypress="return soloLetras(event)">
             </div>
      <div class="col-6">
                    <label for="">APELLIDO MATERNO</label>
                  <input type="text" class="form-control" id="txt_amaterno_editar" onkeypress="return soloLetras(event)">
             </div>
             <div class="col-6">
                    <label for="">NOMBRES</label>
                  <input type="text" class="form-control" id="txt_nombres_editar" onkeypress="return soloLetras(event)">
             </div>
             <div class="col-6">
                    <label for="">DIRECCIÓN</label>
                  <input type="text" class="form-control" id="txt_direccion_editar" >
             </div>
             <div class="col-6">
                    <label for="">NRO DOCUMENTO</label>
                  <input type="text" class="form-control" id="txt_ndoc_editar" onkeypress="return soloNumeros(event)">
             </div>
             <div class="col-sm-6">
           
           <label>TIPO PERSONA</label>
             <select  id="select_tipopersona_editar" class="form-control" >
                 <option value="N" selected>NATURAL</option>
                 <option value="J">JURIDICO</option>
             </select>
       </div>
             <div class="col-6">
                <label>USUARIO</label>
                <input type="text" class="form-control" id="txt_usuario" value ="<?php echo $_SESSION['S_ID'] ?>" disabled>
                
              </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" style="background:white;color:#28a745">Cerrar</button>
        <button type="button" class="btn btn-success btn-sm" onclick="Modificar_Responsable()">Modificar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
<!-- Modal GENERAR DEUDA -->
<div class="modal fade bd-example-modal-xl" id="modal_generar_deuda" data-backdrop="static" data-keyboard="false" tabindex="-1″ id="MiModal" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>GENERAR DEUDA</b> clave ----><?php echo $_SESSION['S_CLAVE'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>CONTRIBUYENTE</label>
              <input type="hidden" class="form-control" id="txt_clave" value="<?php echo $_SESSION['S_CLAVE'] ?>" disabled>
              <input type="text" class="form-control" id="txt_contribuyente" disabled >
             
            </div>
          </div>
          <div class="col-sm-8">
            <div class="form-group">
              <label>NOMBRE COMPLETO</label>
              <input type="text" class="form-control" id="txt_nomcompleto" disabled>
            </div>
          </div>
      </div>
      </div>
          <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                <div class="card">
                          <div class="card-body">
                            <table id="tabla_predios" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>RESPONSABLE</th>
                                        <th>PREDIO_U</th>
                                        <th>DIRECCION FISCAL PREDIO</th>
                                        <th>AREA TERRENO</th>
                                        <th>TIPO RESP</th>
                                        <th>TIPO</th>
                                    </tr>
                                </thead>
                            </table>
                          </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                <div class="card">
                          <div class="card-body">
                          <div class="container">
                              <div class="row">
                                      <div class="col-sm">
                                        <label>Fecha de emisión</label> 
                                        <input style="font-weight:bold"  type="date" class="form-control bootstrap-material-datetimepicker" v-model="fecha" id="fecha" name="date">
                                      </div>
                                      <div class="col-sm">
                                            <label>Periodo Inicial</label>
                                            <select class="js-example-basic-multiple" id="select_periodo_inicial" onchange="btn_generar_deuda_select()" style="width : 100%" selected > </select>
                                      </div>
                                      <div class="col-sm">
                                            <label>Periodo Final</label>
                                            <select class="js-example-basic-multiple" id="select_periodo_final" onchange="btn_generar_deuda_select()" style="width : 100%" selected> </select>
                                      </div>
                                      <div class="col-sm">
                                      <button type="button" class="btn btn-success" onclick="btn_generar_deuda()"><i class="fa fa-bolt"></i> Generar</button>
                                      </div>
              
                              </div>
                          </div>
                           </div>
                </div>
          </div>
        </div>
      </div>
    </div>


 
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                <div class="card">
                          <div class="card-body">
                            <table id="tabla_deudas_generadas" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>PERIODO</th>
                                        <th>MONTO</th>
                                        <th>GASTO ADMINISTRATIVO</th>
                                        <th>TIPO</th>
                                        <th>PREDIO</th>
                                        <th>E</th>
                                    </tr>
                                </thead>
                            </table>
                          </div>
                </div>
          </div>
        </div>
      </div>
    </div>
<!-- Modal -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" style="background:white;color:#28a745">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->

<!-- Modal CANCELAR RECIBO -->
<div class="modal fade bd-example-modal-xl" id="modal_cancelar_recibo" data-backdrop="static" data-keyboard="false" tabindex="-1″ id="MiModal" role="dialog">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>CANCELAR RECIBO</b> clave ----><?php echo $_SESSION['S_CLAVE'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>CONTRIBUYENTE</label>
              <input type="hidden" class="form-control" id="txt_clave" value="<?php echo $_SESSION['S_CLAVE'] ?>">
              <input type="text" class="form-control" id="txt_contribuyente2" >
             
            </div>
          </div>
          <div class="col-sm-8">
            <div class="form-group">
              <label>NOMBRE COMPLETO</label>
              <input type="text" class="form-control" id="txt_nomcompleto2" >
            </div>
          </div>
      </div>
      </div>
          <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                <div class="card">
                          <div class="card-body">
                            <table id="tabla_predios2" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>RESPONSABLE</th>
                                        <th>DIRECCION FISCAL</th>
                                    </tr>
                                </thead>
                            </table>
                          </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                <div class="card">
                          <div class="card-body">
                          <div class="container">
                          <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                <div class="card">
                          <div class="card-body">
                            <table id="tabla_cuentas_pendientes" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>PREDIO</th>
                                        <th>CUENTA</th>
                                        <th>PERIODO</th>
                                        <th>GENERADOR</th>
                                        <th>OBSERVACION</th>
                                        <th>MONTO</th>
                                        <th>DESCUENTO</th>
                                        <th>SALDO</th>
                                        <th>GASTO ADMINISTRATIVO</th>
                                        <th>FECHA DE EMISION</th>
                                        <th>FECHA DE VENCIMIENTO</th>
                                        <th>DIRECCION</th>
                                    </tr>
                                </thead>
                            </table>
                          </div>
                </div>
          </div>
        </div>
      </div>
    </div>
                          </div>
                           </div>
                </div>
          </div>
        </div>
      </div>
    </div>


 
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                <div class="card">
                          <div class="card-body">
                           <p>Botones</p>
                          </div>
                </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                <div class="card">
                          <div class="card-body">
                            <table id="tabla_cuentas_pendientes" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>PREDIO</th>
                                        <th>CUENTA</th>
                                        <th>GENERADOR</th>
                                        <th>EJERCICIO</th>
                                        <th>MONTO</th>
                                        <th>SERENAZGO</th>
                                        <th>INTERES</th>
                                        <th>DESCUENTO</th>
                                        <th>SUBTOTAL</th>
                                    </tr>
                                </thead>
                            </table>
                          </div>
                </div>
          </div>
        </div>
      </div>
    </div>
<!-- Modal -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" style="background:white;color:#28a745">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
<!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><b>Responsable</b> </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php" ><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active"> Responsable</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
 <section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body" style="color:#000000;font-size:small;">
              <div class="row">
                <div class="col-md-10">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title"><b>Listado de Responsables</b></h3>
                      <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="">
                        <div class="row">
                          
                          <div class="col-md-12" style="text-align: left;font-weight: bold;color: #9B0000">
                          <table id="tabla_responsable" class="display" style="width:100%">
                          <thead>
                              <tr>
                                  <th></th>
                                  <th>RESPONSABLE</th>
                                  <th>NOMBRE COMPLETO</th>
                                  <th>DIRECCION FISCAL</th>
                                  <th>Acción 1</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                              <th>#</th>
                                  <th>RESPONSABLE</th>
                                  <th>NOMBRE COMPLETO</th>
                                  <th>DIRECCION FISCAL</th>
                                  <th></th>
                              </tr>
                          </tfoot>
                      </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="card card-danger">
                    <div class="card-header"  style="background-color: #8900B0;">
                      <h3 class="card-title"><b>Botones</b></h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12 form-group" style="text-align:left;font-weight:bold;color: #9B0000">
                          <div class="col-md-12 fom-group">
                            <button onclick="GenerarDeuda()"  class="btn btn-primary btn-block" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="far fa-arrow-alt-circle-right"></i> Generar Deuda</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-warning btn-block" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="far fa-arrow-alt-circle-right "></i> Estado de Cuenta</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-secondary btn-block" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="fas fa-plus"></i> Liquidación</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Cancelar_Recibo()"  class="btn btn-danger btn-block"><i class="fas fa-users-slash  "></i> Cancelar Recibo</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-light btn-block"><i class="far fa-arrow-alt-circle-right "></i> Estado de Cuenta</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-info btn-block"><i class="fas fa-plus"></i> Liquidación</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-link btn-block"><i class="fas fa-users-slash  "></i> Cancelar Recibo</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-warning btn-block"><i class="far fa-arrow-alt-circle-right "></i> Estado de Cuenta</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-secondary btn-block"><i class="fas fa-plus"></i> Liquidación</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-danger btn-block"><i class="fas fa-users-slash  "></i> Cancelar Recibo</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-warning btn-block"><i class="far fa-arrow-alt-circle-right "></i> Estado de Cuenta</button>
                          </div>
                          <br>
                          <div class="col-md-12 fom-group">
                            <button onclick="Estado_Cuenta()"  class="btn btn-secondary btn-block"><i class="fas fa-plus"></i> Liquidación</button>
                          </div>
                        
                         
             
                        </div>
                       
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
       
          </div>
        </div>
    </div>
  </div>
</section>
  
<!-- Modal -->
<div class="modal fade" id="modal_registro_responsable" data-backdrop="static" data-keyboard="false" tabindex="-1″ id="MiModal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">REGISTRAR RESPONSABLE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
             <div class="col-6">
                    <label for="">APELLIDO PATERNO</label>
                  <input type="text" class="form-control" id="txt_apaterno" onkeypress="return soloLetras(event)">
             </div>
             <div class="col-6">
                    <label for="">APELLIDO MATERNO</label>
                  <input type="text" class="form-control" id="txt_amaterno" onkeypress="return soloLetras(event)">
             </div>
             <div class="col-6">
                    <label for="">NOMBRES</label>
                  <input type="text" class="form-control" id="txt_nombres" onkeypress="return soloLetras(event)">
             </div>
             <div class="col-6">
                    <label for="">DIRECCIÓN</label>
                  <input type="text" class="form-control" id="txt_direccion">
             </div>
             <div class="col-6">
                    <label for="">NRO DOCUMENTO</label>
                  <input type="text" class="form-control" id="txt_ndoc" onkeypress="return soloNumeros(event)">
             </div>
             <div class="col-sm-6">
           
              <label>TIPO PERSONA</label>
                <select  id="select_tipopersona" class="form-control" >
                    <option value="N">NATURAL</option>
                    <option value="J">JURIDICO</option>
                </select>
          </div>
             <div class="col-6">
                <!-- <label>USUARIO</label>  -->
                <input type="hidden" class="form-control"  id="txt_usuario" value ="<?php echo $_SESSION['S_ID'] ?>" disabled>
                
              </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" onclick="Registrar_Responsable()">Registrar</button>
        </div>
      </div>
    </div>
  </div>
<style>
  .pdf {
    cursor: pointer;
  margin-right: 5px;
    background-color:  #ff0000 !important;
    color: #ffffff !important;
}
.csv {
  cursor: pointer;
  margin-right: 5px;
    background-color: #00cc00 !important;
    color: #ffffff !important;
}
.excel {
  cursor: pointer;
  margin-right: 5px;
    background-color: #669900 !important;
    color: #ffffff !important;
}

</style>
<script src="../js/material-datetimepicker/moment-with-locales.min.js "></script>
    <script src="../js/material-datetimepicker/bootstrap-material-datetimepicker.js "></script>
    <script src="../js/material-datetimepicker/datetimepicker.js "></script>
  <script src="../js/console_responsable.js">
     listar_tbl_predios(00071867);
     listar_cuentas_pendientes();

     
  </script>
  <script src="../js/console_cuenta.js"></script>
    <script>
      listar_responsable();
      listar_tbl_estado_cuenta(00071867);

      Cargar_Select_Periodo_Final();
      Cargar_Select_Periodo_Inicial();
      $('#modal_registro_responsable').on('shown.bs.modal', function () {
        $('#txt_area').trigger('focus')
    })
    </script>
    <script>
        
      $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
         // Cargar_Select_Agno();
      });
        $(function () {
          $('#myList a:last-child').tab('show')
        }) 
    </script>
   