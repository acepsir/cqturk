<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">{SAYFA_BASLIK}</div>
<div class="kutu-icerik">


{FORM_BILGISI}

<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
	<tr>
	<td class="liste-veri" align="left">
<input class="formlar" type="text" name="kul_ara" size="20" maxlength="20" value="{KULLANICI_ARA}">
&nbsp;<input type="submit" value="Ara" class="dugme">
	</td>

	<td class="liste-veri" align="right">
<select name="sirala" class="formlar">
{SIRALAMA_SECENEK}
</select>
&nbsp;<input type="submit" value="üyeleri sırala" class="dugme">
	</td>
	</tr>

	<tr>
	<td colspan="2">

<table cellspacing="1" width="100%" cellpadding="6" border="0" align="center" bgcolor="#d0d0d0">
	<tr class="forum_baslik">
	<td align="center" width="30">Özel</td>
	<td align="center">Kullanıcı Adı</td>
	<td align="center" width="105">IP Adresi</td>
	<td align="center" width="45">Mesaj</td>
	<td align="center" width="85">Katılım</td>
	<td align="center" width="50">{UYE_ALAN3}</td>
	<td align="center" width="60">{UYE_ALAN1}</td>
	<td align="center" width="82">{UYE_ALAN2}</td>
	<td align="center" width="25">Sil</td>
	</tr>


<!--__KOSUL_BASLAT-2__-->

	<tr class="liste-etiket" bgcolor="#ffffff">
	<td colspan="9" align="center" height="70" valign="center">
{SONUC_YOK}
	</td>
	</tr>

<!--__KOSUL_BITIR-2__-->



<!--__KOSUL_BASLAT-1__-->

<!--__TEKLI_BASLAT-1__-->



	<tr class="liste-veri" bgcolor="#ffffff" onMouseOver="this.bgColor= '#e0e0e0'" onMouseOut="this.bgColor= '#ffffff'">
	<td align="center" title="Özel ileti gönder">
{UYE_ILETI}
	</td>

	<td align="left" title="Kullanıcı yetkilerini ve profilini değiştir">
{UYE_ADI}
	</td>

	<td align="center">
{UYE_IP_ADRESI}
	</td>

	<td align="center">
{UYE_MESAJ}
	</td>

	<td align="center">
{UYE_KATILIM}
	</td>

	<td align="center" title="Özel yetkiler">
{UYE_YETKI}
	</td>

	<td align="center">
{UYE_ENGEL}
	</td>

	<td align="center">
{UYE_ETKIN}
	</td>

	<td align="center">
{UYE_SIL}
	</td>
	</tr>


<!--__TEKLI_BITIR-1__-->

<!--__KOSUL_BITIR-1__-->



</table>

{SAYFALAMA}

<p align="left">
<font face="verdana" size="1">
{ARAMA_SONUC_YAZISI1} <b>{UYE_SAYISI}</b> &nbsp; 
<br><i>{ARAMA_SONUC_YAZISI2}</i>
</font>


</td></tr></table>
</form>


</div>
</div>
</div>
