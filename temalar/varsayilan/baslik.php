<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<title>{SAYFA_BASLIK}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php echo $meta_etiketler; ?>
<link rel="canonical" href="<?php echo $meta_canonical; ?>" />
<link href="temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
{RSS_SATIRI}
{CSS_SATIRI}
<!--[if lt IE 8]>
<link href="temalar/varsayilan/sablon_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<header class="clearfix">

<nav class="sabit-menu"><!-- sabit menü baş -->
<div class="ic">
<ul class="sola-yasla">

<li class="klogo"><a href="index.php"></a></li>

<!--__KOSUL_BASLAT-2__-->
<li><a href="giris.php">Giriş</a></li>
<li><a href="kayit.php">Kayıt</a></li>
<!--__KOSUL_BITIR-2__-->

<!--__KOSUL_BASLAT-1__-->

<li><a href="profil.php">Profil</a>
<ul class="dropdown-menu">
<li><a href="profil_degistir.php">Düzenle</a></li>
<li><a href="profil_degistir.php?kosul=sifre">Şifre</a></li>
</ul>
</li>

<li><a href="ozel_ileti.php">Özel ileti</a></li>


<!--__KOSUL_BASLAT-YONETIM__-->
<li><a href="yonetim/index.php">Yönetim</a>
<?php if (($cms_kullan == 1) OR ($portal_kullan == 1)): // CMS veya portal kullanılıyorsa ?>
<ul class="dropdown-menu">
<?php
if ($portal_kullan == 1) echo '<li><a href="portal/index.php">Portal</a></li>';
if ($cms_kullan == 1) echo '<li><a href="'.$cms_dizin.'phpkf-yonetim/index.php">CMS</a></li>';
?>
</ul>
<?php endif; ?>
</li>
<!--__KOSUL_BITIR-YONETIM__-->

<li><a href="cikis.php?o={O}" onclick="return window.confirm('Çıkış yapmak istediğinize emin misiniz?')">Çıkış</a></li>

<!--__KOSUL_BITIR-1__-->

</ul>



<a class="saga-yasla arama-button" onclick="aramaGoster('arama-alani');" href="javascript:void(0)">Ara</a>
<div class="arama-alani" id="arama-alani">
<form name="hizli_arama" action="arama.php" method="get" onsubmit="return denetle_arama()">
<input type="hidden" name="a" value="1">
<input type="hidden" name="b" value="1">
<input type="hidden" name="forum" value="tum">
<input type="hidden" name="tarih" value="tum_zamanlar">
<input type="text" value="Arama..." class="input" name="sozcuk_herhangi" maxlength="100" onfocus="HizliArama()" onblur="HizliArama()">
<button class="arama-dugme" type="submit">Ara</button>
</form>
</div>
</div>
</nav><!-- sabit menü son -->


<div id="site-baslik" class="site-baslik"><!-- site başlık baş -->
<div class="genislik">
<a href="index.php" class="sola-yasla baslikyazi" title="{SITE_BASLIK}"><?php echo $TEMA_LOGO_UST; ?></a>
</div>
<div class="clear"></div>
<!-- İKİNCİ LOGO
<div class="reklam-logo" style="position:absolute;top:50px;right:20px">
<a href="index.php"><img src="temalar/varsayilan/resimler/phpkf-b.png" style="border:1px solid #cbcbcb" /></a>
</div>
-->
</div><!-- site başlık son -->


<nav id="genel-menu" class="genel-menu"><!-- genel menü baş -->
<div class="ic genislik">
<ul class="sola-yasla" role="menu">

<?php // sadece forum kullanılıyorsa
if ( ($cms_kullan == 0) AND ($portal_kullan == 0) ):
?>
<li><a href="<?php echo $forum_index; ?>">Ana Sayfa</a></li>

<?php // hem cms hem de portal kullanılıyorsa
elseif ( ($cms_kullan == 1) AND ($portal_kullan == 1) ):
?>
<li><a href="<?php echo $cms_dizin.$cms_index; ?>">Ana Sayfa</a></li>
<li><a href="<?php echo $forum_index; ?>">Forum</a></li>
<li><a href="<?php echo $portal_index; ?>">Portal</a></li>

<?php // sadece cms kullanılıyorsa
elseif ($cms_kullan == 1):
?>
<li><a href="<?php echo $cms_dizin.$cms_index; ?>">Ana Sayfa</a></li>
<li><a href="<?php echo $forum_index; ?>">Forum</a></li>

<?php // sadece portal kullanılıyorsa
elseif ($portal_kullan == 1):
?>
<li><a href="<?php echo $portal_index; ?>">Ana Sayfa</a></li>
<li><a href="<?php echo $forum_index; ?>">Forum</a></li>

<?php endif; // CMS, portal link koşulları - sonu ?>

<li><a href="bbcode_yardim.php">Yardım</a></li>
<li><a href="uyeler.php">Üyeler</a></li>

<!--__KOSUL_BASLAT-10__-->
<li><a href="arama.php">Arama</a></li>
<li><a href="cikis.php?o={O}" onclick="return window.confirm('Çıkış yapmak istediğinize emin misiniz?')">Çıkış</a></li>
<!--__KOSUL_BITIR-10__-->

</ul>
</div>
</nav><!-- genel menü son -->


</header><!-- header bitiş -->


<div id="ana_govde" class="genislik">
<div class="menu-alt-bosluk"></div>

<!--__KOSUL_BASLAT-5__-->
<!--__TEKLI_BASLAT-1__-->
<table cellspacing="1" width="100%" cellpadding="0" border="0" align="center" bgcolor="#d0d0d0" style="margin-bottom:20px">
	<tr>
	<td class="forum-kategori-baslik" align="left" valign="middle">
{DUYURU_BASLIK}
	</td>
	</tr>

	<tr>
	<td class="blok-icerigi" bgcolor="#ffffff" align="left">
{DUYURU_ICERIK}
	</td>
	</tr>
</table>
<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-5__-->

{BASLIK_EN_ALT}
