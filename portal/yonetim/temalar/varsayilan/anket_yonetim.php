<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">{ANKET_AYARLARI}</div>
<div class="kutu-icerik">


<table cellspacing="1" width="100%" cellpadding="0" border="0" align="right" bgcolor="#dddddd">
<tr>
<td class="forum_baslik" align="center" colspan="4">
{ANKET_AYARLARI}
</td>
</tr>


<!--__KOSUL_BASLAT-1__-->
<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
<form action="{ANKET_DUZENLE2_SAYFASI_1}"  method="post" name="form3">
<input type="hidden" name="anketno" value="{ANKET_NO}">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td align="left" style="background-color: #ffffff; padding: 9px; margin: 3px;" height="30" class="liste-veri" bgcolor="#ffffff"><b>{ANKET_SORUSU} :</b>
</td>
<td align="left" style="background-color: #ffffff; padding: 9px; margin: 3px;" height="30">
<input type="text" class="formlar" name="anket_soru"  size="20"  value="{ANKET_SORUSU_SONUCU}" style="background:url(resimler/resimler/form2.png) norepeat;">
</td>
<td  align="left" style="background-color: #ffffff; padding: 9px; margin: 3px;" height="30" valign="middle">
<br>
<input class="dugme" name="secenek2" type="submit" value="{ANKETI_DUZENLE}">
</td>
</tr>


<!--__KOSUL_BASLAT-3__-->
<tr>
<td align="left" style="background-color: #ffffff; padding: 9px; margin: 3px;" height="30" class="liste-veri" bgcolor="#ffffff"><b>Forum yeri :</b>
</td>
<td align="left" style="background-color: #ffffff; padding: 9px; margin: 3px;" height="30">
<input type="text" class="formlar" name="forum_yer"  size="20"  value="{FORUM_YERI}">
</td>
<td  align="center" style="background-color: #ffffff; padding: 9px; margin: 3px;" height="30" valign="middle">&nbsp;</td>
</tr>

<tr>
<td align="left" colspan="3" style="background-color: #ffffff; padding: 9px; margin: 3px;" valign="top">
<br>

Anketin forumdaki yerini <b>Forum yeri :</b> kısmına girin.
<br>Forumda görünmesini istemiyorsanız boş bırakın.
<br><br>Tüm forum sayfalarında görünmesi için <b>tum</b> yazın.
<br>Sadece istenilen forumda görünmesi için, mesela forum numarası 99 ise <b>f-99</b> yazın.
<br>Sadece istenilen konuda görünmesi için, mesela konu numarası 26 ise <b>k-26</b> yazın.
<br>
<br>
</td>
</tr>
<!--__KOSUL_BITIR-3__-->


</table>
</form>
</td>
</tr>

<!--__TEKLI_BASLAT-1__-->
<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
<form action="{ANKET_DUZENLE_SAYFASI_1}"  method="post" name="form4">
<input type="hidden" name="anketno" value="{S_ANKET_NO}">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td align="center" style="background-color: #ffffff; padding: 9px; margin: 3px;">
<input type="text" class="formlar" name="secenek"  size="20"  value="{SECENEK}{UYARI}" style="background:url(resimler/resimler/form2.png) norepeat;" {KILIT2}>
</td>
<td align="center" style="background-color: #ffffff; padding: 9px; margin: 3px;">
<input class="dugme" name="secenek1" type="submit" value="{SECENEK_DUZELT}" {KILIT2}>
</td>
<td align="center" style="background-color: #ffffff; padding: 9px; margin: 3px;">
<a href="{ANKET_SIL_SAYFASI_1}" onclick="return confirm('{SECENEK_SIL_UYARI}');">{SECENEK_SIL}</a>
</td>
</tr>
</table>
</form>
</td>
</tr>
<!--__TEKLI_BITIR-1__-->

<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
<form action="{YORUM_AC_KAPA}"  method="post" name="form33">
<input type="hidden" name="anketno" value="{ANKET_NO}">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" align="center" style="background-color: #ffffff; padding: 9px; margin: 3px;" nowrap="nowrap">
<b>{YORUM} : </b>
</td>
<td class="liste-veri" align="center" style="background-color: #ffffff; padding: 9px; margin: 3px;">
{YORUM_SONUCU}
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="2" height="50" align="center">
<input class="dugme" type="submit" name="ayar_degistir" value="{DEGISTIR}">
</td>
</tr>
</table>
</form>
</td>
</tr>


