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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='4'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('gerecler.php');



//	GİRİŞ YAPILMIŞSA ANA SAYFAYA YÖNLENDİR	//

if (isset($_COOKIE['kullanici_kimlik']))
{
	header('Location: ../index.php');
	exit();
}



//	YENİ ŞİFRE TALEBİ YAPILIYORSA	//

if (isset($_POST['kayit_yapildi_mi']) and ($_POST['kayit_yapildi_mi'] == 'yeni_sifre')):

if ( (!isset($_POST['posta'])) OR (@strlen($_POST['posta']) ==  '') ):
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=8');
	exit();
endif;

if (@strlen($_POST['posta']) > 70):
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=40');
	exit();
endif;

if (!@preg_match('/^([~&+.0-9a-z_-]+)@(([~&+0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $_POST['posta'])):
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=10');
	exit();
endif;



//	FORM DOĞRU DOLDURULDUYSA İŞLEMLERE DEVAM	//

$_POST['posta'] = @zkTemizle($_POST['posta']);


//	E-POSTA ADRESİNİN DOĞRULUĞU KONTROL EDİLİYOR	//

$vtsorgu = "SELECT id,posta,kullanici_adi,kul_etkin,engelle FROM $tablo_kullanicilar WHERE posta='$_POST[posta]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


// girilen e-posta doğruysa

if ($vt->num_rows($vtsonuc)):
$yeni_sifre = $vt->fetch_array($vtsonuc);


// hesap etkinleştirilmemişse uyarılıyor

if ($yeni_sifre['kul_etkin'] != 1)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=23');
	exit();
}


// hesap engellenmişse uyarılıyor

if ($yeni_sifre['engelle'] == 1)
{
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=24');
	exit();
}


//	YENİ ŞİFRE OLUŞTURULUP VERİTABANINA GİRİLİYOR	//

$rastgele = rand(1111111,9999999);

$vtsorgu = "UPDATE $tablo_kullanicilar SET yeni_sifre='$rastgele' WHERE posta='$_POST[posta]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());



//		POSTALAR/YENI_SIFRE.TXT DOSYASINDAKİ YAZILAR ALINIYOR...		//
//		... BELİRTİLEN YERLERE YENİ BİLGİLER GİRİLİYOR		// 


$site_link = $TEMA_SITE_ANADIZIN.'phpkf-bilesenler/yeni_sifre.php?kulid='.$yeni_sifre['id'].'&ys=';

if (!($dosya_ac = fopen('./postalar/yeni_sifre.txt','r'))) die ('Dosya Açılamıyor');
$posta_metni = fread($dosya_ac,1024);
fclose($dosya_ac);


$bul = array('{siteadi}',
'{kullanici_adi}',
'{sifre_sifirlama_link}',
'{sifre_sifirlama_iptal_link}',
);

$cevir = array($ayarlar['site_adi'],
$yeni_sifre['kullanici_adi'],
$site_link.$rastgele,
$site_link.'iptal',
);

$posta_metni = str_replace($bul,$cevir,$posta_metni);


//	YENİ ŞİFRE TALEBİ BİLGİLERİ POSTALANIYOR		//

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
$mail->GonderilenAdres($yeni_sifre['posta']);
$mail->YanitlamaAdres($ayarlar['site_posta']);

$mail->konu = $ayarlar['site_adi'].' - Yeni Şifre Başvurusu';
$mail->icerik = $posta_metni;


if ($mail->Yolla())
{
	// YENİ ŞİFRE TALEBİ TAMAMLANDI, EKRAN ÇIKTISI VERİLİYOR //

	header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=20');
	exit();
}

else
{
	header("Content-type: text/html; charset=utf-8");
	echo '<!DOCTYPE html><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><body>
<br><br><center><h3><font color="red">E-posta gönderilemedi !<p><u>Hata iletisi</u>: &nbsp; ';
	echo $mail->hata_bilgi;
	echo '</p></font></h3></center></body></html>';

	exit();
}

//	GİRİLEN E-POSTA VERİTABANINDA YOKSA 	//

else:
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=13');
	exit();
endif;










//	YENİ ŞİFRE OLUŞTUR DÜĞMESİ TIKLANMIŞSA	//


elseif (isset($_POST['kayit_yapildi_mi']) AND ($_POST['kayit_yapildi_mi'] == 'sifre_olustur')):

if (!defined('DOSYA_AYAR')) include 'ayar.php';
if (!defined('DOSYA_GERECLER')) include 'gerecler.php';


$_POST['kulid'] = zkTemizle($_POST['kulid']);
$_POST['ys'] = zkTemizle($_POST['ys']);


//	KULID VE YENİ ŞİFRENİN DOĞRULUĞU KONTROL EDİLİYOR	//	

if ( (strlen($_POST['ys']) != 7) OR (!is_numeric($_POST['ys'])) OR (!is_numeric($_POST['kulid'])) ):
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=96');
	exit();
endif;


$vtsorgu = "SELECT id FROM $tablo_kullanicilar WHERE id='$_POST[kulid]' AND yeni_sifre='$_POST[ys]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

if (!$vt->num_rows($vtsonuc)):
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=96');
	exit();
endif;


//	FORM BİLGİLERİ DENETLENİYOR	//

if ((@strlen($_POST['y_sifre1']) > 20) OR (@strlen($_POST['y_sifre1']) < 5)):
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=20');
	exit();
endif;

if (!@preg_match('/^[A-Za-z0-9-_.&]+$/', $_POST['y_sifre1'])):
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=34');
	exit();
endif;

if ($_POST['y_sifre1'] != $_POST['y_sifre2']):
	header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=33');
	exit();
endif;


//	FORM DOĞRU DOLDURULDUYSA İŞLEMLERE DEVAM	//
//	YENİ ŞİFRE ANAHTAR DEĞİŞKENİNDE KULUNAN DEĞER KARIŞTIRILIP SHA1 İLE ŞİFRELENİYOR	//


$_POST['y_sifre1'] = @zkTemizle($_POST['y_sifre1']);

$karma = sha1(($anahtar.$_POST['y_sifre1']));

$vtsorgu  = "UPDATE $tablo_kullanicilar SET sifre='$karma', yeni_sifre='0' WHERE id='$_POST[kulid]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=21');
exit();












else :


if ( (isset($_GET['kulid'])) AND (isset($_GET['ys'])) AND ($_GET['ys'] == 'iptal')  )
{
	if (!defined('DOSYA_AYAR')) include 'ayar.php';
	if (!defined('DOSYA_GERECLER')) include 'gerecler.php';


	if (!is_numeric($_GET['kulid']))
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=96');
		exit();
	}


	$_GET['kulid'] = @zkTemizle($_GET['kulid']);


	$vtsorgu = "UPDATE $tablo_kullanicilar SET yeni_sifre='0' WHERE id='$_GET[kulid]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	header('Location: ../'.$phpkf_dosyalar['hata'].'?bilgi=22');
	exit();
}



