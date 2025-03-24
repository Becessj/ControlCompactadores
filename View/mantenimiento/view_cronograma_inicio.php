<?php
  session_start();
  if (!isset($_SESSION['S_ID'])) {
      header('Location: ../index.php');
  }
?>
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center"> 
      <div class="col-12"> 
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Cronograma de Mantenimientos</h3>
          </div>
          <div class="card-body">
            <!-- 🔹 Leyenda intuitiva para los eventos -->
            <div class="mb-3 text-center">
              <span style="display: inline-block; width: 20px; height: 20px; background-color: #28a745; border-radius: 50%;"></span> Planeaciones de los Mantenimientos
              &nbsp;&nbsp;
              <span style="display: inline-block; width: 20px; height: 20px; background-color: #FF0000; border-radius: 50%;"></span> Fecha de inicio del Mantenimiento
            </div>
            <!-- 🔹 Contenedor para ajustar la altura del calendario -->
            <div id="calendar-container">
              <div id="calendar"></div>
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
<style>
  #calendar-container {
    height: 35vh; 
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #calendar {
    width: 100%;
    height: 100%;
  }
</style>

<script src="../js/console_mantenimiento.js"></script>

<script src="../js/console_webapi.js"></script>
