
<link rel="stylesheet" type="text/css" href="/revistauca/admin/application/_public/css/machotesstyle.css">
<div id="container">
  <br>
  <input style="position:absolute;left:90%" type="button" onclick="location.href= '<?=base_url()?>'" value="Inicio">
<br>
<h1>Registro de Usuarios</h1>

<table border="1" WIDTH="100%" >
  <tr>
    <td><center>ID<center></td>
    <td WIDTH="10%"><center>Nombre</center></td>
    <td  WIDTH="10%"><Center>Correo</center></td>
    <td  WIDTH="10%"><center>Contraseña</center></td>
    <td  WIDTH="5%"><center>Tipo</center></td>
    <td  WIDTH="10%"><center>Carrera</center></td>
    <td  WIDTH="15%"><center>Creado</center></td>
    <td  WIDTH="20%"><center>Acciones</center></td>
  </tr>
<?php
foreach($ver as $fila){
?>
    <tr>
        <td>
        <center><?=$fila->id;?></center>
        </td>
        <td>
        <center>    <?=$fila->nombre;?></center>
        </td>
        <td>
          <center>  <?=$fila->correo;?></center>
        </td>
        <td>
          <center>  <?=$fila->passw;?></center>
        </td>
        <td>
          <center>  <?=$fila->tipo;?></center>
        </td>

          <?php
        foreach($ver_carreras as $fila2){
          if ($fila->id_carrera==$fila2->id) {
        $carrera=$fila2->nombre;
         break;
       }
        else {
              $carrera="Sin asignar";
        }
          }
?>
  <td>
    <center><?= $carrera; ?></center>
  </td>

        <td>
          <center>  <?=$fila->creado;?></center>
        </td>
        <td>
<br>
          <button type="button" name="button"><a href="<?=base_url("usuarios/mod/$fila->id")?>"style="color: black; text-decoration:none;">Editar</a></button>
<hr><hr>

          <button type="button"  name="button"><a href="<?=base_url("usuarios/eliminar/$fila->id")?>"style="color: black; text-decoration:none;">Eliminar</a></button>

</td>
    </tr>

<?php

}

?>
<tr>
    <td>Nuevo</td>
    <form action="<?=base_url("usuarios/add");?>" method="post">
         <td>
           <input type="text" name="nombre"/>
        </td>
        <td>
           <input type="email" name="correo"/>
        </td>
        <td>
           <input type="password" name="passw"/>
        </td>
        <td>
            <input type="text" name="tipo"/>
        </td>
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
        <td>
            Fecha Actual
        </td>
        <td>
          <br>
        <center>  <input type="submit" name="submit" value="Añadir" /></center>
        </td>
    </form>
</tr>
</table>
</div>
