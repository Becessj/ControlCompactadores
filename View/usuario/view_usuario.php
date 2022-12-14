<script src="../js/console_usuario.js"></script>
<!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Mantenimiento Usuario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Usuario</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Listado de Usuarios</h5>
              </div>
              <div class="card-body">
              <table id="tabla_usuario" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>USUARIO</th>
                <th>NOMBRE</th>
                <th>DIRECCION</th>
                <th>TELEFONO</th>
                <th>EMAIL</th>
                <th>ACCESO</th>
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
    </div>
    <!-- /.content -->
    <script>
      listar_usuario();
    </script>
   