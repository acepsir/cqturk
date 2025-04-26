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
	
	// portal yonetim taban rengi nilgisi.
	$arka_tablo = "yonetim_bg2";
	

	// ONAYLAMA SIL UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './galeri_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./galeri_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_268,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();
	}
	// ONAYLAMA SIL UYARISI - SONU //
	
	// ONAYLA UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi2'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './galeri_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./galeri_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_269,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	// ONAYLA UYARISI - SONU //
	
	
	// YENI DAL UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi3'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './galeri_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./galeri_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_270,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	//  YENI DAL UYARISI - SONU //
	
	
	// DAL SIL UYARISI //
	if ((isset($_GET['bilgi'])) AND ($_GET['bilgi'] == 'iletisi4'))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_1,
	'{ADRES}' => './galeri_yonetim.php',
	'{ILETI}' => '<meta target="_top" http-equiv="Refresh" content="2; url=./galeri_yonetim.php">',
	'{EK_YAZI}' => $kp_yonetim_271,
	'{YONLENDIRME}' => $ileti__1,
	'{YONLENDIRME2}' => $ileti__2);

	yonetim_hata_iletileri($ileti_sonuc);
	exit();	
	}
	//  DAL SIL UYARISI - SONU //



	if ($kosul == 'onaylama_sil')
	{
	// Sil Anahtarı Kontrol Ediliyor //
	
	if ((!isset($_GET['anahtar'])) OR ($portal_ayarlar['sil_anahtar'] != $_GET['anahtar']))
	{
	
	$VeRiyi_YeNiLe = "UPDATE $tablo_portal_ayarlar SET sayi='$sil_anahtar' WHERE isim='sil_anahtar' LIMIT 1";
	$SorGu_SoNuc = $vt->query($VeRiyi_YeNiLe) or die ($vt->hata_ver());

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $ileti_2,
	'{ADRES}' => 'galeri_yonetim.php',
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
	
	if (is_numeric($_GET['no']) == true) $_GET['no'] = @zkTemizle($_GET['no']);
	else $_GET['no'] = 0;
	
	$sorgu = "SELECT sifrelenmis_resim_adi FROM $tablo_portal_galeri WHERE no='$_GET[no]' LIMIT 1";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	$vtsonuc = $vt->fetch_assoc($sorgu_sonuc);

	@unlink('galeri/'.$vtsonuc['sifrelenmis_resim_adi'].'');
	
	$sil_sorgu = "DELETE FROM $tablo_portal_galeri WHERE no='$_GET[no]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());

	header ('Location: galeri_yonetim.php?bilgi=iletisi');
	
	exit();
	}
	
	if ($kosul == 'onayla')
	{
	
	
	if (is_numeric($_GET['no']) == true) $_GET['no'] = @zkTemizle($_GET['no']);
	else $_GET['no'] = 0;
	
	$vtsorgu = "UPDATE $tablo_portal_galeri SET resim_onay='1' where no='$_GET[no]' LIMIT 1";
	$vtsonuc6 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	header ('Location: galeri_yonetim.php?bilgi=iletisi2');
	
	exit();
	}

	if ($kosul == 'yeni_dal')
	{

	$tarih = time();
	
	$_POST['dal_adi'] = @zkTemizle($_POST['dal_adi']);
	
	$vtsorgu = "INSERT INTO $tablo_portal_galeridal (tarih, dal)";

	$vtsorgu .= "VALUES ('$tarih','$_POST[dal_adi]')";
	$vtsonuc5 = $vt->query($vtsorgu) OR die ('<h2>sorgu başarısız</h2>'.$vt->error());

	header ('Location: galeri_yonetim.php?bilgi=iletisi3');
	
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
	'{ADRES}' => 'galeri_yonetim.php',
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
	
	$sil_sorgu = "DELETE FROM $tablo_portal_galeridal WHERE id='$_POST[id]' LIMIT 1";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());

	$sorgu = "SELECT sifrelenmis_resim_adi FROM $tablo_portal_galeri WHERE id='$_POST[id]'";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());
	while ($vtsonuc = $vt->fetch_assoc($sorgu_sonuc)):

	@unlink('galeri/'.$vtsonuc['sifrelenmis_resim_adi'].'');
	
	$sil_sorgu = "DELETE FROM $tablo_portal_galeri WHERE id='$_POST[id]'";
	$sil_sorgu_sonuc = $vt->query($sil_sorgu) or die ($vt->hata_ver());
	
	endwhile;
	
	
	header ('Location: galeri_yonetim.php?bilgi=iletisi4');
	
	
	exit();
	}
	
	$sayfa_adi = 'Galeri Sayfası';
	if (!defined('DOSYA_YONETIM_BASLIK')) include 'phpkf-bilesenler/yonetim_sayfa_baslik.php';
	menu();

	$Sorgu = "SELECT * FROM $tablo_portal_galeridal order by tarih desc";
	$dal_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	$dongule1 = '';
	
	while ($dallar = $vt->fetch_array($dal_sonuc))
	{
	$dongule1 .='<option value="'.$dallar['id'].'">'.$dallar['dal'].'</option>';
	}

	unset($Sorgu); 

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = '5'; 
	$kosullar = "where resim_onay='0' order by tarih desc"; 
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
	
	
	$Sorgu22 = $vt->query("SELECT * FROM $tabloadi $kosullar LIMIT $baslangic,$limit");

	
	while ($resimler = $vt->fetch_array($Sorgu22))
	{
	$dongule2[] = array(
	'{ONAYLA}' => $yonetim_galerisimge_onayla, 
	'{ONAYLAMA}' => $yonetim_galerisimge_onaylama,
	'{NO}' => $resimler['no'],
	'{ONAYLA_SAYFASI}' => 'galeri_yonetim.php?kosul=onayla&amp;no='.$resimler['no'],
	'{ONAYLAMA_SIL_SAYFASI}' => 'galeri_yonetim.php?kosul=onaylama_sil&amp;no='.$resimler['no'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{ID}' => $resimler['id'],
	'{RESIM}' => $resimler['resim'],
	'{TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $resimler['tarih']),
	'{ISIM}' => $resimler['isim'],
	'{BOYUT}' => $resimler['boyut'],
	'{ACIKLAMA}' => $resimler['aciklama'],
	'{EKLEYEN}' => $resimler['ekleyen'],
	'{RESIM_ONAY}' => $resimler['resim_onay']);
	}
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'galeri_yonetim.php?','',$adresdeger='');
	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/galeri_yonetim.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));

	if ($dongule1 !='') 
	{
	$ornek1->dongusuz(array('{SECENEKLER}' => $dongule1));
	}
	else
	{
	$ornek1->dongusuz(array('{SECENEKLER}' => ''));
	}
	
	if (isset($dongule2))
	{
	$ornek1->tekli_dongu('2',$dongule2);
	}
	
	if (($dongule1 !='') AND (isset($dongule2)) )
	{
	$ornek1->kosul('1',array('' => ''), true);
	$ornek1->kosul('2',array('' => ''), false);
	}	
	else
	{
	$ornek1->kosul('2',array('' => ''), true);
	$ornek1->kosul('1',array('' => ''), false);
	}
	
