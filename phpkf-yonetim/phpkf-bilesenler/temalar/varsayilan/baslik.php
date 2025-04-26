<?php if (!defined('PHPKF_ICINDEN')) exit(); ?>
<!DOCTYPE html>
<html <?php echo $TEMA_HTML_DIL; ?>>
<head>
<title><?php echo $ly['yonetim'].' '; phpkf_tema_title(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../phpkf-bilesenler/temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<link href="../phpkf-bilesenler/temalar/varsayilan/css/sablon.css" rel="stylesheet" type="text/css">
<link href="phpkf-bilesenler/temalar/varsayilan/css/yonetim.css" rel="stylesheet" type="text/css">
<!--[if lt IE 8]>
<link href="phpkf-bilesenler/temalar/varsayilan/css/yonetim_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php phpkf_tema_css(); ?>
<script src="../phpkf-bilesenler/diller/<?php echo $site_dili_js; ?>/javascript.js"></script>
<script src="../phpkf-bilesenler/js/phpkf-jsk.js"></script>
<script src="../phpkf-bilesenler/js/islemler.js"></script>
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

<?php if ($forum_kullan == 1): // forum kullanılıyorsa ?>
<li role="menuitem"><a href="<?php echo $forum_dizin.$phpkf_dosyalar['ozel_ileti']; ?>"><?php echo $lmenu['ozel']; ?></a></li>
<?php endif; // forum koşul sonu ?>

<?php if ($TEMA_UYE_BILGI['yetki'] == 1): // yönetici ise ?>

<li role="menuitem"><a href="index.php"><?php echo $lmenu['yonetim']; ?></a>
<?php if ($portal_kullan == 1): // portal kullanılıyorsa ?>
<ul class="dropdown-menu">
<li><a href="<?php echo $forum_dizin; ?>portal/yonetim.php"><?php echo $lmenu['portal']; ?></a></li>
</ul>
<?php endif; // portal koşul sonu ?>
</li>

<?php endif;// yönetici koşul sonu ?>

<li role="menuitem"><a href="../<?php echo $phpkf_dosyalar['cikis'].'?o='.$o; ?>" onclick="return window.confirm(jsl['cikis_uyari'])"><?php echo $lmenu['cikis']; ?></a></li>

<?php endif; // üye giriş koşul sonu ?>

</ul>
<a class="saga-yasla arama-button" onClick="aramaGoster('arama-alani');" href="javascript:void(0);">Ara</a>
<div class="arama-alani" id="arama-alani">
<form name="arama_formu" action="../<?php echo $arama_adres; ?>" method="get" onsubmit="return aramaYap(this, 'arama', <?php echo $arama_seo; ?>)">
<input class="input" name="arama" maxlength="100" placeholder="<?php echo $lmenu['arama']; ?>..." type="text" required />
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
