<?php 
ob_start();
session_start();
include 'baglan.php';

if (isset($_POST['loggin'])) {


	$kullanici_ad=$_POST['kullanici_ad'];
	$kullanici_password=md5($_POST['kullanici_password']);
	
	
	if ($kullanici_ad && $kullanici_password) {


		$kullanicisor=$db->prepare("SELECT * from kullanici where kullanici_ad=:ad and kullanici_password=:password");
		$kullanicisor->execute(array(
			'ad' => $kullanici_ad,
			'password' => $kullanici_password
			));

		$say=$kullanicisor->rowCount();

		if ($say>0) {

			$_SESSION['kullanici_ad'] = $kullanici_ad;


			header('Location:../production/index.php');


		} else {

			header('Location:../production/login.php?durum=no');


		}
	}


	

}





if (isset($_POST['genelayarkaydet'])) {
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_siteurl=:siteurl,
		ayar_title=:title,
		ayar_description=:description,
		ayar_keywords=:keywords,
		ayar_author=:author
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'siteurl' => $_POST['ayar_siteurl'],
		'title' => $_POST['ayar_title'],
		'description' => $_POST['ayar_description'],
		'keywords' => $_POST['ayar_keywords'],
		'author' => $_POST['ayar_author']
		));

	if ($update) {

		Header("Location:../production/genel-ayar.php?durum=ok");

	} else {

		Header("Location:../production/genel-ayar.php?durum=no");
	}

}


if (isset($_POST['iletisimayarkaydet'])) {
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_tel=:tel,
		ayar_gsm=:gsm,
		ayar_faks=:faks,
		ayar_mail=:mail,
		ayar_adres=:adres,
		ayar_ilce=:ilce,
		ayar_il=:il,
		ayar_mesai=:mesai
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'tel' => $_POST['ayar_tel'],
		'gsm' => $_POST['ayar_gsm'],
		'faks' => $_POST['ayar_faks'],
		'mail' => $_POST['ayar_mail'],
		'adres' => $_POST['ayar_adres'],
		'ilce' => $_POST['ayar_ilce'],
		'il' => $_POST['ayar_il'],
		'mesai' => $_POST['ayar_mesai']
		));

	if ($update) {

		Header("Location:../production/iletisim-ayar.php?durum=ok");

	} else {

		Header("Location:../production/iletisim-ayar.php?durum=no");
	}

}


if (isset($_POST['sosyalayarkaydet'])) {
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_facebook=:facebook,
		ayar_twitter=:twitter,
		ayar_google=:google,
		ayar_youtube=:youtube
		WHERE ayar_id=0");
	$update=$ayarkaydet->execute(array(
		'facebook' => $_POST['ayar_facebook'],
		'twitter' => $_POST['ayar_twitter'],
		'google' => $_POST['ayar_google'],
		'youtube' => $_POST['ayar_youtube']
		));

	if ($update) {

		Header("Location:../production/sosyal-ayar.php?durum=ok");

	} else {

		Header("Location:../production/sosyal-ayar.php?durum=no");
	}

}

