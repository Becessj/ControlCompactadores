<?php
  session_start();
  if(isset($_SESSION['S_ID'])){
    header("Location: view/index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Control de Compactadores | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="template/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
  <style>
    body {
      background: url('./assets/fondolog.png') no-repeat center center fixed;
      background-size: cover;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.9);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
      .login-box {
        width: 90%;
      }
    }

    .nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
    color: #fff;
    background: #007bff linear-gradient(180deg, #268fff, #007bff) repeat-x !important;
}

  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="template/index2.html"><b>Sistema </b>Control de Compactadores</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Iniciar Sesion</p>

     
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" id="txt_usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="txt_contra">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" onclick="Iniciar_Sesion()">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>


 
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="template/dist/js/adminlte.min.js"></script>
<script src="js/console_usuario.js?rev=<?php echo time();?>"></script>
<script scr="../js/console_empleado.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  const rmcheck = document.getElementById('remember'),
        usuarioInput = document.getElementById('txt_usuario'),
        passInput = document.getElementById('txt_contra');
        if (localStorage.checkbox  && localStorage.checkbox !=""){
          rmcheck.setAttribute("checked","checked");
          usuarioInput.value=localStorage.usuario;
          passInput.value =localStorage.pass;
        }
        else{
          rmcheck.removeAttribute("checked","checked");
          usuarioInput.value="";
          passInput.value ="";
        }

</script>
<script>
  $(document).ready(function () {
    $(".nav-link").click(function () {
      $(".nav-link").removeClass("active");
      $(this).addClass("active");
    });
  });
</script>

</body>
</html>
