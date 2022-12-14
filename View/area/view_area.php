<script src="../js/console_area.js"></script>
<!-- Content Header (Page header) -->
   <div class="content-header">
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
                <h5 class="m-0">Listado de Areas</h5>
              </div>
              <div class="card-body">
              <table id="tabla_area" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>AREA</th>
                <th>DESCRIPCION</th>
                <th>UNIDAD</th>
                <th>SIGLAS</th>
                <th>GERENCIA</th>
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
      listar_area();
    </script>
   