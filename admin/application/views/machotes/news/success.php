<?php 

//session_start();
//unset($_SESSION['count']);

echo $_SESSION['usuario'];

echo 'succeeded<br>';

foreach ($usuarios as $usuarios_item): ?>

    <h2><?php echo $usuarios_item['nombre_usuario'] ?></h2>
    <div id="main">
        <?php echo $usuarios_item['correo_usuario'] ?>
    </div>
    <p><a href="news/<?php echo $usuarios_item['telefono'] ?>">View article</a></p>

<?php endforeach ?>


