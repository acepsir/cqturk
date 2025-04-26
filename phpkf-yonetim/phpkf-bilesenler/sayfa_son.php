<?php
if (!defined('PHPKF_ICINDEN')) exit();

// bildirim dosyası yükleniyor
$bldrm_dizin = '../';
include_once('../phpkf-bilesenler/bildirim.php');


if (@!preg_match('/\<img/', $ayarlar['tema_logo_alt']))
{
	$TEMA_SITE_ALT_LOGO  = '<span>'.$ayarlar['tema_logo_alt'].'</span>';
}
else $TEMA_SITE_ALT_LOGO = $ayarlar['tema_logo_alt'];


// tema dosyası yükleniyor
include_once("phpkf-bilesenler/temalar/$temadizini_cms/son.php");
?>