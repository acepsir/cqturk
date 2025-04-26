<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

	<!--__KOSUL_BASLAT-4__-->
	

	<br>
	<br>
	<br>
	<br>
	<table width="380" border="0" class="cizgi_renk" cellspacing="1" cellpadding="4" align="center">
	<tr>
	<td class="forum_baslik" colspan="2" align="center"><b>{DOSYA_INDIR}</b>
	</td>
	</tr>
	<tr>
	<td align="center">
	<hr>
	<font face="Verdana" style="font-size: 11px"><b>{DOSYA_ADI_I}:&nbsp;{DOSYA_ADI_I_SONUCU}</b></font>
	<br>
	<br>
	<img src="temalar/{TEMA_DIZIN}/resimler/resimler/indiriliyor2.gif" alt="{DOSYA_INDIRILIYOR}" title="{DOSYA_INDIRILIYOR}" border="0">
	<meta http-equiv="Refresh" content="2; url={DOSYA_ADRESI}">
	<br>
	<br>
	<br><font face="Verdana" style="font-size: 11px">{BASARISIZ_OLURSA} <a href="{DOSYA_ADRESI}">{TIKLAYIN}</a></font>
	<br>
	<br>
	</td>
	</tr>
	</table>
	

	<br>
	<br>

	<!--__KOSUL_BITIR-4__-->


	<!--__KOSUL_BASLAT-3__-->
	
	{JAVA_SCRIPT}
	
	 <script type="text/javascript">
<!-- //
function SayiArttir(){
    var now = new Date();
    var sayac = Math.random();
	sayac++;
	document.images.onaykodu.src="../phpkf-bilesenler/onay_kodu.php?a=1&sayi="+sayac+"&oturum={SESSION_ID}";
}
//  -->
</script>

	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
	
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="4" width="100%" bgcolor="white"><b>{DOSYA_INDIR2}</b></td>
	</tr>
	<tr>
	<td bgcolor="white" width="15%" align="center"><img width="130" height="140" src="../{DOSYA_RESIM}" alt="" border="0"></td>
	<td colspan="3" bgcolor="white" nowrap="nowrap" align="left">
	<div align="right">
	<!--__KOSUL_BASLAT-10__-->
    <a href="{DOSYAYI_DUZELT_1}" onclick="return confirm('{DOSYA_SIL_ONAY}');"><img {SIMGE_SIL} alt="{DOSYA_SIL}" title="{DOSYA_SIL}"></a>&nbsp;

	<a href="{DOSYAYI_SIL_1}"><img {SIMGE_DUZELT} alt="{DOSYA_DUZELT}" title="{DOSYA_DUZELT}"></a>&nbsp;

	<!--__KOSUL_BITIR-10__-->
	<a target="_blank" href="{DOSYAYI_YAZDIR_1}"><img {YAZDIR_SIMGE} alt="{DOSYA_YAZDIR}" title="{DOSYA_YAZDIR}"></a>&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	<font  face="Verdana" style="font-size: 11px;">
	<b>&nbsp;{DOSYA_ADI2} :</b> {DOSYAYI_INDIR_1}
	<br>&nbsp;<b>{URETICI} :</b> {URETICI_SONUCU}
	<br>&nbsp;<b>{DIL} :</b> {DIL_SONUCU}
	<br>&nbsp;<b>{BOYUT} :</b> {BOYUT_SONUCU}
	<br>&nbsp;<b>{EKLEYEN} :</b> <a href="{EKLEYEN_LINKI}">{EKLEYEN_SONUCU}</a>
	<br>&nbsp;<b>{EKLEME_TARIHI} :</b> {EKLEME_TARIHI_SONUCU}
	<br>&nbsp;<b>{INDIRME_SAYISI} :</b> {INDIRME_SAYISI_SONUCU}
	<br>&nbsp;<b>{LISANS} :</b> {KULLANIM}
	</font>	
	</td>
	</tr>

    <tr>
	<td align="center" bgcolor="white" class="liste-veri" valign="middle" colspan="4">
	<form action="{DOSYAYI_INDIR_11}" method="post" name="f" onSubmit="return denetle()">

	<img src="temalar/varsayilan/resimler/resimler/yenile.png" border="0" title="{ONAYKODU1}" alt="{ONAYKODU1}" width="25" height="31" style="cursor:pointer" onclick="javascript:SayiArttir()">

	<img src="../phpkf-bilesenler/onay_kodu.php?a=1&amp;oturum={ONAY_ID}" border="1" title="{DOSYAYI_INDIRMEK_ICIN}" alt="{DOSYAYI_INDIRMEK_ICIN}" id="onaykodu" width="140" height="35">

	&nbsp;<input class="formlar" type="text" name="onay_kodu" size="7" maxlength="6">
	<input class="dugme" type="submit" value="{INDIR}" name="gonder111" title="{BU_ONAY}">
	
	</form>
	
	<script type="text/javascript">
