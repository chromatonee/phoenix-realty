<?php debug_backtrace() || header("Location: 404");?>
<div class="header header-transparent change-logo">
				<div class="container">
					<nav id="navigation" class="navigation navigation-landscape">
						<div class="nav-header">
							<a class="nav-brand static-logo" href="./"><img src="assets/img/logo-light.png" class="logo" alt="" /></a>
							<a class="nav-brand fixed-logo" href="./"><img src="assets/img/logo-light.png" class="logo" alt="" /></a>
							<div class="nav-toggle"></div>
						</div>
						<div class="nav-menus-wrapper" style="transition-property: none;">
							<ul class="nav-menu">
							
								<li class="active"><a href="./">Home<span class="submenu-indicator"></span></a>
									
								</li>
								<?php 
							            $stmt ="SELECT * FROM product WHERE pro_status=1";
										$res = $PDO->prepare($stmt);
										$res->execute();    
										$catlist = $res->fetchAll(); 
										foreach($catlist as $eachcat){ ?>
								<li><a class="nav-brand" href="property/<?php echo $eachcat['pro_slug']; ?>"><img src="files/property-logo/<?php echo $eachcat['pro_img']; ?>" class="property-menu" alt="<?php echo $eachcat['pro_name']; ?>" /></a></li>
								<?php }?>
								

								
								<li><a href="JavaScript:Void(0)">+<span class="more-property"></span></a>
									<ul class="nav-dropdown nav-submenu">
										<li><a href="our-property">+ More Properties</a></li>                                    

									</ul>
								</li>

								<li><a href="about-us">About Us<span class="submenu-indicator"></span></a>
									
								</li>
								
								<li><a href="contact">Contact Us<span class="submenu-indicator"></span></a>
									
								</li>

								
								
								<!-- <li><a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#signup">Sign Up</a></li> -->
								
							</ul>
							
							<ul class="nav-menu nav-menu-social align-to-right">
								
								<!-- <li>
									<a href="submit-property.html" class="text-success"><img src="assets/img/submit.svg" width="20" alt="" class="mr-2" />Add Property</a>
								</li> -->
								<!-- <li class="add-listing light">
									<a href="JavaScript:Void(0);" data-bs-toggle="modal" data-bs-target="#signup"><img src="assets/img/user-dark.svg" width="12" alt="" class="mr-2" />Sign Up</a>
								</li> -->
							</ul>
						</div>
					</nav>
				</div>
			</div>