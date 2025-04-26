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


	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include 'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';

	define('DOSYA_ANKET',true);

	$sayfa_adi = 'Anketler Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
	
	
	/*************************************************************************************/
	
	// OYLAR VERİTABANINA KAYDEDİLİYOR //
	
	if ($kosul == "oy_ver"):
	
	if ($portal_bloklar_ayar['anketler_sayfasi'] == 1):
	
	$sayfa_adi = 'Anket Oylama Sayfası';

	if ( (isset($_POST['anketno'])) AND (is_numeric($_POST['anketno']) == true))
	{
	$_POST['anketno'] = @zkTemizle($_POST['anketno']);
	}

	else
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => '',
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $kp_dil_243,
		'{YONLENDIRME2}' => $kp_yonetim_106);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));

		exit();
	}
	
	$vtsorgu4 =   "SELECT * FROM $tablo_portal_anketsoru where anketno='$_POST[anketno]' AND oy_kullanan_id like '%,$kullanici_kim[id],%'";
	
	$anketler_sonuc4 = $vt->query($vtsorgu4) or die ($vt->hata_ver());
	
	$anket_sonuc4 = $vt->num_rows($anketler_sonuc4);
	
    $anket_oylandimi  = $anket_sonuc4;

	if ( empty($kullanici_kim['id']) )
	{
	header ('Location: giris.php?git=giris');
	exit();
	}
	
	elseif (!$anket_oylandimi == 0)
	{
	header ('Location: anket.php');
	exit();
	} 
	
	if (is_numeric($_POST['anketno']) == true) 
	{
	$anketno = @zkTemizle($_POST['anketno']);
	}
	
	else
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => '',
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $kp_dil_243,
		'{YONLENDIRME2}' => $kp_yonetim_106);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}
	
	if (is_numeric($_POST['secenekno']) == true) 
	{
	$secenekno = @zkTemizle($_POST['secenekno']);
	}
	
	else 
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => '',
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $kp_dil_243,
		'{YONLENDIRME2}' => $kp_yonetim_106);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}
	
	
	$vtsorgu4 = "UPDATE $tablo_portal_anketsecenek SET oylar=oylar +1 WHERE secenekno='$secenekno' AND anketno='$anketno'";
	
	$anketler_sonuc3 = $vt->query($vtsorgu4) or die ($vt->hata_ver());

	$oy_kullanan_id = '';
	$oy_kullanan_id .= $kullanici_kim['id'].',';
	
	$vtsorgu = "update $tablo_portal_anketsoru set oy_kullanan_id=CONCAT(oy_kullanan_id,'$oy_kullanan_id') where anketno='$anketno'";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(OyVerYonlendirme());
	exit();
	
	else:

		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => $kp_dil_323,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	
	endif;
	
	endif;
	
	
	
	// OYLAR VERİTABANINA KAYDEDİLİYOR - SONU //
	
	/*************************************************************************************/

	
	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/anket.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	
	

	// YORUMLAR EKLENİYOR //	
	if ($kosul == 'anket_yorum_ekle')
	{

	$sayfa_adi = 'Yorum Kaydetme Sayfası';

	if ($portal_bloklar_ayar['anketler_sayfasi'] == 1)
	{

	// gelen id nümerik'mi bakılıyor.
	if ( (isset($_POST['id'])) AND (is_numeric($_POST['id']) == true) )
        $_POST['id'] = @zkTemizle($_POST['id']);
	else $_POST['id'] = 0;

	
	$tarih = time();
	
	// son ileti süresi
	if ( ($kullanici_kim['son_ileti']) > ($tarih - $ayarlar['yorum_sure']) )
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_dil_107,
		'{ADRES}' => './anket.php?anketno='.$_POST['id'],
		'{ILETI}' => $kp_dil_194,
		'{EK_YAZI}' => ''.$ayarlar['yorum_sure'].' '.$kp_dil_195.'.',
		'{YONLENDIRME}' => '',
		'{YONLENDIRME2}' => $kp_dil_121);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}
	
	// YORUM EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR //
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
	// YORUM EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR - SONU //
	
	
	
	// gelen id nümerik'mi bakılıyor.
	if ((isset($_POST['id'])) AND (is_numeric($_POST['id']) == true)) $_POST['id'] = @zkTemizle($_POST['id']);
	else $_POST['id'] = 0;
	
	$SELECT = "select anketno,anket_yorum from $tablo_portal_anketsoru where anketno='$_POST[id]'";
	$Select_sorgu = $vt->query($SELECT) or die ($vt->hata_ver());
	$Sorgu_sonuc = $vt->fetch_assoc($Select_sorgu);
	
	
	if (!$vt->num_rows($Select_sorgu))
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $ileti_2,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => $kp_dil_536,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}
	
	
	// YORUMLAR KAPALIYSA UYARI VERILIYOR //
	if ($Sorgu_sonuc['anket_yorum'] == 0)
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $ileti_2,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => $kp_dil_410,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}
	// YORUMLAR KAPALIYSA UYARI VERILIYOR - SONU //


	/* YORUM İÇERİĞİ 3 KARAKTERDEN AZ İSE UYARI VERİLİYOR */
	if (!isset($_POST['icerik']))
	{
	echo '<script type="text/javascript">
	<!--
	location.href="anket.php";
	//-->
	</script>';
	exit();
	}
	elseif (strlen($_POST['icerik']) < 3)
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $ileti_2,
		'{ADRES}' => '?anketno='.$_POST['id'],
		'{ILETI}' => $kp_dil_357,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}
	/* YORUM İÇERİĞİ 3 KARAKTERDEN AZ İSE UYARI VERİLİYOR - SONU */


	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), false);


	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$_POST['icerik'] = @ileti_yolla(stripslashes($_POST['icerik']),2);

	// magic_quotes_gpc kapalıysa //
	else $_POST['icerik'] = @ileti_yolla($_POST['icerik'],2);


	$tarih = time();
	
	
		
	//  SANSÜRLENECEK SÖZCÜKLER ALINIYOR    //

    $vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='sozcukler' LIMIT 1";
    $yasak_sonuc = $vt->query($vtsorgu);
    $yasak_sozcukler = $vt->fetch_row($yasak_sonuc);
    $ysk_sozd = explode("\r\n", $yasak_sozcukler[0]);


    //  SANSÜR CÜMLESİ ALINIYOR //

    $vtsorgu = "SELECT deger FROM $tablo_yasaklar WHERE etiket='cumle' LIMIT 1";
    $yasak_sonuc = $vt->query($vtsorgu);
    $yasak_cumle = $vt->fetch_row($yasak_sonuc);


    //  SANSÜR UYGULANIYOR  //

    if ($ysk_sozd[0] != '')
    {
        if (function_exists('str_ireplace'))
        {
            $_POST['icerik'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['icerik']);
            $_POST['icerik'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['icerik']);
        }

        else
        {
            $_POST['icerik'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['icerik']);
            $_POST['icerik'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['icerik']);
        }
    }


	// veriler kaydediliyor.
	$vtsorgu = "INSERT INTO $tablo_portal_anketyorum (tarih, anketno,  icerik, yazan)";

	$vtsorgu .= "VALUES ('$tarih','$_POST[id]','$_POST[icerik]','$kullanici_kim[kullanici_adi]')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');

	$son_ieti = "UPDATE $tablo_kullanicilar SET son_ileti='$tarih' WHERE id='$kullanici_kim[id]'";
	
	$vtsonuc1 = $vt->query($son_ieti) or die ($vt->hata_ver());


	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './anket.php?anketno='.$_POST['id'],
	'{ILETI}' => $kp_dil_358,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=./anket.php?anketno='.$_POST['id'].'">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	}



	else
	{
		// anketler sayfası kapalıysa uyarı veriliyor.
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => $kp_dil_323,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}

	exit();
	}




	if ($kosul == 'anket_yorum_sil')
	{

	$sayfa_adi = 'Anket Yorum Silme Sayfası';

	if ($portal_bloklar_ayar['anketler_sayfasi'] == 1)
	{

	// YORUMU SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR //
	if ($kullanici_kim['yetki'] != 1)
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $ileti_2,
		'{ADRES}' => './anket.php',
		'{ILETI}' => $kp_dil_279,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}
	
		// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	
	$sayfa_adi = 'Hata İletisi || Anket Sil Sayfası';

		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $ileti_2,
		'{ADRES}' => 'anket.php?anketno='.$_GET['anketno'],
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
	
	
	// YORUMU SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR - SONU //

	if (is_numeric($_GET['id']) == true) $_GET['id'] = @zkTemizle($_GET['id']);
	else $_GET['id'] = 0;
	
	if (is_numeric($_GET['anketno']) == true) $_GET['anketno'] = @zkTemizle($_GET['anketno']);
	else $_GET['anketno'] = 0;


	$sorgu = "SELECT * FROM $tablo_portal_anketyorum WHERE id='$_GET[id]' LIMIT 1";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());

	// sorgu 0 değeri döndürürse uyarı veriliyor.
	if (!$vt->num_rows($sorgu_sonuc))
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => './anket.php?anketno='.$_GET['anketno'],
		'{ILETI}' => '',
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $kp_dil_364,
		'{YONLENDIRME2}' => $kp_yonetim_106);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}

	// yorum siliniyor.
	$sil_sorgu = "DELETE FROM $tablo_portal_anketyorum WHERE id='$_GET[id]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());


		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => './anket.php?anketno='.$_GET['anketno'],
		'{ILETI}' => $kp_dil_365,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__1,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
	}

	else
	{

		// anketler sayfası kapalıysa uyarı veriliyor.
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => $kp_dil_323,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}

	exit();
	}


	// SORU BAŞLIKLARINA GÖRE ANKET SEÇENEKLERİ SIRALANIYOR //
	
	
	if (isset($_GET['anketno']))
	{
	
	if ($portal_bloklar_ayar['anketler_sayfasi'] == 1):
	
	if (is_numeric($_GET['anketno']) == true) 
	{
	$_GET['anketno'] = @zkTemizle($_GET['anketno']);
	}
	else $_GET['anketno'] = 0;


	// SEO ADRESİNİN DOĞRULUĞU KONTROL EDİLİYOR YANLIŞSA DOĞRU ADRESE YÖNLENDİRİLİYOR //
	$sorgu1111 = "select anketno,anket_soru from $tablo_portal_anketsoru where anketno='$_GET[anketno]' LIMIT 1";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$anket_satir = $vt->fetch_assoc($sorgu1111_sonuc);
	$dogru_adres = seo($anket_satir['anket_soru']);

	if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') AND (!@preg_match("/-$dogru_adres.html/i", $_SERVER['REQUEST_URI'])) AND (!@preg_match('/anket\.php\?/i', $_SERVER['REQUEST_URI'])) )
	{
		$yonlendir = linkverPortal('anket.php?anketno='.$anket_satir['anketno'], $anket_satir['anket_soru']);
		header('Location:'.$yonlendir);
		exit();
	}
	
	
	$sayfa_adi = 'Anket Sayfası';
	
	
	$ornek1->kosul('8', array('' => ''), true);
	$ornek1->kosul('9', array('' => ''), false);

	if (is_numeric($_GET['anketno']) == true) 
	{
	$_GET['anketno'] = @zkTemizle($_GET['anketno']);
	}

	else
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => '',
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $kp_dil_243,
		'{YONLENDIRME2}' => $kp_yonetim_106);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}

	$vtsorgu = "SELECT * FROM $tablo_portal_anketsecenek where anketno='$_GET[anketno]' order by secenekno";
	$anketler_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	$vtsorgu2 = "SELECT * FROM $tablo_portal_anketsoru where anketno='$_GET[anketno]'";
	$anketler_sonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());
	$anket_sonuc2 = $vt->fetch_assoc($anketler_sonuc2);
	
	if (!$vt->num_rows($anketler_sonuc2))
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => '',
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $kp_dil_243,
		'{YONLENDIRME2}' => $kp_yonetim_106);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}
	
	if (is_numeric($_GET['anketno']) == true) 
	{
	$_GET['anketno'] = @zkTemizle($_GET['anketno']);
	}

	else
	{
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => '',
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $kp_dil_243,
		'{YONLENDIRME2}' => $kp_yonetim_106);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}
	
	
	$vtsorgu3 =   "SELECT * FROM $tablo_portal_anketsoru  where anketno='$_GET[anketno]' AND oy_kullanan_id like '%,$kullanici_kim[id],%'";
	$anketler_sonuc3 = $vt->query($vtsorgu3) or die ($vt->hata_ver());
	
	
	$anket_sonuc4 = $vt->fetch_array($anketler_sonuc3);
	$anket_sonuc3 = $vt->num_rows($anketler_sonuc3);
	
    $anket_oylandi  = $anket_sonuc3;
	
	if ($kullanici_kim['yetki'] == 1) $ornek1->kosul('1', array('{SECENEK_SIL}' => $kp_dil_160), true);
	else $ornek1->kosul('1', array('{SECENEK_SIL}' => ''), false);

	$toplam_oylar2 = 0;
	
	$vtsorgu11 = $vt->query("SELECT oylar FROM $tablo_portal_anketsecenek where anketno='$_GET[anketno]'");
	while ($toplam_oylar3 = $vt->fetch_assoc($vtsorgu11))
		{
		$toplam_oylar2 += $toplam_oylar3['oylar'];
		}
		
	while ($anket_sonuc = $vt->fetch_assoc($anketler_sonuc)):

	if (!$anket_sonuc['oylar'] == 0)
	{
	$toplam_oy_yuzde = number_format(($anket_sonuc['oylar'] < $toplam_oylar2) ? $anket_sonuc['oylar'] / $toplam_oylar2 * 100 : 100, 2,'.','');
	$cubuk_yuzde = number_format(($anket_sonuc['oylar'] < $toplam_oylar2) ? $anket_sonuc['oylar'] / $toplam_oylar2 * 95 : 95, 0,'.','');
	}
	else
	{
	$toplam_oy_yuzde = '0.00';
	$cubuk_yuzde = '1';
	}
	
	if ($anket_sonuc2['anket_durum'] == 0)
	{
	$ornek1->kosul('ak', array('{ANKET_KAPATILMISTIR}' => $kp_dil_256), true);
	}
	else
	{
	$ornek1->kosul('ak', array('{ANKET_KAPATILMISTIR}' => ''), false);
	}
	
    if (isset($ilksecenek)) $ilksecili = 'checked="checked"';
    else $ilksecili = '';

	$secenek_durumu_2 = '<label style="cursor: pointer;">';
	
	if ($anket_sonuc2['anket_durum'] == 0)
	{
	$secenek_durumu_2 .= '<input type="radio" name="secenekno" value="'.$anket_sonuc['secenekno'].'" disabled="disabled">';
	}
	elseif ( empty($kullanici_kim['id']) )
	{
	$secenek_durumu_2 .= '<input type="radio" name="secenekno" value="'.$anket_sonuc['secenekno'].'" disabled="disabled">';
	}
	elseif ($anket_oylandi == 0)
	{
	$secenek_durumu_2 .= '<input type="radio" name="secenekno" value="'.$anket_sonuc['secenekno'].'" '.$ilksecili.'>';
	}
	elseif (!$anket_oylandi == 0)
	{
	$secenek_durumu_2 .= '<input type="radio" name="secenekno" value="'.$anket_sonuc['secenekno'].'" disabled="disabled">';
	}
	
	$secenek_durumu_2 .= '</label>';
	
	$ilksecenek = true;
	
	$dondur18[] = array(
	'{ANKET_NO}' => $anket_sonuc['anketno'],
	'{SECENEK_NO}' => $anket_sonuc['secenekno'],
	'{SECENEK}' => $anket_sonuc['secenek'],
	'{SECENEK_DURUMU_2}' => $secenek_durumu_2,
	'{YUZDE}' => $toplam_oy_yuzde,
	'{CUBUK_YUZDE}' => $cubuk_yuzde,
	'{OYLAR}' => $anket_sonuc['oylar']);
	
	endwhile;
	
	if (!isset($dondur18)){
	
	$dondur18[] = array(
	'{ANKET_NO}' => '',
	'{SECENEK_NO}' => '',
	'{SECENEK}' => '',
	'{OYLAR}' => '');
	}
	
	$ornek1->tekli_dongu('1',$dondur18);
	
	$oyver_dugmesi_durumu2 = '';
	
	if ($anket_sonuc2['anket_durum'] == 0)
	{
	$oyver_dugmesi_durumu2 .= '<input type="submit" class="dugme" name="oyver" value="'.$kp_dil_168.'" disabled="disabled">';
	}
	elseif ( empty($kullanici_kim['id']) )
	{
	$oyver_dugmesi_durumu2 .= '<input type="submit" class="dugme" name="oyver" value="'.$kp_dil_168.'" disabled="disabled">';
	}
	elseif ($anket_oylandi == 0)
	{
	$oyver_dugmesi_durumu2 .= '<input type="submit" class="dugme" name="oyver" value="'.$kp_dil_168.'">';
	}
	elseif (!$anket_oylandi == 0)
	{
	$oyver_dugmesi_durumu2 .= '<input type="submit" class="dugme" name="oyver" value="'.$kp_dil_168.'" disabled="disabled">';
	}
	
	
	$java = '<script type="text/javascript">
	<!-- //
	
	function denetle25()
{ 
	var dogruMu = true;
	if ((document.form.icerik.value.length < 3)) 
	{ 
		dogruMu = false; 
		alert(\''.$kp_dil_357.'\');
	}
	return dogruMu;
}
	//  -->
	</script>';
	
	
	$dongusuz12 = array(
	'{ALT_DIZIN}' => $alt_dizin,
	'{UST_DIZIN}' => $ust_dizin,
	'{JAVA_SCRIPT}' => $java,
	'{RRESIMM}' => $kp_dil_42,
	'{TTOPLAM_OYLARR}' => $toplam_oylar2,
	'{TTOPLAM_OYLARR_1}' => $kp_dil_258,
	'{CUBUK_1}' => $kp_dil_259,
	'{OYVER_DUGMESI_DURUMU2}' => $oyver_dugmesi_durumu2,
	'{TEMA_DIZIN}' => $temadizini,
	'{ALINTI_CUBUK_RENGI}' => $alinti_cubuk,
	'{TOPLAM_YUZDE}' => $kp_dil_251,
	'{ANKET}' => $kp_dil_156,
	'{SECENEK}' => $kp_dil_157,
	'{TOPLAM_OY}' => $kp_dil_158,
	'{ANKET_SORU}' => $anket_sonuc2['anket_soru'],
	'{ARKA_TABLO}' => $arka_tablo,
	'{PORTAL_INDEX}' => 'anket.php',
	'{OY_VER_SAYFASI_1}' => 'anket.php?kosul=oy_ver',
	'{OYVER}' => $kp_dil_168);
	
	$ornek1->dongusuz($dongusuz12);
	
	
	
	if (is_numeric($_GET['anketno']) == true) $_GET['anketno'] = @zkTemizle($_GET['anketno']);
	else $_GET['anketno'] = 0;

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = '10'; 
	$kosullar = "where anketno='$_GET[anketno]' order by tarih desc"; 
	$tabloadi = $tablo_portal_anketyorum; 

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
	
	// veritabanından yorumlar çekiliyor.
	$sorgu11132 = "select * from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$sorgu11132_sonuc = $vt->query($sorgu11132) or die ($vt->hata_ver());
	$vtsonuc33 = $vt->num_rows($sorgu11132_sonuc);

	if ($kullanici_kim['yetki'] == 1) $yorm_sil_buton = $kp_dil_338;
	else $yorm_sil_buton = '';
	
	// yorumlar döngüye sokuluyor.
	while ($vtsonuc32 = $vt->fetch_assoc($sorgu11132_sonuc)):

	$dongu_baslat222[] = array(
	'{YORUMLARA_KAPALI}' => '',
	'{YORUM}' => bbcode_kapali(ifadeler($vtsonuc32['icerik'])),
	'{SIL3}' => $yorm_sil_buton,
	'{YORUM_YAZAN}' => '<a href="'.linkver('../profil.php?kim='.$vtsonuc32['yazan'],$vtsonuc32['yazan']).'">'.$vtsonuc32['yazan'].'</a>',
	'{YORUM_SIL}' => 'anket.php?kosul=anket_yorum_sil&amp;id='.$vtsonuc32['id'].'&amp;anketno='.$_GET['anketno'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{Y_TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $vtsonuc32['tarih']));

	endwhile;

	$vtsorgu3 =   "SELECT * FROM $tablo_portal_anketsoru  where anketno='$_GET[anketno]' AND oy_kullanan_id like '%,$kullanici_kim[id],%'";
	$anketler_sonuc3 = $vt->query($vtsorgu3) or die ($vt->hata_ver());
	
	$anket_sonuc3 = $vt->fetch_assoc($anketler_sonuc3);
	
	if (!$anket_sonuc3['oy_kullanan_id'])
	{
	$dongu_baslat222[] = array(
	'{YORUMLARA_KAPALI}' => $kp_dil_427.' !',
	'{YORUM}' => '',
	'{YORUM_YAZAN}' => '',
	'{SIL3}' => '',
	'{YORUM_SIL}' => '',
	'{Y_TARIH}' => '');
	}
	elseif (($anket_sonuc4['anket_yorum']) == 0)
	{
	$dongu_baslat222[] = array(
	'{YORUMLARA_KAPALI}' => $kp_dil_409.' !',
	'{YORUM}' => '',
	'{YORUM_YAZAN}' => '',
	'{SIL3}' => '',
	'{YORUM_SIL}' => '',
	'{Y_TARIH}' => '');
	}
	elseif (!isset($dongu_baslat222))
	{
	$dongu_baslat222[] = array(
	'{YORUMLARA_KAPALI}' => '',
	'{YORUM}' => '<br>&nbsp;&nbsp;'.$kp_dil_337.'',
	'{YORUM_YAZAN}' => '',
	'{SIL3}' => '',
	'{YORUM_SIL}' => '',
	'{Y_TARIH}' => '');
	}
	

	$ornek1->tekli_dongu('y1',$dongu_baslat222);
	
	$sorgu1ww = "select anketno,anket_soru from $tablo_portal_anketsoru where anketno='$_GET[anketno]'";
	$sorgu1ww_sonuc = $vt->query($sorgu1ww) or die ($vt->hata_ver());
	$vtsonuc22ww = $vt->fetch_assoc($sorgu1ww_sonuc);
	
	$tablo1 = sayfalama($limit,$sayfa,$satir_sayisi,'anket.php?','&anketno='.$_GET['anketno'],$vtsonuc22ww['anket_soru'].'',$adresdeger='');
	
	$dongu_yok11 = array(
	'{SAYFALAMA1}' => $tablo1,
	'{YORUMLAR}' => $kp_dil_142,
	'{SIL_UYARISI}' => $kp_dil_151,
	'{SIL2}' => $kp_dil_338,
	'{TOPLAM_YORUM2}' => $kp_dil_343,
	'{GONDER}' => $kp_dil_341,
	'{TEMIZLE}' => $kp_dil_342,
	'{TOPLAM_YORUM}' => $vtsonuc33,
	'{YORUM_EKLE}' => 'anket.php?kosul=anket_yorum_ekle',
	'{ID}' => $_GET['anketno']);

	$ornek1->dongusuz($dongu_yok11);
	
	if (!empty($kullanici_kim['id'])) $ornek1->kosul('6', array('' => ''), true);
	else $ornek1->kosul('6', array('' => ''), false);

	
	if (($anket_sonuc4['anket_yorum']) == 1) $ornek1->kosul('y', array('' => ''), true);
	else $ornek1->kosul('y', array('' => ''), false);
	
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();

	else:
		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_yonetim_103,
		'{ADRES}' => 'anket.php',
		'{ILETI}' => $kp_dil_323,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	exit();
	}
	
	// SORU BAŞLIKLARINA GÖRE ANKET SEÇENEKLERİ SIRALANIYOR - SONU //
	
/*************************************************************************************/

	// ANKET SORU BAŞLIKLARI //
	

	if ($portal_bloklar_ayar['anketler_sayfasi'] == 1):
	
	$ornek1->kosul('9', array('' => ''), true);
	$ornek1->kosul('8', array('' => ''), false);
	
	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = $portal_ayarlar['anket_limit']; 
	$kosullar = "ORDER by tarih DESC"; 
	$tabloadi = $tablo_portal_anketsoru; 

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
	
	$vtsorgu1 = "SELECT * FROM $tabloadi $kosullar LIMIT $baslangic,$limit";
	
	$anketler_sonuc1 = $vt->query($vtsorgu1) or die ($vt->hata_ver());
	
	
	
	while ($anket_sonuc1 = $vt->fetch_assoc($anketler_sonuc1)):
	
	$vtsorgu2 = $vt->query("SELECT oylar  FROM $tablo_portal_anketsecenek where anketno='$anket_sonuc1[anketno]'");
	
	$toplam_oylar = 0;
	
	while ($toplam_oylar1 = $vt->fetch_assoc($vtsorgu2))
		{
		$toplam_oylar += $toplam_oylar1['oylar'];
		}
	
	$vtsorgu3 = $vt->query("SELECT * FROM $tablo_portal_anketsecenek where anketno='$anket_sonuc1[anketno]'");
	$secenek_varmi = $vt->num_rows($vtsorgu3);
	
	$anket_durum = '';
	
	if ($anket_sonuc1['anket_durum'] == 1)
	{
	$anket_durum .= $kp_dil_249;
	}
	else
	{
	$anket_durum .= $kp_dil_250;
	}
	
	if (($secenek_varmi) == 0)
	{
	$dondur19[] = array(
	'{TEMA_DIZIN}' => $temadizini,
	'{ANKET_TARIHI}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $anket_sonuc1['tarih']),
	'{ANKET_DURUMU}' => $kp_dil_250,
	'{TOP_OYLAR}' => $toplam_oylar,
	'{ANKET_NO2}' => '',
	'{ANKET_SORUSU2}' => $anket_sonuc1['anket_soru'].'&nbsp;&nbsp;&nbsp;( '.$kp_dil_253.' )');
	}
	else
	{
	$dondur19[] = array(
	'{TEMA_DIZIN}' => $temadizini,
	'{ANKET_TARIHI}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $anket_sonuc1['tarih']),
	'{ANKET_DURUMU}' => $anket_durum,
	'{TOP_OYLAR}' => $toplam_oylar,
	'{ANKET_NO2}' => $anket_sonuc1['anketno'],
	'{ANKET_SORUSU2}' => '<a href="'.linkverPortal('anket.php?anketno='.$anket_sonuc1['anketno'],$anket_sonuc1['anket_soru']).'">'.$anket_sonuc1['anket_soru'].'</a>');
	}
	
	endwhile;
	
	if (!isset($dondur19)){
	$dondur19[] = array(
	'{TEMA_DIZIN}' => $temadizini,
	'{ANKET_TARIHI}' => '',
	'{ANKET_DURUMU}' => '',
	'{TOP_OYLAR}' => '',
	'{ANKET_NO2}' => '',
	'{ANKET_SORUSU2}' => '<br>'.$kp_dil_221);
	}
	$ornek1->tekli_dongu('2',$dondur19);
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'anket.php?',$adresdeger='');
	
	$dongusuz12 = array(
	'{SAYFALAMA}' => $tablo,
	'{ALT_DIZIN}' => $alt_dizin,
	'{UST_DIZIN}' => $ust_dizin,
	'{ARKA_TABLO}' => $arka_tablo,
	'{ACILIS_TARIHI}' => $kp_dil_246,
	'{A_DURUMU}' => $kp_dil_248,
	'{A_OYLAR}' => $kp_dil_247,
	'{PORTAL_INDEX}' => 'anket.php',
	'{ANKETLER}' => $kp_dil_164,
	'{ANKET_SORULARI}' => $kp_dil_165,
	'{SON_ANKETLER}' => $kp_dil_167);
	
	$ornek1->dongusuz($dongusuz12);
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();
	
	
	
	else:

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'anket.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	

	// ANKET SORU BAŞLIKLARI - SONU //

	/**************************************************************/
?>