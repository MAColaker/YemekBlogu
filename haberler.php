<?php 
include 'header.php'; 

?>

<div role="main" class="main">
	<div class="container">
		<div class="row pt-xl">

			<div class="col-md-9">

				<h1 class="mt-xl mb-none">Yemekler</h1>
				<div class="divider divider-primary divider-small mb-xl">
					<hr>
				</div>

				<div class="row">

					<?php

                $sayfada = 4; // sayfada gösterilecek içerik miktarını belirtiyoruz.


                $sorgu=$db->prepare("select * from icerik");
                $sorgu->execute();
                $toplam_icerik=$sorgu->rowCount();

                $toplam_sayfa = ceil($toplam_icerik / $sayfada);

                  // eğer sayfa girilmemişse 1 varsayalım.
                $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

			    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                if($sayfa < 1) $sayfa = 1; 

				// toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

                $limit = ($sayfa - 1) * $sayfada;

                $iceriksor=$db->prepare("select * from icerik order by icerik_zaman DESC limit $limit,$sayfada");
                $iceriksor->execute();

                while($icerikcek=$iceriksor->fetch(PDO::FETCH_ASSOC)) { ?>


                <!-- Başla -->

                <!-- hidden-xs mobilde div gizleme -->

                <div class="col-md-12">

                	<span class="thumb-info thumb-info-side-image thumb-info-no-zoom mt-xl">
                		<span class="thumb-info-side-image-wrapper p-none ">

                			<img  src="<?php echo $icerikcek['icerik_resimyol']; ?>" class="img-responsive" alt="" style="width: 395px; height: 250px; padding:10px;">

                		</span>
                		<span class="thumb-info-caption">
                			<span class="thumb-info-caption-text">
                				<h2 class="mb-md mt-xs"><?php echo $icerikcek['icerik_ad']; ?></h2>
									<!--<span class="post-meta">
										<span>January 10, 2016 | <a href="#">John Doe</a></span>
									</span>-->
									<p style="font-size:16px !important;"><?php echo substr($icerikcek['icerik_detay'],0,250); ?>...</p>
									<a class="mt-md" href="<?=seo($icerikcek["icerik_ad"]).'-'.$icerikcek["icerik_id"]?>">Devamını Oku <i class="fa fa-long-arrow-right"></i></a>
								</span>
							</span>
						</span>

					</div>

					<!-- Bitir -->

					<?php } ?>

					<div align="right" class="col-md-12">
					<ul class="pagination">

						<?php

						$s=0;

						while ($s < $toplam_sayfa) {

							$s++; ?>

							<?php 

							if ($s==$sayfa) {?>

							<li class="active">

								<a href="haberler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

							</li>

							<?php } else {?>


							<li>

								<a href="haberler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

							</li>
							
							<?php   }

						}

						?>

					</ul>
</div>
					

				</div>

			</div>


			<!-- Sidebar -->

			
				<?php include 'rightbar.php'; ?>
		
		</div>

	</div>
</div>

<?php include 'footer.php'; ?>
