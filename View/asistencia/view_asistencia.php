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
        <h1 class="m-0 text-dark">Asistencia</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active">Cargos</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Listado de Asistencia</h3>
        <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistroCargo()">
          <i class="fas fa-plus"></i>&nbsp;Nuevo Cargo
        </button>
      </div>
      <div class="card-body">
        <table id="tabla_asistencia" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Persona</th>
                    <th>Fecha</th>
                    <th>Hora Entrada</th>
                    <th>Hora Salida</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

      <button onclick="marcarEntrada()">Marcar Entrada</button>
      <button onclick="marcarSalida()">Marcar Salida</button>
      <canvas id="firmaCanvas"></canvas>
      </div>
    </div>
  </div>
</section>

<script src="../js/console_asistencia.js"></script>