$java ="<script type=\"text/javascript\">
function sayfa_ac(resim){
window.open(''+resim,'','resizable=1,scrollbars=1, top=100, left=50');
}
</script>";


	$dongu_yok = array( 
	'{JAVA_SCRIPT}' => $java,
	'{SAYFALAMA}' => $tablo,
	'{ONAY_BEKLEYEN}' => $kp_yonetim_175, 
	'{BEKLEYEN_YOK}' => $kp_yonetim_176, 
	'{RESIM_ADI}' => $kp_yonetim_177, 
	'{EKLEME_TARIHI}' => $kp_yonetim_178, 
	'{BOYUT1}' => $kp_yonetim_179, 
	'{EKLEYEN1}' => $kp_yonetim_180, 
	'{ACIKLAMA1}' => $kp_yonetim_181,  
	'{KATEGORI_EKLE}' => $kp_yonetim_81, 
	'{SILINECEK_KATEGORI}' => $kp_yonetim_77, 
	'{KATEGORIYI_SIL}' => $kp_yonetim_80, 
	'{SIL_UYARISI}' => $kp_dil_151,
	'{YENI_DAL_EKLE_SAYFASI}' => 'galeri_yonetim.php?kosul=yeni_dal',
	'{DAL_SIL_SAYFASI}' => 'galeri_yonetim.php?kosul=dal_sil&amp;anahtar='.$portal_ayarlar['sil_anahtar']);



$ornek1->dongusuz($dongu_yok);


eval(TEMA_UYGULA);


?>