if (isset($_POST['hakkimizdakaydet'])) {
	
	$ayarkaydet=$db->prepare("UPDATE hakkimizda SET
		hakkimizda_baslik=:baslik,
		hakkimizda_icerik=:icerik,
		hakkimizda_video=:video,
		hakkimizda_vizyon=:vizyon,
		hakkimizda_misyon=:misyon
		WHERE hakkimizda_id=0");
	$update=$ayarkaydet->execute(array(
		'baslik' => $_POST['hakkimizda_baslik'],
		'icerik' => $_POST['hakkimizda_icerik'],
		'video' => $_POST['hakkimizda_video'],
		'vizyon' => $_POST['hakkimizda_vizyon'],
		'misyon' => $_POST['hakkimizda_misyon']
		));

	if ($update) {

		Header("Location:../production/hakkimizda.php?durum=ok");

	} else {

		Header("Location:../production/hakkimizda.php?durum=no");
	}

}


if (isset($_POST['sliderkaydet'])) {


	$uploads_dir = '../../dimg/slider';
	@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
	@$name = $_FILES['slider_resimyol']["name"];
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	
	$kaydet=$db->prepare("INSERT INTO slider SET
		slider_ad=:ad,
		slider_link=:link,
		slider_sira=:sira,
		slider_durum=:durum,
		slider_resimyol=:resimyol");
	$insert=$kaydet->execute(array(
		'ad' => $_POST['slider_ad'],
		'link' => $_POST['slider_link'],
		'sira' => $_POST['slider_sira'],
		'durum' => $_POST['slider_durum'],
		'resimyol' => $refimgyol
		));

	if ($insert) {

		Header("Location:../production/slider.php?durum=ok");

	} else {

		Header("Location:../production/slider.php?durum=no");
	}

}


if ($_GET['slidersil']=="ok") {
	
	$sil=$db->prepare("DELETE from slider where slider_id=:slider_id");
	$kontrol=$sil->execute(array(
		'slider_id' => $_GET['slider_id']
		));

	if ($kontrol) {

		$resimsilunlink=$_GET['slider_resimyol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/slider.php?durum=ok");

	} else {

		Header("Location:../production/slider.php?durum=no");
	}

}


if (isset($_POST['sliderduzenle'])) {

	
	if($_FILES['slider_resimyol']["size"] > 0)  { 


		$uploads_dir = '../../dimg/slider';
		@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
		@$name = $_FILES['slider_resimyol']["name"];
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizsayi3=rand(20000,32000);
		$benzersizsayi4=rand(20000,32000);
		$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

		$duzenle=$db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum,
			slider_resimyol=:resimyol	
			WHERE slider_id={$_POST['slider_id']}");
		$update=$duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum'],
			'resimyol' => $refimgyol,
			));
		

		$slider_id=$_POST['slider_id'];

		if ($update) {

			$resimsilunlink=$_POST['slider_resimyol'];
			unlink("../../$resimsilunlink");

			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");

		} else {

			Header("Location:../production/slider-duzenle.php?durum=no");
		}



	} else {

		$duzenle=$db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum		
			WHERE slider_id={$_POST['slider_id']}");
		$update=$duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum']
			));

		$slider_id=$_POST['slider_id'];

		if ($update) {

			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");

		} else {

			Header("Location:../production/slider-duzenle.php?durum=no");
		}
	}

}

#İçerik İşlemleri

