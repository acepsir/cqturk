<?php
/*
 +-=========================================================================-+
 |                             phpKF-Portal v3.00                            |
 +---------------------------------------------------------------------------+
 |                  Telif - Copyright (c) 2007 - 2019 phpKF                  |
 |                    www.phpKF.com   -   phpKF@phpKF.com                    |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkarma ve satma hakları sadece phpKF`ye aittir. |
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  phpKF.com/telif.php  adresini ziyaret edin. |
 +-=========================================================================-+*/


if (!@is_file('../ayar.php'))
{
	echo '
	<link href="temalar/varsayilan/portal_stil.css" rel="stylesheet" type="text/css">
	<table cellpadding="0" cellspacing="0" width="100%" height="100%" bgcolor="#ffffff">
	<tr>
	<td align="center" valign="middle">
	<br>
	<table cellpadding="1" cellspacing="1" width="80%" height="80%" bgcolor="#dddddd">
	<tr>
	<td align="center" valign="middle" height="35px" colspan="2" style="background:url(temalar/varsayilan/resimler/resimler/alt.gif); color:#000000; font-family:Verdana; font-size: 13px;">
	phpKF-Portal Kurulumu
	</td>
	</tr>
	<tr>
	<td width="200px" align="left" valign="top" bgcolor="#ffffff">
	<hr style="color:#eeeeee;"><div valign="middle"><font style="color:#000000; font-family:Verdana; font-size: 13px;"><b>1. AŞAMA</b></font>
	<font style="color:#ff0000; font-family:Verdana; font-size: 13px;"><b>( HATA ! )</b></font></div>
	<hr style="color:#eeeeee;"><div valign="middle"><font style="color:#dddddd; font-family:Verdana; font-size: 13px;"><b>2. AŞAMA</b></font></div>
	<hr style="color:#eeeeee;"><div valign="middle"><font style="color:#dddddd; font-family:Verdana; font-size: 13px;"><b>3. AŞAMA</b></font></div>
	
	<hr style="color:#eeeeee;">
	<br>
	<br>
	<br>
	<br>
	<div align="center"><img src="resimler/degisen_resimler/4.png" alt="phpKF" title="phpKF"></div>
	
	</td>
	<td align="center" valign="middle" bgcolor="#ffffff" id="liste-veri">

	<form target="_blank" action="http://www.phpkf.com/indirme.php" method="get" name="uyari">
	<br>
	<br>
	<br>
	<br><br><b>phpKF-Portal\'ı </b> Kurabilmek için phpKF Forumun kurulu olması gerekiyor <br>phpkf forumu indirip kurmak için alttaki butona tıklayarak güncel sürüme ulaşabilirsiniz.
	<br><br>
	Forumu daha önceden kurduysanız portalı aynı dizine atmamış olabilirsiniz.
	<br>Forum ve portalın aynı dizinde (klasörde) olması gerekiyor.
	<br><br><br><br>
	<input class="dugme" type="submit" value="Forum Güncel Sürüm">
	</form>
	<form target="_blank" action="http://www.phpkf.com/indirme.php#portal_indir" method="get" name="uyari">
	<input class="dugme" type="submit" value="Portal Güncel Sürüm">
	</form>
	
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>';
	exit();
}
#######################################################
#######################################################

	// dosyası include ediliyor.
	define('YONETIM_TEMADIZINI', true);
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_MENU')) include 'menu.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';
	$surum = $ayarlar['surum'];


	// portal yonetim taban rengi bilgisi.
	$arka_tablo = "yonetim_bg2";

	if($kosul == 'not_kaydet')
	{
	$_POST['not_icerik'] = stripslashes($_POST['not_icerik']);
	$dosya = @fopen('yonetim_not.txt','w') or die('<br><p align="center"><font style="background-color: #ffffff; color: #FF0000;"><b>'.$kp_yonetim_390.'</b></font><br><br><b>'.$kp_yonetim_391.'</b></p><br>');

	@fwrite($dosya,$_POST['not_icerik']);
	@fclose($dosya);

	header('Location: ./yonetim.php');
	exit();
	}




// RESMİ DUYURU - BAŞI //

