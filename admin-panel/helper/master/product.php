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
  
  
if ($operation=="fetchPro"){
	$stmt = $PDO->prepare("SELECT * FROM product WHERE pro_status<>2 ORDER BY pro_id ASC");
	$stmt->execute(); 
	if($stmt->rowCount()>0){ ?>
	<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="entry_table_room">
	<thead>
	<tr>
	<th>#</th>
	<th>NAME</th>
	<th>LOGO</th>
	<th>CITY</th>
	<th>STATUS</th>
	<th>ACTIONS</th>
	</tr>
	</thead>
	<tbody> 
	<?php   
	$i=1;
	while ($row=$stmt->fetch()){
	extract($row);	?> 
	<tr id="<?php echo $pro_id; ?>">
	<td><?php echo $i++; ?></td>
	<td><a href="product-brief?id=<?php echo $pro_id; ?>" title="View" class="text-info"><?php echo $pro_name; ?></a></td>
	<td><img src = "../files/property-logo/<?php echo $pro_img; ?>" height = "30"></td>
	<td><?php
		$lo = $PDO->prepare("SELECT ploc_id,ploc_name FROM parent_location 
				WHERE ploc_status<>2 and ploc_id ='$pro_ploc_id_ref' ");
		$lo->execute(); 
		$lo_data = $lo->fetch(PDO::FETCH_OBJ);
		echo $lo_data->ploc_name;
		?>

	</td>
	
	<td><?php echo StatusReport($pro_status);  ?></td>
	<td>
	<a href="product-brief?id=<?php echo $pro_id; ?>" title="View" class="text-info"><i class="fa fa-eye"></i></a> ||
	<?php  
    if ($pro_status==0) { ?>
    <a href="javascript:void(0);" title="Make Active" class="text-success statusup" data-id="<?php echo htmlspecialchars($pro_id); ?>" data-operation="activeroom"><i class="fa fa-check"></i> || </a>
    <?php }else if($pro_status==1) { ?>
    <a href="javascript:void(0);" title="Make Dective" class="text-danger statusup" data-id="<?php echo $pro_id; ?>" data-operation="deactiveroom"><i class="fa fa-lock"></i> || </a>
    <?php } ?>
	<a href="product-update?id=<?php echo htmlspecialchars($pro_id); ?>" class="editbtn" title="Update"><i class="fa fa-edit"></i></a> || 
	<a href="javascript:void(0);" class="statusup" title="Delete" data-id="<?php echo htmlspecialchars($pro_id); ?>" data-operation="deleteroom"><i class="fa fa-trash"></i></a>
	</td>
	</tr>
	<?php } ?>
	</tbody>
	</table>
    </div>
	<?php }else{echo '<div class="alert alert-warning"><p>No Data Found</p></div>'; }
}
elseif ($operation=="addPro") {
	$roomloc      = (!empty($_POST['roomloc']))?FilterInput($_POST['roomloc']):null; 
	$proname      = (!empty($_POST['proname']))?FilterInput($_POST['proname']):null; 
	$prourl       = (!empty($_POST['prourl']))?FilterInput($_POST['prourl']):null;  

	if(empty($proname) OR empty($prourl) OR empty($roomloc)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "Field is Empty"
		));
		die();
	} 

		$chk_slug = CheckExists("product","(pro_slug = '$prourl' OR pro_name = '$proname') AND pro_status<>2");
	if (!empty($chk_slug)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "This Property Name Already Exists"
		));
		die();
	}
	
	$sql = "INSERT INTO product SET
			pro_ploc_id_ref	       = :pro_ploc_id_ref,
	        pro_name               = :pro_name,
	        pro_slug               = :pro_slug";
	        $insert = $PDO->prepare($sql);
	        $insert->bindParam(':pro_ploc_id_ref',$roomloc);
	        $insert->bindParam(':pro_name',$proname);
	        $insert->bindParam(':pro_slug',$prourl);
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

