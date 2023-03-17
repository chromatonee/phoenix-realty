<?php include '_auth.php'; ?>
<?php
$id=FilterInput($_GET['id']);
if(!is_numeric($id)){include '404.php';die();}
$stmt = $PDO->prepare("SELECT * FROM product WHERE pro_id='$id' AND pro_status<>2");
$stmt->execute(); 
$data = $stmt->fetch(PDO::FETCH_OBJ);
if(empty($data)){include '404.php';die();}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Property Details</title>
<?php  include '_header.php'; ?>
<style type="text/css">
table.text-left thead tr th, table.text-left tbody tr td {text-align: left!important;}
.faclist li{display: inline-block;background: #1f7da0;margin: 10px 2px;padding: 4px 11px;border-radius: 24px;color: #fff;font-weight: 600;}
</style>
</head>
<body>
<?php  include '_menu.php'; ?>
<div class="row">
<div class="col-md-12">
<div class="card card-statistics h-100">
<div class="card-title">
<h5>Property Type - <?= $data->pro_name; ?> <a href="products" class="button x-small pull-right"><i class="fa fa-long-arrow-left"></i> Back</a> <a href="product-update?id=<?php echo $id; ?>" class="button x-small pull-right mx-2"><i class="fa fa-pencil"></i> Update</a></h5></div>
<div class="card-body">
<ul class="nav nav-tabs thmnavtab">
<li class="nav-item"><a class="nav-link active" href="product-brief?id=<?= $data->pro_id; ?>">Brief Info</a></li>
<li class="nav-item"><a class="nav-link" href="products-gallery?id=<?= $data->pro_id; ?>">Property Gallery</a></li>
</ul>
<div class="table-responsive">          
<table class="table table-hover table-bordered text-left">
<tbody>
<tr>
<td style="font-weight: 600;">Name</td>
<td><?php echo $data->pro_name; ?></td>
<td style="font-weight: 600;">City</td>
<?php
$lo = $PDO->prepare("SELECT ploc_id,ploc_name FROM parent_location 
        WHERE ploc_status<>2 and ploc_id ='$data->pro_ploc_id_ref' ");
$lo->execute(); 
$lo_data = $lo->fetch(PDO::FETCH_OBJ);
?>
<td><?php echo $lo_data->ploc_name; ?></td>

</tr>
<tr>
<td style="font-weight: 600;">Logo</td>
<td><img src="../files/property-logo/<?php echo $data->pro_img; ?>" height="50" width="70"></td>
<td style="font-weight: 600;">Banner</td>
<td><img src="../files/property-banner/<?php echo $data->pro_banner; ?>" height="50" width="70"></td>
</tr>
<tr>
<td style="font-weight: 600;">Full-Address</td>
<td><?php echo $data->pro_small_desc; ?></td>
<td style="font-weight: 600;">Price</td>
<td>₹ <?php echo moneyFormatIndia($data->pro_price); ?></td>
</tr>
<tr>
<td style="font-weight: 600;">Full-Description</td>
<td colspan="3"><?php echo $data->pro_full_desc; ?></td>
</tr>
<tr>
<td style="font-weight: 600;">Bedrooms</td>
<td><?php echo $data->pro_bed; ?></td>
<td style="font-weight: 600;">Bathrooms</td>
<td><?php echo $data->pro_bath; ?></td>
</tr>
<tr>
<td style="font-weight: 600;">Total Area</td>
<td><?php echo $data->pro_area; ?> sqft</td>
<td style="font-weight: 600;">Brochure</td>
<td><?php if(!empty($data->pro_file)){
echo '<a href="../files/property-brochure/'.$data->pro_file.'" target="/"><h6 style="color: #005bff; font-weight: 600;">VIEW</h6></a></td>'; } 
else{echo'-NO DOC-';}
?>
</td>
</tr>
<tr>
<td>Amenities</td>
<td colspan="3">
<?php 
$facimsg = null; 

if (!empty($data->pro_amenities)) {
  $amelist = explode(',', $data->pro_amenities);
  $facimsg   = '<ul class="list-inline faclist">';
  foreach ($amelist as $eachame) {
    $amenity = CheckExist("room_amenities","am_id = '$eachame' AND am_status<>2");
    if (!empty($amenity)) {
      $name = $amenity->am_name;
      $facimsg .='<li>'.$name.'</li>';
    }
  }
  $facimsg.="</ul>";
}
echo $facimsg;
?>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>        
</div>
<?php  include '_footer.php'; ?>
<script type="text/javascript">
</script>
</body>
</html>