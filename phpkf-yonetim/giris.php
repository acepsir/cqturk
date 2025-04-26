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


//  GİRİŞ YAPILIYOR  - BAŞI  //
//  GİRİŞ YAPILIYOR  - BAŞI  //
//  GİRİŞ YAPILIYOR  - BAŞI  //

if ( (isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu') ):


// giriş yapılmışsa yönetim anasayfasına yönlendir
if ( (isset($_COOKIE['yonetim_kimlik'])) AND ($_COOKIE['yonetim_kimlik'] != '') ):
	header('Location: index.php');
	exit();

else:


// Form boş ise hata ver //
if ((empty($_POST['kullanici_adi'])) OR (empty($_POST['sifre'])))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=18');
	exit();
}

if ((@strlen($_POST['kullanici_adi']) > 20) OR (@strlen($_POST['kullanici_adi']) < 4))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=19');
	exit();
}

if ((@strlen($_POST['sifre']) > 20) OR (@strlen($_POST['sifre']) < 5))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=20');
	exit();
}


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');



// zararlı kodlar temizleniyor
if (isset($_COOKIE['misafir_kimlik'])) $_COOKIE['misafir_kimlik'] = zkTemizle($_COOKIE['misafir_kimlik']);
else $_COOKIE['misafir_kimlik'] = '';
$_POST['kullanici_adi'] = zkTemizle($_POST['kullanici_adi']);
$_POST['sifre'] = zkTemizle($_POST['sifre']);


// ziyaretçi ip adresi alınıyor
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
else $ip = $_SERVER['REMOTE_ADDR'];
$ip = zkTemizle4($ip);
$ip = zkTemizle($ip);


$tarih = time();
$sayfa_adi = $l['yonetim_girisi_yapti'];



// Şifre anahtar ile karıştırılarak veritabanındaki ile karşılaştırılıyor

$karma = sha1(($anahtar.$_POST['sifre']));

$vtsorgu = "SELECT id,sifre,kul_etkin,engelle,yetki,giris_denemesi,kilit_tarihi,kullanici_kimlik,yonetim_kimlik
		FROM $tablo_kullanicilar WHERE kullanici_adi='$_POST[kullanici_adi]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$yonetim_denetim = $vt->fetch_assoc($vtsonuc);



// Hesap kilit tarihi kontrol ediliyor

if ( (isset($yonetim_denetim['kilit_tarihi'])) AND
( ($yonetim_denetim['kilit_tarihi'] + $ayarlar['uye_kilit_sure']) > $tarih ) AND
($yonetim_denetim['giris_denemesi'] > 4) )
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=21');
	exit();
}




//  KULLANICI ADI VE ŞİFRE UYUŞMUYORSA  //

elseif ( (!$vt->num_rows($vtsonuc)) OR ($yonetim_denetim['sifre'] != $karma))
{
	// Başarısız girişler 5 olduğunda hesap kilitleniyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET kilit_tarihi='$tarih', giris_denemesi=giris_denemesi + 1
				WHERE kullanici_adi='$_POST[kullanici_adi]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($yonetim_denetim['giris_denemesi'] > 3)
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=21');
		exit();
	}

	else
	{
		if (isset($yonetim_denetim['id'])) header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=22');
		else
		{
			if (@preg_match('/@/i', $_POST['kullanici_adi'])) header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=208');
			else header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=207');
		}
		exit();
	}
}


// Hesap etkinleştirimemişse
elseif ($yonetim_denetim['kul_etkin'] == 0)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=23');
	exit();
}


// hesap engellenmişse değilse
elseif ($yonetim_denetim['engelle'] == 1)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=24');
	exit();
}


// yönetim yetkisi yoksa
elseif ($yonetim_denetim['yetki'] != 1)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=144');
	exit();
}




// SORUN YOK GİRİŞ YAPILIYOR
// Zaman degeri sha1() ile kodlanarak çereze giriliyor
// Beni hatırla işaretli ise çerez geçerlilik süresi ekleniyor

