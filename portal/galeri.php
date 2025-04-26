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


	define('DOSYA_PORTAL_GALERI',true);
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include 'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';

	$sayfa_adi = 'Resim Galerisi';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/galeri.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));


    $_POST['gd'] = @zkTemizle($_POST['gd']);
    if (is_numeric($_POST['gd']) == false) $_POST['gd'] = 0;


	// RESİM SİLİNİYOR //
	if ($kosul == 'resim_sil')
	{

	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1):


	// RESİMİ SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR //
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?gd='.$_POST['gd'],
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// RESİMİ SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR - SONU //

		// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?gd='.$_POST['gd'],
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	else
	{	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //
	
	
	if (is_numeric($_GET['no']) == true) $_GET['no'] = @zkTemizle($_GET['no']);
	else $_GET['no'] = 0;

	$sorgu = "SELECT sifrelenmis_resim_adi FROM $tablo_portal_galeri WHERE no='$_GET[no]' LIMIT 1";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	$vtsonuc = $vt->fetch_assoc($sorgu_sonuc);

	// BÖYLE BİR RESİM YOKSA UYARILIYOR //
	if (!$vt->num_rows($sorgu_sonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_295,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));

	exit();
	}
	// BÖYLE BİR RESİM YOKSA UYARILIYOR - SONU //


	// RESİM VARSA SİLİNİYOR //
	@unlink('galeri/'.$vtsonuc['sifrelenmis_resim_adi'].'');

	$sil_sorgu = "DELETE FROM $tablo_portal_galeri WHERE no='$_GET[no]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'galeri.php?gd='.$_GET['gd'],
	'{ILETI}' => $kp_dil_298,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=galeri.php?gd='.$_GET['gd'].'">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();

	// RESİM VARSA SİLİNİYOR - SONU //

	// GALERİ ÖZELLİĞİ KAPALIYSA UYARI VERİLİYOR //
	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();

	endif;	
	// GALERİ ÖZELLİĞİ KAPALIYSA UYARI VERİLİYOR - SONU //

	}	
	// RESİM SİLİNİYOR - SONU//

	// RESİM'E PUAN VERİLİYOR //
	if ($kosul == 'puan_ver')
	{


	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1):


	if (is_numeric($_GET['no']) == true) $_GET['no'] = @zkTemizle($_GET['no']);
	else $_GET['no'] = 0;

	$vtsorgu33 =   "SELECT puan_verenler,no FROM $tablo_portal_galeri  where no='$_GET[no]' AND puan_verenler like '%,$kullanici_kim[id],%'";
	$puanverenler = $vt->query($vtsorgu33) or die ($vt->hata_ver());

	// DAHA ÖNCE PUAN VERMİŞSE UYARILIYOR //
	if ((!$puanveren = $vt->num_rows($puanverenler)) == 0)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => 'Daha Önce Oy Kullanmışsınız.',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));

	exit();	
	}
	// DAHA ÖNCE PUAN VERMİŞSE UYARILIYOR -SONU //

	// PUAN VERMEYE ÇALIŞAN KİŞİ ZİYARETCİYSE UYARILIYOR //
	if (empty($kullanici_kim['id']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_296,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// PUAN VERMEYE ÇALIŞAN KİŞİ ZİYARETCİYSE UYARILIYOR - SONU //

	// VERİTABANINA PUAN VE ÜYE ID KAYDEDİLİYOR //

	$vtsorgu = "UPDATE $tablo_portal_galeri SET puan=puan +1 where no='$_GET[no]' LIMIT 1";
	$vtsonuc6 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');

	unset($vtsorgu);
	unset($vtsonuc6);
	unset($vtsonuc7);

	$vtsorgu = "Select puan_verenler from $tablo_portal_galeri where no='$_GET[no]'";
	$vtsonuc6 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');
	$vtsonuc7 = $vt->fetch_assoc($vtsonuc6);

	$kul_id = $kullanici_kim['id'].',';

	unset($vtsorgu);
	unset($vtsonuc6);
	unset($vtsonuc7);

	$vtsorgu = "UPDATE $tablo_portal_galeri SET puan_verenler=CONCAT(puan_verenler,'$kul_id') where no='$_GET[no]' LIMIT 1";
	$vtsonuc6 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');
	// VERİTABANINA PUAN VE ÜYE ID KAYDEDİLİYOR  - SONU //

	// BİLGİ İLETİSİ EKRANA YAZDIRILIYOR //
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'galeri.php?gd='.$_GET['gd'],
	'{ILETI}' => $kp_dil_297,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=galeri.php?gd='.$_GET['gd'].'">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	// BİLGİ İLETİSİ EKRANA YAZDIRILIYOR - SONU //

	// GALERİ ÖZELLİĞİ YOKSA ÜYE UYARILIYOR //
	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	// GALERİ ÖZELLİĞİ YOKSA ÜYE UYARILIYOR - SONU //


	}
	// RESİM'E PUAN VERİLİYOR - SONU //


	// RESİM YÜKLENİYOR //
	if ($kosul == 'resim_yukle')
	{


	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1):

	// RESİM YÜKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR //
	if (empty($kullanici_kim['id']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './giris.php?git=giris',
	'{ILETI}' => $kp_dil_308,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__4,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// RESİM YÜKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR - SONU //




	if (isset($_POST['yukle']) AND ($_POST['yukle'] != '') )
	{

	// RESİM KONTROL BAŞLIYOR //
	if ((isset($_FILES['yukle']['tmp_name'])) AND ($_FILES['yukle']['tmp_name'] != '') )
	{
	list($genislik, $yukseklik, $tip) = @getimagesize($_FILES['yukle']['tmp_name']);

	if ( (isset($tip)) AND ($tip == 2) )
	{
	$uzanti = '.jpg';

	if ( !@imagecreatefromjpeg($_FILES['yukle']['tmp_name']) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => $kp_dil_280,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}

	elseif ( (isset($tip)) AND ($tip == 1) )
	{
	$uzanti = '.gif';

	if ( !@imagecreatefromgif ($_FILES['yukle']['tmp_name']) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => $kp_dil_280,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}

	elseif ( (isset($tip)) AND ($tip == 3) )
	{
	$uzanti = '.png';

	if ( !@imagecreatefrompng($_FILES['yukle']['tmp_name']) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => $kp_dil_280,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}

	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => $kp_dil_281,
	'{EK_YAZI}' => $kp_dil_282,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}



	if ($_FILES['yukle']['size'] > $portal_ayarlar['galeri_kb'])
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => ''.$kp_dil_283.' '.($portal_ayarlar['galeri_kb'] / 1024).' '.$kp_dil_284.'',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// RESİM KONTROL BAŞLIYOR - SONU //



	// RESİME YENİ İSİM ATANIYOR //
	$g_resim_adi = rand(1111111111, 9999999999).$uzanti;

	$dosya_yolu2 = './galeri/'.$g_resim_adi;
	$dosya_yolu = 'http://'.$ayarlar['alanadi'].$ayarlar['f_dizin'].'/portal/galeri/'.$g_resim_adi;

	// resim boyutu ayarlanıyor.
	$resim_boyutu = ($_FILES['yukle']['size'] / 1024);
	$tam_boyut = mb_substr($resim_boyutu,0,5, 'utf-8').'&nbsp;kb.';


	// RESİM YÜKLENİRKEN HATA OLUŞURSA BİLGİ VERİLİYOR //
	if ( !@move_uploaded_file($_FILES["yukle"]["tmp_name"],$dosya_yolu2) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_dil_285,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => $kp_dil_286,
	'{EK_YAZI}' => $kp_dil_287,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// RESİM YÜKLENİRKEN HATA OLUŞURSA BİLGİ VERİLİYOR - SONU //

	}
	elseif (isset($_POST['ekle']) AND ($_POST['ekle'] != '') AND ($portal_ayarlar['resim_ekleme'] == '1'))
	{

	$g_resim_adi = null;

	// ZARARLI KARAKTERLER TEMİZLENİYOR //
	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$resim_adres = @ileti_yolla(stripslashes($_POST['ekle']),1);

	// magic_quotes_gpc kapalıysa //
	else $resim_adres = @ileti_yolla($_POST['ekle'],1);

	if ( (!@getimagesize($resim_adres)) AND (preg_match('/^http:\/\//i', $resim_adres))
	OR (!@getimagesize($resim_adres)) AND (preg_match('/^ftp:\/\//i', $resim_adres)) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_423,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	list($genislik, $yukseklik, $tip) = @getimagesize($resim_adres);

	if ( (isset($tip)) AND ($tip == 2) )
	{
	if ( !@imagecreatefromjpeg($resim_adres) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_424,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}

	elseif ( (isset($tip)) AND ($tip == 1) )
	{
	if ( !@imagecreatefromgif ($resim_adres) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_424,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}

	elseif ( (isset($tip)) AND ($tip == 3) )
	{
	if ( !@imagecreatefrompng($resim_adres) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_424,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}

	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_425,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	$resim_dosya = @file_get_contents($resim_adres);
	$resim_boyut = @round((strlen($resim_dosya)),2);
	$tam_boyut = mb_substr(($resim_boyut / 1024),0,5, 'utf-8').'&nbsp;kb.';

	if ($resim_boyut > ($portal_ayarlar['galeri_kb']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_426.' '.($portal_ayarlar['galeri_kb'] / 1024).' '.$kp_dil_284,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	$dosya_yolu = $resim_adres;

	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_416,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	 // ZARARLI KARAKTERLER TEMİZLENİYOR //
    // magic_quotes_gpc açıksa //
    if (get_magic_quotes_gpc())
    {
        $_POST['resim_adi'] = @ileti_yolla(stripslashes($_POST['resim_adi']),1);
        $_POST['aciklama'] = @ileti_yolla(stripslashes($_POST['aciklama']),2);
    }

    // magic_quotes_gpc kapalıysa //
    else
    {
        $_POST['resim_adi'] = @ileti_yolla($_POST['resim_adi'],1);
        $_POST['aciklama'] = @ileti_yolla($_POST['aciklama'],2);
    }
	// ZARARLI KARAKTERLER TEMİZLENİYOR - SONU //

	// GELEN DAL NOSU NÜMERİK DEĞİLSE DEĞERİ 0 YAPILIYOR //
	if (is_numeric($_POST['gd']) == true) $_POST['gd'] = @zkTemizle($_POST['gd']);
	else $_POST['gd'] = 0;


	$tarih = time(); // tarih bilgisi alınıyor.

	if ($kullanici_kim['yetki'] == 1) $resim_onay = '1'; // resmi yükleyen yöneticiyse resim onaylanıyor.
	else $resim_onay = '0'; // resmi yükleyen yöneti değilse resim onaylanmıyor.

	
	/* RESIM ADI VE AÇIKLAMASI BEKLENEN KARAKTERDEN FAZLAYSA VEYA AZ İSE UYARI VERİLİYOR */
	if ((strlen($_POST['aciklama']) < 3) OR (strlen(utf8_decode($_POST['aciklama'])) > 200) OR (strlen($_POST['resim_adi']) < 3) OR (strlen(utf8_decode($_POST['resim_adi'])) > 30))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => $kp_dil_309,
	'{EK_YAZI}' => $kp_dil_310,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	/* RESIM ADI VE AÇIKLAMASI BEKLENEN KARAKTERDEN FAZLAYSA VEYA AZ İSE UYARI VERİLİYOR - SONU */

	// RESİM VERİTABANINA KAYDEDİLİYOR //
	$vtsorgu = "INSERT INTO $tablo_portal_galeri (id, tarih, aciklama, ekleyen, isim, resim, resim_onay, boyut, sifrelenmis_resim_adi,puan_verenler,resim_genislik,resim_yukseklik)";

	$vtsorgu .= "VALUES ('$_POST[gd]','$tarih','$_POST[aciklama]','$kullanici_kim[kullanici_adi]','$_POST[resim_adi]','$dosya_yolu','$resim_onay', '$tam_boyut', '$g_resim_adi',',','$genislik','$yukseklik')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');
	// RESİM VERİTABANINA KAYDEDİLİYOR - SONU //


	// BİLGİ İLETİSİ YAZDIRILIYOR YETKİYE GÖRE //
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_288,
	'{EK_YAZI}' => $kp_dil_289,
	'{YONLENDIRME}' => $kp_dil_290 ,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	}

	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_291,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=galeri.php">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	}
	// BİLGİ İLETİSİ YAZDIRILIYOR YETKİYE GÖRE - SONU //

	}
	else
	{  
	// RESİM YÜKLENEMEZ'SE UYARI VERİLİYOR //
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => $kp_dil_292,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	}
	exit();
	// RESİM YÜKLENEMEZ'SE UYARI VERİLİYOR - SONU //

	else:
	// GALERİ ÖZELLİĞİ KAPALIYSA UYARI VERİLİYOR //

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();

	endif;
	// GALERİ ÖZELLİĞİ KAPALIYSA UYARI VERİLİYOR - SONU //

	}

	// RESİM YÜKLENİYOR - SONU //

	// RESİM DEĞİŞTİRİLİYOR  //
	if ($kosul == 'resim_degistir')
	{

	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1):


	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}



	 // ZARARLI KARAKTERLER TEMİZLENİYOR //
    // magic_quotes_gpc açıksa //
    if (get_magic_quotes_gpc())
    {
        $_POST['resim_adi'] = @ileti_yolla(stripslashes($_POST['resim_adi']),1);
        $_POST['aciklama'] = @ileti_yolla(stripslashes($_POST['aciklama']),2);
    }

    // magic_quotes_gpc kapalıysa //
    else
    {
        $_POST['resim_adi'] = @ileti_yolla($_POST['resim_adi'],1);
        $_POST['aciklama'] = @ileti_yolla($_POST['aciklama'],2);
    }

	if (is_numeric($_POST['gd']) == true) $_POST['gd'] = @zkTemizle($_POST['gd']);
	else $_POST['gd'] = 0;

	if ((strlen($_POST['aciklama']) < 3) OR (strlen(utf8_decode($_POST['aciklama'])) > 201) OR (strlen($_POST['resim_adi']) < 3) OR (strlen(utf8_decode($_POST['resim_adi'])) > 31))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php?kosul=resim_ekle',
	'{ILETI}' => $kp_dil_309,
	'{EK_YAZI}' => $kp_dil_310,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	$vtsorgu = "UPDATE $tablo_portal_galeri SET id='$_POST[gd]',aciklama='$_POST[aciklama]',isim='$_POST[resim_adi]' WHERE no='$_POST[no]' LIMIT 1";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => 'galeri.php?gd='.$_POST['gd'].'',
	'{ILETI}' => $kp_dil_315,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_290 ,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();


	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();

	endif;


	}	
	// RESİM DEĞİŞTİRİLİYOR -SONU  //






	// RESİM EKLEME SAYFASI //
	if ($kosul == 'resim_ekle')
	{

	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1):

	if (empty($kullanici_kim['id']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './giris.php?git=giris',
	'{ILETI}' => $kp_dil_308,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__4,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}


	if ($portal_ayarlar['resim_ekleme'] == '1')
	{
	$ornek1->kosul('re', array('' => ''), true);
	$ornek1->kosul('re2', array('' => ''), true);
	}
	else
	{
	$ornek1->kosul('re', array('' => ''), false);
	$ornek1->kosul('re2', array('' => ''), false);
	}
	
	$ornek1->kosul('4', array('' => ''), true);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('7', array('' => ''), false);





	$Sorgu1 = "select id,dal from $tablo_portal_galeridal order by tarih desc";
	$Sorgu_kontrol1 = $vt->query($Sorgu1) or die ($vt->hata_ver());

	if (!$vt->num_rows($Sorgu_kontrol1))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './'.'galeri.php',
	'{ILETI}' => $kp_dil_305,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_306,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	$dal_secenek = '';

	while ($Sorgu_sonuc1 = $vt->fetch_assoc($Sorgu_kontrol1))
	{
	$dal_secenek .= '<option value="'.$Sorgu_sonuc1['id'].'">'.$Sorgu_sonuc1['dal'].'</option>';
	}
	
	$uzunluk = '200';
	
	$java = '<script type="text/javascript">
	<!-- //


function yaziUzunluk()
{
	var kisim = document.getElementById(\'yazi_uzunluk\');
	kisim.innerHTML = \''.$kp_dil_272.' '.$kp_dil_273.':\' + ('.$uzunluk.'-document.form12.aciklama.value.length);

	if (document.form12.aciklama.value.length > '.$uzunluk.')
	{
        alert(\''.$kp_dil_272.' '.$uzunluk.' '.$kp_dil_273.'.\');
        document.form12.aciklama.value = document.form12.aciklama.value.substr(0,'.$uzunluk.');
        kisim.innerHTML = \''.$kp_dil_272.' '.$kp_dil_273.': 0\';
	}
	return true;
}
yaziUzunluk();

	function denetle5()
{ 
	var dogruMu = true;
	if ((document.form12.aciklama.value.length < 3) || (document.form12.resim_adi.value.length < 3)) 
	{ 
		dogruMu = false; 
		alert("'.$kp_dil_309.'\n'.$kp_dil_310.'");
	}
	return dogruMu;
}
	//  -->
	</script>';
	

	$ornek1->dongusuz(array(
	'{JAVA_SCRIPT}' => $java,
	'{ARKA_TABLO}' => $arka_tablo,
	'{SADECE_DUZ_METIN}' => $kp_dil_418,
	'{RESIM_YUKLE111}' => $kp_dil_411,
	'{BILGISAYAR111}' => $kp_dil_412,
	'{UZAK_RESIM}' => $kp_dil_413,
	'{UZAK_RESIM2}' => $kp_dil_414,
	'{RESIM_YUKLEME_SAYFASI_1}' => 'galeri.php?kosul=resim_yukle',
	'{RESIM_YUKLE1}' => $kp_dil_270,
	'{KATEGORI_SECIN}' => $kp_dil_271,
	'{RESIM_ADI}' => $kp_dil_261,
	'{ACIKLAMA}' => $kp_dil_265,
	'{EN_FAZLA}' => $kp_dil_272,
	'{KARAKTER}' => $kp_dil_273,
	'{RESIM_SECIN}' => $kp_dil_274,
	'{AZAMI_BOYUT}' => $kp_dil_275,
	'{BOYUT_1A}' => ($portal_ayarlar['galeri_kb'] / 1024),
	'{KB}' => $kp_dil_276,
	'{MB}' => $kp_dil_277,
	'{YUKLE}' => $kp_dil_278,
	'{DAL_SECENEK}' => $dal_secenek));

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();


	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	}
	// RESİM EKLEME SAYFASI - SONU //



	// RESİM DÜZENLEME SAYFASI //
	if ($kosul == 'resim_duzelt')
	{

	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1):


	$ornek1->kosul('7', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);

	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	if (is_numeric($_GET['no']) == true) $_GET['no'] = @zkTemizle($_GET['no']);
	else $_GET['no'] = 0;

	$sorgu = "SELECT * FROM $tablo_portal_galeri WHERE no='$_GET[no]' LIMIT 1";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	$vtsonuc1 = $vt->fetch_assoc($sorgu_sonuc);

	if (!$vt->num_rows($sorgu_sonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_295,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}




	$Sorgu = "SELECT * FROM $tablo_portal_galeridal order by tarih desc";
	$dal_sonuc = @$vt->query($Sorgu) or die ($vt->hata_ver());

	while ($dallar = $vt->fetch_array($dal_sonuc)):
	$dongule = '<option value="'.$dallar['id'].'"'; if ($dallar['id'] == $vtsonuc1['id']) $dongule .= ' selected="selected"'; $dongule .= '>'.$dallar['dal'].''; $dongule .= '</option>';
	$dongu1111[] = array('{DAL_SECENEK}' => $dongule);
	endwhile;

	$uzunluk = '200';
	
	$java = '<script type="text/javascript">
	<!-- //

function yaziUzunluk2()
{
	var kisim = document.getElementById(\'yazi_uzunluk2\');
	kisim.innerHTML = \''.$kp_dil_272.' '.$kp_dil_273.':\' + ('.$uzunluk.'-document.form11.aciklama.value.length);

	if (document.form11.aciklama.value.length > '.$uzunluk.')
	{
        alert(\''.$kp_dil_272.' '.$uzunluk.' '.$kp_dil_273.'.\');
        document.form11.aciklama.value = document.form11.aciklama.value.substr(0,'.$uzunluk.');
        kisim.innerHTML = \''.$kp_dil_272.' '.$kp_dil_273.': 0\';
	}
	return true;
}
yaziUzunluk2();	
//  -->
	</script>';
	
	
	
	$ornek1->dongusuz(array('{JAVA_SCRIPT}' => $java));

	$dongusuz = array(
	'{ARKA_TABLO}' => $arka_tablo,
	'{DEGISTIRILEMEZ}' => $kp_dil_415,
	'{DUZELT}' => $kp_dil_314,
	'{RESIM_22}' => $kp_dil_313,
	'{RESIM_DUZENLEME}' => $kp_dil_312,
	'{NO}' => $vtsonuc1['no'],
	'{gd}' => $vtsonuc1['id'],
	'{ISIM}' => $vtsonuc1['isim'],
	'{RESIM}' => $vtsonuc1['resim'],
	'{RESIM_GENISLIK}' => $vtsonuc1['resim_genislik'],
	'{RESIM_YUKSEKLIK}' => $vtsonuc1['resim_yukseklik'],
	'{ACIKLAMA_2}' => $vtsonuc1['aciklama'],
	'{KATEGORI_SECIN}' => $kp_dil_271,
	'{RESIM_ADI}' => $kp_dil_261,
	'{ACIKLAMA}' => $kp_dil_265,
	'{EN_FAZLA}' => $kp_dil_272,
	'{KARAKTER}' => $kp_dil_273,
	'{RESIM_SECIN}' => $kp_dil_274,
	'{AZAMI_BOYUT}' => $kp_dil_275,
	'{KB}' => $kp_dil_276,
	'{MB}' => $kp_dil_277,
	'{RESIM_DEGISTIR_SAYFASI}' => 'galeri.php?kosul=resim_degistir');

	$ornek1->dongusuz($dongusuz);
	$ornek1->tekli_dongu('2',$dongu1111);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);



	exit();

	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();

	endif;
	}	
	// RESİM DÜZENLEME SAYFASI - SONU //

	
	// RESİM EKRANA YAZDIRILIYOR //
	if (isset($_GET['gd']))
	{

	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1):

	if (is_numeric($_GET['gd']) == true) $_GET['gd'] = @zkTemizle($_GET['gd']);
	else $_GET['gd'] = 0;


	// SEO ADRESİNİN DOĞRULUĞU KONTROL EDİLİYOR YANLIŞSA DOĞRU ADRESE YÖNLENDİRİLİYOR //
	$sorgu1111 = "select id,dal from $tablo_portal_galeridal where id='$_GET[gd]' LIMIT 1";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$galeri_satir = $vt->fetch_assoc($sorgu1111_sonuc);
	$dogru_adres = seo($galeri_satir['dal']);

	if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') AND (!@preg_match("/-$dogru_adres.html/i", $_SERVER['REQUEST_URI'])) AND (!@preg_match('/galeri\.php\?/i', $_SERVER['REQUEST_URI'])) )
	{
		$yonlendir = linkverPortal('galeri.php?gd='.$galeri_satir['id'], $galeri_satir['dal']);
		header('Location:'.$yonlendir);
		exit();
	}


	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('7', array('' => ''), false);



	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;

	$limit = $portal_ayarlar['galeri_limit']; 
	$kosullar = "where id='$_GET[gd]' AND resim_onay='1' order by tarih desc"; 
	$tabloadi = $tablo_portal_galeri; 

	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}

	$Sorgu = $vt->query("select * from $tabloadi $kosullar LIMIT $baslangic,$limit");

	$Sorgu2 = "select * from $tablo_portal_galeridal where id='$_GET[gd]' limit 1";
	$sorgu_kontrol222 = $vt->query($Sorgu2) or die ($vt->hata_ver());
	$sorgu_sonucu2 = $vt->fetch_assoc($sorgu_kontrol222);

	if (!$vt->num_rows($Sorgu))
	{
	if ($kullanici_kim['yetki'] == 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_3,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_293,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_3,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_294,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);
	}

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	while ($Sorgu_sonuc = $vt->fetch_assoc($Sorgu))
	{	

	$puan_sistemi = '';

	if ($Sorgu_sonuc['puan'] <= 9)
	{
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	}
	elseif ($Sorgu_sonuc['puan'] <= 19)
	{
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	}
	elseif ($Sorgu_sonuc['puan'] <= 29)
	{
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	}
	elseif ($Sorgu_sonuc['puan'] <= 39)
	{
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="0" alt="yıldız" width="15" height="15">';
	}
	elseif ($Sorgu_sonuc['puan'] >= 40)
	{
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	$puan_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="0" alt="yıldız" width="15" height="15">';
	}

	$aciklama_sonuc = wordwrap($Sorgu_sonuc['aciklama'],60, "<br>\n");


	$puan_dugmesi = '';
	$puan_dugmesi2 = '';
	$sil11 = '';
	$sil12 = '';
	$duzelt11 = '';
	$duzelt12 = '';

	$vtsorgu33 =   "SELECT puan_verenler,no FROM $tablo_portal_galeri  where no='$Sorgu_sonuc[no]' AND puan_verenler like '%,$kullanici_kim[id],%'";
	$puanverenler = $vt->query($vtsorgu33) or die ($vt->hata_ver());

	if (!empty($kullanici_kim['id']))
	{
	if (($puanveren = $vt->num_rows($puanverenler)) == 0)
	{
	$puan_dugmesi .= 'galeri.php?kosul=puan_ver&amp;no='.$Sorgu_sonuc['no'].'&amp;gd='.$Sorgu_sonuc['id'];
	$puan_dugmesi2 .= $galeri_simge_puanver;
	}
	else
	{
	$puan_dugmesi .= '';
	$puan_dugmesi2 .= '</a>'.$galeri_simge_puanverilmis;
	}
	}
	else
	{
	$puan_dugmesi .= './giris.php?git=giris';
	$puan_dugmesi2 .= $galeri_simge_girisyap;
	}

	if ($kullanici_kim['yetki'] == 1)
	{
	$sil11 .= 'galeri.php?kosul=resim_sil&amp;no='.$Sorgu_sonuc['no'].'&amp;gd='.$Sorgu_sonuc['id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'];
	$sil12 .= $galeri_simge_sil;
	$duzelt11 .= 'galeri.php?kosul=resim_duzelt&amp;no='.$Sorgu_sonuc['no'].'&amp;gd='.$Sorgu_sonuc['id'];
	$duzelt12 .= $galeri_simge_duzelt;
	}

	$dongu11a[] = array(
	'{ARKA_TABLO}' => $arka_tablo,
	'{TOPLAM_PUAN}' => $puan_sistemi,
	'{SIL}' => $sil11,
	'{SIL2}' => $sil12,
	'{DUZELT}' => $duzelt11,
	'{DUZELT2}' => $duzelt12,
	'{PUAN_VER}' => $puan_dugmesi,
	'{PUAN_VER_DUGME}' => $puan_dugmesi2,
	'{RESIM}' => $Sorgu_sonuc['resim'],
	'{RESIM_GENISLIK}' => $Sorgu_sonuc['resim_genislik'],
	'{RESIM_YUKSEKLIK}' => $Sorgu_sonuc['resim_yukseklik'],
	'{ISIM}' => $Sorgu_sonuc['isim'],
	'{SIL_UYARISI}' => $kp_dil_151,
	'{TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $Sorgu_sonuc['tarih']),
	'{BOYUT}' => $Sorgu_sonuc['boyut'],
	'{PUAN}' => $Sorgu_sonuc['puan'],
	'{EKLEYEN}' => '<a href="'.linkver('../profil.php?kim='.$Sorgu_sonuc['ekleyen'],$Sorgu_sonuc['ekleyen']).'">'.$Sorgu_sonuc['ekleyen'].'</a>',
	'{ACIKLAMA}' => $aciklama_sonuc);

	}
	
	$sorgu1ww = "select id,dal from $tablo_portal_galeridal where id='$_GET[gd]'";
	$sorgu1ww_sonuc = $vt->query($sorgu1ww) or die ($vt->hata_ver());
	$vtsonuc22ww = $vt->fetch_assoc($sorgu1ww_sonuc);
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'galeri.php?','&gd='.$_GET['gd'],$vtsonuc22ww['dal'].'',$adresdeger='');	


	//	TEMA UYGULANIYOR	//

	$java = "<script type=\"text/javascript\">
	<!-- //
	function sayfa_ac(resim, resim_genislik, resim_yukseklik)
	{
	resim_genislik+=40;
	resim_yukseklik+=40;
	window.open(resim,'_blank','scrollbars=yes,left=1,top=1,resizable=yes,width=' + resim_genislik + ',height=' + resim_yukseklik);
	}
	//  -->
	</script>";
	
	
	
	$ornek1->dongusuz(array('{JAVA_SCRIPT}' => $java));
	
	$dongusuz87 = array(
	'{ARKA_TABLO}' => $arka_tablo,
	'{D1}' => 'galeri.php',
	'{DALL}' => $sorgu_sonucu2['dal'],
	'{SAYFALAMA}' => $tablo,
	'{RESIM_EKLEME_SAYFASI}' => 'galeri.php?kosul=resim_ekle',
	'{RESIM_EKLEME_SAYFASI_ADI}' => $kp_dil_270,
	'{RESIM_GALERISI}' => $kp_dil_260, 
	'{TOPLAM_PUAN2}' => $kp_dil_266, 
	'{RESIM_ADI}' => $kp_dil_261, 
	'{EKLEME_TARIHI}' => $kp_dil_262, 
	'{BOYUT1}' => $kp_dil_263, 
	'{EKLEYEN1}' => $kp_dil_264, 
	'{ACIKLAMA1}' => $kp_dil_265);

	$ornek1->tekli_dongu('3',$dongu11a);
	$ornek1->dongusuz($dongusuz87);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();



	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	}
	// RESİM EKRANA YAZDIRILIYOR //




	// RESİM GALERİSİ //


	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1):

	$ornek1->kosul('1', array('' => ''), true);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('7', array('' => ''), false);


	// slayt eklentisi
	$slayt_eklentisi_baglanti = '';


	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;

	$limit = '10'; 
	$kosullar = "order by tarih desc"; 
	$tabloadi = $tablo_portal_galeridal; 

	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}	

	$Sorgu = "select * from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$Sorgu_kontrol = $vt->query($Sorgu) or die ($vt->hata_ver());

	$dallar = '';

	while ($Sorgu_sonuc = $vt->fetch_assoc($Sorgu_kontrol))
	{

	$Sorgu_a1 = "select resim,resim_genislik,resim_yukseklik from $tablo_portal_galeri where resim_onay='1' AND id='$Sorgu_sonuc[id]' order by tarih desc limit 1";
	$Sorgu_kontrol_a1 = $vt->query($Sorgu_a1) or die ($vt->hata_ver());
	$Sorgu_sonuc_a1 = $vt->fetch_assoc($Sorgu_kontrol_a1);

	$resmin_sonucu1 = '';

	if ($vt->num_rows($Sorgu_kontrol_a1))
	{
	$resmin_sonucu1 .= $Sorgu_sonuc_a1['resim'];
	}
	else
	{
	$resmin_sonucu1 .= 'temalar/'.$temadizini.'/resimler/resimler/otoavatar.png';
	}


	$Sorgu11 = $vt->query("select * from $tablo_portal_galeri where id='$Sorgu_sonuc[id]' AND resim_onay='1'") or die ($vt->hata_ver());
	$resim_sayisi = $vt->num_rows($Sorgu11);



	$dallar_dongu[] = array(
	'{DAL_ADRES}' => linkverPortal('galeri.php?gd='.$Sorgu_sonuc['id'],$Sorgu_sonuc['dal']),
	'{RESIM_SAYISI}' => $resim_sayisi,
	'{RESIM}' => $resmin_sonucu1,
	'{RESIM_GENISLIK}' => $Sorgu_sonuc_a1['resim_genislik'],
	'{RESIM_YUKSEKLIK}' => $Sorgu_sonuc_a1['resim_yukseklik'],
	'{DAL}' => $Sorgu_sonuc['dal']);

	}

	unset($Sorgu);
	unset($Sorgu_kontrol);
	unset($Sorgu_sonuc);

	$kilitle = '';
	$kilit_ileti = '';

	if (!empty($kullanici_kim['id'])) $ornek1->kosul('3', array('' => ''), true);
	else $ornek1->kosul('3', array('' => ''), false);


	if (!isset($dallar_dongu)) 
	{
	$ornek1->kosul('6', array('{SONUC}' => $kp_dil_304), true);
	$ornek1->kosul('5', array('' => ''), false);
	}
	else 
	{
	$ornek1->kosul('5', array('' => ''), true);
	$ornek1->kosul('6', array('{SONUC}' => ''), false);
	}

	if (!isset($dallar_dongu))
	{
	$dallar_dongu[] = array(
	'{DAL_ADRES}' => '',
	'{RESIM_SAYISI}' => '',
	'{RESIM}' => '',
	'{RESIM_GENISLIK}' => '',
	'{RESIM_YUKSEKLIK}' => '',
	'{DAL}' => '');
	}

	$ornek1->tekli_dongu('1',$dallar_dongu);

	$Sorgu_a2 = "select * from $tablo_portal_galeri where resim_onay='1'";
	$Sorgu_kontrol_a2 = $vt->query($Sorgu_a2) or die ($vt->hata_ver());
	$Sorgu_sonuc_a2 = $vt->num_rows($Sorgu_kontrol_a2);

	$Sorgu_a3 = "select * from $tablo_portal_galeri where resim_onay='1' order by tarih desc limit 1";
	$Sorgu_kontrol_a3 = $vt->query($Sorgu_a3) or die ($vt->hata_ver());
	$Sorgu_sonuc_a3 = $vt->fetch_assoc($Sorgu_kontrol_a3);

	$Sorgu_a4 = "SELECT resim,isim,puan,resim_genislik,resim_yukseklik FROM $tablo_portal_galeri  ORDER BY puan DESC LIMIT 1";
	$Sorgu_kontrol_a4 = $vt->query($Sorgu_a4) or die ($vt->hata_ver());
	$Sorgu_sonuc_a4 = $vt->fetch_assoc($Sorgu_kontrol_a4);
	$Sorgu_sonuc_rows = $vt->num_rows($Sorgu_kontrol_a4);


	if ($Sorgu_sonuc_a4['puan'] == 0) $paun_sonuC = '</a>'.$kp_dil_386;
	else $paun_sonuC = $Sorgu_sonuc_a4['isim'];

	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'galeri.php?',$adresdeger='');

	$java = "<script type=\"text/javascript\">
	<!-- //
	function sayfa_ac(resim, resim_genislik, resim_yukseklik)
	{
	resim_genislik+=40;
	resim_yukseklik+=40;
	window.open(resim,'_blank','scrollbars=yes,left=1,top=1,resizable=yes,width=' + resim_genislik + ',height=' + resim_yukseklik);
	}
	//  -->
	</script>";
	
	
	
	$ornek1->dongusuz(array('{JAVA_SCRIPT}' => $java));
	
	
	$ornek1->dongusuz(array(
	'{SAYFALAMA}' => $tablo,
	'{ARKA_TABLO}' => $arka_tablo,
	'{SON}' => $kp_dil_303,
	'{BURADA}' => $kp_dil_299,
	'{RESIM_VAR}' => $kp_dil_300,
	'{ENCOK_PUAN_ALAN2}' => $kp_dil_301,
	'{SON_YUKLENEN2}' => $kp_dil_302,
	'{TOPLAM_RESIM_SAYISI}' => $Sorgu_sonuc_a2,
	'{SON_RESIM_BILGISI}' => $Sorgu_sonuc_a3['isim'],
	'{SON_RESIM_ADRESI}' => $Sorgu_sonuc_a3['resim'],
	'{RESIM_GENISLIK_1}' => $Sorgu_sonuc_a3['resim_genislik'],
	'{RESIM_YUKSEKLIK_1}' => $Sorgu_sonuc_a3['resim_yukseklik'],
	'{ENCOK_PUAN_ALAN}' => $paun_sonuC,
	'{ENCOK_PUAN_ALAN_ADRESI}' => $Sorgu_sonuc_a4['resim'],
	'{RESIM_GENISLIK}' => $Sorgu_sonuc_a4['resim_genislik'],
	'{RESIM_YUKSEKLIK}' => $Sorgu_sonuc_a4['resim_yukseklik'],
	'{GALERI_DALLARI}' => $kp_dil_267,
	'{DALLAR}' => $kp_dil_268,
	'{SLAYT_EKLENTISI_BAGLANTI}' => $slayt_eklentisi_baglanti,
	'{RESIM_EKLEME_SAYFASI}' => 'galeri.php?kosul=resim_ekle',
	'{RESIM_EKLEME_SAYFASI_ADI}' => $kp_dil_270,
	'{TOPLAM_RESIM}' => $kp_dil_269));
	


	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();



	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'galeri.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;

	// RESİM GALERİSİ - SONU //

?>