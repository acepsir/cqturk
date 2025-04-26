<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>
<!DOCTYPE html>
<html <?php echo $TEMA_HTML_DIL; ?>>
<head>
<title><?php echo $l['yonetim'].' '.$sayfa_baslik; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $TEMA_META_KARAKTER; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=0.9" />
<link href="temalar/varsayilan/resimler/resimler/favicon.png" rel="icon" type="image/png" />
<link href="temalar/varsayilan/css/portal_stil.css" rel="stylesheet" type="text/css" />
<link href="temalar/varsayilan/css/sablon.css" rel="stylesheet" type="text/css" />
<link href="yonetim/temalar/varsayilan/css/yonetim.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 8]>
<link href="yonetim/temalar/varsayilan/css/sablon_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php
if ($secili_tema == 'varsayilan')
{
	if ($ayarlar['tema_renk'] == 'mor') echo '<link href="temalar/varsayilan/css/sablon_mor.css" rel="stylesheet" type="text/css" />';
	elseif ($ayarlar['tema_renk'] == 'gri') echo '<link href="temalar/varsayilan/css/sablon_koyu.css" rel="stylesheet" type="text/css" />';
	elseif ($ayarlar['tema_renk'] == 'siyah') echo '<link href="temalar/varsayilan/css/sablon_siyah.css" rel="stylesheet" type="text/css" />';
}
?>
<script src="../phpkf-bilesenler/diller/<?php echo $site_dili; ?>/javascript.js"></script>
<script src="../phpkf-bilesenler/js/phpkf-jsk.js" type="text/javascript"></script>
<script src="../phpkf-bilesenler/js/islemler_forum.js" type="text/javascript"></script>
<script src="../phpkf-bilesenler/js/betik_portal.js" type="text/javascript"></script>
</head>
<body>
<header class="clearfix">


<nav id="sabit-menu" class="sabit-menu"><!-- sabit menü baş -->
<div class="ic">
<ul class="sola-yasla" role="menu">

<li role="menuitem" class="klogo"><a href="../<?php echo $phpkf_dosyalar['index']; ?>"></a></li>

<?php if (!$TEMA_UYE_BILGI): // üye girişi yapılmamışsa ?>

<li role="menuitem"><a href="../<?php echo $phpkf_dosyalar['giris']; ?>"><?php echo $lmenu['giris']; ?></a></li>
<li role="menuitem"><a href="../<?php echo $phpkf_dosyalar['kayit']; ?>"><?php echo $lmenu['kayit']; ?></a></li>

<?php else: // üye girişi yapılmışsa ?>

<li role="menuitem"><a href="../<?php echo $phpkf_dosyalar['profil']; ?>"><?php echo $lmenu['profil']; ?></a>
<ul class="dropdown-menu" role="menu">
<li role="menuitem"><a href="../<?php echo $phpkf_dosyalar['profil_degistir']; ?>"><?php echo $lmenu['duzenle']; ?></a></li>
<li role="menuitem"><a href="../<?php echo $phpkf_dosyalar['sifre_degistir']; ?>"><?php echo $lmenu['sifre']; ?></a></li>
</ul>
</li>

<li role="menuitem"><a href="../<?php echo $phpkf_dosyalar['ozel_ileti']; ?>"><?php echo $lmenu['ozel']; ?></a></li>


<?php if ($TEMA_UYE_BILGI['yetki'] == 1): // yönetici ise ?>
<li role="menuitem"><a href="<?php echo $cms_dizin; ?>phpkf-yonetim/index.php"><?php echo $lmenu['yonetim']; ?></a>
<ul class="dropdown-menu">
<li><a href="yonetim.php"><?php echo $lmenu['portal']; ?></a></li>
</ul>
</li>
<?php endif;// yönetici koşul sonu ?>

<li role="menuitem"><a href="../<?php echo $phpkf_dosyalar['cikis'].'?o='.$o; ?>" onclick="return window.confirm(jsl['cikis_uyari'])"><?php echo $lmenu['cikis']; ?></a></li>

<?php endif; // üye giriş koşul sonu ?>

</ul>



<a class="saga-yasla arama-button" onclick="aramaGoster('arama-alani');" href="javascript:void(0);">Ara</a>
<div class="arama-alani" id="arama-alani">
<form name="hizli_arama" action="../<?php echo $phpkf_dosyalar['arama']; ?>" method="get" onsubmit="return denetle_arama()">
<input type="hidden" name="a" value="1" />
<input type="hidden" name="b" value="1" />
<input type="hidden" name="forum" value="tum" />
<input type="hidden" name="tarih" value="tum_zamanlar" />
<input type="text" name="sozcuk_herhangi" maxlength="100" class="input" value="" placeholder="<?php echo $lmenu['arama']; ?>..." required />
<button class="arama-dugme" type="submit">ara</button>
</form>
</div>

</div>
</nav><!-- sabit menü son -->


<div id="site-baslik" class="site-baslik"><!-- site başlık baş -->
<div class="ic genislik">
<div class="baslikyazi sola-yasla"><?php echo $TEMA_LOGO_UST; ?></div>
<div class="baslikyazi saga-yasla"><?php echo $TEMA_LOGO_UST2; ?></div>
</div>
</div><!-- site başlık son -->


<nav id="genel-menu" class="genel-menu"><!-- genel menü baş -->
<div class="ic genislik">
<ul class="sola-yasla" role="menu">
<?php echo $TEMA_MENU; ?>
</ul>
</div>
</nav><!-- genel menü son -->


</header><!-- header bitiş -->


<div id="yonetim_ana_govde" class="genislik">
<div class="menu-alt-bosluk"></div>
