<?php 
ob_start();
session_start();
include 'baglan.php';

if (isset($_POST['videocek'])) {

	$videocode=$_POST['video_code'];



	$veri = file_get_contents("https://www.youtube.com/watch?v=$videocode"); 
	preg_match_all('@dir="ltr"(.*?)title="(.*?)">@',$veri,$abone);


	$video_ad=$abone[2][1];


	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4.".jpg";
	$refimgyol="dimg/video/".$benzersizad.$yeni;

	$veri2 = file_get_contents("http://img.youtube.com/vi/$videocode/mqdefault.jpg"); 
	$kayit= fopen('../../dimg/video/'.$benzersizad,'w+'); 
	fwrite($kayit,$veri2); 
	fclose($kayit);


	$kaydet=$db->prepare("INSERT INTO video SET
		video_code=:code,
		video_ad=:ad,
		video_resimyol=:video");
	$insert=$kaydet->execute(array(
		'code' => $videocode,
		'ad' => $video_ad,
		'video' => $refimgyol
		));

	$video_id = $db->lastInsertId();

	Header("Location:../production/video-yukle.php?youtube=ok&video_id=$video_id");

}


?>