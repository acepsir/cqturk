<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

{JAVA_SCRIPT}
	<table width="100%" class="cizgi_renk" border="0" cellpadding="0" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td class="ana_forum_baslik" width="100%" colspan="2" align="center">{DAVETIYE}
	</td>
	</tr>
	<tr>
	<td width="100%" colspan="2" align="center">
	
	<table width="100%" border="0" cellpadding="20" cellspacing="0" bgcolor="#ffffff">
	<tr>
	<td width="100%" colspan="2" align="center" class="alt">
	
	<form action="{DAVETIYE_GONDER_SAYFASI}" method="post" name="form" onsubmit="return denetle25();">
	<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
	
	<tr>
	<td bgcolor="#ffffff" align="left">
	<font face="Verdana" size="2" color="#2E2E2E">
	{ISMINIZ} :</font>
	</td>
	<td bgcolor="#ffffff" align="left">
	<input type="text" style="background:url(portal/temalar/varsayilan/resimler/resimler/form2.png) norepeat;" class="formlar" name="isim" size="35" maxlength="50">
	</td>
	</tr>
	<tr>
	<td bgcolor="#ffffff" align="left">
	<font color="#2E2E2E" face="Verdana" size="2">{E-POSTA_ADRESINIZ} :</font>
	</td>
	<td bgcolor="#ffffff" align="left">
	<input type="text" style="background:url(portal/temalar/varsayilan/resimler/resimler/form2.png) norepeat;" class="formlar" name="email" size="35" maxlength="50">
	</td>
	</tr>
	<tr>
	<td bgcolor="#ffffff" align="left">
	<font face="Verdana" size="2" color="#2E2E2E">{ARKADASINIZIN_ISMI} :</font>
	</td>
	<td bgcolor="#ffffff" align="left">
	<input type="text" style="background:url(portal/temalar/varsayilan/resimler/resimler/form2.png) norepeat;" class="formlar" name="aisim" size="35" maxlength="50">
	</td>
	</tr>
	<tr>
	<td bgcolor="#ffffff" align="left">
	<font color="#2E2E2E" face="Verdana" size="2" style="white-space: nowrap;">{ARKADASINIZIN_E-POSTA_ADRESI} :</font>
	</td>
	<td bgcolor="#ffffff" align="left">
	<input type="text" style="background:url(portal/temalar/varsayilan/resimler/resimler/form2.png) norepeat;" class="formlar" name="aemail" size="35" maxlength="50">
	</td>
	</tr>
	<tr>
	<td bgcolor="#ffffff" align="left">
	<font color="#2E2E2E" face="Verdana" size="2">{MESAJINIZ}.</font>
	</td>
	<td bgcolor="#ffffff" align="left">
	<textarea rows="7" cols="35" name="eklenen_mesaj" class="formlar"></textarea>
	</td>
	</tr>
	<tr>
	<td bgcolor="#ffffff" align="left">&nbsp;
	</td>
	<td align="left" bgcolor="#ffffff">
	<input class="dugme" type="submit" value="{GONDER}">
	<input class="dugme" type="reset" name="reset" value="{TEMIZLE}">
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