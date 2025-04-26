<?php
/*
 +-=========================================================================-+
 |                              phpKF-CMS v3.00                              |
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


if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('kullanici_kimlik.php');
if (!defined('DOSYA_GERECLER')) include_once('gerecler.php');


// ziyaretçi ip adresi alınıyor
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
else $ip = $_SERVER['REMOTE_ADDR'];
$ip = zkTemizle4($ip);
$ip = zkTemizle($ip);



//  YORUM OLUŞTURMA İŞLEMLERİ  //

if ( (isset($_POST['dolu'])) AND ($_POST['dolu'] == 'dolu') ):


// Ziyaretçiler için yorum onay kodu işlemleri
if ( ($ayarlar['yorum_onay_kodu'] == '1') AND (!$TEMA_UYE_BILGI) )
{
	@session_start();
	if ( (!isset($_POST['onay_kodu'])) OR (is_array($_POST['onay_kodu'])) OR (!isset($_SESSION['onay_kodu'])) OR (@strtolower($_POST['onay_kodu']) != @strtolower($_SESSION['onay_kodu'])) )
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=508');
		exit();
	}
}

$tarih = time();

if ((isset($_POST['yazi_id'])) AND ($_POST['yazi_id'] != ''))
{
	$yazi_id = zkTemizleNumara($_POST['yazi_id']);

	if ($yazi_id == 0)
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=501');
		exit();
	}
}

else
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=501');
	exit();
}


// yazi_id kontrol ediliyor
$vtsorgu = "SELECT id FROM $tablo_yazilar WHERE id='$yazi_id' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$yazi = $vt->fetch_assoc($vtsonuc);


// yazı yoksa uyarı ver
if (!isset($yazi['id']))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=501');
	exit();
}


// üye ise son yorum tarihi kontrol ediliyor
if (isset($kullanici_kim['id']))
{
	if ($kullanici_kim['yetki'] == 1);

	elseif ( ($kullanici_kim['son_ileti']) > ($tarih - $ayarlar['yorum_sure']) )
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=6');
		exit();
	}
}


// ziyaretçi ise ad, soyad, eposta ve son yorum tarihi kontrol ediliyor
else
{
	if ( (!isset($_POST['adsoyad'])) OR ($_POST['adsoyad'] == '') )
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=502');
		exit();
	}

	if ( (!isset($_POST['posta'])) OR ($_POST['posta'] == '') )
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=503');
		exit();
	}

	if (!@preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['posta']))
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=10');
		exit();
	}

	if ((isset($_COOKIE['yorum'])) AND ($_COOKIE['yorum'] != ''))
	{
		if ( ($_COOKIE['yorum']) > ($tarih - $ayarlar['yorum_sure']) )
		{
			header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=6');
			exit();
		}
	}
}


if (@strlen($_POST['mesaj_baslik']) < 3)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=504');
	exit();
}

if (@strlen($_POST['mesaj_icerik']) < 3)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=504');
	exit();
}


// değişkenler temizleniyor
if ((isset($_POST['kat_id'])) AND ($_POST['kat_id'] != '')) $kat_id = zkTemizleNumara($_POST['kat_id']);
else $kat_id = 0;

if ((isset($_POST['yanitla'])) AND ($_POST['yanitla'] != '')) $yanitla = zkTemizleNumara($_POST['yanitla']);
else $yanitla = 0;


// magic_quotes_gpc açıksa
if (get_magic_quotes_gpc())
{
	$baslik = @ileti_yolla(stripslashes($_POST['mesaj_baslik']), 1);
	$icerik = @ileti_yolla(stripslashes($_POST['mesaj_icerik']), 2);
}

// magic_quotes_gpc kapalıysa
else
{
	$baslik = @ileti_yolla($_POST['mesaj_baslik'], 1);
	$icerik = @ileti_yolla($_POST['mesaj_icerik'], 2);
}




// yorum yazan üye ise
if (isset($kullanici_kim['id']))
{
	// üyenin yorum sayısı arttırılıyor ve son ileti tarihi giriliyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET mesaj_sayisi=mesaj_sayisi+1, son_ileti='$tarih' WHERE id='$kullanici_kim[id]' LIMIT 1";
	$vt_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

	$kullanici_id = $kullanici_kim['id'];
	$kullanici_adi = $kullanici_kim['kullanici_adi'].';'.$kullanici_kim['gercek_ad'];
	$posta = $kullanici_kim['posta'];
	$adsoyad = NULL;

	if ($kullanici_kim['yetki'] == 0)
	{
		if ($ayarlar['yorum_onay'] == 1) $onay = 1;
		else $onay = 0;
	}
	else $onay = 1;
}


// yorum yazan ziyaretçi ise
else
{
	$kullanici_id = 0;
	$kullanici_adi = @zkTemizle($_POST['adsoyad']);
	$posta = @zkTemizle($_POST['posta']);

	if ($ayarlar['yorum_onay'] == '0') $onay = 1;
	else $onay = 0;

	setcookie('yorum', $tarih, 0, $cerez_dizin, $cerez_alanadi);
	setcookie('adsoyad', $_POST['adsoyad'], 0, $cerez_dizin, $cerez_alanadi);
	setcookie('posta', $_POST['posta'], 0, $cerez_dizin, $cerez_alanadi);
}


if (isset($_POST['bbcode'])) $bbcode = 1;
else $bbcode = 0;

if (isset($_POST['ifade'])) $ifade = 1;
else $ifade = 0;



// Yorum veritabanına giriliyor
$vtsorgu = "INSERT INTO $tablo_yorumlar (tarih,yazan,yazan_id,yazan_ip,posta,yazi_id,kat_id,yanit,bbcode,ifade,onay,baslik,icerik)
VALUES('$tarih','$kullanici_adi','$kullanici_id','$ip','$posta','$yazi_id','$kat_id','$yanitla','$bbcode','$ifade','$onay','$baslik','$icerik')";
$vt_sonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

// yorum id'si alınıyor
$yorumid = $vt->insert_id();


// yanıt ise "yorumunun" yanit sayısı değiştiriliyor
if ($yanitla != 0)
{
	$vtsorgu = "UPDATE $tablo_yorumlar SET yanit=1 WHERE id='$yanitla' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
}


// Onaylı ise yazının yorum sayısı arttırılıyor
if ($onay == 1)
{
	$vtsorgu = "UPDATE $tablo_yazilar SET yorum_sayi=yorum_sayi+1 WHERE id='$yazi_id' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
}

// "onaysız yorum var" bildirimi giriliyor
else
{
	if (isset($kullanici_kim['id'])) $uye_id = $kullanici_kim['id'];
	else $uye_id = 0;

	$vtsorgu = "INSERT INTO $tablo_bildirimler (tarih,uye_id,seviye,tip,okundu,bildirim)";
	$vtsorgu .= "VALUES ('$tarih','$uye_id','1','5','0','$posta')";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}


// Bilgi iletisi ve geri yönlendirme
if ($onay == 1) header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=501');
else header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=502');
exit();




// FORM BOŞ İSE //

else:

header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=505');
exit();



endif;
?>