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


// ayar.php yok ise uyarı ver.
if (!@is_file('../../ayar.php'))
{
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" Content="text/html; charset=utf-8">
<link href="../temalar/varsayilan/resimler/resimler/favicon.png" rel="icon" type="image/png" />
<link href="../temalar/varsayilan/css/sablon.css" rel="stylesheet" type="text/css" />
<title>phpKF-Portal KURULUM</title>
</head>
<body>
	<table cellpadding="0" cellspacing="0" width="100%" height="100%" bgcolor="#ffffff">
	<tr>
	<td align="center" valign="middle">
	<br>
	<table cellpadding="1" cellspacing="1" width="80%" height="80%" bgcolor="#dddddd">
	<tr>
	<td align="center" valign="middle" height="35px" colspan="2" style="background:url(../temalar/varsayilan/resimler/resimler/alt.gif); color:#000000; font-family:Verdana; font-size: 13px;">
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
	<div align="center"><img src="../resimler/degisen_resimler/4.png" alt="phpKF" title="phpKF"></div>
	</td>


	<td align="center" valign="middle" bgcolor="#ffffff" id="liste-veri">
	<b>phpKF-Portal</b>`ı kurabilmek için phpKF forumun kurulu olması gerekiyor. <br>phpKF Forumu indirip kurmak için alttaki butona tıklayarak güncel sürüme ulaşabilirsiniz.
	<br><br>
	Forumu daha önceden kurduysanız portalı aynı dizine atmamış olabilirsiniz.
	<br>Forum ve portalın aynı dizinde (klasörde) olması gerekir.
	<br><br><br><br>

	<a href="../../phpkf-kurulum/index.php">Kurulum Sayfasına Git</a>
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



define('DOSYA_PORTAL_AYARLAR',true);
include_once('../diller/tr/portal_dil.php');
if (!defined('DOSYA_AYAR')) include '../../ayar.php';
if (!defined('DOSYA_TEMA_SINIF')) include '../../phpkf-bilesenler/sinif_tema_forum.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../../phpkf-bilesenler/kullanici_kimlik.php';

$temadizini = 'varsayilan';
$ornek1 = new phpkf_tema();
$tema_dosyasi = 'temalar/varsayilan/kurulum.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


$version = "3.00";
$version_forum = "3.00";

function YazmaIzni($klasor)
{
	$sonuc2 = '<font color="red">'.$klasor.'</font> <br>';
	return $sonuc2;
}


$chmod_ayari = YazmaIzni('bloklar/');
$chmod_ayari .= YazmaIzni('sayfalar/');
$chmod_ayari .= YazmaIzni('galeri/');
$chmod_ayari .= YazmaIzni('dosyalar/');
$chmod_ayari .= YazmaIzni('yonetim_not.txt');

$ornek1->dongusuz(array(
'{CHMOD}' => $chmod_ayari,
'{PORTAL_INDEX}' => $phpkf_dosyalar['portal'],
'{PORTAL_SURUM}' => $version,
'{FORUM_SURUM}' => $version_forum));


// Eklenen Tablolar //
$tablo_portal_ayarlar = $tablo_oneki.'portal_ayarlar';
$tablo_portal_indir = $tablo_oneki.'portal_indir';
$tablo_portal_indirkategori = $tablo_oneki.'portal_indirkategori';
$tablo_portal_indiryorum = $tablo_oneki.'portal_indiryorum';
$tablo_portal_anketsoru = $tablo_oneki.'portal_anketsoru';
$tablo_portal_anketsecenek = $tablo_oneki.'portal_anketsecenek';
$tablo_portal_galeri = $tablo_oneki.'portal_galeri';
$tablo_portal_galeridal = $tablo_oneki.'portal_galeridal';
$tablo_portal_haberler = $tablo_oneki.'portal_haberler';
$tablo_portal_haberyorum = $tablo_oneki.'portal_haberyorum';
$tablo_portal_anketyorum = $tablo_oneki.'portal_anketyorum';
$tablo_portal_bloklar = $tablo_oneki.'portal_bloklar';
$tablo_portal_sayfa = $tablo_oneki.'portal_sayfa';
$tablo_portal_siteekle = $tablo_oneki.'portal_siteekle';
$tablo_portal_siteekledal = $tablo_oneki.'portal_siteekledal';
$tablo_portal_haberdal = $tablo_oneki.'portal_haberdal';

/*************************************************************/




if ($ayarlar['surum'] < $version_forum)
{
	$ornek1->kosul('1', array('' => ''), true);
	eval(TEMA_UYGULA);
	exit();
}
else
{
	$ornek1->kosul('1', array('' => ''), false);

	$strSQL = "SELECT sayi FROM $tablo_portal_ayarlar WHERE isim='portal_surum' LIMIT 1";
	$ayarlar_tablosu_sonuc = $vt->query($strSQL);
	$portal_ayarlar = @$vt->fetch_row($ayarlar_tablosu_sonuc);

	if ( (isset($portal_ayarlar)) AND ($portal_ayarlar[0] == $version) )
	{
		$ornek1->kosul('6', array('' => ''), false);
		$ornek1->kosul('5', array('' => ''), true);
	}
}


if ($kullanici_kim['id'] == 1)
{
	$ornek1->kosul('id1', array('' => ''), true);
	$ornek1->kosul('id2', array('' => ''), false);
	@$kosul=$_GET['kosul'];



	//  KURULUM - BAŞI  //
	if ($kosul == "kur")
	{
		$ornek1->kosul('3', array('' => ''), true);
		$strSQL = "SELECT * FROM $tablo_portal_ayarlar";

		if ($ayarlar_tablosu_sonuc = $vt->query($strSQL))
		{
			$ayarlar_tablosu_icerigi_varmi = $vt->num_rows($ayarlar_tablosu_sonuc);
		}
		else $ayarlar_tablosu_icerigi_varmi = 0;


		if ($ayarlar_tablosu_icerigi_varmi >= '25')
		{
			$ornek1->kosul('2', array('' => ''), true);
		}
		else
		{
			$ornek1->kosul('2', array('' => ''), false);
		}


		//  VERİTABANI YÜKLEME KISMI - BAŞI  //

		// veritabanı sql dosyası yükleniyor
		$tarih = time();
		$guncel_surum_portal = $version;
		$yonetici_adi = $kullanici_kim['kullanici_adi'];
		include_once('_veritabani_portal.php');
		$kurulum_sql = $veritabani_portal;


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


		$portal_portal_surum = "UPDATE `$tablo_ayarlar` SET deger='1' WHERE etiket='portal_kullan' LIMIT 1";
		$portal_portal_surum_sonuc = $vt->query($portal_portal_surum) or die ($vt->hata_ver());



		// EKRANA BİLGİ YAZDIRILIYOR //
		$ornek1->kosul('1', array('' => ''), false);
		$ornek1->kosul('3', array('' => ''), true);
		$ornek1->kosul('2', array('' => ''), false);
		$ornek1->kosul('4', array('' => ''), false);
		$ornek1->kosul('5', array('' => ''), false);
		$ornek1->kosul('6', array('' => ''), false);
		$ornek1->kosul('7', array('' => ''), false);
		$ornek1->kosul('8', array('' => ''), false);
		$ornek1->kosul('9', array('' => ''), false);
		$ornek1->kosul('10', array('' => ''), false);

		eval(TEMA_UYGULA);
		exit();
	}

	else
	{
		$ornek1->kosul('3', array('' => ''), false);
	}

	//  KURULUM - SONU  //






	###################################################################
	###################################################################
	###################################################################



	// GÜNCELLEME //

	if ($kosul == "guncelle")
	{
		$strSQL = "SELECT * FROM $tablo_portal_ayarlar";

		$portal_ayarlar_sonucu = $vt->query($strSQL);

		if (isset($portal_ayarlar_sonucu))
		{
		while ($ayar1 = $vt->fetch_array($portal_ayarlar_sonucu))
		{
		$isim = $ayar1['0'];
		$portal_ayarlar[$isim] = $ayar1['1'];
		}
		}


		include 'guncelle.php';


		// yazi renklendir özelliği siliniyor
		if (isset($portal_ayarlar['yazi_renklendir']))
		{
			@$portal_yazi_renklendir = "DELETE FROM $tablo_portal_ayarlar WHERE CONVERT($tablo_portal_ayarlar.isim USING utf8) = 'yazi_renklendir' LIMIT 1";
			@$portal_yazi_renklendir = $vt->query($portal_yazi_renklendir) or die ($vt->hata_ver());
		}

		// EKRANA BİLGİ YAZDIRILIYOR //
		
		eval(TEMA_UYGULA);
		exit();
	}


	// GÜNCELLEME //
	###################################################################
	###################################################################
	###################################################################



	else
	{
		$ornek1->kosul('4', array('' => ''), false);
		$ornek1->kosul('5', array('' => ''), false);
	}


	$strSQL = "SELECT * FROM $tablo_portal_ayarlar";

	if ($portal_ayarlar_sonucu = $vt->query($strSQL))
	{
		while ($ayar1 = $vt->fetch_array($portal_ayarlar_sonucu))
		{
		$isim = $ayar1['0'];
		$portal_ayarlar[$isim] = $ayar1['1'];
		}
	}

	if (isset($portal_ayarlar['portal_dili']))
	{
	$ornek1->kosul('6', array('' => ''), true);
	$ornek1->kosul('7', array('' => ''), false);


	$disabled ='';

	// SUNUCUDAKİ PHP SÜRÜMÜNE BAKILIYOR   //

	if (@phpversion())
	{
		$php_surum = @phpversion();

		if($php_surum < '4.0')
		{
			$ornek1->kosul('9', array('' => ''), true);
		}
		else
		{
			$ornek1->kosul('9', array('' => ''), false);
		}
	}
	else
	{
		$ornek1->kosul('9', array('' => ''), true);
	}


	// SUNUCUDAKİ MYSQL SÜRÜMÜNE BAKILIYOR   //

	if (@$vt->get_server_info())
	{
		$mysql_surum = @$vt->get_server_info();

		if($mysql_surum < '4.0')
		{
			$ornek1->kosul('8', array('' => ''), true);
			$ornek1->dongusuz(array('{MYSQL_SURUM}' => $mysql_surum));
		}
		else
		{
			$ornek1->kosul('8', array('' => ''), false);
		}
	}
	else
	{
		$ornek1->kosul('8', array('' => ''), true);
	}



	// SUNUCUNUN register_globals AYARINA BAKILIYOR //
	if(  @ini_get('register_globals') )
	{
		$ornek1->kosul('10', array('' => ''), true);
		$disabled .= 'disabled="disabled"';
	}
	else
	{
		$ornek1->kosul('10', array('' => ''), false);
	}
	$ornek1->dongusuz(array('{KILIT2}' => $disabled));



	$strSQL = "SELECT * FROM $tablo_portal_ayarlar";
	$portal_ayarlar_sonucu = $vt->query($strSQL);

	while (@$ayar1 = $vt->fetch_array($portal_ayarlar_sonucu))
	{
		$isim = $ayar1['0'];
		$portal_ayarlar[$isim] = $ayar1['1'];
	}

	if (isset($portal_ayarlar['portal_surum']))
	{
		$ornek1->kosul('11', array('' => ''), true);
		$ornek1->kosul('12', array('' => ''), false);
		$ornek1->dongusuz(array('{PORTAL_SURUM2}' => $portal_ayarlar['portal_surum']));
	}
	elseif (isset($portal_ayarlar['sitemaps']))
	{
		$ornek1->kosul('12', array('' => ''), true);
		$ornek1->kosul('11', array('' => ''), false);
	}

	}


	else
	{
	$ornek1->kosul('7', array('' => ''), true);
	$ornek1->kosul('6', array('' => ''), false);


	$disabled ='';

	// SUNUCUDAKİ PHP SÜRÜMÜNE BAKILIYOR   //

	if (@phpversion())
	{
	$php_surum = @phpversion();
	
				if($php_surum < '4.0')
				{	
				$ornek1->kosul('13', array('' => ''), true);
				}
				else
				{
				$ornek1->kosul('13', array('' => ''), false);	
				}
	}
	else 
		{
			$ornek1->kosul('13', array('' => ''), true);
		}


	// SUNUCUDAKİ MYSQL SÜRÜMÜNE BAKILIYOR   //

	if (@$vt->get_server_info())
	{
	$mysql_surum = @$vt->get_server_info();

				if($mysql_surum < '4.0')
				{	
				$ornek1->kosul('14', array('' => ''), true);
				$ornek1->dongusuz(array('{MYSQL_SURUM}' => $mysql_surum));
				}
				else
				{
				$ornek1->kosul('14', array('' => ''), false);
				}
		
	}
	else 
	{
	$ornek1->kosul('14', array('' => ''), true);
	} 
	

	// SUNUCUNUN register_globals AYARINA BAKILIYOR //

	if(  @ini_get('register_globals') )
	{
		$ornek1->kosul('15', array('' => ''), true);
		$disabled .= 'disabled="disabled"';
	}
	else
	{
		$ornek1->kosul('15', array('' => ''), false);
	}
	$ornek1->dongusuz(array('{KILIT}' => $disabled));

	}

}




else
{
	$ornek1->kosul('id2', array('' => ''), true);
	$ornek1->kosul('id1', array('' => ''), false);
}

eval(TEMA_UYGULA);
?>