</table>
</td>
</tr>
</table>
</table>
<tr>
<td align="left" class="liste-veri" colspan="10">
<br>
<br>
<br>
</td></tr></table>
</td></tr></table>
</table>
</table>
</table>
<!--__KOSUL_BITIR-1__-->


<!--__KOSUL_BASLAT-2__-->
<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
<form action="{SORU_EKLE_SAYFASI_1}" method="post" name="form">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
  <table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" width="25%" nowrap="nowrap">
<b>{ANKET_SORUSU} :</b>
</td><td style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="45%">
<input class="formlar" type="text" name="anket_soru" size="25" value="{SORU_EKLE}" style="background:url(resimler/resimler/form2.png) norepeat;">
</td><td style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="2" width="30%"><input class="dugme" name="anket_soru_ekle" type="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{SORU_EKLE}&nbsp;&nbsp;&nbsp;&nbsp;">
</td>
</tr>
</table>
</form>
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
<form action="{SECENEK_EKLE_SAYFASI_1}" method="post" name="form2">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="25%">
<b>{SECENEK_EKLE} :</b>
</td>
<td style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="45%">
<select name="anketno" class="liste-veri" {KILITLE}>

{SECENEK_DONGU1}

</select><br><br><input style="background:url(resimler/resimler/form2.png) norepeat;" class="formlar" type="text" name="secenek" size="25" value="{SECENEK_EKLE}" {KILITLE}>
</td><td style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="2" valign="middle" width="30%"><input class="dugme" name="ASeEkle" type="submit" value="&nbsp;{SECENEK_EKLE}&nbsp;&nbsp;" {KILITLE}>
</table>
</form>
</td>
</tr>


<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
<form action="{ANKET_SIL_SAYFASI_2}"  method="post" name="form3">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="25%">
<b>{ANKET_SİL} :</b>
</td>
<td style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="45%">
<select name="anketno" class="liste-veri" {KILITLE}>

{SECENEK_DONGU2}

</select>
</td><td style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="2" width="30%"><input class="dugme" name="Asil" type="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{ANKET_SİL}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="return confirm('{ANKET_SİL2}');" {KILITLE}>
</td>
</tr>
</table>
</form>
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
<form action="{ANKET_DUZENLE_SAYFASI_2}"  method="post" name="form4">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="25%">
<b>{ANKET_DUZENLE} :</b>
</td>
<td style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="45%">

<select name="anketno" class="liste-veri" {KILITLE}>

{SECENEK_DONGU3}

</select>
</td><td style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="2" width="30%"><input class="dugme" name="Aduzelt" type="submit" value="{ANKET_DUZENLE}"{KILITLE}>
</td>
</tr>
</table>
</form>
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
<form action="{ANKET_KAPAT_SAYFASI_1}"  method="post" name="form5">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="25%">
<b>{ANKETI_KAPAT} :</b>
</td>
<td style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="45%">

<select name="anketno" class="liste-veri" {K_KILITLE}>

{SECENEK_DONGU4}

</select>
</td><td style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="2" width="30%"><input class="dugme" name="Akapat" type="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{KAPAT}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="return confirm('{KAPAT2}');"{K_KILITLE}>
</td>
</tr>
</table>
</form>
</td>
</tr>

<tr>
<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
<form action="{ANKET_AC_SAYFASI_1}"  method="post" name="form6">
<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="25%">
<b>{ANKETI_AC} :</b>
</td>
<td style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" nowrap="nowrap" width="45%">

<select name="anketno" class="liste-veri" {A_KILITLE}>

{SECENEK_DONGU5}

</select>
</td><td style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="2" width="30%"><input class="dugme" name="Akapat" type="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{AC}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="return confirm('{AC2}');"{A_KILITLE}>
</td>
</tr>
</table>
</form>
</td>
</tr>

<tr class="forum_baslik" align="left">
<td width="1%"></td>
<td width="99%" colspan="3" align="center"><font color="#ffffff">{EKLENEN_ANKETLER}</font></td>
</tr>


<!--__TEKLI_BASLAT-6__-->

<tr>
<td style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left" width="1%">
<img src="temalar/{TEMA_DIZINI}/resimler/resimler/anket_soru.gif" alt="" border="0">
</td>
<td style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="3" align="left">{ANKET_SORU}
<br>
</td>
</tr>

<!--__TEKLI_BITIR-6__-->

</table>


<!--__KOSUL_BITIR-2__-->

</div>
