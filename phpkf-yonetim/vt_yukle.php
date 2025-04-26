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
if (!defined('DOSYA_AYAR')) include '../phpkf-ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


if ($kullanici_kim['id'] != 1)
{
	header('Location: hatalar.php?hata=151');
	exit();
}



		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - BAŞI	//


//	DOSYA YÜKLEMEDE HATA OLURSA - DOSYA 2`MB. DAN BÜYÜKSE	//

if ( (isset($_FILES['vtyukle']['error'])) AND ($_FILES['vtyukle']['error'] != 0) )
{
	header('Location: hatalar.php?hata=156');
	exit();
}


if ( (isset($_FILES['vtyukle']['tmp_name'])) AND ($_FILES['vtyukle']['tmp_name'] != '') ):


// yönetim oturum kodu
if (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';


// yönetim oturum kodu kontrol ediliyor
if ($gyo != $yo)
{
	header('Location: hatalar.php?hata=45');
	exit();
}


//	DOSYA 2`MB. DAN BÜYÜKSE	//

if ($_FILES['vtyukle']['size'] > 5242880):
	header('Location: hatalar.php?hata=157');
	exit();
endif;


$uzanti = explode(".", strtolower($_FILES['vtyukle']['name']));
$uzanti = end($uzanti);


//	DOSYA SIKIŞTIRILMIŞ MI BAKILIYOR	//

if ($uzanti == 'gz'):

	if(extension_loaded('zlib'))
	{
		$gzipdosya01 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
		$gzipac01 = gzread($gzipdosya01, 9921920);
		gzclose($gzipdosya01);

		//	çift sıkıştırılımış olma olasılığına karşı tekrar açılıyor
		$yeni_gzipdosya = fopen($_FILES['vtyukle']['tmp_name'], 'w') or die ("Dosya açılamıyor!");
		fwrite($yeni_gzipdosya, $gzipac01);
		fclose($yeni_gzipdosya);

		$gzipdosya02 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
		$gzipac02 = gzread($gzipdosya02, 9921920);
		gzclose($gzipdosya02);

		$ac = $gzipac02;
	}

	else
	{
		header('Location: hatalar.php?hata=158');
		exit();
	}



//	DOSYA .SQL UZANTILI DEĞİLSE	//

elseif ($uzanti != 'sql'):

	header('Location: hatalar.php?hata=159');
	exit();


//	TEMP'TEKİ DOSYANIN İÇİNDEKİLER DEĞİŞKENE AKTARILIYOR	//

else:
$dosya = @fopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
$boyut = @filesize($_FILES['vtyukle']['tmp_name']);
$ac = @fread( $dosya, $boyut );
endif;





// dosyadaki veriler satır satır dizi değişkene aktarılıyor //
$toplam = explode(";\n\n", $ac);

// satır sayısı alınıyor //
$toplam_sayi = count($toplam);

// dizideki satırlar döngüye sokuluyor //
for ($satir=0;$satir<$toplam_sayi;$satir++)
{
	// 9 karakterden kısa dizi elemanları diziden atılıyor	//
	if (strlen($toplam[$satir]) > 9)
	{
		// yorumlar diziden atılıyor //
		if (preg_match("/\n\n--/", $toplam[$satir]))
		{
			$yorum = explode("\n\n", $toplam[$satir]);
			$yorum_sayi = count($yorum);

			for ($satir2=0;$satir2<$yorum_sayi;$satir2++)
			{
				if ( (strlen($yorum[$satir2]) > 9) AND (!preg_match("/--/", $yorum[$satir2])) )
				// sorgu veritabanına giriliyor //
				$vtsonuc = $vt->query($yorum[$satir2]) or die($vt->hata_ver());
			}
		}

		else // sorgu veritabanına giziliyor //
		$vtsonuc = $vt->query($toplam[$satir]) or die($vt->hata_ver());
	}
}


//	VERİTABANI YEDEĞİ YÜKLENDİ MESAJI	//


setcookie('kullanici_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);
setcookie('yonetim_kimlik', '', 0, $cerez_dizin, $cerez_alanadi);

header('Location: hatalar.php?bilgi=14');
exit();



		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - SONU	//


		//	GİRİŞ SAYFASI KISMI - BAŞI	//

else:


$tema_sayfa_icerik = $ly['vt_geri_yukle_bilgi'].'<br><br><br>
<center>
<form name="vtyukleme" action="vt_yukle.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="yo" value="'.$yo.'" />
<input type="hidden" name="MAX_FILE_SIZE" value="2621440" />
<input class="input-text" name="vtyukle" type="file" size="30" />
<br>
<br>
<br>
<input class="dugme dugme-mavi" type="submit" value="'.$ly['geri_yukle'].'" />
</form>
</center>
<br>';




// tema dosyası yükleniyor
$sayfa_adi = $ly['veritabani_geri_yukle'];
$tema_sayfa_baslik = $ly['veritabani_geri_yukle'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));


endif;
?>