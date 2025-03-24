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
            <!-- 🔹 CARD 1: Mantenimientos por tipo -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h3 class="card-title">Cantidad de Mantenimientos por Tipo</h3>
                        <div class="float-right">
                            <select id="select_mes" class="form-control">
                                <?php
                                $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                                          "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                                for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT); ?>" <?= ($i == date('m')) ? 'selected' : ''; ?>>
                                        <?= $meses[$i - 1]; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>

                            <select id="select_anio" class="form-control mt-2">
                                <?php for ($i = date('Y'); $i >= date('Y') - 5; $i--): ?>
                                    <option value="<?= $i; ?>" <?= ($i == date('Y')) ? 'selected' : ''; ?>><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container_mantenimientos_tipo_por_fecha"></div>
                        </figure>
                    </div>
                </div>
            </div>

            <!-- 🔹 CARD 2: Repuestos en el tiempo -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container_repuestos_tiempo"></div>
                        </figure>
                    </div>
                </div>
            </div>

            <!-- 🔹 CARD 3: Comparación de repuestos -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container_repuestos_compactador"></div>
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
    graficos_mantenimientos_tipo_por_fecha();
    graficos_consumo_repuestos_tiempo();
    graficos_repuestos_compactador();
</script>
