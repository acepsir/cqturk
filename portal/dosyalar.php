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


	@session_start();
	define('DOSYA_DOSYALAR',true);
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5' OR kip='6'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include 'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';

	$sayfa_adi = 'Dosyalar Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/dosyalar.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));

	$indir_sonuc1 = true;
	$duzenleme = true;
	$yeni_dosya_ekle = true;


	$ornek1->dongusuz(array(
	'{ALT_DIZIN}' => $alt_dizin,
	'{UST_DIZIN}' => $ust_dizin,));


	// DOSYA İNDİRİLİYOR SAYFASI //

	if ($kosul == "dosya_indiriliyor")
	{
	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 1):

/*
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/dosyalar.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
*/


	if ( (isset($_POST['onay_kodu'])) AND (@strtolower($_POST['onay_kodu']) == @strtolower($_SESSION['onay_kodu'])) )
	{

	$sayfa_adi = 'Dosya İndiriliyor Sayfası';
	
	$ornek1->kosul('4', array('' => ''), true);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('5', array('' => ''), false);
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), false);


	if ($portal_ayarlar['kullanici_izni'] == 0)
	{
	if ( empty($kullanici_kim['id']) )
	{
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(KullaniciIzni());
	exit();
	}
	}
	
	if ( (isset($_GET['no'])) AND ($_GET['no'] != '') AND (is_numeric($_GET['no'])) )
	{
		$no = @zkTemizle($_GET['no']);
	}
	else
	
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_240,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
		
	$vtsorgu = "SELECT * FROM $tablo_portal_indir WHERE no='$no' LIMIT 1";
	
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	if (!$vt->num_rows($vtsonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_240,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	$indir_sonuc = $vt->fetch_assoc($vtsonuc);
	
	$vt->query("UPDATE $tablo_portal_indir SET indirme_sayisi=indirme_sayisi +1 WHERE no='$no'") or die ($vt->hata_ver());
	
	$dongusuz13 = array(
	'{TEMA_DIZIN}' => $temadizini,
	'{DOSYA_INDIR}' => $kp_dil_101,
	'{DOSYA_ADI_I}' => $kp_dil_102,
	'{DOSYA_ADI_I_SONUCU}' => $indir_sonuc['dosya_baslik'],
	'{DOSYA_INDIRILIYOR}' => $kp_dil_103,
	'{DOSYA_ADRESI}' => $indir_sonuc['dosya_adresi'],
	'{BASARISIZ_OLURSA}' => $kp_dil_104,
	'{TIKLAYIN}' => $kp_dil_105,
	'{ARKA_TABLO}' => $arka_tablo,
	'{PORTAL_INDEX}' => 'dosyalar.php');
	
	$ornek1->dongusuz($dongusuz13);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);





	if (is_numeric($_GET['no']) == true) 
	{
	$no = @zkTemizle($_GET['no']);
	}
	else 
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_240,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	}
	
	else 
	
	{
	
	if (is_numeric($_GET['no']) == true) 
	{
	$no = @zkTemizle($_GET['no']);
	}
	else 
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_240,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}


	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_3,
	'{ADRES}' => 'dosyalar.php?kosul=dosya_indirme&amp;dosya=indir&no='.$no,
	'{ILETI}' => $kp_dil_321,
	'{EK_YAZI}' => $kp_dil_322,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	
	
	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	
	}
	
	// DOSYA İNDİRİLİYOR SAYFASI - SONU //
	
	/*************************************************************************************/
	
	// DOSYAYA GÖRE YORUMLAR SİLİNİYOR //
	
	$s = $ps;
	
	if ($kullanici_kim['yetki'] == 1){
	
	if ($kosul == "yorum_sil")
	{
	
	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 1):
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'dosyalar.php?no='.$_POST['no'],
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
	
/*
	$sayfa_adi = 'Yorum Silme Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/dosyalar.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
*/

	if (is_numeric($_GET['yorumno']) == true) 
	{
	$yorumno = @zkTemizle($_GET['yorumno']);
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_241,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	
	$vtsorgu2 = "SELECT * FROM $tablo_portal_indiryorum WHERE yorumno='$yorumno' LIMIT 1";
	
	$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());
	
	if (!$vt->num_rows($vtsonuc2))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_241,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}


	$vtsorgu = "DELETE FROM $tablo_portal_indiryorum WHERE yorumno='$yorumno' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(YorumSilYonlendirme());
	exit();


	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	
	}
	}
	
	// DOSYAYA GÖRE YORUMLAR SİLİNİYOR -SONU //
	
	/*************************************************************************************/

	// DOSYAYA GÖRE YORUMLAR VERİTABANINA EKLENİYOR //
	
	if (isset($_GET['kw35ba2ml'])) $kw35ba2ml = $_GET['kw35ba2ml'];
	
	if ($kosul == "yorum_ekle")
	{
	
	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 1):

