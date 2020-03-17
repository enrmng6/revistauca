<?php 
$arrayfinal=array();
$con= new mysqli("localhost","root","progra","revistaucaapp");

$resultado=$con->query("SELECT * FROM calendario ORDER BY FECHA;");

for ($i=0; $i < $resultado->num_rows; $i++) { 
	$resultado->data_seek($i);
	$arregloPHP=$resultado->fetch_assoc();
	array_push($arrayfinal,$arregloPHP);
 }
 
 

echo json_encode($arrayfinal);
 
 ?>