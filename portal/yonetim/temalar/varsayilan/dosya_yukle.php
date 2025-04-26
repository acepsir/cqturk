<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Dosya Yükleme</div>
<div class="kutu-icerik">

<div class="genel-tablo" style="box-sizing:border-box; display:table; width:808px" id="tablo_buyut3">

<table cellspacing="0" cellpadding="0" border="0" align="center" id="tablo_buyut" style="width:100%">
<tr>
<td class="forum_baslik" align="center" width="30%">
{KATEGORI_EKLE}
</td>
</tr>

<tr>
<td class="alt_haber" height="30" align="left" style="padding: 3px; margin: 3px;">

<form action="{KATEGORI_EKLE_SAYFASI_1}" method="post" name="form3">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">

<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" nowrap="nowrap"  align="left" width="30%">
<b>{KATEGORI_EKLE} :</b>
</td>
<td align="left" width="35%">
<input class="formlar" type="text" name="kategoriadi" size="27" value="">
</td>
<td align="left" width="35%">
<input class="dugme" name="Kekle" type="submit" value="{KATEGORI_EKLE}">
</td>
</tr>
</table>
</form> 
</td>
</tr>

<tr>
<td class="alt_haber" height="30" align="left" style="padding: 3px; margin: 3px;">
<form action="{KATEGORI_SIL_SAYFASI_1}" method="post" name="form2">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">

<tr>
<td class="liste-veri" nowrap="nowrap" align="left" width="30%">
<b>{SILINECEK_KATEGORI}:</b>
</td>
<td style="padding: 10px; margin: 3px;" align="left" width="35%">
<select name="kategorino" class="liste-veri">
<option value="0">----- {SILINECEK_KATEGORI} -----</option>

{SECENEKLER}

</select>
</td>
<td align="left" width="35%">
<input class="dugme" name="Ksil" type="submit" value="{KATEGORIYI_SIL}" onclick="return confirm('{SIL_UYARISI2}');">
</td>
</tr> 
</table>
</form> 
</td>
</tr>


<tr>
<td class="forum_baslik" align="center">
{DOSYA_EKLE}
</td>
</tr>
<tr>
<td class="alt_haber" height="30" align="left">
<form enctype="multipart/form-data" action="{DOSYA_EKLE_SAYFASI_1}" method="post" name="duzenleyici_form" id="duzenleyici_form" onsubmit="return denetle_yazi(), yukle('BLS')">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<input type="hidden" name="ifade" value="1">

<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center">

<tr>
<td class="liste-veri" style="padding: 10px; margin: 3px;" align="left" width="130">
<b>{KATEGORI_SEC} :</b>
</td>
<td style="padding: 10px; margin: 3px;" align="left">
<select name="kategorino" class="liste-veri">

{SECENEKLER2}

</select>
</td>
</tr>

<tr>
<td class="liste-veri" nowrap="nowrap" style="padding: 10px; margin: 3px;" align="left">
<b>{DOSYA_BASLIK} :</b>
</td>
<td style="padding: 10px; margin: 3px;" align="left">
<input class="formlar" type="text" name="dosya_baslik" size="50"  value="">
</td>
</tr>   

<tr>
<td class="liste-veri" nowrap="nowrap" style="padding: 10px; margin: 3px;" align="left">
<b>{DOSYA_BOYUTU} :</b>
</td>
<td style="padding: 10px; margin: 3px;" align="left">
<font face="Verdana" style="font-size: 10px;">{ORNEK}</font><br>
<input class="formlar" type="text" name="dosya_boyutu" size="50"  value="">
</td>
</tr> 

<tr>
<td class="liste-veri" nowrap="nowrap" style="padding: 10px; margin: 3px;" align="left">
<b>{URETICI} :</b>
</td>
<td style="padding: 10px; margin: 3px;" align="left">
<input class="formlar" type="text" name="uretici" size="50"  value="">
</td>
</tr> 


