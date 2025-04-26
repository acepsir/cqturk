<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

	<!--__KOSUL_BASLAT-8__-->

	<table width="100%" class="cizgi_renk" border="0" cellpadding="1" cellspacing="1">
	<tr>
	<td class="ana_forum_baslik" align="center" width="100%">
	<b>{DUYURULAR}</b>
	</td>
	</tr>

	<!--__TEKLI_BASLAT-2__-->
	<tr>
	<td align="left" class="alt_haber">
	<div class="dotted-cerceve2">
	<div class="padmar_ayari">
	{DUYURU_ICERIK}
	</div>
	</div>
	</td>
	</tr>
	<!--__TEKLI_BITIR-2__-->
	</table>
	<br>



<!--__KOSUL_BITIR-8__-->
	
	
	
	<!--__KOSUL_BASLAT-2__-->
	<!--__KOSUL_BASLAT-1__-->
	<table width="100%" class="cizgi_renk" border="0" cellpadding="0" cellspacing="1">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="4" width="100%" bgcolor="white">
	<b>{HABERLER}</b>
	</td>
	</tr>
	<!--__TEKLI_BASLAT-1__-->	
	
	<tr>
	<td colspan="4" bgcolor="white" class="alt_haber" align="left">
	<div class="dotted-cerceve">
	<font  face="Verdana" style="font-size: 12px;"><b><a href="{ADRES}">{BASLIK}</a></b></font>
	<div align="right">
	<!--__KOSUL_BASLAT-5__-->
	( <a href="{SIL}" onclick="return confirm('{SIL_UYARISI}');">{SIL2}</a> ) ( <a href="{DUZENLEME}">{DUZENLE}</a> )
	( <a href="{HABER_EKLE_LINK}">{HABER_EKLE}</a> )
	<!--__KOSUL_BITIR-5__-->
	( {DOSYAYI_YAZDIR} )</div>
	<br>
	<br>
	{ICERIK}
	<br>
	<br>
	<br>
	<div class="liste-veri" align="right"><i>{YAZAN2}: <b>{YAZAN}</b>
	|&nbsp;{OKUNMA2}: {OKUNMA}
	|&nbsp;{TARIH2}: {TARIH} 
	|&nbsp;{TOPLAM_YORUM}</i>
	</div>	
	</div>
	</td>
	</tr>
	<!--__TEKLI_BITIR-1__-->
	<tr>
	<td align="center" colspan="4" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>
	</table>
	<br>
	<!--__KOSUL_BITIR-1__-->
	<!--__KOSUL_BITIR-2__-->
	
	<!--__KOSUL_BASLAT-dos__-->
		

	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="6" width="100%"><b>{DOSYA_KATEGORILERI}</b>
	</td>
	</tr>

	<tr class="forum_baslik" align="center">	
	<td width="1%"></td>
	<td nowrap="nowrap"><font face="Verdana" color="#ffffff" style="font-size: 12px">{KATEGORI}</font></td>
	<td width="20%" nowrap="nowrap"><font face="Verdana" color="#ffffff" style="font-size: 12px">{SON_DOSYALAR}</font></td>
	<td width="20%" nowrap="nowrap"><font face="Verdana" color="#ffffff" style="font-size: 12px">{SON_YORUMLAR}</font></td>
	<td width="5%" nowrap="nowrap"><font face="Verdana" color="#ffffff" style="font-size: 12px">{DOSYALAR3}</font></td>
	<td width="5%" nowrap="nowrap"><font face="Verdana" color="#ffffff" style="font-size: 12px">{YORUMLAR}</font></td>
	</tr>
	
	<!--__TEKLI_BASLAT-do1__-->

	<tr>
	<td class="alt" style="padding: 5px;"><img src="portal/temalar/{TEMA_DIZIN}/resimler/resimler/kategori.gif" alt="{RESIM}" border="0">	</td>
	
	<td class="alt" style="padding: 5px;" align="left">&nbsp;<a href="{DOSYA_DALI_LINKI}"><font face="Verdana" style="font-size: 13px">{KATEGORI_ADI}</font></a><br></td>

	<td class="alt" style="padding: 5px;" align="left">{DOSYA_SONUC}</td>
	
	<td class="alt" style="padding: 5px;" align="left">{YORUM_SONUC}	</td>
	
	<td class="alt" style="padding: 5px;" align="center"><font face="Verdana" style="font-size: 10px"><b>{ICERIK}</b></font></td>
	
	<td class="alt" style="padding: 5px;" align="center"><font face="Verdana" style="font-size: 10px"> <b>{ICERIK_2}</b></font></td>
	</tr>

	<!--__TEKLI_BITIR-do1__-->
	
	
	<tr>
	<td align="center" valign="middle" colspan="6" id="sayfalama_cubuk">
	{SAYFALAMA2}
	</td>
	</tr>





	</table>
	<br>
	
	<!--__KOSUL_BITIR-dos__-->
	
	<!--__KOSUL_BASLAT-ank__-->
	

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
	
	<!--__TEKLI_BASLAT-an1__-->
	
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
	
	<!--__TEKLI_BITIR-an1__-->
	<tr>
	<td align="center" valign="middle" colspan="5" id="sayfalama_cubuk">
	{SAYFALAMA3}
	</td>
	</tr>
	</table>
	<br>
	<!--__KOSUL_BITIR-ank__-->
	
	
	<!--__KOSUL_BASLAT-glr__-->
	
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



	<!--__KOSUL_BASLAT-gle__-->
	<tr>
	<td bgcolor="white"  align="center" class="alt" colspan="3">
	<font face="Verdana"  style="font-size: 11px">{SONUC}</font>
	</td>
	</tr>
	<!--__KOSUL_BITIR-gle__-->



	<!--__KOSUL_BASLAT-gli__-->
	<!--__TEKLI_BASLAT-gl1__-->
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
	<!--__TEKLI_BITIR-gl1__-->

	<tr>
	<td align="right" class="liste-veri" bgcolor="white" colspan="3">
	<br><b>( <a href="{RESIM_EKLEME_SAYFASI}">{RESIM_EKLEME_SAYFASI_ADI}</a> )</b>
	</td>
	</tr>
	<tr>
	<td height="90" align="left" class="liste-veri" bgcolor="white">
	<br><img src="portal/temalar/varsayilan/resimler/resimler/istatistik.png" alt="" border="0" width="40" height="40">
	</td>
	<td height="90" align="left" class="liste-veri" bgcolor="white" valign="middle" colspan="2">
	{BURADA} {TOPLAM_RESIM_SAYISI} {RESIM_VAR}.
	<br>{ENCOK_PUAN_ALAN2} : <a href="javascript:void(0);" onClick="sayfa_ac('{ENCOK_PUAN_ALAN_ADRESI}','{RESIM_GENISLIK}','{RESIM_YUKSEKLIK}'); return false;">{ENCOK_PUAN_ALAN}</a>
	<br>{SON_YUKLENEN2} : <a href="javascript:void(0);" onClick="sayfa_ac('{SON_RESIM_ADRESI}','{RESIM_GENISLIK_1}','{RESIM_YUKSEKLIK_1}'); return false;">{SON_RESIM_BILGISI}</a>
	</td>
	</tr>
	<!--__KOSUL_BITIR-gli__-->
	<tr>
	<td align="center" colspan="3" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA4}
	</td>
	</tr>
	</table>
	<br>
	<!--__KOSUL_BITIR-glr__-->
	
	<!--__KOSUL_BASLAT-ste__-->

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
	
	<!--__TEKLI_BASLAT-st1__-->

	<tr>
	<td bgcolor="white" class="alt" style="padding: 10px;"><img src="portal/temalar/varsayilan/resimler/resimler/ozel_sayfalar.gif" alt="{RESIM}" border="0">	</td>
	
	<td bgcolor="white" align="left" class="alt" style="padding: 10px;">&nbsp;{KATEGORI_BASLIK}<br></td>
		
	<td bgcolor="white" align="center" class="alt" style="padding: 10px;"><font face="Verdana" style="font-size: 10px"><b>{TOPLAM_SITE2}</b></font></td>
	
	</tr>

	<!--__TEKLI_BITIR-st1__-->
	<tr>
	<td align="right" class="liste-veri" bgcolor="white" colspan="3" valign="middle">
	<b>( <a href="{SITE_EKLE_SAYFASI_LINK}">{SITE_EKLE_SAYFASI}</a> )</b>
	</td>
	</tr>
	<tr>
	<td height="40" align="left" class="liste-veri" bgcolor="white" valign="middle">
	<br><img src="portal/temalar/varsayilan/resimler/resimler/istatistik.png" alt="." border="0" width="40" height="40">
	</td>
	<td height="40" align="left" class="liste-veri" bgcolor="white" valign="middle" colspan="2">
	{BURADA} {TOPLAM_SITE_SAYISI} {SITE_VAR}.
	<br>{SON_YUKLENEN2} : <a target="_blank" href="{SON_SITE_ADRESI}">{SON_SITE_BILGISI}</a>
	</td>
	</tr>
	
	<tr>
	<td align="center" valign="middle" colspan="3" id="sayfalama_cubuk">
	{SAYFALAMA5}
	</td>
	</tr>
	</table>
	<br>
	<!--__KOSUL_BITIR-ste__-->
	
	<!--__KOSUL_BASLAT-fm__-->

	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="3" width="100%"><b>{FORUM_BASLIK}</b>
	</td>
	</tr>

	

	<!--__TEKLI_BASLAT-fm__-->

	
	<tr>
	<td bgcolor="white" class="alt_haber" align="left">
	
	<div class="dotted-cerceve">
	<font  face="Verdana" style="font-size: 12px;"><b><a href="{ADRES}">{BASLIK}</a></b></font>
	<div align="right">
	<!--__KOSUL_BASLAT-fm5__-->
	( <a href="{SIL44}" onclick="return confirm('{SIL_UYARISI4}');">{SIL4}</a> ) ( <a href="{DUZENLEME4}">{DUZENLE4}</a> ) 
	<!--__KOSUL_BITIR-fm5__-->
	</div>
	<br>
	<br>
	<br>
	{ICERIK}
	
	<br>
	<br>
	<br>
	<div class="liste-veri" align="right"><i>{YAZAN2}: <b>{YAZAN_FRM}</b>
	|&nbsp;{OKUNMA2}: {OKUNMA}
	|&nbsp;{TARIH2}: {TARIH} 
	|&nbsp;{TOPLAM_YORUM}</i>
	</div>	
	</div>
	</td>
	</tr>

	

	<!--__TEKLI_BITIR-fm__-->
	
	
	<tr>
	<td align="center" valign="middle" colspan="3" id="sayfalama_cubuk">
	{SAYFALAMA5}
	</td>
	</tr>
	</table>
	<br>
	<!--__KOSUL_BITIR-fm__-->
	
	<!--__KOSUL_BASLAT-19__-->
	
	<table width="100%" class="cizgi_renk" border="0" cellpadding="0" cellspacing="0" class="forum-kategori-taban">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="6"><b>{SON}&nbsp;{SAYI}&nbsp;{MESAJ}</b>
	</td>
	</tr>

	<tr class="forum_baslik">
	<td align="center" colspan="2" height="30"><b>{KONU}</b></td>
	<td class="mobil-gizle" align="center" width="20%"><b>{YAZAN}</b></td>
	<td class="mobil-gizle" align="center" width="12%"><b>{CEVAP}</b></td>
	<td class="mobil-gizle" align="center" width="12%"><b>{GOSTERIM}</b></td>
	<td align="center" width="20%"><b>{SON_MESAJ}</b></td>
	</tr>
	<tr><td width="100%" colspan="10">
	
	<!--__KOSUL_BASLAT-20__-->
