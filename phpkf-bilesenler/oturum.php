<?php
/*
 +-=========================================================================-+
 |                                phpKF v3.00                                |
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


if (!isset($sayfa_numara))
{
	if (isset($sayfano)) $sayfa_numara = $sayfano;
	else $sayfa_numara = $sayfano = 0;
}
else $sayfano = 0;

if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_OTURUM')) define('DOSYA_OTURUM',true);
if (!defined('DOSYA_AYAR')) include_once('phpkf-ayar.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_GERECLER')) include_once('phpkf-bilesenler/gerecler.php');


// ziyaretçi ip adresi alınıyor
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
else $ip = $_SERVER['REMOTE_ADDR'];
$ip = zkTemizle4($ip);
$ip = zkTemizle($ip);



//  IP YASAKLAMA - BAŞI  //

// yasaklı ip adresleri alınıyor
$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='yasak_ip' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu);
$yasak_ip = $vt->fetch_row($yasak_sonuc);

$yasak_ipd = explode("\r\n", $yasak_ip[0]);

if ($yasak_ip[0] != '')
{
	foreach ($yasak_ipd as $yasak_ipt)
	{
		if ($ip == $yasak_ipt)
		{
			$a = '403 Access Forbidden - Erişim Engellendi';
			header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
			header('Content-type: text/html; charset=utf-8');
			echo '<!DOCTYPE html><html><head><title>'.$a.'</title><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" /></head><body><h3>'.$a.'</h3></body></html>';
			exit();
		}
	}
}

//  IP YASAKLAMA - SONU  //




//  OTURUM BİLGİLERİ - BAŞI  //

$tarih = time();
if (isset($sayfa_adi)) $sayfa_adi = @zkTemizle($sayfa_adi);
else $sayfa_adi = '';
$sayfa_adi = mb_substr($sayfa_adi, 0, 100, 'utf-8');



// KAYITLI KULLANICI İSE //

if (isset($kullanici_kim['id']))
{
	// Android uygulaması için
	if (!preg_match('/phpKF\ Android\ Uygulamasi/', $_SERVER['HTTP_USER_AGENT']))
		$kul_ip = ", kul_ip='$ip'";
	else $kul_ip = '';


	// 30 dakikadır hareketsizse, son_hareketi son_girise yaz
	if ( ($kullanici_kim['son_hareket']+1800) < $tarih)
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET son_giris=son_hareket, son_hareket='$tarih', sayfano='$sayfa_numara', hangi_sayfada='$sayfa_adi' $kul_ip WHERE id='$kullanici_kim[id]' LIMIT 1";
		$oturum_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		$kullanici_kim['son_giris'] = $kullanici_kim['son_hareket'];

		// okundu bilgisi taşıyan çerezi sil
		@setcookie('kfk_okundu', '', 0, $cerez_dizin, $cerez_alanadi);
	}

	else
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET son_hareket='$tarih', sayfano='$sayfa_numara', hangi_sayfada='$sayfa_adi' $kul_ip WHERE id='$kullanici_kim[id]' LIMIT 1";
		$oturum_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}
}



// MİSAFİRİN İLK GELİŞİ İSE //

elseif ((empty($kullanici_kim['id'])) AND (empty($_COOKIE['misafir_kimlik'])))
{
	// yarım saatten eski oturumları sil
	$vtsorgu = "DELETE FROM $tablo_oturumlar WHERE (son_hareket + 1800) < $tarih";
	$eskileri_sil = $vt->query($vtsorgu) or die($vt->hata_ver());


	// BU IP İLE DAHA ÖNCE GİRİŞ VAR MI BAKILIYOR
	$result = $vt->query("SELECT sid FROM $tablo_oturumlar WHERE kul_ip='$ip' LIMIT 1");
	$misafir_varmi = $vt->fetch_assoc($result);

	if (isset($misafir_varmi['sid']))
	{
		// MD5 ile oluşturulan kimlik yarım saatlik ömür ile çereze kaydediliyor.
		$misafir_kimlik = $misafir_varmi['sid'];
		setcookie('misafir_kimlik', $misafir_kimlik, $tarih+1800, $cerez_dizin, $cerez_alanadi);

		$vtsorgu = "UPDATE $tablo_oturumlar SET son_hareket='$tarih', sayfano='$sayfa_numara', hangi_sayfada='$sayfa_adi', kul_ip='$ip' WHERE kul_ip='$ip' LIMIT 1";
		$oturum_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}

	else
	{
		$misafir_kimlik = md5(microtime());
		setcookie('misafir_kimlik', $misafir_kimlik, $tarih+1800, $cerez_dizin, $cerez_alanadi);

		$vtsorgu = "INSERT INTO $tablo_oturumlar (sid,giris,son_hareket,sayfano,hangi_sayfada,kul_ip)
				VALUES('$misafir_kimlik','$tarih','$tarih','$sayfa_numara','$sayfa_adi','$ip')";
		$oturum_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}
}



// MİSAFİRİN GEZİNTİLERİ //

elseif ((empty($kullanici_kim['id'])) AND (isset($_COOKIE['misafir_kimlik'])) AND ($_COOKIE['misafir_kimlik'] != ''))
{
	$misafir_kimlik = zkTemizle4($_COOKIE['misafir_kimlik']);
	$misafir_kimlik = zkTemizle($misafir_kimlik);
	setcookie('misafir_kimlik', $misafir_kimlik, $tarih+1800, $cerez_dizin, $cerez_alanadi);

	$vtsorgu = "UPDATE $tablo_oturumlar SET son_hareket='$tarih', sayfano='$sayfa_numara', hangi_sayfada='$sayfa_adi', kul_ip='$ip' WHERE sid='$misafir_kimlik' LIMIT 1";
	$oturum_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
}

//  OTURUM BİLGİLERİ - SONU  //






if (($ayarlar['durum_site'] != 1) AND ($kullanici_kim['yetki'] != 1))
{
// site durumu bilgisi ayarlar tablosundan çekiliyor
$vtsorgu = "SELECT * FROM $tablo_ayarlar WHERE etiket='site_kapali'";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$site_kapali = $vt->fetch_array($vtsonuc);


echo '<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>'.$ayarlar['title_anasyf'].'</title>
</head>
<body bgcolor="#ffffff" text="#000000">
<br /><br /><br /><br /><br />
<table width="100%" style="height:100%" border="0" align="center" valign="top">
<tr><td align="center" valign="middle">
<img src="'.$anadizin.'phpkf-dosyalar/site_kapali.png" width="200" height="200" border="0" alt="Sitemiz Güncellenmektedir !">
<br /><br /><br />
<h1><font color="#ff0000">'.$ayarlar['site_adi'].'</font></h1>
'.$site_kapali['deger'].'
</td></tr></table>
</body>
</html>';
exit();
}

?>