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
                <h1 class="m-0 text-dark">Reportes</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
                    <li class="breadcrumb-item active">Reportes</li>
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
                        <h3 class="card-title">Comparación de Repuestos Usados</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <figure class="highcharts-figure">
                                <div id="container_repuestos_compactador"></div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="../js/console_reportes.js"></script>
<script>
    graficos_repuestos_compactador();
</script>
