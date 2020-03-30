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
