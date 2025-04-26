<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">{DOSYA_AYARLARI}</div>
<div class="kutu-icerik">

<div class="genel-tablo" style="box-sizing:border-box; display:table; width:814px" id="tablo_buyut3">

<table cellspacing="0" cellpadding="0" border="0" align="center" id="tablo_buyut" style="width:100%">
<tr>
<td class="alt_haber" bgcolor="white" height="30" align="left" style="background-color: #ffffff; padding: 3px; margin: 3px;">
<form action="{AYARLARI_KAYDET_SAYFASI_1}" method="post" name="duzenleyici_form" id="duzenleyici_form" onsubmit="return denetle_yazi()">
<input type="hidden" name="no" value="{NO}">
<input type="hidden" name="ifade" value="1">

<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff">
<tr>
<td style="padding: 10px; margin: 3px;" align="left" nowrap="nowrap" width="130">
<b>{DOSYA_ADI} :</b>&nbsp;</td>
<td style="padding: 10px; margin: 3px;" align="left">
<input class="formlar" type="text" name="dosya_baslik" size="50"  value="{DOSYA_ADI_SONUCU}">
</td>
</tr>

<tr>
<td  class="liste-veri" style="padding: 10px; margin: 3px;" align="left" nowrap="nowrap">
<b>{DOSYA_ASRESI} :</b>&nbsp;<br><i><font size="1">{DEGISTIRILEMEZ} !</font></i></td><td  style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left"><input disabled="disabled" class="formlar" type="text" name="dosya_adresi" size="50"  value="{DOSYA_ADRESI_SONUCU}">
</td>
</tr>
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left" nowrap="nowrap">
<b>{URETICI_FIRMA} :</b>
</td><td  style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left">
<input class="formlar" type="text" name="uretici" size="50"  value="{URETICI_FIRMA_SONUCU}">
</td>
</tr> 

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left">
<b>{KULLANIM}:</b>
</td>
<td  style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left">
<select name="kullanim" class="liste-veri">
<option value="{KULLANIM_SONUCU}">{KULLANIM_SONUCU}</option>
<option value="{KULLANIM_SONUCU}">--------------------</option>
<option value="FREEWARE/Ücretsiz">{FREEWARE/Ucretsiz}</option>
<option value="SOFTWARE/Ücretli">{SOFTWARE/Ucretli}</option>
<option value="SHAREWARE/Deneme">{SHAREWARE/Deneme}</option>
</select>
</td>
</tr> 

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left" nowrap="nowrap">
<b>{RESIM} :</b>
</td><td  style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left">
<input class="formlar" type="text" name="resim" size="50"  value="{RESIM_SONUCU}">
</td>
</tr> 

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left" nowrap="nowrap">
<b>{DIL} :</b>
</td><td  style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left">
<input class="formlar" type="text" name="dil" size="50"  value="{DIL_SONUCU}">
</td>
</tr> 

<tr>
<td nowrap="nowrap" class="liste-veri" style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left">
<b>{DOSYA_BOYUTU} :</b>&nbsp;</td><td  style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left">
<font face="Verdana" style="font-size: 10px;">{ORNEK}</font><br>
<input class="formlar" type="text" name="dosya_boyutu" size="50"  value="{DOSYA_BOYUTU_SONUCU}">
</td>
</tr>

<tr>
<td nowrap="nowrap" class="liste-veri" style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left">
<b>{KATEGORI_SEC} :</b>
</td>
<td style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left" >
<select name="kategorino" class="liste-veri">
<option value="0">----- {KATEGORI_SEC} -----</option>

{KATEGORI_SONUCU}

</select>
</td>
</tr> 

<tr>
<td nowrap="nowrap" class="liste-veri"  style="background-color: #ffffff; padding: 10px; margin: 3px;" align="left" valign="top"  rowspan="5">
<br>
<b>{DOSYA_ACIKLAMA} :</b><br><br>

<div align="center">

<div align="center" style="font-weight: normal; font-size: 10px; position: relative; float: center; overflow: auto; width: 130px; height: 130px;"><?php echo ifade_olustur('4'); ?></div>

<br>
<br>
{HTML}<br>
{BBCODE}

</div>
</td>


<td class="liste-etiket" valign="top" colspan="2" id="tablo_buyut2">
<br>
<?php
$duzenleyici_dizin = '../';

// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="70" rows="20" name="mesaj_icerik" id="mesaj_icerik" class="post">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
$duzenleyici = $ayarlar['bduzenleyici'];
include_once('../phpkf-bilesenler/editor/index.php');
?>
</td>
</tr>

<tr>
<td height="23" class="liste-etiket" style="background-color: #ffffff;" align="left" colspan="4">
<div align="left"><br>{BBCODE_SONUCU}</div>
<br>
</td>
</tr>

<tr class="liste-etiket">
<td align="center" colspan="4">
<input class="dugme" name="ayarlari_kaydet1" type="submit" value="{GONDER}">
&nbsp; &nbsp; 
<input class="dugme" type="reset" name="temizle1" value="{TEMIZLE}">
<br>
<br>
</td>
</tr>
</table>
</form>


</td></tr></table>

</div>
</div>