//	KULID VE YENİ ŞİFRENİN DOĞRULUĞU KONTROL EDİLİYOR - SAYAYA GİRİŞ SIRASINDA	//

if ( (isset($_GET['kulid'])) AND (isset($_GET['ys'])) )
{
	if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
	if (!defined('DOSYA_GERECLER')) include_once('gerecler.php');
	@session_start();


	//	yeni şifre deneme sayısı arttırılıyor	//

	if (empty($_SESSION['yenisifre_deneme'])) $_SESSION['yenisifre_deneme'] = 1;
	else $_SESSION['yenisifre_deneme']++;

	$_GET['kulid'] = @zkTemizle($_GET['kulid']);
	$_GET['ys'] = @zkTemizle($_GET['ys']);


	//  bilgiler hatalıysa  //

	if ( (strlen($_GET['ys']) !=  7) OR (!is_numeric($_GET['ys'])) OR (!is_numeric($_GET['kulid'])) )
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=96');
		exit();
	}


	//	kayıt denemesi beşe ulaştığında hata iletisi veriliyor	//

	if ($_SESSION['yenisifre_deneme'] > 5)
	{
		$vtsorgu = "UPDATE $tablo_kullanicilar SET yeni_sifre='0' WHERE id='$_GET[kulid]' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=97');
		exit();
	}


	$vtsorgu = "SELECT id FROM $tablo_kullanicilar WHERE id='$_GET[kulid]' AND yeni_sifre='$_GET[ys]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if (!$vt->num_rows($vtsonuc))
	{
		header('Location: ../'.$phpkf_dosyalar['hata'].'?hata=96');
		exit();
	}


	header('Location: ../'.$phpkf_dosyalar['giris'].'?kip=yeni_sifre&kulid='.$_GET['kulid'].'&ys='.$_GET['ys']);
	exit();
}

endif;

?>