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

// Düzenleyici tek sefer yükleniyor
if (!isset($duzenleyici_yukle))
{
	echo '<script src="'.$duzenleyici_dizin.'phpkf-bilesenler/editor/phpkf/phpkf.js" type="text/javascript"></script>';
}


// simge font yükleniyor
if ($ayarlar['duzenleyici_font'] != '')
{
	echo '<link href="'.$ayarlar['duzenleyici_font'].'" rel="stylesheet" type="text/css">';
}


// düğme ve varsayılan şablon yükleniyor
echo '<script src="'.$duzenleyici_dizin.'phpkf-bilesenler/editor/phpkf/dugmeler.js" type="text/javascript"></script>
<style type="text/css" scoped="scoped">@import url("'.$duzenleyici_dizin.'phpkf-bilesenler/editor/phpkf/css/varsayilan.css");</style>';


// harici düğme stil kodları
if ($ayarlar['dugme_stil'] != '')
{
	echo '<style type="text/css" scoped="scoped">@import url("'.$duzenleyici_dizin.'phpkf-bilesenler/editor/phpkf/harici_stil.php");</style>';
}


// HTML için
if ( (isset($duzenleyici_bicim)) AND ($duzenleyici_bicim == 'html') )
{
	$duzenleyici_js = 'html';
	$duzenleyici_cevir = 'cevirme';
	$duzenleyici_yolla = "yolla('".$duzenleyici_id."_div','".$duzenleyici_id."','yolla')";
	$duzenleyici_tema = $ayarlar['duzenleyici_html_tema'];
}

// BBCode için
else
{
	$duzenleyici_js = 'bbcode';
	$duzenleyici_cevir = 'cevir';
	$duzenleyici_yolla = "yolla('".$duzenleyici_id."_div','".$duzenleyici_id."','yolla','cevir')";

	if ((isset($duzenleyici_tip))AND($duzenleyici_tip == 'hizli'))
	{
		$duzenleyici_tema = $ayarlar['duzenleyici_hizli_tema'];
		$ayarlar['dugme_bbcode'] = $ayarlar['dugme_hizli'];
	}
	else $duzenleyici_tema = $ayarlar['duzenleyici_bbcode_tema'];
}



// Kod çevirici ve şablon yükleniyor
if (!isset($duzenleyici_yukle)) echo '<script src="'.$duzenleyici_dizin.'phpkf-bilesenler/editor/phpkf/'.$duzenleyici_js.'.js" type="text/javascript"></script>';

if ($duzenleyici_tema != 'varsayilan') echo '<style type="text/css" scoped="scoped">@import url("'.$duzenleyici_dizin.'phpkf-bilesenler/editor/phpkf/css/'.$duzenleyici_tema.'.css");</style>';



echo '<script type="text/javascript"><!-- //
var duzenleyici_cevir = "'.$duzenleyici_cevir.'";
var duzenleyici_yolla = "'.$duzenleyici_yolla.'";
var dugme_html = "'.$ayarlar['dugme_html'].'";
var dugme_bbcode = "'.$ayarlar['dugme_bbcode'].'";
'.$ayarlar['dugme_kodlar'].'
//  -->
</script>
<script src="'.$duzenleyici_dizin.'phpkf-bilesenler/editor/phpkf/uygula.js" type="text/javascript"></script>';


$duzenleyici_yukle = true;
?>