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


if (!defined('PHPKF_ICINDEN')) define('PHPKF_ICINDEN', true);
if (!defined('DOSYA_DIL')) include_once('diller/index.php');
header("Content-type: text/html; charset=utf-8");
@ini_set('magic_quotes_runtime', 0);
$guncel_surum = '3.00';



//  AYAR DOSYASINI İNDİR TIKLANDIĞINDA ÇALIŞACAK KISIM  //

if ( (isset($_POST['kurulum_yapildi'])) AND ($_POST['kurulum_yapildi'] == 'ayar_dosyasi') AND (isset($_POST['ayar_bilgi'])) )
{
	header('Content-Type: text/x-delimtext; name="phpkf-ayar.php"');
	header('Content-disposition: attachment; filename=phpkf-ayar.php');

	// magic_quotes_gpc açıksa
	if (get_magic_quotes_gpc()) echo stripslashes($_POST['ayar_bilgi']);

	// magic_quotes_gpc kapalıysa
	else echo $_POST['ayar_bilgi'];

	exit();
}


elseif ( (isset($_POST['kurulum_yapildi'])) AND ($_POST['kurulum_yapildi'] == 'htaccess_dosyasi') AND (isset($_POST['htaccess_bilgi'])) )
{
	header('Content-Type: text/x-delimtext; name=".htaccess.txt"');
	header('Content-disposition: attachment; filename=".htaccess.txt"');

	// magic_quotes_gpc açıksa
	if (get_magic_quotes_gpc()) echo stripslashes($_POST['htaccess_bilgi']);

	// magic_quotes_gpc kapalıysa
	else echo $_POST['htaccess_bilgi'];

	exit();
}


// phpkf-ayar.php varsa
if (@is_file('../phpkf-ayar.php'))
{
	$bitti_ayar = true;
	echo $vt_hata_tablo[0].$lk[118].$vt_hata_tablo[1].'<center>'.$lk[119].'<br><br>'.$lk[120].'</center>'.$vt_hata_tablo[2];
	exit();
}
else $bitti_ayar = false;




//  FORM BİLGİLERİ KONTROL EDİLİYOR - BAŞI  //

if ( (empty($_POST['kurulum'])) OR ($_POST['kurulum'] == '') ) exit();

if ( (empty($_POST['kurulum'])) OR ($_POST['kurulum'] != 'form_dolu') OR (empty($_POST['alanadi'])) OR (empty($_POST['dizin'])) OR (empty($_POST['vt_sunucu'])) OR (empty($_POST['vt_adi'])) OR (empty($_POST['tablo_oneki'])) OR (empty($_POST['yonetici_adi'])) OR (empty($_POST['yonetici_sifre'])) )
{
	echo $vt_hata_tablo[0].$lk[91].$vt_hata_tablo[1].$lk[92].$vt_hata_tablo[2];
	exit();
}

if (!isset($_POST['telif_kabul']))
{
	echo $vt_hata_tablo[0].$lk[91].$vt_hata_tablo[1].$lk[121].$vt_hata_tablo[2];
	exit();
}

if (!preg_match('/^[a-zA-Z]\w{0,10}+$/', $_POST['tablo_oneki']))
{
	echo $vt_hata_tablo[0].$lk[91].$vt_hata_tablo[1].$lk[93].$vt_hata_tablo[2];
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_ğĞüÜŞşİıÖöÇç.]+$/', $_POST['yonetici_adi']))
{
	echo $vt_hata_tablo[0].$lk[91].$vt_hata_tablo[1].$lk[122].$vt_hata_tablo[2];
	exit();
}

if ((strlen($_POST['yonetici_adi']) > 20) or (strlen($_POST['yonetici_adi']) < 4))
{
	echo $vt_hata_tablo[0].$lk[91].$vt_hata_tablo[1].$lk[123].$vt_hata_tablo[2];
	exit();
}

if (!preg_match('/^[A-Za-z0-9-_.&]+$/', $_POST['yonetici_sifre']))
{
	echo $vt_hata_tablo[0].$lk[91].$vt_hata_tablo[1].$lk[124].$vt_hata_tablo[2];
	exit();
}

