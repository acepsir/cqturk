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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


//      FORM DOLDURULDUYSA      //

if ((isset($_POST['kayit_yapildi_mi'])) AND ($_POST['kayit_yapildi_mi'] == 'form_dolu')):


// zararlı kodlar temizleniyor
if (isset($_POST['kulad'])) $kulad = trim($_POST['kulad']);
if (isset($_POST['adsoyad'])) $adsoyad = trim($_POST['adsoyad']);
if (isset($_POST['posta'])) $posta = trim($_POST['posta']);
if (isset($_POST['sozcukler'])) $sozcukler = trim($_POST['sozcukler']);
if (isset($_POST['cumle'])) $cumle = trim($_POST['cumle']);
if (isset($_POST['yasak_ip'])) $yasak_ip = trim($_POST['yasak_ip']);



// kullanıcı adları için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $kulad);
$kulad = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	$yasak_bosluk[$d] = trim($yasak_bosluk[$d]);

	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($kulad != '') $kulad .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $kulad .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// ad soyad için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $adsoyad);
$adsoyad = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($adsoyad != '') $adsoyad .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $adsoyad .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// e-posta için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $posta);
$posta = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	$yasak_bosluk[$d] = trim($yasak_bosluk[$d]);

	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($posta != '') $posta .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $posta .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// sözcükler için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $sozcukler);
$sozcukler = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($sozcukler != '') $sozcukler .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $sozcukler .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// cümle için, 3 karakterden az sözcükler atılıyor
$yasak_bosluk = explode("\r\n", $cumle);
$cumle = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if ($cumle != '') $cumle .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $cumle .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}


// ip adresi için, 3 karakterden az adresler atılıyor
$yasak_bosluk = explode("\r\n", $yasak_ip);
$yasak_ip = '';
$yasak_sayi = count($yasak_bosluk);

for ($d=0,$a=0; $d < $yasak_sayi; $d++)
{
	if (strlen($yasak_bosluk[$d]) >= 3)
	{
		if (!preg_match('/^[0-9 .]+$/', $yasak_bosluk[$d])) continue;
		$yasak_bosluk[$d] = trim($yasak_bosluk[$d]);
		if ($yasak_ip != '') $yasak_ip .= "\r\n".@zkTemizle($yasak_bosluk[$d]);
		else $yasak_ip .= @zkTemizle($yasak_bosluk[$d]);
		$a++;
	}
}




//  BİLGİLER VERİTABANINA GİRİLİYOR  //

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$kulad' where etiket='kulad' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$adsoyad' where etiket='adsoyad' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$posta' where etiket='posta' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$sozcukler' where etiket='sozcukler' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$cumle' where etiket='cumle' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

$vtsorgu = "UPDATE $tablo_yasaklar SET deger='$yasak_ip' where etiket='yasak_ip' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


// güncellendi iletisi

header('Location: hatalar.php?bilgi=39');
exit();







//      SAYFA NORMAL GÖSTERİM  //

else:

//	YASAK KULLANICI ADLARI ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='kulad' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_kulad = $vt->fetch_row($yasak_sonuc);


//	YASAK POSTA ADRESLERİ ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='posta' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_posta = $vt->fetch_row($yasak_sonuc);


//	YASAK AD SOYADLAR ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='adsoyad' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_adsoyad = $vt->fetch_row($yasak_sonuc);


//	SANSÜRLENECEK SÖZCÜKLER ADRESLERİ ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='sozcukler' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_sozcukler = $vt->fetch_row($yasak_sonuc);


//	SANSÜR CÜMLESİ ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='cumle' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_cumle = $vt->fetch_row($yasak_sonuc);


//	YASAKLI IP ADRESLERİ ALINIYOR	//

$sorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='yasak_ip' LIMIT 1";
$yasak_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
$yasak_ip = $vt->fetch_row($yasak_sonuc);



// tema dosyası yükleniyor
$sayfa_adi = $ly['yasaklamalar'];
$tema_sayfa_baslik = $ly['yasaklamalar'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/yasaklamalar.php'));
endif;
?>