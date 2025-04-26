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


@session_start();
$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='2' OR kip='4'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('gerecler.php');
if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");


// ziyaretçi ip adresi alınıyor
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
else $ip = $_SERVER['REMOTE_ADDR'];
$ip = zkTemizle4($ip);
$ip = zkTemizle($ip);


//  BİLGİLERİ TEKRAR GİRMEYE GEREK KALMAMASI İÇİN OTURUMA KAYDEDİLİYOR  //

$_SESSION['ad_soyad'] = zkTemizle4($_POST['ad_soyad']);
$_SESSION['posta'] = zkTemizle4($_POST['posta']);
$_SESSION['baslik'] = zkTemizle4($_POST['baslik']);
$_SESSION['baslik2'] = zkTemizle4($_POST['baslik2']);


// onay kodu durumu
// 1: Açık
// 0: Kapalı
// Kullanılmazsa yönetimden ayarlanır
$ayarlar['kayit_onay_kodu'] = '1';

// onay kodu kapalı ise
if ($ayarlar['kayit_onay_kodu'] != '1')
{
	$_POST['onay_kodu'] = 'kapali';
	$_SESSION['onay_kodu'] = 'kapali';
}



// KAYIT ALANINDA EKSİK VARSA UYARILIYOR    //

if ( (!$_POST['ad_soyad']) or (!$_POST['posta']) )
{

	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=26');
	exit();

//  GÖRSEL ONAY KODU DOĞRU İSE DEVAM    //
}

elseif (strtolower($_POST['onay_kodu']) == strtolower($_SESSION['onay_kodu']))
{
	// KAYIT BİLGİLERİNİN DOĞRULUĞU DENETLENİYOR //

	if (!preg_match('/^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç. ]+$/', $_POST['ad_soyad']))
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=31');
		exit();
	}

	if (( strlen($_POST['ad_soyad']) > 20) or ( strlen($_POST['ad_soyad']) < 4))
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=32');
		exit();
	}

	if ($_POST['baslik'] == '0')
	{
		if (!preg_match('/^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç. ]+$/', $_POST['baslik2']))
		{
			header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=509');
			exit();
		}
		if (( strlen($_POST['baslik']) > 100) or ( strlen($_POST['baslik2']) < 4))
		{
			header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=510');
			exit();
		}
	}

	if ( strlen($_POST['posta']) > 70)
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=40');
		exit();
	}

	if (!preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['posta']))
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=10');
		exit();
	}

	if ( strlen($_POST['icerik']) < 10)
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=507');
		exit();
	}


	if ($_POST['durum'] == 'form_dolu')
	{
		$tarih = time();
		$ad_soyad = zkTemizle($_POST['ad_soyad']);
		$posta = zkTemizle($_POST['posta']);
		$baslik = zkTemizle($_POST['baslik']);
		$icerik = zkTemizle($_POST['icerik']);

		if($baslik == '0') $baslik = zkTemizle($_POST['baslik2']);

		$vtsorgu = "INSERT INTO $tablo_iletisim (ad_soyad, posta, baslik, icerik, ip, tarih)";
		$vtsorgu .= "VALUES ('$ad_soyad','$posta','$baslik','$icerik','$ip','$tarih')";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

		$posta_baslik = $ayarlar['site_adi'].' -> İletişim';
		$site_link = $TEMA_SITE_ANADIZIN.$phpkf_dosyalar['giris'];

		$posta_metni  = "Merhaba," . PHP_EOL . PHP_EOL;
		$posta_metni  = "Size $baslik konulu bir mesaj gönderildi." . PHP_EOL . PHP_EOL;
		$posta_metni .= "$icerik" . PHP_EOL . PHP_EOL;
		$posta_metni .= "Ad Soyad: $ad_soyad ; E-Posta Adresi: $posta." . PHP_EOL . PHP_EOL;
		$posta_metni .= "-------------------------------------------------------------------------------------------" . PHP_EOL . PHP_EOL;
		$posta_metni .= "Adres: $site_link" . PHP_EOL . PHP_EOL;
		$posta_metni .= "-------------------------------------------------------------------------------------------" . PHP_EOL . PHP_EOL;
		$posta_metni .= "Bu mesaj ".$ayarlar['site_adi']." İletişim Formu üzerinden size gönderildi.";

		$posta_metni = wordwrap( $posta_metni, 70 );

		require('sinif_eposta.php');
		$mail = new eposta_yolla();


		if ($ayarlar['eposta_yontem'] == 'mail') $mail->MailKullan();
		elseif ($ayarlar['eposta_yontem'] == 'smtp') $mail->SMTPKullan();


		$mail->sunucu = $ayarlar['smtp_sunucu'];
		if ($ayarlar['smtp_kd'] == '1') $mail->smtp_dogrulama = true;
		else $mail->smtp_dogrulama = false;
		$mail->kullanici_adi = $ayarlar['smtp_kullanici'];
		$mail->sifre = $ayarlar['smtp_sifre'];

		$mail->gonderen = $ayarlar['site_posta'];
		$mail->gonderen_adi = $ayarlar['site_adi'];

		$mail->GonderilenAdres($ayarlar['site_posta']);

		$mail->YanitlamaAdres($ayarlar['site_posta']);
		$mail->konu = $posta_baslik;
		$mail->icerik = $posta_metni;


		// Ayrıntılı hata açıksa, E-posta hatası
		if ( (!$mail->Yolla()) AND ($ayarlar['vt_hata'] == 1) )
		{
			echo '<br><br><center><h3><font color="red">E-posta gönderilemedi !<p><u>Hata iletisi</u>: &nbsp; ';
			echo $mail->hata_bilgi;
			echo '</p></font></h3></center>';
			exit();
		}
		else
		{
			header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=500');
			exit();
		}
	}
}


// Onay kodu hatalıysa
elseif (strtolower($_POST['onay_kodu']) != strtolower($_SESSION['onay_kodu']))
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=508');
	exit();
}
?>