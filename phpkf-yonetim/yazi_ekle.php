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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5' OR kip='6'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


// yazı, galeri, video tip seçimi belirleniyor
$ktip = '0';
$itip = 'yazi';
$diger_kategoriler = '<b>'.$lymenu['yazi_ekle'].'</b>
<br><a href="yazi_ekle.php?ktip=1">'.$lymenu['galeri_ekle'].'</a>
<br><a href="yazi_ekle.php?ktip=2">'.$lymenu['video_ekle'].'</a>';

if (isset($_GET['ktip']))
{
	if ($_GET['ktip'] == '1')
	{
		$ktip = 1;
		$itip = 'galeri';
		$diger_kategoriler = '<a href="yazi_ekle.php">'.$lymenu['yazi_ekle'].'</a>
		<br><b>'.$lymenu['galeri_ekle'].'</b>
		<br><a href="yazi_ekle.php?ktip=2">'.$lymenu['video_ekle'].'</a>';
	}
	elseif ($_GET['ktip'] == '2')
	{
		$ktip = 2;
		$itip = 'video';
		$diger_kategoriler = '<a href="yazi_ekle.php">'.$lymenu['yazi_ekle'].'</a>
		<br><a href="yazi_ekle.php?ktip=1">'.$lymenu['galeri_ekle'].'</a>
		<br><b>'.$lymenu['video_ekle'].'</b>';
	}
}


// Sayfa Düzenleme Tıklanmışsa
$disable = '';
$SefYapYazi = 'onkeyup="SefYapYazi(this.value)"';

if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'duzenle'))
{
	if (isset($_GET['y'])) $yaziid = @zkTemizle($_GET['y']);
	else $yaziid = 0;

	if ( (!is_numeric($yaziid)) OR ($yaziid == 0) )
	{
		header('Location: hatalar.php?hata=4');
		exit();
	}

	// yazının bilgileri veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_yazilar WHERE id='$yaziid' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yazi = $vt->fetch_assoc($vtsonuc);

	if (!isset($yazi['id']))
	{
		header('Location: hatalar.php?hata=4');
		exit();
	}


	$yazi_duzenle = '<input type="hidden" name="duzenle" value="'.$yazi['id'].'" />';
	$yazi_baslik = $yazi['baslik'];
	$yazi_adres = $yazi['adres'];
	$yazi_etiket = $yazi['etiket'];
	$yazi_icerik = $yazi['icerik'];
	$tip = $yazi['tip'];
	$yorum = $yazi['yorum_durum'];
	$katid = $yazi['kategori'];

	if ($yazi['alt_yazi'] == '0') $alt_yazi = '';
	else $alt_yazi = $yazi['alt_yazi'];
	if ($yazi['sayfa_no'] == '0') $yazi_no = '';
	else $yazi_no = $yazi['sayfa_no'];

	$tarih_hemen = '';
	$tarih_gun = zaman('d', $ayarlar['saat_dilimi'], false, $yazi['yayin_tarihi'], 0, false);
	$tarih_ay = zaman('m', $ayarlar['saat_dilimi'], false, $yazi['yayin_tarihi'], 0, false);
	$tarih_yil = zaman('Y', $ayarlar['saat_dilimi'], false, $yazi['yayin_tarihi'], 0, false);
	$tarih_saat = zaman('H', $ayarlar['saat_dilimi'], false, $yazi['yayin_tarihi'], 0, false);
	$tarih_dakika = zaman('i', $ayarlar['saat_dilimi'], false, $yazi['yayin_tarihi'], 0, false);


	// Dil ekleme denetleniyor
	if ((isset($_GET['dil_ekle'])) AND ($_GET['dil_ekle'] != ''))
	{
		$dil_ekle = zkTemizle(BoslukSil($_GET['dil_ekle']));
		if (($dil_ekle == '') OR (!preg_match("/,$dil_ekle,/is", $ayarlar['dil_eklenen']))) $dil_ekle = '';
	}
	else $dil_ekle = '';


	// Sayfa başlık
	if ($ktip == '1')
	{
		$sayfa_adi = $ly['galeri_duzenleme'];
		$yeni_duzenle = $ly['galeri_duzenleme'];
	}
	elseif ($ktip == '2')
	{
		$sayfa_adi = $ly['video_duzenleme'];
		$yeni_duzenle = $ly['video_duzenleme'];
	}
	else
	{
		$sayfa_adi = $ly['yazi_duzenleme'];
		$yeni_duzenle = $ly['yeni_yazi_ve_sayfa_duzenleme'];
	}


	// Farklı dilde yazı ekleme
	if ($dil_ekle != '')
	{
		$yazi_duzenle .= '<input type="hidden" name="dil_ekle" value="'.$dil_ekle.'" />';
		$yazi_etiket = $yazi['etiket_'.$dil_ekle];
		$yazi_baslik = $yazi['baslik_'.$dil_ekle];
		$yazi_icerik = $yazi['icerik_'.$dil_ekle];
		$disable = ' disabled="disable" style="cursor:not-allowed"';
		//$SefYapYazi = '';
		$sayfa_adi = $diller[$dil_ekle].' '.$ly['icerik_ekle'];
		$yeni_duzenle = $diller[$dil_ekle].' '.$ly['icerik_ekle'];
	}
}



