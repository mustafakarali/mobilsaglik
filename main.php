<?php
include("config.php");
session_start();
if( isset($_SESSION['uzele-saglik'])){
	$sonuc = $db->get_row("SELECT * FROM tblyonetici WHERE yonetici_id=".$_SESSION['uzele-saglik']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    
	<title>Uzel Teknoloji e-Sağlık</title>	
	
	<link rel="stylesheet" href="./css/screen.css" type="text/css" media="screen" title="no title" charset="utf-8" />	
	<link rel="stylesheet" href="./css/plugin.css" type="text/css" media="screen" title="no title" charset="utf-8" />	
	<link rel="stylesheet" href="./css/custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />		
	
	<style type="text/css" media="screen">
		
	</style>


</head>

<body onload="tansiyonal();">
	
<div id="wrapper" class="clearfix">
	
	<div id="top">
		<div id="header">
			<h1>UZEL TEKNOLOJİ E-SAĞLIK SİSTEMİ</h1>
			
			<div id="info">
				<h4><?php echo $sonuc->yonetici_adi; ?></h4>
				
				<p>
					<br />Çıkış için <a href="cikisyaptir.php">Tıklayınız.</a>
				</p>
				
				<img src="./images/avatar.jpg" alt="avatar" />
			</div> <!-- #info -->
					
		</div> <!-- #header -->	
		
		
		<div id="nav">	
	
	</div> <!-- #top -->
	
	<div id="content" class="xfluid">
		
		<div class="portlet x3" style="min-height: 300px;">
			
			<div class="portlet-header">
				<h4>HASTA BİLGİLERİ</h4>
			</div> <!-- .portlet-header -->
			
			<div class="portlet-content">
				<img src="images/ress.gif" width="265px" height="180px" /><br />
                
                <table width="200" border="0">
                <?php
			$hasta = $db->get_row("SELECT * FROM tblhasta WHERE hasta_yonetici_id=".$_SESSION['uzele-saglik']);
			echo '<tr><td width="47%"><b>Hasta Adı<b></td><td width="53%">';
            echo $hasta->hasta_adi;    
            echo "</td></tr><tr><td><b>Hasta Yaşı<b></td><td>";     
			echo $hasta->hasta_yasi;	  
			echo "</td></tr><tr><td><b>Hasta Cinsiyet<b></td><td>";	  
			if($hasta->hasta_cinsiyet==1)
			{
			echo "Erkek";
			}	  
			else
			{
			echo "Kadın";  
			}
			echo "</td></tr><tr><td><b>Hasta Telefon<b></td><td>";
			echo $hasta->hasta_telefon;	  
			echo "</td></tr><tr><td><b>Hasta Doktoru<b></td><td>";	
			echo $sonuc->yonetici_adi;
			echo "</td></tr><tr><td><b>Hasta Adresi<b></td><td>";	
			echo $hasta->hasta_adresi;	
			echo "</td></tr></table>";

?>
			</div> <!-- .portlet-content -->			
		</div> <!-- .portlet -->
		
		<div id="dash_chart" class="portlet x9">
			
			<div class="portlet-header">
				<h4>ÖLÇÜM DEĞERLERİ</h4>
				
				<ul class="portlet-tab-nav">
					<li class="portlet-tab-nav-active"><a href="#tab1" rel="tooltip" title="">TANSİYON DEĞERLERİ</a></li>				
					<li class=""><a href="#tab2" rel="tooltip" title="">ŞEKER DEĞERLERİ</a></li>
                    <li class=""><a href="#tab3" rel="tooltip" title="">EKG DEĞERLERİ</a></li>
                    <li class=""><a href="#tab4" rel="tooltip" title="">VUCUT SICAKLIĞI</a></li>
                    <li class=""><a href="#tab5" rel="tooltip" title="">KİLO DEĞERLERİ</a></li>
				</ul>
			</div> <!-- .portlet-header -->
			
			<div class="portlet-content">				
				<div id="tab1" class="portlet-tab-content portlet-tab-content-active">
                <?php
$tansiyonlar = $db->get_results("SELECT * FROM tbltansiyon WHERE tansiyon_hastaid=12345678 order by tansiyon_id desc limit 10");		
$tansiyonlar2 = $db->get_row("SELECT * FROM tbltansiyon WHERE tansiyon_hastaid=12345678 order by tansiyon_id desc limit 1");		
?>
<font size="+1">
		<table width="200" border="0">
  <tr>
    <td width="18%"><b>Son ölçülen :</b></td>
    <td width="82%"><?php echo "Büyük tansiyon : <font color='#FF0000'>".$tansiyonlar2->tansiyon_bt." </font>Küçük tansiyon : <font color='#FF0000'>".$tansiyonlar2->tansiyon_kt." </font>Nabız : <font color='#FF0000'>".$tansiyonlar2->tansiyon_nbz."</font>"; ?></td>
  </tr>
</table>
</font>
<table class="stats" title="area" width="100%" cellpadding="0" cellspacing="0">
                <caption>Tansiyon Ölçümü</caption>
                <thead>
                
							<tr>
                            <?php
					foreach($tansiyonlar as $tansiyonlardata){
						echo "<th>".$tansiyonlardata->tansiyon_saat."</th>";
					}
					 ?>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<th>Büyük Tansiyon</th>
								<?php
					foreach($tansiyonlar as $tansiyonlardata){
						echo "<td>".$tansiyonlardata->tansiyon_bt."</td>";
					}
					 ?>
							</tr>
                            <tr>
                            <th>Küçük Tansiyon</th>
<?php
					foreach($tansiyonlar as $tansiyonlardata){
						echo "<td>".$tansiyonlardata->tansiyon_kt."</td>";
					}
					 ?>  
							</tr>					
						</tbody>
					</table>
				</div> <!-- .portlet-tab-content -->
				
				<div id="tab2" >
                 <?php
$sekerler = $db->get_results("SELECT * FROM tblseker WHERE seker_hastaid=12345678 order by seker_id desc limit 10");		
$sekerler2 = $db->get_row("SELECT * FROM tblseker WHERE seker_hastaid=12345678 order by seker_id desc limit 1");		
?>

                <table class="stats" title="area" width="100%" cellpadding="0" cellspacing="0">
                <caption>Şeker Ölçümü</caption>
                <thead>
                
							<tr>
                            <?php
					foreach($sekerler as $sekerlerdata){
						echo "<th>".$sekerlerdata->seker_saat."</th>";
					}
					 ?>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<th>Şeker Değeri</th>
								<?php
					foreach($sekerler as $sekerlerdata){
						echo "<td>".$sekerlerdata->seker_deger."</td>";
					}
					 ?>
							</tr>			
						</tbody>
					</table>
				</div> <!-- .portlet-tab-content -->
                
                <div id="tab3" class="portlet-tab-content">
                <table class="stats" title="area" width="100%" cellpadding="0" cellspacing="0">
						<caption>EKG</caption>
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
                                <th></th>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<th>12/02/2013</th>
								<td>5</td>
								<td>-5</td>
								<td>4</td>
								<td>-5</td>
								<td>5</td>
                                <td>-3</td>
                                <td>6</td>
							</tr>					
						</tbody>
					</table>
				</div> <!-- .portlet-tab-content -->
                <div id="tab4" class="portlet-tab-content">
                <table class="stats" title="area" width="100%" cellpadding="0" cellspacing="0">
						<caption>VÜCUT SICAKLIĞI</caption>
						<thead>
							<tr>
								<th>06:00</th>
								<th>09:00</th>
								<th>12:00</th>
								<th>15:00</th>
								<th>18:00</th>
								<th>21:00</th>
                                <th>00:00</th>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<th>12/02/2013</th>
								<td>36</td>
								<td>36.5</td>
								<td>37</td>
								<td>36.5</td>
								<td>36</td>
                                <td>38</td>
                                <td>37</td>
							</tr>					
						</tbody>
					</table>
				</div> <!-- .portlet-tab-content -->
                <div id="tab5" class="portlet-tab-content">
                <table class="stats" title="area" width="100%" cellpadding="0" cellspacing="0">
						<caption>KİLO DEĞERLERİ</caption>
						<thead>
							<tr>
								<th>06:00</th>
								<th>09:00</th>
								<th>12:00</th>
								<th>15:00</th>
								<th>18:00</th>
								<th>21:00</th>
                                <th>00:00</th>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<th>12/02/2013</th>
								<td>56.80</td>
								<td>55.81</td>
								<td>56.80</td>
								<td>54.30</td>
								<td>56.01</td>
                                <td>58.30</td>
                                <td>56.55</td>
							</tr>					
						</tbody>
					</table>
				</div> <!-- .portlet-tab-content -->
			</div> <!-- .portlet-content -->			
		</div> <!-- .portlet -->
		
		<div class="xbreak"></div> <!-- .xbreak -->
		
		
		</div>  <!-- .portlet -->
	
	<div id="footer">
		
		<p>Tüm Hakları Saklıdır &copy; 2013 UZEL TEKNOLOJİ</p>
		
	</div> <!-- #footer -->
	
</div> <!-- #wrapper -->

<script  type="text/javascript" src="js/jquery/jquery.1.4.2.min.js"></script>
<script  type="text/javascript" src="js/slate/slate.js"></script>
<script  type="text/javascript" src="js/slate/slate.portlet.js"></script>
<script  type="text/javascript" src="js/plugin.js"></script>
                    <script type="text/javascript" charset="utf-8">
$(function () 
{
	slate.init ();
	slate.portlet.init ();	
});
</script>	
              
</body>

</html>
<?php
}
else{
header('Location: index.html');	
}?>