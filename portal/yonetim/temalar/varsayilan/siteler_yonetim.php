<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Favori Siteler</div>
<div class="kutu-icerik">


<table cellspacing="1" width="100%" cellpadding="0" border="0" align="center" bgcolor="#dddddd">
<tr>
<td class="forum_baslik" align="center" colspan="3">
{KATEGORI_EKLE}
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="3">
<form action="{YENI_DAL_EKLE_SAYFASI}" method="post" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">

<tr>
<td class="liste-veri" bgcolor="white"  width="23%" nowrap="nowrap">
<b>{KATEGORI_EKLE} :</b>
</td>
<td bgcolor="white" width="30%">
<input class="formlar" type="text" name="baslik" size="27"  value="">
</td>
<td bgcolor="white">
<input class="dugme" name="Kekle" type="submit" value="{KATEGORI_EKLE}">
</td>
</tr>
</table>
</form> 
</td>
</tr>


<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="3">
<form action="{DAL_SIL_SAYFASI}" method="post" name="form2">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" bgcolor="white" width="23%" nowrap="nowrap">
<b>{KATEGORIYI_SIL} :</b>
</td>
<td bgcolor="white" width="30%">
<select name="dal_no" id="liste_veri">
<option value="0">----- {SILINECEK_KATEGORI} -----</option>

{SECENEKLER}

</select>
</td>
<td bgcolor="white">
<input class="dugme" name="Ksil" type="submit" value="{KATEGORIYI_SIL}" onclick="return confirm('{SIL_UYARISI}');">
</td>
</tr> 
</table>
</form> 
</td>
</tr>




<tr>
<td class="forum_baslik" align="center" colspan="3">
{ONAY_BEKLEYEN}
</td>
</tr>

<!--__KOSUL_BASLAT-2__-->
<tr>
<td valign="middle" height="70" align="center" bgcolor="white" width="20%" colspan="3" class="liste-veri">
<b>{BEKLEYEN_YOK}</b>
</td>
</tr>
<!--__KOSUL_BITIR-2__-->
<!--__KOSUL_BASLAT-1__-->
<!--__TEKLI_BASLAT-2__-->
<tr class="liste-veri" align="center" bgcolor="white">
<td align="center" valign="top">

<table class="alt_haber" width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
<tr>
<td align="left" width="40%" valign="top">
<br><b>{SITE_ADI} :</b> {ISIM}
<br><b>{EKLEME_TARIHI} :</b> {TARIH}
<br><b>{ACIKLAMA1} :</b> {ACIKLAMA}
</td>
<td align="left" width="60%" valign="top">
<div style="float:right" align="left">
<br><b>{ADRES} :</b> <a target="_blank" href="{ADRES2}">{ADRES2}</a>
<br><b>{EKLEYEN1} :</b> {EKLEYEN}</div>
</td>
<td align="left" width="100%" rowspan="2" valign="middle">
<a href="{ONAYLA_SAYFASI}">{ONAYLA}</a><br><br><a href="{ONAYLAMA_SIL_SAYFASI}" onclick="return confirm('{SIL_UYARISI}');">{ONAYLAMA}</a>
</td>
</tr>
<tr>
<td align="center" width="100%" colspan="2">
<a target="_blank" href="{ADRES2}"><img src="{SITE_RESIM}" alt="{SITE_RESIM}" border="1" width="468" height="60"></a>
</td>
</tr>
</table>
</td>
</tr>

<!--__TEKLI_BITIR-2__-->
<tr>
<td align="center" valign="middle" id="sayfalama_cubuk">
{SAYFALAMA}
</td>
</tr>
<!--__KOSUL_BITIR-1__-->
</table>

</div>
