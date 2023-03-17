<?php 
include '_top.php'; 
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
        <title>Phoenix Reality</title>	
        <?php include '_header.php'; ?>
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
			<div class="hero-banner vedio-banner">
				<div class="overlay"></div>	

				<video playsinline="playsinline" autoplay="autoplay" muted="unmuted" loop="loop">
					<source src="assets/img/banners.mp4" type="video/mp4">
				</video>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-9 col-md-11 col-sm-12">
							<div class="inner-banner-text text-center">
								<p class="lead-i text-light">Amet consectetur adipisicing <span class="badge badge-success">New</span></p>
								<h2 class="text-light"><span class="font-normal">Find Your</span> Perfect Place.</h2>
							</div>
							<div class="full-search-2 eclip-search italian-search hero-search-radius shadow-hard mt-5">
								<div class="hero-search-content">
									
									<div class="row">
									
										<div class="col-lg-4 col-md-4 col-sm-12 b-r">
											<div class="form-group">
												<div class="choose-propert-type">
													<ul>
														<li>
															<input id="cp-1" class="checkbox-custom" name="cpt" type="radio" checked>
															<label for="cp-1" class="checkbox-custom-label">Sale</label>
														</li>
														
													</ul>
												</div>
											</div>
										</div>
											
										<div class="col-lg-6 col-md-6 col-sm-6">
									    <div class="form-group">
										<!-- <label>----------------------Select Your City----------------------</label> -->
										<select id="cities" class="form-control">
											<option value="">&nbsp;</option>
											<?php 
										$serch_stmt ="SELECT * FROM parent_location WHERE ploc_status=1 ORDER BY ploc_id ASC LIMIT 3 ";
										$search_result = $PDO->prepare($serch_stmt);
										$search_result->execute();    
										$searchlist = $search_result->fetchAll(); 
										foreach($searchlist as $each_search){  
										if(!empty($each_search['ploc_img']) AND file_exists('files/location/'.$each_search['ploc_img'])){
										  $img =  $each_search['ploc_img'];       
										}else{
										  $img = "default.jpg";
										}
										?>
											<option value="<?= $each_search['ploc_slug'] ?>"><?= $each_search['ploc_name'] ?></option>
											<?php } ?>	
										</select>
									    </div>
								        </div>										
										<div class="col-lg-2 col-md-3 col-sm-12">
											<div class="form-group">
												<a href="our-property" class="btn search-btn black">Search</a>
											</div>
										</div>
											
									</div>
								
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Hero Banner End ================================== -->
			
			<!-- ============================ Achievement Start ================================== -->
			<section>
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-lg-7 col-md-10 text-center">
							<div class="sec-heading center mb-4">
								<h2>Achievement</h2>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="achievement-wrap">
								<div class="achievement-content">
									<h4>500+</h4>
									<p>Completed Property</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="achievement-wrap">
								<div class="achievement-content">
									<h4>700+</h4>
									<p>Property Sales</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="achievement-wrap">
								<div class="achievement-content">
									<h4>900+</h4>
									<p>Apartment Rent</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-3 col-md-3 col-sm-6">
							<div class="achievement-wrap">
								<div class="achievement-content">
									<h4>1500+</h4>
									<p>Happy Clients</p>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- ============================ Achievement End ================================== -->
			
			<!-- ============================ Latest Property For Sale Start ================================== -->
			<section class="pt-0">
				<div class="container">
				
					<div class="row justify-content-center">
						<div class="col-lg-7 col-md-10 text-center">
							<div class="sec-heading center mb-4">
								<h2>Recent Property For Rent</h2>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="property-slide">
								<?php $stmt ="SELECT * FROM product
                                                WHERE pro_status=1 ORDER BY pro_id DESC LIMIT 6";
                                    $res = $PDO->prepare($stmt);
                                    $res->execute();    
                                    $count = $res->rowCount();
                                    $teslist = $res->fetchAll();
                                    foreach ($teslist  as $pkges)
                                    {extract($pkges);
                                    ?>
								<!-- Single Property -->
								<div class="single-items">
									<div class="property-listing shadow-none property-2 border">
								
										<div class="listing-img-wrapper">
											<div class="list-img-slide">
												<div class="click">
													<?php 
													$gallist = $PDO->prepare("SELECT * FROM product_gallery WHERE pg_pro_id_ref='$pro_id' AND pg_img_status=1 ORDER BY pg_id ASC LIMIT 3");
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
													<div>
														<a href="property/<?php echo $pro_slug; ?>"><img src="<?php echo $mainimg;?>" class="img-fluid mx-auto" alt="" /></a>
													</div>
													<?php  $count++;} ?>
													<?php } ?>
													
												</div>
											</div>
										</div>
										
										<div class="listing-detail-wrapper">
											<div class="listing-short-detail-wrap">
												<div class="listing-short-detail">
												    <span class="prt-types sale">For Sale</span>
													<h4 class="listing-name verified"><a href="property/<?php echo $pro_slug; ?>" class="prt-link-detail"><?php echo $pro_name; ?></a></h4>
												</div>
												<div class="listing-short-detail-flex">
													<h6 class="listing-card-info-price">₹ <?php echo moneyFormatIndia($pro_price); ?></h6>
												</div>
											</div>
										</div>
										
										<div class="price-features-wrapper">
											<div class="list-fx-features">
												<div class="listing-card-info-icon">
													<div class="inc-fleat-icon"><img src="assets/img/bed.svg" width="13" alt="" /></div><?php echo $pro_bed; ?> Beds
												</div>
												<div class="listing-card-info-icon">
													<div class="inc-fleat-icon"><img src="assets/img/bathtub.svg" width="13" alt="" /></div><?php echo $pro_bath; ?> Bath
												</div>
												<div class="listing-card-info-icon">
													<div class="inc-fleat-icon"><img src="assets/img/move.svg" width="13" alt="" /></div><?php echo $pro_area; ?> sqft
												</div>
											</div>
										</div>
										
										<div class="listing-detail-footer">
											<div class="footer-first">
												<div class="foot-location"><img src="assets/img/pin.svg" width="18" alt="" /><?php echo $pro_small_desc; ?></div>
											</div>
											<div class="footer-flex">
												<a href="property/<?php echo $pro_slug; ?>" class="prt-view">View</a>
											</div>
										</div>
										
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					
				</div>
			</section>
			<!-- ============================ Latest Property For Sale End ================================== -->

			<!-- ============================ Smart Testimonials ================================== -->
			<section class="image-cover" style="background:url(assets/img/banner-2.jpg) no-repeat;" data-overlay="5">
				<div class="container">
					<div class="row justify-content-center">
						
						<div class="col-lg-8 col-md-8">
							
							<div class="caption-wrap-content text-center">
								<h2>Search Perfect Place in your City</h2>
								<p class="mb-5">We post regulary most powerful articles for help and support.</p>
								<a href="our-property" class="btn btn-light btn-md rounded">Explore More Property</a>
							</div>
						</div>
						
					</div>
				</div>
			</section>

			
			
			<!-- ============================ All Property ================================== -->
			<section class="bg-light">
				<div class="container">
				
					<div class="row justify-content-center">
						<div class="col-lg-7 col-md-10 text-center">
							<div class="sec-heading center">
								<h2>Featured Property For Sale</h2>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
							</div>
						</div>
					</div>
				
					<div class="row list-layout">
						<?php $stmt ="SELECT *
                                      FROM product
                                      WHERE pro_status=1 ORDER BY pro_id ASC LIMIT 4 ";
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
						<!-- Single Property Start -->
						<div class="col-lg-6 col-md-12">
							<div class="property-listing property-1">
									
								<div class="listing-img-wrapper">
									<a href="property/<?php echo $pro_slug; ?>">
										<img src="files/property-banner/<?php echo $img; ?>" class="img-fluid mx-auto" alt="" />
									</a>
								</div>
								
								<div class="listing-content">
								
									<div class="listing-detail-wrapper-box">
										<div class="listing-detail-wrapper">
											<div class="listing-short-detail">
												<h4 class="listing-name"><a href="property/<?php echo $pro_slug; ?>"><?php echo $pro_name; ?></a></h4>
												<div class="fr-can-rating">
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<!-- <span class="reviews_text">(42 Reviews)</span> -->
												</div>
												<span class="prt-types sale">For Sale</span>
											</div>
											<div class="list-price">
												<h6 class="listing-card-info-price">₹ <?php echo moneyFormatIndia($pro_price); ?></h6>
											</div>
										</div>
									</div>
									
									<div class="price-features-wrapper">
										<div class="list-fx-features">
											<div class="listing-card-info-icon">
												<div class="inc-fleat-icon"><img src="assets/img/bed.svg" width="13" alt="" /></div><?php echo $pro_bed; ?> Beds
											</div>
											<div class="listing-card-info-icon">
												<div class="inc-fleat-icon"><img src="assets/img/bathtub.svg" width="13" alt="" /></div><?php echo $pro_bath; ?> Bath
											</div>
											<div class="listing-card-info-icon">
												<div class="inc-fleat-icon"><img src="assets/img/move.svg" width="13" alt="" /></div><?php echo $pro_area; ?> sqft
											</div>
										</div>
									</div>
								
									<div class="listing-footer-wrapper">
										<div class="listing-locate">
											<span class="listing-location"><i class="ti-location-pin"></i><?php echo $pro_small_desc; ?></span>
										</div>
										<div class="listing-detail-btn">
											<a href="property/<?php echo $pro_slug; ?>" class="more-btn">View</a>
										</div>
									</div>
									
								</div>
								
							</div>
						</div>
						<!-- Single Property End -->							
						<?php } ?>
					</div>
							
					<!-- Pagination -->
					<!-- <div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 text-center">
							<a href="property-list" class="btn btn-theme-light rounded">Browse More Properties</a>
						</div>
					</div> -->
					
				</div>		
			</section>
			<!-- ============================ All Featured Property ================================== -->
			<!-- ============================ Step How To Use Start ================================== -->
			<section>
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-lg-7 col-md-10 text-center">
							<div class="sec-heading center">
								<h2>How It Works?</h2>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-4 col-md-4">
							<div class="middle-icon-features-item">
								<div class="icon-features-wrap"><div class="middle-icon-large-features-box f-light-success"><i class="ti-receipt text-success"></i></div></div>
								<div class="middle-icon-features-content">
									<h4>Evaluate Property</h4>
									<p>There are many variations of passages of Lorem Ipsum available, but the majority have Ipsum available.</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="middle-icon-features-item">
								<div class="icon-features-wrap"><div class="middle-icon-large-features-box f-light-warning"><i class="ti-user text-warning"></i></div></div>
								<div class="middle-icon-features-content">
									<h4>Meet Your Agent</h4>
									<p>There are many variations of passages of Lorem Ipsum available, but the majority have Ipsum available.</p>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4">
							<div class="middle-icon-features-item remove">
								<div class="icon-features-wrap"><div class="middle-icon-large-features-box f-light-blue"><i class="ti-shield text-blue"></i></div></div>
								<div class="middle-icon-features-content">
									<h4>Close The Deal</h4>
									<p>There are many variations of passages of Lorem Ipsum available, but the majority have Ipsum available.</p>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</section>

	    <section class="bg-light">
				<div class="container">
					
					<div class="row justify-content-center">
						<div class="col-lg-7 col-md-10 text-center">
							<div class="sec-heading center">
								<h2>Find By Locations</h2>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
							</div>
						</div>
					</div>
					
					<div class="row">
									<?php 
										$stmt ="SELECT * FROM parent_location WHERE ploc_status=1 ORDER BY ploc_id ASC LIMIT 3 ";
										$res = $PDO->prepare($stmt);
										$res->execute();    
										$catlist = $res->fetchAll(); 
										foreach($catlist as $eachcat){  
									if(!empty($eachcat['ploc_img']) AND file_exists('files/location/'.$eachcat['ploc_img'])){
									  $img =  $eachcat['ploc_img'];       
									}else{
									  $img = "default.jpg";
									}
									?>
					    <div class="col-lg-4 col-md-4">
							<div class="location-property-wrap">
								<div class="location-property-thumb">
									<a href="city/<?php echo $eachcat['ploc_slug']; ?>"><img src="files/location/<?php echo $img; ?>" class="img-fluid" alt="" /></a>
								</div>
								<div class="location-property-content">
									<div class="lp-content-flex">
										<h4 class="lp-content-title"><?php echo $eachcat['ploc_name']; ?></h4>
										<span>Properties</span>
									</div>
									<div class="lp-content-right">
										<a href="city/<?php echo $eachcat['ploc_slug']; ?>" class="lp-property-view"><i class="ti-angle-right"></i></a>
									</div>
								</div>
							</div>
						</div>

						<?php } ?>

					</div>
					
				</div>
			</section>

			<!-- ================= Our Team================= -->
			<section class="gray-bg">
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2>Who We Work With</h2>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
						
							<div class="team-slide item-slide">
								<?php 
                                    $stmt ="SELECT *
                                                FROM about
                                                WHERE abo_status=1 ORDER BY RAND() LIMIT 12 ";
                                    $res = $PDO->prepare($stmt);
                                    $res->execute();    
                                    $teslist = $res->fetchAll();
                                    foreach ($teslist  as $pkges){extract($pkges); 
                                    if(!empty($abo_img) AND file_exists('files/workwith/'.$abo_img)){
                                      $img =  $abo_img;       
                                    }else{
                                      $img = "default.png";
                                    }
                                    ?>
								<!-- Single Teamm -->
								<div class="single-team">
									<div class="team-grid"  data-toggle="tooltip" title="<?php echo $abo_name; ?>">
								
										<div class="teamgrid-user">
											<img src="files/workwith/<?php echo $img; ?>" alt="" class="img-fluid"/>
										</div>
										

									</div>
								</div>
								<?php } ?>
								

								
							</div>
						
						</div>
					</div>
				
				</div>
			</section>
			
			<!-- ============================ Step How To Use Start ================================== -->
			<!--  -->
			<div class="clearfix"></div>
			<!-- ============================ Step How To Use End ================================== -->
			
			<!-- ============================ Smart Testimonials ================================== -->
			<section class="bg-orange">
				<div class="container">
				
					<div class="row justify-content-center">
						<div class="col-lg-7 col-md-10 text-center">
							<div class="sec-heading center">
								<h2>Good Reviews by Customers</h2>
								<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
							</div>
						</div>
					</div>
					
					<div class="row justify-content-center">
						
						<div class="col-lg-12 col-md-12">
							
							<div class="smart-textimonials smart-center" id="smart-textimonials">
								
								<!-- Single Item -->
								<?php 
                                    $stmt ="SELECT *
                                                FROM testimonials
                                                WHERE testi_status=1 ORDER BY RAND() LIMIT 8 ";
                                    $res = $PDO->prepare($stmt);
                                    $res->execute();    
                                    $teslist = $res->fetchAll();
                                    foreach ($teslist  as $pkges){extract($pkges); 
                                    if(!empty($testi_img) AND file_exists('files/testimonials/'.$testi_img)){
                                      $img =  $testi_img;       
                                    }else{
                                      $img = "default.jpg";
                                    }
                                    ?>
								<div class="item">
									<div class="item-box">
										<div class="smart-tes-author">
											<div class="st-author-box">
												<div class="st-author-thumb">
													<div class="quotes bg-blue"><i class="ti-quote-right"></i></div>
													<img src="files/testimonials/<?php echo $img; ?>" class="img-fluid" alt="" />
												</div>
											</div>
										</div>
										
										<div class="smart-tes-content">
											<p><?php echo $testi_text; ?></p>
										</div>
										
										<div class="st-author-info">
											<h4 class="st-author-title"><?php echo $testi_name; ?></h4>
											
										</div>
									</div>
								</div>
								<?php } ?>

								
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ Smart Testimonials End ================================== -->
			

			
			<!-- ========================== Download App Section =============================== -->
			<!-- <section class="bg-light">
				<div class="container">
					<div class="row align-items-center">
						
						<div class="col-lg-7 col-md-12 col-sm-12 content-column">
							<div class="content_block_2">
								<div class="content-box">
									<div class="sec-title light">
										<p class="text-blue">Download apps</p>
										<h2>Download App Free App For Android and iPhone</h2>
									</div>
									<div class="text">
										<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto accusantium.</p>
									</div>
									<div class="btn-box clearfix mt-5">
										<a href="index.html" class="download-btn play-store">
											<i class="fab fa-google-play"></i>
											<span>Download on</span>
											<h3>Google Play</h3>
										</a>
										
										<a href="index.html" class="download-btn app-store">
											<i class="fab fa-apple"></i>
											<span>Download on</span>
											<h3>App Store</h3>
										</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-5 col-md-12 col-sm-12 image-column">
							<div class="image-box">
								<figure class="image"><img src="assets/img/app.png" class="img-fluid" alt=""></figure>
							</div>
						</div>
					</div>
				</div>
			</section> -->
			<!-- ========================== Download App Section =============================== -->
			
			

		<?php include '_footer.php'; ?>
		<script>
			$("#cities").on("change",function(){
				var curval = $(this).val();
				location.href = "city/" + curval
			})
		</script>	
		</body>
		</html>