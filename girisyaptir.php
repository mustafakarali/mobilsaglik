<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<?php
	include("config.php");
	$gelenKullanici = $_POST["kullaniciadi"];
	$gelenSifresi = $_POST["sifresi"];
	$sonuc = $db->get_row("SELECT * FROM tblyonetici WHERE yonetici_mail='".$gelenKullanici."' AND yonetici_sifre='".$gelenSifresi."'");
if($sonuc)
{
	session_start();
	$_SESSION['uzele-saglik']= $sonuc->yonetici_id;
	header('Location: main.php');	
	
} 
else
{
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title></title>
	
	<link rel="stylesheet" href="./css/screen.css" type="text/css" media="screen" title="no title" charset="utf-8" />	
	<link rel="stylesheet" href="./css/plugin.css" type="text/css" media="screen" title="no title" charset="utf-8" />	
	<link rel="stylesheet" href="./css/custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />
	<link rel="stylesheet" href="./css/login.css" type="text/css" media="screen" title="no title" charset="utf-8" />

</head>

<body >

<div id="login">

	
<div id="login-body" class="clearfix"> 
<div class="content_front">
<div class="pad">
	   <font color="#FF0000" size="+1">HATALI KULLANICI ADI VEYA ŞİFRESİ GİRDİNİZ</font>
</div>
</div> 


</body>

</html>';	
header("Refresh: 3; url=index.html");
}
?>

</body>
</html>