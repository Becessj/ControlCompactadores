
<?php
  session_start();
  if(!isset($_SESSION['S_ID'])){
    header("Location: ../index.php");
  }
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema | Control de Compactadores</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../template/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="_Plantilla/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="../utils/DataTables/datatables.min.css"/>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="_Plantilla/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js"></script>

    <link rel="stylesheet" href="../template/dist/css/adminlte.min.css">
  <style>
      .nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    color: #fff !important;
    background: #007bff linear-gradient(180deg, #268fff, #007bff) repeat-x !important;
}
#cmb_placa_registro {
    text-align: center;
    text-align-last: center; /* Para navegadores como Chrome */
}

  </style>
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #28a745 !important;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
  
      
    </ul>

    <!-- SEARCH FORM -->
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
  
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown"  href="#">
          <label id="lb_correo_usuario" style="cursor: pointer;color: white;"> <?php echo $_SESSION['S_ID'] ?></label>
          <i class="fa fa-angle-down" style="color: white"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a  href="javascript:abrirModalFotoPerfil();"  class="dropdown-item">
            <i class="fas fa-camera mr-2"></i> Foto
          </a>
          <div class="dropdown-divider"></div>
          <a  href="javascript:abrirModalCuentaPerfil();"  class="dropdown-item">
            <i class="fas fa-user mr-2"></i> Perfil
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:abrirModalusuario()" class="dropdown-item">
            <i class="fas fa-cog mr-2"></i> Cuenta
          </a>
          <div class="dropdown-divider"></div>
          <a  href="../Controller/usuario/controller_cerrar_sesion.php" class="dropdown-item">
            <i class="fas fa-power-off mr-2"></i> Salir
          </a>
        </div>
      </li>
     
    </ul>
  </nav>
  <!-- <a style="color: #03710E;text-align: center"><b><h1>Sistema de Control de Compactadores</h1></b></a> -->
  
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="../assets/logo.png"  alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Compactadores</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../template/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> <?php echo $_SESSION['S_NOMBRE'] ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
  

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
            if ($_SESSION['S_TIPO'] == 'A') {
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Sistema
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Configuración del Sistema
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Configuración</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Tipo de Documento</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-layer-group"></i>
                <p> Areas </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Configuración del Usuario
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Usuario</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Configuración de Accesos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Tipo Documento Usuario</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Administración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Responsable
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Persona
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a onclick="cargar_contenido('contenido_principal','cuentas/view_periodo.php')" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Periodo de Pago
                  </p>
                </a>
              </li>
            </ul>
          </li>
       
          <li class="nav-item">
            <a onclick="cargar_contenido('contenido_principal','usuario/view_usuario.php')" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a onclick="cargar_contenido('contenido_principal','area/view_area.php')" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Areas
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a onclick="cargar_contenido('contenido_principal','responsable/view_responsable.php')" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Responsable
               
              </p>
            </a>
          </li>
          <?php
          }
          if ($_SESSION['S_TIPO'] != 'A') {
          ?>
       <li class="nav-item active">
       <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Dashboard</p>
          </a>
      </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-truck mr-2"></i>
                  <p>
                    Compactadores
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','compactador/view_compactador.php')" class="nav-link">
                      <i class="fas fa-truck mr-2 nav-icon"></i>
                      <p>Compactadores</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','mantenimiento/view_mantenimiento.php')" class="nav-link">
                      <i class="fa fa-cog fa-spin fa-1x fa-fw nav-icon"></i>
                      <p>Mantenimientos</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','repuestos/view_repuesto.php')" class="nav-link">
                    <i class="fa fa-cog fa-spin fa-1x fa-fw nav-icon"></i>
                      <p> Repuestos </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','combustible/view_combustible.php')" class="nav-link">
                      <i class="nav-icon ion ion-beaker"></i>
                      <p> Combustible </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','rutas/view_rutas.php')" class="nav-link">
                      <i class="nav-icon ion ion-calendar"></i>
                      <p> Rutas </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','mantenimiento/view_cronograma.php')" class="nav-link">
                      <i class="nav-icon ion ion-calendar"></i>
                      <p> Cronograma </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','declaracion/view_declaracion.php')" class="nav-link">
                      <i class="nav-icon far fa-list-alt"></i>
                      <p> Declaraciones </p>
                    </a>
                  </li>

                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon ion ion-person-add"></i>
                  <p>
                    Empleados
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','empleado/view_empleado.php')" class="nav-link">
                      <i class="ion ion-person-add nav-icon"></i>
                      <p>Empleados</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','cargo/view_cargo.php')" class="nav-link">
                      <i class="fa fa-envelope-open nav-icon"></i>
                      <p>Cargo</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','asignacion/view_asignacion.php')" class="nav-link">
                      <i class="nav-icon far fa-list-alt"></i>
                      <p> Programación </p>
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','asistencia/view_asistencia.php')" class="nav-link">
                      <i class="nav-icon far fa-list-alt"></i>
                      <p> Asistencia </p>
                    </a>
                  </li> -->

                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                    Reportes
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','reportes/view_reporte.php')" class="nav-link">
                    <i class="nav-icon fas fa-chart-bar"></i>
                      <p>Consumo de Combustible</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','reportes/view_reporte_repuestos.php')" class="nav-link">
                    <i class="nav-icon fas fa-chart-bar"></i>
                      <p>Repuestos por Compactador</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','reportes/view_reporte_tipo_mantenimientos.php')" class="nav-link">
                    <i class="nav-icon fas fa-chart-bar"></i>
                      <p> Tipo de Mantenimiento </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:cargar_contenido('contenido_principal','reportes/view_reporte_documentos_al_dia.php')" class="nav-link">
                    <i class="nav-icon fas fa-chart-bar"></i>
                      <p> Estado de Documentación </p>
                    </a>
                  </li>
                  
                </ul>
              </li>
           
          <?php
          }
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="contenido_principal">
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Página principal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
    
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h1 style="font-size:lg;" id="compactadores_total"><b>0</b></h1>

                <p>Compactadores disponibles</p>
              </div>
              <div class="icon">
                <i class="fas fa-truck mr-2"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal', 'compactador/view_compactador.php'); return false;">
              Ver más <i class="fas fa-arrow-circle-right"></i>
            </a>

            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h1 style="font-size:lg;" id="mantenimiento_mensuales"><b>0</b></h1>

                <p>Mantenimientos</p>
              </div>
              <div class="icon">
              <i class="ion ion-calendar"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal', 'mantenimiento/view_mantenimiento.php'); return false;">
              Ver más <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <h1 style="font-size:lg;" id="empleados_total"><b>0</b></h1>

                <p>Empleados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal', 'empleado/view_empleado.php'); return false;">
              Ver más <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h1 style="font-size:lg;" id="combustible_mensual"><b>0</b></h1>

                <p>Consumo mensual de combustible</p>
              </div>
              <div class="icon">
              <i class="ion ion-beaker"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal', 'combustible/view_combustible.php'); return false;">
              Ver más <i class="fas fa-arrow-circle-right"></i>
              </a>

          
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h1 style="font-size:lg;" id="combustible_mensual_gasto"><b>0</b></h1>

                <p>Gasto mensual de combustible</p>
              </div>
              <div class="icon">
              <i class="ion ion-social-usd"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal', 'combustible/view_combustible.php'); return false;">
              Ver más <i class="fas fa-arrow-circle-right"></i>
              </a>

          
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box ">
              <div class="inner">
              <h1 style="font-size:lg;" id="cargas_haquira"><b>0</b></h1>
                  <p id="texto_mes_haquira">Cargas a Haquira</p>

              </div>
              <div class="icon">
              <i class="fas fa-truck mr-2"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="cargar_contenido('contenido_principal', 'declaracion/view_declaracion.php'); return false;">
              Ver más <i class="fas fa-arrow-circle-right"></i>
              </a>

          
            </div>
          </div>
          <!-- ./col -->
        </div>
        
        <!-- /.row -->
      
      </div><!-- /.container-fluid -->

      <div class="row">
    <!-- Primer cronograma en la mitad izquierda -->
    <div class="col-lg-6">
        <div id="cronograma_contenedor_1"></div>
    </div>
    
    
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    <?php echo $_SESSION['S_ROL'] ?>
    ADMINISTRADOR
    <?php echo $_SESSION['S_TIPO'] ?>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2025 <a href="">Guaman Poma de Ayala</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<style type="text/css">
  button.dt-button,
  div.dt-button,
  a.dt-button {
    position: relative;
    display: inline-block;
    box-sizing: border-box;
    margin-right: 0.333em;
    margin-bottom: 0.333em;
    padding: 0.5em 1em;
    border: 1px solid #999;
    border-radius: 2px;
    cursor: pointer;
    font-size: 0.88em;
    line-height: 1.6em;
    color: black;
    white-space: nowrap;
    overflow: hidden;
    background-color: #e9e9e9;
    background-image: -webkit-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: -moz-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: -ms-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: -o-linear-gradient(top, #fff 0%, #e9e9e9 100%);
    background-image: linear-gradient(to bottom, #fff 0%, #e9e9e9 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, StartColorStr='white', EndColorStr='#e9e9e9');
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-decoration: none;
    outline: none;
  }

  .user-panel,
  .user-panel .info {
    overflow: hidden;
    white-space: normal !important;
  }
</style>
<!-- REQUIRED SCRIPTS -->
<script>
 
  function soloNumeros(e){ 
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla==8){
          return true;
      }
      // Patron de entrada, en este caso solo acepta numeros
      patron =/[0-9]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
}
function soloLetras(e){
      key = e.keyCode || e.which;
      tecla = String.fromCharCode(key).toLowerCase();
      letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
      especiales = "8-37-39-46";
      tecla_especial = false
      for(var i in especiales){
          if(key == especiales[i]){
              tecla_especial = true;
              break;
          }
      }
      if(letras.indexOf(tecla)==-1 && !tecla_especial){
          return false;
      }
}
function filterFloat(evt,input){
    var key = window.Event ? evt.which : evt.keyCode;
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {
              return true;
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{
                    return true;
                }
          }else{
              return false;
          }
    }
}

