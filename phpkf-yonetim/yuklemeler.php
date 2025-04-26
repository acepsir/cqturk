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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5' OR kat='14'";
if (!defined('DOSYA_AYAR')) include '../phpkf-ayar.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');
include_once('../phpkf-bilesenler/yukleme/dosya_tipleri.php');


$bul = array("'", "\n", "\r");
$degis = array("\'", '', '');

$dosya_tipleri_js =  '
var duzenleyici_dizin = "../";
var azami_boyut = "'.$ayarlar['yukleme_boyut'].'";
var video_etiketi = "'.$video_etiketi.'";
var embed_etiketi = "'.$embed_etiketi.'";
var audio_etiketi = "'.$audio_etiketi.'";
var yukleme_video = \''.str_replace($bul, $degis, $ayarlar['yukleme_video']).'\';
var yukleme_embed = \''.str_replace($bul, $degis, $ayarlar['yukleme_embed']).'\';
var yukleme_audio = \''.str_replace($bul, $degis, $ayarlar['yukleme_audio']).'\';
';


// tema dosyası yükleniyor
$sayfa_adi = $ly['dosya_yuklemeleri'];
$tema_sayfa_baslik = $ly['dosya_yuklemeleri'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/yuklemeler.php'));
?>