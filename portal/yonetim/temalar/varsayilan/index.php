<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">{YONETIM_MASASI}</div>
<div class="kutu-icerik">

<table cellspacing="1" width="100%" cellpadding="0" border="0" align="center" bgcolor="#dddddd">
<tr>
<td align="left" class="liste-veri" style="background-color: #ffffff; padding: 15px; margin: 3px;" colspan="2" height="60">
<center>{HOSGELDINIZ}</center>
</td>
</tr>


<tr>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" width="30%" class="liste-veri" align="left">{PORTAL_SURUMU} :</td>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" width="70%" class="liste-veri" align="left">
	<div id="katman_surum1" style="float:left; width:105px; height: 15px; border:0px solid #000000">{PORTAL_SURUM_SONUCU}</div>
	<div id="katman_surum2" style="float:left; height: 15px; border:0px solid #000000">{PGS}</div>
</td>
</tr>

<tr>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{PHP_SURUMU} :</td>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{PHP_SURUM_SONUCU}</td>
</tr>

<tr>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{MYSQL_SURUMU} :</td>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{MYSQL_SURUM_SONUCU}</td>
</tr>

<tr>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{ZEND_SURUMU} :</td>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{ZEND_SURUM_SONUCU}</td>
</tr>

<tr>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{DOSYALAR_KLASORU_BOYUTU} :</td>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{DOSYALAR_KLASORU_BOYUTU_SONUCU}</td>
</tr>

<tr>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{GALERI_KLASORU_BOYUTU} :</td>
<td style="background-color: #ffffff; padding: 15px; margin: 3px;" class="liste-veri" align="left">{GALERI_KLASORU_BOYUTU_SONUCU}</td>
</tr>


<tr>
<td class="forum_baslik" bgcolor="#0099ff" align="center" colspan="2">
phpKF Duyuru Ekranı
</td>
</tr>

<tr>
<td align="left" class="liste-veri" bgcolor="#ffffff" colspan="2">
<br>
{PHPKF_DUYURU}
<br>
<br>
</td>
</tr>

<tr>
<td style="background-color: #ffffff;" class="liste-veri" align="center" colspan="2">
<br>
<br>
<b><u>{NOTLARIM}</u></b><br><br>
<form action="?kosul=not_kaydet" method="post" name="form1">
<textarea class="formlar" cols="71" rows="2" name="not_icerik" style="height: 150px;"><!--__TEKLI_BASLAT-not__-->{NOT_ICERIK}<!--__TEKLI_BITIR-not__--></textarea>
<br><br>
<input class="dugme" name="kaydet" type="submit" value="{KAYDET}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input class="dugme" name="temizle" type="reset" value="{TEMIZLE}">
<br>
<br>
</form>
</td>
</tr>
</table>

{JAVASCRIPT_KODU}

</div>
