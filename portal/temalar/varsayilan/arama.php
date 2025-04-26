<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

	{JAVA_SCRIPT}

	
	<table width="100%" class="cizgi_renk" border="0" cellpadding="0" cellspacing="0" bgcolor="white">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="8" width="100%"><b>{ARAMA}</b></td>
	</tr>
	<tr>
	<td align="center">
	<div align="center" id="alt_haber" style="padding: 0px; margin: 0px;">

	<table width="100%" border="0" cellpadding="15" cellspacing="0" class="alt">
	<tr>
	<td valign="middle" align="center" class="liste-veri" width="100%" colspan="4">
	
	<table width="100%" border="0" cellpadding="10" cellspacing="1" align="center" bgcolor="#dddddd">
	<tr>
	<td valign="middle" align="center" class="liste-veri" width="100%" bgcolor="#ffffff">
	<form name="form2" method="get" action="{ACTION}" onSubmit="return kontrol2()">
	<input type="hidden" name="kosul" value="portal_arama">
	<input type="hidden" name="dolu" value="1">
	<input type="hidden" name="ara" value="forum">
	{FORUM} : <input type="text" size="25" name="sozcuk" class="formlar" 
	value="" style="background:url(portal/temalar/varsayilan/resimler/resimler/form2.png) norepeat;">
	<input type="submit" name="submit" class="dugme" value="{ARAMA_BASLAT}">
	</form>
	</td>
	</tr>
	</table>
	<br>
	<table width="100%" border="0" cellpadding="10" cellspacing="0" style="border: 1px solid #dddddd">
	<tr>
	<td align="center">

	<form name="form" method="get" action="{ACTION}" onSubmit="return kontrol()">
	<input type="hidden" name="kosul" value="portal_arama">
	<input type="hidden" name="dolu" value="1">


    <table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td valign="top" align="left" class="liste-veri" width="50%">
	{GALERI}
	{DOSYA}
	{SITELER}
	</td>
	
	<td valign="top" align="left" class="liste-veri" width="50%">
	{HABER}
	{ANKET}
	</td>
	</tr>
	
	<tr>
	<td valign="top" align="center" class="liste-veri" width="100%" colspan="4">
	<br>
	<br>
	<input type="radio" name="ara2" value="baslik" checked="checked">{BASLIK}<input type="radio" name="ara2" value="icerik">{ICERIK}<br><br>
	{PORTAL_ARAMA1} : <input type="text" size="25" name="sozcuk" class="formlar" 
	value="" style="background:url(portal/temalar/varsayilan/resimler/resimler/form2.png) norepeat;">
	<input type="submit" class="dugme" value="{ARAMA_BASLAT}">	
	</td>
	</tr>
    </table>

	</form>


	</td>
	</tr>
	</table>
	
	
	<!--__KOSUL_BASLAT-1__-->
	<br>
	<table width="100%" border="0" cellpadding="10" cellspacing="0" style="border: 1px solid #dddddd">
	<tr>
	<td valign="top" align="left" class="liste-veri" width="100%" colspan="4">
	{BULUNAN}
	</td>
	</tr>	
	<tr>
	<td align="center" colspan="4" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>
	</table>
	<!--__KOSUL_BITIR-1__-->

	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
	</table>

