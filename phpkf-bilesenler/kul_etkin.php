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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='2'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('gerecler.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('kullanici_kimlik.php');


//	FORM DOLU DEĞİLSE UYAR		//

if ( (empty($_GET['kulid'])) OR (empty($_GET['kulkod'])) OR ($_GET['kulkod'] == '0') ):
header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=48');
exit();




// E-POSTA ONAYI İŞLEMLERİ  //

elseif ( (isset($_GET['onay'])) AND ($_GET['onay'] == 'eposta') ):


if (!is_numeric($_GET['kulid']))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=49');
	exit();
}


if (( strlen($_GET['kulkod']) != 10))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=49');
	exit();
}


$_GET['kulid'] = zkTemizleNumara($_GET['kulid']);
$_GET['kulkod'] = zkTemizle($_GET['kulkod']);


//	KUL ID İLE KUL KOD VERİTABANINDAKİ İLE KARŞILAŞTIRIYOR //

$vtsorgu = "SELECT posta2,kul_etkin_kod FROM $tablo_kullanicilar WHERE id='$_GET[kulid]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$etkin_mi = $vt->fetch_assoc($vtsonuc);


// YENİ E-POSTA YOKSA   //

if ($etkin_mi['posta2'] == '')
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=49');
	exit();
}


//	KUL ID İLE KUL KOD UYUŞMUYORSA	//

elseif ($etkin_mi['kul_etkin_kod'] != $_GET['kulkod'])
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=49');
	exit();
}


//  SORUN YOK İŞLEM GERÇEKLEŞTİRİLİYOR  //

else
{
	$vtsorgu = "UPDATE $tablo_kullanicilar SET posta='$etkin_mi[posta2]',kul_etkin_kod='0',posta2='' WHERE id='$_GET[kulid]'";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=45');
	exit();
}





//	GİRİŞ YAPILMIŞSA ANA SAYFAYA YÖNLENDİR	//

elseif ( isset($kullanici_kim['id']) ):
header('Location: ../'.$phpkf_dosyalar['forum']);
exit();




// HESAP ETKİNLEŞTİRME İŞLEMLERİ    //

else:

if (!is_numeric($_GET['kulid']))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=49');
	exit();
}


if (( strlen($_GET['kulkod']) != 10))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=49');
	exit();
}


$_GET['kulid'] = zkTemizle($_GET['kulid']);
$_GET['kulkod'] = zkTemizle($_GET['kulkod']);


//	KUL ID İLE KUL KOD VERİTABANINDAKİ İLE KARŞILAŞTIRIYOR //

$vtsorgu = "SELECT kul_etkin,kul_etkin_kod FROM $tablo_kullanicilar WHERE id='$_GET[kulid]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$etkin_mi = $vt->fetch_assoc($vtsonuc);


//	KUL ID İLE KUL KOD UYUŞMUYORSA	//

if ($etkin_mi['kul_etkin'] == 1)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=18');
	exit();
}

elseif ($etkin_mi['kul_etkin_kod'] != $_GET['kulkod'])
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=49');
	exit();
}

// yönetici onaylı hesap etkinleştir için e-posta onayı
else
{
	if ($ayarlar['kayit_hesap_etkin'] != 2)
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET kul_etkin='1',kul_etkin_kod='0' WHERE id='$_GET[kulid]'";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=19');
		exit();
	}


	else
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET kul_etkin_kod='0' WHERE id='$_GET[kulid]'";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=51');
		exit();
	}
}endif;
?>