if ((strlen($_POST['yonetici_sifre']) > 20) or (strlen($_POST['yonetici_sifre']) < 5))
{
	echo $vt_hata_tablo[0].$lk[91].$vt_hata_tablo[1].$lk[125].$vt_hata_tablo[2];
	exit();
}

//  FORM BİLGİLERİ KONTROL EDİLİYOR - SONU  //


//  veritabanına girilen veriler temizleniyor

function zkTemizle($metin)
{
	$donen = urldecode($metin);
	$donen = str_replace('>','',$donen);
	$donen = str_replace('<','',$donen);
	$donen = str_replace("'",'',$donen);
	$donen = str_replace('\\','',$donen);
	$donen = str_replace('"','',$donen);
	return $donen;
}


// form değişkenlere aktarılıyor
$vt_sunucu = zkTemizle($_POST['vt_sunucu']);
$vt_adi = zkTemizle($_POST['vt_adi']);
$vt_kullanici = zkTemizle($_POST['vt_kullanici']);
$vt_sifre = zkTemizle($_POST['vt_sifre']);
$vtsecim = zkTemizle($_POST['vt_tip']);
$tablo_oneki = zkTemizle($_POST['tablo_oneki']);
$yonetici_sifre = zkTemizle($_POST['yonetici_sifre']);
$alanadi = zkTemizle($_POST['alanadi']);
$site_dizin = zkTemizle($_POST['dizin']);
$yonetici_adi = zkTemizle($_POST['yonetici_adi']);




// Ortak tablo adları tanımlanıyor
$tablo_ayarlar = $tablo_oneki.'ortak_ayarlar';
$tablo_baglantilar = $tablo_oneki.'ortak_baglantilar';
$tablo_bildirimler = $tablo_oneki.'ortak_bildirimler';
$tablo_eklentiler = $tablo_oneki.'ortak_eklentiler';
$tablo_kullanicilar = $tablo_oneki.'ortak_kullanicilar';
$tablo_oturumlar = $tablo_oneki.'ortak_oturumlar';
$tablo_yasaklar = $tablo_oneki.'ortak_yasaklar';

// CMS tablo adları tanımlanıyor
$tablo_bloklar = $tablo_oneki.'cms_bloklar';
$tablo_iletisim = $tablo_oneki.'cms_iletisim';
$tablo_kategoriler = $tablo_oneki.'cms_kategoriler';
$tablo_sablonlar = $tablo_oneki.'cms_sablonlar';
$tablo_yazilar = $tablo_oneki.'cms_yazilar';
$tablo_yorumlar = $tablo_oneki.'cms_yorumlar';

// Forum tablo adları tanımlanıyor
$tablo_cevaplar = $tablo_oneki.'forum_cevaplar';
$tablo_dallar = $tablo_oneki.'forum_dallar';
$tablo_duyurular = $tablo_oneki.'forum_duyurular';
$tablo_forumlar = $tablo_oneki.'forum_forumlar';
$tablo_gruplar = $tablo_oneki.'forum_gruplar';
$tablo_mesajlar = $tablo_oneki.'forum_mesajlar';
$tablo_ozel_ileti = $tablo_oneki.'forum_ozel_ileti';
$tablo_ozel_izinler = $tablo_oneki.'forum_ozel_izinler';
$tablo_pyorumlar = $tablo_oneki.'forum_pyorumlar';
$tablo_yuklemeler = $tablo_oneki.'forum_yuklemeler';

// Portal tablo adları tanımlanıyor
$tablo_portal_ayarlar = $tablo_oneki.'portal_ayarlar';
$tablo_portal_anketsecenek = $tablo_oneki.'portal_anketsecenek';
$tablo_portal_anketsoru = $tablo_oneki.'portal_anketsoru';
$tablo_portal_anketyorum = $tablo_oneki.'portal_anketyorum';
$tablo_portal_bloklar = $tablo_oneki.'portal_bloklar';
$tablo_portal_galeri = $tablo_oneki.'portal_galeri';
$tablo_portal_galeridal = $tablo_oneki.'portal_galeridal';
$tablo_portal_haberdal = $tablo_oneki.'portal_haberdal';
$tablo_portal_haberler = $tablo_oneki.'portal_haberler';
$tablo_portal_haberyorum = $tablo_oneki.'portal_haberyorum';
$tablo_portal_indir = $tablo_oneki.'portal_indir';
$tablo_portal_indirkategori = $tablo_oneki.'portal_indirkategori';
$tablo_portal_indiryorum = $tablo_oneki.'portal_indiryorum';
$tablo_portal_sayfa = $tablo_oneki.'portal_sayfa';
$tablo_portal_siteekle = $tablo_oneki.'portal_siteekle';
$tablo_portal_siteekledal = $tablo_oneki.'portal_siteekledal';




