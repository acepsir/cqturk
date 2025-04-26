<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">{SAYFA_AYARLARI2}</div>
<div class="kutu-icerik">


<table cellspacing="5" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="100%">
<tr>
<td align="center" colspan="2">
<form action="{AYARLARI_KAYDET_SAYFASI_1}" method="post" onSubmit="return denetle()" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<table cellspacing="1" width="100%" cellpadding="0" border="0" align="right" bgcolor="#dddddd">
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{SOL_BLOKLAR} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{SOL_BLOKLAR_SONUCU}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{SAG_BLOKLAR} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{SAG_BLOKLAR_SONUCU}
</td>
</tr>
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="2" height="50" align="center">
<input class="dugme" type="submit" name="ayar_degistir" value="{GONDER}">
 &nbsp; &nbsp; &nbsp;
<input class="dugme" type="reset" name="temizle" value="{TEMIZLE}">
<br><br>
</td>
</tr>
<tr>
<td class="liste-etiket" style="background-color: #ffffff; padding: 4px; margin: 3px;" colspan="2" height="40" align="center">
<a href="ozel_blok_yonetim.php">{YENI_BLOK_EKLE}</a>
</td>
</tr>
</table>
</form>

</td>
</tr>
<tr>
<td align="center" valign="top">
<table cellspacing="1" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff" class="bloklar_yonetim_cizgi_renk">



<tr>
<td align="center" class="ana_forum_baslik">
{SOL_BLOKLAR2}
</td>
</tr>
<tr>
<td align="center" class="bloklar_alt">
{TABLO}
</td>
</tr>
</table>
</td>
<td align="center" valign="top">
<table cellspacing="1" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff" class="bloklar_yonetim_cizgi_renk">
<tr>
<td align="center" class="ana_forum_baslik">
{SAG_BLOKLAR2}
</td>
</tr>
<tr>
<td align="center" class="bloklar_alt">
{TABLO2}
</td>
</tr>
</table>
</td>
</tr>
</table>

</div>
