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
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


function phpinfo_array($return=false)
{
	@ob_start();
	@phpinfo(-1);
	$pi = @ob_get_clean();
	$pi = preg_replace("|<style\b[^>]*>(.*?)</style>|s", "", $pi);
	$pi = strip_tags($pi,'<h1><h2><hr><style><table><tr><th><td><tbody><thead><tfoot><img><b><u><i><strong><em><br><p>');
	$pi = str_replace("phpinfo()", '', $pi);
	return $pi;
}



$tema_sayfa_icerik = '<style type="text/css">
.sunucu_bilgi {font-family: sans-serif !important; font-size:14px !important}
.sunucu_bilgi pre {margin: 0px; font-family: monospace;}
.sunucu_bilgi a:link {color: #000099; text-decoration: none; background-color: #ffffff;}
.sunucu_bilgi a:hover {text-decoration: underline;}
.sunucu_bilgi table {border-collapse: collapse; width:100%}
.center {text-align: center;}
.center table { margin-left: auto; margin-right: auto; text-align: left;}
.center th { text-align: center !important; }
.sunucu_bilgi td, .sunucu_bilgi th { border: 1px solid #000000; font-size: 75%; vertical-align: baseline;}
.sunucu_bilgi h1 {font-size: 150%;}
.sunucu_bilgi h2 {font-size: 125%;}
.p {text-align: left;}
.e {background-color: #ccccff; font-weight: bold; color: #000000;}
.h {background-color: #9999cc; font-weight: bold; color: #000000;}
.v {background-color: #cccccc; color: #000000;}
.vr {background-color: #cccccc; text-align: right; color: #000000;}
.sunucu_bilgi img {float: right; border: 0px;}
.sunucu_bilgi hr {width: 600px; background-color: #cccccc; border: 0px; height: 1px; color: #000000;}
</style>';


$tema_sayfa_icerik .= '<div class="sunucu_bilgi">'.phpinfo_array().'</div>';



// tema dosyası yükleniyor
$sayfa_adi = $ly['sunucu_bilgileri'];
$tema_sayfa_baslik = $ly['sunucu_bilgileri'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>