<?php
/*
 +-=========================================================================-+
 |                              phpKF Forum v3.00                            |
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


if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_SISTEM_SINIF')) define('DOSYA_SISTEM_SINIF',true);



// Üst Menü Fonksiyonu

function phpkf_ust_menu($baglanti, $tasarim, $ek='')
{
	global $ayarlar,$vt,$tablo_baglantilar,$kullanici_kim,$o,$lmenu,$site_dili,$cms_kullan,$forum_kullan,$portal_kullan,$cms_dizin,$forum_dizin,$phpkf_dosyalar;


	$linkler = '';
	switch($baglanti['ad'])
	{
		case 'anasayfa';
		$adres = $phpkf_dosyalar['anasayfa']; $ad = $lmenu['anasayfa']; $bilgi = $lmenu['anasayfa'];
		break;

		case 'cms';
		$adres = $cms_dizin.$phpkf_dosyalar['cms']; $ad = $lmenu['cms']; $bilgi = $lmenu['cms'];
		break;

		case 'forum';
		$adres = $phpkf_dosyalar['forum']; $ad = $lmenu['forum']; $bilgi = $lmenu['forum'];
		break;

		case 'portal';
		$adres = $phpkf_dosyalar['portal']; $ad = $lmenu['portal']; $bilgi = $lmenu['portal'];
		break;

		case 'uyeler';
		$adres = $phpkf_dosyalar['uyeler']; $ad = $lmenu['uye']; $bilgi = $lmenu['uye'];
		break;

		case 'cevrimici';
		$adres = $phpkf_dosyalar['cevrimici']; $ad = $lmenu['cevrimici']; $bilgi = $lmenu['cevrimici'];
		break;

		case 'yardim';
		$adres = $phpkf_dosyalar['yardim']; $ad = $lmenu['yardim']; $bilgi = $lmenu['yardim'];
		break;

		case 'mobil';
		$adres = $phpkf_dosyalar['mobil']; $ad = $lmenu['mobil']; $bilgi = $lmenu['mobil'];
		break;

		case 'rss';
		$adres = $phpkf_dosyalar['rss']; $ad = $lmenu['rss']; $bilgi = $lmenu['rss'];
		break;

		case 'profil';
		$adres = $phpkf_dosyalar['profil']; $ad = $lmenu['profil']; $bilgi = $lmenu['profil'];
		break;

		case 'duzenle';
		$adres = $phpkf_dosyalar['profil_degistir']; $ad = $lmenu['duzenle']; $bilgi = $lmenu['duzenle'];
		break;

		case 'sifre';
		$adres = $phpkf_dosyalar['sifre_degistir']; $ad = $lmenu['sifre']; $bilgi = $lmenu['sifre'];
		break;

		case 'ozel';
		$adres = $phpkf_dosyalar['ozel_ileti']; $ad = $lmenu['ozel']; $bilgi = $lmenu['ozel'];
		break;

		case 'yonetim';
		$adres = 'yonetim/index.php'; $ad = $lmenu['yonetim']; $bilgi = $lmenu['yonetim'];
		break;

		case 'kayit';
		$adres = $phpkf_dosyalar['kayit']; $ad = $lmenu['kayit']; $bilgi = $lmenu['kayit'];
		break;

		case 'giris-cikis';
		if (isset($kullanici_kim['id'])){
			$ad = $lmenu['cikis']; $bilgi = $lmenu['cikis'];
			$adres = $phpkf_dosyalar['cikis'].'?o='.$o.'" onclick="return window.confirm(jsl[\'cikis_uyari\'])';
		}
		else {$adres = $phpkf_dosyalar['giris']; $ad = $lmenu['giris']; $bilgi = $lmenu['giris'];}
		break;

		case 'arama';
		$adres = $phpkf_dosyalar['arama'];
		$ad = $lmenu['arama']; $bilgi = $lmenu['arama'];
		break;

		case 'kategoriler';
		$adres = $cms_dizin.linkyap($phpkf_dosyalar['cms'].'?kip=kat', $ayarlar['dizin_kat']);
		$ad = $lmenu['kategori']; $bilgi = $lmenu['kategori'];
		break;

		case 'sayfalar';
		$adres = $cms_dizin.linkyap($phpkf_dosyalar['cms'].'?kip=sayfa', $ayarlar['dizin_sayfa']);
		$ad = $lmenu['sayfa']; $bilgi = $lmenu['sayfa'];
		break;

		case 'galeriler';
		$adres = $cms_dizin.linkyap($phpkf_dosyalar['cms'].'?kip=galeri', $ayarlar['dizin_galeri']);
		$ad = $lmenu['galeri']; $bilgi = $lmenu['galeri'];
		break;

		case 'videolar';
		$adres = $cms_dizin.linkyap($phpkf_dosyalar['cms'].'?kip=video', $ayarlar['dizin_video']);
		$ad = $lmenu['video']; $bilgi = $lmenu['video'];
		break;

		case 'etiket';
		$adres = $cms_dizin.linkyap($phpkf_dosyalar['cms'].'?kip=etiket', $ayarlar['dizin_etiket']);
		$ad = $lmenu['etiket']; $bilgi = $lmenu['etiket'];
		break;

		case 'iletisim';
		$adres = $cms_dizin.linkyap($phpkf_dosyalar['cms'].'?kip=iletisim', 'iletisim.html');
		$ad = $lmenu['iletisim']; $bilgi = $lmenu['iletisim'];
		break;


		default:
		if (preg_match("/y=([0-9]*?)&ya=([a-z0-9-]*?)&k=([0-9]*?)&ka=([a-z0-9-]*?)$/i", $baglanti['adres'], $adres, PREG_OFFSET_CAPTURE))
			$adres = $cms_dizin.linkyap($phpkf_dosyalar['cms'].'?k='.$adres[3][0].'&y='.$adres[1][0], $adres[4][0], $adres[2][0]);

		elseif (preg_match("/k=([0-9]*?)&ka=([a-z0-9-]*?)$/i", $baglanti['adres'], $adres, PREG_OFFSET_CAPTURE))
			$adres = $cms_dizin.linkyap($phpkf_dosyalar['cms'].'?kip=kat&k='.$adres[1][0], $adres[2][0]);

		else $adres = $baglanti['adres'];

		$ad = $baglanti['ad'];
		$bilgi = $baglanti['bilgi'];

		// Dil seçimine göre içerik alınıyor
		if (($site_dili != $ayarlar['dil_varsayilan']) AND (isset($baglanti['ad_'.$site_dili])) AND ($baglanti['ad_'.$site_dili] != ''))
		{
			$ad = $baglanti['ad_'.$site_dili];
			$bilgi = $baglanti['ad_'.$site_dili];
		}
	}



	if (preg_match('/^(\/|http:|https:|ftp:|javascript:)/is', $adres)) $yeni_adres = $adres;
	else $yeni_adres = $ek.$adres;
	$linkler .= "\r\n";
	$bul = array('{ADRES}', '{BILGI}', '{ISIM}', '{TOPLAM}');
	$degis = array($yeni_adres, $bilgi, $ad, '');


	// Sayfalar, kategoriler, forum, portal ve üye giriş durumu için ek sorgu
	$drm_syf_ek = '';
	if ($portal_kullan != 1) $drm_syf_ek .= " AND ad!='portal'";
	if ($cms_kullan != 1) $drm_syf_ek .= " AND ad!='cms' AND ad!='kategoriler' AND ad!='sayfalar' AND ad!='galeriler' AND ad!='videolar' AND ad!='etiket' AND ad!='iletisim'";

	// üye giriş durumu için ek sorgu
	if (isset($kullanici_kim['id']))
	{
		if ($kullanici_kim['yetki'] == 1) $drm_syf_ek .= " AND ad!='kayit'";
		else $drm_syf_ek .= " AND ad!='kayit' AND ad!='yonetim'";
	}
	else $drm_syf_ek .= " AND ad!='profil' AND ad!='duzenle' AND ad!='sifre' AND ad!='ozel' AND ad!='yonetim'";


	$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE alt_menu='$baglanti[id]' $drm_syf_ek ORDER BY sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	if ($vt->num_rows($vtsonuc))
	{
		$linkler .= str_replace($bul, $degis, $tasarim['ust_acilis']);
		while($altlink = $vt->fetch_assoc($vtsonuc))
			$linkler .= phpkf_ust_menu($altlink, $tasarim, $ek);
		$linkler .= $tasarim['ust_kapanis'];
	}

	else
	{
		$linkler .= str_replace($bul, $degis, $tasarim['alt_link']);
	}

	return($linkler);
}




// Taban Menü Fonksiyonu

function phpkf_taban_menu($adet, $ek='')
{
	global $vt, $tablo_baglantilar, $phpkf_dosyalar, $tema_ozellik_taban_baglanti;

	$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE yer='3' AND alt_menu='0' ORDER BY sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$toplam_taban_link = $vt->num_rows($vtsonuc);

	$sayi = 0; $tekrar = 0;
	$toplam = ($toplam_taban_link / $adet);

	if (is_int($toplam)) settype($toplam,'integer');
	else
	{
		settype($toplam,'integer');
		$toplam++;
	}

	while ($menubag = $vt->fetch_array($vtsonuc))
	{
		if ($sayi==0) echo $tema_ozellik_taban_baglanti['ana_yapı_acilis']."\r\n";
		$sayi++;
		$tekrar++;

		echo phpkf_ust_menu($menubag, $tema_ozellik_taban_baglanti, $ek);

		if ( (($toplam_taban_link == ($adet+1)) AND ($sayi == 1) AND (isset($kapandi))) OR ($sayi == $toplam) OR ($tekrar == $toplam_taban_link) )
		{
			echo $tema_ozellik_taban_baglanti['ana_yapı_kapanis']."\r\n";
			$sayi = 0;
			$kapandi = true;
		}
	}
}


${"GLOBA\x4c\x53"}["j\x64\x64o\x77\x75g\x67\x6eo"]="c";${"\x47L\x4fBAL\x53"}["\x64\x79\x6f\x67\x66\x6eq\x68"]="\x69";${"\x47LOBALS"}["\x71\x68\x73\x6fcq\x62\x78\x68"]="k";${"\x47L\x4f\x42\x41L\x53"}["i\x65\x65\x67gg\x69z"]="p";${"\x47\x4c\x4fB\x41\x4c\x53"}["\x63\x67\x6e\x65\x61\x72\x77"]="\x61";

include_once('_lisans_forum.php');

?>