elseif ($operation=="updateRoom") {

	$acmrid        = (!empty($_POST['acmrid']))?FilterInput($_POST['acmrid']):null; 
	$roomurl       = (!empty($_POST['roomurl']))?FilterInput($_POST['roomurl']):null;
	$roomname      = (!empty($_POST['roomname']))?FilterInput($_POST['roomname']):null; 
	$smalldesc     = (!empty($_POST['smalldesc']))?$_POST['smalldesc']:NULL;
	$roomloc       = (!empty($_POST['roomloc']))?$_POST['roomloc']:NULL;
	$fulldesc      = (!empty($_POST['fulldesc']))?$_POST['fulldesc']:NULL;
	$roombed       = (!empty($_POST['roombed']))?FilterInput($_POST['roombed']):null; 
	$roombath      = (!empty($_POST['roombath']))?FilterInput($_POST['roombath']):null; 
	$roomarea      = (!empty($_POST['roomarea']))?FilterInput($_POST['roomarea']):null; 
	$roomprice      = (!empty($_POST['roomprice']))?FilterInput($_POST['roomprice']):null; 
	$roomamenities = (!empty($_POST['roomamenities']))?$_POST['roomamenities']:NULL;


	if(empty($acmrid) OR empty($roomname) OR empty($roomurl)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "Field is Empty"
		));
		die();
	} 

	$pro_det = CheckExists("product","pro_id = '$acmrid' AND pro_status<>2");
	if (empty($pro_det)) {
		echo $response = json_encode(array(
					"status" => false,
					"msg"	 => "Product Not Found"
		));
		die();
	}

	if (!empty($roomamenities)) {
		$roomamenities = implode(',', $roomamenities);
	}


	$thumb = $pro_det['pro_img'];
	if(!empty($_FILES['timage']['name'])){

		$valid_ext   = array('jpeg', 'jpg', 'png'); 
		$MimeFilter  = array('image/jpeg', 'image/jpg', 'image/png');
		$MaxSize     = 5 * 1024 * 1024;
		$FileName    = FilterInput($_FILES['timage']['name']);
		$tmpName     = $_FILES['timage']['tmp_name'];
		$FileTyp     = $_FILES['timage']['type'];
		$FileSize    = $_FILES['timage']['size']; 
		$MimeType    = mime_content_type($_FILES['timage']['tmp_name']);

		$ext         = strtolower(pathinfo($FileName, PATHINFO_EXTENSION));
		if(!in_array($ext, $valid_ext)) {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"File Extention Not Allowed"
			));
			die();
		}
		if($FileSize>$MaxSize){
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Max file Size: 5MB"
			));
			die();
		}
		if($FileTyp!='image/jpeg' && $FileTyp!='image/jpg' && $FileTyp!='image/png'){
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Image Type Shoud be JPG OR JPEG OR PNG"
			));
			die();
		}
		if(!in_array($MimeType, $MimeFilter)) {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"File Not Supported"
			));
			die();
		}
		$dir          = "../../../files/property-logo/";
		$thumb        = FileName($roomname).'_'.time().rand(10000,999999).'.'.$ext;
		$width        = 512;
	    $height       = 351;
		$img_file_fu  = ImageProperResize($height,$width,$dir,$thumb,$_FILES["timage"]["tmp_name"]);

		if (!empty($pro_det->pro_img) AND file_exists("../../../files/property-logo/".$pro_det->pro_img)){
			@unlink("../../../files/property-logo/".$pro_det->pro_img);
		}
	}
		$coverimg = $pro_det['pro_banner'];
	if(!empty($_FILES['image']['name'])){

		$valid_ext   = array('jpeg', 'jpg', 'png'); 
		$MimeFilter  = array('image/jpeg', 'image/jpg', 'image/png');
		$MaxSize     = 5 * 1024 * 1024;

		$FileName    = FilterInput($_FILES['image']['name']);
		$tmpName     = $_FILES['image']['tmp_name'];
		$FileTyp     = $_FILES['image']['type'];
		$FileSize    = $_FILES['image']['size']; 
		$MimeType    = mime_content_type($_FILES['image']['tmp_name']);

		$ext         = strtolower(pathinfo($FileName, PATHINFO_EXTENSION));
		if(!in_array($ext, $valid_ext)) {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"File Extention Not Allowed"
			));
			die();
		}
		if($FileSize>$MaxSize){
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Max file Size: 5MB"
			));
			die();
		}
		if($FileTyp!='image/jpeg' && $FileTyp!='image/jpg' && $FileTyp!='image/png'){
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"Image Type Shoud be JPG OR JPEG OR PNG"
			));
			die();
		}
		if(!in_array($MimeType, $MimeFilter)) {
			echo $response = json_encode(array(
				"status" =>false, 
				"msg"	 =>"File Not Supported"
			));
			die();
		}
		$dir          = "../../../files/property-banner/";
		$coverimg        = FileName($roomname).'_'.time().rand(10000,999999).'.'.$ext;
		$width        = 360;
	    $height       = 240;
		$img_file_fu  = ImageProperResize($height,$width,$dir,$coverimg,$_FILES["image"]["tmp_name"]);

		if (!empty($pro_det->room_banner) AND file_exists("../../../files/property-banner/".$pro_det->pro_banner)){
			@unlink("../../../files/property-banner/".$pro_det->pro_banner);
		}
	}

	$FileName = $pro_det['pro_file'];
	if(!empty($_FILES['comimg']['name'])){

	$valid_ext   = array('jpeg', 'jpg', 'png', 'pdf', 'doc', 'docx');
	$mime_filter = array('image/jpeg', 'image/jpg', 'image/png', 'application/pdf', 'application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	$maxsize     = 10 * 1024 * 1024;

	$FileName    = FilterInput($_FILES['comimg']['name']);
	$tmpName     = $_FILES['comimg']['tmp_name'];
	$FileTyp     = $_FILES['comimg']['type'];
	$FileSize    = $_FILES['comimg']['size'];
	$MimeType    = mime_content_type($_FILES['comimg']['tmp_name']);

	$ext      = strtolower(pathinfo($FileName, PATHINFO_EXTENSION));
	$FileName = FileName($roomname).'_'.time().rand(10000,999999999).'.'.$ext;

	if(!in_array($ext, $valid_ext)) {
	  echo $response = json_encode(array(
	        "status" => false,
	        "msg"    => '<div class="alert alert-danger">File Extension is Not Allowed!</div>'
	    ));
	}
	if($FileSize>$maxsize){
	  echo $response = json_encode(array(
	        "status" => false,
	        "msg"    => '<div class="alert alert-danger">Max File Size Must Be 10MB!</div>'
	    ));
	}
	if(!in_array($FileTyp, $mime_filter)) {
	  echo $response = json_encode(array(
	        "status" => false,
	        "msg"    => '<div class="alert alert-danger">File Format Not Supported!</div>'
	    ));
	}
	if(!in_array($MimeType, $mime_filter)) {
	 echo $response = json_encode(array(
	        "status" => false,
	        "msg"    => '<div class="alert alert-danger">File Format Not Supported!</div>'
	    ));
	}

	$path = "../../../files/property-brochure/".$FileName;
	if (!move_uploaded_file($_FILES["comimg"]["tmp_name"],$path)) {
	  echo $response = json_encode(array(
	        "status" => false,
	        "msg"    => '<div class="alert alert-danger">Cant Upload File!</div>'
	    ));
	}
	chmod($path,0644);
	}

	$sql = "UPDATE product SET
	        pro_name           = :pro_name,
	        pro_slug           = :pro_slug,
	        pro_img            = :pro_img,
	        pro_banner         = :pro_banner,
	        pro_small_desc     = :pro_small_desc,
	        pro_ploc_id_ref    = :pro_ploc_id_ref,
	        pro_full_desc      = :pro_full_desc,
	        pro_bed            = :pro_bed,
	        pro_bath           = :pro_bath,
	        pro_area           = :pro_area,
	        pro_price          = :pro_price,
	        pro_file 		   = :pro_file,
	        pro_amenities      = :pro_amenities
	        WHERE pro_id=:pro_id";
	        $insert = $PDO->prepare($sql);
	        $insert->bindParam(':pro_name',$roomname);
	        $insert->bindParam(':pro_slug',$roomurl);
	        $insert->bindParam(':pro_img',$thumb);
	        $insert->bindParam(':pro_banner',$coverimg);
	        $insert->bindParam(':pro_small_desc',$smalldesc);
	        $insert->bindParam(':pro_ploc_id_ref',$roomloc);
	        $insert->bindParam(':pro_full_desc',$fulldesc);
	        $insert->bindParam(':pro_bed',$roombed);
	        $insert->bindParam(':pro_bath',$roombath);
	        $insert->bindParam(':pro_area',$roomarea);
	        $insert->bindParam(':pro_price',$roomprice);
	        $insert->bindParam(':pro_file',$FileName);
	        $insert->bindParam(':pro_amenities',$roomamenities);
	        $insert->bindParam(':pro_id',$acmrid);
	        $insert->execute();
	        if($insert->rowCount() > 0){
	        	echo $response = json_encode(array(
					"status" => true, 
					"msg"	 => "Successfully Updated"
				));
	        }else {
	        	echo $response = json_encode(array(
					"status" =>false,
					"msg"	 =>"No Changes Done"
				));
			}

}