function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/;
    if(preg.test(__val__) === true){
        return true;
    }else{
        return false;
    }
}
  function cargar_contenido(id,vista){
    $("#"+id).load(vista);
    
  }
  var idioma_espanol = {
   
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %ds fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir",
        "renameState": "Cambiar nombre",
        "updateState": "Actualizar",
        "createState": "Crear Estado",
        "removeAllStates": "Remover Estados",
        "removeState": "Remover",
        "savedStates": "Estados Guardados",
        "stateRestore": "Estado %d"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "notEmpty": "No Vacio",
                "not": "Diferente de"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con",
                "not": "Diferente de",
                "notContains": "No Contiene",
                "notStartsWith": "No empieza con",
                "notEndsWith": "No termina con"
            },
            "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d",
        "showMessage": "Mostrar Todo",
        "collapseMessage": "Colapsar Todo"
    },
    "select": {
        "cells": {
            "1": "1 celda seleccionada",
            "_": "%d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        },
        "rows": {
            "1": "1 fila seleccionada",
            "_": "%d filas seleccionadas"
        }
    },
    "thousands": ".",
    "datetime": {
        "previous": "Anterior",
        "next": "Proximo",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "AM",
            "PM"
        ],
        "months": {
            "0": "Enero",
            "1": "Febrero",
            "10": "Noviembre",
            "11": "Diciembre",
            "2": "Marzo",
            "3": "Abril",
            "4": "Mayo",
            "5": "Junio",
            "6": "Julio",
            "7": "Agosto",
            "8": "Septiembre",
            "9": "Octubre"
        },
        "weekdays": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ]
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
            }
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
        },
        "multi": {
            "title": "Múltiples Valores",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
        }
    },
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "stateRestore": {
        "creationModal": {
            "button": "Crear",
            "name": "Nombre:",
            "order": "Clasificación",
            "paging": "Paginación",
            "search": "Busqueda",
            "select": "Seleccionar",
            "columns": {
                "search": "Búsqueda de Columna",
                "visible": "Visibilidad de Columna"
            },
            "title": "Crear Nuevo Estado",
            "toggleLabel": "Incluir:"
        },
        "emptyError": "El nombre no puede estar vacio",
        "removeConfirm": "¿Seguro que quiere eliminar este %s?",
        "removeError": "Error al eliminar el registro",
        "removeJoiner": "y",
        "removeSubmit": "Eliminar",
        "renameButton": "Cambiar Nombre",
        "renameLabel": "Nuevo nombre para %s",
        "duplicateError": "Ya existe un Estado con este nombre.",
        "emptyStates": "No hay Estados guardados",
        "removeTitle": "Remover Estado",
        "renameTitle": "Cambiar Nombre Estado"
    }
}
</script>
<!-- jQuery -->
<script src="../template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->

