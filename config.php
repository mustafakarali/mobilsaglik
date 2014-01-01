<?php
//ezSQL çekirdegini dahil ediyoruz.
include_once "ezsql/ez_sql_core.php";
// ezSQL veritabani bilesenini cagiriyoruz.
include_once "ezsql/ez_sql_mysql.php";
// veritabanin ayarlarini yapiyoruz.
$vt_kullanici="root";
$vt_parola="";
$vt_isim="admin_esaglik";
$vt_sunucu="localhost";
// ezSQL sinifini cagirarak calistirmaya basliyoruz.
$db = new ezSQL_mysql($vt_kullanici,$vt_parola,$vt_isim,$vt_sunucu);
?>