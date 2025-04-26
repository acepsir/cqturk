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


define('DOSYA_SABLON',true);
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');


if (isset($_GET['engenis_sol']))
{
	$engenis_solblok = zkTemizle4($_GET['engenis_sol']);
	$engenis_solblok = zkTemizle($engenis_solblok);
	$engenis_solblok = $engenis_solblok.' !important';
}
else $engenis_solblok = '200px !important';

if (isset($_GET['engenis_sag']))
{
	$engenis_sagblok = zkTemizle4($_GET['engenis_sag']);
	$engenis_sagblok = zkTemizle($engenis_sagblok);
	$engenis_sagblok = $engenis_sagblok.' !important';
}
else $engenis_sagblok = '200px !important';



// tema veritabanından çekiliyor
$vtsorgu = "SELECT * FROM $tablo_sablonlar WHERE ad='kullanilan' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$tema = $vt->fetch_assoc($vtsonuc);


// tema css kodu oluşturuluyor
header('Content-type: text/css');
echo '@charset "utf-8";'."\r\n";


foreach($tema as $temae => $temab){
	if (($temae != 'id') AND ($temae != 'ad')) echo $temab;
}

echo '
@media screen and (min-width: 768px){
.genislik{width:'.$ayarlar['tema_genislik'].'; margin:0 auto}
.sol-blok{width:'.$engenis_solblok.';}
.sag-blok{width:'.$engenis_sagblok.';}
}';

?>