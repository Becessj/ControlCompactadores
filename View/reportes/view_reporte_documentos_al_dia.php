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
            <!-- 🔹 CARD 1: Documentación de Compactadores -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container_compactadores_documentacion"></div>
                        </figure>
                        <div id="lista_compactadores"></div> <!-- Lista adicional -->
                    </div>
                </div>
            </div>

            <!-- 🔹 CARD 2: Documentos Próximos a Expirar -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container_documentos_proximos_a_expirar"></div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="../js/console_reportes.js"></script>
<script>
    graficos_compactadores_documentacion();
    graficos_documentos_proximos_a_expirar();
</script>
