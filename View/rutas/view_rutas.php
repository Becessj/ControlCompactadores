<?php
  session_start();

?>
     <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Rutas</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php" ><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active">Rutas</li>
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
          <h3 class="card-title">Rutas</h3>
          <button class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#modal_registrar_ruta">
                <i class="fas fa-plus"></i> Nueva Ruta
            </button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table id="tabla_rutas" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                   
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
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


<!-- MODAL PARA REGISTRAR RUTA -->
<div class="modal fade" id="modal_registrar_ruta">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-map-marked-alt"></i> Registrar Nueva Ruta</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_ruta">
                    <div class="form-group">
                        <label for="nombre_ruta"><i class="fas fa-road"></i> Nombre de la Ruta (*)</label>
                        <input type="text" id="nombre_ruta" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion_ruta"><i class="fas fa-align-left"></i> Descripción</label>
                        <textarea id="descripcion_ruta" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="estado_ruta"><i class="fas fa-toggle-on"></i> Estado</label>
                        <select id="estado_ruta" class="form-control">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-success" onclick="Registrar_Ruta()">
                            <i class="fas fa-save"></i> Guardar Ruta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA EDITAR RUTA -->
<div class="modal fade" id="modal_editar_ruta">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Editar Ruta</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form_editar_ruta">
                    <input type="hidden" id="id_ruta_editar">
                    
                    <div class="form-group">
                        <label for="nombre_ruta_editar"><i class="fas fa-road"></i> Nombre de la Ruta (*)</label>
                        <input type="text" id="nombre_ruta_editar" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion_ruta_editar"><i class="fas fa-align-left"></i> Descripción</label>
                        <textarea id="descripcion_ruta_editar" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="estado_ruta_editar"><i class="fas fa-toggle-on"></i> Estado</label>
                        <select id="estado_ruta_editar" class="form-control">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-warning" onclick="Editar_Ruta()">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="../js/console_rutas.js"></script>
<script src="../js/validador.js"></script>
<script>
    listar_rutas();
</script>
   