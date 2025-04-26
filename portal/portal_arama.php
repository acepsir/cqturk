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


	define('DOSYA_PORTAL_ARAMA',true);
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include 'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';


	$limit = '8';

	// get değişkeni temizleniyor.
	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;

	$_GET['sozcuk'] = @zkTemizle($_GET['sozcuk']);


	// forumdan arama seçiliyse eğer foruma yönlendiriliyor.
	if (isset($_GET['ara']))
	{
		if ($_GET['ara'] == 'forum')
		{
			header ('Location: ../arama.php?a=1&b=1&sozcuk_hepsi='.$_GET['sozcuk'].'&forum=tum');
			exit();
		}
	}


	$sayfa_adi = 'Arama Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/arama.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));


	if ($portal_bloklar_ayar['arama_sayfasi'] =='1')
	{
	if(!isset($kullanici_kim['id']))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => '../'.$phpkf_dosyalar['portal'],
	'{ILETI}' => '',
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $kp_dil_404,
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	}
	
	if ($portal_bloklar_ayar['arama_sayfasi'] !='1')
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'portal_arama.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
	
	// sözcük temizleniyor.
	$_GET['sozcuk'] = @zkTemizle2($_GET['sozcuk']);

	$baslangic = $_GET['s']*$limit;
	
	$veritabani_tablosu = '';







	// PORTAL ARAMA - BAŞLANGIC //	

	@session_start();

	if (isset($_GET['dolu'])) $ornek1->kosul('1', array('{}' => ''), true);
	else $ornek1->kosul('1', array('{}' => ''), false);
	
	$bulunan = '';
	
	
	// sözcük boş ise veritabanına giriş yapılmadan bilgi yazdırılıyor.
	if ((!isset($_GET['sozcuk'])) OR ($_GET['sozcuk'] == ''))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
	else
	{
	
	if (isset($_GET['ara']))
	{
	@session_start();
	$tarih = time();

    if ( ((!isset($_GET['s'])) OR ($_GET['s']==0)) AND (isset($_SESSION['arama_tarih'])) AND ($_SESSION['arama_tarih'] > ($tarih - 20)))
    {
            $bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_537.'</b></font></center>';
    }

	else
	{
	// GALERİ TARANIYOR //
	if ($_GET['ara'] == 'galeri')
	{
	
	if ($_GET['ara2'] == 'baslik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_galeri WHERE resim_onay='1' AND isim LIKE '%$_GET[sozcuk]%'";
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_galeri WHERE resim_onay='1' AND isim LIKE '%$_GET[sozcuk]%' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	while($r=$vt->fetch_assoc($Sorgu_sonuc)): 
	
   $bulunan .= '<div style=" border: 1px solid #dddddd; padding: 5px;"><div style="color: red; font-size: 12px; font-family: Verdana;">
   <a href="javascript:void(0);" OnClick="sayfa_ac(\''.$r['resim'].'\'); return false;">'.$r['isim'].'</a><br><br></div>
   <div style="font-size: 11px; font-family: Verdana;">'.mb_substr(bbcode_acik($r['aciklama'],$r['no']),0,500, 'utf-8').'...</div></div><br>';

	
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;

	}
	elseif ($_GET['ara2'] == 'icerik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_galeri WHERE resim_onay='1' AND aciklama LIKE '%$_GET[sozcuk]%'";
	
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_galeri WHERE resim_onay='1' AND aciklama LIKE '%$_GET[sozcuk]%' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	
	while($r=$vt->fetch_assoc($Sorgu_sonuc)):
	
	$bulunan .= '<div style=" border: 1px solid #dddddd; padding: 5px;"><div style="color: red; font-size: 12px; font-family: Verdana;">
	 <a href="javascript:void(0);" OnClick="sayfa_ac(\''.$r['resim'].'\'); return false;">'.$r['isim'].'</a><br><br></div>
   <div style="font-size: 11px; font-family: Verdana;">'.mb_substr(bbcode_acik($r['aciklama'],$r['no']),0,500, 'utf-8').'...</div></div><br>';
   
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;
	
	}
	
	// GALERİ TARANIYOR - SONU //
	
	
	
	}
	// FAVORİ SİTELER TARANIYOR //
	elseif ($_GET['ara'] == 'siteler')
	{
	
	if ($_GET['ara2'] == 'baslik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_siteekle WHERE site_onay='1' AND site_title LIKE '%$_GET[sozcuk]%'";
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_siteekle WHERE site_onay='1' AND site_title LIKE '%$_GET[sozcuk]%' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	while($site=$vt->fetch_assoc($Sorgu_sonuc)): 
	
   $bulunan .= '<div style=" border: 1px solid #dddddd; padding: 5px;"><div style="color: red; font-size: 12px; font-family: Verdana;">
   <a target="_blank" href="site_ekle.php?kosul=siteye_yonlendiriliyor&amp;site_id='.$site['site_id'].'">'.$site['site_title'].'</a><br><br></div>
   <div style="font-size: 11px; font-family: Verdana;">'.mb_substr(bbcode_acik($site['aciklama'],$site['site_id']),0,500, 'utf-8').'...</div></div><br>';

	
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;
	}
	elseif ($_GET['ara2'] == 'icerik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_siteekle WHERE site_onay='1' AND aciklama LIKE '%$_GET[sozcuk]%'";
	
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_siteekle WHERE site_onay='1' AND aciklama LIKE '%$_GET[sozcuk]%' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	
	while($site=$vt->fetch_assoc($Sorgu_sonuc)): 
	
   $bulunan .= '<div style=" border: 1px solid #dddddd; padding: 5px;"><div style="color: red; font-size: 12px; font-family: Verdana;">
   <a target="_blank" href="site_ekle.php?kosul=siteye_yonlendiriliyor&amp;site_id='.$site['site_id'].'">'.$site['site_title'].'</a><br><br></div>
   <div style="font-size: 11px; font-family: Verdana;">'.mb_substr(bbcode_acik($site['aciklama'],$site['site_id']),0,500, 'utf-8').'...</div></div><br>';
	
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;
	}
	
	// FAVORİ SİTELER TARANIYOR - SONU //
	
	// DOSYALAR TARANIYOR //
	}
	elseif ($_GET['ara'] == 'dosya')
	{
	
	
	if ($_GET['ara2'] == 'baslik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_indir WHERE dosya_baslik LIKE '%$_GET[sozcuk]%'";
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_indir WHERE dosya_baslik LIKE '%$_GET[sozcuk]%' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	
	while($r=$vt->fetch_assoc($Sorgu_sonuc)):
	

  
   $bulunan .= '<div style=" border: 1px solid #dddddd; padding: 5px;"><div style="color: red; font-size: 12px; font-family: Verdana;">
   <a target="_blank" href="dosyalar.php?no='.$r['no'].'">'.$r['dosya_baslik'].'</a><br><br></div>
   <div style="font-size: 11px; font-family: Verdana;">'.mb_substr(bbcode_acik($r['dosya_aciklama'],$r['no']),0,500, 'utf-8').'...</div></div><br>';
	
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;
	
	}
	elseif ($_GET['ara2'] == 'icerik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_indir WHERE dosya_aciklama LIKE '%$_GET[sozcuk]%'";
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_indir WHERE dosya_aciklama LIKE '%$_GET[sozcuk]%' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	
	while($r=$vt->fetch_assoc($Sorgu_sonuc)):
	
  
   $bulunan .= '<div style=" border: 1px solid #dddddd; padding: 5px;"><div style="color: red; font-size: 12px; font-family: Verdana;">
   <a target="_blank" href="dosyalar.php?no='.$r['no'].'">'.$r['dosya_baslik'].'</a><br><br></div>
   <div style="font-size: 11px; font-family: Verdana;">'.mb_substr(bbcode_acik($r['dosya_aciklama'],$r['no']),0,500, 'utf-8').'...</div></div><br>';
	
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;
	}
	
	// DOSYALAR TARANIYOR - SONU //
	
	
	// HABERLER TARANIYOR //
	
	}
	elseif ($_GET['ara'] == 'haber')
	{
	
	if ($_GET['ara2'] == 'baslik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_haberler WHERE onay='1' AND baslik LIKE '%$_GET[sozcuk]%'";
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_haberler WHERE onay='1' AND baslik LIKE '%$_GET[sozcuk]%' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	while($r=$vt->fetch_assoc($Sorgu_sonuc)):
	

   $bulunan .= '<div style=" border: 1px solid #dddddd; padding: 5px;"><div style="color: red; font-size: 12px; font-family: Verdana;">
   <a target="_blank" href="haberler.php?hn='.$r['id'].'">'.$r['baslik'].'</a><br><br></div>
   <div style="font-size: 11px; font-family: Verdana;">'.mb_substr(bbcode_acik($r['icerik'],$r['id']),0,500, 'utf-8').'...</div></div><br>';
	
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;
	}
	if ($_GET['ara2'] == 'icerik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_haberler WHERE onay='1' AND icerik LIKE '%$_GET[sozcuk]%'";
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_haberler WHERE onay='1' AND icerik LIKE '%$_GET[sozcuk]%' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	
	while($r=$vt->fetch_assoc($Sorgu_sonuc)):
	
   $bulunan .= '<div style=" border: 1px solid #dddddd; padding: 5px;"><div style="color: red; font-size: 12px; font-family: Verdana;">
   <a target="_blank" href="haberler.php?hn='.$r['id'].'">'.$r['baslik'].'</a><br><br></div>
   <div style="font-size: 11px; font-family: Verdana;">'.mb_substr(bbcode_acik($r['icerik'],$r['id']),0,500, 'utf-8').'...</div></div><br>';
	
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;
	}
	
	// HABERLER TARANIYOR - SONU //

	
	// ANKETLER TARANIYOR //
	
	}
	elseif (isset($_GET['ara']) == 'anket')
	{
	
	
	if (isset($_GET['ara2']) == 'baslik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_anketsoru WHERE anket_durum='1' AND anket_soru LIKE '%$_GET[sozcuk]%'";
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_anketsoru WHERE anket_durum='1' AND anket_soru LIKE '%$_GET[sozcuk]%' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	
	while($r=$vt->fetch_assoc($Sorgu_sonuc)):
	 
  
   $bulunan .= '<div style="color: red; font-size: 12px; font-family: Verdana; border: 1px solid #dddddd; padding: 5px;">
   <a target="_blank" href="anket.php?anketno='.$r['anketno'].'">'.$r['anket_soru'].'</a></div><br>';
	
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;
	}
	elseif (isset($_GET['ara2']) == 'icerik')
	{
	
	$veritabani_tablosu .= "$tablo_portal_anketsoru WHERE secenek LIKE '%$_GET[sozcuk]%'";
	
	$vtsorgu = $vt->query("SELECT COUNT(* ) FROM $veritabani_tablosu" ); 
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}
	
	$Sorgu = "SELECT * FROM $tablo_portal_anketsecenek WHERE secenek LIKE '%$_GET[sozcuk]%'"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	
	
	while($r=$vt->fetch_assoc($Sorgu_sonuc)):
	 
	$Sorgu = "SELECT * FROM $tablo_portal_anketsoru WHERE anket_durum='1' AND anketno='$r[anketno]' order by tarih desc limit $baslangic,$limit"; 
	$Sorgu_sonuc = $vt->query($Sorgu) or die ($vt->hata_ver());
	$r2=$vt->fetch_assoc($Sorgu_sonuc);
  
   $bulunan .= '<div style="color: red; font-size: 12px; font-family: Verdana; border: 1px solid #dddddd; padding: 5px;">
   <a target="_blank" href="anket.php?anketno='.$r2['anketno'].'">'.$r2['anket_soru'].'</a></div><br>';
	
	endwhile; 
	 
	if (!$vt->num_rows($Sorgu_sonuc))
	{ 
	$bulunan .= '<center><font color="#ff0000"><b>'.$kp_dil_374.'</b></font></center>';
	}
    else $_SESSION['arama_tarih'] = $tarih;

		}
			}
			// ANKETLER TARANIYOR - SONU //
			}
		}
	}
	// PORTAL ARAMA - SONU //
	
	$tablo = '';
	
	if (isset($Sorgu))
	{
	
	$tablo .= sayfalama($limit,$sayfa,$satir_sayisi,'portal_arama.php?dolu=1&ara='.$_GET['ara'].'&ara2='.$_GET['ara2'].'&sozcuk='.$_GET['sozcuk'].'&',$adresdeger='');
	
	
	}
	
	// SAYFALAMA BAŞLIYOR - SONU //
	
	
	// GET verisi alınıyor.
	$forum = '';
	$galeri = '';
	$dosya = '';
	$haber = '';
	$anket = '';
	$siteler = '';
	$galeri1 = '';
	$dosya1 = '';
	$haber1 = '';
	$anket1 = '';
	$siteler1 = '';
	
	if (isset($_GET['ara']))
	{		
	if ($_GET['ara'] == 'galeri')
	$galeri .= 'checked="checked"';
	else $galeri .= '';
	
	if ($_GET['ara'] == 'dosya')
	$dosya .= 'checked="checked"';
	else $dosya .= '';
	
	if ($_GET['ara'] == 'haber')
	$haber .= 'checked="checked"';
	else $haber .= '';
	
	if ($_GET['ara'] == 'anket')
	$anket .= 'checked="checked"';
	else $anket .= '';
	
	if ($_GET['ara'] == 'siteler')
	$siteler .= 'checked="checked"';
	else $siteler .= '';
	}
	else
	{
	$haber .= 'checked="checked"';
	}
	
	$forum = $kp_dil_383;
	
	if ($portal_bloklar_ayar['galeri_sayfasi'] == 1) 
	{
	$galeri1 .= '<input type="radio" name="ara" value="galeri" '.$galeri.'>'.$kp_dil_375.'<br>';
	}
		
	if ($portal_bloklar_ayar['dosyalar_sayfasi'] == 1) 
	{
	$dosya1 .= '<input type="radio" name="ara" value="dosya" '.$dosya.'>'.$kp_dil_376.'<br>';
	}
	
	if ($portal_bloklar_ayar['haber_sayfasi'] == 1) 
	{
	$haber1 .= '<input type="radio" name="ara" value="haber" '.$haber.'>'.$kp_dil_377.'<br>';
	}
	
	if ($portal_bloklar_ayar['anketler_sayfasi'] == 1)	
	{
	$anket1 .= '<input type="radio" name="ara" value="anket" '.$anket.'>'.$kp_dil_378.'<br>';
	}
	if ($portal_bloklar_ayar['siteler_sayfasi'] == 1)	
	{
	$siteler1 .= '<input type="radio" name="ara" value="siteler" '.$siteler.'>'.$kp_dil_482.'<br>';
	}
	
	
	$java = "<script type=\"text/javascript\">
	function sayfa_ac(resim){
	window.open(''+resim,'','resizable=1,scrollbars=1, top=100, left=50');
	}
	function kontrol()
	{ 
	var dogruMu = true;
	if (document.form.sozcuk.value.length < 3)
	{ 
	dogruMu = false; 
	alert(\"$kp_dil_384\");
	}
	else;
	return dogruMu;
	}
	
	function kontrol2()
	{ 
	var dogruMu = true;
	if (document.form2.sozcuk.value.length < 3)
	{ 
	dogruMu = false; 
	alert(\"$kp_dil_384\");
	}
	else;
	return dogruMu;
	}

	</script>";


	// TEMA UYGULANIYOR //
	
	$ornek1->dongusuz(array(
	'{ACTION}' => 'portal_arama.php',
	'{JAVA_SCRIPT}' => $java,
	'{FORUM}' => $forum,
	'{PORTAL_ARAMA1}' => $kp_dil_391,
	'{GALERI}' => $galeri1,
	'{DOSYA}' => $dosya1,
	'{HABER}' => $haber1,
	'{ANKET}' => $anket1,
	'{SITELER}' => $siteler1,
	'{BASLIK}' => $kp_dil_379,
	'{ICERIK}' => $kp_dil_380,
	'{BULUNAN}' => $bulunan,
	'{SAYFALAMA}' => $tablo,
	'{ARAMA}' => $kp_dil_381,
	'{ARAMA_BASLAT}' => $kp_dil_382));

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);

?>