<script src="../js/console_cuenta.js"></script>
<!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Periodos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Periodo</li>
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
                <h5 class="m-0">Listado de Periodos</h5>
                   </div>
              <div class="card-body">
              <table id="tabla_periodo" class="display" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>PERIODO</th>
                <th>GENERADOR</th>
                <th>AÑO</th>
                <th>DESCRIPCIÓN</th>
                <th>NRO_PERIODO</th>
                <th>FECHA_VCTO</th>
                <th>OBS</th>
                <th>ES_FRACCION</th>
                <th>ES_FRACCION</th>
                <th>GENERADOR</th>
                <th>AÑO</th>
                <th>DESCRIPCIÓN</th>
                <th>NRO_PERIODO</th>
             
           
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
    


<!-- Modal -->
    <!-- /.content -->
    <script>
       
        var ida = $("#select_agno").val();
        Cargar_Select_Agno(ida)
        listar_periodo(ida);
      
    </script>
    <script src="../js/console_cuenta.js"></script>
   