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


	define('DOSYA_SITE_EKLE',true);
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include 'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';


	$sayfa_adi = 'Siteler Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/site_ekle.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));


	if ($kosul == 'yeni_site_ekle')
	{
	
	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1)
	{

	#######################################################
	#######################################################

	if (isset($_GET['site'])) $site = $_GET['site'];
	if ((isset($site)) AND ($site=='duzelt'))
	{
	if ($kullanici_kim['yetki'] !=1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './giris.php?git=giris',
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__4,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}



	$ornek1->kosul('3', array('' => ''), true);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), false);

/*
	$sayfa_adi = 'Yeni Site Düzeltme Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/


	if (is_numeric($_GET['site_id']) == true) $_GET['site_id'] = @zkTemizle($_GET['site_id']);
	else $_GET['site_id'] = 0;

	$sorgu = "SELECT * FROM $tablo_portal_siteekle WHERE site_id='$_GET[site_id]' LIMIT 1";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	$vtsonuc1 = $vt->fetch_assoc($sorgu_sonuc);

	if (!$vt->num_rows($sorgu_sonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php',
	'{ILETI}' => $kp_dil_457,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	
	

	$Sorgu = "SELECT * FROM $tablo_portal_siteekledal order by tarih desc";
	$dal_sonuc = @$vt->query($Sorgu) or die ($vt->hata_ver());

	$dal_secenek ='';
	
	while ($dallar = $vt->fetch_array($dal_sonuc)):


	$dal_secenek .='<option value="'.$dallar['dal_no'].'"'; 
	if ($dallar['dal_no'] == $vtsonuc1['dal_no']) $dal_secenek .=' selected="selected"'; 
	$dal_secenek .='>'.$dallar['baslik'].''; 
	$dal_secenek .='</option>';

	endwhile;
	
	$java = '<script type="text/javascript">
	<!-- //

	function txtmesajsay()
	{
	document.form1.sayac.value=200-document.form1.aciklama.value.length;
	if (document.form1.sayac.value<0)
	{
	alert ("'.$kp_dil_307.'");
	document.form1.aciklama.value = document.form1.aciklama.value.substr(0,200);
	document.form1.sayac.value=0;
	}
	return true;
	}

	
	function denetle5()
{ 
	var dogruMu = true;
	if ((document.form1.aciklama.value.length < 3) || (document.form1.site_title.value.length < 3) || (document.form1.adres.value.length < 12)) 
	{ 
		dogruMu = false; 
		alert("'.$kp_dil_458.'");
	}
	return dogruMu;
}
	//  -->
	</script>';

	$ornek1->dongusuz(array(
	'{JAVA_SCRIPT}' => $java,
	'{ARKA_TABLO}' => $arka_tablo,
	'{SADECE_DUZ_METIN}' => $kp_dil_418,
	'{SITE_DUZELT_SECENEK}' => '1',
	'{SITE_ID}' => $vtsonuc1['site_id'],
	'{SITE_ADI}' => $kp_dil_446,
	'{SITE_ADI2}' => $vtsonuc1['site_title'],
	'{SITE_RESIM2}' => $vtsonuc1['site_resim'],
	'{ACIKLAMA2}' => $vtsonuc1['aciklama'],
	'{ADRES2}' => $vtsonuc1['adres'],
	'{RESIM_ADRESI}' => $kp_dil_459,
	'{SITE_ADRESI}' => $kp_dil_447,
	'{SITE_EKLE}' => $kp_dil_461,
	'{SITE_EKLEME_SAYFASI}' => 'site_ekle.php?kosul=siteyi_ekle',
	'{KATEGORI_SECIN}' => $kp_dil_271,
	'{ACIKLAMA}' => $kp_dil_265,
	'{EN_FAZLA}' => $kp_dil_272,
	'{KARAKTER}' => $kp_dil_273,
	'{EKLE}' => $kp_dil_461,
	'{DAL_SECENEK}' => $dal_secenek));
	

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();
	}


	#######################################################
	#######################################################


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



	$ornek1->kosul('3', array('' => ''), true);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('1', array('' => ''), false);

/*
	$sayfa_adi = 'Yeni Site Ekleme Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/


	$Sorgu1 = "select dal_no,baslik from $tablo_portal_siteekledal order by tarih desc";
	$Sorgu_kontrol1 = $vt->query($Sorgu1) or die ($vt->hata_ver());

	if (!$vt->num_rows($Sorgu_kontrol1))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './'.'site_ekle.php',
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
	$dal_secenek .= '<option value="'.$Sorgu_sonuc1['dal_no'].'">'.$Sorgu_sonuc1['baslik'].'</option>';
	}
	
	$java = '<script type="text/javascript">
	<!-- //

	function txtmesajsay()
	{
	document.form1.sayac.value=200-document.form1.aciklama.value.length;
	if (document.form1.sayac.value<0)
	{
	alert ("'.$kp_dil_307.'");
	document.form1.aciklama.value = document.form1.aciklama.value.substr(0,200);
	document.form1.sayac.value=0;
	}
	return true;
	}

	
	function denetle5()
{ 
	var dogruMu = true;
	if ((document.form1.aciklama.value.length < 3) || (document.form1.site_title.value.length < 3) || (document.form1.adres.value.length < 12)) 
	{ 
		dogruMu = false; 
		alert("'.$kp_dil_458.'");
	}
	return dogruMu;
}
	//  -->
	</script>';
	

	$ornek1->dongusuz(array(
	'{JAVA_SCRIPT}' => $java,
	'{ARKA_TABLO}' => $arka_tablo,
	'{SADECE_DUZ_METIN}' => $kp_dil_418,
	'{SITE_ADI}' => $kp_dil_446,
	'{SITE_DUZELT_SECENEK}' => '0',
	'{SITE_ID}' => '',
	'{SITE_ADI2}' => '',
	'{SITE_RESIM2}' => 'http://',
	'{ACIKLAMA2}' => '',
	'{ADRES2}' => 'http://',
	'{RESIM_ADRESI}' => $kp_dil_459,
	'{SITE_ADRESI}' => $kp_dil_447,
	'{SITE_EKLE}' => $kp_dil_444,
	'{SITE_EKLEME_SAYFASI}' => 'site_ekle.php?kosul=siteyi_ekle',
	'{KATEGORI_SECIN}' => $kp_dil_271,
	'{ACIKLAMA}' => $kp_dil_265,
	'{EN_FAZLA}' => $kp_dil_272,
	'{KARAKTER}' => $kp_dil_273,
	'{EKLE}' => $kp_dil_460,
	'{DAL_SECENEK}' => $dal_secenek));

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);





	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'site_ekle.php',
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

	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////



	if ($kosul == 'siteyi_ekle')
	{
	
	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1)
	{
	
	if ((isset($_GET['site_duzelt_secenek'])) AND ($_GET['site_duzelt_secenek'] =='1'))
	{
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php?sd='.$_POST['sd'].'',
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	}
	

	// SİTE EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR //
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
	// SİTE EKLEMEYE ÇALIŞAN KİŞİ ÜYE DEĞİLSE UYARILIYOR - SONU //

	// ZARARLI KARAKTERLER TEMİZLENİYOR //

	if (get_magic_quotes_gpc())
	$resim_adres = @zkTemizle2(stripslashes($_POST['ekle']));

	// magic_quotes_gpc kapalıysa //
	else $resim_adres = @zkTemizle2($_POST['ekle']);
	
	if ( (!@getimagesize($resim_adres)) AND (preg_match('/^http(s):\/\//i', $resim_adres))
	OR (!@getimagesize($resim_adres)) AND (preg_match('/^ftp:\/\//i', $resim_adres)) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php?kosul=yeni_site_ekle',
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
	'{ADRES}' => './site_ekle.php?kosul=yeni_site_ekle',
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
	'{ADRES}' => './site_ekle.php?kosul=yeni_site_ekle',
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
	'{ADRES}' => './site_ekle.php?kosul=yeni_site_ekle',
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
	'{ADRES}' => './site_ekle.php?kosul=yeni_site_ekle',
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

	$dosya_yolu = $resim_adres;

	if (($genislik > 500) OR ($yukseklik > 100))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php?kosul=yeni_site_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_462,
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
        $_POST['site_title'] = @ileti_yolla(stripslashes($_POST['site_title']),1);
        $_POST['aciklama'] = @ileti_yolla(stripslashes($_POST['aciklama']),2);
    }

    // magic_quotes_gpc kapalıysa //
    else
    {
        $_POST['site_title'] = @ileti_yolla($_POST['site_title'],1);
        $_POST['aciklama'] = @ileti_yolla($_POST['aciklama'],2);
    }
	
	// magic_quotes_gpc açıksa //
	if (get_magic_quotes_gpc())
	$_POST['adres'] = @zkTemizle2(stripslashes($_POST['adres']));

	// magic_quotes_gpc kapalıysa //
	else $_POST['adres'] = @zkTemizle2($_POST['adres']);


	// ZARARLI KARAKTERLER TEMİZLENİYOR - SONU //
	
	
	
	
	
	
	
	
	
	
	
	
	

	// GELEN DAL NOSU NÜMERİK DEĞİLSE DEĞERİ 0 YAPILIYOR //
	if (is_numeric($_POST['sd']) == true) $_POST['sd'] = @zkTemizle($_POST['sd']);
	else $_POST['sd'] = 0;


	$tarih = time(); // tarih bilgisi alınıyor.

	if ($kullanici_kim['yetki'] == 1) $site_onay = '1'; // resmi yükleyen yöneticiyse resim onaylanıyor.
	else $site_onay = '0'; // resmi yükleyen yöneti değilse resim onaylanmıyor.

	
	/* SITE ADI VE AÇIKLAMASI BEKLENEN KARAKTERDEN FAZLAYSA VEYA AZ İSE UYARI VERİLİYOR */
	if ((strlen($_POST['aciklama']) < 3) OR (strlen(utf8_decode($_POST['aciklama'])) > 250) OR (strlen($_POST['site_title']) < 3) OR (strlen(utf8_decode($_POST['site_title'])) > 60))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php?kosul=yeni_site_ekle',
	'{ILETI}' => $kp_dil_463,
	'{EK_YAZI}' => $kp_dil_464,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	/* SITE ADI VE AÇIKLAMASI BEKLENEN KARAKTERDEN FAZLAYSA VEYA AZ İSE UYARI VERİLİYOR - SONU */

	////////////////////////////////////////////////////////
	
	@preg_match('@^(?:http://)?(?:https://)?([^/]+)@i',$_POST['adres'], $donustur);
	$sitenin_adresi = $donustur[1];
	$websayfasi_sonuc = 'http://'.$sitenin_adresi;


	@preg_match('/[^.]+\.[^.]+$/', $sitenin_adresi, $donustur);
	$www = @$donustur[0];
	
	////////////////////////////////////////////////////////
	$sorgula_web = $vt->query("select * from $tablo_portal_siteekle");



	if ( (!isset($www)) OR ($www =='') )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php?kosul=yeni_site_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_540,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

	while ($sorgula_web_sonuc = $vt->fetch_assoc($sorgula_web))
	{
	@preg_match('@^(?:http://)?([^/]+)@i',$sorgula_web_sonuc['adres'], $donustur2);
	$sitenin_adresi2 = $donustur2[1];
	
	@preg_match('/[^.]+\.[^.]+$/', $sitenin_adresi2, $donustur2);
	$www2 = @$donustur2[0];

	////////////////////////////////////////////////////////
	
	if ( ($_POST['site_duzelt_secenek'] != 1) AND ($www == $www2) )
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php?kosul=yeni_site_ekle',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_486.' !',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}
	
	if ((isset($_POST['site_duzelt_secenek'])) AND ($_POST['site_duzelt_secenek'] =='1'))
	{
	// SITE DUZELTİLİYOR //
	$vtsorgu = "UPDATE $tablo_portal_siteekle SET dal_no='$_POST[sd]',site_title='$_POST[site_title]',adres='$websayfasi_sonuc',site_resim='$_POST[ekle]',aciklama='$_POST[aciklama]' WHERE site_id='$_POST[site_id]' LIMIT 1";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	// SITE DUZELTİLİYOR - SONU //
	}
	else
	{
	// SITE VERİTABANINA KAYDEDİLİYOR //
	$vtsorgu = "INSERT INTO $tablo_portal_siteekle (dal_no, tarih, site_title, adres, site_onay, aciklama, ekleyen, site_resim, oy_verenler)";
	$vtsorgu .= "VALUES ('$_POST[sd]','$tarih','$_POST[site_title]','$websayfasi_sonuc','$site_onay','$_POST[aciklama]','$kullanici_kim[kullanici_adi]','$dosya_yolu',',')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	// SITE VERİTABANINA KAYDEDİLİYOR - SONU //
	}


	// BİLGİ İLETİSİ YAZDIRILIYOR YETKİYE GÖRE //
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './site_ekle.php',
	'{ILETI}' => $kp_dil_288,
	'{EK_YAZI}' => $kp_dil_289,
	'{YONLENDIRME}' => $kp_dil_290 ,
	'{YONLENDIRME2}' => $ileti__2);
	}
	elseif ((isset($_POST['site_duzelt_secenek'])) AND ($_POST['site_duzelt_secenek'] =='1'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './site_ekle.php',
	'{ILETI}' => $kp_dil_465,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=./site_ekle.php">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './site_ekle.php',
	'{ILETI}' => $kp_dil_466,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="3; url=./site_ekle.php">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);
	}

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));


	// BİLGİ İLETİSİ YAZDIRILIYOR YETKİYE GÖRE - SONU //

	
	
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'site_ekle.php',
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
	
	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	
	
	
	if ($kosul == 'site_oy_ver')
	{
	
	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1)
	{

	if (is_numeric($_GET['site_id']) == true) $_GET['site_id'] = @zkTemizle($_GET['site_id']);
	else $_GET['site_id'] = 0;

	$vtsorgu33 =   "SELECT oy_verenler,site_id FROM $tablo_portal_siteekle where site_id='$_GET[site_id]' AND oy_verenler like '%,$kullanici_kim[id],%'";
	$oy_verenler = $vt->query($vtsorgu33) or die ($vt->hata_ver());

	// DAHA ÖNCE OY VERMİŞSE UYARILIYOR //
	if ((!$puanveren = $vt->num_rows($oy_verenler)) == 0)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php',
	'{ILETI}' => $kp_dil_467,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();	
	}
	// DAHA ÖNCE OY VERMİŞSE UYARILIYOR -SONU //

	// OY VERMEYE ÇALIŞAN KİŞİ ZİYARETCİYSE UYARILIYOR //
	if (empty($kullanici_kim['id']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php',
	'{ILETI}' => $kp_dil_468,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// OY VERMEYE ÇALIŞAN KİŞİ ZİYARETCİYSE UYARILIYOR - SONU //

	// VERİTABANINA OY VE ÜYE ID KAYDEDİLİYOR //

	$vtsorgu = "UPDATE $tablo_portal_siteekle SET site_oy=site_oy +1 where site_id='$_GET[site_id]' LIMIT 1";
	$vtsonuc6 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	unset($vtsorgu);
	unset($vtsonuc6);
	unset($vtsonuc7);

	$vtsorgu = "Select oy_verenler from $tablo_portal_siteekle where site_id='$_GET[site_id]'";
	$vtsonuc6 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	$vtsonuc7 = $vt->fetch_assoc($vtsonuc6);

	$kul_id = $kullanici_kim['id'].',';

	unset($vtsorgu);
	unset($vtsonuc6);
	unset($vtsonuc7);

	$vtsorgu = "UPDATE $tablo_portal_siteekle SET oy_verenler=CONCAT(oy_verenler,'$kul_id') where site_id='$_GET[site_id]' LIMIT 1";
	$vtsonuc6 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	// VERİTABANINA OY VE ÜYE ID KAYDEDİLİYOR  - SONU //

	// BİLGİ İLETİSİ EKRANA YAZDIRILIYOR //
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './site_ekle.php?sd='.$_GET['sd'],
	'{ILETI}' => $kp_dil_469,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./site_ekle.php?sd='.$_GET['sd'].'">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	// BİLGİ İLETİSİ EKRANA YAZDIRILIYOR - SONU //

	
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'site_ekle.php',
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
	
	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	
	
	if ($kosul == 'site_sil')
	{
	
	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1)
	{

	// SİTEYİ SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR //
	if ($kullanici_kim['yetki'] != 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php?sd='.$_POST['sd'],
	'{ILETI}' => $kp_dil_279,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// SİTEYİ SİLMEYE ÇALIŞAN KİŞİ YÖNETİCİ DEĞİLSE UYARILIYOR - SONU //
	
	if (isset($_GET['anahtar'])) $_GET['anahtar'] = @zkTemizle($_GET['anahtar']);
	else $_GET['anahtar'] = 0;
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'site_ekle.php?sd='.$_GET['sd'],
	'{ILETI}' => $kp_dil_487.'<br>'.$_GET['anahtar'].'<br>'.$portal_ayarlar['sil_anahtar'],
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
	
	
	if ((isset($_GET['site_id'])) AND (is_numeric($_GET['site_id']) == true)) $_GET['site_id'] = @zkTemizle($_GET['site_id']);
	else $_GET['site_id'] = 0;

	$sorgu = "SELECT site_id FROM $tablo_portal_siteekle WHERE site_id='$_GET[site_id]' LIMIT 1";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	$vtsonuc = $vt->fetch_assoc($sorgu_sonuc);

	// BÖYLE BİR SİTE YOKSA UYARILIYOR //
	if (!$vt->num_rows($sorgu_sonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => './site_ekle.php',
	'{ILETI}' => $kp_dil_457,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	// BÖYLE BİR SİTE YOKSA UYARILIYOR - SONU //


	// SİTE VARSA SİLİNİYOR //

	$sil_sorgu = "DELETE FROM $tablo_portal_siteekle WHERE site_id='$_GET[site_id]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './site_ekle.php?sd='.$_GET['sd'],
	'{ILETI}' => $kp_dil_470,
	'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./site_ekle.php?sd='.$_GET['sd'].'">',
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));

	// SİTE VARSA SİLİNİYOR - SONU //

	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'site_ekle.php',
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

	
	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	
	if ($kosul == "siteye_yonlendiriliyor")
	{
	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1)
	{	
		
	if ((isset($_GET['site_id'])) AND (is_numeric($_GET['site_id']) == true)) $_GET['site_id'] = @zkTemizle($_GET['site_id']);
	else $_GET['site_id'] = 0;
		
	$vtsorgu = "SELECT * FROM $tablo_portal_siteekle WHERE site_id='$_GET[site_id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	if (!$vt->num_rows($vtsonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'site_ekle.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => $kp_dil_457,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();	
	}

	$yonlendirme = $vt->fetch_assoc($vtsonuc);

	$vt->query("UPDATE $tablo_portal_siteekle SET tiklama_sayisi=tiklama_sayisi +1 WHERE site_id='$_GET[site_id]'") or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_dil_471,
	'{ADRES}' => $yonlendirme['adres'],
	'{ILETI}' => '<meta http-equiv="Refresh" content="2; url='.$yonlendirme['adres'].'">',
	'{EK_YAZI}' => $kp_dil_472,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	}

	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'site_ekle.php',
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
	

	
	
	//////////////////////////////////////////////////////
	//////////////////////////////////////////////////////
	
	
	if (isset($_GET['sd']))
	{
	
	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1)
	{
	
	$ornek1->kosul('2', array('' => ''), true);
	$ornek1->kosul('1', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);


	if (is_numeric($_GET['sd']) == true) $_GET['sd'] = @zkTemizle($_GET['sd']);
	else $_GET['sd'] = 0;


	// SEO ADRESİNİN DOĞRULUĞU KONTROL EDİLİYOR YANLIŞSA DOĞRU ADRESE YÖNLENDİRİLİYOR //
	$sorgu1111 = "select dal_no,baslik from $tablo_portal_siteekledal where dal_no='$_GET[sd]' LIMIT 1";
	$sorgu1111_sonuc = $vt->query($sorgu1111) or die ($vt->hata_ver());
	$siteler_satir = $vt->fetch_assoc($sorgu1111_sonuc);
	$dogru_adres = seo($siteler_satir['baslik']);

	if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') AND (!@preg_match("/-$dogru_adres.html/i", $_SERVER['REQUEST_URI'])) AND (!@preg_match('/site_ekle\.php\?/i', $_SERVER['REQUEST_URI'])) )
	{
		$yonlendir = linkverPortal('site_ekle.php?sd='.$siteler_satir['dal_no'], $siteler_satir['baslik']);
		header('Location:'.$yonlendir);
		exit();
	}

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;

	$limit = $portal_ayarlar['siteler_limit']; 
	$kosullar = "where dal_no='$_GET[sd]' AND site_onay='1' order by site_oy desc"; 
	$tabloadi = $tablo_portal_siteekle; 

	$vtsorgu = $vt->query("SELECT site_id FROM $tabloadi $kosullar");
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@$sayfa = abs(intval($_GET['s'] ) );
	if(empty($sayfa) || $sayfa > ceil($satir_sayisi/$limit ))
	{
	$sayfa = 1; 
	$baslangic = 0;
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}

	$Sorgu = $vt->query("select * from $tabloadi $kosullar LIMIT $baslangic,$limit");

/*
	$sayfa_adi = 'Siteler Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/


	if (!$vt->num_rows($Sorgu))
	{
	if ($kullanici_kim['yetki'] == 1)
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_3,
	'{ADRES}' => 'site_ekle.php',
	'{ILETI}' => $kp_dil_442,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);
	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_3,
	'{ADRES}' => 'site_ekle.php',
	'{ILETI}' => $kp_dil_442,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);
	}

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}


	While ($siteler = $vt->fetch_assoc($Sorgu))
	{
	$site_oy_sistemi = '';

	if ($siteler['site_oy'] <= 9)
	{
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	}
	elseif ($siteler['site_oy'] <= 19)
	{
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	}
	elseif ($siteler['site_oy'] <= 29)
	{
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	}
	elseif ($siteler['site_oy'] <= 39)
	{
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	}
	elseif ($siteler['site_oy'] >= 40)
	{
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_oy_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	}
	
	
	
	
	$site_hit_sistemi = '';

	if ($siteler['tiklama_sayisi'] <= 9)
	{
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	}
	elseif ($siteler['tiklama_sayisi'] <= 19)
	{
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	}
	elseif ($siteler['tiklama_sayisi'] <= 29)
	{
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	}
	elseif ($siteler['tiklama_sayisi'] <= 39)
	{
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan2.png" border="" alt="" width="15" height="15">';
	}
	elseif ($siteler['tiklama_sayisi'] >= 40)
	{
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	$site_hit_sistemi .= '<img src="temalar/'.$temadizini.'/resimler/resimler/puan1.png" border="" alt="" width="15" height="15">';
	}

	$aciklama_sonuc = wordwrap($siteler['aciklama'],60, "<br>\n");


	$site_oy_dugmesi = '';
	$site_oy_dugmesi2 = '';
	$sil11 = '';
	$sil12 = '';
	$duzelt11 = '';
	$duzelt12 = '';

	$vtsorgu33 =   "SELECT oy_verenler,site_id FROM $tablo_portal_siteekle  where site_id='$siteler[site_id]' AND oy_verenler like '%,$kullanici_kim[id],%'";
	$oy_verenler = $vt->query($vtsorgu33) or die ($vt->hata_ver());
	
	if (!empty($kullanici_kim['id']))
	{
	if (($puanveren = $vt->num_rows($oy_verenler)) == 0)
	{
	$site_oy_dugmesi .= '<a href="site_ekle.php?kosul=site_oy_ver&amp;site_id='.$siteler['site_id'].'&amp;sd='.$siteler['dal_no'].'">'.$galeri_simge_puanver.'</a>';
	}
	else
	{
	$site_oy_dugmesi .= $galeri_simge_puanverilmis;
	}
	}
	else
	{
	$site_oy_dugmesi .= '<a href="giris.php?git=giris">'.$galeri_simge_girisyap.'</a>';
	}

	if ($kullanici_kim['yetki'] == 1)
	{
	$sil11 .= 'site_ekle.php?kosul=site_sil&amp;site_id='.$siteler['site_id'].'&amp;sd='.$siteler['dal_no'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'];
	$sil12 .= $simge_sil2;
	$duzelt11 .= 'site_ekle.php?kosul=yeni_site_ekle&amp;site=duzelt&amp;site_id='.$siteler['site_id'].'&amp;sd='.$siteler['dal_no'];
	$duzelt12 .= $galeri_simge_duzelt;
	}

	$site_adres = str_replace(array('http://', 'https://', 'www.'), '', $siteler['adres']);


	$site_dondur[] = array(
	'{TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $siteler['tarih']),
	'{TOPLAM_PUAN}' => $site_oy_sistemi,
	'{TOPLAM_HIT_SISTEMI}' => $site_hit_sistemi,
	'{SIL}' => $sil11,
	'{SIL2}' => $sil12,
	'{SIL_UYARISI}' => $kp_dil_151,
	'{DUZELT}' => $duzelt11,
	'{DUZELT2}' => $duzelt12,
	'{PUAN_VER}' => $site_oy_dugmesi,
	'{SITE_BASLIK}' => $siteler['site_title'],
	'{SITE_ADRES}' => $site_adres,
	'{SITE_ADRES3}' => 'site_ekle.php?kosul=siteye_yonlendiriliyor&amp;site_id='.$siteler['site_id'],
	'{ACIKLAMA}' => $aciklama_sonuc,
	'{EKLEYEN}' => '<a href="'.linkver('../profil.php?kim='.$siteler['ekleyen'],$siteler['ekleyen']).'">'.$siteler['ekleyen'].'</a>',
	'{HIT}' => $siteler['tiklama_sayisi'],
	'{TOPLAM_OY}' => $siteler['site_oy'],
	'{SITE_RESIM}' => $siteler['site_resim']);


	}
	
	$sorgu1ww = "select dal_no,baslik from $tablo_portal_siteekledal where dal_no='$_GET[sd]'";
	$sorgu1ww_sonuc = $vt->query($sorgu1ww) or die ($vt->hata_ver());
	$vtsonuc22ww = $vt->fetch_assoc($sorgu1ww_sonuc);
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'site_ekle.php?','&sd='.$_GET['sd'],$vtsonuc22ww['baslik'].'',$adresdeger='');
	
	$sorgula ="select * from $tablo_portal_siteekledal where dal_no='$_GET[sd]'";
	$sorgula_sonuc = $vt->query($sorgula) or die ($vt->hata_ver());
	$vtsonuc = $vt->fetch_assoc($sorgula_sonuc);
	
	$site_dongusuz = array(
	'{SAYFALAMA}' => $tablo,
	'{HANGI_KATEGORI}' => $vtsonuc['baslik'],
	'{SITELER}' => $kp_dil_443,
	'{SITELER_ADRES}' => 'site_ekle.php',
	'{SITE_EKLE_SAYFASI}' => $kp_dil_444,
	'{SITE_EKLE_SAYFASI_LINK}' => 'site_ekle.php?kosul=yeni_site_ekle',
	'{TARIH2}' => $kp_dil_445,
	'{SITE_BASLIK2}' => $kp_dil_446,
	'{SITE_ADRES2}' => $kp_dil_447,
	'{ACIKLAMA2}' => $kp_dil_448,
	'{EKLEYEN2}' => $kp_dil_449,
	'{TOPLAM_HIT}' => $kp_dil_450,
	'{OY}' => $kp_dil_451,
	'{SITE_RESIM2}' => $kp_dil_452);

	$ornek1->dongusuz($site_dongusuz);

	$ornek1->tekli_dongu('1',$site_dondur);


	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);

	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'site_ekle.php',
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
	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////

	
	
	
	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1)
	{

	$ornek1->kosul('1', array('' => ''), true);
	$ornek1->kosul('2', array('' => ''), false);
	$ornek1->kosul('3', array('' => ''), false);
	
	
	
	$sayfa_adi = 'Site Kategori Sayfası';

	
	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = $portal_ayarlar['siteler_dal_limit']; 
	$kosullar = "order by tarih desc"; 
	$tabloadi = $tablo_portal_siteekledal; 

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

/*
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
*/


	While ($siteler = $vt->fetch_assoc($Sorgu))
	{
	
	$Sorgu_a2 = "select site_onay,dal_no from $tablo_portal_siteekle where dal_no='$siteler[dal_no]' AND site_onay='1'";
	$Sorgu_kontrol_a2 = $vt->query($Sorgu_a2) or die ($vt->hata_ver());
	$Sorgu_sonuc_a2 = $vt->num_rows($Sorgu_kontrol_a2);


	$site_dondur2[] = array(
	'{TARIH}' => $siteler['tarih'],
	'{TOPLAM_SITE2}' => $Sorgu_sonuc_a2,
	'{KATEGORI_BASLIK}' => '<a href="'.linkverPortal('site_ekle.php?sd='.$siteler['dal_no'],$siteler['baslik']).'">'.$siteler['baslik'].'</a>',
	'{DAL_NO}' => $siteler['dal_no']);


	}
	
	$Sorgu_a2 = "select * from $tablo_portal_siteekle where site_onay='1'";
	$Sorgu_kontrol_a2 = $vt->query($Sorgu_a2) or die ($vt->hata_ver());
	$Sorgu_sonuc_a2 = $vt->num_rows($Sorgu_kontrol_a2);

	$Sorgu_a3 = "select * from $tablo_portal_siteekle where site_onay='1' order by tarih desc limit 1";
	$Sorgu_kontrol_a3 = $vt->query($Sorgu_a3) or die ($vt->hata_ver());
	$Sorgu_sonuc_a3 = $vt->fetch_assoc($Sorgu_kontrol_a3);
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'site_ekle.php?',$adresdeger='');	
	
	
	$site_dongusuz2 = array(
	'{BURADA}' => $kp_dil_299,
	'{SITE_VAR}' => $kp_dil_484,
	'{TOPLAM_SITE_SAYISI}' => $Sorgu_sonuc_a2,
	'{SON_YUKLENEN2}' => $kp_dil_485,
	'{SON_SITE_BILGISI}' => $Sorgu_sonuc_a3['site_title'],
	'{SON_SITE_ADRESI}' => 'site_ekle.php?kosul=siteye_yonlendiriliyor&amp;site_id='.$Sorgu_sonuc_a3['site_id'],
	'{SAYFALAMA}' => $tablo,
	'{SITE_EKLE_SAYFASI}' => $kp_dil_444,
	'{SITE_EKLE_SAYFASI_LINK}' => 'site_ekle.php?kosul=yeni_site_ekle',
	'{SITELER_KATEGORILERI}' => $kp_dil_453,
	'{KATEGORI}' => $kp_dil_454,
	'{TOPLAM_SITE}' => $kp_dil_455,
	'{RESIM}' => $kp_dil_456,
	);
	
	$ornek1->dongusuz($site_dongusuz2);
	
	if (!isset($site_dondur2))
	{
	$site_dondur2[] = array(
	'{TARIH}' => '',
	'{TOPLAM_SITE2}' => '',
	'{KATEGORI_BASLIK}' => $kp_dil_304,
	'{DAL_NO}' => '');
	}
	
	$ornek1->tekli_dongu('2',$site_dondur2);


	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);

	}
	else
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'site_ekle.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}

?>