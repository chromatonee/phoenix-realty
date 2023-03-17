<?php 
include '_top.php'; 
$link=$_SERVER['REQUEST_URI']; 
$link_array=explode('/',$link);
$proslug=FilterInput(strval(end($link_array)));
if(empty($proslug) OR $proslug=="city"){include '404.php';die();} 


$stmt = $PDO->prepare("SELECT * FROM parent_location WHERE ploc_slug='$proslug' AND ploc_status=1");
$stmt->execute(); 
$datap = $stmt->fetch(PDO::FETCH_OBJ);
if(empty($datap)){include '404.php';die();}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
        <title><?php echo $datap->ploc_name?> - Property List</title>
		
        <?php include '_header.php'; ?>
		<style type="text/css">
			.page-title{
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
        .nav-menu.nav-menu-social>li.add-listing{
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
			
			<!-- ============================ Page Title Start================================== -->
			<div class="page-title">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							
							<h2 class="ipt-title"><?php echo $datap->ploc_name?> Property List</h2>
							<span class="ipn-subtitle">Have a look on our property's</span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ All Property ================================== -->
			<section class="bg-light">
				<div class="container">
					<?php $stmt ="  SELECT *
	                                FROM product
	                                WHERE pro_status=1 AND pro_ploc_id_ref = '$datap->ploc_id' ORDER BY pro_id ASC ";
                                    $res = $PDO->prepare($stmt);
                                    $res->execute();    
                                    $count = $res->rowCount();?>
					<div class="row justify-content-center">
						<div class="col-lg-12 col-md-12">
							<div class="item-shorting-box">
								<div class="item-shorting clearfix">
									<div class="left-column pull-left"><h4 class="m-0"><?= $count ?> Results Found</h4></div>
								</div>
								<!-- <div class="item-shorting-box-right">
									<div class="shorting-by">
										<select id="shorty" class="form-control">
											<option value="">&nbsp;</option>
											<option value="1">Low Price</option>
											<option value="2">High Price</option>
											<option value="3">Most Popular</option>
										</select>
									</div>
									<ul class="shorting-list">
										<li><a href="grid.html"><i class="ti-layout-grid2"></i></a></li>
										<li><a href="list-layout-full.html" class="active"><i class="ti-view-list"></i></a></li>
									</ul>
								</div> -->
							</div>
						</div>
					</div>
							
					<div class="row">
						
						<div class="col-lg-12 col-sm-12 list-layout">
							<div class="row">
								<?php
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
															<i class="fas fa-star filled"></i>													</div>
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
													<a href="property/<?php echo $pro_slug; ?>" target="/" class="more-btn">View</a>
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
								<div class="col-lg-12 col-md-12 col-sm-12">
									<ul class="pagination p-center">
										<li class="page-item">
										  <a class="page-link" href="#" aria-label="Previous">
											<span class="ti-arrow-left"></span>
											<span class="sr-only">Previous</span>
										  </a>
										</li>
										<li class="page-item"><a class="page-link" href="#">1</a></li>
										<li class="page-item"><a class="page-link" href="#">2</a></li>
										<li class="page-item active"><a class="page-link" href="#">3</a></li>
										<li class="page-item"><a class="page-link" href="#">...</a></li>
										<li class="page-item"><a class="page-link" href="#">18</a></li>
										<li class="page-item">
										  <a class="page-link" href="#" aria-label="Next">
											<span class="ti-arrow-right"></span>
											<span class="sr-only">Next</span>
										  </a>
										</li>
									</ul>
								</div>
							</div> -->
					
						</div>
						
					</div>
				</div>		
			</section>
			<!-- ============================ All Property ================================== -->
			
			<?php include '_footer.php'; ?>
	</body>

<!-- Mirrored from themezhub.net/resido-live/resido/list-layout-full.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jan 2023 19:58:15 GMT -->
</html>