<!-- //
document.f.onay_kodu.setAttribute("autocomplete","off"); 
//  -->
</script>
	</td>
    </tr>


	<tr>
	<td colspan="4" bgcolor="white" align="left">
	<div style="width: 100%; float: left; position: relative; border: 0px solid #0099ff; overflow: auto; font-family: Verdana; font-size: 12px;">
	<br>&nbsp;<u><b>{ACIKLAMA} :</b></u> <br><br>&nbsp;{ACIKLAMA_SONUCU}
	</div>
	<br>
	<br>
	</td>
	</tr>

	
	<tr>
	<td colspan="4" bgcolor="white" align="left">
	<font face="Verdana" style="font-size: 12px">{DEGISTIRME_SAYISI}</font>
	</td>
	</tr>


	<tr class="forum_baslik" align="center">
	<td width="15%">
	<font face="Verdana" color="#ffffff" style="font-size: 12px">{YORUMLAYAN}</font>
	</td>
	<td width="79%" colspan="2">
	<font face="Verdana" color="#ffffff" style="font-size: 12px">{YORUM}</font>
	</td>
	<td width="1%" nowrap="nowrap">
	<font face="Verdana" color="#ffffff" style="font-size: 12px">{YORUM_SIL} </font>
	</td>
	</tr>

	
	<!--__TEKLI_BASLAT-3__-->
	
	
	<tr>
	<td width="15%" bgcolor="white" align="left">&nbsp;
	<font face="Verdana" style="font-size: 10px">{YORUMLAYAN}<br>&nbsp;&nbsp;{ZAMAN_}</font>
	</td>
	<td width="79%" bgcolor="white"  colspan="2" align="left">&nbsp;
	<font face="Verdana" style="font-size: 10px">{YORUM_ICERIK}</font>
	</td>
	<td width="1%" bgcolor="white" align="center">
	
	<!--__KOSUL_BASLAT-13__-->
	<form action="{DOSYA_YORUM_11}" method="post" name="form1" onclick="return confirm('{DOSYA_SIL_ONAY}');">
	<input type="hidden" name="no" value="{DOSYA_NO_}">
	<input class="dugme" name="sil" type="submit" value="{SIL_}">
	</form>
	<!--__KOSUL_BITIR-13__-->
	
	<!--__TEKLI_BITIR-3__-->
	
	</td>
	</tr>
	<!--__KOSUL_BASLAT-sa__-->
	<tr>
	<td align="center" colspan="4" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>
	<!--__KOSUL_BITIR-sa__-->
	<!--__KOSUL_BASLAT-7__-->
	
	<tr>
	<td class="liste-veri" bgcolor="white" height="30" align="left" colspan="4">
	
	<table cellspacing="0" width="100%" cellpadding="5" border="0" align="center">
	<tr>
	<td class="liste-etiket" valign="top" align="center" bgcolor="white">
	<br><br>
	<form action="{DOSYA_YORUM_EKLE}" method="post" name="form" onsubmit="return denetle10();">
	<input type="hidden" name="no" value="{DOSYA_NO}">
	<input type="hidden" name="kategorino" value="{KATEGORI_NO}">
	<textarea rows="10" cols="50" name="yorum_icerik" class="formlar"></textarea>
	<br><br>
	<input class="dugme" name="yorumla" type="submit" value="{YORUM_GONDER}">
	&nbsp; &nbsp; 
	<input class="dugme" type="reset" name="reset" value="{YORUM_TEMIZLE}">
	</form>
	<br>
	<br>
	</td>
	</tr>
	</table>
	
	</td>
	</tr>
	
	<!--__KOSUL_BITIR-7__-->
	

	</table>
	
	<!--__KOSUL_BITIR-3__-->
	
	
	<!--__KOSUL_BASLAT-2__-->


	<table width="100%" class="cizgi_renk" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
	<tr>
	<td class="ana_forum_baslik" align="center" colspan="7" width="100%"><b>{DOSYALAR}</b></td>
	</tr>
	
	<tr class="forum_baslik" align="left">	
	<td width="1%"></td>
	<td align="center"><font face="Verdana" color="#ffffff" style="font-size: 12px">{DOSYA_ADI_I}</font></td>
	<td width="13%" align="center" nowrap="nowrap"><font face="Verdana" color="#ffffff" style="font-size: 12px">{EKLEME_TARIHI}</font></td>
	<td width="13%" align="center"><font face="Verdana" color="#ffffff" style="font-size: 12px">{BOYUT}</font></td>
	<td width="13%" align="center"><font face="Verdana" color="#ffffff" style="font-size: 12px">{EKLEYEN}</font></td>
	<td width="10%" align="center"><font face="Verdana" color="#ffffff" style="font-size: 12px">{INDIRME_SAYISI}</font></td>
	<!--__KOSUL_BASLAT-gi1__-->
	<td width="10%" align="center"><font face="Verdana" color="#ffffff" style="font-size: 12px">{DUZENLEME2}</font></td>
	<!--__KOSUL_BITIR-gi1__-->
	</tr>
	
	<!--__KOSUL_BASLAT-5__-->
	
	<!--__KOSUL_BASLAT-14__-->
	<tr>
	<td bgcolor="white" colspan="7" align="center">
	<br>
	<br>
	<a href="{YENI_DOSYA_EKLE2}"><font  face="Verdana" style="font-size: 12px">{YENI_DOSYA_EKLE}</font></a>
	<br>
	<br>
	<br>
	</td>
	</tr>
	<!--__KOSUL_BITIR-14__-->
	
	<!--__KOSUL_BASLAT-15__-->
	<tr>
	<td bgcolor="white" colspan="7" align="center">
	<br>
	<br>
	<font  face="Verdana" style="font-size: 12px">{DOSYA_YOK_}..</font>
	<br>
	<br>
	<br>
	</td>
	</tr>
	<!--__KOSUL_BITIR-15__-->

	<!--__KOSUL_BITIR-5__-->
	

	<!--__KOSUL_BASLAT-6__-->
	
	<!--__TEKLI_BASLAT-4__-->
	<tr>
	<td bgcolor="white"><img src="temalar/{TEMA_DIZIN}/resimler/resimler/enter.gif" alt="enter" border="0"></td>
	<td bgcolor="white" style="font-size: 10px; font-family: Verdana;" align="left">{DOSYA_LINKI_11}</td>
	<td bgcolor="white" align="center" style="font-size: 10px; font-family: Verdana;">{INDIR_TARIH_}</td>
	<td bgcolor="white" align="center" style="font-size: 10px; font-family: Verdana;">{INDIR_BOYUT_}</td>
	<td bgcolor="white" align="center" style="font-size: 10px; font-family: Verdana;"><a href="{INDIR_LINK_}">{INDIR_EKLEYEN_}</a></td>
	<td bgcolor="white" align="center" style="font-size: 10px; font-family: Verdana;">{INDIR_INDIRME_SAYISI_}</td>

	<!--__KOSUL_BASLAT-16__-->
	<td bgcolor="white" align="center">
	<a href="{DOSYA_DUZELT_22}" onclick="return confirm('{INDIR_SIL_ONAY_}');"><img {SIMGE_SIL} alt="{INDIR_SIL_}" title="{INDIR_SIL_}"></a>&nbsp;
	
	<a href="{DOSYA_SIL_22}"><img {SIMGE_DUZELT} alt="{INDIR_DUZELT_}" title="{INDIR_DUZELT_}"></a>&nbsp;</td>
	<!--__KOSUL_BITIR-16__-->
	
	<!--__TEKLI_BITIR-4__-->
	
	<!--__KOSUL_BITIR-6__-->
	
	</tr>
