<?php 
include 'nedmin/netting/baglan.php';
include 'nedmin/production/ponki.php';

$ayarsor=$db->prepare("select * from ayar where ayar_id=?");
$ayarsor->execute(array(0));
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>

	<!-- Basic -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	



	<meta name="keywords" content="<?php echo $ayarcek['ayar_keywords']; ?>" />
	<meta name="description" content="<?php echo $ayarcek['ayar_description']; ?>">
	<meta name="author" content="<?php echo $ayarcek['ayar_author']; ?>">

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
	<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/theme.css">
	<link rel="stylesheet" href="css/theme-elements.css">
	<link rel="stylesheet" href="css/theme-blog.css">
	<link rel="stylesheet" href="css/theme-shop.css">
	<link rel="stylesheet" href="css/theme-animate.css">

	<!-- Current Page CSS -->
	<link rel="stylesheet" href="vendor/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="vendor/rs-plugin/css/layers.css">
	<link rel="stylesheet" href="vendor/rs-plugin/css/navigation.css">

	<!-- Skin CSS -->
	<link rel="stylesheet" href="css/skins/skin-restaurant.css"> 

	<!-- Demo CSS -->
	<link rel="stylesheet" href="css/demos/demo-restaurant.css">

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="css/custom.css">

	<!-- Head Libs -->
	<script src="vendor/modernizr/modernizr.min.js"></script>

</head>
<body data-spy="scroll" data-target="#navSecondary" data-offset="170">

	<div class="body">
		<header id="header" class="header-narrow" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": false}'>
			<div class="header-body">
				<div class="header-top header-top-secondary header-top-style-3">
					<div class="container">
						<nav class="header-nav-top pull-right">
							<ul class="nav nav-pills">
								<li class="hidden-xs">
									<span class="ws-nowrap"><i class="fa fa-map-marker"></i> <?php echo $ayarcek['ayar_adres']; ?> - <?php echo $ayarcek['ayar_ilce']; ?> / <?php echo $ayarcek['ayar_il']; ?></span>
								</li>
								<li>
									<span class="ws-nowrap"><i class="fa fa-phone"></i> <?php echo $ayarcek['ayar_tel']; ?></span>
								</li>
								<li class="hidden-xs">
									<span class="ws-nowrap"><i class="fa fa-envelope"></i> <a href="mailto:mail@example.com"><?php echo $ayarcek['ayar_mail']; ?></a></span>
								</li>
							</ul>
						</nav>
						<p class="hidden-xs text-color-tertiary">
							<?php echo $ayarcek['ayar_title']; ?>
						</p>
					</div>
				</div>
				<div class="header-container container">
					<div class="header-row">
						<div class="header-column">
							<div class="header-logo">
							<a href="index.php">
									<img alt="Porto" width="230" height="80"  src="<?php echo $ayarcek['ayar_logo']; ?>">
								</a>
							</div>
						</div>
						<div class="header-column">
							<div class="header-row">
								<div class="header-nav">
									<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
										<i class="fa fa-bars"></i>
									</button>
									<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
										<nav>
											<ul class="nav nav-pills" id="mainNav">

												<?php 

												$menusor=$db->prepare("select * from menu where menu_ust=:menu_ust order by menu_sira");
												$menusor->execute(array(
													'menu_ust' => 0
													));
												while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) {
													$menu_id=$menucek['menu_id'];
													$altmenusor=$db->prepare("select * from menu where menu_ust=:menu_id order by menu_sira");
													$altmenusor->execute(array(
														'menu_id' => $menu_id
														));
													$say=$altmenusor->rowCount();

													?>

													<li <?php 
													if ($say>0) {

														echo "class='dropdown'";
													}
													?>>
													<a href="<?php

													if (strlen($menucek['menu_url'])>0) {

														echo $menucek['menu_url'];

													} elseif (strlen($menucek['menu_url'])==0) {?>

													sayfa-<?=seo($menucek["menu_ad"]).'-'.$menucek["menu_id"]?>

													<?php }

													?>"><?php echo $menucek['menu_ad']; ?></a>

													<ul class="dropdown-menu">

														<?php 

														while($altmenucek=$altmenusor->fetch(PDO::FETCH_ASSOC)) {
															?>

															<li>
																<a href="<?php

																if (strlen($altmenucek['menu_url'])>0) {

																	echo $altmenucek['menu_url'];

																} elseif (strlen($altmenucek['menu_url'])==0) {?>

																sayfa-<?=seo($altmenucek["menu_ad"]).'-'.$altmenucek["menu_id"]?>

																<?php }

																?>"><?php echo $altmenucek['menu_ad']; ?></a>

															</li>

															<?php  } ?>

														</ul>
													</li>



													<?php } ?>

												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>