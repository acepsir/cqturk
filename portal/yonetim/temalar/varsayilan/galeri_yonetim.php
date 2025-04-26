<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Galeri Yönetim</div>
<div class="kutu-icerik">

{JAVA_SCRIPT}

<table cellspacing="1" width="100%" cellpadding="0" border="0" align="center" bgcolor="#dddddd">
<tr>
<td class="forum_baslik" align="center" colspan="7">
{KATEGORI_EKLE}
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="7">
<form action="{YENI_DAL_EKLE_SAYFASI}" method="post" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">

<tr>
<td class="liste-veri" bgcolor="white"  width="23%" nowrap="nowrap">
<b>{KATEGORI_EKLE} :</b>
</td>
<td bgcolor="white" width="30%">
<input class="formlar" type="text" name="dal_adi" size="27"  value="">
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
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="7">
<form action="{DAL_SIL_SAYFASI}" method="post" name="form2">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" bgcolor="white" width="23%" nowrap="nowrap">
<b>{KATEGORIYI_SIL} :</b>
</td>
<td bgcolor="white" width="30%">
<select name="id" id="liste_veri">
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
<td class="forum_baslik" align="center" colspan="7">
{ONAY_BEKLEYEN}
</td>
</tr>

<!--__KOSUL_BASLAT-2__-->
<tr>
<td valign="middle" height="70" align="center" bgcolor="white" width="20%" colspan="7" class="liste-veri">
<b>{BEKLEYEN_YOK}</b>
</td>
</tr>
<!--__KOSUL_BITIR-2__-->
<!--__KOSUL_BASLAT-1__-->
<!--__TEKLI_BASLAT-2__-->
<tr>
<td valign="top" height="130" align="center" bgcolor="white" width="20%">
<a href="" OnClick="sayfa_ac('{RESIM}'); return false;">
<img style="cursor: url(./temalar/varsayilan/resimler/resimler/yakinlastir.cur), pointer;" width="130" height="130" src="{RESIM}" alt="{RESIM}" border="1" class="cizgi_renk"></a>
</td>
<td class="liste-veri" align="left" valign="top" bgcolor="white">
<br><b>{RESIM_ADI} :</b> {ISIM}
<br><b>{EKLEME_TARIHI} :</b> {TARIH}
<br><b>{BOYUT1} :</b> {BOYUT}
<br><b>{EKLEYEN1} :</b> {EKLEYEN}
<br><b>{ACIKLAMA1} :</b> <br>{ACIKLAMA}
</td>
<td class="liste-veri" align="center" valign="middle" bgcolor="white" width="20%">
<b><a href="{ONAYLA_SAYFASI}">{ONAYLA}</a><br><br><a href="{ONAYLAMA_SIL_SAYFASI}" onclick="return confirm('{SIL_UYARISI}');">{ONAYLAMA}</a></b>
</td>
</tr>

<!--__TEKLI_BITIR-2__-->
<tr>
<td align="center" colspan="4" valign="middle" id="sayfalama_cubuk">
{SAYFALAMA}
</td>
</tr>
<!--__KOSUL_BITIR-1__-->
</table>

</div>