<!-- AdminLTE App -->
<script src="../template/dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="../utils/DataTables/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="_Plantilla/plugins/moment/moment.min.js"></script>
<script src="../template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="_Plantilla/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../js/console_usuario.js?rev=<?php echo time();?>"></script>
<script scr="../js/console_area.js"></script>
<script scr="../js/console_empleado.js"></script>
<script scr="../js/console_webapi.js"></script>
<script src="../js/console_declaracion.js"></script>
<script>
      $(function() {
    var menues = $(".nav-link");
    menues.click(function() {
      menues.removeClass("active");
      $(this).addClass("active");
    });
  });
    $(document).ready(function() {
        // Cargar la vista del cronograma debajo de los cuadros
        cargar_contenido('cronograma_contenedor_1', 'mantenimiento/view_cronograma_inicio.php');
        Traer_Consumo_Mensual();
        Traer_Compactadores_Mensual();
        Traer_Compactadores_Mensual();
        Traer_Mantenimientos_Mensual();
        Traer_Personas_Mensual();
    });
    
    function Traer_Consumo_Mensual() {
        $.ajax({
            url: "../Controller/combustible/controller_combustible.php",
            type: "POST",
            data: { action: "consumo_mensual" },
            success: function (response) {
                let resp = JSON.parse(response);
                if (resp.success) {
                    let data = resp.data[0]; // Accede directamente a la primera fila de resultados
                    let consumoLitros = data.TOTAL_LITROS || "0.00";
                    let gastoTotal = data.GASTO_TOTAL || "0.00";
                    
                    $("#combustible_mensual").html(`<b>${consumoLitros} L</b>`);
                    $("#combustible_mensual_gasto").html(`<b>S/ ${gastoTotal}</b>`);

                } else {
                    Swal.fire("Error", "No se pudo obtener el consumo mensual", "error");
                }
            },
            error: function () {
                Swal.fire("Error", "Problema en la conexión con el servidor", "error");
            }
        });
    }


