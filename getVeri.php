<?php
include("config.php");
$veri = $_GET['veri'];
$key = $_GET['esaglikkey'];
if($key=="0uzeltek0"){
	$tarih = date("d-m-y");
	$saat =  date("H:i");
	
	list($hastaid,$cihazid,$veri1,$veri2,$veri3,$veri4,$veri5) = explode("-",$veri);
	if($cihazid==1){
	$db->query("
	INSERT INTO tbltansiyon (
 	tansiyon_id,
 	tansiyon_hastaid,
 	tansiyon_bt,
 	tansiyon_kt,
 	tansiyon_nbz,
 	tansiyon_tarih,
 	tansiyon_saat 
	)
	VALUES (
 	NULL ,'".$hastaid."','".$veri1."','".$veri2."','".$veri3."','".$tarih."','".$saat."'
	)");
	echo "tansiyon alindi";
	}
	else if($cihazid==2){
	$db->query(
	"INSERT INTO tblseker(
	seker_id,
	seker_hastaid,
	seker_deger,
	seker_tarih,
	seker_saat) 
	VALUES (
	NULL, '".$hastaid."', '".$veri1."', '".$tarih."', '".$saat."')");
	echo "şeker alindi";
	}
	else{
		echo "hatalı cihaz kodu";
	}
}
else{
	echo "Şifresiz Erişim..!";
}

?>