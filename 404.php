<?php include 'header.php'; ?>

<head>
	<title>Hata Sayfası » Belediyem.Net</title>           
</head>

<div role="main" class="main">

	<section class="page-header">
		<div class="container">
			
			<div class="row">
				<div class="col-md-12">
					<h1>Hata-Sayfa Bulunamadı...</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container">

		<section class="page-not-found">
			<div class="row">
				<div class="col-md-6 col-md-offset-1">
					<div class="page-not-found-main">
						<h2>404 <i class="fa fa-file"></i></h2>
						<p>Aradığınız sayfayı malesef bulamadık!</p>
					</div>
				</div>
				<div class="col-md-4">
					<h4 class="heading-primary">Ne aramıştınız?</h4>
					<ul class="nav nav-list">

						<?php 

						$menusor=$db->prepare("select * from menu where menu_ust=:menu_ust order by menu_sira");
						$menusor->execute(array(
							'menu_ust' => 0
							));
							while($menucek=$menusor->fetch(PDO::FETCH_ASSOC)) {?>


							<li><a href="<?php

								if (strlen($menucek['menu_url'])>0) {

									echo $menucek['menu_url'];

								} elseif (strlen($menucek['menu_url'])==0) {?>

								sayfa-<?=seo($menucek["menu_ad"]).'-'.$menucek["menu_id"]?>

								<?php }

								?>"><?php echo $menucek['menu_ad']; ?></a></li>

								<?php } ?>

							</ul>
						</div>
					</div>
				</section>

			</div>

		</div>

		<?php include 'footer.php'; ?>