elseif ($operation=="activeroom" OR $operation=="deactiveroom" OR $operation=="deleteroom") {


	$id = (!empty($_POST['id']))?FilterInput($_POST['id']):null; 
	if(empty($id) AND !is_numeric($id)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "Something Wrong"
		));
		die();
	}
	switch ($operation) {
		case 'activeroom':
			$up = 1;
			$msg="Successfully Activated";
			break;
		case 'deactiveroom':
			$up = 0;
			$msg="Successfully Deactivated";
			break;
		case 'deleteroom':
			$up = 2;
			$msg="Successfully Deleted";
			break;
		default:
			$up=1;
			$msg="Something Wrong";
			break;
	}
	$chk_id = CheckExists("product","pro_id = '$id' AND pro_status<>2");
	if (empty($chk_id)) {
		echo $response = json_encode(array(
				"status" => false,
				"msg"	 => "Cant Find this Entry"
		));
		die();
	}
	if($operation=="deletepro"){
		$sql = "UPDATE  product SET pro_status = 2 , pro_delete_at=NOW() WHERE pro_id = '$id'";
		$insert = $PDO->prepare($sql);
		$insert->execute();
	}
	$ad  = ($operation=='deletepro')?", pro_delete_at=NOW()":null;
	$sql = "UPDATE  product SET pro_status= {$up} ".$ad. " WHERE pro_id= '$id'";
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