// şifrelerinin karıştırılacağı anahtar üretiliyor
// şifre anahtar ile karıştırılarak sha1 ile şifreleniyor
$tarih = time();
$anahtar = md5(microtime());
$sifre = sha1($anahtar.$yonetici_sifre);



// Alanadından site ve yönetici e-posta adresi üretiliyor
$alanadi = str_replace(array('http://', 'https://', 'ftp://'), array(''), $alanadi);
$adres_dizi = explode('.', $alanadi);

$site_posta = 'admin@';
$ilk = true;

foreach ($adres_dizi as $adres)
{
	if ($ilk)
	{
		if ($adres != 'www') $site_posta .= $adres.'.';
		$ilk = false;
	}
	else $site_posta .= $adres.'.';
}

$site_posta = substr($site_posta, 0, -1);



// Neden phpKF resmi
if ($site_dizin == '/') $neden_phpkf = '//'.$alanadi.'/phpkf-dosyalar/yuklemeler/phpkf.png';
else $neden_phpkf = '//'.$alanadi.$site_dizin.'/phpkf-dosyalar/yuklemeler/phpkf.png';




//  VERİTABANI YÜKLEME KISMI - BAŞI  //

if (!defined('PHPKF_ICINDEN')) define('PHPKF_ICINDEN', true);

// Veritabanı sınıf dosyası yükleniyor
if(!@include_once('../phpkf-bilesenler/veritabani/'.$vtsecim.'.php'))
{
	echo $vt_hata_tablo[0].$lk[94].$vt_hata_tablo[1].'/phpkf-bilesenler/veritabani/'.$vtsecim.'.php '.$lk[95].'<br><br>'.$lk[96].$vt_hata_tablo[2];
	exit();
}


// Veritabanı ile bağlantı kuruluyor
$vt = new sinif_vt();
$vt->baglan($vt_sunucu, $vt_kullanici, $vt_sifre);

// veritabanı seçiliyor
if ($vt->hata_cikti == '') $veri_tabani = $vt->sec($vt_adi);
else $veri_tabani = false;


// Hata iletileri
if ( (!$vt) OR (!$veri_tabani) )
{
	if ( (preg_match("|Can\'t connect to MySQL server|si", $vt->hata_cikti))
		OR (preg_match("|Unknown MySQL server|si", $vt->hata_cikti))
		OR (preg_match("|php_network_getaddresses|si", $vt->hata_cikti)) )
		echo @$vt_hata_tablo[0].@$lk[197].@$vt_hata_tablo[1].@$lk[98].'<br><br>
		<b>'.$lk[99].': </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	elseif (preg_match("|Access denied for user|si", $vt->hata_cikti))
		echo $vt_hata_tablo[0].$lk[100].$vt_hata_tablo[1].$lk[101].'<br><br>
	<b>'.$lk[99].': </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	elseif (preg_match("|Unknown database|si", $vt->hata_cikti))
		echo $vt_hata_tablo[0].$lk[102].$vt_hata_tablo[1].$lk[103].'<br><br>
	<b>'.$lk[99].': </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	else echo $vt_hata_tablo[0].$lk[104].$vt_hata_tablo[1].$lk[105].'<br><br>
	<b>'.$lk[99].': </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	die();
}







// Yazılım seçimi - Başı //

$site_index = 1;
$cms_kullan = 0;
$forum_kullan = 0;
$portal_kullan = 0;

