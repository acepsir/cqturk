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
if (!defined('DOSYA_GERECLER')) include $duzenleyici_dizin.'phpkf-bilesenler/gerecler.php';


$duzenleyici_ifadeler_dizin = $TEMA_SITE_ANADIZIN.'phpkf-dosyalar/ifadeler/';
$duzenleyici_ifadeler_dizin  = str_replace('/','\\/',$duzenleyici_ifadeler_dizin);


$bul = array('\\','(',')','/','*','|');
$cevir = array('\\\\','\\(','\\)','\\/','\\*','\\|');


$dongu=0; $a1=''; $b1=''; $a2=''; $b2='';

foreach($ifadeler_dizi as $tek)
{
	$kod = str_replace($bul, $cevir, $tek['k']);
	$a1 .= '"'.$kod.'", ';
	$b1 .= '"'.$tek['d'].'", ';
	$a2 .= '"<img src=\""+ifadeler_dizin+"'.$tek['d'].'\"\>", ';
	$b2 .= '"'.$tek['k'].'", ';
	$dongu++;
}

$a1 = substr($a1, 0, -2);
$b1 = substr($b1, 0, -2);
$a2 = substr($a2, 0, -2);
$b2 = substr($b2, 0, -2);

echo '<script type="text/javascript"><!-- //
var ifadeler_dizin="'.$duzenleyici_ifadeler_dizin.'";
var ifadeler_bul1 = new Array('.$a1.');
var ifadeler_degis1 = new Array('.$b1.');
var ifadeler_bul2 = new Array('.$a2.');
var ifadeler_degis2 = new Array('.$b2.');
// -->
</script>';

?>