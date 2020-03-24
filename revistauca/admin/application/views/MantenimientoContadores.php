<?php
   $CI=& get_instance(); 
   if($this->uri->segment(3)==0){
    $Contadores[0]['id']="";   
    $Contadores[0]['preview']="";
    $Contadores[0]['archivo']="";
    $Contadores[0]['titulo']="";
    $Contadores[0]['id_autor']="";
    $Contadores[0]['modificado']="";
    $Contadores[0]['creado']="";
    $Contadores[0]['descripcion']="";
    $Contadores[0]['contenido']="";
    $Contadores[0]['megusta']="";
    $Contadores[0]['nomegusta']="";
    $Contadores[0]['compartido']="";
   }else{
       $CI->db->where('id',$this->uri->segment(3));
       $Contadores = $CI->db->get('entrecontadores')->result_array();

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mantenimiento</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        tr{
            width:inline-table;
            table-Layout:fixed;
        }

        table{
            height:200px;
            display: -moz-groupbox;
        }

        tbody{
            overflow-y:scroll;
            height:500px;
            position:absolute;
        }

        html{
            min-heigth:100px;
            position:relative;
        }
     
        body{
            margin:0;
            margin-bottom:120px;
            background-color:#ffab00;
            background-image: url("https://www.solofondos.com/wp-content/uploads/2015/11/bgcalisma-1.jpg");
        }
        .panel-default{
            background-color:#0097a7;
            border:1px solid black;
        }

        h1{
            font-size:50px;
            color:blue;
        }
        .footer{
            position:absolute;
            text-align: center;
            bottom:0;
            width:1800px;
            height:70px;
            line-height:100px;
            background-color:#424242;
        }
        
    
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class ="col-md-12 text-center">
                <h1> Revista Entre Contadores</h1>
            </div>
        
        </div>
    
        <div class="row">
            <div class ="col-md-4">
                <div class ="panel panel-default">
                    <div class ="panel-heading">Agregar Revista</div>
                    <div class ="panel-body">
                        <form action="<?=base_url('EntreContadoresController/guardar')?>" method="post">
                            
                            
                            <div class="col-md-12 form-group input-group">
                                
                                <input type="HIDDEN" name="id" class="form-control" value="<?= $Contadores[0]['id'] ?>">
                            </div>
                           
                            
                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">preview</label>
                                <input required type="text" name="preview" class="form-control" value="<?= $Contadores[0]['preview'] ?>">
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">archivo</label>
                                <input required type="text" name="archivo" class="form-control" value="<?= $Contadores[0]['archivo'] ?>">
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">titulo</label>
                                <input required type="text" name="titulo" class="form-control" value="<?= $Contadores[0]['titulo'] ?>">
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">id_autor</label>
                                <input required type="text" name="id_autor" class="form-control" value="<?= $Contadores[0]['id_autor'] ?>">
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">modificado</label>
                                <input required type="text" name="modificado" class="form-control" value="<?= $Contadores[0]['modificado'] ?>">
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">creado</label>
                                <input required type="text" name="creado" class="form-control" value="<?= $Contadores[0]['creado'] ?>" >
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">descripcion</label>
                                <textarea required name="descripcion" class="form-control">
                                    <?= $Contadores[0]['descripcion'] ?>
                                </textarea>
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">contenido</label>
                                <textarea required name="contenido" class="form-control">
                                    <?= $Contadores[0]['contenido'] ?>
                                </textarea>
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">me gusta</label>
                                <input required type="text" name="megusta" class="form-control" value="<?= $Contadores[0]['megusta'] ?>">
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">no me gusta</label>
                                <input required type="text" name="nomegusta" class="form-control" value="<?= $Contadores[0]['nomegusta'] ?>">
                            </div>

                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">compartido</label>
                                <input required type="text" name="compartido" class="form-control" value="<?= $Contadores[0]['compartido'] ?>">
                            </div>

                            <div class ="col-md-12 text-center">
                                <a href="<?= base_url("EntreContadoresController/guardar")?>" class="btn btn-primary">Nuevo Registro</a>
                                <button type="submit" class="btn btn-success">Guardar Registro</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class ="col-md-8">
                <div class ="panel panel-default" style="width: 1270px; height:700px;">
                    <div class ="panel-heading">Revista Agregadas</div>
                    <div class ="panel-body">
                       <table class="table table-hover table-striped">
                           <thead>
                                <th>id</th>
                                <th>preview</th>
                                <th>archivo</th>
                                <th>titulo</th>
                                <th>id_autor</th>
                                <th>modificado</th>
                                <th>creado</th>
                                <th>descripcion</th>
                                <th>contenido</th>
                                <th>megusta</th>
                                <th>nomegusta</th>
                                <th>compartido</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                    $CI =& get_instance();
                                    $entrecontadores = $CI->db->get('entrecontadores')-> result_array();

                                    foreach($entrecontadores as $entrecontadores){
                                        $rutaeditar = base_url("EntreContadoresController/guardar/{$entrecontadores['id']}");
                                        $rutaelimiar = base_url("EntreContadoresController/eliminar/eliminar?eliminar={$entrecontadores['id']}");
                                        echo"<tr>
                                            <td>{$entrecontadores['id']}</td>
                                            <td>{$entrecontadores['preview']}</td>
                                            <td>{$entrecontadores['archivo']}</td>
                                            <td>{$entrecontadores['titulo']}</td>
                                            <td>{$entrecontadores['id_autor']}</td>
                                            <td>{$entrecontadores['modificado']}</td>
                                            <td>{$entrecontadores['creado']}</td>
                                            <td>{$entrecontadores['descripcion']}</td>
                                            <td>{$entrecontadores['contenido']}</td>
                                            <td>{$entrecontadores['megusta']}</td>
                                            <td>{$entrecontadores['nomegusta']}</td>
                                            <td>{$entrecontadores['compartido']}</td>
                                            <td>
                                                <a href ='{$rutaeditar}' class='btn btn-info glyphicon glyphicon-pencil'></a>
                                                <a href ='{$rutaelimiar}' onclick='return confirm(\"¿Seguro que desea eliminar el registro?\")' class='btn btn-danger glyphicon glyphicon-remove'></a>

                                            </td>
                                        </tr>
                                        ";


                                    }
                                ?>
                            </tbody>
                       </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
<footer class="footer">
        <div class:"container text-center">                        
            <span class="text-muted">Universidad Florencio del Castillo Año 2020</span>                           
        </div>
</footer>

</body>
</html>