elseif ($yonetim_denetim['sifre'] == $karma)
{
	if ($yonetim_denetim['kullanici_kimlik'] != '') $kullanici_kimlik = $yonetim_denetim['kullanici_kimlik'];
	else $kullanici_kimlik = sha1(microtime());
	$yonetim_kimlik = sha1(microtime());


	// Android uygulaması için
	if ((@preg_match('/phpKF\ Android\ Uygulamasi/', $_SERVER['HTTP_USER_AGENT'])) AND ($yonetim_denetim['kullanici_kimlik'] != ''))
	{
		if ($yonetim_denetim['yonetim_kimlik'] != '') $yonetim_kimlik = $yonetim_denetim['yonetim_kimlik'];
	}


	if (isset($_POST['hatirla'])) $cerez_tarih = $tarih +$ayarlar['k_cerez_zaman'];
	else $cerez_tarih = 0;

	// çerez yazılıyor
	setcookie('kullanici_kimlik', $kullanici_kimlik, $cerez_tarih, $cerez_dizin, $cerez_alanadi);
	setcookie('yonetim_kimlik', $yonetim_kimlik, 0, $cerez_dizin, $cerez_alanadi);


	// Kullanıcı giriş yapınca açılan misafir oturumu ve çerezi siliniyor
	if ( (isset($_COOKIE['misafir_kimlik'])) OR ($_COOKIE['misafir_kimlik'] != '') )
	{
		$vtsorgu = "DELETE FROM $tablo_oturumlar WHERE sid='$_COOKIE[misafir_kimlik]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		setcookie('misafir_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
	}


	// kullanıcı ve yonetim kimlik veritabanına giriliyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET
				kullanici_kimlik='$kullanici_kimlik', yonetim_kimlik='$yonetim_kimlik',
				giris_denemesi=0, kilit_tarihi=0, yeni_sifre=0,
				son_giris=son_hareket, son_hareket='$tarih',
				hangi_sayfada='$sayfa_adi', kul_ip='$ip'
				WHERE id='$yonetim_denetim[id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if (isset($_POST['git']))
	{
		if (@is_array($_POST['git'])) $git = 'index.php';
		else $git = $_POST['git'];

		if ($git == '')  $git = 'index.php';
		elseif ($git == 'portal') $git = '../portal/yonetim.php';
		elseif (@preg_match('/'.$phpkf_dosyalar['hata'].'/i', $git)) $git = 'index.php';
		elseif (@preg_match('/'.$phpkf_dosyalar['giris'].'/i', $git)) $git = 'index.php';
		elseif (@preg_match('/giris.php/i', $git)) $git = 'index.php';
		elseif ((@preg_match('/^http(s):\/\//i', $git)) AND (!@preg_match('/^http(s):\/\/'.$ayarlar['alanadi'].'/i', $git))) $git = 'index.php';
	}
	else $git = 'index.php';

	$git = @str_replace('veisareti', '&', $git);
	$git = zkTemizle($git);

	header('Location: '.$git);
	exit();
}
endif;


//  GİRİŞ YAPILIYOR  - SONU  //
//  GİRİŞ YAPILIYOR  - SONU  //
//  GİRİŞ YAPILIYOR  - SONU  //





// Giriş yapılmışsa yönetim ana sayfasına yönlendiriliyor

elseif ( (isset($_COOKIE['yonetim_kimlik'])) AND ($_COOKIE['yonetim_kimlik'] != '') ):

if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');

header('Location: index.php');
exit();





//  GİRİŞ YAPILMAMIŞSA GİRİŞ FORMUNU GÖSTER  //

else:

if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
$temadizini_cms = 'varsayilan';
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_YONETIM_DIL')) include_once('phpkf-bilesenler/diller/index.php');


$sayfa_adi = $l['giris'];
$tema_sayfa_baslik = $l['yonetim_giris'];



if (isset($_GET['git']))
{
	if (is_array($_GET['git'])) $_GET['git'] = '';
	$gelinen_adres = zkTemizle3($_GET['git']);
	$gelinen_adres = zkTemizle4($gelinen_adres);
	$gelinen_adres = @str_replace('//', '', $gelinen_adres);

	if ($gelinen_adres == '') $gelinen_adres = 'index.php';
	elseif ($gelinen_adres == 'portal') $gelinen_adres = '../portal/index.php';
	elseif ((@preg_match('/giris.php/', $gelinen_adres)) OR (@preg_match('/'.$phpkf_dosyalar['giris'].'/', $gelinen_adres))) $gelinen_adres = 'index.php';
}
else $gelinen_adres = '';


if (isset($kullanici_kim['kullanici_adi'])) $kulllanici_adi = $kullanici_kim['kullanici_adi'];
else $kulllanici_adi = '';



// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/giris.php'));

endif;

?>