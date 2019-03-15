<?php 
include 'header.php'; 
$hakkimizdasor=$db->prepare("select * from hakkimizda where hakkimizda_id=?");
$hakkimizdasor->execute(array(0));
$hakkimizdacek=$hakkimizdasor->fetch(PDO::FETCH_ASSOC);
?>

<head>
		<title><?php echo $ayarcek['ayar_title']; ?></title>	

</head>
<div role="main" class="main">


	<div class="slider-container rev_slider_wrapper" style="height: 650px;">
		<div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 1170, "gridheight": 650, "disableProgressBar": "on"}'>
			<ul>



				<?php 

				$slidersor=$db->prepare("select * from slider where slider_durum=? order by slider_id DESC limit 25");
				$slidersor->execute(array(1));

				while($slidercek=$slidersor->fetch(PDO::FETCH_ASSOC)) {
					?>

					<li data-transition="fade">
						<img src="<?php echo $slidercek['slider_resimyol']; ?>"  
						alt="<?php echo $slidercek['slider_ad']; ?>"
						data-bgposition="center center" 
						data-bgfit="cover" 
						data-bgrepeat="no-repeat"
						class="rev-slidebg">

					</li>

					<?php } ?>

				</ul>
			</div>
		</div>


		<!-- Vizyon vs -->


	<div class="container-fluid">
					<div class="row mt-xlg">

						<div class="col-md-6 p-none">
							<section class="section section-quaternary section-no-border match-height mt-none" style="min-height: 625px;">
								<div class="row">
									<div class="col-half-section col-half-section-right">
										<div class="center">
											<h4 class="mt-none mb-none heading-dark">Vizyon & <strong>Misyon</strong></h4>
											<p class="mb-xs">Vizyonumuz ve Misyonumuz hakkında bilgiler</p>

											<hr class="custom-divider m-none">
										</div>
										
										<div class="owl-carousel owl-theme show-nav-title mt-xlg mb-none" data-plugin-options='{"items": 1, "margin": 10, "loop": true, "nav": true, "dots": false, "autoplay": true, "autoplayTimeout": 4000}'>
											<div>
												<span class="thumb-info thumb-info-side-image thumb-info-no-zoom thumb-info-no-borders thumb-info-blog-custom mb-xl">
													
													<span class="thumb-info-caption">
														<span class="thumb-info-caption-text">
															<h4 class="mb-none mt-xs heading-dark">Vizyonumuz</h4>
															<p class="font-size-md"><?php echo $hakkimizdacek['hakkimizda_vizyon']; ?></p>
															
														</span>
													</span>
												</span>

											</div>																					
										</div>

										<div class="owl-carousel owl-theme show-nav-title mt-xlg mb-none" data-plugin-options='{"items": 1, "margin": 10, "loop": true, "nav": true, "dots": false, "autoplay": true, "autoplayTimeout": 4000}'>
											<div>
												<span class="thumb-info thumb-info-side-image thumb-info-no-zoom thumb-info-no-borders thumb-info-blog-custom mb-xl">
													
													<span class="thumb-info-caption">
														<span class="thumb-info-caption-text">
															<h4 class="mb-none mt-xs heading-dark">Misyonumuz</h4>
															<p class="font-size-md"><?php echo $hakkimizdacek['hakkimizda_misyon']; ?></p>
															
														</span>
													</span>
												</span>

											</div>																					
										</div>

									</div>
								</div>
							</section>
						</div>

						<div class="col-md-6 p-none">
							<section class="section section-tertiary section-no-border match-height mt-none">
								<div class="row">
									<div class="col-half-section">
										<div class="center">
											<h4 class="mt-none mb-none heading-dark">Tanıtım <strong>Videomuz</strong></h4>
											<p class="mb-xs">İşletmemizin tanıtım videosunu izlemek istermisiniz?</p>

											<hr class="custom-divider m-none">
										</div>

										<div class="col-md-12">
											
											<div align="center" class="embed-responsive embed-responsive-16by9 mb-xl">
								<iframe width="230" height="150" src="https://www.youtube.com/embed/<?php echo $hakkimizdacek['hakkimizda_video']; ?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							</div>
										</div>
									</div>
								</div>
							</section>
						</div>

					</div>
				</div>




	<!-- Vizyon vs -->



		<section class="p-xlg">
			<div class="container">
				<div class="row">
					<div class="col-md-12 center">
						<h2 class="mt-lg mb-sm">Yiyecek <strong>& İçecekler</strong></h2>
						<p class="font-size-md">Bu alanı dilerseniz haberler blog dilersenizde menülerinizi yayınlamak için kullanabilirsiniz.</p>

						<hr class="custom-divider">
					</div>
				</div>
				<div class="row mt-lg">

						<?php 
						$iceriksor=$db->prepare("select * from icerik order by icerik_zaman DESC limit 6");
						$iceriksor->execute();

						while($icerikcek=$iceriksor->fetch(PDO::FETCH_ASSOC)) { ?>



					<div class="col-sm-4 pb-xlg">

						<div class="appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="0">
							<span class="thumb-info thumb-info-no-zoom thumb-info-custom mb-xl center">
								<span class="thumb-info-side-image-wrapper p-none">
									<img src="<?php echo $icerikcek['icerik_resimyol']; ?>" class="img-responsive" alt="">
									<img class="thumb-info-custom-icon" style="width: 30%; margin: -50px" src="dimg/restaurant-icon-1.png" alt="" />
                                    <h3 style="color: black;margin: -50px auto 60px;position: relative;"><?php echo $icerikcek['fiyat'] ?>₺</h3>
								</span>
								<span class="thumb-info-caption">
									<span class="thumb-info-caption-text">
										<h2 class="mb-md mt-xs"><?php echo $icerikcek['icerik_ad']; ?></h2>
										<p class="font-size-md"><?php echo substr($icerikcek['icerik_detay'],0,250); ?>...</p>
										<a class="btn btn-primary mt-md" href="<?=seo($icerikcek["icerik_ad"]).'-'.$icerikcek["icerik_id"]?>">İncele <i class="fa fa-long-arrow-right"></i></a>
									</span>
								</span>
							</span>
						</div>

						</div>

						<?php } ?>

					


				</div>
			</div>
		</section>


	</div>

	<?php include 'footer.php'; ?>