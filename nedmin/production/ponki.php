<?php 
ob_start();
session_start();


function seo($s) {
	$tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',' ',',','?','+');
	$eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','-','-','-','-','','-','-');
	$s = str_replace($tr,$eng,$s);
	$s = strtolower($s);
	$s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
	$s = preg_replace('/\s+/', '-', $s);
	$s = preg_replace('|-+|', '-', $s);
	$s = preg_replace('/#/', '', $s);
	$s = str_replace('.', '', $s);
	$s = trim($s, '-');
	return $s;
}

function tcevir($tarih){
	$tr = explode("-",$tarih); 
	$tarih1 = $tr[2]."-".$tr[1]."-".$tr[0]; 
	return $tarih1;
}


function zamantr($girdi) 
{ 
    $cikti = date("d F Y l H:i", $girdi); 
$aylarIng = array( 
    "January", "February", "March", "April", "May", "June",  
    "July", "August", "September", "October", "November", "December" 
    ); 
$gunlerIng = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"); 
$aylar = array( 
    "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran",  
    "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" 
    ); 
$gunler = array("Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi", "Pazar"); 
$cikti = str_replace($aylarIng, $aylar, $cikti); 
$cikti = str_replace($gunlerIng, $gunler, $cikti); 
return $cikti; 
} 


?>