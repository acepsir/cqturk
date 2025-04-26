<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<!--__KOSUL_BASLAT-2__-->

	{JAVA_SCRIPT}

	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="4" width="100%"><b>{RESIM_GALERISI}</b></td>
	</tr>
	<tr>
	<td align="left" class="liste-veri" bgcolor="white" valign="top" colspan="2">
	<b><a href="{D1}">{RESIM_GALERISI}</a></b>-><b>{DALL}</b>
	<br>
	<br>
	</td>
	<td align="right" class="liste-veri" bgcolor="white" valign="top" nowrap="nowrap">
	<b>( <a href="{RESIM_EKLEME_SAYFASI}">{RESIM_EKLEME_SAYFASI_ADI}</a> )</b>
	<br>
	<br>
	</td>
	</tr>

	<!--__TEKLI_BASLAT-3__-->
	<tr align="center" bgcolor="white">
	<td valign="top" height="130" align="center" width="20%">
	<label style="cursor: pointer;"><a href="javascript:void(0);" onClick="sayfa_ac('{RESIM}',{RESIM_GENISLIK},{RESIM_YUKSEKLIK}); return false;">
	<img style="cursor: url(./temalar/varsayilan/resimler/resimler/yakinlastir.cur), pointer;" width="130" height="130" src="{RESIM}" border="1" class="cizgi_renk" alt="resim"></a></label>
	</td>
	<td class="liste-veri" align="left" valign="top">
	<div align="right">{TOPLAM_PUAN}</div>
	<b>{RESIM_ADI} :</b> {ISIM} 
	<br><b>{EKLEME_TARIHI} :</b> {TARIH}
	<br><b>{BOYUT1} :</b> {RESIM_GENISLIK} X {RESIM_YUKSEKLIK} | {BOYUT}
	<br><b>{EKLEYEN1}:</b> {EKLEYEN}
	<br><b>{ACIKLAMA1} :</b> {ACIKLAMA}<div align="right"><b>{TOPLAM_PUAN2} : {PUAN}</b></div>
	</td>
	<td class="liste-veri" align="center" valign="middle" width="15%">
	<a href ="{SIL}" onClick="return confirm('{SIL_UYARISI}');">{SIL2}</a><br><br>
	<a href ="{PUAN_VER}">{PUAN_VER_DUGME}</a><br><br>
	<a href ="{DUZELT}">{DUZELT2}</a>
	</td>
	</tr>
	<!--__TEKLI_BITIR-3__-->
	<tr>
	<td align="center" colspan="5" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>
	</table>
	
	<!--__KOSUL_BITIR-2__-->

	<!--__KOSUL_BASLAT-1__-->
	
	{JAVA_SCRIPT}
	
	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="3" width="100%">
	<b>{GALERI_DALLARI}</b>
	</td>
	</tr>
	<tr  align="center" class="forum_baslik">	
	<td nowrap="nowrap" style="width: 50px;"><font face="Verdana"  style="font-size: 12px">{SON}</font></td>
	<td nowrap="nowrap" width="100%"><font face="Verdana"  style="font-size: 12px">{DALLAR}</font></td>
	<td width="5%" nowrap="nowrap"><font face="Verdana" style="font-size: 12px">{TOPLAM_RESIM}</font></td>
	</tr>	



	<!--__KOSUL_BASLAT-6__-->
	<tr>
	<td bgcolor="white"  align="center" class="alt" colspan="3">
	<font face="Verdana"  style="font-size: 11px">{SONUC}</font>
	</td>
	</tr>
	<!--__KOSUL_BITIR-6__-->



	<!--__KOSUL_BASLAT-5__-->
	<!--__TEKLI_BASLAT-1__-->
	<tr>
	<td bgcolor="white" style="width: 65px;" align="center" class="alt">
	<a href="{DAL_ADRES}"><img src="{RESIM}" alt="{RESIM}" border="0" width="65" height="50"></a>
	</td>
	<td bgcolor="white" class="alt" align="left">
	<a href="{DAL_ADRES}"><font face="Verdana"  style="font-size: 11px"><b>{DAL}</b></font><br></a>
	</td>
	<td bgcolor="white" align="center" class="alt">
	<font face="Verdana"  style="font-size: 11px"><b>{RESIM_SAYISI}</b></font>
	</td>
	</tr>
	<!--__TEKLI_BITIR-1__-->

	<tr>
	<td align="right" class="liste-veri" bgcolor="white" colspan="3">
	<br>{SLAYT_EKLENTISI_BAGLANTI}<b>( <a href="{RESIM_EKLEME_SAYFASI}">{RESIM_EKLEME_SAYFASI_ADI}</a> )</b>
	</td>
	</tr>
	<tr>
	<td height="90" align="left" class="liste-veri" bgcolor="white">
	<br><img src="temalar/varsayilan/resimler/resimler/istatistik.png" alt="istatistik" border="0" width="40" height="40">
	</td>
	<td height="90" align="left" class="liste-veri" bgcolor="white" valign="middle" colspan="2">
	{BURADA} {TOPLAM_RESIM_SAYISI} {RESIM_VAR}.
	<br>{ENCOK_PUAN_ALAN2} : <a href="javascript:void(0);" onClick="sayfa_ac('{ENCOK_PUAN_ALAN_ADRESI}',{RESIM_GENISLIK},{RESIM_YUKSEKLIK}); return false;">{ENCOK_PUAN_ALAN}</a>
	<br>{SON_YUKLENEN2} : <a href="javascript:void(0);" onClick="sayfa_ac('{SON_RESIM_ADRESI}',{RESIM_GENISLIK_1},{RESIM_YUKSEKLIK_1}); return false;">{SON_RESIM_BILGISI}</a>
	</td>
	</tr>
	<!--__KOSUL_BITIR-5__-->
	<tr>
	<td align="center" colspan="3" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>
	</table>
	
	<!--__KOSUL_BITIR-1__-->



	<!--__KOSUL_BASLAT-4__-->
	

	<form enctype="multipart/form-data" action="{RESIM_YUKLEME_SAYFASI_1}" method="post" name="form12" onsubmit="return denetle5();">
	<input type="hidden" name="gd" value="{DAL_NO}">
	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
	<tr>
	<td class="forum_baslik" align="center" colspan="2">
	<b>
	{RESIM_YUKLE1}
	</b>
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{KATEGORI_SECIN} :</b>
	</td>
	<td bgcolor="white" width="80%" align="left">
	<select name="gd" id="liste_veri">
	{DAL_SECENEK}
	</select>
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{RESIM_ADI} :</b>
	</td>
	<td  bgcolor="white" width="80%" align="left">
	<input class="formlar" type="text" name="resim_adi" size="52"  value="" maxlength="30">
	</td>
	</tr> 
	<tr>
	<td class="liste-veri" valign="top" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{ACIKLAMA} :</b>
	<br><i><font size="1">{SADECE_DUZ_METIN} !</font></i>
	
	</td>
	<td  bgcolor="white" width="80%" class="liste-veri" align="left">
	<textarea class="formlar" cols="50" rows="10" name="aciklama" onKeyUp="yaziUzunluk()"></textarea>
	<br>
	<div id="yazi_uzunluk" style="font-weight: normal">{EN_FAZLA} {KARAKTER}:</div>
	{JAVA_SCRIPT}
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">

	<b>{RESIM_YUKLE111} :</b>
	<br><i><font size="1">{BILGISAYAR111}.</font></i>
	</td>
	<td class="liste-veri" bgcolor="white" align="left">
	<input type="radio" checked="checked" name="yukle"  style="width: 50px" maxlength="20" onclick="gizle_goster('alan2','alan1')">
	</td>
	</tr>
	<!--__KOSUL_BASLAT-re2__-->
	<tr>
	<td class="liste-veri" bgcolor="white" align="left" nowrap="nowrap">
	<b>{UZAK_RESIM} :</b>
	<br><i><font size="1">{UZAK_RESIM2}.</font></i>
	</td>
	<td class="liste-veri" bgcolor="white" align="left">
	<input type="radio" name="yukle" style="width: 50px" maxlength="30" onclick="gizle_goster('alan1','alan2')"> 
	</td>
	</tr>
	<!--__KOSUL_BITIR-re2__-->
	<tr>
	<td class="liste-veri" bgcolor="white" align="left">
	<font face="Verdana" style="font-size: 10px;">{AZAMI_BOYUT} {BOYUT_1A} {KB}.</font>
	</td>
	<td class="liste-veri" bgcolor="white" align="left" height="35">
	&nbsp;
	<div id="alan2" style="display: inline; visibility: inline;">
	<input class="formlar" type="file" name="yukle" size="40" style="width: 320px">
	</div>


	<!--__KOSUL_BASLAT-re__-->
	<div id="alan1" style="display: none; visibility: hidden;">
	<input class="formlar" type="text" name="ekle" size="50" value="http://">
	</div>
	<!--__KOSUL_BITIR-re__-->

	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white"  colspan="2" align="center">
	<input class="dugme" name="yukle" type="submit" value="{YUKLE}">
	</td>
	</tr> 
	<tr>
	<td height="90" align="left" colspan="2" bgcolor="white">
	
	</td>
	</tr>
	</table>
	</form>
	<!--__KOSUL_BITIR-4__-->


	<!--__KOSUL_BASLAT-7__-->

	
	<form enctype="multipart/form-data" action="{RESIM_DEGISTIR_SAYFASI}" method="post" name="form11">
	<input type="hidden" name="no" value="{NO}">
	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
	<tr>
	<td class="forum_baslik" align="center" colspan="2">
	<b>
	{RESIM_DUZENLEME}
	</b>
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{KATEGORI_SECIN} :</b>
	</td>
	<td  bgcolor="white" width="80%" align="left">
	<select name="gd" id="liste_veri">
	<!--__TEKLI_BASLAT-2__-->
	{DAL_SECENEK}
	<!--__TEKLI_BITIR-2__-->
	</select>
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{RESIM_ADI} :</b>
	</td>
	<td bgcolor="white" width="80%" align="left">
	<input class="formlar" type="text" name="resim_adi" size="52" maxlength="30"  value="{ISIM}">
	</td>
	</tr> 
	<tr>
	<td class="liste-veri" valign="top" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{ACIKLAMA} :</b>
	</td>
	<td  bgcolor="white" width="80%" class="liste-veri" align="left">
	<textarea class="formlar" cols="50" rows="10" name="aciklama" onKeyUp="yaziUzunluk2()">{ACIKLAMA_2}</textarea>
	<br>
	<div id="yazi_uzunluk2" style="font-weight: normal">{EN_FAZLA} {KARAKTER}:</div>
	{JAVA_SCRIPT}
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<b>{RESIM_22} :</b>
	<br><i><font size="1">({DEGISTIRILEMEZ})</font></i>
	</td>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" width="15%" align="left">
	<input class="formlar" type="text" name="resim" size="52" value="{RESIM}" disabled="disabled">
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white"  colspan="2" align="center">
	<input class="dugme" name="yukle" type="submit" value="{DUZELT}">
	</td>
	</tr>
	<tr>
	<td height="90" align="center" bgcolor="white" colspan="2">
	<img src="{RESIM}" alt="{ISIM}" title="{ISIM}" border="1" width="100">

	</td>
	</tr>	
	</table>	
	</form>
	<!--__KOSUL_BITIR-7__-->

