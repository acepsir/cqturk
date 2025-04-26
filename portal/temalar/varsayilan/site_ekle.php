<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

	<!--__KOSUL_BASLAT-1__-->
		

	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="3" width="100%"><b>{SITELER_KATEGORILERI}</b>
	</td>
	</tr>

	<tr class="forum_baslik" align="center">	
	<td width="1%"></td>
	<td nowrap="nowrap"><font face="Verdana" color="#ffffff" style="font-size: 12px">{KATEGORI}</font></td>
	<td width="5%" nowrap="nowrap"><font face="Verdana" color="#ffffff" style="font-size: 12px">{TOPLAM_SITE}</font></td>
	</tr>
	
	<!--__TEKLI_BASLAT-2__-->

	<tr>
	<td bgcolor="white" class="alt" style="padding: 10px;"><img src="temalar/varsayilan/resimler/resimler/ozel_sayfalar.gif" alt="{RESIM}" border="0">	</td>
	
	<td bgcolor="white" align="left" class="alt" style="padding: 10px;">&nbsp;{KATEGORI_BASLIK}<br></td>
		
	<td bgcolor="white" align="center" class="alt" style="padding: 10px;"><font face="Verdana" style="font-size: 10px"><b>{TOPLAM_SITE2}</b></font></td>
	
	</tr>

	<!--__TEKLI_BITIR-2__-->
	<tr>
	<td align="right" class="liste-veri" bgcolor="white" colspan="3" valign="middle">
	<b>( <a href="{SITE_EKLE_SAYFASI_LINK}">{SITE_EKLE_SAYFASI}</a> )</b>
	</td>
	</tr>
	<tr>
	<td height="40" align="left" class="liste-veri" bgcolor="white" valign="middle">
	<br><img src="temalar/varsayilan/resimler/resimler/istatistik.png" alt="." border="0" width="40" height="40">
	</td>
	<td height="40" align="left" class="liste-veri" bgcolor="white" valign="middle" colspan="2">
	{BURADA} {TOPLAM_SITE_SAYISI} {SITE_VAR}.
	<br>{SON_YUKLENEN2} : <a target="_blank" href="{SON_SITE_ADRESI}">{SON_SITE_BILGISI}</a>
	</td>
	</tr>
	
	<tr>
	<td align="center" valign="middle" colspan="3" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>





	</table>
	
	<!--__KOSUL_BITIR-1__-->
	


	
	<!--__KOSUL_BASLAT-2__-->
	
	<table class="cizgi_renk" width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td class="ana_forum_baslik" align="center" width="100%"><b>{SITELER}</b></td>
	</tr>
	<tr>
	<td align="right" class="liste-veri" style="background: #dedede url(temalar/varsayilan/resimler/resimler/tbl.gif) repeat-x; border: #dddddd 1px solid;" valign="middle" nowrap="nowrap" height="50">
	<div align="left">&nbsp;<b><a href="{SITELER_ADRES}">{SITELER}</a> -> {HANGI_KATEGORI}</b></div><b>( <a href="{SITE_EKLE_SAYFASI_LINK}">{SITE_EKLE_SAYFASI}</a> )&nbsp;</b>
	</td>
	</tr>
	
	<!--__TEKLI_BASLAT-1__-->
	<tr class="liste-veri" align="center" bgcolor="white">
	<td align="center" valign="top">
	
	<table class="alt_haber" width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td align="left" width="40%" valign="top">
	<b>{SITE_BASLIK2} :</b> {SITE_BASLIK}  <br>
	<b>{SITE_ADRES2} :</b> <a target="_blank" href="{SITE_ADRES3}">{SITE_ADRES}</a> <br>
	<b>{EKLEYEN2}:</b> {EKLEYEN}<br>
	<b>{ACIKLAMA2} :</b> {ACIKLAMA}
	</td>
	<td align="left" width="60%" valign="top">
	<div style="float:right" align="left"><b>{TARIH2} :</b> {TARIH} <br>
	<b>{OY} : </b>( {TOPLAM_OY} )&nbsp; &nbsp; {TOPLAM_PUAN} <br>
	<b>{TOPLAM_HIT} : </b>( {HIT} )&nbsp; &nbsp; {TOPLAM_HIT_SISTEMI}</div>
	</td>
	<td align="left" width="100%" rowspan="2" valign="middle">
	<a href ="{SIL}" onClick="return confirm('{SIL_UYARISI}');">{SIL2}</a><br><br>
	{PUAN_VER}<br><br>
	<a href ="{DUZELT}">{DUZELT2}</a>
	</td>
	</tr>
	<tr>
	<td align="center" width="100%" colspan="2">

<a target="_blank" href="{SITE_ADRES3}"><img src="{SITE_RESIM}" border="0" alt="{SITE_RESIM}" width="468" height="60"></a>
	</td>
	</tr>
	</table>	
	</td>
	</tr>
	
	<!--__TEKLI_BITIR-1__-->
	
	<tr>
	<td align="center" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>
	</table>
	
	
<!--__KOSUL_BITIR-2__-->


<!--__KOSUL_BASLAT-3__-->
	
	{JAVA_SCRIPT}
	<form action="{SITE_EKLEME_SAYFASI}" method="post" name="form1" onsubmit="return denetle5();">
	<input type="hidden" name="site_duzelt_secenek" value="{SITE_DUZELT_SECENEK}">
	<input type="hidden" name="site_id" value="{SITE_ID}">
	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="2">
	<b>
	{SITE_EKLE}
	</b>
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{KATEGORI_SECIN} :</b>
	</td>
	<td bgcolor="white" width="80%" align="left">
	<select name="sd" id="liste_veri">
	{DAL_SECENEK}
	</select>
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{SITE_ADI} :</b>
	</td>
	<td  bgcolor="white" width="80%" align="left">
	<input class="formlar" type="text" name="site_title" size="52"  value="{SITE_ADI2}" maxlength="59">
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{SITE_ADRESI} :</b>
	</td>
	<td class="liste-veri" bgcolor="white" align="left">
	<input class="formlar" type="text" checked="checked" name="adres" size="52" maxlength="100" value="{ADRES2}"> 
	</td>
	</tr> 
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	{RESIM_ADRESI}
	</td>
	<td class="liste-veri" bgcolor="white" align="left">
	<input class="formlar" type="text" checked="checked" name="ekle" size="52" maxlength="150" value="{SITE_RESIM2}"> 
	</td>
	</tr> 
	<tr>
	<td class="liste-veri" valign="top" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{ACIKLAMA} :</b>
	<br><i><font size="1">{SADECE_DUZ_METIN} !</font></i>
	</td>
	<td  bgcolor="white" width="80%" class="liste-veri" align="left">
	<textarea class="formlar" cols="50" rows="10" name="aciklama" title="" onKeyUp="txtmesajsay()"  onchange="txtmesajsay()">{ACIKLAMA2}</textarea>
	<br>
	{EN_FAZLA}<input name="sayac" type="text" disabled size="2" style="width:22; float:center; font-size :12px;color:#330066; border:0;" maxlength="3" value="200">{KARAKTER}.
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white"  colspan="2" align="center">
	<input class="dugme" name="gonder" type="submit" value="{EKLE}">
	<script type="text/javascript">
<!-- //
txtmesajsay();
//  -->
</script>
	</td>
	</tr> 
	<tr>
	<td height="90" align="left" colspan="2" bgcolor="white">
	</td>
	</tr>
	</table>
	</form>
	<!--__KOSUL_BITIR-3__-->