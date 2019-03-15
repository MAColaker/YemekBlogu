<?php 
include 'header.php'; 

?>

<div role="main" class="main">
	<div class="container">
		<div class="row pt-xl">

			<div class="col-md-9">

				<h1 class="mt-xl mb-none">Resim Galeri</h1>
				<div class="divider divider-primary divider-small mb-xl">
					<hr>
				</div>

				<div class="row">

					<ul class="portfolio-list lightbox m-none" data-plugin-options='{"delegate": "a.lightbox-portfolio", "type": "image", "gallery": {"enabled": true}}'>

						<?php

                $sayfada = 20; // sayfada gösterilecek içerik miktarını belirtiyoruz.


                $sorgu=$db->prepare("select * from galeri");
                $sorgu->execute();
                $toplam_galeri=$sorgu->rowCount();

                $toplam_sayfa = ceil($toplam_galeri / $sayfada);

                  // eğer sayfa girilmemişse 1 varsayalım.
                $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

			    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
                if($sayfa < 1) $sayfa = 1; 

				// toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
                if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 

                $limit = ($sayfa - 1) * $sayfada;

                $galerisor=$db->prepare("select * from galeri order by galeri_id DESC limit $limit,$sayfada");
                $galerisor->execute();

                while($galericek=$galerisor->fetch(PDO::FETCH_ASSOC)) { ?>


                <!-- Başla -->

                <!-- hidden-xs mobilde div gizleme -->

                <li style="padding:7px;" class="col-md-3 col-sm-6 col-xs-12">
                	<div class="portfolio-item">
                		<span class="thumb-info thumb-info-lighten thumb-info-centered-icons">
                			<span class="thumb-info-wrapper">
                			<img src="<?php echo $galericek['galeri_resimyol']; ?>" class="img-responsive" alt="<?php echo $galericek['galeri_ad']; ?>">
                				<span class="thumb-info-action">
                					<a href="<?php echo $galericek['galeri_resimyol']; ?>" class="lightbox-portfolio">
                						<span class="thumb-info-action-icon thumb-info-action-icon-light"><i class="fa fa-search-plus"></i></span>
                					</a>
                				</span>
                			</span>
                		</span>
                	</div>
                </li> 

                <!-- Bitir -->

                <?php } ?>

            </ul>

            <div align="right" class="col-md-12">
            	<ul class="pagination">

            		<?php

            		$s=0;

            		while ($s < $toplam_sayfa) {

            			$s++; ?>

            			<?php 

            			if ($s==$sayfa) {?>

            			<li class="active">

            				<a href="resim-galeri?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

            			</li>

            			<?php } else {?>


            			<li>

            				<a href="resim-galeri?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a>

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