if ((isset($_POST['yazilim'])) AND (is_array($_POST['yazilim'])) )
{
	foreach($_POST['yazilim'] as $yazilim)
	{
		if ($yazilim == 'cms') $cms_kullan = 1;
		elseif ($yazilim == 'forum') $forum_kullan = 1;
		elseif ($yazilim == 'portal') $portal_kullan = 1;
	}
	if ( (isset($_POST['yazilim'][0])) AND ($_POST['yazilim'][0] == 'cms') ) $cms_kullan = 1;
	if ( (isset($_POST['yazilim'][1])) AND ($_POST['yazilim'][1] == 'forum') ) $forum_kullan = 1;
	if ( (isset($_POST['yazilim'][2])) AND ($_POST['yazilim'][2] == 'portal') ) $portal_kullan = 1;
}
if (($cms_kullan == 0) AND ($portal_kullan == 0) AND ($forum_kullan == 0))
{
	$cms_kullan = true;
	$forum_kullan = true;
}
elseif (($portal_kullan == 1) AND ($forum_kullan == 0)) $forum_kullan = true;
if ($cms_kullan == 0) $site_index = 2;

// Yazılım seçimi - Sonu //




// kurulum sql dosyası yükleniyor
$kurulum_sql = '';

include_once('_veritabani_ortak.php');
$kurulum_sql .= $veritabani_ortak;

if ($cms_kullan == 1)
{
	include_once('_veritabani_cms.php');
	$kurulum_sql .= $veritabani_cms;
}
if ($forum_kullan == 1)
{
	include_once('_veritabani_forum.php');
	$kurulum_sql .= $veritabani_forum;
}
if ($portal_kullan == 1)
{
	include_once('_veritabani_portal.php');
	$kurulum_sql .= $veritabani_portal;
}



$toplam = explode(";\n\n", $kurulum_sql); // sorgular satır satır ayrılıyor
$toplam_sayi = count($toplam); // satır sayısı

// sorgular döngüye sokuluyor
for ($satir=0;$satir<$toplam_sayi;$satir++)
{
	// 9 karakterden kısa dizi elemanları diziden atılıyor
	if (strlen($toplam[$satir]) > 9)
	{
		// yorumlar diziden atılıyor
		if (preg_match("/\n\n--/", $toplam[$satir]))
		{
			$yorum = explode("\n\n", $toplam[$satir]);
			$yorum_sayi = count($yorum);

			for ($satir2=0;$satir2<$yorum_sayi;$satir2++)
			{
				if ( (strlen($yorum[$satir2]) > 9) AND (!preg_match("/--/", $yorum[$satir2])) )
				// sorgu veritabanına giriliyor
				$vtsonuc = $vt->query($yorum[$satir2]) or die ($vt->hata_ver());
			}
		}

		// sorgu veritabanına giriliyor
		else $vtsonuc = $vt->query($toplam[$satir]) or die ($vt->hata_ver());
	}
}

//  VERİTABANI YÜKLEME KISMI - SONU  //






// Dosya Oluşturma Fonksiyonu
function DosyaOlustur($d, $i, $c)
{
	$s = false;
	if ($c == true)
	{
		$bul = array('&gt;', '&lt;', '&quot;');
		$cevir = array('>', '<', '"');
		$i = @str_replace($bul, $cevir, $i);
	}
	if (@touch($d))
	{
		if (@is_writable($d))
		{
			$b = @fopen($d, 'w');
			@flock($b, 2);
			@fwrite($b, $i);
			@flock($b, 3);
			@fclose($b);
			$s = true;
		}
	}
	return $s;
}



include_once('_htaccess.php'); // .htaccess dosya içeriği
include_once('_ayar.php'); // ayar dosya içeriği



// dosya adları
$dosyaadi_htaccess = '../.htaccess';
$dosyaadi_ayar = '../phpkf-ayar.php';



// phpkf-ayar.php dosyası oluşturuluyor
if (!$bitti_ayar) $bitti_ayar = DosyaOlustur($dosyaadi_ayar, $dosya_ayar, true);


// .htaccess dosyası kontrol ve oluşturma
if (@is_file($dosyaadi_htaccess))
{
	$bitti_htacces_var = true;
	$bitti_htacces = true;
}
else
{
	$bitti_htacces_var = false;
	$bitti_htacces = DosyaOlustur($dosyaadi_htaccess, $dosya_htaccess, false);
}







