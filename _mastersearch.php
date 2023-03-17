<?php 
require_once("admin-panel/config/config.php");  
require_once("admin-panel/config/function.php"); 

$lid     = (!empty($_REQUEST['lid']))?FilterInput($_REQUEST['lid']):null; 
$keyword = (!empty($_REQUEST['query']))?FilterInput(strval($_REQUEST['query'])):null; 
// $type    = (!empty($_REQUEST['type']))?FilterInput(strval($_REQUEST['type'])):null; 

$qu="SELECT * location FROM parent_location WHERE ploc_name LIKE "."'%".$lid."%'";
if (!empty($lid) AND is_numeric($lid)) {
    $qu.=" AND ploc_id<>'$lid' ";
}
$run = $PDO->prepare($qu);
$run->execute();
$data=$subar=array();
if ($run->rowCount()>0){
    while($row   = $run->fetch()) {
    	$subar= array(
    		"nm" => $row['ploc_name'],
    		"id" => $row['ploc_id']
    	);
    	array_push($data,$subar);
    }
    echo json_encode($data);
}
die();