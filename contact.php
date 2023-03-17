<?php 
include '_top.php'; 
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
        <title>Phoenix Reality - Contact Us</title>
		
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
        .cn-info-detail{
        	justify-content: flex-start;
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
							
							<h2 class="ipt-title">Contact Us</h2>
							<span class="ipn-subtitle">Have a chat with us</span>
							
						</div>
					</div>
				</div>
			</div>
			<!-- ============================ Page Title End ================================== -->
			
			<!-- ============================ Agency List Start ================================== -->
			<section>
			
				<div class="container">
				
					<!-- row Start -->
					<div class="row">
					
						<div class="col-lg-7 col-md-7">
							<form method="post" id="contactForm">
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Name</label>
										<input type="text" id="name" name="name" class="form-control simple">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" id="emailid" name="emailid" class="form-control simple">
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Phone No.</label>
										<input type="text" id="phone" name="phone" class="form-control simple">
									</div>
								</div>
								<div class="col-lg-6 col-md-6">
									<div class="form-group">
										<label>Subject</label>
										<input type="text" id="subject" name="subject" class="form-control simple">
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label>Message</label>
								<textarea id="message" name="message" class="form-control simple"></textarea>
							</div>
							
							<div class="form-group">
								<input type="submit" value="Submit Request" id="submit-contact" class="btn btn-theme-light-2 rounded" type="submit">
							</div>
								<div class="rh col-xs-12 outmsg" style="margin-top: 20px;"></div>			
							</form>
						</div>
						
						<div class="col-lg-5 col-md-5">
							<div class="contact-info">
								
								<h2>Get In Touch</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								
								<div class="cn-info-detail">
									<div class="cn-info-icon">
										<i class="ti-home"></i>
									</div>
									<div class="cn-info-content">
										<h4 class="cn-info-title">Reach Us</h4>
										Golapbug Bus Station, Golapbag More,<br> Grand Trunk Rd, Burdwan,<br> West Bengal - 713104
									</div>
								</div>
								
								<div class="cn-info-detail">
									<div class="cn-info-icon">
										<i class="ti-email"></i>
									</div>
									<div class="cn-info-content">
										<h4 class="cn-info-title">Drop A Mail</h4>
										phoenixrealty22@gmail.com<br>enquiry@phoenix-realty.com
									</div>
								</div>
								
								<div class="cn-info-detail">
									<div class="cn-info-icon">
										<i class="ti-mobile"></i>
									</div>
									<div class="cn-info-content">
										<h4 class="cn-info-title">Call Us</h4>
										(41) 123 521 458<br>+91 235 548 7548
									</div>
								</div>
								
							</div>
						</div>
						
					</div>
					<!-- /row -->		
					
				</div>
						
			</section>
			<!-- ============================ Agency List End ================================== -->
			
			<?php include '_footer.php'; ?>
			<script>
    $(document).ready(function(){
    $("#contactForm").on('submit',(function(e){
    e.preventDefault();
    var url="_check_contact";
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
        if(res.status){$("#contactForm").trigger('reset');}
      }
    })
  }));
});
</script>

	</body>


</html>