function Traer_Compactadores_Mensual() {
  $.ajax({
      url: "../Controller/compactador/controller_compactador.php",
      type: "POST",
      data: { action: "total_compactadores" },
      success: function (response) {
          let resp = JSON.parse(response);
          if (resp.success) {
              let data = resp.data[0]; // Accede a la primera fila de resultados
              let totalCompactadores = data.TOTAL_COMPACTADORES || "0";

              $("#compactadores_total").html(`<b>${totalCompactadores}</b>`);
          } else {
              Swal.fire("Error", "No se pudo obtener la cantidad de compactadores", "error");
          }
      },
      error: function () {
          Swal.fire("Error", "Problema en la conexión con el servidor", "error");
      }
  });
}
function Traer_Mantenimientos_Mensual() {
    $.ajax({
        url: "../Controller/mantenimiento/controller_mantenimiento.php",
        type: "POST",
        data: { action: "mantenimientos_mensual" },
        success: function (response) {
            let resp = JSON.parse(response);
            if (resp.success) {
                let data = resp.data[0]; // Accede a la primera fila de resultados
                let totalMantenimientos = data.TOTAL_MANTENIMIENTOS || "0";

                $("#mantenimiento_mensuales").html(`<b>${totalMantenimientos}</b>`);
            } else {
                Swal.fire("Error", "No se pudo obtener la cantidad de mantenimientos", "error");
            }
        },
        error: function () {
            Swal.fire("Error", "Problema en la conexión con el servidor", "error");
        }
    });
}
function Traer_Personas_Mensual() {
    $.ajax({
        url: "../Controller/empleado/controller_empleado.php",
        type: "POST",
        data: { action: "personas_mensual" },
        success: function (response) {
            let resp = JSON.parse(response);
            if (resp.success) {
                let data = resp.data[0]; // Accede a la primera fila de resultados
                let totalPersonas = data.TOTAL_PERSONAS || "0";

                $("#empleados_total").html(`<b>${totalPersonas}</b>`);
            } else {
                Swal.fire("Error", "No se pudo obtener la cantidad de personas", "error");
            }
        },
        error: function () {
            Swal.fire("Error", "Problema en la conexión con el servidor", "error");
        }
    });
}


</script>
</body>
</html>
