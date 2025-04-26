<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">{YENI_BLOK_OLUSTUR}</div>
<div class="kutu-icerik">

<div class="genel-tablo" style="box-sizing:border-box; display:table; width:790px" id="tablo_buyut3">

<table cellspacing="0" cellpadding="0" border="0" align="center" id="tablo_buyut" style="width:100%">
<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="3">
<form action="{ACTION}" method="post" name="duzenleyici_form" id="duzenleyici_form" onsubmit="return denetle_yazi()">
<input type="hidden" name="bbcode_kullan" value="1">
<input type="hidden" name="ifade" value="1">
<input type="hidden" name="sayfa_no" value="{SAYFA_NO}">
<input type="hidden" name="uzanti" value=".html">

<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">

<tr>
<td class="liste-veri" bgcolor="white" width="110" height="30" align="left">
<b>{GORUNECEK_BASLIK} :&nbsp;</b>
</td>
<td  bgcolor="white" class="liste-veri" align="left" colspan="2">
<input class="formlar" type="text" name="baslik" size="35"  value="{BASLIK}" maxlength="50">
</td>
</tr>
<tr>
<td class="liste-veri" bgcolor="white" width="110" height="30" align="left">
<b>{DOSYA_ADI22} :&nbsp;</b>
</td>
<td bgcolor="white" class="liste-veri" align="left" colspan="2">
<input class="formlar" type="text" name="dosya_adi" size="35"  value="{DOSYA_ADI}" maxlength="50">
{UZANTI_2}: .html
</td>
</tr>
<!--__KOSUL_BASLAT-1__-->
<tr>
<td class="liste-veri" bgcolor="white" width="110" height="30" align="left">
<b>{BLOK_YERI} : &nbsp;</b>
</td>
<td  bgcolor="white" class="liste-veri" align="left" colspan="2">
<select name="yer" class="formlar">
<option value="3">{SAG}</option>
<option value="1">{SOL}</option>
</select>
</td>
</tr>
<!--__KOSUL_BITIR-1__-->


<tr>
<td colspan="2" height="5"></td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" width="110" height="30" valign="top" align="left">
<b>{BLOK_KODLARI} :</b>
<br><br>
<br><br>
HTML Açık<br>
BBCode Kapalı
</td>


<td class="liste-etiket" valign="top" colspan="2" id="tablo_buyut2">
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
<td class="liste-veri" bgcolor="white" height="30" valign="top" align="left">
&nbsp;
</td>
<td class="liste-veri" bgcolor="white" height="30" valign="top" align="center">
<br>
&nbsp;<input class="dugme" name="yukle" type="submit" value="{BLOK_OLUSTUR}">
&nbsp;<input class="dugme" name="temizle" type="reset" value="{BLOK_TEMIZLE}">
<br>
<br>
</td>
</tr>
</table>
</form>

</td></tr></table>

</div>
</div>
