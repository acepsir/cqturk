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


if (!defined('PHPKF_ICINDEN')) exit();
define('DOSYA_DIL',true);



// varsayılanlar
$ayarlar['dil_varsayilan'] = 'tr';
$ayarlar['dil_eklenen'] = ',tr,en,it,';



// Tanımlı Diller - kendi dilinde yazılış
$dillerg = array(
'de' => 'Deutsch',
'ar' => 'العربية',
'az' => 'Azərbaycan dili',
'eu' => 'Euskara',
'bn' => 'বাংলা',
'bg' => 'Български език',
'cs' => 'Čeština',
'zh-cn' => '简体中文',
'zh-tw' => '繁體中文',
'da' => 'Dansk',
'id' => 'Bahasa Indonesia',
'hy' => 'Հայերեն',
'et' => 'Eesti',
'fa' => 'فارسی',
'fil' => 'Filipino',
'fi' => 'Suomi',
'fr' => 'Français',
'gl' => 'Galego',
'gu' => 'ગુજરાતી',
'ka' => 'ქართული ენა',
'hr' => 'Hrvatski',
'hi' => 'हिन्दी',
'nl' => 'Nederlands',
'he' => 'עִבְרִית',
'en' => 'English',
'ga' => 'Gaeilge',
'es' => 'Español',
'sv' => 'Svenska',
'it' => 'Italiano',
'ja' => '日本語',
'kn' => 'ಕನ್ನಡ',
'ca' => 'Català',
'ko' => '한국어',
'kk' => 'Қазақша',
'ky' => 'кыргызча',
'ku' => 'Kurdî (Kurmancî)',
'hac' => 'گۆرانی (Gorani)',
'cb' => 'کوردیی ناوەندی‏ (Sorani)',
'zz' => 'Kurdî (Zaza)',
'lzz' => 'Lazuri nena - ლაზური ნენა',
'pl' => 'Polski',
'hu' => 'Magyar',
'mk' => 'Македонски',
'msa' => 'Bahasa Melayu',
'mn' => 'Монгол',
'mr' => 'मराठी',
'no' => 'Norsk',
'ota' => 'Osmanlıca',
'uz' => 'O`zbek',
'pt' => 'Português',
'ro' => 'Română',
'ru' => 'Русский',
'sr' => 'Српски',
'sk' => 'Slovenčina',
'tg' => 'Тоҷикӣ',
'ta' => 'தமிழ்',
'th' => 'ภาษาไทย',
'tr' => 'Türkçe',
'tm' => 'Türkmen dili - تورکمن ﺗﻴﻠی',
'uk' => 'Українська мова',
'ur' => 'اردو',
'vi' => 'Tiếng Việt',
'el' => 'Ελληνικά',
);



// varsayılanlar
$ayarlar['k_cerez_zaman'] = 1800;
$dosya_index = 'index.php';
$cerez_alanadi = $_SERVER['HTTP_HOST'];
$cerez_dizin = dirname(dirname($_SERVER['PHP_SELF'] ));
if ($cerez_dizin == '\\') $cerez_dizin = '/';



// GET ile dil seçimi
if (isset($_GET['dil']))
{
	$bul = array('x','-','.',',');
	$dil = htmlspecialchars(urldecode(trim($_GET['dil'])), ENT_QUOTES);
	$dil = str_replace($bul, '', $dil);
	$zaman = time()+$ayarlar['k_cerez_zaman'];

	if (isset($_SERVER['HTTP_REFERER'])) $ref = str_replace('dil='.$dil, '', $_SERVER['HTTP_REFERER']);
	else $ref = $dosya_index;

	if (($dil == '') OR ($dil == '0') OR (!preg_match("/,$dil,/is", $ayarlar['dil_eklenen'])) ) {$dil = ''; $zaman = 0;}

	@setcookie('dil', $dil, $zaman, $cerez_dizin, $cerez_alanadi);

	header('Location: '.$ref);
	exit();
}




