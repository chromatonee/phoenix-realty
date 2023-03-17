<?php 
include '_top.php'; 
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
        <title>Phoenix Reality - About Us</title>
		
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
							
							<h2 class="ipt-title">About Us</h2>
							<span class="ipn-subtitle">Who we are & our mission</span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ Our Story Start ================================== -->
			<section>
			
				<div class="container">
				
					<!-- row Start -->
					<div class="row align-items-center">

						<div class="col-lg-6 col-md-6">
							<img src="assets/img/sb.png" class="img-fluid" alt="" />
						</div>

						<div class="col-lg-6 col-md-6">
							<div class="story-wrap explore-content">
								
								<h2>Our Story</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
								
							</div>
						</div>
						
					</div>
					<!-- /row -->					
					
				</div>
						
			</section>
			<!-- ============================ Our Story End ================================== -->
			
			<!-- ================= Our Team================= -->
			<section class="gray-bg">
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2>Meet Our Team</h2>
								<p>Professional & Dedicated Team</p>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
						
							<div class="team-slide item-slide">
								
								<?php 
									$stmt ="SELECT *
									            FROM projects
									            WHERE proj_status=1 ORDER BY proj_id ASC ";
									$res = $PDO->prepare($stmt);
									$res->execute();    
									$teslist = $res->fetchAll();
									foreach ($teslist  as $pkges){extract($pkges); 
									if(!empty($proj_img) AND file_exists('files/team/'.$proj_img)){
									  $img =  $proj_img;       
									}else{
									  $img = "default.jpg";
									}
									?>
								<div class="single-team">
									<div class="team-grid">
								
										<div class="teamgrid-user">
											<img src="files/team/<?php echo $img; ?>" alt="" class="img-fluid" />
										</div>
										
										<div class="teamgrid-content">
											<h4><?php echo $proj_name; ?></h4>
											<span><?php echo $proj_text; ?></span>
										</div>
										
										
							
									</div>
								</div>
								
								<?php } ?>
								
							</div>
						
						</div>
					</div>
				
				</div>
			</section>
			<!-- =============================== Our Team ================================== -->
			
			<!-- ================= Our Mission ================= -->
			<section>
				<div class="container">
				
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="sec-heading center">
								<h2>Our Mission & Work Process</h2>
								<p>Professional & Dedicated Team</p>
							</div>
						</div>
					</div>
					
					<div class="row align-items-center">
						
						<div class="col-lg-6 col-md-6">
							
							<div class="icon-mi-left">
								<i class="ti-lock theme-cl"></i>
								<div class="icon-mi-left-content">
									<h4>Fully Secure & 24x7 Dedicated Support</h4>
									<p>If you are an individual client, or just a business startup looking for good backlinks for your website.</p>
								</div>
							</div>
							
							<div class="icon-mi-left">
								<i class="ti-twitter theme-cl"></i>
								<div class="icon-mi-left-content">
									<h4>Manage your Social & Busness Account Carefully</h4>
									<p>If you are an individual client, or just a business startup looking for good backlinks for your website.</p>
								</div>
							</div>
							
							<div class="icon-mi-left">
								<i class="ti-layers theme-cl"></i>
								<div class="icon-mi-left-content">
									<h4>We are Very Hard Worker and loving</h4>
									<p>If you are an individual client, or just a business startup looking for good backlinks for your website.</p>
								</div>
							</div>
							
						</div>
						
						<div class="col-lg-6 col-md-6">
							<img src="assets/img/vec-2.png" class="img-fluid" alt="" />
						</div>
						
					</div>
				</div>
			</section>
			<!-- ================= Our Mission ================= -->
			
			
			<?php include '_footer.php'; ?>
	</body>
</html>