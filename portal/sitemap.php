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


	define('DOSYA_SITEMAP',true);
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include 'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';



	/*************************************************************************************/

	// SİTEMAP SAYFASI AYARLARI //


// Gizli forumlar - başı

$vtsorgu = "SELECT id,gizle FROM $tablo_forumlar ORDER BY sira";
$gforums = $vt->query($vtsorgu) or die ($vt->hata_ver());
$ek_kosul = '';


while ($gforum = $vt->fetch_assoc($gforums))
{
    if ($gforum['gizle'] == 1)
    {
        $ek_kosul .= " AND hangi_forumdan!='$gforum[id]' ";
    }
}

// Gizli forumlar - sonu



	if ($portal_bloklar_ayar['siteharitasi_sayfasi'] == 1):

	$sayfa_adi = 'Site Haritası Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';


	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;


	$limit = $portal_ayarlar['sitemaps'];
	$kosullar = "WHERE silinmis='0' $ek_kosul ORDER BY son_mesaj_tarihi DESC"; 
	$tabloadi = $tablo_mesajlar; 


	$vtsorgu = $vt->query("SELECT id FROM $tabloadi $kosullar") or die ($vt->hata_ver());
	$satir_sayisi = $vt->num_rows($vtsorgu);

	@$sayfa = abs(intval($_GET['s'] ));
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ))
	{
	$sayfa = 1;
	$baslangic = 0;
	} else {
	$baslangic = ($sayfa - 1 ) * $limit;
	}


	// TABLOLAR SIRALANIYOR //

	$dongusuz = array(
	'{SITEMAP_SON_KONULAR}' => $kp_dil_125,
	'{KONU}' => $kp_dil_74,
	'{GONDEREN}' => $kp_dil_72,
	'{CEVAP}' => $kp_dil_75,
	'{GOSTERİM}' => $kp_dil_76);

	// TABLOLAR SIRALANIYOR - SONU //


	// VERİTABANINDAN BİLGİLER ÇEKİLİYOR //
	$sorgu = $vt->query("SELECT id,yazan,mesaj_baslik,cevap_sayi,goruntuleme  FROM $tabloadi $kosullar LIMIT $baslangic,$limit") or die ($vt->hata_ver());

	if (!$vt->num_rows($sorgu))
	{
	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => '../'.$phpkf_dosyalar['portal'],
	'{ILETI}' => $kp_dil_244,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => '',
	'{YONLENDIRME2}' => $kp_yonetim_106);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));

	exit();
	}


	else
	{
	// VERİTABANINDAN BİLGİLER ÇEKİLİYOR - SONU //

	// BİLGİLER EKRANA YAZDIRILIYOR //

	$dondur_dongu=1;
	while ($Smap_listele=$vt->fetch_assoc($sorgu)):

	$dongu[] = array(
	'{PORTAL_ARKA_TABLO_RENGI}' => $arka_tablo,
	'{SON_ILETI_RENGI}' => $sonileti_rengi,
	'{DONDUR_DONGU}' => $dondur_dongu,
	'{KONU_BASIGI}' => '<a href="'.linkver($alt_dizin.'konu.php?k='.$Smap_listele['id'],$Smap_listele['mesaj_baslik']).'"> '.$Smap_listele['mesaj_baslik'].' </a>',
	'{YAZAN}' => '<a href="'.linkver($alt_dizin.'profil.php?kim='.$Smap_listele['yazan'],$Smap_listele['yazan']).'">'.$Smap_listele['yazan'].'</a>',
	'{YANIT}' => $Smap_listele['cevap_sayi'],
	'{GORUNTULENME}' => $Smap_listele['goruntuleme']);
	$dondur_dongu++;
	endwhile; 




	// BİLGİLER EKRANA YAZDIRILIYOR - SONU //

	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,'sitemap.php?','',$adresdeger='');
	$tablo2 = array('{SAYFALAMA}' => $tablo);
	$dongusuz = array_merge($dongusuz, $tablo2);

	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/sitemap.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));

	$ornek1->tekli_dongu('1',$dongu);
	$ornek1->dongusuz($dongusuz);
	}

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();


	else:
	$sayfa_adi = 'Site Haritası Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => 'sitemap.php',
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	endif;

	// SİTEMAP SAYFASI AYARLARI SONU //
?>