<tr>
<td class="liste-veri" nowrap="nowrap" style="padding: 10px; margin: 3px;" align="left">
<b>{KULLANIM} :</b>
</td>
<td style="padding: 10px; margin: 3px;" align="left">
<select name="kullanim" class="liste-veri">
<option value="FREEWARE/Ücretsiz">{FREEWARE/Ucretsiz}</option>
<option value="SOFTWARE/Ücretli">{SOFTWARE/Ucretli}</option>
<option value="SHAREWARE/Deneme">{SHAREWARE/Deneme}</option>
</select>
</td>
</tr> 
<tr>
<td class="liste-veri" nowrap="nowrap" style="padding: 10px; margin: 3px;" align="left">
<b>{RESIM} :</b>
</td>
<td style="padding: 10px; margin: 3px;" align="left">
<input class="formlar" type="text" name="resim" size="50"  value="portal/resimler/prog_resimleri/varsayilan.png">
</td>
</tr> 

<tr>
<td class="liste-veri" nowrap="nowrap" style="padding: 10px; margin: 3px;" align="left">
<b>{DIL} :</b>
</td>
<td style="padding: 10px; margin: 3px;" align="left">
<input class="formlar" type="text" name="dil" size="50"  value="">
</td>
</tr> 


<tr>
<td class="liste-veri" style="padding: 10px; margin: 0px;" align="left">
<b>{DOSYA_YUKKLEE} :</b>
</td>
<td class="liste-veri" align="left">
<label style="cursor:pointer"><input type="radio" checked="checked" name="dup" style="width:25px" value="" onclick="gizle_goster('alan1','alan2')">{DOSYA_YUKKLEE2}</label>
</td>
</tr>

<tr>
<td class="liste-veri" align="left" style="padding: 10px; margin: 0px;">
<b>{DOSYA_EKKLE} :</b>
</td>
<td class="liste-veri" align="left">
<label style="cursor:pointer"><input type="radio" name="dup" style="width:25px" value="" onclick="gizle_goster('alan2','alan1')">{DOSYA_EKKLE2}</label>
</td>
</tr>

<tr>
<td class="liste-veri" align="left" style="padding: 10px; margin: 3px;">
</td>

<td class="liste-veri" align="left" height="90">
<div id="alan1" style="display:inline; visibility:visible">
<input class="formlar" type="file" name="dup" size="35" style="width:373px">
&nbsp; {AZAMI_BOYUT} 2MB.
</div>

<div id="alan2" style="display:none; visibility:hidden">
<input class="formlar" type="text" name="ekle" size="35" value="http://" style="width:373px">
&nbsp; {AZAMI_BOYUT} 2MB.
</div>
</td>
</tr> 

<tr>
<td class="liste-veri" nowrap="nowrap" style="padding: 10px; margin: 3px;" align="left" valign="top"  rowspan="5">
<br>
<b>{DOSYA_ACIKLAMA} :</b><br><br>


<div  align="center">

<div align="center" style="font-weight: normal; font-size: 10px; position: relative; float: center; overflow: auto; width: 130px; height: 130px;"><?php echo ifade_olustur('4'); ?></div>

<br>
<br>
{HTML}<br>
{BBCODE}

</div>
</td>


<td class="liste-etiket" valign="top" colspan="2" id="tablo_buyut2">
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
<td height="23" class="liste-etiket" align="left" colspan="4">
{JAVA_SCRIPT}
<div align="left">

{BBCODE_SONUCU}

</div>
<br>
</td>
</tr>
<tr class="liste-etiket" align="center">
<td align="center" width="100%" colspan="4" id="BLS">
</td>
</tr>
<tr class="liste-etiket">
<td align="center" colspan="4" style="padding: 10px; margin: 3px;">
<input class="dugme" name="ayarlari_kaydet1" type="submit" value="{GONDER}">
&nbsp; &nbsp; 
<input class="dugme" type="reset" name="temizle1" value="{TEMIZLE}">
<br>
<br>
</td>
</tr>
</table>

</form>
</td>
</tr>
</table>

</div>
</div>
