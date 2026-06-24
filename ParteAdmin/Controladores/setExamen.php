<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once(__DIR__. '../../../System/Clases/class.DataManager.php');
$numExamen = $_POST['textNumExamen'];

$llamadoDM = new DataManager;

$llamadoDM->_setExamenActivo($numExamen);

?>