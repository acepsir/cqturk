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


if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
if (!defined('DOSYA_YONETIM_GUVENLIK')) include '../phpkf-yonetim/phpkf-bilesenler/guvenlik.php';
define('DOSYA_MENU',true);


$kosul = @zkTemizle($_GET['kosul']);
$bilgi = @zkTemizle($_GET['bilgi']);
$hata = @zkTemizle($_GET['hata']);

///////////////////////////////////////////////////////////////////


// yönetim menüsü - başlangıcı

function menu(){
global $kp_yonetim_12,$kp_yonetim_53,$kp_yonetim_82,$kp_yonetim_16,$kp_yonetim_17,$kp_yonetim_157,$kp_yonetim_158,$kp_yonetim_211;
global $kp_yonetim_110,$kp_yonetim_111,$kp_yonetim_113,$kp_yonetim_115,$kp_yonetim_114,$kp_yonetim_156,$kp_yonetim_114,$kp_yonetim_174;
global $arka_tablo,$kp_yonetim_13,$kp_yonetim_14,$kp_yonetim_15,$kp_yonetim_41,$version,$kp_yonetim_159,$kp_yonetim_193,$kp_yonetim_212;
global $kp_yonetim_100,$kp_yonetim_101,$kp_yonetim_112,$kp_yonetim_11,$kp_yonetim_116,$kp_yonetim_213,$portal_ayarlar,$ayarlar;
global $kp_yonetim_218,$kp_yonetim_219,$kp_yonetim_220,$kp_yonetim_221,$kp_yonetim_226,$kp_yonetim_227,$kp_yonetim_228,$kp_yonetim_229,$kp_yonetim_199;
global $kp_yonetim_230,$kp_yonetim_231,$kp_yonetim_320,$kp_yonetim_190,$kp_yonetim_330,$kp_yonetim_331,$kp_yonetim_332,$kp_yonetim_367,$kp_yonetim_368;
global $alan,$gizle1,$temadizini,$phpkf_dosyalar;

$ornek1 = new phpkf_tema();
$tema_dosyasi = 'yonetim/temalar/'.$temadizini.'/menu.php';
eval($ornek1->tema_dosyasi($tema_dosyasi));


$javascript_kodu ='<script type="text/javascript">
<!-- //
function resimDegistir(resim){
var alanadi = "'.$ayarlar['f_dizin'].'/portal/temalar/'.$temadizini.'/resimler/resimler/";
var dosya1 = alanadi+"assagi.png";
var dosya2 = alanadi+"yukari.png";
var blsresim = document.getElementById(resim);
if (blsresim.src==dosya1) blsresim.src=dosya2;
else blsresim.src=dosya1;
}
function bls_gizle(gizle1){
var gizle1 = document.getElementById(gizle1);
if (document.getElementById){
if(gizle1.style.display == \'inline\'){
    gizle1.style.display = \'none\';
    gizle1.style.visibility = \'hidden\';}
else{
    gizle1.style.display = \'inline\';
    gizle1.style.visibility = \'visible\';}}
}
// -->
</script>';


$dongu_yok11 = array(
'{JAVASCRIPT_KODU}' => $javascript_kodu,
'{TEMA_DIZIN}' => $temadizini,
'{EKLENTILER}' => $kp_yonetim_367,
'{DOSYALAR_SAYFASI}' => $kp_yonetim_368,
'{SAYFA_AYARLARI}' => $kp_yonetim_190,
'{FAVORI_SITELER}' => $kp_yonetim_320,
'{DUYURU_HABER}' => $kp_yonetim_228,
'{VERITABANI}' => $kp_yonetim_229,
'{DIGERLERI}' => $kp_yonetim_230,
'{OZEL_SAYFALAR}' => $kp_yonetim_231,
'{SUNUCU_BILGISI}' => $kp_yonetim_226,
'{VERITABANI_BILGISI}' => $kp_yonetim_227,
'{BLOK_SAYFASI}' => $kp_yonetim_213,
'{HABER_SAYFASI}' => $kp_yonetim_211,
'{VT_YEDEKLE}' => $kp_yonetim_218,
'{VT_YUKLE}' => $kp_yonetim_219,
'{VT_YONETIM}' => $kp_yonetim_220,
'{HABER_EKLE}' => $kp_yonetim_221,
'{HABER_SAYFASI_2}' => $kp_yonetim_212,
'{GALERI_SAYFASI}' => $kp_yonetim_174,
'{GALERI_SAYFASI_2}' => $kp_yonetim_193,
'{ANKETLER_SAYFASI}' => $kp_yonetim_158,
'{DAVETIYE}' => $kp_yonetim_159,
'{YONETIM_MENUSU}' => $kp_yonetim_114,
'{SAYFALAR}' => $kp_yonetim_157,
'{TEMA_AYARLARI}' => $kp_yonetim_156,
'{YONETIM_MASASI}' => $kp_yonetim_11,
'{YONETIM_MENUSU}' => $kp_yonetim_114,
'{YONETIM_ANA_SAYFASI}' => $kp_yonetim_12,
'{FORUM_YONETIMI}' => $kp_yonetim_13,
'{FORUM_INDEX}' => $phpkf_dosyalar['forum'],
'{FORUM_ANA_SAYFASI}' => $kp_yonetim_15,
'{PORTAL_INDEX}' => $phpkf_dosyalar['portal'],
'{PORTAL_ANA_SAYFASI}' => $kp_yonetim_14,
'{SITEMAP_SAYFASI}' => $kp_yonetim_116,
'{GENEL_AYARLAR}' => $kp_yonetim_115,
'{DUYURU_YONETIMI}' => $kp_yonetim_41,
'{ANKET_YONETIMI}' => $kp_yonetim_82,
'{DOSYA_YUKLE}' => $kp_yonetim_101,
'{YENI_BLOK_EKLE}' => $kp_yonetim_332,
'{ANKETLER_SAYFASI_1}' => 'anket.php',
'{HABER_SAYFASI_1}' => 'haberler.php',
'{GALERI_SAYFASI_1}' => 'galeri.php',
'{SITEMAP_SAYFASI_1}' => 'sitemap.php',
'{DAVETIYE_SAYFASI_1}' => 'davetiye.php',
'{DOSYALAR_SAYFASI_1}' => 'dosyalar.php',
'{TAKVIM_SAYFASI}' => $kp_yonetim_199,
'{TAKVIM_SAYFASI_1}' => 'takvim.php',
'{SITELER_SAYFASI}' => $kp_yonetim_331,
'{SITELER_SAYFASI_1}' => 'site_ekle.php',
'{ARAMA_SAYFASI_1}' => 'portal_arama.php',
'{ARAMA_SAYFASI}' => $kp_yonetim_330,
'{TEMA_SECIM_SAYFASI_11}' => '../phpkf-yonetim/temalar.php?kip=portal',
'{SUNUCU_BILGISI_SAYFASI_11}' => '../phpkf-yonetim/phpinfo.php',
'{VERITABANI_BILGISI_SAYFASI_11}' => '../phpkf-yonetim/show_status.php',
'{VT_SAYFASI_1}' => '../phpkf-yonetim/vt_yedek.php',
'{VT_SAYFASI_2}' => '../phpkf-yonetim/vt_yukle.php',
'{VT_SAYFASI_3}' => '../phpkf-yonetim/vt_yonetim.php',
'{DOSYA_EKLE}' => $kp_yonetim_100);


$ornek1->dongusuz($dongu_yok11);
$ornek1->tema_uygula();

}

// yönetim menüsü - sonu



function yonetim_hata_iletileri($ileti = array())
{
	global $ayarlar, $portal_ayarlar, $temadizini;

	ob_end_clean();

	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_DILAYARINDEX')) include 'diller/dil_ayarlari.php';

	$ileti_dosyasi = 'yonetim/temalar/'.$temadizini.'/yonetim_ileti.php';

	if (!($dosya_ac = fopen($ileti_dosyasi,'r'))) die ('Dosya Açılamıyor');
	$boyut = filesize($ileti_dosyasi);
	$ileti_metni = fread($dosya_ac, $boyut);
	fclose($dosya_ac);


	$bul = array('{ILETI_BASLIK}',
	'{ADRES}',
	'{ILETI}',
	'{EK_YAZI}',
	'{YONLENDIRME}',
	'{YONLENDIRME2}');

	$cevir = array($ileti['{ILETI_BASLIK}'],
	$ileti['{ADRES}'],
	$ileti['{ILETI}'],
	$ileti['{EK_YAZI}'],
	$ileti['{YONLENDIRME}'],
	$ileti['{YONLENDIRME2}']);

	$ileti_metni = str_replace($bul, $cevir, $ileti_metni);
	echo $ileti_metni;
}

?>