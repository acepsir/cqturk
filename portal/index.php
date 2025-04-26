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


// Ana sayfa forum veya portal dizin seçimi
if (@is_file('ayar.php'))
{
	$ust_dizin = 'portal/';
	$alt_dizin = '';
}
else
{
	$ust_dizin = '';
	$alt_dizin = '../';
}

if (!@is_file($alt_dizin.'phpkf-ayar.php'))
{
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8">
<link href="'.$ust_dizin.'temalar/varsayilan/resimler/resimler/favicon.png" rel="icon" type="image/png" />
<link href="'.$ust_dizin.'temalar/varsayilan/css/sablon.css" rel="stylesheet" type="text/css" />
<title>phpKF-Portal KURULUM</title>
</head>
<body>
	<link href="'.$ust_dizin.'temalar/varsayilan/css/portal_stil.css" rel="stylesheet" type="text/css">
	<table cellpadding="0" cellspacing="0" width="100%" height="100%" bgcolor="#ffffff">
	<tr>
	<td align="center" valign="middle">
	<br>
	<table cellpadding="1" cellspacing="1" width="80%" height="80%" bgcolor="#dddddd">
	<tr>
	<td align="center" valign="middle" height="35px" colspan="2" style="background:url('.$ust_dizin.'temalar/varsayilan/resimler/resimler/alt.gif); color:#000000; font-family:Verdana; font-size: 13px;">
	phpKF-Portal Kurulumu
	</td>
	</tr>
	<tr>
	<td width="200px" align="left" valign="top" bgcolor="#ffffff">
	<hr style="color:#eeeeee;"><div valign="middle"><font style="color:#000000; font-family:Verdana; font-size: 13px;"><b>1. AŞAMA</b></font>
	<font style="color:#ff0000; font-family:Verdana; font-size: 13px;"><b>( HATA ! )</b></font></div>
	<hr style="color:#eeeeee;"><div valign="middle"><font style="color:#dddddd; font-family:Verdana; font-size: 13px;"><b>2. AŞAMA</b></font></div>
	<hr style="color:#eeeeee;"><div valign="middle"><font style="color:#dddddd; font-family:Verdana; font-size: 13px;"><b>3. AŞAMA</b></font></div>
	
	<hr style="color:#eeeeee;">
	<br><br><br><br>
	<div align="center"><img src="'.$ust_dizin.'resimler/degisen_resimler/4.png" alt="phpKF" title="phpKF"></div>
	</td>


	<td align="center" valign="middle" bgcolor="#ffffff" id="liste-veri">
	<b>phpKF-Portal</b>`ı kurabilmek için phpKF forumun kurulu olması gerekiyor. <br>phpKF Forumu indirip kurmak için alttaki butona tıklayarak güncel sürüme ulaşabilirsiniz.
	<br><br>
	Forumu daha önceden kurduysanız portalı aynı dizine atmamış olabilirsiniz.
	<br>Forum ve portalın aynı dizinde (klasörde) olması gerekir.
	<br><br><br><br>

	<a href="'.$alt_dizin.'phpkf-kurulum/index.php">Kurulum Sayfasına Git</a>
	<br><br><br>
	<a href="http://www.phpkf.com/indirme.php" target="_blank">Forum Güncel Sürüm</a>
	<br><br><br>
	<a href="http://www.phpkf.com/indirme.php#portal_indir" target="_blank">Portal Güncel Sürüm</a>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
</body>
</html>';
	exit();
}



	$sayfano = 201;
	$sayfa_adi = 'Ana Sayfa';
	$phpkf_ayarlar_kip = "WHERE kip='1'";

	if (!defined('DOSYA_AYAR')) include $alt_dizin.'ayar.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include $ust_dizin.'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include $ust_dizin.'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include $alt_dizin.'phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include $alt_dizin.'phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include $ust_dizin.'hata.php';
	if (!defined('DOSYA_BASLIK')) include $ust_dizin.'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include $ust_dizin.'bloklar.php';


	$ornek1 = new phpkf_tema();
	$tema_dosyasi = $ust_dizin.'temalar/'.$temadizini.'/index.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));


	// ana sayfadaki mesajların karakter sınırlaması.
	$karakter_siniri = $portal_ayarlar['karakter_sinirlamasi'];


	// DUYURU BİLGİLERİ ÇEKİLİYOR //
	

	if ($portal_bloklar_ayar['duyuru'] =='1')
	{
	$sorgu = "SELECT * FROM $tablo_duyurular WHERE fno='por'";
	$sorgu_sonuc = $vt->query($sorgu) or die ($vt->hata_ver());


	while($duyurular_sonuc = $vt->fetch_assoc($sorgu_sonuc))
	{
	// DUYURULAR BOLUMU //

	$tekli1[] = array( 
	'{DUYURU_BASLIK}' => $duyurular_sonuc['duyuru_baslik'], 
	'{DUYURU_ICERIK}' => $duyurular_sonuc['duyuru_icerik']);
	}

	$ornek1->dongusuz(array('{DUYURULAR}' => $kp_dil_69));

	if (isset($tekli1)) $ornek1->tekli_dongu('2',$tekli1);
	else $ornek1->kosul('8', array('' => ''), false);

	}
	else $ornek1->kosul('8', array('' => ''), false);

	// DUYURULAR BOLUMU SONU //



	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;

	$limit = $portal_ayarlar['haber_limit']; 
	$kosullar = "where onay='1' order by tarih desc"; 
	$tabloadi = $tablo_portal_haberler; 

	$sorgu = $vt->query("SELECT id FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($sorgu); 

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}

	if ($portal_bloklar_ayar['haber_sayfasi'] != 1) $ornek1->kosul('2', array('' => ''), false); 

	$sorgu1112 = "select id,baslik,icerik,yazan,tarih,okunma_sayisi,bbcode_kullan from $tabloadi $kosullar LIMIT $baslangic,$limit";
	$sorgu1112_sonuc = $vt->query($sorgu1112) or die ($vt->hata_ver());
	$haber_varmi = $vt->num_rows($sorgu1112_sonuc);

	if (($portal_bloklar_ayar['haber'] == '0') OR ($portal_bloklar_ayar['haber'] == '2')
	OR ($portal_bloklar_ayar['haber'] == '3') OR ($portal_bloklar_ayar['haber'] == '4')
	OR ($portal_bloklar_ayar['haber'] == '5') OR ($portal_bloklar_ayar['haber'] == '6'))
	{
	$haber_varmi = '0';
	}

	if ($haber_varmi)
	{
	if ($kullanici_kim['yetki'] != 1) $ornek1->kosul('5', array('' => ''), false);

	while ($vtsonuc2 = $vt->fetch_assoc($sorgu1112_sonuc))
	{

	$sorgu11133 = "select id from $tablo_portal_haberyorum where haber_id='$vtsonuc2[id]'";
	$sorgu11133_sonuc = $vt->query($sorgu11133) or die ($vt->hata_ver());
	$vtsonuc33 = $vt->num_rows($sorgu11133_sonuc);

	$aciklama_sonucu = '';

	if (strlen($vtsonuc2['icerik']) > $karakter_siniri)
	{
		$aciklama_sonucu .= mb_substr(BBcodeTemizle(bbcode_kapali($vtsonuc2['icerik'])),0,$karakter_siniri, 'utf-8').'....<br><a href="'.linkverPortal($ust_dizin.'haberler.php?hn='.$vtsonuc2['id'],$vtsonuc2['baslik']).'"><b>'.$kp_dil_359.'&nbsp;&raquo;</b></a>';
	}
	else
	{
		if ( ($vtsonuc2['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
		{
			$aciklama_sonucu .= bbcode_acik(ifadeler($vtsonuc2['icerik']),$vtsonuc2['id']);
		}
		else
		{
			$aciklama_sonucu .= bbcode_kapali(ifadeler($vtsonuc2['icerik']));
		}
	}

	$dongu_baslatt[] = array(
	'{DOSYAYI_YAZDIR}' => '<a target="_blank" href="'.$ust_dizin.'yazdir.php?dosya=haberler&amp;veri=konu&amp;kosul=portal&amp;no='.$vtsonuc2['id'].'">'.$kp_dil_100.'</a>',
	'{HABER_EKLE_LINK}' => $ust_dizin.'haberler.php?kosul=haber_ekle',
	'{SIL_UYARISI}' => $kp_dil_151,
	'{DUZENLEME}' => $ust_dizin.'haberler.php?kosul=haber_ekle&amp;haber_duzenle&amp;hn='.$vtsonuc2['id'],
	'{ADRES}' => linkverPortal($ust_dizin.'haberler.php?hn='.$vtsonuc2['id'],$vtsonuc2['baslik']),
	'{SIL}' => $ust_dizin.'haberler.php?kosul=haber_sil&amp;hn='.$vtsonuc2['id'].'&amp;anahtar='.$portal_ayarlar['sil_anahtar'],
	'{TOPLAM_YORUM}' => '<a href="'.linkverPortal($ust_dizin.'haberler.php?hn='.$vtsonuc2['id'],$vtsonuc2['baslik']).'#yorum">'.$kp_dil_541.'</a>: '.$vtsonuc33,
	'{YAZAN}' => '<a href="'.$alt_dizin.linkver('profil.php?kim='.$vtsonuc2['yazan'],$vtsonuc2['yazan']).'">'.$vtsonuc2['yazan'].'</a>',
	'{TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $vtsonuc2['tarih']),
	'{ID}' => $vtsonuc2['id'],
	'{ICERIK}' => $aciklama_sonucu,
	'{BASLIK}' => $vtsonuc2['baslik'],
	'{OKUNMA}' => $vtsonuc2['okunma_sayisi']);
	}

	$ornek1->tekli_dongu('1',$dongu_baslatt);
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,$phpkf_dosyalar['portal'].'?',$adresdeger=''); 

	$dongusuz10 = array(
	'{SAYFALAMA}' => $tablo,
	'{HABERLER}' => $kp_dil_325,
	'{SIL2}' => $kp_dil_338,
	'{DUZENLE}' => $kp_dil_339,
	'{HABER_EKLE}' => $kp_dil_330,
	'{YAZAN2}' => $kp_dil_328,
	'{OKUNMA2}' => $kp_dil_329,
	'{TARIH2}' => $kp_dil_340,
	'{TEMA_DIZIN}' => $temadizini,
	'{ARKA_TABLO}' => $arka_tablo,
	'{PORTAL_INDEX}' => $phpkf_dosyalar['portal']);

	$ornek1->dongusuz($dongusuz10);
	}
	else $ornek1->kosul('1', array('' => ''), false);



	$son_mesajlar_limit = $portal_ayarlar['son_mesajlar_sayisi'];

	if ($portal_bloklar_ayar['son_mesajlar'] == '0') $son_mesajlar_limit = '0';




// Yetkiye göre konu başlığı gizleme - başı

$gforums = $vt->query("SELECT id,okuma_izni,gizle FROM $tablo_forumlar ORDER BY sira");
$guncel_ek = '';


while ($gforum = $vt->fetch_assoc($gforums))
{
	if (($gforum['gizle'] == 1) AND ($gforum['okuma_izni'] != 0))
	{
		if (isset($kullanici_kim['id']))
		{
			if (($gforum['okuma_izni'] == 5) AND ($kullanici_kim['yetki'] != 1))
			{
				$guncel_ek .= " AND hangi_forumdan!='$gforum[id]' ";
				continue;
			}

			elseif (($gforum['okuma_izni'] == 1) AND ($kullanici_kim['yetki'] != 1))
			{
				$guncel_ek .= " AND hangi_forumdan!='$gforum[id]' ";
				continue;
			}

			elseif (($gforum['okuma_izni'] == 2) AND ($kullanici_kim['yetki'] == 0))
			{
				$guncel_ek .= " AND hangi_forumdan!='$gforum[id]' ";
				continue;
			}

			elseif (($gforum['okuma_izni'] == 3) AND ($kullanici_kim['yetki'] != 1) AND ($kullanici_kim['yetki'] != 2))
			{
				if ($kullanici_kim['yetki'] == 3)
				{
					$vtsorgu = "SELECT fno FROM $tablo_ozel_izinler WHERE kulad='$kullanici_kim[kullanici_adi]' AND fno='$gforum[id]' AND okuma='1'";
					$kul_izin = $vt->query($vtsorgu);
					if (!$vt->num_rows($kul_izin))
					{
						$guncel_ek .= " AND hangi_forumdan!='$gforum[id]' ";
						continue;
					}
				}
				else
				{
					$guncel_ek .= " AND hangi_forumdan!='$gforum[id]' ";
					continue;
				}
			}
		}

		else
		{
			$guncel_ek .= " AND hangi_forumdan!='$gforum[id]' ";
			continue;
		}
	}
}

// Yetkiye göre konu başlığı gizleme - sonu



// SON MESAJLAR VERITABANINDAN ÇEKİLİYOR

$vtsonuc100 = $vt->query("SELECT id,yazan,hangi_forumdan,son_mesaj_tarihi,cevap_sayi,goruntuleme,mesaj_baslik,son_cevap,son_cevap_yazan FROM $tablo_mesajlar WHERE silinmis='0' $guncel_ek ORDER BY son_mesaj_tarihi DESC LIMIT $son_mesajlar_limit");

// MESAJ VARMI YOKMU DENETLENİYOR

if (!$vt->num_rows($vtsonuc100)) $ornek1->kosul('19', array('' => ''), false);

else
{
$dongusuz102 = array(
'{ARKA_TABLO}' => $arka_tablo,
'{SON}' => $kp_dil_230,
'{SAYI}' => $portal_ayarlar['son_mesajlar_sayisi'],
'{MESAJ}' => $kp_dil_231,
'{KONU}' => $kp_dil_74,
'{YAZAN}' => $kp_dil_72,
'{CEVAP}' => $kp_dil_75,
'{GOSTERIM}' => $kp_dil_76,
'{SON_MESAJ}' => $kp_dil_77);



	while ($son99=$vt->fetch_assoc($vtsonuc100)):

	// mesaj başlığı uzunsa kısaltılıyor
	if (mb_substr($son99['mesaj_baslik'],50)) $kisa_baslik = mb_substr($son99['mesaj_baslik'],0,50, 'utf-8').' ...';
	else $kisa_baslik = $son99['mesaj_baslik'];

	$son_mesaj = '';

	if ($son99['cevap_sayi'] == 0)
	{
	$zaman = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $son99['son_mesaj_tarihi']); 
	$son_mesaj .= '<a href="'.$alt_dizin.linkver('profil.php?kim='.$son99['yazan'],$son99['yazan']).'">'.$son99['yazan'].'</a>
	<a href="'.$alt_dizin.linkver('konu.php?k='.$son99['id'],$son99['mesaj_baslik']).'" style="text-decoration: none">&nbsp;<b>'.$kp_dil_224.'</b></a>';  

	}

	// CEVAP VARSA SON MESAJ BİLGİLERİ ÇEKİLİYOR	//
	else{

	$zaman = zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $son99['son_mesaj_tarihi']);

	$son_mesaj .= '<a href="'.$alt_dizin.linkver('profil.php?kim='.$son99['son_cevap_yazan'],$son99['son_cevap_yazan']).'">'.$son99['son_cevap_yazan'].'</a>';

	//  BAŞLIK ÇOK SAYFALI İSE SON SAYFAYA GİT  //

	if ($son99['cevap_sayi'] > $ayarlar['ksyfkota']){
	$sayfaya_git = (($son99['cevap_sayi']-1) / $ayarlar['ksyfkota']);
	settype($sayfaya_git,'integer');
	$sayfaya_git = ($sayfaya_git * $ayarlar['ksyfkota']);

	$son_mesaj .= '&nbsp;<a href="'.$alt_dizin.linkver('konu.php?k='.$son99['id'].'&ks='.$sayfaya_git, $son99['mesaj_baslik'], '#c'.$son99['son_cevap']).'" style="text-decoration: none">';
	}

	else $son_mesaj .= '&nbsp;<a href="'.$alt_dizin.linkver('konu.php?k='.$son99['id'], $son99['mesaj_baslik'],'#c'.$son99['son_cevap']).'" style="text-decoration: none">';

	$son_mesaj .= '<b>'.$kp_dil_224.'</b>&nbsp;</a>';

	}


	$dongu101[] = array(
	'{SON_ILETI_RENGI}' => $sonileti_rengi,
	'{MESAJ_BASLIK}' => '<a href="'.$alt_dizin.linkver('konu.php?k='.$son99['id'],$son99['mesaj_baslik']).'" title="'.$son99['mesaj_baslik'].'">'.$kisa_baslik.' </a>',
	'{GONDEREN}' => '<a href="'.$alt_dizin.linkver('profil.php?kim='.$son99['yazan'],$son99['yazan']).'">'.$son99['yazan'].'</a>',
	'{CEVAP_SAYI}' => $son99['cevap_sayi'],
	'{GORUNTULENME}' => $son99['goruntuleme'],
	'{ZAMAN}' => $zaman,
	'{SON_MESAJ}' => $son_mesaj); 


	endwhile;


	if ($portal_ayarlar['son_mesajlar_hr'] == 'Shareketsiz')
	{
	$ornek1->kosul('20', array('' => ''), false);
	$ornek1->kosul('20a', array('' => ''), false);
	}


	$ornek1->tekli_dongu('5',$dongu101);
	$ornek1->dongusuz($dongusuz102);


	}



	// DOSYA KATEGORİLERİ SAYFASI //
	
	if ($portal_bloklar_ayar['haber'] == 2)
	{
	// VERİTABANINDAN BİLGİLER ÇEKİLİYOR //
	
	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = $portal_ayarlar['dosya_dal_limit']; 
	$kosullar = "order by kategorino desc"; 
	$tabloadi = $tablo_portal_indirkategori; 

	$sorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($sorgu); 

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
	<a href="'.$alt_dizin.linkver('profil.php?kim='.$icerik4['ekleyen'],$icerik4['ekleyen']).'">'.$icerik4['ekleyen'].'</a>
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
	<a href="'.$alt_dizin.linkver('profil.php?kim='.$icerik3['yorumlayan'],$icerik3['yorumlayan']).'">'.$icerik3['yorumlayan'].'</a>
	<br />'.mb_substr($icerik3['yorum_icerik'],0,15, 'utf-8').'...
	<br>'.zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $icerik3['yorum_tarih']).'</font>';
	}	
	
	$dongu111[] = array(
	'{DOSYA_SONUC}' => $dosya4,
	'{YORUM_SONUC}' => $dosya5,
	'{ARAMA_YAP}' => $kp_dil_176,
	'{ARAMA_BASLAT}' => $kp_dil_49,
	'{KATEGORI_NO}' => $indir_satir['kategorino'],
	'{DOSYA_DALI_LINKI}' => linkverPortal($ust_dizin.'dosyalar.php?kategorino='.$indir_satir['kategorino'],$indir_satir['kategoriadi']),
	'{KATEGORI_ADI}' => $indir_satir['kategoriadi'],
	'{ICERIK}' => $icerik,
	'{ICERIK_2}' => $icerik2);
	
	
	
	endwhile;
	
	
	}
	else
	{
	$dongu111[] = array(
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
	
	$ornek1->tekli_dongu('do1',$dongu111);
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,$phpkf_dosyalar['portal'].'?',$adresdeger='');
	
	$dongusuz111 = array(
	'{SAYFALAMA2}' => $tablo,
	'{TEMA_DIZIN}' => $temadizini,
	'{ARKA_TABLO}' => $arka_tablo,
	'{PORTAL_INDEX}' => $ust_dizin.'dosyalar.php',
	'{DOSYA_KATEGORILERI}' => $kp_dil_130,
	'{KATEGORI}' => $kp_dil_126,
	'{SON_DOSYALAR}' => $kp_dil_170,
	'{SON_YORUMLAR}' => $kp_dil_171,
	'{DOSYALAR3}' => $kp_dil_127,
	'{RESIM}' => $kp_dil_42,
	'{YORUMLAR}' => $kp_dil_172);

	$ornek1->dongusuz($dongusuz111);
	
	}
	else
	{
	$ornek1->kosul('dos', array('' => ''), false);
	}

	// DOSYA KATEGORİLERİ SAYFASI - SONU //
	
	
	// ANKET SORU BAŞLIKLARI //
	
	if ($portal_bloklar_ayar['haber'] == 3)
	{

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = $portal_ayarlar['anket_limit']; 
	$kosullar = "ORDER by tarih DESC"; 
	$tabloadi = $tablo_portal_anketsoru; 

	$sorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($sorgu); 

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
	'{ANKET_SORUSU2}' => '<a href="'.linkverPortal($ust_dizin.'anket.php?anketno='.$anket_sonuc1['anketno'],$anket_sonuc1['anket_soru']).'">'.$anket_sonuc1['anket_soru'].'</a>');
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
	$ornek1->tekli_dongu('an1',$dondur19);
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,$phpkf_dosyalar['portal'].'?',$adresdeger='');
	
	$dongusuz12 = array(
	'{SAYFALAMA3}' => $tablo,
	'{ALT_DIZIN}' => $alt_dizin,
	'{UST_DIZIN}' => $ust_dizin,
	'{ARKA_TABLO}' => $arka_tablo,
	'{ACILIS_TARIHI}' => $kp_dil_246,
	'{A_DURUMU}' => $kp_dil_248,
	'{A_OYLAR}' => $kp_dil_247,
	'{PORTAL_INDEX}' => $ust_dizin.'anket.php',
	'{ANKETLER}' => $kp_dil_164,
	'{ANKET_SORULARI}' => $kp_dil_165,
	'{SON_ANKETLER}' => $kp_dil_167);
	
	$ornek1->dongusuz($dongusuz12);
	
	}
	else
	{
	$ornek1->kosul('ank', array('' => ''), false);
	}
	
	// ANKETLER - SONU //
	
	// RESİM GALERİSİ //
	
	if ($portal_bloklar_ayar['haber'] == 4)
	{

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;

	$limit = '10'; 
	$kosullar = "order by tarih desc"; 
	$tabloadi = $tablo_portal_galeridal; 

	$sorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($sorgu); 

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

	$Sorgu_a1 = "select resim from $tablo_portal_galeri where resim_onay='1' AND id='$Sorgu_sonuc[id]' order by tarih desc limit 1";
	$Sorgu_kontrol_a1 = $vt->query($Sorgu_a1) or die ($vt->hata_ver());
	$Sorgu_sonuc_a1 = $vt->fetch_assoc($Sorgu_kontrol_a1);

	$resmin_sonucu1 = '';

	if ($vt->num_rows($Sorgu_kontrol_a1))
	{
	$resmin_sonucu1 .= $Sorgu_sonuc_a1['resim'];
	}
	else
	{
	$resmin_sonucu1 .= $ust_dizin.'temalar/'.$temadizini.'/resimler/resimler/otoavatar.png';
	}


	$Sorgu11 = $vt->query("select * from $tablo_portal_galeri where id='$Sorgu_sonuc[id]' AND resim_onay='1'") or die ($vt->hata_ver());
	$resim_sayisi = $vt->num_rows($Sorgu11);



	$dallar_dongu[] = array(
	'{DAL_ADRES}' => linkverPortal($ust_dizin.'galeri.php?gd='.$Sorgu_sonuc['id'],$Sorgu_sonuc['dal']),
	'{RESIM_SAYISI}' => $resim_sayisi,
	'{RESIM}' => $resmin_sonucu1,
	'{DAL}' => $Sorgu_sonuc['dal']);

	}

	unset($Sorgu);
	unset($Sorgu_kontrol);
	unset($Sorgu_sonuc);

	$kilitle = '';
	$kilit_ileti = '';

	if (isset($kullanici_kim['id'])) $ornek1->kosul('3', array('' => ''), false);


	if (!isset($dallar_dongu)) 
	{
	$ornek1->kosul('gle', array('{SONUC}' => $kp_dil_304), true);
	$ornek1->kosul('gli', array('' => ''), false);
	}
	else $ornek1->kosul('gle', array('{SONUC}' => ''), false);

	if (!isset($dallar_dongu))
	{
	$dallar_dongu[] = array(
	'{DAL_ADRES}' => '',
	'{RESIM_SAYISI}' => '',
	'{RESIM}' => '',
	'{DAL}' => '');
	}

	$ornek1->tekli_dongu('gl1',$dallar_dongu);

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

	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,$phpkf_dosyalar['portal'].'?',$adresdeger='');

	$java = "<script type=\"text/javascript\">
	<!-- //
	function sayfa_ac(resim, resim_genislik, resim_yukseklik)
	{
	window.open(resim,'galeri','scrollbars=yes,left=1,top=1,resizable=yes,width=' + resim_genislik + ',height=' + resim_yukseklik);
	}
	//  -->
	</script>";
	
	
	
	$ornek1->dongusuz(array('{JAVA_SCRIPT}' => $java));
	
	
	$ornek1->dongusuz(array(
	'{SAYFALAMA4}' => $tablo,
	'{ARKA_TABLO}' => $arka_tablo,
	'{SON}' => $kp_dil_303,
	'{BURADA}' => $kp_dil_299,
	'{RESIM_VAR}' => $kp_dil_300,
	'{ENCOK_PUAN_ALAN2}' => $kp_dil_301,
	'{SON_YUKLENEN2}' => $kp_dil_302,
	'{TOPLAM_RESIM_SAYISI}' => $Sorgu_sonuc_a2,
	'{SON_RESIM_BILGISI}' => $Sorgu_sonuc_a3['isim'],
	'{SON_RESIM_ADRESI}' => $Sorgu_sonuc_a3['resim'],
	'{RESIM_GENISLIK_1}' => $Sorgu_sonuc_a3['resim_genislik']+20,
	'{RESIM_YUKSEKLIK_1}' => $Sorgu_sonuc_a3['resim_yukseklik']+20,
	'{ENCOK_PUAN_ALAN}' => $paun_sonuC,
	'{ENCOK_PUAN_ALAN_ADRESI}' => $Sorgu_sonuc_a4['resim'],
	'{RESIM_GENISLIK}' => $Sorgu_sonuc_a4['resim_genislik']+20,
	'{RESIM_YUKSEKLIK}' => $Sorgu_sonuc_a4['resim_yukseklik']+20,
	'{GALERI_DALLARI}' => $kp_dil_267,
	'{DALLAR}' => $kp_dil_268,
	'{RESIM_EKLEME_SAYFASI}' => $ust_dizin.'galeri.php?kosul=resim_ekle',
	'{RESIM_EKLEME_SAYFASI_ADI}' => $kp_dil_270,
	'{TOPLAM_RESIM}' => $kp_dil_269));

		
	}
	else
	{
	$ornek1->kosul('glr', array('' => ''), false);
	}
	
	// RESİM GALERİSİ - SONU //





	if ($portal_bloklar_ayar['haber'] == 5)
	{

	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = $portal_ayarlar['siteler_dal_limit']; 
	$kosullar = "order by tarih desc"; 
	$tabloadi = $tablo_portal_siteekledal; 

	$sorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($sorgu); 

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}

	$Sorgu = $vt->query("select * from $tabloadi $kosullar LIMIT $baslangic,$limit");
	
	While ($siteler = $vt->fetch_assoc($Sorgu))
	{
	
	$Sorgu_a2 = "select site_onay,dal_no from $tablo_portal_siteekle where dal_no='$siteler[dal_no]' AND site_onay='1'";
	$Sorgu_kontrol_a2 = $vt->query($Sorgu_a2) or die ($vt->hata_ver());
	$Sorgu_sonuc_a2 = $vt->num_rows($Sorgu_kontrol_a2);


	$site_dondur2[] = array(
	'{TARIH}' => $siteler['tarih'],
	'{TOPLAM_SITE2}' => $Sorgu_sonuc_a2,
	'{KATEGORI_BASLIK}' => '<a href="'.linkverPortal($ust_dizin.'site_ekle.php?sd='.$siteler['dal_no'],$siteler['baslik']).'">'.$siteler['baslik'].'</a>',
	'{DAL_NO}' => $siteler['dal_no']);


	}
	
	$Sorgu_a2 = "select * from $tablo_portal_siteekle where site_onay='1'";
	$Sorgu_kontrol_a2 = $vt->query($Sorgu_a2) or die ($vt->hata_ver());
	$Sorgu_sonuc_a2 = $vt->num_rows($Sorgu_kontrol_a2);

	$Sorgu_a3 = "select * from $tablo_portal_siteekle where site_onay='1' order by tarih desc limit 1";
	$Sorgu_kontrol_a3 = $vt->query($Sorgu_a3) or die ($vt->hata_ver());
	$Sorgu_sonuc_a3 = $vt->fetch_assoc($Sorgu_kontrol_a3);
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,$phpkf_dosyalar['portal'].'?',$adresdeger='');	
	
	
	$site_dongusuz2 = array(
	'{BURADA}' => $kp_dil_299,
	'{SITE_VAR}' => $kp_dil_484,
	'{TOPLAM_SITE_SAYISI}' => $Sorgu_sonuc_a2,
	'{SON_YUKLENEN2}' => $kp_dil_485,
	'{SON_SITE_BILGISI}' => $Sorgu_sonuc_a3['site_title'],
	'{SON_SITE_ADRESI}' => $ust_dizin.'site_ekle.php?kosul=siteye_yonlendiriliyor&amp;site_id='.$Sorgu_sonuc_a3['site_id'],
	'{SAYFALAMA5}' => $tablo,
	'{SITE_EKLE_SAYFASI}' => $kp_dil_444,
	'{SITE_EKLE_SAYFASI_LINK}' => $ust_dizin.'site_ekle.php?kosul=yeni_site_ekle',
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
	
	$ornek1->tekli_dongu('st1',$site_dondur2);
		
	}
	else
	{
	$ornek1->kosul('ste', array('' => ''), false);
	}





	if ($portal_bloklar_ayar['haber'] == 6)
	{
	if ($kullanici_kim['yetki'] != 1) $ornek1->kosul('fm5', array('' => ''), false);
	
	if (isset($_GET['s']) AND is_numeric($_GET['s']) == true) $_GET['s'] = @zkTemizle($_GET['s']);
	else $_GET['s'] = 0;
	
	$limit = $portal_ayarlar['haber_limit']; 
	$kosullar = "where hangi_forumdan='$portal_ayarlar[haber_kaynagi]' AND silinmis='0' order by son_mesaj_tarihi desc"; 
	$tabloadi = $tablo_mesajlar; 

	$sorgu = $vt->query("SELECT COUNT(* ) FROM $tabloadi $kosullar" ); 
	$satir_sayisi = $vt->num_rows($sorgu); 

	@ $sayfa = abs(intval($_GET['s'] ) ); 
	if(empty($sayfa ) || $sayfa > ceil($satir_sayisi/$limit ) ) 
	{ 
	$sayfa = 1; 
	$baslangic = 0; 
	} else { 
	$baslangic = ($sayfa - 1 ) * $limit; 
	}

	$Sorgu = $vt->query("select id,mesaj_baslik,mesaj_icerik,bbcode_kullan,ifade,hangi_forumdan,yazan,goruntuleme,tarih,cevap_sayi,son_cevap,son_mesaj_tarihi from $tabloadi $kosullar LIMIT $baslangic,$limit");
	
	While ($phpkf_mesajlar = $vt->fetch_assoc($Sorgu))
	{

		if($phpkf_mesajlar['ifade']==1) $phpkf_mesajlar['mesaj_icerik'] = ifadeler($phpkf_mesajlar['mesaj_icerik']);

		$aciklama_sonucu = '';
		
		if (strlen($phpkf_mesajlar['mesaj_icerik']) > $karakter_siniri)
		{
			$aciklama_sonucu .= mb_substr(BBcodeTemizle(bbcode_kapali($phpkf_mesajlar['mesaj_icerik'])),0,$karakter_siniri, 'utf-8').'....<br><a href="'.$alt_dizin.linkver('konu.php?k='.$phpkf_mesajlar['id'],$phpkf_mesajlar['mesaj_baslik']).'"><b>'.$kp_dil_359.'&nbsp;&raquo;</b></a>';
		}
		else
		{
			if ( ($phpkf_mesajlar['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
			{
				$aciklama_sonucu .= bbcode_acik($phpkf_mesajlar['mesaj_icerik'],$phpkf_mesajlar['id']);
			}
			else
			{
				$aciklama_sonucu .= bbcode_kapali($phpkf_mesajlar['mesaj_icerik']);
			}
		}



	//  BAŞLIK ÇOK SAYFALI İSE SON SAYFAYA GİT  //
	$Sorgu_sonuc_ala111 ='';
	if ($phpkf_mesajlar['cevap_sayi'] > $ayarlar['ksyfkota']){
	$sayfaya_git = (($phpkf_mesajlar['cevap_sayi']-1) / $ayarlar['ksyfkota']);
	settype($sayfaya_git,'integer');
	$sayfaya_git = ($sayfaya_git * $ayarlar['ksyfkota']);

	$Sorgu_sonuc_ala111 .= '&nbsp;<a href="'.$alt_dizin.linkver('konu.php?k='.$phpkf_mesajlar['id'].'&ks='.$sayfaya_git, $phpkf_mesajlar['mesaj_baslik'], '#c'.$phpkf_mesajlar['son_cevap']).'" style="text-decoration: none">';
	}

	else $Sorgu_sonuc_ala111 .= '<a href="'.$alt_dizin.linkver('konu.php?k='.$phpkf_mesajlar['id'],$phpkf_mesajlar['mesaj_baslik']).'#c'.$phpkf_mesajlar['son_cevap'].'">';

	$Sorgu_sonuc_ala111 .= $kp_dil_532.'</a>: '.$phpkf_mesajlar['cevap_sayi'];

	
	
	$phpkf_frm[] = array(
	'{SIL4}' => $kp_dil_338,
	'{DUZENLE4}' => $kp_dil_339,
	'{DUZENLEME4}' => $alt_dizin.'mesaj_degistir.php?fno='.$phpkf_mesajlar['hangi_forumdan'].'&amp;kip=mesaj&amp;mesaj_no='.$phpkf_mesajlar['id'].'&amp;fsayfa=0',
	'{SIL44}' => $alt_dizin.'phpkf-bilesenler/mesaj_sil.php?fno='.$phpkf_mesajlar['hangi_forumdan'].'&amp;kip=mesaj&amp;mesaj_no='.$phpkf_mesajlar['id'].'&amp;fsayfa=0',
	'{SIL_UYARISI4}' => $kp_dil_151,
	'{ADRES}' => $alt_dizin.linkver('konu.php?k='.$phpkf_mesajlar['id'],$phpkf_mesajlar['mesaj_baslik']),
	'{TOPLAM_YORUM}' => $Sorgu_sonuc_ala111,
	'{YAZAN_FRM}' => '<a href="'.$alt_dizin.linkver('profil.php?kim='.$phpkf_mesajlar['yazan'],$phpkf_mesajlar['yazan']).'">'.$phpkf_mesajlar['yazan'].'</a>',
	'{TARIH}' => zonedate($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $phpkf_mesajlar['son_mesaj_tarihi']),
	'{ICERIK}' => $aciklama_sonucu,
	'{BASLIK}' => $phpkf_mesajlar['mesaj_baslik'],
	'{OKUNMA}' => $phpkf_mesajlar['goruntuleme']);
	
	}
	
	
	
	
	$tablo = sayfalama($limit,$sayfa,$satir_sayisi,$phpkf_dosyalar['portal'].'?',$adresdeger='');
	
	
	$Sorgu_al = "select forum_baslik,id from $tablo_forumlar where id='$portal_ayarlar[haber_kaynagi]' limit 1";
	$Sorgu_kontrol_al = $vt->query($Sorgu_al) or die ($vt->hata_ver());
	$Sorgu_sonuc_al = $vt->fetch_assoc($Sorgu_kontrol_al);

	
	$frm_dongusuz2 = array(
	'{SAYFALAMA5}' => $tablo,
	'{YENI_BASLIK}' => $kp_dil_491,
	'{YENI_BASLIK_LINK}' => 'mesaj_yaz.php?fno='.$portal_ayarlar['haber_kaynagi'].'&amp;kip=yeni',
	'{FORUM_BASLIK}' => $Sorgu_sonuc_al['forum_baslik'],
	'{YAZAN2}' => $kp_dil_328,
	'{OKUNMA2}' => $kp_dil_329,
	'{TARIH2}' => $kp_dil_77);
	
	$ornek1->dongusuz($frm_dongusuz2);
	
	if (!isset($phpkf_frm))
	{
	$phpkf_frm[] = array(
	'{SIL4}' => '',
	'{DUZENLE4}' => '',
	'{DUZENLEME4}' => '',
	'{SIL44}' => '',
	'{SIL_UYARISI4}' => '',
	'{ICERIK}' => $kp_dil_492,
	'{ADRES}' => '',
	'{TOPLAM_YORUM}' => '',
	'{YAZAN_FRM}' => '',
	'{TARIH}' => '',
	'{BASLIK}' => '',
	'{OKUNMA}' => '');
	
	}
	
	$ornek1->tekli_dongu('fm',$phpkf_frm);
		
	}
	else
	{
	$ornek1->kosul('fm', array('' => ''), false);
	}

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	exit();

?>