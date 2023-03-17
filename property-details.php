<?php 
include '_top.php'; 
$link=$_SERVER['REQUEST_URI']; 
$link_array=explode('/',$link);
$proslug=FilterInput(strval(end($link_array)));
if(empty($proslug) OR $proslug=="property"){include '404.php';die();} 


$stmt = $PDO->prepare("SELECT * FROM product WHERE pro_slug='$proslug' AND pro_status=1");
$stmt->execute(); 
$datap = $stmt->fetch(PDO::FETCH_OBJ);
if(empty($datap)){include '404.php';die();}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title>Phoenix Reality - <?php echo $datap->pro_name?></title>
	<!-- <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=63c93d45592bb2001af01dc6&product=inline-share-buttons&source=platform" async="async"></script> -->
	<?php include '_header.php'; ?>
	<style type="text/css">
		.page-title {
			padding-bottom: 42px;
			height: 288px;
			justify-content: flex-end;
		}

		.nav-menu>li>a {
			margin-top: 15px;
		}

		.nav-menu.nav-menu-social>li.add-listing a {
			top: -30px;
		}

		.nav-menu.nav-menu-social>li.add-listing {
			top: 32px;
		}
	</style>

</head>

<body class="blue-skin">
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<!-- <div id="preloader"><div class="preloader"><span></span><span></span></div></div> -->


	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">

		<!-- ============================================================== -->
		<!-- Top header  -->
		<!-- ============================================================== -->
		<!-- Start Navigation -->
		<?php include '_menu.php'; ?>
		<!-- End Navigation -->
		<div class="clearfix"></div>
		<!-- ============================================================== -->
		<!-- Top header  -->
		<!-- ============================================================== -->


		<!-- ============================ Hero Banner  Start================================== -->
		<div class="featured_slick_gallery gray">
			<div class="featured_slick_gallery-slide">
				<?php 
							$gallist = $PDO->prepare("SELECT * FROM product_gallery WHERE pg_pro_id_ref='$datap->pro_id' AND pg_img_status=1");
							$gallist->execute(); 
							$galdet=$gallist->fetchAll();
							if (empty($galdet)) {
							echo '<img src="files/property-gallery/default.jpg" alt="">';
							}else{
							?>
							<?php $count=1; foreach($galdet as $eachgal) {
							extract($eachgal);
							$mainimg="files/property-gallery/".$pg_img_lg;
							?>
				<div class="featured_slick_padd"><a href="<?php echo $mainimg;?>" class="mfp-gallery"><img src="<?php echo $mainimg;?>" class="img-fluid mx-auto" alt="" /></a></div>
				<?php  $count++;} ?>
				<?php } ?>
			</div>
			<!-- <a href="JavaScript:Void(0);" class="btn-view-pic">View photos</a> -->
		</div>
		<!-- ============================ Hero Banner End ================================== -->

		<!-- ============================ Property Detail Start ================================== -->
		<section class="gray-simple">
			<div class="container">
				<div class="row">

					<!-- property main detail -->
					<div class="col-lg-8 col-md-12 col-sm-12">

						<div class="property_block_wrap style-2 p-4">
							<div class="prt-detail-title-desc">
								<span class="prt-types sale">For Sale</span>
								<h3><?php echo $datap->pro_name?></h3>
								<span><i class="lni-map-marker"></i> <?php echo $datap->pro_small_desc?></span>
								<h3 class="prt-price-fix">₹ <?php echo moneyFormatIndia($datap->pro_price)?></h3>
								<div class="list-fx-features">
									<div class="listing-card-info-icon">
										<div class="inc-fleat-icon"><img src="assets/img/bed.svg" width="13" alt=""></div><?php echo $datap->pro_bed?> Beds
									</div>
									<div class="listing-card-info-icon">
										<div class="inc-fleat-icon"><img src="assets/img/bathtub.svg" width="13" alt=""></div><?php echo $datap->pro_bath?> Bath
									</div>
									<div class="listing-card-info-icon">
										<div class="inc-fleat-icon"><img src="assets/img/move.svg" width="13" alt=""></div><?php echo $datap->pro_area?> sqft
									</div>
								</div>
							</div>
						</div>

						<!-- Single Block Wrap -->
						<!-- <div class="property_block_wrap style-2">

							<div class="property_block_wrap_header">
								<a data-bs-toggle="collapse" data-parent="#features" data-bs-target="#clOne" aria-controls="clOne" href="javascript:void(0);" aria-expanded="false">
									<h4 class="property_block_title">Detail & Features</h4>
								</a>
							</div>
							<div id="clOne" class="panel-collapse collapse show" aria-labelledby="clOne">
								<div class="block-body">
									<ul class="deatil_features">
										<li><strong>Bedrooms:</strong>3 Beds</li>
										<li><strong>Bathrooms:</strong>2 Bath</li>
										<li><strong>Areas:</strong>4,240 sq ft</li>
										<li><strong>Garage</strong>1</li>
										<li><strong>Property Type:</strong>Apartment</li>
										<li><strong>Year:</strong>Built1982</li>
										<li><strong>Status:</strong>Active</li>
										<li><strong>Cooling:</strong>Central A/C</li>
										<li><strong>Heating Type:</strong>Forced Air</li>
										<li><strong>Kitchen Features:</strong>Kitchen Facilities</li>
										<li><strong>Exterior:</strong>FinishBrick</li>
										<li><strong>Swimming Pool:</strong>Yes</li>
										<li><strong>Elevetor:</strong>Yes</li>
										<li><strong>Fireplace:</strong>Yes</li>
										<li><strong>Free WiFi:</strong>No</li>

									</ul>
								</div>
							</div>

						</div> -->

						<!-- Single Block Wrap -->
						<div class="property_block_wrap style-2">

							<div class="property_block_wrap_header">
								<a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo" href="javascript:void(0);" aria-expanded="true">
									<h4 class="property_block_title">Description</h4>
								</a>
							</div>
							<div id="clTwo" class="panel-collapse collapse show">
								<div class="block-body">
									<p><?php echo $datap->pro_full_desc?></p>
								</div>
							</div>
						</div>

						<!-- Single Block Wrap -->
						<div class="property_block_wrap style-2">

							<div class="property_block_wrap_header">
								<a data-bs-toggle="collapse" data-parent="#amen" data-bs-target="#clThree" aria-controls="clThree" href="javascript:void(0);" aria-expanded="true">
									<h4 class="property_block_title">Ameneties</h4>
								</a>
							</div>

							<div id="clThree" class="panel-collapse collapse show">
								<div class="block-body"><?php 
									$facimsg = null; 

									if (!empty($datap->pro_amenities)) {
									  $amelist = explode(',', $datap->pro_amenities);
									  $facimsg   = '<ul class="avl-features third color">';
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
									
								</div>
							</div>
						</div>

						<!-- Single Block Wrap -->
						<!-- <div class="property_block_wrap style-2">
								
								<div class="property_block_wrap_header">
									<a data-bs-toggle="collapse" data-parent="#vid"  data-bs-target="#clFour" aria-controls="clFour" href="javascript:void(0);" aria-expanded="true" class="collapsed"><h4 class="property_block_title">Property video</h4></a>
								</div>
								
								<div id="clFour" class="panel-collapse collapse">
									<div class="block-body">
										<div class="property_video">
											<div class="thumb">
												<img class="pro_img img-fluid w100" src="assets/img/pl-6.jpg" alt="7.jpg">
												<div class="overlay_icon">
													<div class="bb-video-box">
														<div class="bb-video-box-inner">
															<div class="bb-video-box-innerup">
																<a href="https://www.youtube.com/watch?v=A8EI6JaFbv4" data-bs-toggle="modal" data-bs-target="#popup-video" class="theme-cl"><i class="ti-control-play"></i></a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div> -->

						<!-- Single Block Wrap -->
						<!-- <div class="property_block_wrap style-2">
								
								<div class="property_block_wrap_header">
									<a data-bs-toggle="collapse" data-parent="#floor"  data-bs-target="#clFive" aria-controls="clFive" href="javascript:void(0);" aria-expanded="true" class="collapsed"><h4 class="property_block_title">Floor Plan</h4></a>
								</div>
								
								<div id="clFive" class="panel-collapse collapse">
									<div class="block-body">
										<div class="accordion" id="floor-option">
											<div class="card">
												<div class="card-header" id="firstFloor">
													<h2 class="mb-0">
														<button type="button" class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#firstfloor" aria-controls="firstfloor">First Floor<span>740 sq ft</span></button>									
													</h2>
												</div>
												<div id="firstfloor" class="collapse" aria-labelledby="firstFloor" data-parent="#floor-option">
													<div class="card-body">
														<img src="assets/img/floor.jpg" class="img-fluid" alt="" />
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="seconfFloor">
													<h2 class="mb-0">
														<button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#secondfloor" aria-controls="secondfloor">Second Floor<span>710 sq ft</span></button>
													</h2>
												</div>
												<div id="secondfloor" class="collapse" aria-labelledby="seconfFloor" data-parent="#floor-option">
													<div class="card-body">
														<img src="assets/img/floor.jpg" class="img-fluid" alt="" />
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" id="third-garage">
													<h2 class="mb-0">
														<button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#garages" aria-controls="garages">Garage<span>520 sq ft</span></button>                     
													</h2>
												</div>
												<div id="garages" class="collapse" aria-labelledby="third-garage" data-parent="#floor-option">
													<div class="card-body">
														<img src="assets/img/floor.jpg" class="img-fluid" alt="" />
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div> -->

						<!-- Single Block Wrap -->
						<!-- <div class="property_block_wrap style-2">
								
								<div class="property_block_wrap_header">
									<a data-bs-toggle="collapse" data-parent="#loca"  data-bs-target="#clSix" aria-controls="clSix" href="javascript:void(0);" aria-expanded="true" class="collapsed"><h4 class="property_block_title">Location</h4></a>
								</div>
								
								<div id="clSix" class="panel-collapse collapse">
									<div class="block-body">
										<div class="map-container">
											<div id="singleMap" data-latitude="40.7427837" data-longitude="-73.11445617675781" data-mapTitle="Our Location"></div>
										</div>

									</div>
								</div>
								
							</div> -->

						<!-- Single Block Wrap -->
						<!-- <div class="property_block_wrap style-2">
								
								<div class="property_block_wrap_header">
									<a data-bs-toggle="collapse" data-parent="#clSev"  data-bs-target="#clSev" aria-controls="clOne" href="javascript:void(0);" aria-expanded="true" class="collapsed"><h4 class="property_block_title">Gallery</h4></a>
								</div>
								
								<div id="clSev" class="panel-collapse collapse">
									<div class="block-body">
										<ul class="list-gallery-inline">
											<li>
												<a href="assets/img/p-1.jpg" class="mfp-gallery"><img src="assets/img/p-1.jpg" class="img-fluid mx-auto" alt="" /></a>
											</li>
											<li>
												<a href="assets/img/p-2.jpg" class="mfp-gallery"><img src="assets/img/p-2.jpg" class="img-fluid mx-auto" alt="" /></a>
											</li>
											<li>
												<a href="assets/img/p-3.jpg" class="mfp-gallery"><img src="assets/img/p-3.jpg" class="img-fluid mx-auto" alt="" /></a>
											</li>
											<li>
												<a href="assets/img/p-4.jpg" class="mfp-gallery"><img src="assets/img/p-4.jpg" class="img-fluid mx-auto" alt="" /></a>
											</li>
											<li>
												<a href="assets/img/p-5.jpg" class="mfp-gallery"><img src="assets/img/p-5.jpg" class="img-fluid mx-auto" alt="" /></a>
											</li>
											<li>
												<a href="assets/img/p-6.jpg" class="mfp-gallery"><img src="assets/img/p-6.jpg" class="img-fluid mx-auto" alt="" /></a>
											</li>
										</ul>
									</div>
								</div>
								
							</div> -->

						<a href="files/property-brochure/<?php echo $datap->pro_file?>" target='/' class="btn btn-black btn-md rounded full-width">Download Brochure</a>
					</div>

					<!-- property Sidebar -->
					<div class="col-lg-4 col-md-12 col-sm-12">

						<!-- Like And Share -->
						<div class="like_share_wrap b-0">
							<ul class="like_share_list">
								<li><a href="https://api.whatsapp.com/send?text=https://www.phoenix-realty.in/property/<?php echo $datap->pro_slug?>" class="btn btn-likes" data-toggle="tooltip" data-original-title="Share" target="_blank" rel="noopener"><i class="fas fa-share"></i>Share</a>
								</li>
								<!-- <li><a href="JavaScript:Void(0);" onclick="save()" id="save" class="btn btn-likes" data-toggle="tooltip" data-original-title="Save"><i class="fas fa-heart"></i>Save</a></li> -->
							</ul>
						</div>

						<div class="details-sidebar">

							<!-- Agent Detail -->
							<div class="sides-widget">
								<!-- <div class="sides-widget-header">
										<div class="agent-photo"><img src="assets/img/user-6.jpg" alt=""></div>
										<div class="sides-widget-details">
											<h4><a href="#">Shivangi Preet</a></h4>
											<span><i class="lni-phone-handset"></i>(91) 123 456 7895</span>
										</div>
										<div class="clearfix"></div>
									</div> -->
							<form id="enquiry" >
								<div class="sides-widget-body simple-form">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control " required id="name" name="name" placeholder="Your Name">
									</div>
									<div class="form-group">
										<label>Phone No.</label>
										<input type="text" class="form-control " required placeholder="Your Phone" id="phone" name="phone">
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" id="message" name="message">I'm interested in this property - <?php echo $datap->pro_name?></textarea>
									</div>
									<input type="submit" value="Send Message" id="submit-contact" class="btn btn-md full-width btn-theme-light rounded" >
								</div>
								<div class=" col-xs-10 outmsg"></div>
							</form>
							
							</div>

							<!-- Mortgage Calculator -->
							<div class="sides-widget">

								<!-- <div class="sides-widget-header">
										<div class="sides-widget-details">
											<h4><a href="#">Shivangi Preet</a></h4>
											<span>View your Interest Rate</span>
										</div>
										<div class="clearfix"></div>
									</div> -->

								<div class="sides-widget-body simple-form">
									<div class="form-group">
										<div class="input-with-icon">
											<input type="text" class="form-control" id="amount" placeholder="Sale Price">
											<i class="fas fa-rupee-sign"></i>
										</div>
									</div>

									<div class="form-group">
										<div class="input-with-icon">
											<input type="text" class="form-control" id="damount" placeholder="Down Payment">
											<i class="fas fa-rupee-sign"></i>
										</div>
									</div>

									<div class="form-group">
										<div class="input-with-icon">
											<input type="text" class="form-control" id="time" placeholder="Loan Term (Months)">
											<i class="ti-calendar"></i>
										</div>
									</div>

									<div class="form-group">
										<div class="input-with-icon">
											<input type="text" class="form-control" step=".1" id="rate" placeholder="Interest Rate">
											<i class="fa fa-percent"></i>
										</div>
									</div>

									<button class="btn btn-black btn-md rounded full-width" onclick="calculateEmi()">Calculate</button>
									<p style="margin-top: 10px;">Total EMI: ₹
										<span id="output"></span>
									</p>
								</div>
							</div>

							<!-- Featured Property -->
							<div class="sidebar-widgets">

								<h4>Similar Property</h4>

								<div class="sidebar_featured_property">
									<?php $stmt ="SELECT * FROM parent_location,product WHERE ploc_status=1 AND pro_status=1 AND ploc_id = '$datap->pro_ploc_id_ref' AND pro_id<>'$datap->pro_id' ORDER BY rand() LIMIT 2";
                                    $res = $PDO->prepare($stmt);
                                    $res->execute();
                                    $teslist = $res->fetchAll();
                                    foreach ($teslist  as $pkges){extract($pkges); 
                                    if(!empty($pro_banner) AND file_exists('files/property-banner/'.$pro_banner)){
                                      $img =  $pro_banner;       
                                    }else{
                                      $img = "default.jpg";
                                    }
                                    ?>
									<div class="sides_list_property">
										<div class="sides_list_property_thumb">
											<img src="files/property-banner/<?php echo $img; ?>" class="img-fluid" alt="">
										</div>
										<div class="sides_list_property_detail">
											<h4><a href="property/<?php echo $pro_slug; ?>" target="/"><?php echo $pro_name; ?></a></h4>
											<span><i class="ti-location-pin"></i><?=$pro_small_desc; ?></span>
											<div class="lists_property_price">
												<div class="lists_property_types">
													<div class="property_types_vlix sale">For Sale</div>
												</div>
												<div class="lists_property_price_value">
													<h4>₹ <?php echo moneyFormatIndia($pro_price); ?></h4>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>
								</div>

							</div>

						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- ============================ Property Detail End ================================== -->
		<script>
			function calculateEmi() {
				amount = document.getElementById('amount').value
				damount = document.getElementById('damount').value
				rate = document.getElementById('rate').value
				time = document.getElementById('time').value
				famount = parseInt(amount) - parseInt(damount);
				const interest = (famount * (rate * 0.01)) / time;
				let emi = ((famount / time) + interest).toFixed(2);
				emi = emi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				document.getElementById("output").innerHTML = emi
			}
			function save(){
				document.getElementById('save').innerHTML='<i class="fas fa-heart"></i> Saved';
				


			}
		</script>
		<?php include '_footer.php'; ?>
		<script>
	  $(document).ready(function(){
    $("#enquiry").on('submit',(function(e){
    e.preventDefault();
    var url="_check_quote";
    var data = new FormData(this);
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      contentType: false,
      cache: false,
      processData:false, 
      dataType:"json",
      beforeSend: function(){$('.actionbtn').addClass('is-loading');},
      error: function(res){$('.actionbtn').removeClass('is-loading');},
      success: function(res){
        $('.actionbtn').removeClass('is-loading');
        $(".outmsg").html(res.msg);
        if(res.status){$("#enquiry").trigger('reset');}
      }
    })
  }));
});
</script>
</body>


</html>