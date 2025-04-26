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
define('DOSYA_SEF',true);


if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') ):

$gadres = $_SERVER['REQUEST_URI'];
$anadizin2 = str_replace('/', '\/', $anadizin);


// Özel SEF Adresler
function OzelSEF($a=1, $b=1)
{
	global $ayarlar, $gadres, $anadizin2;

	$donen = '';
	if ( ($ayarlar['sef_adresler'] != '') AND ($a == 1) )
	{
		$sef_adresler = str_replace(array("\r",' '), array('', ''), $ayarlar['sef_adresler']);
		$sef_adresler = explode("\n", $sef_adresler);

		foreach ($sef_adresler as $sef_adres)
		{
			if ($sef_adres != '')
			{
				$sef_adres = explode('=', $sef_adres);
				if ( (isset($sef_adres[0])) AND (isset($sef_adres[1])) )
				{
					$sef_adres[0] = str_replace('/', '\/', $sef_adres[0]);
					if (preg_match("/^$anadizin2".$sef_adres[0]."(|\?.*)$/i", $gadres))
					{
						$donen = "if (@include_once('$sef_adres[1]'));
						if (@include_once('phpkf-bilesenler/oturum.php'));
						else echo '<b>Dosya Bulunamıyor: &nbsp; </b>$sef_adres[1]';
						exit();";
						break;
					}
				}
			}
		}
	}

	if ( ($donen == '') AND ($b == 1) )
	{
		$donen .= 'if(!defined("PHPKF_ICINDEN_TEMA"))define("PHPKF_ICINDEN_TEMA",true);
		$sayfa_adi="404";
		$sayfa_numara = 116;
		if (@include_once("phpkf-bilesenler/oturum.php"));
		header($_SERVER[\'SERVER_PROTOCOL\']." 404 Not Found");
		header("Content-type: text/html; charset=utf-8");
		include_once(\'phpkf-bilesenler/temalar/\'.$temadizini_cms.\'/404.php\');
		exit();';
	}

	return($donen);
}



// Kök ve index.php için
if (preg_match("/^$anadizin2(|\?.*)$/i", $gadres));
elseif (preg_match("/^$anadizin2\\index.php(|\?.*)$/i", $gadres));
elseif (preg_match("/^$anadizin2\\".$phpkf_dosyalar['index']."(|\?.*)$/i", $gadres));
elseif (preg_match("/^$anadizin2\\".$phpkf_dosyalar['cms']."(|\?.*)$/i", $gadres));



// SEF kaplıysa
elseif ($ayarlar['seo'] == '0')
{
	// 404 hatası ver
	if(!defined("PHPKF_ICINDEN_TEMA"))define("PHPKF_ICINDEN_TEMA",true);
	$sayfa_adi="404";
	$sayfa_numara = 116;
	if (@include_once("phpkf-bilesenler/oturum.php"));
	header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
	header("Content-type: text/html; charset=utf-8");
	include_once('phpkf-bilesenler/temalar/'.$temadizini_cms.'/404.php');
	exit();
}



// Dizin adresler için
elseif (preg_match("/^$anadizin2".$ayarlar['dizin_kat']."\/$/i", $gadres, $adres, PREG_OFFSET_CAPTURE)) $_GET['kip'] = 'kat';
elseif (preg_match("/^$anadizin2".$ayarlar['dizin_sayfa']."\/$/i", $gadres, $adres, PREG_OFFSET_CAPTURE)) $_GET['kip'] = 'sayfa';
elseif (preg_match("/^$anadizin2".$ayarlar['dizin_galeri']."\/$/i", $gadres, $adres, PREG_OFFSET_CAPTURE)) $_GET['kip'] = 'galeri';
elseif (preg_match("/^$anadizin2".$ayarlar['dizin_video']."\/$/i", $gadres, $adres, PREG_OFFSET_CAPTURE)) $_GET['kip'] = 'video';
elseif (preg_match("/^$anadizin2".$ayarlar['dizin_etiket']."\/$/i", $gadres, $adres, PREG_OFFSET_CAPTURE)) $_GET['kip'] = 'etiket';
elseif (preg_match("/^$anadizin2".$ayarlar['dizin_arama']."\/$/i", $gadres, $adres, PREG_OFFSET_CAPTURE)) $_GET['kip'] = 'arama';
elseif (preg_match("/^$anadizin2"."iletisim.html$/i", $gadres, $adres, PREG_OFFSET_CAPTURE)) $_GET['kip'] = 'iletisim';
elseif (preg_match("/^$anadizin2".$ayarlar['dizin_etiket']."\/(.*?)\/.*$/i", $gadres, $adres, PREG_OFFSET_CAPTURE)){
	if ($adres[1][0]) $_GET['etiket'] = $adres[1][0];}
elseif (preg_match("/^$anadizin2".$ayarlar['dizin_arama']."\/(.*?)\/.*$/i", $gadres, $adres, PREG_OFFSET_CAPTURE)){
	if ($adres[1][0]) $_GET['arama'] = $adres[1][0];}




//  KategoriAdı-k1/SayfaAdı-y1.html adres yapısı için
elseif ($ayarlar['seo'] == 1)
{
	if (preg_match("/([a-z0-9-]*?)-k([0-9]*?)\/([a-z0-9-]*?)-y([0-9]*?).html(\?[^\/]+)?$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		if ($adres[2][0]) $_GET['k'] = $adres[2][0];
		if ($adres[4][0]) $_GET['y'] = $adres[4][0];
	}

	elseif (preg_match("/([a-z0-9-]*?)-k([0-9]*?)\/(\?[^\/]+)?$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		$_GET['kip'] = 'kat';
		if ($adres[2][0]) $_GET['k'] = $adres[2][0];
	}

	elseif (preg_match("/^$anadizin2([0-9]*?)-uye-([a-z0-9-]*?).html$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		if ($adres[1][0]) $_GET['u'] = $adres[1][0];
		include_once($phpkf_dosyalar['profil']);
		exit();
	}

	else eval(OzelSEF());
}




//  KategoriAdı/SayfaAdı.html adres yapısı için
elseif ($ayarlar['seo'] == 2)
{
	if (preg_match("/^$anadizin2([a-z0-9-]*?)\/([a-z0-9-]*?).html(\?[^\/]+)?$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		if ($adres[1][0]) $_GET['ka'] = $adres[1][0];
		if ($adres[2][0]) $_GET['ya'] = $adres[2][0];
	}

	elseif (preg_match("/^$anadizin2([a-z0-9-]*?)\/(\?[^\/]+)?$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		$_GET['kip'] = 'kat';
		if ($adres[1][0]) $_GET['ka'] = $adres[1][0];
	}

	elseif (preg_match("/^$anadizin2"."uye-([a-z0-9-]*?).html$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		if ($adres[1][0]) $_GET['kim'] = $adres[1][0];
		include_once($phpkf_dosyalar['profil']);
		exit();
	}

	else eval(OzelSEF());
}




//  SayfaAdı-y1.html adres yapısı için
elseif ($ayarlar['seo'] == 3)
{
	if (preg_match("/^$anadizin2([a-z0-9-]*?)-y([0-9]*?).html(\?[^\/]+)?$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		if ($adres[2][0]) $_GET['y'] = $adres[2][0];
	}

	elseif (preg_match("/^$anadizin2([a-z0-9-]*?)-k([0-9]*?)\/(\?[^\/]+)?$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		$_GET['kip'] = 'kat';
		if ($adres[2][0]) $_GET['k'] = $adres[2][0];
	}

	elseif (preg_match("/^$anadizin2([0-9]*?)-uye-([a-z0-9-]*?).html$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		if ($adres[1][0]) $_GET['u'] = $adres[1][0];
		include_once($phpkf_dosyalar['profil']);
		exit();
	}

	else eval(OzelSEF());
}




//  SayfaAdı.html adres yapısı için
elseif ($ayarlar['seo'] == 4)
{
	eval(OzelSEF(1,0));

	if (preg_match("/^$anadizin2"."uye-([a-z0-9-]*?).html$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		if ($adres[1][0]) $_GET['kim'] = $adres[1][0];
		include_once($phpkf_dosyalar['profil']);
		exit();
	}

	elseif (preg_match("/^$anadizin2([a-z0-9-]*?).html(\?[^\/]+)?$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		if ($adres[1][0]) $_GET['ya'] = $adres[1][0];
	}

	elseif (preg_match("/^$anadizin2([a-z0-9-]*?)\/(\?[^\/]+)?$/i", $gadres, $adres, PREG_OFFSET_CAPTURE))
	{
		$_GET['kip'] = 'kat';
		if ($adres[1][0]) $_GET['ka'] = $adres[1][0];
	}

	else eval(OzelSEF(0,1));
}


endif; // REQUEST_URI koşul sonu

?>