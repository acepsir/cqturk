<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

	<!--__KOSUL_BASLAT-8__-->
	

	<table width="100%" border="0" cellpadding="0" cellspacing="0"  bgcolor="#ffffff">
	<tr>
	<td align="left">

	<form method="post" action="{OY_VER_SAYFASI_1}" name="anket_form">

	<table width="100%" class="cizgi_renk" border="0" cellpadding="0" cellspacing="1"  bgcolor="#dddddd">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="5" width="100%"><b>{ANKET}</b>
	</td>
	</tr>
	<tr class="forum_baslik" align="left">
	<td width="1%"></td>
	<td align="left">
	<font face="Verdana" color="#ffffff" style="font-size: 12px">{SECENEK}
	</font>
	</td>	
	<td width="9%" align="center"><font face="Verdana" color="#ffffff" style="font-size: 12px">{TOPLAM_OY}</font></td>
	<td width="9%" align="center"><font face="Verdana" color="#ffffff" style="font-size: 12px">{TOPLAM_YUZDE}</font></td>
	<td width="12%" align="center"><font face="Verdana" color="#ffffff" style="font-size: 12px">{CUBUK_1}</font></td>
	
	</tr>
	<tr align="center">
	<td colspan="5" bgcolor="#eeeeee" height="25" valign="middle">
	<u>
	<b>
	<font face="Verdana" style="font-size: 11px">{ANKET_SORU}</font>
	</b>
	</u>
	<!--__KOSUL_BASLAT-ak__-->
	<br>
	<b>
	<font face="Verdana" style="font-size: 11px; color: red;">{ANKET_KAPATILMISTIR}</font>
	</b>
	<!--__KOSUL_BITIR-ak__-->
	</td>
	</tr>
	


	
	<!--__TEKLI_BASLAT-1__-->
	
	<tr>
	<td bgcolor="white">
	<input type="hidden" name="anketno" value="{ANKET_NO}">	
	<font face="Verdana" style="font-size: 11px"><img src="{UST_DIZIN}temalar/{TEMA_DIZIN}/resimler/resimler/anket_soru.gif" title="{RRESIMM}" alt="{RRESIMM}" border="0">
	</font>
	</td>
	
	
	<td bgcolor="white">
	<font face="Verdana" style="font-size: 11px">
	&nbsp;{SECENEK_DURUMU_2}{SECENEK}
	</font>
	</td>	
	
	
	
	<td align="center" bgcolor="white">
	<font face="Verdana"  style="font-size: 11px">{OYLAR}
	</font>
	</td>
	
	<td align="center" bgcolor="white" nowrap="nowrap">
	<font face="Verdana"  style="font-size: 11px">
	 %{YUZDE}
	</font>
	</td>
	
	<td align="left" bgcolor="white" nowrap="nowrap">
	<div style="{ALINTI_CUBUK_RENGI} height:14px; width:{CUBUK_YUZDE}%; text-align:left; font-size: 9px;" class="forum_baslik"></div>
	</td>
	</tr>
	<!--__TEKLI_BITIR-1__-->
	
	
	<tr>
	<td width="1%" bgcolor="white">
	</td>
	<td  align="center" bgcolor="white">
	<br>
	{OYVER_DUGMESI_DURUMU2}
	<br>
	<br>
	</td>
	<td width="20%" align="center" bgcolor="white" colspan="3">
	<font style="font-size: 10px; font-family: Verdana;"><b>{TTOPLAM_OYLARR_1} : {TTOPLAM_OYLARR}</b></font>
	</td>
	</tr>
	</table>
	</form>

{JAVA_SCRIPT}
    


	<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#fefefe">
	<tr>
	<td colspan="5" align="center" class="forum_baslik">{YORUMLAR}</td>
	</tr>
	<tr>
	<td align="center" colspan="5" width="100%">
	<div  id="alt_yorum">&nbsp;
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<!--__TEKLI_BASLAT-y1__-->
	<tr>
	<td  width="20%" valign="top" align="left" class="alt_yorum3" height="50">
	&nbsp;&nbsp;{YORUM_YAZAN}<br>
	&nbsp;&nbsp;{Y_TARIH}
	</td>
	<td  width="80%" class="liste-veri" valign="top" align="left" colspan="3" id="alt_yorum2">
	<div align="right"><a href="{YORUM_SIL}" onclick="return confirm('{SIL_UYARISI}');">{SIL3}</a> &nbsp;&nbsp;&nbsp;</div>{YORUM}
	<font face="Verdana" style="font-size: 11px; color: red;">{YORUMLARA_KAPALI}</font>
	<br>
	</td>
	</tr>
	<!--__TEKLI_BITIR-y1__-->
	<tr>
	<td align="center" colspan="5" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA1}
	</td>
	</tr>
	<!--__KOSUL_BASLAT-6__-->
	<!--__KOSUL_BASLAT-y__-->
	
	<tr>
	<td class="liste-etiket" valign="top" colspan="5" align="center" bgcolor="white">
	<form action="{YORUM_EKLE}" method="post" name="form" onsubmit="return denetle25();">
	<input type="hidden" name="id" value="{ID}"><br><br>
	<textarea rows="10" cols="50" name="icerik" class="formlar"></textarea>
	<br>
	<br>
	<input class="dugme" name="yorumla" type="submit" value="{GONDER}">
	&nbsp; &nbsp; 
	<input class="dugme" type="reset" name="reset" value="{TEMIZLE}">
	</form>
	<br>
	<br>
	</td>
	</tr>
	
	<!--__KOSUL_BITIR-y__-->
	<!--__KOSUL_BITIR-6__-->
	</table>

	</div>
	</td>
	</tr>
	</table>
    
	</td>
	</tr>
	</table>


	
	<!--__KOSUL_BITIR-8__-->
	
	<!--__KOSUL_BASLAT-9__-->
	

	<table width="100%" class="cizgi_renk" border="0" cellpadding="3" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="5" width="100%"><b>{ANKETLER}
	</b>
	</td>
	</tr>
	<tr class="forum_baslik" align="left">
	<td width="1%">
	</td>
	<td width="59%">{ANKET_SORULARI}
	</td>
	<td width="15%" align="center" nowrap="nowrap">{A_DURUMU}
	</td>
	<td width="20%" align="center">{ACILIS_TARIHI}
	</td>
	<td width="5%" align="center">{A_OYLAR}
	</td>
	</tr>
	
	<!--__TEKLI_BASLAT-2__-->
	
	<tr>
	<td class="alt" style="padding: 5px;">
	<img src="{UST_DIZIN}temalar/{TEMA_DIZIN}/resimler/resimler/anket_soru.gif" alt="" border="0">
	</td>
	<td colspan="1" class="alt" style="padding: 5px;" align="left">
	<font face="Verdana" style="font-size: 11px">{ANKET_SORUSU2}</font>
	<br>
	</td>
	<td class="alt" style="padding: 5px;" align="center">
	<font face="Verdana" style="font-size: 11px">
	{ANKET_DURUMU}
	</font>
	</td>
	<td class="alt" style="padding: 5px;" align="center">
	<font face="Verdana" style="font-size: 11px">
	{ANKET_TARIHI}
	</font>
	</td>
	<td class="alt" style="padding: 5px;" align="center">
	<font face="Verdana" style="font-size: 11px">
	{TOP_OYLAR}
	</font>
	</td>
	</tr>
	
	<!--__TEKLI_BITIR-2__-->
	<tr>
	<td align="center" valign="middle" colspan="5" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>
	</table>

	<!--__KOSUL_BITIR-9__-->
	
	
