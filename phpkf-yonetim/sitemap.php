<?php
/*
 +-=========================================================================-+
 |                                phpKF v3.00                                |
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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



//  SİTE HARİTASI OLUŞTURMA İŞLEMLERİ - BAŞI  //

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'guncelle') ):



// Sitedeki verilerin güncellenme/değiştirilme sıklığı (<changefreq>)
// Anasayfa için günlük,
// Kategoriler için haftalık,
// Yazılar ve sayfalar için ise aylık güncellenme sıklığı ideal.
$surekli = 'always';
$saatbasi = 'hourly';
$gunluk = 'daily';
$haftalik = 'weekly';
$aylik = 'monthly';
$yillik = 'yearly';
$hic = 'never';
$tarih = time();
$otomatik_ping = 0;
$cms_ek1 = '';
$cms_ek2 = '';
$forum_ek = '';
$portal_ek = '';



// Site haritası için tarih biçimi
function phpKF_SiteHaritasi($zamandilimi, $tarih)
{
	$yazsaati = date('I');
	if ($zamandilimi >> 0){
		if ($yazsaati == 1) $zdilim = ($zamandilimi + 1) * 3600;
		else $zdilim = $zamandilimi * 3600;
	}
	else{
		if ($yazsaati == 1) $zdilim = 3600;
		else $zdilim = 0;
	}
	$sonuc = gmdate('c', $tarih + $zdilim);
	return $sonuc;
}



// Sitemap Ping Fonksiyonu (Google Webmaster Araçları'na Sitemap'ı bildirir)
function sitemap_pingle()
{
	global $TEMA_SITE_ANADIZIN;

	$durum = 0;
	$adres = urlencode($TEMA_SITE_ANADIZIN.'sitemap.xml');

	if ($fp = @fsockopen('www.google.com', 80))
	{
		$istek = 'GET /webmasters/sitemaps/ping?sitemap='.$adres." HTTP/1.1\r\n".
		"Host: www.google.com\r\n".
		"User-Agent: Mozilla/5.0 (compatible; ".PHP_OS.") PHP/".PHP_VERSION."\r\n".
		"Connection: Close\r\n\r\n";

		fwrite($fp, $istek);
		while(!feof($fp))
		{
			if(@preg_match('~^HTTP/\d\.\d (\d+)~i', fgets($fp, 128), $m))
			{
				$durum = intval($m[1]);
				break;
			}
		}
		fclose($fp);
	}
	return($durum);
}



// CMS kategoriler
if ($cms_kullan == 1)
{
	// Kategoriler veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_kategoriler ORDER BY id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$sira = 0;

	while ($blok_kategori = $vt->fetch_assoc($vtsonuc))
	{
		$tum_kategoriler[$blok_kategori['id']]['id'] = $blok_kategori['id'];
		$tum_kategoriler[$blok_kategori['id']]['adres'] = $blok_kategori['adres'];
		$tum_kategoriler[$blok_kategori['id']]['baslik'] = $blok_kategori['baslik'];
		$tum_kategoriler[$blok_kategori['id']]['bilgi'] = $blok_kategori['bilgi'];
		$sira++;
	}
}



// cms, forum, portal linkler
if ($cms_kullan == 1)
{
	$cms_ek1 = "<url>
	<loc>".$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['cms']."</loc>
	<lastmod>".phpKF_SiteHaritasi(2, $tarih)."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>";

	$cms_ek2 = "<url>
	<loc>".$TEMA_SITE_ANADIZIN.linkyap($phpkf_dosyalar['cms'].'?kip=kat', $ayarlar['dizin_kat'])."</loc>
	<lastmod>".phpKF_SiteHaritasi(2, $tarih)."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>
<url>
	<loc>".$TEMA_SITE_ANADIZIN.linkyap($phpkf_dosyalar['cms'].'?kip=galeri', $ayarlar['dizin_galeri'])."</loc>
	<lastmod>".phpKF_SiteHaritasi(2, $tarih)."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>
<url>
	<loc>".$TEMA_SITE_ANADIZIN.linkyap($phpkf_dosyalar['cms'].'?kip=video', $ayarlar['dizin_video'])."</loc>
	<lastmod>".phpKF_SiteHaritasi(2, $tarih)."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>";
}


if ($forum_kullan == 1)
{
	$forum_ek = "<url>
	<loc>".$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['forum']."</loc>
	<lastmod>".phpKF_SiteHaritasi(2, $tarih)."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>
<url>
	<loc>".$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['mobil']."</loc>
	<lastmod>".phpKF_SiteHaritasi(2, $tarih)."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>";
}


if ($ayarlar['portal_kullan'] == 1)
{
	$portal_ek .= "<url>
	<loc>".$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['portal']."</loc>
	<lastmod>".phpKF_SiteHaritasi(2, $tarih)."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>";
}




// Site Haritası Başı //

$icerik ="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<?xml-stylesheet type=\"text/xsl\" href=\"phpkf-bilesenler/sitemap.xsl\"?>
<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">
<url>
	<loc>".$TEMA_SITE_ANADIZIN."</loc>
	<lastmod>".phpKF_SiteHaritasi(2, $tarih)."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>
$cms_ek1
$forum_ek
$portal_ek
<url>
	<loc>".$TEMA_SITE_ANADIZIN.$phpkf_dosyalar['uyeler']."</loc>
	<lastmod>".phpKF_SiteHaritasi(2, $tarih)."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>
$cms_ek2
";




//  CMS İÇİN - BAŞI  //
if ($cms_kullan == 1)
{
	// Kategori bağlantıları veritabanından çekiliyor
	$vtsorgu = "SELECT id,adres,baslik FROM $tablo_kategoriler ORDER BY tip,sira,id";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while($kategori = $vt->fetch_assoc($vtsonuc))
	{
		$link = linkyap($phpkf_dosyalar['cms'].'?kip=kat&k='.$kategori['id'], $kategori['adres']);
		$kategori_tarih = phpKF_SiteHaritasi(2, $tarih);
		$icerik .= "<url>
		<loc>".$TEMA_SITE_ANADIZIN.$link."</loc>
		<lastmod>".$kategori_tarih."</lastmod>
		<changefreq>".$haftalik."</changefreq>
		<priority>0.7</priority>
	</url>
	";
	}



	// Yazı bağlantıları veritabanından çekiliyor
	$vtsorgu = "SELECT id,kategori,yayin_tarihi,degistirme_tarihi,adres FROM $tablo_yazilar WHERE yayin_tarihi < $tarih ORDER BY yayin_tarihi DESC";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($yazilar = $vt->fetch_assoc($vtsonuc))
	{
		// yazının ilk kategorisi bulunuyor
		$kat_id = explode(',', $yazilar['kategori']);
		$kat_id = $kat_id[1];
		$yazi_link = linkyap($phpkf_dosyalar['cms'].'?k='.$kat_id.'&y='.$yazilar['id'], $tum_kategoriler[$kat_id]['adres'], $yazilar['adres']);
		if($yazilar['degistirme_tarihi'] > $yazilar['yayin_tarihi'])
			$yazi_tarih = phpKF_SiteHaritasi(2, $yazilar['degistirme_tarihi']);
		else $yazi_tarih = phpKF_SiteHaritasi(2, $yazilar['yayin_tarihi']);

		$icerik .= "<url>
		<loc>".$TEMA_SITE_ANADIZIN.$yazi_link."</loc>
		<lastmod>".$yazi_tarih."</lastmod>
		<changefreq>".$aylik."</changefreq>
		<priority>0.7</priority>
	</url>
	";
	}
}
//  CMS İÇİN - SONU  //




//  FORUM İÇİN - BAŞI  //

if ($forum_kullan == 1)
{

if ( ($ayarlar['seo'] != 0) AND (!defined('PHPKF_SEO')) ) define('PHPKF_SEO',true);


// Forum bölüm bağlantıları veritabanından çekiliyor
$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar ORDER BY id";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

while($forum_satir = $vt->fetch_assoc($vtsonuc))
{
	$link = linkver('forum.php?f='.$forum_satir['id'], $forum_satir['forum_baslik']);

	$forum_tarih = phpKF_SiteHaritasi(2, $tarih); // Şu anki tarih
	$icerik .= "<url>
	<loc>".$protocol.'://'.$ayarlar['alanadi'].$forum_dizin.$link."</loc>
	<lastmod>".$forum_tarih."</lastmod>
	<changefreq>".$gunluk."</changefreq>
	<priority>1.0</priority>
</url>
";
}


// Konu bağlantıları veritabanından çekiliyor
$vtsorgu = "SELECT id,mesaj_baslik,son_mesaj_tarihi FROM $tablo_mesajlar ORDER BY son_mesaj_tarihi DESC";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

while($konu_satir = $vt->fetch_assoc($vtsonuc))
{
	$link = linkver('konu.php?k='.$konu_satir['id'], $konu_satir['mesaj_baslik']);

	$konu_tarih = phpKF_SiteHaritasi(2, $konu_satir['son_mesaj_tarihi']);
	$icerik .= "<url>
	<loc>".$protocol.'://'.$ayarlar['alanadi'].$forum_dizin.$link."</loc>
	<lastmod>".$konu_tarih."</lastmod>
	<changefreq>".$aylik."</changefreq>
	<priority>0.7</priority>
</url>
";
}

}
//  FORUM İÇİN - SONU  //








$icerik .= "</urlset>";
$dosya = "../sitemap.xml";
$dosyaac = fopen("$dosya", "w") or die("Sitemap Dosyası Açılamadı");
fwrite($dosyaac, $icerik);
fclose($dosyaac);



// Eğer sitemap oluşturulur oluşturulmaz Google'a gönderilmesi istenirse
if ($otomatik_ping == 1) sitemap_pingle();



header('Location: sitemap.php?kip=guncellendi');
exit();


//  SİTE HARİTASI OLUŞTURMA İŞLEMLERİ - SONU  //








//  SAYFA GÖSTERİMİ  //

else:


if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'guncellendi') )
{
	$tema_sayfa_icerik = '<center><br><br>
	<font color="green"><b>'.$ly['site_haritasi_guncellendi'].'</b></font><br><br>
	<a href="../sitemap.xml" target="_blank"><u>'.$ly['gormek_icin_tıklayın'].'</u></a>
	<br><br><br></center>';
}
else
{
	$tema_sayfa_icerik = $ly['site_haritasi_bilgi'].'<br><br><br><br>
<form name="ayarlar" action="sitemap.php" method="get">
<input type="hidden" name="kip" value="guncelle" />
<center><input type="submit" name="submit" value="'.$ly['site_haritasi_guncelle'].'" class="dugme dugme-mavi" /></center>
</form><br><br>';
}




// tema dosyası yükleniyor
$sayfa_adi = $ly['site_haritasi'];
$tema_sayfa_baslik = $ly['site_haritasi'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));


endif;

?>