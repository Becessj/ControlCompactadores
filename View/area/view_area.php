      <!-- Modal -->
<div class="modal fade" id="modal_editar" data-backdrop="static" data-keyboard="false" tabindex="-1″ id="MiModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>EDITAR &Aacute;REA</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
          <div class="col-sm-12">
           
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" class="form-control" id="txt_area_editar" readonly>
              <!-- <input type="text" class="form-control" id="txt_idarea" hidden> -->
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Estado</label>
                <select  id="select_estatus" class="form-control" >
                    <option value="A">ACTIVO</option>
                    <option value="C">INACTIVO</option>
                </select>
            </div>
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" style="background:white;color:#28a745">Cerrar</button>
        <button type="button" class="btn btn-success btn-sm" onclick="Modificar_Area()">Modificar</button>
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
            <h1 class="m-0">Mantenimiento Area</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Area</li>
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
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><b>Listado de Areas</b></h5>
                <button class="btn btn-danger btn-sm float-right" onclick="AbriRegistro()"><i class="fas fa-plus"></i> Nuevo Registro</button>
              </div>
              <div class="card-body">
              <table id="tabla_area" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>AREA</th>
                <th>FECHA REGISTRO</th>
                <th>ESTADO</th>
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
    <!-- /.content -->
<!-- Modal -->
<div class="modal fade" id="modal_registro" data-backdrop="static" data-keyboard="false" tabindex="-1″ id="MiModal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE AREA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-12">
                    <label for="">AREA</label>
                  <input type="text" class="form-control" id="txt_area">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" onclick="Registrar_Area()">Registrar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/console_area.js"></script>
    <script>
      listar_area();
      $('#modal_registro').on('shown.bs.modal', function () {
      $('#txt_area').trigger('focus')
    })
    </script>
   