<div id="comments_scroll_divq" style="height:300px; overflow:auto; border: 1px solid #000000">
<div id="comments_scroll_divq2" onmouseover="document.getElementById('comments_scroll_container').stop();" onmouseout="document.getElementById('comments_scroll_container').start();">

	<!--__KOSUL_BITIR-20__-->
	<table width="100%" border="0" cellpadding="0" cellspacing="1">
	
	
	<!--__TEKLI_BASLAT-5__-->

	<tr class="satir_renk1 liste-veri">
	<td align="left" class="son_mesajlar" style="padding: 3px;"><img src="{SON_ILETI_RENGI}" alt="ok" border="0">&nbsp;{MESAJ_BASLIK}</td>
	<td width="20%" class="son_mesajlar mobil-gizle" align="center" style="padding: 3px;">{GONDEREN}</td>
	<td width="12%" class="son_mesajlar mobil-gizle" align="center" style="padding: 3px;">{CEVAP_SAYI}</td> 
	<td width="12%" class="son_mesajlar mobil-gizle" align="center" style="padding: 3px;">{GORUNTULENME}</td>
	<td width="20%" align="left" class="son_mesajlar" style="padding: 3px;">&nbsp;{ZAMAN}<br>&nbsp;{SON_MESAJ}</td>
	</tr>

	<!--__TEKLI_BITIR-5__-->
	
	
	</table>
	<!--__KOSUL_BASLAT-20a__-->
	</div>
</div>
	<script type="text/javascript">//<![CDATA[
hareketli_yazi('comments_scroll_divq', 'comments_scroll_container', 'up', '2', '90', '300', 'genmed');//]]></script>
	<!--__KOSUL_BITIR-20a__-->
	</td>
	</tr>
	</table>
	
	
	
<!--__KOSUL_BITIR-19__-->

	