if ( ((isset($_GET['duyuru'])) AND ($_GET['duyuru'] == 'portal')) OR ((isset($_GET['psurum'])) AND ($_GET['psurum'] != '')) )
{
	if (isset($_GET['duyuru'])) $ek = 'l='.$site_dili.'&duyuru=portal';
	elseif (isset($_GET['psurum'])) $ek = 'l='.$site_dili.'&psurum='.$surum;

	if (!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = 'http://'.$ayarlar['alanadi'].$ayarlar['f_dizin'].'/portal/yonetim.php';

	if ((isset($_GET['adres'])) AND ($_GET['adres'] == '1')) $adres = '79.171.17.200';
	else{
		$adres = 'www.phpkf.com';
		$_GET['adres'] = '0';
	}


	header('Content-type: text/html');
	header('Content-type: text/html; charset=iso-8859-9');
	header('Content-Language: tr');


$out = "GET /resmi_duyuru.php?$ek HTTP/1.1
Accept: text/html
Accept-Encoding: iso-8859-9
Host: $adres
Referer: $_SERVER[HTTP_REFERER]
User-Agent: phpKF Resmi Duyuru ve Surum Denetleme
Connection: close

";


	// fsockopen fonksiyonu engellenmişse
	if (!function_exists('fsockopen'))
	{
		if ( (isset($_GET['duyuru'])) AND ($_GET['duyuru'] == 'portal' ) )
		echo mb_convert_encoding('<iframe src="//www.phpkf.com/resmi_duyuru.php?l='.$site_dili.'&duyuru=portal" name="duyuru" style="border:2px solid #ddd; width:800px; height:500px">'.$ly['noiframe'].'</iframe>',"ISO-8859-9","UTF-8");
		exit();
	}



	$cikis = '';
	$baglanti = @fsockopen($adres, 80, $hatano, $hata, 10);

	if(!$baglanti)
	{
		if ($_GET['adres'] == '0')
		{
			header('Location: yonetim.php?adres=1&'.$ek);
			exit();
		}
		else
		{
			echo '<font color="#ff0000"><b>'.$ly['baglanti_yok_ansi'].'</b></font><br>';
			echo "$hata ($hatano)<br><br>";
			exit();
		}
	}

	@fputs($baglanti, $out);
	$satir = @fgets($baglanti);

	if (@substr_count($satir, "200 OK") > 0)
	{
		$baslik = false;
		while(!@feof($baglanti))
		{
			$satir = @fgets($baglanti);
			if ($satir == "\r\n") $baslik = true;
			if ($baslik) $cikis .= $satir;
		}
	}

	else $cikis .= '<font color="#ff0000"><b>'.$ly['baglanti_yok_ansi'].'</b></font><br>';
	@fclose($baglanti);

	$cikis = str_replace(array("\r", "\n"), array('', ''), $cikis);
	$cikis = preg_replace("/^([a-z0-9-]*?)\</i", '<', $cikis);
	$cikis = preg_replace("/\>([a-z0-9-]*?)$/i", '>', $cikis);

	echo $cikis;
	exit();
}

// RESMİ DUYURU - SONU //




	/***************************************************/

	$sayfa_adi = $l['anasayfa'];
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();

	function dizinboyut($dizinadi)
	{
	if ((!is_dir($dizinadi)) OR (!is_readable($dizinadi)))
	return false;

	$dizinadi_dizi[] = $dizinadi;
	$boyut = 0;

	do
	{
	$dizinadi = array_shift($dizinadi_dizi);
	$klasor = opendir($dizinadi);

	while (false !== ($dosya = readdir($klasor)))
	{
	if ( ($dosya != '.') AND ($dosya != '..') AND (is_readable($dizinadi . DIRECTORY_SEPARATOR . $dosya)) )
	{
	if (is_dir($dizinadi . DIRECTORY_SEPARATOR . $dosya))
	$dizinadi_dizi[] = $dizinadi . DIRECTORY_SEPARATOR . $dosya;

	$boyut += filesize($dizinadi . DIRECTORY_SEPARATOR . $dosya);
	}
	}
	closedir($klasor);
	}
	while (count($dizinadi_dizi) > 0);

	return $boyut;
	}	




	$boyut_sonuc =  sprintf("%.2f" , ((dizinboyut('dosyalar/')) / 1024));  
	$boyut_sonuc .= ' kb.';
	$boyut_sonuc2 =  sprintf("%.2f" , ((dizinboyut('galeri/')) / 1024)); 
	$boyut_sonuc2 .= ' kb.';

	$pgs = '<a href="javascript:void(0);" onclick="yenile(\'katman_surum1\', \'1\', \'portal\')">'.$kp_yonetim_154.'</a>';




// RESMİ DUYURU EKRANI - BAŞI //

$phpkf_duyuru = '<br>
<noscript><br><font color="#ff0000">
<b>Tarayıcınız javascript desteklemiyor veya kapalı !
<br>Bu özellik için javascript desteği gereklidir !</b><br>
</font></noscript>


<div id="katman_duyuru1" style="float:left; border:0px solid #000000">

<script type="text/javascript"><!-- //
document.write(\'<b>&nbsp; Güncel duyuruları almak için <a href="javascript:void(0);" onclick="duyuru(\\\'katman_duyuru1\\\')">tıklayın.</a></b>\');
//  -->
</script>

</div>
';



$javascript_kodu = '<script type="text/javascript"><!-- //
//  php Kolay Forum (phpKF)
//  =======================
//  Telif - Copyright (c) 2007 - 2019 phpKF Ekibi
//  http://www.phpkf.com   -   phpkf @ phpkf.com
//  Tüm hakları saklıdır - All Rights Reserved

function GonderAl(adres,katman){
var katman1 = document.getElementById(katman);
var veri_yolla = \'name=value\';
if (document.all) var istek = new ActiveXObject("Microsoft.XMLHTTP");
else var istek = new XMLHttpRequest();
istek.open("GET", adres, true);

istek.onreadystatechange = function(){
if (istek.readyState == 4){
    if (istek.status == 200) katman1.innerHTML = istek.responseText;
    else katman1.innerHTML = \'<font color="#ff0000"><b>Bağlantı Kurulamadı !</b></font>\';}};
istek.send(veri_yolla);}

function yenile(katman,veri,tip){
if (tip==\'portal\') var adres = \'yonetim.php?psurum=\'+veri;
var katman1 = document.getElementById(katman);
katman1.innerHTML = \'<img src="../phpkf-dosyalar/yukleniyor.gif" alt="Yü." title="Yükleniyor...">\';
setTimeout("GonderAl(\'"+adres+"\',\'"+katman+"\')",1000);}

function duyuru(katman){
adres = \'yonetim.php?duyuru=portal\';
var katman1 = document.getElementById(katman);
katman1.innerHTML = \'<img src="../phpkf-dosyalar/yukleniyor.gif" alt="Yü." title="Yükleniyor...">\';
setTimeout("GonderAl(\'"+adres+"\',\'"+katman+"\')",1000);}';

$tarih = time();

if (($ayarlar['duyuru_tarihi']+259200) < $tarih)
{
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$tarih' WHERE etiket='duyuru_tarihi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$javascript_kodu .= 'duyuru(\'katman_duyuru1\');
	yenile(\'katman_surum1\', \'1\',\'portal\');';
}

$javascript_kodu .= '
// -->
</script>';

// RESMİ DUYURU EKRANI - SONU //



	$dongusuz = array(
	'{TEMIZLE}' => $kp_yonetim_134,
	'{NOTLARIM}' => $kp_yonetim_375,
	'{KAYDET}' => $kp_yonetim_374,
	'{PORTAL_ARKA_TABLO_RENGI}' => $arka_tablo,
	'{PORTAL_SURUMU}' => $kp_yonetim_113,
	'{PORTAL_SURUM_SONUCU}' => $surum,
	'{PHP_SURUMU}' => $kp_yonetim_118,
	'{PHP_SURUM_SONUCU}' => @phpversion(),
	'{MYSQL_SURUMU}' => $kp_yonetim_119,
	'{MYSQL_SURUM_SONUCU}' => @$vt->get_server_info(),
	'{ZEND_SURUMU}' => $kp_yonetim_120,
	'{ZEND_SURUM_SONUCU}' => @zend_version(),
	'{DOSYALAR_KLASORU_BOYUTU}' => $kp_yonetim_192,
	'{GALERI_KLASORU_BOYUTU}' => $kp_yonetim_191,
	'{DOSYALAR_KLASORU_BOYUTU_SONUCU}' =>  $boyut_sonuc,
	'{GALERI_KLASORU_BOYUTU_SONUCU}' =>  $boyut_sonuc2,
	'{YONETIM_MASASI}' => $kp_yonetim_11,
	'{PGS}' => $pgs,
	'{HOSGELDINIZ}' => $kp_yonetim_16,
	'{JAVASCRIPT_KODU}' => $javascript_kodu,
	'{PHPKF_DUYURU}' => $phpkf_duyuru);


	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/index.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));

	$dosya = 'yonetim_not.txt';
	$dosya_ac = @fopen($dosya,'r');
	
	while ($yazdir = @fread($dosya_ac,filesize($dosya)))
	{
	$dondur111[] = array('{NOT_ICERIK}' => $yazdir);
	}
	if (!isset($dondur111))
	{
	$dondur111[] = array('{NOT_ICERIK}' => $kp_yonetim_377);
	}
	@fclose($dosya_ac);
	
	$ornek1->tekli_dongu('not',$dondur111);
	
	$ornek1->dongusuz($dongusuz);

	eval(TEMA_UYGULA);

?>