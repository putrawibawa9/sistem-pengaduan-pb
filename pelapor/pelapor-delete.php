<?php

require_once '../classes/classPelapor.php';

$id_pelapor = $_GET['id_pelapor'];

$deletePelapor = new Pelapor;


$deletePelapor->deletePelapor($id_pelapor);

?>