<?php 
require_once("../../config/config.php");require_once("../../config/function.php");header("cache-control:no-cache");
if(empty($_SESSION['islogin'])){
	echo $response = json_encode(array(
			"status" =>false,
			"msg"	 => "Unauthorized Access"
	));
	die(); 
} 
$operation  = (!empty($_POST['operation']))?FilterInput($_POST['operation']):null; 
if (empty($operation)){
	echo $response = json_encode(array(
			"status" => false,
			"msg"	 => "Something Wrong"
	));
	die();
}
if ($operation=="fetch"){
	$stmt = $PDO->prepare("SELECT * FROM parent_location WHERE ploc_status<>2 ORDER BY ploc_id ASC");
	$stmt->execute(); 
	if($stmt->rowCount()>0){ ?>
	<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="entry_table">
	<thead>
	<tr>
	<th>#</th>
	<th>NAME</th>
	<th>IMAGE</th>
	<th>URL</th>
	<th>STATUS</th>
	<th>ACTIONS</th>
	</tr>
	</thead>
	<tbody> 
	<?php   
	$i=1;
	while ($row=$stmt->fetch()){
	extract($row);
	?> 
	<tr id="<?php echo $ploc_id; ?>">
	<td><?php echo $i++; ?></td>
	<td><?php echo $ploc_name; ?></td>
	<td><?php
	if((!empty($ploc_img)) AND file_exists("../../../files/location/".$ploc_img)) {
		echo '<img src="../files/location/'.$ploc_img.'" height="20">';
	}else{
		echo '<img src="../files/location/default.jpg" height="20">';
	}
	?>	</td>
	<td><?php echo $ploc_slug; ?></td>
	<td><?php echo StatusReport($ploc_status);  ?></td>
	<td>
	<?php  
    if ($ploc_status==0) { ?>
    <a href="javascript:void(0);" title="Make Active" class="text-success statusup" data-id="<?php echo htmlspecialchars($ploc_id); ?>" data-operation="active"><i class="fa fa-check"></i> || </a>
    <?php }else if($ploc_status==1) { ?>
    <a href="javascript:void(0);" title="Make Dective" class="text-danger statusup" data-id="<?php echo $row['ploc_id']; ?>" data-operation="deactive"><i class="fa fa-lock"></i> || </a>
    <?php } ?>
	<a href="" data-toggle="modal" data-target="#upMod" data-id="<?php echo htmlspecialchars($ploc_id); ?>" data-name="<?php echo htmlspecialchars($ploc_name); ?>" data-url="<?php echo htmlspecialchars($ploc_slug); ?>" class="editbtn" title="Update"><i class="fa fa-edit"></i></a> || 
	<a href="javascript:void(0);" class="statusup" title="Delete" data-id="<?php echo htmlspecialchars($ploc_id); ?>" data-operation="delete"><i class="fa fa-trash"></i></a>
	</td>
	</tr>
	<?php } ?>
	</tbody>
	</table>
    </div>
	<?php }else{echo '<div class="alert alert-warning"><p>No Data Found</p></div>'; }
}
elseif ($operation=="addnew") {
	$name     = (!empty($_POST['name']))?FilterInput($_POST['name']):null; 
	$nameurl  = (!empty($_POST['nameurl']))?FilterInput($_POST['nameurl']):null; 
	if(empty($name) OR empty($nameurl)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "Enter Name"
		));
		die();
	}
	$chk_slug = CheckExists("parent_location","(ploc_slug = '$nameurl' OR ploc_name = '$name') AND ploc_status<>2");
	if (!empty($chk_slug)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "This Name Already Exists"
		));
		die();
	}

	$img_thumb=NULL;
	if(!empty($_FILES['image']['name'])){
		$valid_ext = array('jpeg', 'jpg', 'png'); 
		$maxsize   = 2 * 1024 * 1024;

		$imgFile  = stripslashes($_FILES['image']['name']);
		$tmpName  = $_FILES['image']['tmp_name'];
		$imgType  = $_FILES['image']['type'];
		$imgSize  = $_FILES['image']['size'];

		$ext = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
		if($imgType!='image/jpeg' && $imgType!='image/jpg' && $imgType!='image/png') {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Image Type Shoud be JPG OR PNG OR JPEG"
			));
			die();
		}
		if ($imgSize>$maxsize) {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Max file Size: 2MB"
			));
			die();
		}
		if(!in_array($ext, $valid_ext)) {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Image Extention Should be jpg or png or jpeg"
			));
			die();
		}
		$width=620;$height=410;
		$dir="../../../files/location/"; 
		$img_thumb = FileName($name).'_'.time().rand(10000,999999999).'.'.$ext;
		$img_file  = resize($width,$height,$dir,$img_thumb);
	}

	$sql = "INSERT INTO parent_location SET
	        ploc_slug   = :ploc_slug,
	        ploc_name   = :ploc_name,
	        ploc_img	= :ploc_img";
	        $insert = $PDO->prepare($sql);
	        $insert->bindParam(':ploc_slug',$nameurl);
	        $insert->bindParam(':ploc_name',$name);
	        $insert->bindParam(':ploc_img',$img_thumb);
	        $insert->execute();
	        if($insert->rowCount() > 0){
	        	echo $response = json_encode(array(
					"status" => true, 
					"msg"	 => "Successfully Added"
				));
	        }else {
	        	echo $response = json_encode(array(
					"status" =>false,
					"msg"	 =>"Something Wrong"
				));
			}
}
elseif($operation=="update") {
	$uptid     = (!empty($_POST['uptid']))?FilterInput($_POST['uptid']):null; 
	$upname    = (!empty($_POST['upname']))?FilterInput($_POST['upname']):null; 
	$upnameurl = (!empty($_POST['upnameurl']))?FilterInput($_POST['upnameurl']):null; 

	if(empty($uptid) OR empty($upname) OR empty($upnameurl) OR !is_numeric($uptid)){
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "Fields is Empty"
		));
		die();
	}
	$chk_id = CheckExists("parent_location","ploc_id = '$uptid' AND ploc_status<>2");
	if (empty($chk_id)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "Cant Find this Entry"
		));
		die();
	}
	$chk_slug = CheckExists("parent_location","(ploc_slug = '$upnameurl' OR ploc_name = '$upname') AND ploc_id<>'$uptid' AND ploc_status<>2");
	if (!empty($chk_slug)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "This Name Already Exists"
		));
		die();
	}

	$img_thumb=$chk_id['ploc_img'];
	if(!empty($_FILES['image']['name'])){
		$valid_ext = array('jpeg', 'jpg', 'png'); 
		$maxsize   = 2 * 1024 * 1024;

		$imgFile  = stripslashes($_FILES['image']['name']);
		$tmpName  = $_FILES['image']['tmp_name'];
		$imgType  = $_FILES['image']['type'];
		$imgSize  = $_FILES['image']['size'];

		$ext = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
		if($imgType!='image/jpeg' && $imgType!='image/jpg' && $imgType!='image/png') {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Image Type Shoud be JPG OR PNG OR JPEG"
			));
			die();
		}
		if ($imgSize>$maxsize) {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Max file Size: 2MB"
			));
			die();
		}
		if(!in_array($ext, $valid_ext)) {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Image Extention Should be jpg or png or jpeg"
			));
			die();
		}
		$width=620;$height=410;
		$dir="../../../files/location/"; 
		$img_thumb = FileName($upname).'_'.time().rand(10000,999999999).'.'.$ext;
		$img_file  = resize($width,$height,$dir,$img_thumb);
		if ((!empty($chk_id->ploc_img)) AND file_exists("../../../files/location/".$chk_id->ploc_img)) {
			@unlink("../../../files/location/".$chk_id->ploc_img);
		}
	}

	$sql = "UPDATE parent_location SET
		        ploc_slug      = :ploc_slug,
		        ploc_name     = :ploc_name,
		        ploc_img	= :ploc_img
	            WHERE ploc_id=:ploc_id";
	            $insert = $PDO->prepare($sql);
		        $insert->bindParam(':ploc_slug',$upnameurl);
		        $insert->bindParam(':ploc_name',$upname);
		        $insert->bindParam(':ploc_img',$img_thumb);
	            $insert->bindParam(':ploc_id',$uptid);
		        $insert->execute();
	            if($insert->rowCount() > 0){
	            	echo $response = json_encode(array(
						"status" =>true, 
						"msg"	 => "Successfully Updated"
					));
	            }else {
	            	echo $response = json_encode(array(
						"status" =>false,
						"msg"	 =>"No Change Done"
					));
	   			}
}
elseif ($operation=="active" OR $operation=="deactive" OR $operation=="delete") {


	$id = (!empty($_POST['id']))?FilterInput($_POST['id']):null; 
	if(empty($id) AND !is_numeric($id)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "Something Wrong"
		));
		die();
	}
	switch ($operation) {
		case 'active':
			$up = 1;
			$msg="Successfully Activated";
			break;
		case 'deactive':
			$up = 0;
			$msg="Successfully Deactivated";
			break;
		case 'delete':
			$up = 2;
			$msg="Successfully Deleted";
			break;
		default:
			$up=1;
			$msg="Something Wrong";
			break;
	}
	$chk_id = CheckExists("parent_location","ploc_id = '$id' AND ploc_status<>2");
	if (empty($chk_id)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "Cant Find this Entry"
		));
		die();
	}
	$ad = ($operation=='delete')?", ploc_delete_at=NOW()":null;
	$sql = "UPDATE parent_location SET ploc_status= {$up} ".$ad. " WHERE ploc_id= {$id}";
			$insert = $PDO->prepare($sql);
			$insert->execute();
			if($insert->rowCount() > 0){
					echo $response = json_encode(array(
					"status" => true, 
					"msg"	 => $msg
				));
			}else {
					echo $response = json_encode(array(
					"status" =>false,
					"msg"	 =>"No Change Done"
				));
			}
}
// elseif ($operation=="orderType") {
// 	$res  = (!empty($_POST['data']))?$_POST['data']:null;
// 	if (empty($res)) {
// 		echo $response = json_encode(array(
// 			"status" => false, 
// 			"msg"	 => "No Changes Done"
// 		));   
// 		die();
// 	}
// 	$i=1;
// 	foreach ($res as $value) {
// 	    $sql = "UPDATE parent_location SET
// 		            am_order ='$i'
// 		            WHERE acm_room_amenity_id ='$value'";
// 		            $update = $PDO->prepare($sql);
// 			        $update->execute();
// 		$i++;
// 	}
// 	echo $response = json_encode(array(
// 			"status" => true, 
// 			"msg"	 => "Success"
// 	));   
// 	die();
// }
// else {
// 	echo $response = json_encode(array(
// 			"status" => false,
// 			"msg"	 =>" Something Wrong"
// 	));
// 	die();
// }