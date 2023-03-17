<?php 
include '_top.php'; 
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
        <title>Phoenix Reality - 404</title>

        <!-- Custom CSS -->
        <?php include '_header.php'; ?>
		<style type="text/css">
			.page-title{
				padding-bottom: 42px;
				height: 248px;
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
           
			<div class="clearfix"></div>
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->
			
			<!-- ============================ User Dashboard ================================== -->
			<section class="error-wrap">
				<div class="container">
					<div class="row justify-content-center">
						
						<div class="col-lg-6 col-md-10">
							<div class="text-center">
								
								<img src="assets/img/404.png" class="img-fluid" alt="">
								<!-- <p>Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper</p> -->
								<a class="btn btn-theme" href="./">Back To Home</a>
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- ============================ User Dashboard End ================================== -->
			
			<?php include '_footer.php'; ?>

	</body>
</html>