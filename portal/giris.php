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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
if (!defined('DOSYA_AYAR')) include '../ayar.php';
if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
if (!defined('DOSYA_SEC')) include 'sec.php';
if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
if (!defined('DOSYA_HATA')) include 'hata.php';


// ziyaretçi ip adresi alınıyor
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
else $ip = $_SERVER['REMOTE_ADDR'];
$ip = zkTemizle4($ip);
$ip = zkTemizle($ip);


	if ((isset($kullanici_kim['id'])) AND ($kullanici_kim['yetki'] !='1') AND (!isset($_GET['dosya'])))
	{
		header('Location: ../profil.php');
		exit();
	}



	if (isset($_GET['dosya']))
	{
		$_GET['dosya'] = zkTemizle($_GET['dosya']);
		if (preg_match('/(https\:\/)/', $_GET['dosya'])) $_GET['dosya'] = $phpkf_dosyalar['portal'];
		elseif (preg_match('/(http\:\/)/', $_GET['dosya'])) $_GET['dosya'] = $phpkf_dosyalar['portal'];
		elseif (preg_match('/(ftp\:\/)/', $_GET['dosya'])) $_GET['dosya'] = $phpkf_dosyalar['portal'];
		else  $_GET['dosya'] = @zkTemizle($_GET['dosya']);


		$sayfa_adi = $l['giris'];
		if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
		if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';


		if (@is_file('ayar.php')) $giris_dizin ='';
		else $giris_dizin ='../';

		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $kp_dil_517,
		'{ADRES}' => $giris_dizin.$_GET['dosya'],
		'{ILETI}' => $kp_dil_48.'<font color="red"><br><br>'.$kullanici_kim['kullanici_adi'].'</font>',
		'{EK_YAZI}' => '<meta target="_top" http-equiv="Refresh" content="3; url='.$giris_dizin.$_GET['dosya'].'">
		<br><br><img src="temalar/varsayilan/resimler/resimler/indiriliyor2.gif" alt="Gir"><br><br>',
		'{YONLENDIRME}' => $ileti__1,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
	}


	elseif (isset($_GET['git']) AND ($_GET['git'] == 'giris'))
	{
		$sayfa_adi = $l['giris'];
		if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
		if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

		$ornek1 = new phpkf_tema();
		$tema_dosyasi = 'temalar/'.$temadizini.'/giris.php';
		eval($ornek1->tema_dosyasi($tema_dosyasi));

		if (@is_file('ayar.php')) $giris_dizin ='';
		else $giris_dizin ='../';

		$java = '<script type="text/javascript">
		<!-- //
		function denetle2()
		{ 
		var dogruMu = true;
		if ((document.giris.kullanici_adi.value.length < 4) || (document.giris.sifre.value.length < 5)) 
		{ 
		dogruMu = false; 
		alert("'.$kp_dil_437.'");
		}
		return dogruMu;
		}
		//  -->
		</script>';

		$ornek1->dongusuz(array(
		'{JAVA}' => $java,
		'{ACTION}' => $giris_dizin.'giris.php',
		'{GIT}' => $phpkf_dosyalar['portal'],
		'{BASLIK}' => $kp_dil_515,
		'{HOSGELDINIZ}' => $kp_dil_181,
		'{IP}' => $kp_dil_182,
		'{IP_SONUC}' => $ip,
		'{KULLANICI_ADI}' => $kp_dil_40,
		'{KULLANICI_ADI_VALUE}' => '',
		'{SIFRE}' => $kp_dil_41,
		'{HATIRLA}' => $kp_dil_25,
		'{GIRIS_YAP}' => $kp_dil_91,
		'{YENI_SIFRE}' => $kp_dil_26,
		'{GIRIS_DIZIN}' => $giris_dizin,
		'{YENI_KAYIT}' => $kp_dil_183,
		'{ETKINLESTIRME}' => $kp_dil_539));


		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(TEMA_UYGULA);
		exit();
	}


	else
	{
		if (!isset($kullanici_kim['id']))
		{
			if (@is_file('ayar.php'))
			{
				header('Location: '.$phpkf_dosyalar['portal'].'');
				exit();
			}
			else 
			{
				header('Location: ../'.$phpkf_dosyalar['portal'].'');
				exit();
			}
		}


		if ($kullanici_kim['yetki'] !='1')
		{
		$sayfa_adi = $l['hata_iletisi'].' '.$l['yonetim'];
		if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
		if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';


		if (@is_file('ayar.php')) $giris_dizin ='';
		else $giris_dizin ='../';

		$ileti_sonuc = array(
		'{ILETI_BASLIK}' => $ileti_2,
		'{ADRES}' => $giris_dizin.$phpkf_dosyalar['portal'],
		'{ILETI}' => '<br><br>'.$kp_dil_519,
		'{EK_YAZI}' => '',
		'{YONLENDIRME}' => $ileti__3,
		'{YONLENDIRME2}' => $ileti__2);

		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(hata_iletileri($ileti_sonuc));
		exit();
		}


		if ( (isset($_COOKIE['yonetim_kimlik'])) AND ($_COOKIE['yonetim_kimlik'] != '') )
		{
			header('Location: yonetim.php');
			exit();
		}


		$sayfa_adi = $l['yonetim'].' '.$l['giris'];
		if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
		if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';


		$ornek1 = new phpkf_tema();
		$tema_dosyasi = 'temalar/'.$temadizini.'/giris.php';
		eval($ornek1->tema_dosyasi($tema_dosyasi));

		if (@is_file('ayar.php')) $giris_dizin ='';
		else $giris_dizin ='../';

		$java = '<script type="text/javascript">
		<!-- //
		function denetle2()
		{ 
		var dogruMu = true;
		if ((document.giris.kullanici_adi.value.length < 4) || (document.giris.sifre.value.length < 5)) 
		{ 
		dogruMu = false; 
		alert("'.$kp_dil_437.'");
		}
		return dogruMu;
		}
		//  -->
		</script>';

		$ornek1->dongusuz(array(
		'{JAVA}' => $java,
		'{ACTION}' => '../phpkf-yonetim/giris.php',
		'{GIT}' => 'portal',
		'{BASLIK}' => $kp_dil_516,
		'{HOSGELDINIZ}' => $kp_dil_520.' <font color="red">'.$kullanici_kim['kullanici_adi'].'</font><br>',
		'{IP}' => $kp_dil_182,
		'{IP_SONUC}' => $ip,
		'{KULLANICI_ADI}' => $kp_dil_40,
		'{KULLANICI_ADI_VALUE}' => $kullanici_kim['kullanici_adi'],
		'{SIFRE}' => $kp_dil_41,
		'{HATIRLA}' => $kp_dil_25,
		'{GIRIS_YAP}' => $kp_dil_91,
		'{YENI_SIFRE}' => $kp_dil_26,
		'{GIRIS_DIZIN}' => $giris_dizin,
		'{YENI_KAYIT}' => $kp_dil_183,
		'{ETKINLESTIRME}' => $kp_dil_539));


		echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
		eval(TEMA_UYGULA);
		exit();
	}
?>