<?php
if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_GERECLER')) include 'gerecler.php';


// bildirim dosyası yükleniyor
$bldrm_dizin = '';
include_once('phpkf-bilesenler/bildirim.php');


// Taban yazı ve logo
$TEMA_SITE_TABAN_YAZI = $ayarlar['site_taban'];
$TEMA_SITE_TABAN_KOD = $ayarlar['site_taban_kod'];
$TEMA_LOGO_ALT = $ayarlar['tema_logo_alt'];


if ($TEMA_LOGO_ALT != '')
{
	if (@!preg_match('/\<img/', $TEMA_LOGO_ALT))
	{
		if ((@!preg_match('/\<a/', $TEMA_LOGO_ALT)) AND ($temadizini == 'varsayilan')) $TEMA_LOGO_ALT = '<a href="'.$anadizin.'">'.$TEMA_LOGO_ALT.'</a>';
		$TEMA_LOGO_ALT = '<span>'.$TEMA_LOGO_ALT.'</span>';
	}
}


// Forum dizini
if ($ayarlar['f_dizin'] == '/') $fdizin = '';
else $fdizin = $ayarlar['f_dizin'];
$tema_secimi = '';


// Yönetim bağlantıları
$yonetim = '';
if ( (isset($kullanici_kim['yetki'])) AND ($kullanici_kim['yetki'] == 1) )
{
	$yonetim .= '<a href="phpkf-yonetim/index.php">Yönetim Masası</a>';
}


$mobil_adres = '';

if ( (isset($_GET['f'])) AND ($_GET['f'] !='' ) AND (is_numeric($_GET['f'])) )
	$mobil_adres = $phpkf_dosyalar['mobil'].'?af='.$_GET['f'];

elseif ( (isset($_GET['k'])) AND ($_GET['k'] !='' ) AND (is_numeric($_GET['k'])) )
	$mobil_adres = $phpkf_dosyalar['mobil'].'?ak='.$_GET['k'];

elseif ( (isset($_GET['oino'])) AND ($_GET['oino'] !='' ) AND (is_numeric($_GET['oino'])) )
	$mobil_adres = 'mobil/oi_oku.php?oino='.$_GET['oino'];

elseif ((isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != ''))
{
	$adres = $_SERVER['REQUEST_URI'];
	if (preg_match("/\/ozel_ileti.php/i", $adres))
	{
		if (isset($_GET['kip'])) $mobil_adres = 'mobil/ozel_ileti.php?kip='.zkTemizle($_GET['kip']);
		else $mobil_adres = 'mobil/ozel_ileti.php';
	}
	elseif (preg_match("/\/arama.php/i", $adres)) $mobil_adres = 'mobil/arama.php';
}


// Tema uygulanıyor
$dongusuz = array('{YONETIM_MASASI}' => $yonetim,
'{MOBIL_ADRES}' => $mobil_adres,
'{TEMA_SECIMI}' => $tema_secimi);
eval(TEMA_UYGULA_SON);
$vt->close();
unset($vt);
?>