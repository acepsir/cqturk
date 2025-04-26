<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include 'bilesenler/guvenlik.php';
if (!defined('DOSYA_GERECLER')) include '../bilesenler/gerecler.php';


// RESMİ DUYURU - BAŞI //

if ( (isset($_GET['duyuru'])) AND ($_GET['duyuru'] == 'forum' ) OR (isset($_GET['fsurum'])) AND ($_GET['fsurum'] != '' ) )
{
	if (isset($_GET['duyuru'])) $ek = 'duyuru=forum';
	elseif (isset($_GET['fsurum'])) $ek = 'fsurum='.$_GET['fsurum'];

	if (!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER'] = 'http://'.$ayarlar['alanadi'].$ayarlar['f_dizin'].'/yonetim/index.php';

	if ((isset($_GET['adres'])) AND ($_GET['adres'] == '1'))
	{
		$adres = '79.171.17.200';
		$_GET['adres'] = '0';
	}
	else
	{
		$adres = 'www.phpkf.com';
		$_GET['adres'] = '0';
	}


	header('Content-type: text/html');
	header("Content-type: text/html; charset=iso-8859-9");
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
		echo '<font color="#ff0000"><b>fsockopen() fonksiyonu engellenmiş !</b></font>';

		if ( (isset($_GET['duyuru'])) AND ($_GET['duyuru'] == 'forum' ) )

		echo '<br><br><b>Sunucu ayarlarınız www.phpkf.com adresine bağlanmayı desteklemiyor veya izin vermiyor !</b><br><br>Duyurular aşağıda çerçeve (iframe) içinde açılacaktır.<br><br>
		<hr width="100%" style="color: #000000"><br>
		<iframe src="http://www.phpkf.com/resmi_duyuru.php?duyuru=forum" name="duyuru" height="250" width="530" frameborder="0">Tarayıcınız iframe özelliğini desteklemiyor veya kapalı. Başka bir tarayıcıda deneyin veya kullandığınız tarayıcının iframe özelliğini açın.</iframe>';

		exit();
	}



	$cikis = '';
	$baglanti = @fsockopen($adres, 80, $hatano, $hata, 10);

	if(!$baglanti)
	{
		if ($_GET['adres'] == '0')
		{
			header('Location: index.php?adres=1&'.$ek);
			exit();
		}
		else
		{
			echo '<font color="#ff0000"><b>Bağlantı Kurulamadı !</b></font><br>';
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

	else $cikis .= '<font color="#ff0000"><b>Bağlantı Kurulamadı !</b></font><br>';

	@fclose($baglanti);

	$cikis = str_replace("\r", '', $cikis);
	$cikis = str_replace("\n", '', $cikis);
	$cikis = preg_replace("/^([a-z0-9-]*?)\</i", '<', $cikis);
	$cikis = preg_replace("/\>([a-z0-9-]*?)$/i", '>', $cikis);
	echo $cikis;
	exit();
}

// RESMİ DUYURU - SONU //




$sayfa_adi = 'Yönetim Ana Sayfası';
include_once('bilesenler/sayfa_baslik.php');




// RESIM DİZİNİ BOYUTU ÖLÇÜLÜYOR //

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



//	GD KUTUPHANESİ BİLGİSİ	//

$gd_bilgisi = '';

if (@extension_loaded('gd'))
{
	$gd_bilgi = @gd_info();

	$gd_bilgisi .= 'GD Bilgisi: '.$gd_bilgi['GD Version'];

	if ($gd_bilgi['PNG Support'] == true)
		$gd_bilgisi .= '<br>PNG Bilgisi: destekleniyor';

	else $gd_bilgisi .= '<br><font color="#ff0000">Sunucunuz PNG desteklemiyor, onay kodu çalışmaz !<br>"Genel Ayarlar" sayfasından kapatabilirsiniz.</font></font>';
}

else $gd_bilgisi .= '<font color="#ff0000">Sunucunuz GD desteklemiyor, onay kodu çalışmaz !<br>"Genel Ayarlar" sayfasından kapatabilirsiniz.</font><br>';



//  GZİP DOSYA SIKIŞTIRMA DESTEĞİ   //

if (@extension_loaded('zlib'))
	$gzip = '<font color="#007900">Var</font>';

else $gzip = '<font color="#ff0000"><b>Yok</b></font>';



//  SUNUCUNUN register_globals AYARINA BAKILIYOR //

if(@ini_get('register_globals'))
{
	$register_globals = '<font color="#ff0000">
Sunucunuzun register_globals ayarı açık durumda !
<br>Sitenizin güvenliği için bu ayarı kapatmanız önerilir.
<br><br>Kapatmak için <a href="http://www.phpkf.com/k820-registerglobals-evrensel-kayit-ozelligini-kapatma.html" target="_blank">bu sayfaya bakın.</a>
</font>';
}

else $register_globals = '<font color="#007900">Kapalı</font>';



//  SUNUCUNUN safe_mode AYARINA BAKILIYOR //

if(@ini_get('safe_mode')) $safe_mode = '<font color="#007900">Açık</font>';

else $safe_mode = 'Kapalı';




//	VERİTABANI BOYUTU HESAPLANIYOR - BAŞI	//

$vtsorgu = "SHOW TABLE STATUS LIKE '%'";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$toplam_boyut = 0;

while ($tablo_bilgileri = $vt->fetch_array($vtsonuc))
$toplam_boyut += ($tablo_bilgileri['Data_length'] + $tablo_bilgileri['Index_length']);

$vt_boyutu = NumaraBicim($toplam_boyut/1024/1024, 2).' mb';
$resim_boyutu = NumaraBicim((dizinboyut('../dosyalar/resimler/yuklenen/')/1024/1024), 2).' mb';
$eklentiler_boyutu = NumaraBicim((dizinboyut('../eklentiler/')/1024/1024), 2).' mb';


$acilis_tarihi = zonedate2('d.m.Y', $ayarlar['saat_dilimi'], false, $forum_acilis);
$phpkf_surum = $ayarlar['surum']. ' &nbsp; ';
$surum_denetle = '<a href="javascript:void(0);" onclick="yenile(\'katman_surum2\', \''.$ayarlar['surum'].'\')">Sürümü Denetle</a>';


if (@PHP_OS) $sunucu_is = @PHP_OS;
elseif (isset($_ENV['TERM'])) $sunucu_is = $_ENV['TERM'];
elseif (isset($_ENV['OS'])) $sunucu_is = $_ENV['OS'];



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
//  Telif - Copyright (c) 2007 - 2017 phpKF
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

function yenile(katman,veri){
adres = \'index.php?fsurum=\'+veri;
var katman1 = document.getElementById(katman);
katman1.innerHTML = \'<img src="../dosyalar/yukleniyor.gif" width="18" height="18" alt="Yü." title="Yükleniyor...">\';
setTimeout("GonderAl(\'"+adres+"\',\'"+katman+"\')",1000);}

function duyuru(katman){
adres = \'index.php?duyuru=forum\';
var katman1 = document.getElementById(katman);
katman1.innerHTML = \'<img src="../dosyalar/yukleniyor2.gif" width="220" height="19" alt="Yükleniyor..." title="Yükleniyor...">\';
setTimeout("GonderAl(\'"+adres+"\',\'"+katman+"\')",1000);}';

$tarih = time();

if (($ayarlar['duyuru_tarihi']+86400) < $tarih)
{
	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$tarih' WHERE etiket='duyuru_tarihi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$javascript_kodu .= 'duyuru(\'katman_duyuru1\');
	yenile(\'katman_surum2\', \''.$ayarlar['surum'].'\');';
}

$javascript_kodu .= '
// -->
</script>';

// RESMİ DUYURU EKRANI - SONU //




//	TEMA UYGULANIYOR	//

//	veriler tema motoruna yollanıyor	//

$dongusuz = array('{ACILIS_TARIHI}' => $acilis_tarihi,
'{PHPKF_SURUM}' => $phpkf_surum,
'{MYSQL_SURUM}' => @$vt->get_server_info(),
'{PHP_SURUM}' => @phpversion(),
'{ZEND_SURUM}' => @zend_version(),
'{GD_BILGI}' => $gd_bilgisi,
'{GZIP}' => $gzip,
'{REGISTER_GLOBALS}' => $register_globals,
'{SAFE_MODE}' => $safe_mode,
'{SUNUCU_IS}' => $sunucu_is,
'{SUNUCU_BILGI}' => $_SERVER['SERVER_SOFTWARE'],
'{RESIM_BOYUTU}' => $resim_boyutu,
'{EKLENTILER_BOYUTU}' => $eklentiler_boyutu,
'{VT_BOYUTU}' => $vt_boyutu,
'{SURUM_DENETLE}' => $surum_denetle,
'{JAVASCRIPT_KODU}' => $javascript_kodu,
'{PHPKF_DUYURU}' => $phpkf_duyuru);


$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/'.$temadizini.'/index.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));

$ornek1->dongusuz($dongusuz);

eval(TEMA_UYGULA);

?>