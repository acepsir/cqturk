<?php
/*
 +-=========================================================================-+
 |                              phpKF-CMS v3.00                              |
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
if (!defined("DOSYA_BLOKLAR")) define('DOSYA_BLOKLAR',true);
if (!defined("PHPKF_ICINDEN_TEMA")) define("PHPKF_ICINDEN_TEMA",true);

if (!defined('DOSYA_AYAR')) include_once('phpkf-ayar.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('phpkf-bilesenler/kullanici_kimlik.php');



// Kategoriler veritabanından çekiliyor

$vtsorgu = "SELECT * FROM $tablo_kategoriler ORDER BY tip!=0,sira,id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$sira = 0;

while ($blok_kategori = $vt->fetch_assoc($vtsonuc))
{
	// Dil seçimine göre içerik alınıyor
	if ($ayarlar['dil_varsayilan'] != $site_dili)
	{
		if (isset($blok_kategori['baslik_'.$site_dili])) $blok_kategori['baslik'] = $blok_kategori['baslik_'.$site_dili];
	}

	$tum_kategoriler[$blok_kategori['id']]['id'] = $blok_kategori['id'];
	$tum_kategoriler[$blok_kategori['id']]['adres'] = $blok_kategori['adres'];
	$tum_kategoriler[$blok_kategori['id']]['baslik'] = $blok_kategori['baslik'];
	$tum_kategoriler[$blok_kategori['id']]['bilgi'] = $blok_kategori['bilgi'];
	$tum_kategoriler[$blok_kategori['id']]['alt_kat'] = $blok_kategori['alt_kat'];
	$tum_kategoriler[$blok_kategori['id']]['toplam'] = $blok_kategori['toplam'];
	$sira++;
}



//   BLOKLAR SIRALANIYOR - BAŞI   //

// bloklar veritabanından çekiliyor
$vtsorgu = "SELECT * FROM $tablo_bloklar WHERE durum!=0 ORDER BY sira";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


$bloklar_cikis[1] = '';
$bloklar_cikis[2] = '';
$sira1 = 0;
$sira2 = 0;
$engenis_solblok = 0;
$engenis_sagblok = 0;
$bul = array(' ', 'px','%');


// forum ve portal durumu için ek sorgu
$drm_syf_ek = '';
if ($forum_kullan != 1) $drm_syf_ek .= " AND ad!='forum' AND ad!='ozel'";
if ($portal_kullan != 1) $drm_syf_ek .= " AND ad!='portal'";

// üye giriş durumu için ek sorgu
if (isset($kullanici_kim['id']))
{
	if ($kullanici_kim['yetki'] == 1) $drm_syf_ek .= " AND ad!='kayit'";
	else $drm_syf_ek .= " AND ad!='kayit' AND ad!='yonetim'";
}
else $drm_syf_ek .= " AND ad!='profil' AND ad!='duzenle' AND ad!='sifre' AND ad!='ozel' AND ad!='yonetim'";



while ($bloklar = $vt->fetch_assoc($vtsonuc))
{
	$i = $bloklar['durum'];
	$bloklar_cikis[$i] = '';


	// BAĞLANTILAR BLOĞU İÇİN //

	if ($bloklar['ad'] == 'baglantilar')
	{
		if ($bloklar['baslik'] == 'Bağlantılar') $blok_baslik = $l['baglantilar'];
		else $blok_baslik = $bloklar['baslik'];


		// Blok bağlantıları veritabanından çekiliyor
		$vtsorgu = "SELECT * FROM $tablo_baglantilar WHERE yer='2' AND alt_menu='0' $drm_syf_ek ORDER BY sira,id";
		$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());


		// bağlantılar sıralanıyor
		$bloklar_cikis[$i] .= $tema_ozellik_blok_baglanti['ana_yapı_acilis'];

		while ($blokbag = $vt->fetch_array($vtsonuc2))
		{
			$bloklar_cikis[$i] .= phpkf_ust_menu($blokbag, $tema_ozellik_blok_baglanti);
		}

		$bloklar_cikis[$i] .= $tema_ozellik_blok_baglanti['ana_yapı_kapanis'];
	}




	// KATEGORİLER BLOĞU İÇİN //

	elseif ($bloklar['ad'] == 'kategoriler')
	{
		if ($bloklar['baslik'] == 'Kategoriler') $blok_baslik = $l['kategoriler'];
		else $blok_baslik = $bloklar['baslik'];

		$bloklar_cikis[$i] .= $tema_ozellik_blok_baglanti['ana_yapı_acilis'];

		foreach ($tum_kategoriler as $blok_kategori)
		{
			if ($blok_kategori['alt_kat'] != '0') continue;
			$adres = linkyap($phpkf_dosyalar['cms'].'?kip=kat&k='.$blok_kategori['id'], $blok_kategori['adres']);
			$bulk = array('{ADRES}', '{BILGI}', '{ISIM}', '{TOPLAM}');
			$degisk = array($adres, $blok_kategori['baslik'], $blok_kategori['baslik'], NumaraBicim($blok_kategori['toplam']));
			$bloklar_cikis[$i] .= str_replace($bulk, $degisk, $tema_ozellik_blok_baglanti['alt_link']);
			$bloklar_cikis[$i] .= phpkf_tema_alt_kategoriler(array('alt_kat' => $blok_kategori['id']));
		}
		$bloklar_cikis[$i] .= $tema_ozellik_blok_baglanti['ana_yapı_kapanis'];
	}




	// ÖZEL BLOK İSE //

	else
	{
		if ($bloklar['baslik'] == 'Son Yorumlar') $blok_baslik = $l['son_yorumlar'];
		elseif ($bloklar['baslik'] == 'Beğenilen Yazılar') $blok_baslik = $l['begenilen_yazilar'];
		elseif ($bloklar['baslik'] == 'Çevrimiçi Üyeler') $blok_baslik = $l['cevrimici_uyeler'];
		elseif ($bloklar['baslik'] == 'İstatistikler') $blok_baslik = $l['istatistikler'];
		elseif ($bloklar['baslik'] == 'Kullanıcı Masası') $blok_baslik = $l['kullanici_masasi'];
		else $blok_baslik = $bloklar['baslik'];

		if ($bloklar['adres'] != '')
		{
			// tamponlama başlatılıyor
			ob_start();
			ob_implicit_flush(0);

			if (include_once($bloklar['adres'])) $bloklar_cikis[$i] .= ob_get_contents();
			else $bloklar_cikis[$i] .= '<font color="#ff0000"><b>Hata:</b></font> <b>'.$bloklar['adres'].'</b> dosyası bulunamıyor !';

			// ekran temizleniyor
			ob_end_clean();
		}
		else $bloklar_cikis[$i] .= $bloklar['ozel_blok_kod'];
	}



	// Sol bloklar
	if ($bloklar['durum'] == 1)
	{
		$TEMA_SOLBLOK[$sira1]['GENISLIK'] = $bloklar['blok_genislik'];
		$TEMA_SOLBLOK[$sira1]['BASLIK'] = $blok_baslik;
		$TEMA_SOLBLOK[$sira1]['ICERIK'] = $bloklar_cikis[$i];
		$sira1++;

		// En geniş sol blok bulunuyor
		if (str_replace($bul, '', $engenis_solblok) < str_replace($bul, '', $bloklar['blok_genislik'])) $engenis_solblok = $bloklar['blok_genislik'];
	}

	// Sağ bloklar
	elseif ($bloklar['durum'] == 2)
	{
		$TEMA_SAGBLOK[$sira2]['GENISLIK'] = $bloklar['blok_genislik'];
		$TEMA_SAGBLOK[$sira2]['BASLIK'] = $blok_baslik;
		$TEMA_SAGBLOK[$sira2]['ICERIK'] = $bloklar_cikis[$i];
		$sira2++;

		// En geniş sağ blok bulunuyor
		if (str_replace($bul, '', $engenis_sagblok) < str_replace($bul, '', $bloklar['blok_genislik'])) $engenis_sagblok = $bloklar['blok_genislik'];
	}
}

//   BLOKLAR SIRALANIYOR - SONU   //



// bloklar tema dosyası yükleniyor
include_once('phpkf-bilesenler/temalar/'.$temadizini_cms.'/bloklar.php');

?>