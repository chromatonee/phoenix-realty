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
<title>Property Update</title>
<?php include '_header.php'; ?>
<style type="text/css">
label {}
.custom-control-label::after{position:absolute;top:0rem;left:20px;display:block;width:1.5rem;height:1.5rem;content:"";background-repeat:no-repeat;background-position:center center;background-size:64% 100%}
.custom-control-label::before{position:absolute;top:0rem;left:20px;display:block;width:1.5rem;height:1.5rem;pointer-events:none;content:"";-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:#dee2e6}
.custom-control{position:relative;display:block;min-height:1.5rem;padding-left:3.5rem}
.masterbox ul.token-input-list {width:auto!important;border: 1px solid #d6d6d6;}
.masterbox ul.token-input-list li {display:inline-block;float: left;}
.masterbox ul.token-input-list li input {width:100%;padding:6px 8px;}
.masterbox ul.token-input-list li.token-input-highlighted-token{}
.masterbox li.token-input-token span {margin-left: 5px;}
.masterbox .selectize-input{padding: 6px 8px!important}
.masterbox .dropdown {position: relative;}
.masterbox .locsign {position: absolute;top:8px;right:8px;opacity:.5}
</style>
</head>
<body> 
<?php  include '_menu.php'; ?>
<div class="row">
<div class="col-md-12">
<div class="card card-statistics h-100">
<div class="card-title">
<h5>Update Property - <?= $data->pro_name; ?> <a href="products" class="button x-small pull-right"><i class="fa fa-long-arrow-left"></i> Back</a></h5>
</div> 
<div class="card-body">
<form id="addfrm" autocomplete="off" enctype="multipart/form-data">
<div class="row">
<div class="form-group col-sm-6">
<label for="roomname">Enter Property Name:</label>
<input type="text" class="form-control" id="roomname" name="roomname" required="" autofocus="" value="<?php echo $data->pro_name; ?>">
</div>
<div class="form-group col-sm-6">
<label for="roomurl">Enter Property Url:</label>
<input type="text" class="form-control" id="roomurl" name="roomurl" required="" value="<?php echo $data->pro_slug; ?>">
</div>

<div class="form-group col-sm-3">
<label for="roomimg">Logo Image:[512X351][PNG]</label>
<input type="file" class="form-control" id="roomimg" name="timage">
</div>
<div class="form-group col-sm-3">
<label for="coverimg">Banner Image:[360X240][JPG/JPEG]</label>
<input type="file" class="form-control" id="coverimg" name="image">
</div>
<div class="form-group col-sm-2">
<label for="roombed">Total Bedrooms:</label>
<input type="number" class="form-control" id="roombed" name="roombed" required="" value="<?php echo $data->pro_bed; ?>">
</div>
<div class="form-group col-sm-2">
<label for="roombath">Total Bathrooms:</label>
<input type="number" class="form-control" id="roombath" name="roombath" required="" value="<?php echo $data->pro_bath; ?>">
</div>
<div class="form-group col-sm-2">
<label for="roomarea">Total Area[in sqft]:</label>
<input type="number" class="form-control" id="roomarea" name="roomarea" required="" value="<?php echo $data->pro_area; ?>">
</div>
<div class="form-group col-sm-6">
<label for="smalldesc">Full Address</label>
<textarea class="form-control" id="smalldesc" name="smalldesc" rows="1"><?php echo $data->pro_small_desc; ?></textarea>
</div>
<div class="form-group col-sm-3">
<label for="roomprice">Price:</label>
<input type="number" class="form-control" id="roomprice" name="roomprice" required="" value="<?php echo $data->pro_price; ?>">
</div>
<div class="form-group col-sm-3">
<label for="roomloc">Select City:<span class="req">*</span></label>
<select id="roomloc" name="roomloc" class="form-control" required="">
<option value="">-- Select City --</option>
<?php
$qu=$PDO->prepare("SELECT ploc_id,ploc_name FROM parent_location WHERE ploc_status=1 ORDER BY ploc_name ASC");
$qu->execute(); 
while ($desdet=$qu->fetch()){
echo '<option value="'.$desdet['ploc_id'].'">'.$desdet['ploc_name'].'</option>';
} ?>
</select> 
</div>
<div class="form-group col-sm-12">
<label for="fulldesc">Product Full-Description</label>
<textarea class="form-control" id="fulldesc" name="fulldesc" rows="5"><?php echo $data->pro_full_desc; ?></textarea>
</div>
<div class="col-md-6 col-sm-6">
<div class="form-group">
<label>Document[jpeg, png, pdf]</label>
<input type="file" id="comimg" name="comimg" class="form-control">
</div>
</div>
<label class="col-sm-12"><b>Room Amenities</b></label>
<?php
$amenilist = array();
if(!empty($data->pro_amenities)) {$amenilist = explode(',', $data->pro_amenities);}
$k=1;
$qu=$PDO->prepare("SELECT * FROM room_amenities WHERE am_status<>2");
$qu->execute(); 
while ($catdet=$qu->fetch()){ ?>
<div class="custom-control custom-checkbox mb-30 form-group col-sm-2">
<input type="checkbox" class="custom-control-input" name="roomamenities[]"  <?php echo (in_array($catdet['am_id'],$amenilist))?"checked":null; ?> value="<?php echo $catdet['am_id']; ?>" id="catid<?php echo $k; ?>">
<label class="custom-control-label" for="catid<?php echo $k; ?>"><?php echo $catdet['am_name']; ?></label>
</div>
<?php $k++;} ?>
<div class="form-group col-sm-12">
<button type="submit" class="button btn-block btn-lg entrybtn floatbtn">Update Now</button>
</div>
</div>
</form>
</div>
</div>
</div>         
</div>
<?php  include '_footer.php'; ?>
<script type="text/javascript" src="assets/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$.validator.messages.required = '';
$('#addfrm').validate({});
$(".editor").each(function(){CKEDITOR.replace($(this).attr("name"));});
$("#addfrm").on('submit',(function(e){
for(instance in CKEDITOR.instances){CKEDITOR.instances[instance].updateElement();}
e.preventDefault();
if($("#addfrm").valid()){
    var url="helper/master/product";
    var data = new FormData(this);
    data.append("operation","updateRoom");
    data.append("acmrid","<?php echo $id; ?>");
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      contentType: false,
      cache: false,
      processData:false, 
      dataType:"json",
      beforeSend: function(){$('.entrybtn').addClass('eventbtn');},
      error: function(res){$('.entrybtn').removeClass('eventbtn');showToast("Something Wrong Try Later","error");},
      success: function(res)
      { 
        $('.entrybtn').removeClass('eventbtn');
        if(res.status){
          $("#roomimg").val('');
          $("#coverimg").val('');
          showToast(res.msg,"success");
        }else {showToast(res.msg,"error");}
      }
    }); 
}else{return false;}
}));  


});
$("#roomname").keyup(function(){$("#roomurl").val(convertToSlug($(this).val()));});
</script>
</body>
</html>