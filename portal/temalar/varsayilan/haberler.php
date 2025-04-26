<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<!--__KOSUL_BASLAT-dal__-->

	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="3" width="100%">
	<b>{HABER_DALLARI}</b>
	</td>
	</tr>
	<tr  align="center" class="forum_baslik">	
	<td nowrap="nowrap" width="1%"><font face="Verdana"  style="font-size: 12px">{SON}</font></td>
	<td nowrap="nowrap" width="100%"><font face="Verdana"  style="font-size: 12px">{DALLAR}</font></td>
	<td width="5%" nowrap="nowrap"><font face="Verdana" style="font-size: 12px">{TOPLAM_HABER}</font></td>
	</tr>	



	<!--__KOSUL_BASLAT-d6__-->
	<tr>
	<td bgcolor="white"  align="center" class="alt" colspan="3">
	<font face="Verdana"  style="font-size: 11px">{SONUC}</font>
	</td>
	</tr>
	<!--__KOSUL_BITIR-d6__-->



	<!--__KOSUL_BASLAT-d5__-->
	<!--__TEKLI_BASLAT-d1__-->
	<tr>
	<td bgcolor="white" width="1%" align="center" class="alt">
	<a href="{DAL_ADRES}"><img src="{HABER}" alt="{HABER}" border="0"></a>
	</td>
	<td bgcolor="white" class="alt" align="left">
	<a href="{DAL_ADRES}"><font face="Verdana"  style="font-size: 11px"><b>{DAL}</b></font><br></a>
	</td>
	<td bgcolor="white" align="center" class="alt">
	<font face="Verdana"  style="font-size: 11px"><b>{HABER_SAYISI}</b></font>
	</td>
	</tr>
	<!--__TEKLI_BITIR-d1__-->

	<tr>
	<td align="right" class="liste-veri" bgcolor="white" colspan="3">
	<br><b>( <a href="{HABER_EKLEME_SAYFASI}">{HABER_EKLEME_SAYFASI_ADI}</a> )</b>
	</td>
	</tr>
	<tr>
	<td height="90" align="left" class="liste-veri" bgcolor="white">
	<br><img src="temalar/varsayilan/resimler/resimler/istatistik.png" alt="" border="0" width="40" height="40">
	</td>
	<td height="90" align="left" class="liste-veri" bgcolor="white" valign="middle" colspan="2">
	{BURADA} {TOPLAM_HABER_SAYISI} {HABER_VAR}.
	<br>{SON_EKLENEN2} : <a href="{SON_HABER_ADRESI}">{SON_HABER_BILGISI}</a>
	</td>
	</tr>
	<!--__KOSUL_BITIR-d5__-->
	<tr>
	<td align="center" colspan="3" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>
	</table>
	
	<!--__KOSUL_BITIR-dal__-->

	<!--__KOSUL_BASLAT-1__-->
	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="white">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="6"><b>{HABERLER}
	</b>
	</td>
	</tr>
	<tr>
	<td class="forum_baslik" align="center" colspan="2"><b>{HABER}</b></td>
	<td class="forum_baslik" align="center" width="15%" nowrap="nowrap"><b>{EKLENME_TARIHI}</b></td>
	<td class="forum_baslik" align="center" width="15%"><b>{YAZAN}</b></td>
	<td class="forum_baslik" align="center" width="12%"><b>{OKUNMA}</b></td>
	</tr>

	<!--__TEKLI_BASLAT-1__-->

	<tr class="liste-veri">
	
	<td class="alt" align="center" bgcolor="white" width="1%"><img src="temalar/varsayilan/resimler/resimler/haber.gif" alt="r" border="0"></td>
	
	<td bgcolor="white" height="20" class="alt" align="left">{HABER_LINK}</td>

	<td  class="alt" bgcolor="white" align="center">{ACILIS_TARİH}</td>

	<td  class="alt" bgcolor="white" align="center">{YAZAN2}</td>


	<td bgcolor="white" align="center" class="alt">{OKUNMA2}</td>
	
	</tr>

	<!--__TEKLI_BITIR-1__-->
	<tr>
	<td align="center" colspan="5" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>
	<tr>
	<td align="right" class="liste-veri" bgcolor="white" valign="top" colspan="5">
	<br><b>( <a href="{HABER_EKLE_LINK}">{HABER_EKLE}</a> )</b>&nbsp;
	</td>
	</tr>
	<tr>
	<td height="90" width="50" align="left" class="liste-veri" bgcolor="white" valign="top">
	<br>&nbsp;<img src="temalar/varsayilan/resimler/resimler/istatistik.png" alt="" border="0" width="40" height="40">
	</td>
	<td height="50" align="left" class="liste-veri" bgcolor="white" valign="middle" colspan="4">
	&nbsp;&nbsp; {BURADA_TOPLAM} {TOPLAM_HABER} {HABER_VAR}.<br>
	&nbsp;&nbsp; {EN_SON_EKLENEN_HABER} : <a href="{ADRES2}">{BASLIK2}</a>
	</td>
	</tr>
	</table>

	<!--__KOSUL_BITIR-1__-->

	<!--__KOSUL_BASLAT-2__-->

	<table width="100%" class="cizgi_renk" border="0" cellpadding="0" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="4" width="100%" bgcolor="white">
	<b>
	{HABERLER}
	</b>
	</td>
	</tr>
	<tr>
	<td colspan="4" bgcolor="white" class="alt_haber" align="left">
	<div class="dotted-cerceve">
	<font  face="Verdana" style="font-size: 12px; color: red"><b>{BASLIK}</b></font>
	<div align="right">
	<!--__KOSUL_BASLAT-5__-->
	( <a href="{SIL}" onclick="return confirm('{SIL_UYARISI}');">{SIL2}</a> ) ( <a href="{DUZENLEME}">{DUZENLE}</a> ) 
	<!--__KOSUL_BITIR-5__-->
	( <a href="{HABER_EKLE_LINK}">{HABER_EKLE}</a> )
	( {DOSYAYI_YAZDIR} )</div>
	<br>
	<br>
	&nbsp;{ACIKLAMA}
	<br>
	<br>
	<div class="liste-veri" align="right">
	<p>
	<i>
	&nbsp;{YAZAN2} : <b>{YAZAN}</b>
	&nbsp;{OKUNMA2} : {OKUNMA}
	&nbsp;{TARIH2} : {TARİH} 
	&nbsp;{TOPLAM_YORUM2} : {TOPLAM_YORUM}</i>	
	</p>
	</div>
	</div>
	</td>
	</tr>
	<tr>
	<td colspan="4" align="left">
	<div id="etiket" style="margin:0px;padding-bottom:0px"><h4>&nbsp;{ETIKETLER}</h4>
	<p>&nbsp;{ETIKET}</p></div>
	</td>
	</tr>
	<tr class="forum_baslik">
	<td colspan="4" align="center">{BENZER_HABERLER}</td>
	</tr>
	<tr class="liste-veri">
	<td height="25" align="center" class="haber_cubuk">{HABERLER}</td>
	<td width="15%" align="center" class="haber_cubuk">{YAZAN2}</td>
	<td width="15%" align="center" class="haber_cubuk">{OKUNMA2}</td>
	<td width="15%" align="center" class="haber_cubuk">{TARIH2}</td>
	</tr>
	<!--__TEKLI_BASLAT-E__-->
	<tr bgcolor="white" class="liste-veri">
	<td class="alt3" height="25" align="left">&nbsp;&nbsp;{ETIKET_BASLIK}</td>
	<td width="15%" align="center" class="alt3">{ETIKET_YAZAN}</td>
	<td width="15%" align="center" class="alt3">{ETIKET_OKUNMA_SAYISI}</td>
	<td width="15%" align="center" class="alt3">{ETIKET_TARIH}</td>
	</tr>
	<!--__TEKLI_BITIR-E__-->
	<tr>
	<td colspan="4" align="center" class="forum_baslik">{YORUMLAR}<a name="yorum"></a></td>
	</tr>
	<tr>
	<td align="center" colspan="4" width="100%">
	<div id="alt_yorum">
	{JAVA_SCRIPT}
	

	<table width="100%" bgcolor="#ffffff">
	<!--__TEKLI_BASLAT-2__-->
	<tr>
	<td width="20%" class="liste-veri" valign="top" align="left" id="alt_yorum3" height="50">
	
	{YORUM_YAZAN}<br>
	{Y_TARIH}</td>
	<td  width="80%" class="liste-veri" valign="top" align="left" colspan="3" id="alt_yorum2">
	<div align="right"><a href="{YORUM_SIL}" onclick="return confirm('{SIL_UYARISI}');">{SIL3}</a> &nbsp;&nbsp;&nbsp;</div>{YORUM}
	<font face="Verdana" style="font-size: 11px; color: red;">{YORUMLARA_KAPALI}</font>
	<br>
	<br>
	</td>
	</tr>
	<!--__TEKLI_BITIR-2__-->
	<tr>
	<td align="center" colspan="4" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA1}
	</td>
	</tr>
	<!--__KOSUL_BASLAT-7__-->
	<!--__KOSUL_BASLAT-6__-->
	
	
	<tr>
	<td class="liste-etiket" valign="top" colspan="4" align="center" bgcolor="white">
	<form action="{YORUM_EKLE}" method="post" name="form" onsubmit="return denetle25();">
	<input type="hidden" name="id" value="{ID}">
	<br><br>
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

	<!--__KOSUL_BITIR-6__-->
	<!--__KOSUL_BITIR-7__-->

	</table>

	</div>
	</td>
	</tr>



	<tr>
	<td colspan="4" height="25">
	</td>
	</tr>
	</table>
	<!--__KOSUL_BITIR-2__-->

	<!--__KOSUL_BASLAT-3__-->

	<form action="{HABERI_EKLE}" method="post" onsubmit="return denetle_yazi()" name="duzenleyici_form" id="duzenleyici_form">
	<input type="hidden" name="duzenle" value="{DUZENLE}">
	<input type="hidden" name="id" value="{ID}">
	<input type="hidden" name="bbcode_kullan" value="1">
	<input type="hidden" name="ifade" value="1">

	<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff">
	<tr>
	<td class="forum_baslik" align="center" colspan="3">
	<b>
	{YENI_HABER_EKLE}
	</b>
	</td>
	</tr>
	<tr>
	<td align="center" valign="top" bgcolor="#ffffff">

	<div class="genel-tablo" style="box-sizing:border-box; display:table; width:790px" id="tablo_buyut3">

	<table cellspacing="0" cellpadding="0" border="0" align="center" id="tablo_buyut" style="width:100%">
	<tr>
	<td valign="middle">

	<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff">
	<tbody>
	<tr>
	<td height="10" align="left" colspan="3" bgcolor="white">
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" height="40" valign="middle" align="left" width="130">
	<b>&nbsp;&nbsp;{KATEGORI_SECIN} :</b>
	</td><td  bgcolor="white" align="left">
	<select name="dal_id" id="liste_veri" class="formlar">
	{DAL_SECENEK}
	</select>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" height="30" valign="middle" align="left" width="130">
	<b>&nbsp;&nbsp;{HABER_BASLIK} :</b>
	</td><td  bgcolor="white" align="left">
	<input class="formlar" type="text" name="mesaj_baslik" size="50"  value="{BASLIK}" maxlength="50">
	</td>
	</tr>
	<tr>
	<td class="liste-veri" bgcolor="white" nowrap="nowrap" height="30" valign="middle" align="left">
	<br><br><br><b>&nbsp;&nbsp;{ETIKETLER} :</b>
	</td><td  bgcolor="white" class="liste-veri" align="left">
	{LUTFEN}.<br> ( {ORNEK} )<br><br>
	<input class="formlar" type="text" name="etiket" size="50"  value="{ETIKET}" maxlength="50">
	</td>
	</tr> 
	<tr>
	<td class="liste-veri" bgcolor="white" align="left" valign="middle" height="45">
	<b>&nbsp;&nbsp;{YORUM} :</b>
	</td>
	<td class="liste-veri" bgcolor="white" align="left" valign="middle" height="45">
	<select class="formlar" name="yorum">
	{YORUM_SONUC}
	</select>
	</td>
	</tr>

	<tr>
	<td class="liste-veri" valign="top" bgcolor="white" nowrap="nowrap" align="center">
	<p align="left">&nbsp;&nbsp;<b>{ICERIK} :</b></p>
	<br>
	<br>
	<a href="../<?php echo $phpkf_dosyalar['yardim']; ?>#bbcode" target="_blank"><b>[{BBCODE_YARDIM}]</b></a>
	<br>
	<br>
	<div align="center" style="font-weight: normal; font-size: 10px; position: relative; float: center; overflow: auto; width: 130px; height: 125px;"><?php echo ifade_olustur('4'); ?></div>

	<br>
	<br>
	{HTML}<br>
	{BBCODE}
	</td>



<td class="liste-etiket" valign="top" colspan="2" id="tablo_buyut2">
<?php
$duzenleyici_dizin = '../';

// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="70" rows="20" name="mesaj_icerik" id="mesaj_icerik" class="post">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
$duzenleyici = $ayarlar['bduzenleyici'];
include_once('../phpkf-bilesenler/editor/index.php');
?>
	</td>
	</tr>

	<tr>
	<td>&nbsp;</td>
	<td align="center" class="liste-etiket" valign="top">
	<br>
	<input class="dugme" name="yukle" type="submit" value="{GONDER}">
	&nbsp;
	<input class="dugme" name="yukle" type="reset" value="{TEMIZLE}">
	<br>
	<br>
	</td>
	<td>&nbsp;
	</td>
	</tr>


	</table>

	</td></tr></table>
	</div>
	</td></tr></table>
	</form>

	<!--__KOSUL_BITIR-3__-->
	
	