// KURULUM TAMAMLANDI - yazma hakkı yok

$kurulum_tamam1 = '<!DOCTYPE html>
<html lang="'.$site_dili.'" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../phpkf-bilesenler/temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<title>'.$lk[126].'</title>
</head>
<body>

<br><br><br><table border="0" cellspacing="1" cellpadding="10" width="580" bgcolor="#999999" align="center">
<tr><td bgcolor="#eeeeee" align="center"><font color="#333333" size="5"><b>
'.$lk[126].'
</b></font></td></tr>
<tr><td bgcolor="#fafafa">

<font face="arial" size="3">
'.$lk[127].'
<p><font color="ff0000">'.$lk[128].'</font>
<br><br>
'.$lk[129].'<p>'.$lk[136].'
<br><br>
</font>

<form action="kurulum.php" method="post" name="kurulum_formu2">
<input type="hidden" name="kurulum_yapildi" value="ayar_dosyasi">
<input type="hidden" name="ayar_bilgi" value="'.$dosya_ayar.'">
<center><input class="dugme" type="submit" value="'.$lk[130].'"><br><br></center>
</form>

<form action="kurulum.php" method="post" name="kurulum_formu2">
<input type="hidden" name="kurulum_yapildi" value="htaccess_dosyasi">
<input type="hidden" name="htaccess_bilgi" value="'.$dosya_htaccess.'">
<center><input class="dugme" type="submit" value="'.$lk[131].'">
<br><br><a href="../index.php">'.$lk[132].'</a></center>
</form>

<br>
</td></tr></table>
</body>
</html>';





// KURULUM TAMAMLANDI İLETİSİ - htaccess var

$kurulum_tamam3 = '<!DOCTYPE html>
<html lang="'.$site_dili.'" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../phpkf-bilesenler/temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<title>'.$lk[126].'</title>
</head>
<body>

<br><br><br><table border="0" cellspacing="1" cellpadding="10" width="580" bgcolor="#999999" align="center">
<tr><td bgcolor="#eeeeee" align="center"><font color="#333333" size="5"><b>
'.$lk[126].'
</b></font></td></tr>
<tr><td bgcolor="#fafafa">

<font face="arial" size="3">
'.$lk[127].'
<p><font color="ff0000">'.$lk[133].'</font>
<br><br>
'.$lk[134].'<p>'.$lk[136].'
<br><br><br>
</font>

<form action="kurulum.php" method="post" name="kurulum_formu2">
<input type="hidden" name="kurulum_yapildi" value="htaccess_dosyasi">
<input type="hidden" name="htaccess_bilgi" value="'.$dosya_htaccess.'">
<center><input class="dugme" type="submit" value="'.$lk[131].'">
<br><br>
<a href="../index.php">'.$lk[132].'</a>
</center>
</form>

<br>
</td></tr></table>
</body>
</html>';





// KURULUM TAMAMLANDI İLETİSİ - sorun yok

$kurulum_tamam2 = '<!DOCTYPE html>
<html lang="'.$site_dili.'" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../phpkf-bilesenler/temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<title>'.$lk[126].'</title>
</head>
<body>
<br><br><br><table border="0" cellspacing="1" cellpadding="10" width="580" bgcolor="#999999" align="center">
<tr><td bgcolor="#eeeeee" align="center"><font color="#333333" size="5"><b>
'.$lk[126].'
</b></font></td></tr>
<tr><td bgcolor="#fafafa">

<font face="arial" size="3">
<br>'.$lk[127].'
<p><b style="color:#008000">'.$lk[135].'</b>
<br><br>
'.$lk[136].'
<br><br>
</font>

<center><br><a href="../index.php">'.$lk[132].'</a></center>

<br>
</td></tr></table>
</body>
</html>';



// Tüm dosyalar sorunsuz yazıldı ise
if ( ($bitti_htacces) AND ($bitti_ayar) )
{
	if ($bitti_htacces_var) echo $kurulum_tamam3;
	else echo $kurulum_tamam2;
}

// Yazma hakkı yoksa
else echo $kurulum_tamam1;

?>