/*
	$sayfa_adi = 'Yorum Ekleme Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/dosyalar.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
*/

	if ( empty($kullanici_kim['id']) )
	{
	
	$ka = '';
	
	exit();
	
	}
	
	$tarih = time();
	
	//	FORM DOLU MU BOŞ MU DENETLENİYOR	//
	if (!isset($_POST['yorum_icerik']))
	{
	echo '<script type="text/javascript">
	<!--
	location.href="dosyalar.php";
	//-->
	</script>';
	exit();
	}
	elseif (strlen($_POST['yorum_icerik']) < 5)
	{
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(FormDolumuBosmu());
	exit();
	}


	
	if ( ($kullanici_kim['son_ileti']) > ($tarih - $ayarlar['yorum_sure']) )
	{
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(SoniletiZamani());
	exit();
	}
	
	else
	{
	
	//	FORM DOLU İSE BİLGİLER VERİTABANINA KAYDEDİLİYOR //

	if (is_numeric($_POST['kategorino']) == true) 
	{
	$_POST['kategorino'] = @zkTemizle($_POST['kategorino']);
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_242,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	if (is_numeric($_POST['no']) == true) 
	{
	$_POST['no'] = @zkTemizle($_POST['no']);
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_242,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$_POST['yorum_icerik'] = @ileti_yolla(stripslashes($_POST['yorum_icerik']),2);

	// magic_quotes_gpc kapalıysa //
	else $_POST['yorum_icerik'] = @ileti_yolla($_POST['yorum_icerik'],2);
	
	
	
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
            $_POST['yorum_icerik'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['yorum_icerik']);
            $_POST['yorum_icerik'] = str_ireplace($ysk_sozd, $yasak_cumle[0], $_POST['yorum_icerik']);
        }

        else
        {
            $_POST['yorum_icerik'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['yorum_icerik']);
            $_POST['yorum_icerik'] = str_replace($ysk_sozd, $yasak_cumle[0], $_POST['yorum_icerik']);
        }
    }


	$vtsorgu = "SELECT no,kategorino FROM $tablo_portal_indir";
	$vtsonucu_goster = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$indir_sonuc2 = $vt->fetch_assoc($vtsonucu_goster);

	$vtsorgu = "INSERT INTO $tablo_portal_indiryorum (yorum_tarih,  yorum_icerik, yorumlayan, dosyano, kategorino, yorumlayan_ip)";
	$vtsorgu .= "VALUES ('$tarih','$_POST[yorum_icerik]','$kullanici_kim[kullanici_adi]','$_POST[no]', '$_POST[kategorino]','$_SERVER[REMOTE_ADDR]')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>');

	$son_ieti = "UPDATE $tablo_kullanicilar SET son_ileti='$tarih' WHERE id='$kullanici_kim[id]'";
	$vtsonuc1 = $vt->query($son_ieti) or die ($vt->hata_ver());

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(bilgi());
	exit();
	}
	
	exit();
	
	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	
	}
	
	// DOSYAYA GÖRE YORUMLAR VERİTABANINA EKLENİYOR -SONU //
	
	/*************************************************************************************/
	
	// DOSYAYA GÖRE İÇERİK SAYFASI AYARLARI //
	
	
	
	if (isset($_GET['no']))
	{
	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 1):
	
	if (is_numeric($_GET['no']) == true) 
	{
	$no = @zkTemizle($_GET['no']);
	}
	else
	{
	$_GET['no'] = 0;
	$no = 0;
	}


	// SEO ADRESİNİN DOĞRULUĞU KONTROL EDİLİYOR YANLIŞSA DOĞRU ADRESE YÖNLENDİRİLİYOR //
	$sorgu1111 = "select no,dosya_baslik from $tablo_portal_indir where no='$_GET[no]' LIMIT 1";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$dosya_satir = $vt->fetch_assoc($sorgu1111_sonuc);
	$dogru_adres = seo($dosya_satir['dosya_baslik']);

if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') AND (!@preg_match("/-$dogru_adres.html/i", $_SERVER['REQUEST_URI'])) AND (!@preg_match('/dosyalar\.php\?/i', $_SERVER['REQUEST_URI'])) )
	{
		$yonlendir = linkverPortal('dosyalar.php?no='.$dosya_satir['no'], $dosya_satir['dosya_baslik']);
		echo '<meta http-equiv="Refresh" content="0;url='.$yonlendir.'">';
		exit();
	}

