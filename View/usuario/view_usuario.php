<script src="../js/console_usuario.js"></script>
<!-- Modal -->
<div class="modal fade" id="modal_editar_usuario" data-backdrop="static" data-keyboard="false"  id="MiModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>MODIFICAR USUARIO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-sm-6">
                      <!-- text input -->
           
              <label>NOMBRES</label>
              <input type="text" class="form-control" placeholder="Ingresar Nombres" id="txt_nombres_editar" onkeypress="return soloLetras(event)">
           
          </div>
          <div class="col-sm-6">
                      <!-- text input -->
           
              <label>DIRECCION</label>
              <input type="text" class="form-control" placeholder="Ingresar Direccion" id="txt_direccion_editar" >
           
          </div>
          <div class="col-sm-6">
                      <!-- text input -->
           
              <label>USUARIO</label>
              <input type="text" class="form-control" placeholder="Ingresar Usuario" id="txt_usu_editar">
           
          </div>
          <div class="col-sm-6">
           
              <label>CONTRASEÑA</label>
              <input type="password" class="form-control" placeholder="Ingresar Contraseña"  style="text-align:center;"id="txt_con_editar">
         
          </div>
        <!--   <div class="col-12">
          <label>USUARIO</label>
           <select class="js-example-basic-multiple" id="select_usuario"  style="width : 100%"> </select>
          </div> -->
     <!--      <div class="col-6">
          <label>AREA</label>
           <select class="js-example-basic-multiple" id="select_area_editar" style="width : 100%" > </select>
          </div> -->
          <div class="col-6">
          <label>ROL</label>
           <select class="js-example-basic-multiple" id="select_rol_editar" style="width : 100%" >
            <option value="A" >ADMINISTRADOR</option>
              <option value="U" >USUARIO</option>
          </select>
            
          </div>
          <div class="col-6">
          <label>ESTADO</label>
           <select class="js-example-basic-multiple" id="select_estado_editar" style="width : 100%" >
            <option value="A" >ACTIVO</option>
              <option value="C" >INACTIVO</option>
          </select>
            
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" style="background:white;color:#28a745">Cerrar</button>
        <button type="button" class="btn btn-success btn-sm" onclick="Modificar_Usuario()">Modificar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
<!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mantenimiento Usuario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php" ><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active"> Usuario</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Listado de Usuarios</h3>
                  <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistro()"><i class="fas fa-plus"></i>&nbsp;Nuevo registro</button>
              </div>
              <div class="card-body">
              <table id="tabla_usuario" style="table-layout:fixed;width: 100%" class="table tabel-display table-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>USUARIO</th>
                            <th>NOMBRE</th>
                            <th>DIRECCION</th>
                            <!--    <th>AREA</th>
                        <th>EMAIL</th> -->
                            <th>ROL</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
               </table>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>
    
<!-- Modal -->
<div class="modal fade" id="modal_registro_usuario" data-backdrop="static" data-keyboard="false"  id="MiModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>REGISTRAR USUARIO</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-sm-6">
                      <!-- text input -->
           
              <label>NOMBRES</label>
              <input type="text" class="form-control" placeholder="Ingresar Nombres" id="txt_nombres" onkeypress="return soloLetras(event)">
           
          </div>
          <div class="col-sm-6">
                      <!-- text input -->
           
              <label>APELLIDO PATERNO</label>
              <input type="text" class="form-control" placeholder="Ingresar Apellido Paterno" id="txt_apaterno"onkeypress="return soloLetras(event)" >
           
          </div>
          <div class="col-sm-6">
                      <!-- text input -->
           
              <label>APELLIDO MATERNO</label>
              <input type="text" class="form-control" placeholder="Ingresar Apellido Materno" id="txt_amaterno" onkeypress="return soloLetras(event)">
           
          </div>
          <div class="col-sm-6">
                      <!-- text input -->
           
              <label>DIRECCION</label>
              <input type="text" class="form-control" placeholder="Ingresar Direccion" id="txt_direccion" >
           
          </div>
          <div class="col-sm-6">
                      <!-- text input -->
           
              <label>USUARIO</label>
              <input type="text" class="form-control" placeholder="Ingresar Usuario" id="txt_usu">
           
          </div>
          <div class="col-sm-6">
           
              <label>CONTRASEÑA</label>
              <input type="password" class="form-control" placeholder="Ingresar Contraseña"  style="text-align:center;"id="txt_con">
         
          </div>
        <!--   <div class="col-12">
          <label>USUARIO</label>
           <select class="js-example-basic-multiple" id="select_usuario"  style="width : 100%"> </select>
          </div> -->
          <div class="col-6">
          <label>AREA</label>
           <select class="js-example-basic-multiple" id="select_area" style="width : 100%" > </select>
          </div>
          <div class="col-6">
          <label>ROL</label>
           <select class="js-example-basic-multiple" id="select_rol" style="width : 100%" >
            <option value="A" >ADMINISTRADOR</option>
              <option value="U" selected>USUARIO</option>
          </select>
            
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" style="background:white;color:#28a745">Cerrar</button>
        <button type="button" class="btn btn-success btn-sm" onclick="Registrar_Usuario()">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->

<!-- Modal -->
    <!-- /.content -->
    <script>
      listar_usuario();
      Cargar_Select_Area();
      var ida = $("#select_agno").val();
      // Cargar_Select_Agno(ida)
      $(document).ready(function() {
          $('.js-example-basic-multiple').select2();
         // Cargar_Select_Agno();
      });
    </script>
   