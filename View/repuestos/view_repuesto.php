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
        <h1 class="m-0 text-dark">Repuestos</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php" ><i class="fa fa-home"></i> Inicio</a></li>
          <li class="breadcrumb-item active"> Repuestos</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listado de Repuestos</h3>
            <!-- <button class="btn btn-danger btn-sm float-right" data-toggle="modal" onclick="AbrirModalRegistro()"><i class="fas fa-plus"></i>&nbsp;Nuevo registro</button> -->
          </div>
          <div class="card-body" style="color:#000000;">
            <div class="col-12" style="text-align: right;">
              <label>Saldo Actual: </label>
              <label>&nbsp;&nbsp;<&nbsp;10 Negro &nbsp;&nbsp;|&nbsp;&nbsp; </label>
              <label style="color: green;">&nbsp;&nbsp;<&nbsp;8 Verde &nbsp;&nbsp;|&nbsp;&nbsp;</label>
              <label style="color: #ff7e00;">&nbsp;&nbsp;<&nbsp;5 Ambar &nbsp;&nbsp;|&nbsp;&nbsp;</label>
              <label style="color: red;">&nbsp;&nbsp;<&nbsp;2 Rojo &nbsp;&nbsp;|&nbsp;&nbsp;</label>
            </div>
            <div class="table-responsive" > 
              <table id="tabla_repuestos" style="table-layout:fixed;width: 100%" class="table tabel-display table-nowrap">
                <thead>
                  <tr>
                    <th style="text-align: center;width: 20px;word-wrap: break-word;">PRODUCTO</th>
                    <th style="width: 120px;word-wrap: break-word;">DESCRIPCION</th>
                    <th style="width: 50px;word-wrap: break-word;">UNIDAD</th>
                    <th style="text-align: center;width: 40px;word-wrap: break-word;">SALDO ACTUAL</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th style="text-align: center;width: 20px;word-wrap: break-word;">PRODUCTO</th>
                    <th style="width: 120px;word-wrap: break-word;">DESCRIPCION</th>
                    <th style="width: 50px;word-wrap: break-word;">UNIDAD</th>
                    <th style="text-align: center;width: 40px;word-wrap: break-word;">SALDO ACTUAL</th>
                  </tr>
                </tfoot>
              </table>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->

    <script src="../js/console_repuesto.js"></script>
   