// Alt Sayfa Ekleme Tıklanmışsa

elseif ((isset($_GET['kip'])) AND ($_GET['kip'] == 'altyazi'))
{
	if (isset($_GET['y'])) $yaziid = @zkTemizle($_GET['y']);
	else $yaziid = 0;

	if ( (!is_numeric($yaziid)) OR ($yaziid == 0) )
	{
		header('Location: hatalar.php?hata=4');
		exit();
	}


	// yazının bilgileri veritabanından çekiliyor
	$vtsorgu = "SELECT id,baslik,adres,kategori,etiket FROM $tablo_yazilar WHERE id='$yaziid' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yazi = $vt->fetch_assoc($vtsonuc);

	// sayfa yoksa hata ver
	if (!isset($yazi['id']))
	{
		header('Location: hatalar.php?hata=4');
		exit();
	}


	// yazının en son alt sayfası numarası alınıyor
	$vtsorgu = "SELECT id,sayfa_no FROM $tablo_yazilar WHERE alt_yazi='$yaziid' ORDER BY sayfa_no DESC LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$yazino = $vt->fetch_assoc($vtsonuc);

	if (isset($yazino['sayfa_no'])) $yazi_no = $yazino['sayfa_no']+1;
	else $yazi_no = 2;

	$yazi_duzenle = '';
	$alt_yazi = $yazi['id'];
	$yazi_baslik = $yazi['baslik'].': Sayfa '.$yazi_no;
	$yazi_adres = $yazi['adres'].'-'.$yazi_no;
	$yazi_etiket = $yazi['etiket'];
	$yazi_icerik = '';
	$tip = 0;
	$yorum = 1;
	$katid = $yazi['kategori'];

	$tarih = time();
	$tarih_hemen = 'checked="checked"';
	$tarih_gun = zaman('d', $ayarlar['saat_dilimi'], false, $tarih, 0, false);
	$tarih_ay = zaman('m', $ayarlar['saat_dilimi'], false, $tarih, 0, false);
	$tarih_yil = zaman('Y', $ayarlar['saat_dilimi'], false, $tarih, 0, false);
	$tarih_saat = zaman('H', $ayarlar['saat_dilimi'], false, $tarih, 0, false);
	$tarih_dakika = zaman('i', $ayarlar['saat_dilimi'], false, $tarih, 0, false);

	if ($ktip == '1')
	{
		$sayfa_adi = $ly['yeni_galeri_ekle'];
		$yeni_duzenle = $ly['yeni_galeri_ekle'];
	}
	elseif ($ktip == '2')
	{
		$sayfa_adi = $ly['yeni_video_ekle'];
		$yeni_duzenle = $ly['yeni_video_ekle'];
	}
	else
	{
		$sayfa_adi = $ly['yeni_yazi_ekle'];
		$yeni_duzenle = $ly['yeni_yazi_ve_sayfa_ekle'];
	}
}


else
{
	$yazi_duzenle = '';
	$yazi_baslik = '';
	$yazi_adres = '';
	$yazi_etiket = '';
	$yazi_icerik = '';
	if ((isset($_GET['kip'])) AND ($_GET['kip'] == 'iletisim')) $tip = 3;
	else $tip = 2;
	$yorum = 1;
	$alt_yazi = '';
	$yazi_no = '';

	$tarih = time();
	$tarih_hemen = 'checked="checked"';
	$tarih_gun = zaman('d', $ayarlar['saat_dilimi'], false, $tarih, 0, false);
	$tarih_ay = zaman('m', $ayarlar['saat_dilimi'], false, $tarih, 0, false);
	$tarih_yil = zaman('Y', $ayarlar['saat_dilimi'], false, $tarih, 0, false);
	$tarih_saat = zaman('H', $ayarlar['saat_dilimi'], false, $tarih, 0, false);
	$tarih_dakika = zaman('i', $ayarlar['saat_dilimi'], false, $tarih, 0, false);

	if ($ktip == '1')
	{
		$sayfa_adi = $ly['yeni_galeri_ekle'];
		$yeni_duzenle = $ly['yeni_galeri_ekle'];
	}
	elseif ($ktip == '2')
	{
		$sayfa_adi = $ly['yeni_video_ekle'];
		$yeni_duzenle = $ly['yeni_video_ekle'];
	}
	else
	{
		$sayfa_adi = $ly['yeni_yazi_ekle'];
		$yeni_duzenle = $ly['yeni_yazi_ve_sayfa_ekle'];
	}
}


// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/yazi_ekle.php'));

?>