<!--__KOSUL_BASLAT-sa__-->
	<tr>
	<td align="center" colspan="7" valign="middle" id="sayfalama_cubuk">
	{SAYFALAMA2}
	</td>
	</tr>
	<!--__KOSUL_BITIR-sa__-->
	</table>

	<!--__KOSUL_BITIR-2__-->
	
	<!--__KOSUL_BASLAT-1__-->
		

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
	
	<!--__TEKLI_BASLAT-1__-->

	<tr>
	<td class="alt" style="padding: 5px;"><img src="temalar/{TEMA_DIZIN}/resimler/resimler/kategori.gif" alt="{RESIM}" border="0">	</td>
	
	<td class="alt" style="padding: 5px;" align="left">&nbsp;<a href="{DOSYA_DALI_LINKI}"><font face="Verdana" style="font-size: 13px">{KATEGORI_ADI}</font></a><br></td>

	<td class="alt" style="padding: 5px;" align="left">{DOSYA_SONUC}</td>
	
	<td class="alt" style="padding: 5px;" align="left">{YORUM_SONUC}	</td>
	
	<td class="alt" style="padding: 5px;" align="center"><font face="Verdana" style="font-size: 10px"><b>{ICERIK}</b></font></td>
	
	<td class="alt" style="padding: 5px;" align="center"><font face="Verdana" style="font-size: 10px"> <b>{ICERIK_2}</b></font></td>
	</tr>

	<!--__TEKLI_BITIR-1__-->
	
	
	<tr>
	<td align="center" valign="middle" colspan="6" id="sayfalama_cubuk">
	{SAYFALAMA}
	</td>
	</tr>





	</table>
	
	<!--__KOSUL_BITIR-1__-->
	



