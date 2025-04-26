<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>
<!DOCTYPE html>
<html <?php echo $TEMA_HTML_DIL; ?>>
<head>
<title><?php echo $sayfa_baslik; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $TEMA_META_KARAKTER; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php echo $meta_etiketler; ?>
<link href="{UST_DIZIN}temalar/varsayilan/resimler/resimler/favicon.png" rel="icon" type="image/png" />
<?php echo $TEMA_CSS; ?>
<!--[if lt IE 8]>
<link href="{UST_DIZIN}temalar/varsayilan/css/sablon_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php echo $rss_satiri; ?>
</head>
<body>
<header class="clearfix">
{JAVASCRIPT_KODU2}

<?php if ($TEMA_UYELIK_MENU_GOSTER): // Üyelik menüsü göster/gizle - koşul başı ?>

<nav id="sabit-menu" class="sabit-menu"><!-- sabit menü baş -->
<div class="ic">
<ul class="sola-yasla" role="menu">

<li role="menuitem" class="klogo"><a href="<?php echo $alt_dizin.$phpkf_dosyalar['index']; ?>"></a></li>

<?php if (!$TEMA_UYE_BILGI): // üye girişi yapılmamışsa ?>

<li role="menuitem"><a href="<?php echo $alt_dizin.$phpkf_dosyalar['giris']; ?>"><?php echo $lmenu['giris']; ?></a></li>
<li role="menuitem"><a href="<?php echo $alt_dizin.$phpkf_dosyalar['kayit']; ?>"><?php echo $lmenu['kayit']; ?></a></li>

<?php else: // üye girişi yapılmışsa ?>

<li role="menuitem"><a href="<?php echo $alt_dizin.$phpkf_dosyalar['profil']; ?>"><?php echo $lmenu['profil']; ?></a>
<ul class="dropdown-menu" role="menu">
<li role="menuitem"><a href="<?php echo $alt_dizin.$phpkf_dosyalar['profil_degistir']; ?>"><?php echo $lmenu['duzenle']; ?></a></li>
<li role="menuitem"><a href="<?php echo $alt_dizin.$phpkf_dosyalar['sifre_degistir']; ?>"><?php echo $lmenu['sifre']; ?></a></li>
</ul>
</li>

<li role="menuitem"><a href="<?php echo $alt_dizin.$phpkf_dosyalar['ozel_ileti']; ?>"><?php echo $lmenu['ozel']; ?></a></li>


<?php if ($TEMA_UYE_BILGI['yetki'] == 1): // yönetici ise ?>
<li role="menuitem"><a href="<?php echo $cms_dizin; ?>phpkf-yonetim/index.php"><?php echo $lmenu['yonetim']; ?></a>
<ul class="dropdown-menu">
<li><a href="<?php echo $alt_dizin; ?>portal/yonetim.php"><?php echo $lmenu['portal']; ?></a></li>
</ul>
</li>
<?php endif;// yönetici koşul sonu ?>

<li role="menuitem"><a href="<?php echo $alt_dizin.$phpkf_dosyalar['cikis'].'?o='.$o; ?>" onclick="return window.confirm(jsl['cikis_uyari'])"><?php echo $lmenu['cikis']; ?></a></li>

<?php endif; // üye giriş koşul sonu ?>

</ul>


<a class="saga-yasla arama-button" onclick="aramaGoster('arama-alani');" href="javascript:void(0)">Ara</a>
<div class="arama-alani" id="arama-alani">
<form name="hizli_arama" action="<?php echo $alt_dizin.$phpkf_dosyalar['arama']; ?>" method="get" onsubmit="return denetle_arama()">
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

<?php endif; // Üyelik menüsü göster/gizle - koşul sonu ?>




<div id="site-baslik" class="site-baslik"><!-- site başlık baş -->
<div class="ic genislik">
<div class="baslikyazi sola-yasla"><?php echo $TEMA_LOGO_UST; ?></div>
<div class="baslikyazi saga-yasla"><?php echo $TEMA_LOGO_UST2; ?></div>
</div>
</div><!-- site başlık son -->



<nav id="genel-menu" class="genel-menu"><!-- genel menü baş -->
<div class="ic genislik">
<ul class="sola-yasla" role="menu">
<?php
// Menü linklerini tema.php tema dosyasındaki
// $tema_ozellik_genel_menu[] dizi değişkeninden değiştirebilirsiniz.
echo $TEMA_MENU;
?>
</ul>
</div>
</nav><!-- genel menü son -->


</header><!-- header bitiş -->


<div id="ana_govde" class="genislik">
<div class="menu-alt-bosluk"></div>

<table cellspacing="0" cellpadding="0" border="0" align="center" style="width:100%">
<tr>
<td align="center">{KURULUM_KLASORU}</td>
</tr>
</table>

<?php echo $baslik_en_alt; ?>
