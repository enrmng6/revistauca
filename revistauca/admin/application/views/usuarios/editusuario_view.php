<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Custom fonts for this template-->
<link href="revistauca/admin/application/_public/bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Custom styles for this template-->
<link href="revistauca/admin/application/_public/bootstrap/css/sb-admin-2.min.css" rel="stylesheet">
<link href="revistauca/admin/application/_public/bootstrap/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


<link rel="stylesheet" type="text/css" href="/revistauca/admin/application/_public/css/machotesstyle.css">

<div id="container">
        <h1>Modificar usuario</h1>
<table border="1">
  <tr>
    <td><center><h3>Nombre</h3></center></td>
    <td><center><h3>Correo</h3></center></td>
    <td><center><h3>Contraseña</h3></center></td>
    <td><center><h3>Tipo</h3></center></td>
    <td><center><h3>Carrera</h3></center></td>
      <td><center><h3>Acción</h3></center></td>
  </tr>



        <form action="" method="POST">
            <?php foreach ($mod as $fila){ ?>
              <tr>

        <td><input type="text" name="nombre" value="<?=$fila->nombre?>"/></td>
          <td>  <input type="email"  name="correo" value="<?=$fila->correo?>"/></td>
          <td>  <input type="text" name="passw" value="<?=$fila->passw?>"/></td>
          <td>  <input type="text" name="tipo" value="<?=$fila->tipo?>"/></td>
          <td>
            <select name="id_carrera">
              <?php
            foreach($ver_carreras as $fila2){
            ?>
                  <option value="<?=$fila2->id;?>"><?=$fila2->nombre;?></option>

                  <?php
                  }
                  ?>
          </select>
          </td>
          <td><input type="submit" name="submit" value="Modificar"/></td>

          </tr>
            <?php } ?>
        </form>
        </table>
        <br><br>
      <button><a href="<?=base_url("usuarios")?>"style="color: black; text-decoration:none;">Volver</a>  </button>


</div>
<!-- Bootstrap core JavaScript-->
<script src="revistauca/admin/application/_public/bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="revistauca/admin/application/_public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="revistauca/admin/application/_public/bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="revistauca/admin/application/_public/bootstrap/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="revistauca/admin/application/_public/bootstrap/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="revistauca/admin/application/_public/bootstrap/js/demo/chart-area-demo.js"></script>
<script src="revistauca/admin/application/_public/bootstrap/js/demo/chart-pie-demo.js"></script>