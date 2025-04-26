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


	// dosyası ınclude ediliyor.
	define('YONETIM_TEMADIZINI', true);
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_MENU')) include 'menu.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';
	if (!defined('DOSYA_DILAYAR')) include 'diller/dil_ayarlari.php';
	
	
	// YENI DAL UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi1'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './haber_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./haber_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_270,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	//  YENI DAL UYARISI - SONU //
	
	
	// DAL SIL UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi2'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './haber_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./haber_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_271,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	//  DAL SIL UYARISI - SONU //
	
	// ONAYLA //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi3'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './haber_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./haber_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_358,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	// ONAYLA - SONU //
	
	// ONAYLAMA //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi4'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './haber_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./haber_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_357,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	// ONAYLAMA - SONU //
	
	if ($kosul == 'onaylama_sil')
	{
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haber_yonetim.php',
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	else
	{	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //
	
	if (is_numeric($_GET['id']) == true) $_GET['id'] = @zkTemizle($_GET['id']);
	else $_GET['id'] = 0;

	$sorgu = "SELECT * FROM $tablo_portal_haberler WHERE id='$_GET[id]' LIMIT 1";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	if (!$vt->num_rows($sorgu_sonuc))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'haber_yonetim.php',
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_355,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}

	$sil_sorgu = "DELETE FROM $tablo_portal_haberler WHERE id='$_GET[id]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());

	header ('Location: haber_yonetim.php?bilgi=iletisi4');

	exit();
	}

	if ($kosul == 'onayla')
	{


	if (is_numeric($_GET['id']) == true) $_GET['id'] = @zkTemizle($_GET['id']);
	else $_GET['id'] = 0;

	$vtsorgu = "UPDATE $tablo_portal_haberler SET onay='1' where id='$_GET[id]' LIMIT 1";
	$vtsonuc6 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());
	


	header ('Location: haber_yonetim.php?bilgi=iletisi3');

	exit();
	}
	
	
	if ($kosul == 'yeni_dal')
	{

	$tarih = time();
	
	$_POST['dal_adi'] = @zkTemizle($_POST['dal_adi']);
	
	$vtsorgu = "INSERT INTO $tablo_portal_haberdal (tarih, dal)";

	$vtsorgu .= "VALUES ('$tarih','$_POST[dal_adi]')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	header ('Location: haber_yonetim.php?bilgi=iletisi1');
	
	exit();
	}
	
	if ($kosul == 'dal_sil')
	{
	
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'haber_yonetim.php',
	'{ILETI}' => $kp_dil_487,
	'{EK_YAZI}' => $kp_dil_322,
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);

	exit();
	}
	else
	{	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());
	}
	
	// Sil Anahtarı Kontrol Ediliyor - Sonu //
	
	if (is_numeric($_POST['id']) == true) $_POST['id'] = zkTemizle($_POST['id']);
	else $_POST['id'] = 0;
	
	$sil_sorgu = "DELETE FROM $tablo_portal_haberdal WHERE id='$_POST[id]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());
			
	$sorgu = "SELECT * FROM $tablo_portal_haberler WHERE dal_id='$_POST[id]'";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	while ($vtsonuc = $vt->fetch_assoc($sorgu_sonuc)):

	$sil_sorgu = "DELETE FROM $tablo_portal_haberler WHERE dal_id='$_POST[id]'";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());
	
	endwhile;
	
	
	header ('Location: haber_yonetim.php?bilgi=iletisi2');
	
	
	exit();
	}
	
	$sayfa_adi = 'Haberler Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();
	
	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/haber_yonetim.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	
	$Sorgu = "SELECT * FROM $tablo_portal_haberdal order by tarih desc";
	$dal_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	$dongule1 = '';
	
	while ($dallar = $vt->fetch_array($dal_sonuc))
	{
	$dongule1 .='<option value="'.$dallar['id'].'">'.$dallar['dal'].'</option>';
	}
	
	if ($dongule1 !='') 
	{
	$ornek1->dongusuz(array('{SECENEKLER}' => $dongule1));
	}
	else
	{
	$ornek1->dongusuz(array('{SECENEKLER}' => ''));
	}

	unset($Sorgu);

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;

	
	$limit = '15'; 
	$kosullar = "where onay='0' order by tarih desc"; 
	$tabloadi = $tablo_portal_haberler; 

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
	$sorgu1111 = "select * from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$Sorgu22 = $vt->query($sorgu1111) or die ($vt->hata_ver());
	
	while ($haberler = $vt->fetch_array($Sorgu22))
	{

	$aciklama_sonucu = '';

	if (strlen($haberler['icerik']) > 500)
	{
	if ( ($haberler['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
	{
	$aciklama_sonucu .= mb_substr(bbcode_acik($haberler['icerik'],$haberler['id']),0,500, 'utf-8').'....<a href="'.linkverPortal('haberler.php?hn='.$haberler['id'],$haberler['baslik']).'"><b>'.$kp_dil_359.'</b></a>';
	}
	else
	{
	$aciklama_sonucu .= mb_substr(bbcode_kapali($haberler['icerik']),0,500, 'utf-8').'....<a href="'.linkverPortal('haberler.php?hn='.$haberler['id'],$haberler['baslik']).'"><b>'.$kp_dil_359.'</b></a>';
	}
	}
	else
	{	
	if ( ($haberler['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
	{
	$aciklama_sonucu .= bbcode_acik($haberler['icerik'],$haberler['id']);
	}
	else
	{
	$aciklama_sonucu .= bbcode_kapali($haberler['icerik']);
	}
	}

	$dongule2[] = array(
	'{ONAYLA}' => $yonetim_galerisimge_onayla, 
	'{ONAYLAMA}' => $yonetim_galerisimge_onaylama,
	'{ONAYLA_SAYFASI}' => 'haber_yonetim.php?kosul=onayla&amp;id='.$haberler['id'],
	'{ONAYLAMA_SIL_SAYFASI}' => 'haber_yonetim.php?kosul=onaylama_sil&amp;id='.$haberler['id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{ID}' => $haberler['id'],
	'{TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $haberler['tarih']),
	'{BASLIK}' => $haberler['baslik'],
	'{ICERIK}' => $aciklama_sonucu,
	'{YAZAN}' => $haberler['yazan'],
	'{ONAY}' => $haberler['onay']);
	}



	if (isset($dongule2))
	{
	$ornek1->tekli_dongu('2',$dongule2);
	}

	if (isset($dongule2))
	{
	$ornek1->kosul('1',array('' => ''), true);
	$ornek1->kosul('2',array('' => ''), false);
	}
	else
	{
	$ornek1->kosul('2',array('' => ''), true);
	$ornek1->kosul('1',array('' => ''), false);
	}

	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'haber_yonetim.php?','',$adresdeger='');
	
	$dongu_yok = array( 
	'{SAYFALAMA}' => $tablo,
	'{ONAY_BEKLEYEN}' => $kp_dil_360, 
	'{O_B_YOK}' => $kp_dil_361, 
	'{BASLIK2}' => $kp_dil_362, 
	'{EKLEME_TARIHI}' => $kp_yonetim_178, 
	'{YAZAN2}' => $kp_yonetim_180, 
	'{ICERIK2}' => $kp_dil_363,  
	'{SIL_UYARISI}' => $kp_dil_151,
	'{KATEGORI_EKLE}' => $kp_yonetim_81, 
	'{SILINECEK_KATEGORI}' => $kp_yonetim_77, 
	'{KATEGORIYI_SIL}' => $kp_yonetim_80, 
	'{SIL_UYARISI}' => $kp_dil_151,
	'{YENI_DAL_EKLE_SAYFASI}' => 'haber_yonetim.php?kosul=yeni_dal',
	'{DAL_SIL_SAYFASI}' => 'haber_yonetim.php?kosul=dal_sil&amp;anahtar='.$portal_ayarlar['sil_anahtar']);

	$ornek1->dongusuz($dongu_yok);
	

eval(TEMA_UYGULA);


?>