if (isset($_POST['icerikkaydet'])) {


	$uploads_dir = '../../dimg/icerik';
	@$tmp_name = $_FILES['icerik_resimyol']["tmp_name"];
	@$name = $_FILES['icerik_resimyol']["name"];
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


	$tarih=$_POST['icerik_tarih'];
	$saat=$_POST['icerik_saat'];
	$zaman = $tarih." ".$saat;

	
	$kaydet=$db->prepare("INSERT INTO icerik SET
		icerik_ad=:ad,
		icerik_detay=:detay,
		icerik_keyword=:keyword,
		icerik_durum=:durum,
		icerik_resimyol=:resimyol,
		icerik_zaman=:zaman,
		fiyat=:fiyat");
	$insert=$kaydet->execute(array(
		'ad' => $_POST['icerik_ad'],
		'detay' => $_POST['icerik_detay'],
		'keyword' => $_POST['icerik_keyword'],
		'durum' => $_POST['icerik_durum'],
		'resimyol' => $refimgyol,
		'zaman' => $zaman,
		"fiyat" => $_POST['fiyat']
		));

	if ($insert) {

		Header("Location:../production/icerik.php?durum=ok");

	} else {

		Header("Location:../production/icerik.php?durum=no");
	}

}


if (isset($_POST['icerikduzenle'])) {

	
	if($_FILES['icerik_resimyol']["size"] > 0)  { 


		$uploads_dir = '../../dimg/icerik';
		@$tmp_name = $_FILES['icerik_resimyol']["tmp_name"];
		@$name = $_FILES['icerik_resimyol']["name"];
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizsayi3=rand(20000,32000);
		$benzersizsayi4=rand(20000,32000);
		$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

		$tarih=$_POST['icerik_tarih'];
		$saat=$_POST['icerik_saat'];
		$zaman = $tarih." ".$saat;

		$kaydet=$db->prepare("UPDATE icerik SET
			icerik_ad=:ad,
			icerik_detay=:detay,
			icerik_keyword=:keyword,
			icerik_durum=:durum,
			icerik_resimyol=:resimyol,
			icerik_zaman=:zaman,
			fiyat=:fiyat
			WHERE icerik_id={$_POST['icerik_id']}");
		$update=$kaydet->execute(array(
			'ad' => $_POST['icerik_ad'],
			'detay' => $_POST['icerik_detay'],
			'keyword' => $_POST['icerik_keyword'],
			'durum' => $_POST['icerik_durum'],
			'resimyol' => $refimgyol,
			'zaman' => $zaman,
			"fiyat" => $_POST['fiyat']
			));


		$icerik_id=$_POST['icerik_id'];

		if ($update) {

			$resimsilunlink=$_POST['icerik_resimyol'];
			unlink("../../$resimsilunlink");

			Header("Location:../production/icerik-duzenle.php?icerik_id=$icerik_id&durum=ok");

		} else {

			Header("Location:../production/icerik-duzenle.php?durum=no");
		}



	} else {

		$tarih=$_POST['icerik_tarih'];
		$saat=$_POST['icerik_saat'];
		$zaman = $tarih." ".$saat;

		$kaydet=$db->prepare("UPDATE icerik SET
			icerik_ad=:ad,
			icerik_detay=:detay,
			icerik_keyword=:keyword,
			icerik_durum=:durum,
			icerik_zaman=:zaman,
			fiyat=:fiyat
			WHERE icerik_id={$_POST['icerik_id']}");
		$update=$kaydet->execute(array(
			'ad' => $_POST['icerik_ad'],
			'detay' => $_POST['icerik_detay'],
			'keyword' => $_POST['icerik_keyword'],
			'durum' => $_POST['icerik_durum'],
			'zaman' => $zaman,
			"fiyat" => $_POST['fiyat']
			));


		$icerik_id=$_POST['icerik_id'];

		if ($update) {

			Header("Location:../production/icerik-duzenle.php?icerik_id=$icerik_id&durum=ok");

		} else {

			Header("Location:../production/icerik-duzenle.php?durum=no");
		}

		

	}

}

if ($_GET['iceriksil']=="ok") {
	
	$sil=$db->prepare("DELETE from icerik where icerik_id=:icerik_id");
	$kontrol=$sil->execute(array(
		'icerik_id' => $_GET['icerik_id']
		));

	if ($kontrol) {

		$resimsilunlink=$_GET['icerik_resimyol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/icerik.php?durum=ok");

	} else {

		Header("Location:../production/icerik.php?durum=no");
	}

}


#İçerik İşlemleri


if (isset($_POST['menukaydet'])) {

	
	$kaydet=$db->prepare("INSERT INTO menu SET
		menu_ust=:ust,
		menu_ad=:ad,
		menu_url=:url,
		menu_detay=:detay,
		menu_sira=:sira,
		menu_durum=:durum");
	$insert=$kaydet->execute(array(
		'ust' => $_POST['menu_ust'],
		'ad' => $_POST['menu_ad'],
		'url' => $_POST['menu_url'],
		'detay' => $_POST['menu_detay'],
		'sira' => $_POST['menu_sira'],
		'durum' => $_POST['menu_durum']
		));

	if ($insert) {

		Header("Location:../production/menu.php?durum=ok");

	} else {

		Header("Location:../production/menu.php?durum=no");
	}

}


if (isset($_POST['menuduzenle'])) {

	$menu_id=$_POST['menu_id'];

	
	$kaydet=$db->prepare("UPDATE menu SET
		menu_ust=:ust,
		menu_ad=:ad,
		menu_url=:url,
		menu_detay=:detay,
		menu_sira=:sira,
		menu_durum=:durum
		WHERE menu_id={$_POST['menu_id']}");
	$update=$kaydet->execute(array(
		'ust' => $_POST['menu_ust'],
		'ad' => $_POST['menu_ad'],
		'url' => $_POST['menu_url'],
		'detay' => $_POST['menu_detay'],
		'sira' => $_POST['menu_sira'],
		'durum' => $_POST['menu_durum']
		));

	if ($update) {

		Header("Location:../production/menu-duzenle.php?durum=ok&menu_id=$menu_id");

	} else {

		Header("Location:../production/menu-duzenle.php?durum=no&menu_id=$menu_id");
	}

}

if ($_GET['menusil']=="ok") {
	
	$sil=$db->prepare("DELETE from menu where menu_id=:menu_id");
	$kontrol=$sil->execute(array(
		'menu_id' => $_GET['menu_id']
		));

	if ($kontrol) {

		Header("Location:../production/menu.php?durum=ok");

	} else {

		Header("Location:../production/menu.php?durum=no");
	}

}




if (isset($_POST['logoduzenle'])) {



	$uploads_dir = '../../dimg';
	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];
	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'logo' => $refimgyol
		));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/genel-ayar.php?durum=ok");

	} else {

		Header("Location:../production/genel-ayar.php?durum=no");
	}

}



if (isset($_POST['kresimduzenle'])) {

	$uploads_dir = '../../dimg/kullanici';
	@$tmp_name = $_FILES['kullanici_resim']["tmp_name"];
	@$name = $_FILES['kullanici_resim']["name"];
	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

	$duzenle=$db->prepare("UPDATE kullanici SET
		kullanici_resim=:resim
		WHERE kullanici_id={$_POST['kullanici_id']}");
	$update=$duzenle->execute(array(
		'resim' => $refimgyol
		));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/kullanici-profil.php?durum=ok");

	} else {

		Header("Location:../production/kullanici-profil.php?durum=no");
	}

}


if (isset($_POST['kullaniciprofilkaydet'])) {

	if (strlen($_POST['kullanici_password'])>0) {

		$kullanici_password=md5($_POST['kullanici_password']);

		$ayarkaydet=$db->prepare("UPDATE kullanici SET

			kullanici_adsoyad=:adsoyad,
			kullanici_unvan=:unvan,
			kullanici_password=:password
			WHERE kullanici_id={$_POST['kullanici_id']}");
		$update=$ayarkaydet->execute(array(

			'adsoyad' => $_POST['kullanici_adsoyad'],
			'unvan' => $_POST['kullanici_unvan'],
			'password' => $kullanici_password
			));
		


	} else {


		$ayarkaydet=$db->prepare("UPDATE kullanici SET
			kullanici_adsoyad=:adsoyad,
			kullanici_unvan=:unvan
			WHERE kullanici_id={$_POST['kullanici_id']}");
		$update=$ayarkaydet->execute(array(
			'adsoyad' => $_POST['kullanici_adsoyad'],
			'unvan' => $_POST['kullanici_unvan']
			));



	}


	

	if ($update) {

		Header("Location:../production/kullanici-profil.php?durum=ok");

	} else {

		Header("Location:../production/kullanici-profil.php?durum=no");
	}

}


if(isset($_POST['galerisil'])) {


	$checklist = $_POST['galerisec'];

	foreach($checklist as $list) {

		$sil=$db->prepare("DELETE from galeri where galeri_id=:galeri_id");
		$kontrol=$sil->execute(array(
			'galeri_id' => $list
			));
	}

	if ($kontrol) {

		Header("Location:../production/galeri.php?durum=ok");

	} else {

		Header("Location:../production/galeri.php?durum=no");
	}


}

?>



