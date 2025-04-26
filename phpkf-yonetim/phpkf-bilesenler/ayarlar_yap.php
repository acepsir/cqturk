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


if (!defined('DOSYA_AYAR')) include_once('../../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('../../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('guvenlik.php');


// yönetim oturum kodu
if (isset($_POST['yo'])) $gyo = zkTemizle($_POST['yo']);
else $gyo = '';


// yönetim oturum kodu kontrol ediliyor
if ($gyo != $yo)
{
	header('Location: ../hatalar.php?hata=45');
	exit();
}



if (isset($_POST['kip']) AND ($_POST['kip'] != '') ) $kip = $_POST['kip'];
else $kip = '';



if (isset($_POST['dolu']) AND ($_POST['dolu'] == 'dolu') )
{
	if ($kip == 'genel')			$sorgu_kosul = "kat='1' OR kat='2' OR kat='3'";
	elseif ($kip == 'entegrasyon')	$sorgu_kosul = "kat='19'";
	elseif ($kip == 'forum')		$sorgu_kosul = "kat='16'";
	elseif ($kip == 'seo')			$sorgu_kosul = "kat='4'";
	elseif ($kip == 'tarih')		$sorgu_kosul = "kat='5'";
	elseif ($kip == 'uyelik')		$sorgu_kosul = "kat='6' OR kat='7' OR kat='8' OR kat='17'";
	elseif ($kip == 'eposta')		$sorgu_kosul = "kat='9' OR kat='10'";
	elseif ($kip == 'duzenleyici')	$sorgu_kosul = "kat='11'";
	elseif ($kip == 'tinymce')		$sorgu_kosul = "kat='12'";
	elseif ($kip == 'phpkf')		$sorgu_kosul = "kat='15'";
	elseif ($kip == 'yukleme')		$sorgu_kosul = "kat='14'";
	elseif ($kip == 'ozel_ileti')	$sorgu_kosul = "kat='18'";
	elseif ($kip == 'eklenti')		$sorgu_kosul = "tip='eklenti'";
	elseif ($kip == 'tema')		$sorgu_kosul = "tip='tema'";


	// hatalı kip //
	else
	{
		header('Location: ../hatalar.php?hata=18');
		exit();
	}



	// ayar kategorisindaki ayarlar veritabanından çekiliyor
	$vtsorgu = "SELECT etiket,deger,secenek_tip,varsayilan,bos FROM $tablo_ayarlar WHERE $sorgu_kosul ORDER BY sira";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	while ($ayar_tek = $vt->fetch_assoc($vtsonuc))
	{
		if (isset($_POST[$ayar_tek['etiket']]))
		{
			if ($ayar_tek['bos'] == '0')
			{
				// Zorunlu alan boş ise uyarı ver
				if (BoslukSil($_POST[$ayar_tek['etiket']]) == '')
				{
					header('Location: ../hatalar.php?hata=73');
					exit();
				}
			}


			// alan seçenek tipi numeric ise
			if ($ayar_tek['secenek_tip'] == 'numeric')
			{
				$deger = BoslukSil($_POST[$ayar_tek['etiket']]);
				if (is_numeric($deger))
				{
					if ($ayar_tek['etiket'] == 'uye_cevrimici_sure') $deger = ($deger * 60);
					elseif ($ayar_tek['etiket'] == 'uye_kilit_sure') $deger = ($deger * 60);
					elseif ($ayar_tek['etiket'] == 'k_cerez_zaman') $deger = ($deger * 60);
					elseif ($ayar_tek['etiket'] == 'uye_resim_boyut') $deger = ($deger * 1024);
					elseif ($ayar_tek['etiket'] == 'yukleme_boyut') $deger = ($deger * 1024);
					elseif ($ayar_tek['etiket'] == 'altforum_sira'){if ($deger == 0) $deger = 1;}
				}
				else $deger = $ayar_tek['varsayilan'];
			}


			// alan seçenek tipi html ise
			elseif ($ayar_tek['secenek_tip'] == 'html')
			{
				// magic_quotes_gpc açıksa
				if (get_magic_quotes_gpc()) $deger = stripslashes($_POST[$ayar_tek['etiket']]);
				else $deger = $_POST[$ayar_tek['etiket']];
				$deger = ileti_yolla($deger, 4);
			}


			// alan seçenek tipi text ise
			else
			{
				$deger = BoslukSil(zkTemizle($_POST[$ayar_tek['etiket']]));

				if ($ayar_tek['etiket'] == 'alanadi')
				{
					$bul = array('http://', 'https://', 'ftp://', '/');
					$deger = str_replace($bul, '', $deger);
				}

				elseif (($ayar_tek['etiket'] == 'dizin') OR ($ayar_tek['etiket'] == 'f_dizin'))
				{
					if ($deger != '/')
					{
						if (!@preg_match('/^\//', $deger)) $deger = '/'.$deger;
						if (@preg_match('/\/$/', $deger)) $deger = substr($deger, 0, -1);
					}
				}

				elseif (($ayar_tek['etiket'] == 'yukleme_dizin') OR ($ayar_tek['etiket'] == 'yukleme_dizin_uye'))
				{
					$deger = @str_replace('.', '', $deger);
					if ($deger != '')
					{
						if (@preg_match('/^\//', $deger)) $deger = substr($deger, 1);
						if (@preg_match('/\/$/', $deger)) $deger = substr($deger, 0, -1);
					}
				}

				elseif ($ayar_tek['etiket'] == 'smtp_sifre')
				{
					if ($deger == 'sifre_degismedi') $deger = $ayar_tek['deger'];
				}
			}


			// ayar veritabanına giriliyor
			$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$deger' WHERE etiket='$ayar_tek[etiket]' LIMIT 1";
			$vtsonuc2 = $vt->query($vtsorgu) or die($vt->hata_ver());
		}
	}




	// Ayarlar kaydedildi bilgi iletisi
	header('Location: ../hatalar.php?bilgi=1&git='.$kip);
	exit();
}



else
{
	header('Location: ../hatalar.php?hata=1');
	exit();
}

?>