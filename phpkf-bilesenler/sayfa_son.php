<?php
if (!defined('PHPKF_ICINDEN')) exit();

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
		if ((@!preg_match('/\<a/', $TEMA_LOGO_ALT)) AND ($temadizini_cms == 'varsayilan')) $TEMA_LOGO_ALT = '<a href="'.$anadizin.'">'.$TEMA_LOGO_ALT.'</a>';
		$TEMA_LOGO_ALT = '<span>'.$TEMA_LOGO_ALT.'</span>';
	}
}


// tema dosyası yükleniyor
include_once("phpkf-bilesenler/temalar/$temadizini_cms/son.php");
?>