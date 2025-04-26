<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Özel Sayfalar</div>
<div class="kutu-icerik">

<div class="genel-tablo" style="box-sizing:border-box; display:table; width:806px" id="tablo_buyut3">

<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center" id="tablo_buyut" style="width:100%">
<tr>
<td align="center" colspan="3">
<!--__KOSUL_BASLAT-1__-->
<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center" bgcolor="#dddddd">
<tr>
<td class="forum_baslik" align="center" colspan="3">
<b>
{SAYFA_DUZELT_SIL}
</b>
</td>
</tr>

<tr>
<td height="30" align="left" colspan="3" bgcolor="white">
<font face="Verdana" style="font-size: 9pt;">
<br>
{ACIKLAMA1}
</font>
<br>
<br>
</td>
</tr>


<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="3">
<form action="sayfa_yonetim.php?kosul=duzelt" method="post" name="form_duzelt">

<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" bgcolor="white" nowrap="nowrap" height="30" align="left" width="35%">
<b>{SAYFA_DUZELT} : &nbsp;</b>
</td>
<td  bgcolor="white" class="liste-veri" align="left" width="35%">
<select name="duzelt" class="formlar" {KILITLE}>
{DEGER}
</select>
</td>
<td  bgcolor="white" class="liste-veri" align="left" width="30%">
&nbsp;<input class="dugme" name="yukle" type="submit" value="{DUZELT}" {KILITLE}>
</td>
</tr>
</table>
 
</form>
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="3">
<form action="sayfa_yonetim.php?kosul=sil" method="post" name="form_duzelt">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" bgcolor="white" nowrap="nowrap" height="30" align="left" width="35%">
<b>{SAYFA_SIL} : &nbsp;</b>
</td>
<td  bgcolor="white" class="liste-veri" align="left" width="35%">
<select name="sil" class="formlar" {KILITLE}>
{DEGER2}
</select>
</td>
<td  bgcolor="white" class="liste-veri" align="left" width="30%">
&nbsp;<input class="dugme" name="yukle" type="submit" value="{SIL}" onclick="return confirm('{SIL_UYARI}');" {KILITLE}>
</td>
</tr>
</table>
</form>
</td>
</tr>
</table>
<!--__KOSUL_BITIR-1__-->
</td>
</tr>


<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="3">
<form action="{ACTION}" method="post" name="duzenleyici_form" id="duzenleyici_form" onsubmit="return denetle_yazi()">
<input type="hidden" name="bbcode_kullan" value="1">
<input type="hidden" name="ifade" value="1">
<input type="hidden" name="sayfa_no" value="{SAYFA_NO}">
<input type="hidden" name="uzanti" value=".html">

<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center" bgcolor="#dddddd">
<tr>
<td class="forum_baslik" align="center" colspan="3">
<b>
{YENI_SAYFA_OLUSTUR}
</b>
</td>
</tr>
<tr>
<td height="30" align="left" colspan="3" bgcolor="white">
<font face="Verdana" style="font-size: 9pt;">
<br>
<br>
{ACIKLAMA2}
</font>
<br>
<br>
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="100" height="30" align="left">
<b>{GORUNECEK_BASLIK} :&nbsp;</b>
</td>
<td  bgcolor="white" class="liste-veri" align="left" colspan="2">
<input class="formlar" type="text" name="baslik" size="35"  value="{BASLIK}" maxlength="50">
</td>
</tr>
<tr>
<td class="liste-veri" bgcolor="white" width="100" height="30" align="left">
<b>{DOSYA_ADI22} :&nbsp;</b>
</td>
<td bgcolor="white" class="liste-veri" align="left" colspan="2">
<input class="formlar" type="text" name="dosya_adi" size="35"  value="{DOSYA_ADI}" maxlength="50">
.html
</td>
</tr>
<tr>
<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="100" height="30" align="left">
<b>{SAYFA_YERI} : &nbsp;</b>
</td>
<td  bgcolor="white" class="liste-veri" align="left" colspan="2">
<select name="yer" class="formlar">
{YER}
</select>
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="100" height="30" valign="top" align="left" rowspan="2">
<b>{SAYFA_ICERIGI} :</b>
<br><br>
<br>
HTML Açık<br>
BBCode Kapalı
</td>

<td class="liste-etiket" valign="top" colspan="2" bgcolor="white" id="tablo_buyut2">
<?php
$duzenleyici_dizin = '../';
$duzenleyici_bicim = 'html';

$duzenleyici = $ayarlar['duzenleyici'];
$duzenleyici_id = 'mesaj_icerik';

// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="70" rows="20" name="mesaj_icerik" id="mesaj_icerik" class="post">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
include_once('../phpkf-bilesenler/editor/index.php');
?>
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" height="60" align="center" valign="middle">
&nbsp;<input class="dugme" name="yukle" type="submit" value="{SAYFAYI_OLUSTUR}">
</td>
</tr>
</table>
</form>
</td></tr></table>

</div>
</div>