// COOKIE ile dil seçimi
if (isset($_COOKIE['dil']))
{
	$bul = array('x','-','.',',');
	$dil = htmlspecialchars(urldecode(trim($_COOKIE['dil'])), ENT_QUOTES);
	$dil = str_replace($bul, '', $dil);

	if (($dil != '') AND (preg_match("/,$dil,/is", $ayarlar['dil_eklenen']))) $site_dili = $_COOKIE['dil'];
	else $site_dili = $ayarlar['dil_varsayilan'];
}
else
{
	$site_dili = $ayarlar['dil_varsayilan'];
}




// Dil dosyası yükleniyor
if (@include_once($site_dili.'.php'));
else include_once('tr.php');





// Dil seçim formu hazırlanıyor

if ($ayarlar['dil_eklenen'] != ',')
{
	$TEMA_DIL_SECIM = '<form action="" method="get" name="site_dili">
	<select name="dil" class="formlar" style="padding:4px 6px 4px 2px; width:auto; text-align:center" onchange="if(this.options[this.selectedIndex].value!=\'0\'){document.forms[\'site_dili\'].submit()}">
	<option value="0"> - '.$l['dil_sec'].' - </option>';


	$dil_eklenen = explode(',', $ayarlar['dil_eklenen']);
	foreach ($dil_eklenen as $dil)
	{
		if ($dil == '') continue;
		if ($dil == $site_dili)
		{
			$s = ' selected="selected"';
			$z = '';
		}
		else
		{
			$s = '';
			$z = ' - '.$diller[$dil];
		}
		$TEMA_DIL_SECIM .= '<option value="'.$dil.'"'.$s.'>'.$dillerg[$dil].$z.'</option>'."\r\n";
	}
	$TEMA_DIL_SECIM .= '</select><input type="submit" value="'.$l['sec'].'" class="formlar" style="padding:5px 8px; margin-left:7px; width:auto" /></form>';
}
else $TEMA_DIL_SECIM = false;




// Veritabanı sınıf dosyaları alınıyor

$veritabanlari = '';
$dizin_adi = '../phpkf-bilesenler/veritabani/';

if ($dizin = @opendir($dizin_adi))
{
	while ( @gettype($bilgi = @readdir($dizin)) != 'boolean' )
	{
		if ( (!@is_dir($dizin_adi.$bilgi)) AND ($bilgi != 'index.php') AND (@preg_match('/.php$/i', $bilgi)) )
		{
			$bilgi = str_replace('.php', '', $bilgi);

			if ($bilgi == 'mysql') $veritabanlari .= '<option value="mysql">MySQL ('.$lk[86].')</option>';
			elseif ($bilgi == 'mysqli') $veritabanlari .= '<option value="mysqli" selected="selected">MySQLi (improved)</option>';
			elseif ($bilgi == 'mssql') $veritabanlari .= '<option value="mssql">MSSQL (Microsoft SQL)</option>';
			else $veritabanlari .= '<option value="'.$bilgi.'">'.$bilgi.'</option>';
		}
	}
}

else
{
	$veritabanlari = '<option value="">phpkf-bilesenler/veritabani/ '.$lk[89].'</option>';
}



//  hata tablosu
$vt_hata_tablo[0] = '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>'.$lk[90].'</title><link href="../phpkf-bilesenler/temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" /></head><body style="background:#f8f8f8">
<br><br><br><table border="0" cellspacing="1" cellpadding="7" width="530" bgcolor="#999999" align="center"><tr><td bgcolor="#eeeeee" align="center"><font color="#ff0000"><b>';
$vt_hata_tablo[1] = '</b></font></td></tr><tr><td bgcolor="#f5f5f5"><table border="0" cellspacing="1" cellpadding="7" width="100%" bgcolor="#999999" align="center"><tr><td bgcolor="#eeeeee" align="left" style="padding:30px 15px">';
$vt_hata_tablo[2] = '</td></tr></table></table></body></html>';

?>