/*
	$sayfa_adi = 'Dosya Detay Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/dosyalar.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
*/

	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), true);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('5', array('' => ''), false);
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), false);
	
	
	if ($portal_ayarlar['kullanici_izni'] == 0){
	if ( empty($kullanici_kim['id']) )
	{
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(KullaniciIzni());
	exit();
	}
  }

	// VERİTABANINDAN BİLGİLER ÇEKİLİYOR //
	
	if ( (isset($_GET['no'])) AND ($_GET['no'] != '') AND (is_numeric($_GET['no'])) )
	{
	$no = @zkTemizle($_GET['no']);
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_239,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	if (isset($_GET['kategorino']))
	{
	
	if (is_numeric($_GET['kategorino']) == true) 
	{
	$kategorino = @zkTemizle($_GET['kategorino']);
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_239,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}
	
	$vtsorgu = "SELECT * FROM $tablo_portal_indir WHERE no='$no' LIMIT 1";
	
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	if (!$vt->num_rows($vtsonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_239,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	else
	{
	$indir_sonuc1 = $vt->fetch_assoc($vtsonuc);

    //	YÖNETİCİ VEYA YARDIMCI İSE //
	
	if ($kullanici_kim['yetki'] == 1){
	
	if (isset($_GET['kategorino'])){
	if (is_numeric($_GET['kategorino']) == true) 
	{
	$kategorino = @zkTemizle($_GET['kategorino']);
	}
	else 
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_239,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}
	
	$ornek1->kosul('10', array('' => ''), true);
	
	}else $ornek1->kosul('10', array('' => ''), false);
	
	
	$aciklama_sonucu = '';
	
	if ( ($indir_sonuc1['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
	{
	$aciklama_sonucu .= bbcode_acik($indir_sonuc1['dosya_aciklama'],$indir_sonuc1['no']);
	}
	else
	{
	$aciklama_sonucu .= bbcode_kapali($indir_sonuc1['dosya_aciklama']);
	}

	// EN SON DOSYAYI DEĞİŞTİRENİN BİLGİLERİ EKRANA YAZDIRILIYOR //
	
	$degistimesayisi = '';
	
	if ($indir_sonuc1['degistirme_sayisi'] != 0):
	
	$degistimesayisi .= '&nbsp;__________________________________________________________<br><br>
	<font  face="Verdana" style="font-size: 9px">&nbsp;'.$kp_dil_131.' <b>'.$indir_sonuc1['degistiren'].'</b>
	'.$kp_dil_132.' <b>'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $indir_sonuc1['degistirme_tarihi']).'</b>
	'.$kp_dil_133.' '.$indir_sonuc1['degistirme_sayisi'].' '.$kp_dil_134.'.';
	
	if ($kullanici_kim['yetki'] == 1)
	{
	
	$degistimesayisi .= '
	<a target="_blank" href="http://whois.domaintools.com/'.$indir_sonuc1['degistiren_ip'].'">[ip]</a>
	</font>';

	}
	endif;

	// EN SON DOSYAYI DEĞİŞTİRENİN BİLGİLERİ EKRANA YAZDIRILIYOR -SONU //
	
	/*************************************************************************************/
	
	// YORUMLAR EKRANA YAZDIRILIYOR //
	
	
	if (is_numeric($_GET['no']) == true) 
	{
	$_GET['no'] = @zkTemizle($_GET['no']);
	}
	else 
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_241,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	
	$limit = '10'; 
	$kosullar = "WHERE dosyano='$_GET[no]' ORDER BY yorum_tarih DESC"; 
	$tabloadi = $tablo_portal_indiryorum; 

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
	
	$_GET['s'] = @zkTemizle($_GET['s']);
	
	$vtsorgu =$vt->query("SELECT * FROM $tabloadi $kosullar LIMIT $baslangic,$limit");
	
	$kac_secili=$vt->num_rows($vtsorgu); 
	
	$yorum_sil = '';
	
	if ($kullanici_kim['yetki'] == 1){
	$yorum_sil .= ''.$kp_dil_143.''; 
	} 
	
	if (!$vt->num_rows($vtsorgu))
	{
	$ornek1->kosul('13', array('{SIL_}' => ''), false);
	
	$dondur33[] = array(
	'{YORUMLAYAN}' => '',
	'{ZAMAN_}' => '',
	'{YORUM_ICERIK}' => ''.$kp_dil_245.'<br>',
	'{YORUM_NO}' => '',
	'{DOSYA_YORUM_11}' => '',
	'{DOSYA_NO_}' => '');	
	}
	else
	{
	
	while ($indir_sonuc2 = $vt->fetch_assoc($vtsorgu)):
	
	if ($kullanici_kim['yetki'] == 1){

	$ornek1->kosul('13', array('{SIL_}' => $kp_dil_144), true);
	
	}else $ornek1->kosul('13', array('{SIL_}' => ''), false);
	
	$dondur33[] = array(
	'{YORUMLAYAN}' => '<a href="'.linkver('../profil.php?kim='.$indir_sonuc2['yorumlayan'],$indir_sonuc2['yorumlayan']).'">'.$indir_sonuc2['yorumlayan'].'</a>',
	'{ZAMAN_}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $indir_sonuc2['yorum_tarih']),
	'{YORUM_ICERIK}' => bbcode_kapali(ifadeler($indir_sonuc2['yorum_icerik'])),
	'{YORUM_NO}' => $indir_sonuc2['yorumno'],
	'{DOSYA_YORUM_11}' => ''.'dosyalar.php?kosul=yorum_sil&amp;yorumno='.$indir_sonuc2['yorumno'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{DOSYA_NO_}' => $indir_sonuc1['no']);
	
	endwhile;
	}
	
	
	$ornek1->tekli_dongu('3', $dondur33);

	// BİLGİLER EKRANA YAZDIRILIYOR - SONU //

	$sayfala = '';
	
	if($kac_secili>0)
	
	{
	
	$ornek1->kosul('sa',array('{}' => ''), true);
		
	$sayfala .= sayfalama($limit,$sayfa,$satir_sayisi,'dosyalar.php?','&no='.$indir_sonuc1['no'],$indir_sonuc1['dosya_baslik'].'',$adresdeger=''); 
	
	}
	else
	{
	$ornek1->kosul('sa',array('{}' => ''), false);
	}
	// SAYFALAMA BAŞLIYOR - SONU //
	

	if (!empty($kullanici_kim['id']) )
	{
	$ornek1->kosul('3', array('' => ''), true);
	$ornek1->kosul('7', array('' => ''), true);
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('5', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), false);
	}
	else
	{
	$ornek1->kosul('3', array('' => ''), true);
	$ornek1->kosul('7', array('' => ''), false);
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('5', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), false);
	}
	
	
	$onay_id = session_id().'&amp;sayi='.sha1(microtime());

	
	$java = '<script type="text/javascript">
<!-- 
function denetle()
{ 
	var dogruMu = true;
	for (var i=0; i<11; i++)
	{
		if (document.f.elements[i].value=="")
		{ 
			dogruMu = false; 
			alert("'.$kp_dil_320.'");
			break
		}
	}
	return dogruMu;
}


	
	function denetle10()
{ 
	var dogruMu = true;
	if ((document.form.yorum_icerik.value.length < 5)) 
	{ 
		dogruMu = false; 
		alert("'.$kp_dil_138.'");
	}
	return dogruMu;
}
	//  -->
	</script>';
	
	
	
	
	
	
	
	
	// BİLGİLER EKRANA YAZDIRILIYOR - SONU //

	$dongusuz13 = array(
	'{SESSION_ID}' => session_id(),
	'{JAVA_SCRIPT}' => $java,
	'{LISANS}' => $kp_dil_316,
	'{ONAYKODU1}' => $kp_dil_317,
	'{DOSYAYI_INDIRMEK_ICIN}' => $kp_dil_318,
	'{BU_ONAY}' => $kp_dil_319,
	'{ONAY_ID}' => $onay_id,
	'{ACIKLAMA_SONUCU}' => ifadeler($aciklama_sonucu),
	'{TEMA_DIZIN}' => $temadizini,
	'{SIMGE_SIL}' => $simge_sil,
	'{SIMGE_DUZELT}' => $simge_degistir,
	'{DOSYA_INDIR2}' => $kp_dil_109,
	'{DOSYA_ADI2}' => $kp_dil_102,
	'{DOSYA_NO}' => $indir_sonuc1['no'],
	'{ARKA_TABLO}' => $arka_tablo,
	'{DOSYAYI_INDIR_1}' => $indir_sonuc1['dosya_baslik'],
	'{DOSYA_RESIM}' => $indir_sonuc1['resim'],
	'{DUZENLEME}' => $duzenleme,
	'{INDIR}' => $kp_dil_119,
	'{URETICI}' => $kp_dil_178,
	'{URETICI_SONUCU}' => $indir_sonuc1['uretici'],
	'{DIL}' => $kp_dil_177,
	'{DIL_SONUCU}' => $indir_sonuc1['dil'],
	'{BOYUT}' => $kp_dil_110,
	'{BOYUT_SONUCU}' => $indir_sonuc1['dosya_boyutu'],
	'{EKLEYEN}' => $kp_dil_111,
	'{EKLEYEN_LINKI}' => linkver('../profil.php?kim='.$indir_sonuc1['ekleyen'],$indir_sonuc1['ekleyen']),
	'{EKLEYEN_SONUCU}' => $indir_sonuc1['ekleyen'],
	'{EKLEME_TARIHI}' => $kp_dil_112,
	'{EKLEME_TARIHI_SONUCU}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $indir_sonuc1['tarih']),
	'{INDIRME_SAYISI}' => $kp_dil_113,
	'{INDIRME_SAYISI_SONUCU}' => $indir_sonuc1['indirme_sayisi'],
	'{KULLANIM}' => $indir_sonuc1['kullanim'],
	'{DEGISTIRME_SAYISI}' => $degistimesayisi,
	'{YORUMLAYAN}' => $kp_dil_141,
	'{YORUM}' => $kp_dil_142,
	'{YORUM_SIL}' => $yorum_sil,
	'{SAYFALAMA}' => $sayfala,
	'{KATEGORI_NO}' => $indir_sonuc1['kategorino'],
	'{DOSYAYI_DUZELT_1}' => 'dosya_duzelt_sil.php?kosul=dosya_sil&amp;kategorino='.$indir_sonuc1['kategorino'].'&amp;no='.$indir_sonuc1['no'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{DOSYAYI_SIL_1}' => 'dosya_duzelt_sil.php?no='.$indir_sonuc1['no'].'',
	'{DOSYAYI_YAZDIR_1}' => 'yazdir.php?dosya=dosyalar&amp;veri=konu&amp;kosul=portal&amp;no='.$indir_sonuc1['no'],
	'{DOSYAYI_INDIR_11}' => ''.'dosyalar.php?kosul=dosya_indiriliyor&amp;no='.$indir_sonuc1['no'].'',
	'{DOSYA_YORUM_EKLE}' => ''.'dosyalar.php?kosul=yorum_ekle',
	'{ACIKLAMA}' => $kp_dil_120,
	'{DOSYA_SIL}' => $kp_dil_116,
	'{DOSYA_DUZELT}' => $kp_dil_118,
	'{DOSYA_YAZDIR}' => $kp_dil_100,
	'{YAZDIR_SIMGE}' => $simge_yazdir,
	'{DOSYA_SIL_ONAY}' => $kp_dil_151,
	'{YORUM_GONDER}' => $kp_dil_150,
	'{YORUM_TEMIZLE}' => $kp_yonetim_65);
	
	$ornek1->dongusuz($dongusuz13);
	
	}


	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();

	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	
	}
	
	// DOSYAYA GÖRE İÇERİK SAYFASI AYARLARI SONU //	
	
	/*************************************************************************************/
	
	// KATEGORİLERE GÖRE DOSYA İNDİRME SAYFASI AYARLARI  //
	
	if (isset($_GET['kategorino']))
	{
	
	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 1):
	
	if ((isset($_GET['kategorino'])) AND (is_numeric($_GET['kategorino']) == true)) 
	{
	$_GET['kategorino'] = @zkTemizle($_GET['kategorino']);
	}
	else $_GET['kategorino'] = 0;


	// SEO ADRESİNİN DOĞRULUĞU KONTROL EDİLİYOR YANLIŞSA DOĞRU ADRESE YÖNLENDİRİLİYOR //
	$sorgu1111 = "select kategorino,kategoriadi from $tablo_portal_indirkategori where kategorino='$_GET[kategorino]' LIMIT 1";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$dosyalar_satir = $vt->fetch_assoc($sorgu1111_sonuc);
	$dogru_adres = seo($dosyalar_satir['kategoriadi']);

	if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') AND (!@preg_match("/-$dogru_adres.html/i", $_SERVER['REQUEST_URI'])) AND (!@preg_match('/dosyalar\.php\?/i', $_SERVER['REQUEST_URI'])) )
	{
		$yonlendir = linkverPortal('dosyalar.php?kategorino='.$dosyalar_satir['kategorino'], $dosyalar_satir['kategoriadi']);
		echo '<meta http-equiv="Refresh" content="0;url='.$yonlendir.'">';
		exit();
	}

/*
	$sayfa_adi = 'Dosyalar Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/dosyalar.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
*/

	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);

	
	if ($portal_ayarlar['kullanici_izni'] == 0){
	if ( empty($kullanici_kim['id']) )
	{
	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(KullaniciIzni());
	exit();
	}
  }
  
	if ((isset($_GET['s'])) AND (is_numeric($_GET['s']) == true)) $_GET['s'] = @zkTemizle($_GET['s']);
	else	$_GET['s'] = 0;
  
	if ((isset($_GET['kategorino'])) AND (is_numeric($_GET['kategorino']) == true)) 
	{
	$_GET['kategorino'] = @zkTemizle($_GET['kategorino']);
	}
	else 
	{
	echo $_GET['kategorino'];

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_535,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	$limit = $portal_ayarlar['dosya_sayfalama']; 
	$kosullar = "where kategorino='$_GET[kategorino]' ORDER BY tarih DESC"; 
	$tabloadi = $tablo_portal_indir; 

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
	$sorgu1ww = "select * from $tablo_portal_indirkategori where kategorino='$_GET[kategorino]'";
	$sor = $vt->query($sorgu1ww) or die ($vt->hata_ver());
	if (!$vt->num_rows($sor))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => $kp_dil_535,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	// VERİTABANINDAN BİLGİLER ÇEKİLİYOR //
	
	
	$vtsonuc57=$vt->query("SELECT * FROM $tabloadi $kosullar LIMIT $baslangic,$limit"); 
	
	$kac_secili=$vt->num_rows($vtsonuc57);
	
	

	$sayfala2 = '';

	if ($kac_secili == 0)
	{
	
	$ornek1->kosul('sa',array('{}' => ''), false);
	
	$ornek1->kosul('5', array('' => ''), true);
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);
	
	if ($kullanici_kim['yetki'] == 1)
	{
	$ornek1->kosul('14', array('{YENI_DOSYA_EKLE}' => $kp_dil_169), true);
	$ornek1->kosul('15', array('' => ''), false);
	}
	else
	{
	$ornek1->kosul('15', array('' => ''), true);
	$ornek1->kosul('14', array('{YENI_DOSYA_EKLE}' => ''), false);
	}
	
	}
	
	else 
	
	{
	$ornek1->kosul('sa',array('{}' => ''), true);
	
	$ornek1->kosul('6', array('' => ''), true);
	$ornek1->kosul('5', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);
	
	while ($indir = $vt->fetch_assoc($vtsonuc57)):

	// DOSYA İNDİRME İÇERİĞİ EKRANA YAZDIRILIYOR ///
	
  //	YÖNETİCİ İSE	VEYA YARDIMCI İSE //
  
	if ($kullanici_kim['yetki'] == 1)
	$ornek1->kosul('16', array('' => ''), true);	
	else $ornek1->kosul('16', array('' => ''), false);
	
	$dongu_1_[] = array(
	'{DOSYA_SIL_22}' => 'dosya_duzelt_sil.php?dosya=duzelt&amp;no='.$indir['no'].'',
	'{DOSYA_DUZELT_22}' => 'dosya_duzelt_sil.php?kosul=dosya_sil&amp;dosya=sil&amp;no='.$indir['no'].'&amp;kategorino='.$indir['kategorino'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{DOSYA_LINKI_11}' => '<a href="'.linkverPortal('dosyalar.php?no='.$indir['no'],$indir['dosya_baslik']).'">'.$indir['dosya_baslik'].'</a>',
	'{GET_KATEGORI_NO_}' => $_GET['kategorino'],
	'{GET_KATEGORI_NO_2}' => $indir['kategorino'],
	'{INDIR_NO_}' => $indir['no'],
	'{INDIR_BASLIK_}' => $indir['dosya_baslik'],
	'{INDIR_TARIH_}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $indir['tarih']),
	'{INDIR_BOYUT_}' => $indir['dosya_boyutu'],
	'{INDIR_LINK_}' => linkver('../profil.php?kim='.$indir['ekleyen'],$indir['ekleyen']),
	'{INDIR_EKLEYEN_}' => $indir['ekleyen'],
	'{INDIR_INDIRME_SAYISI_}' => $indir['indirme_sayisi'],
	'{INDIR_SIL_ONAY_}' => $kp_dil_151,
	'{INDIR_SIL_}' => $kp_dil_116,
	'{INDIR_DUZELT_}' => $kp_dil_118);
	
	endwhile;
	
	if (!isset($dongu_1_)){
	$dongu_1_[] = array(
	'{DOSYA_SIL_22}' => '',
	'{DOSYA_DUZELT_22}' => '',
	'{DOSYA_LINKI_11}' => '',
	'{GET_KATEGORI_NO_}' => '',
	'{GET_KATEGORI_NO_2}' => '',
	'{INDIR_NO_}' => $indir['no'],
	'{INDIR_BASLIK_}' => '',
	'{INDIR_TARIH_}' => '',
	'{INDIR_BOYUT_}' => '',
	'{INDIR_LINK_}' => '',
	'{INDIR_EKLEYEN_}' => '',
	'{INDIR_INDIRME_SAYISI_}' => '',
	'{INDIR_SIL_ONAY_}' => '',
	'{INDIR_SIL_}' => '',
	'{INDIR_DUZELT_}' => '');
	}
	
	$ornek1->tekli_dongu('4', $dongu_1_);
	
	// BİLGİLER EKRANA YAZDIRILIYOR - SONU //
	
	$sorgu1ww = "select kategorino,dosya_baslik from $tablo_portal_indir where kategorino='$_GET[kategorino]'";
	$sorgu1ww_sonuc = $vt->query($sorgu1ww) or die ($vt->hata_ver());
	$vtsonuc22ww = $vt->fetch_assoc($sorgu1ww_sonuc);

	$sonkat = $vt->fetch_assoc($sor);
	$sayfala2 .= sayfalama($limit,$sayfa,$satir_sayisi,'dosyalar.php?','&kategorino='.$_GET['kategorino'],$sonkat['kategoriadi'],$adresdeger='');

	}
	
	if ($kullanici_kim['yetki'] == 1)
	$ornek1->kosul('gi1', array('' => ''), true);
	else $ornek1->kosul('gi1', array('' => ''), false);
	
	$dongusuz13 = array(
	'{TEMA_DIZIN}' => $temadizini,
	'{SIMGE_SIL}' => $simge_sil,
	'{SIMGE_DUZELT}' => $simge_degistir,
	'{DOSYA_YOK_}' => $kp_dil_202,
	'{DOSYA_ADI_I}' => $kp_dil_102,
	'{DOSYA_INDIR2}' => $kp_dil_109,
	'{DOSYA_ADI2}' => $indir_sonuc1['dosya_baslik'],
	'{DOSYA_NO}' => $indir_sonuc1['no'],
	'{ARKA_TABLO}' => $arka_tablo,
	'{PORTAL_INDEX}' => 'dosyalar.php',
	'{DOSYA_RESIM}' => $indir_sonuc1['resim'],
	'{DUZENLEME}' => $duzenleme,
	'{BOYUT}' => $kp_dil_110,
	'{BOYUT_SONUCU}' => $indir_sonuc1['dosya_boyutu'],
	'{EKLEYEN}' => $kp_dil_111,
	'{EKLEYEN_LINKI}' => linkver('../profil.php?kim='.$indir_sonuc1['ekleyen'],$indir_sonuc1['ekleyen']),
	'{EKLEYEN_SONUCU}' => $indir_sonuc1['ekleyen'],
	'{EKLEME_TARIHI}' => $kp_dil_112,
	'{EKLEME_TARIHI_SONUCU}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $indir_sonuc1['tarih']),
	'{INDIRME_SAYISI}' => $kp_dil_113,
	'{INDIRME_SAYISI_SONUCU}' => $indir_sonuc1['indirme_sayisi'],
	'{DOSYALAR}' => $kp_dil_123,
	'{DUZENLEME2}' => $kp_dil_135,
	'{YENI_DOSYA_EKLE}' => $yeni_dosya_ekle,
	'{YENI_DOSYA_EKLE2}' => 'dosya_yukle.php',
	'{SAYFALAMA2}' => $sayfala2,
	'{DOSYA_EKLEME}' => '<a href="dosya_yukle.php">'.$kp_dil_169.'</a>');
	
	$ornek1->dongusuz($dongusuz13);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);


	exit();
	
	else:
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;
	}



	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 1)
	{
	
	// KATEGORİLERE GÖRE DOSYA İNDİRME SAYFASI AYARLARI - SONU //	
	
	/*************************************************************************************/
	
	// KATEGORİLER SAYFASI //

/*
	$sayfa_adi = 'Dosya Kategori Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/dosyalar.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
*/

	$ornek1->kosul('7', array('' => ''), false);
	$ornek1->kosul('6', array('' => ''), false);
	$ornek1->kosul('5', array('' => ''), false);
	$ornek1->kosul('4', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), true);

	// VERİTABANINDAN BİLGİLER ÇEKİLİYOR //
	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = $portal_ayarlar['dosya_dal_limit']; 
	$kosullar = "order by kategorino desc"; 
	$tabloadi = $tablo_portal_indirkategori; 

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
	
	$vtsorgu = "SELECT * FROM $tabloadi $kosullar LIMIT $baslangic,$limit";
	
	$vtsonuc116 = $vt->query($vtsorgu);

	if ($vt->num_rows($vtsonuc116))
	{
	while ($indir_satir = $vt->fetch_assoc($vtsonuc116)):

	//	FORUMDAKİ BAŞLIKLARIN SAYISI SON DOSYALAR VE YORUMLAR YAZDIRILIYOR	//
	
	$lg_sorgu3 = "SELECT yorumlayan,yorum_tarih,yorum_icerik FROM $tablo_portal_indiryorum where kategorino='$indir_satir[kategorino]' ORDER BY yorum_tarih DESC LIMIT 0,1";
	
	$vtsonuclar9 = $vt->query($lg_sorgu3);
	
	$icerik3 = $vt->fetch_assoc($vtsonuclar9);
	
    $son_yorum_sayi = $vt->num_rows($vtsonuclar9);
	
	
	$lg_sorgu4 = "SELECT ekleyen,dosya_baslik,tarih FROM $tablo_portal_indir where kategorino='$indir_satir[kategorino]' ORDER BY tarih DESC LIMIT 0,1";
	
	$vtsonuclar8 = $vt->query($lg_sorgu4);
	
	$icerik4 = $vt->fetch_assoc($vtsonuclar8);
	
    $son_dosya_sayi = $vt->num_rows($vtsonuclar8);
	
	
	$lg_sorgu2 = $vt->query("SELECT * FROM $tablo_portal_indiryorum WHERE kategorino='$indir_satir[kategorino]'");
	
	$icerik2 = $vt->num_rows($lg_sorgu2);
	
	
	$lg_sorgu = $vt->query("SELECT * FROM $tablo_portal_indir WHERE kategorino='$indir_satir[kategorino]'");
	
	$icerik = $vt->num_rows($lg_sorgu);

	
	$dosya4 = '';
	
	if (!$vt->num_rows($vtsonuclar8))
	{
	$dosya4 .=  '';
	}
	else 
	{
	$dosya4 .=  '
	<font face="Verdana" style="font-size: 10px">
	<a href="'.linkver('../profil.php?kim='.$icerik4['ekleyen'],$icerik4['ekleyen']).'">'.$icerik4['ekleyen'].'</a>
	<br />'.mb_substr($icerik4['dosya_baslik'],0,15, 'utf-8').'...
	<br>'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $icerik4['tarih']).'</font>';
	}

	$dosya5 = '';
	
	if (!$vt->num_rows($vtsonuclar9))
	{
	$dosya5 .= '';
	}
	else
	{
	$dosya5 .= '
	<font face="Verdana" style="font-size: 10px">
	<a href="'.linkver('../profil.php?kim='.$icerik3['yorumlayan'],$icerik3['yorumlayan']).'">'.$icerik3['yorumlayan'].'</a>
	<br />'.mb_substr($icerik3['yorum_icerik'],0,15, 'utf-8').'...
	<br>'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $icerik3['yorum_tarih']).'</font>';
	}	
	
	$dongu11[] = array(
	'{DOSYA_SONUC}' => $dosya4,
	'{YORUM_SONUC}' => $dosya5,
	'{ARAMA_YAP}' => $kp_dil_176,
	'{ARAMA_BASLAT}' => $kp_dil_49,
	'{KATEGORI_NO}' => $indir_satir['kategorino'],
	'{DOSYA_DALI_LINKI}' => linkverPortal('dosyalar.php?kategorino='.$indir_satir['kategorino'],$indir_satir['kategoriadi']),
	'{KATEGORI_ADI}' => $indir_satir['kategoriadi'],
	'{ICERIK}' => $icerik,
	'{ICERIK_2}' => $icerik2);
	
	
	
	endwhile;
	
	
	}
	else
	{
	$dongu11[] = array(
	'{DOSYA_SONUC}' => '',
	'{YORUM_SONUC}' => '',
	'{ARAMA_YAP}' => '',
	'{ARAMA_BASLAT}' => '',
	'{KATEGORI_NO}' => '',
	'{DOSYA_DALI_LINKI}' => '',
	'{KATEGORI_ADI}' => '</a>'.$kp_dil_396.'',
	'{ICERIK}' => '',
	'{ICERIK_2}' => '');
	}
	
	$ornek1->tekli_dongu('1',$dongu11);
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'dosyalar.php?',$adresdeger='');
	
	$dongusuz10 = array(
	'{SAYFALAMA}' => $tablo,
	'{TEMA_DIZIN}' => $temadizini,
	'{ARKA_TABLO}' => $arka_tablo,
	'{PORTAL_INDEX}' => 'dosyalar.php',
	'{DOSYA_KATEGORILERI}' => $kp_dil_130,
	'{KATEGORI}' => $kp_dil_126,
	'{SON_DOSYALAR}' => $kp_dil_170,
	'{SON_YORUMLAR}' => $kp_dil_171,
	'{DOSYALAR3}' => $kp_dil_127,
	'{RESIM}' => $kp_dil_42,
	'{YORUMLAR}' => $kp_dil_172,
	'{DOSYA_EKLEME}' => '<a href="dosya_yukle.php">'.$kp_dil_169.'</a>');

	$ornek1->dongusuz($dongusuz10);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);


	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'dosyalar.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	// KATEGORİLER SAYFASI - SONU //

/*************************************************************************************/

?>