<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="link-agaci">{FORUM_ANASAYFA}{FORUM_BASLIK}{ALT_FORUM_BASLIK}{KONU_BASLIK}</div>

<div style="float: left; position: relative; width: 100%; height: 40px;">
<div style="float: left; position: relative; width: 50%; text-align: left;">{BASLIK_CEVAP}</div>
<div style="float: right; position: relative; width: 50%" class="sayfalama">{SAYFALAMA}</div>
</div>

<table cellspacing="1" width="100%" cellpadding="4" border="0" align="left" class="tablo-ana">

<!--__KOSUL_BASLAT-1__-->

	<tr>
	<td colspan="2" class="forum-kategori-alt-baslik" align="left">
{KONU_ANAME}
{KONU_BASLIK2}
<font class="liste-veri" style="color:#ffffff; margin-left:50px"><i>(<?php echo $l['gosterim']; ?>: {GOSTERIM})</i></font>
<div style="float:right; margin:-3px 0 -4px 0">
<div style="float:right; padding:2px 0 0 10px">{KONU_BAGLANTI}</div>
<div style="float:right"><?php echo $ayarlar['sosyal_imleme']; ?></div>
</div>
	</td>
	</tr>

	<tr class="liste-etiket tablo-baslik" bgcolor="#f5f5f5">
	<td width="170" align="center" class="mobil-gizle"><?php echo $l['yazan']; ?></td>
	<td width="100%" align="center"><?php echo $l['icerik']; ?></td>
	</tr>

	<tr class="liste-veri tablo-ici">
	<td width="170" valign="top" rowspan="2" align="left" class="mobil-gizle">
<img src="temalar/varsayilan/resimler/bosluk170.gif" width="170" height="1" border="0" style="display:block;height:0px" alt="boşluk">

<div class="yazar-bilgi"><b>{KONU_ACAN}</b></div>
<div class="yazar-bilgi">[{KONU_ACAN_ADI}]</div>
<div class="yazar-bilgi">{KONU_ACAN_YETKISI}</div>
<div class="yazar-bilgi"><div style="max-width:160px">{KONU_ACAN_RESMI}</div></div>
<div class="yazar-bilgi">
	<font size="1" face="verdana">
<?php echo $l['kayit']; ?>: {KONU_ACAN_KAYIT}
<br>
<?php echo $l['ileti']; ?>: {KONU_ACAN_MESAJSAYI}
<br>
<?php echo $l['konum']; ?>: {KONU_ACAN_SEHIR}
<br>
<?php echo $l['durum']; ?>: {KONU_ACAN_DURUM}
<br>
<br>
{KONU_ACAN_EPOSTA}
{KONU_ACAN_WEB}
<br>
{KONU_ACAN_OZEL}
<br>
</font>
</div>


	</td>

	<td valign="top" height="150">
<div align="left" style="width:52%; float:left; position:relative; padding-left:10px; margin-top:10px">
<div class="masa-gizle tablet-gizle">
<b><?php echo $l['yazan']; ?>:</b> {KONU_ACAN}<br>
</div>
<b><?php echo $l['tarih']; ?>: </b> {KONU_TARIHI}
</div>
<div align="right" style="width:45%; float:right; position:relative; padding-top:4px">
{KONU_ALINTI_DUZENLE}
</div>


<div style="width: 100%; float: left; position: relative;">
<hr size="1" style="border:0;border-bottom: 2px solid #ccc">
<br>
</div>

<div style="clear:both; position:relative; margin:0px 4px 0px 4px; overflow:auto; word-wrap:break-word">

{KONU_ICERIK}

<br><br>
</div>
	</td>
	</tr>

	<tr>
	<td height="23" class="liste-veri tablo-ici" align="left">
{KONU_ACAN_IMZA}
{KONU_DEGISTIRME}
	</td>
	</tr>


<!--__KOSUL_BITIR-1__-->







<!--__KOSUL_BASLAT-2__-->

<!--__TEKLI_BASLAT-1__-->



	<tr>
	<td colspan="2" class="forum-kategori-alt-baslik" align="left">
{CEVAP_ANAME}
{CEVAP_BASLIK}
<div style="float:right; text-align:right; font-size:11px">{ILETI_NO}</div>
	</td>
	</tr>

	<tr class="liste-etiket tablo-baslik" bgcolor="#f5f5f5">
	<td width="170" align="center" class="mobil-gizle"><?php echo $l['yazan']; ?></td>
	<td width="100%" align="center"><?php echo $l['icerik']; ?></td>
	</tr>

	<tr class="liste-veri tablo-ici">
	<td width="170" valign="top" rowspan="2" align="left" class="mobil-gizle">
<img src="temalar/varsayilan/resimler/bosluk170.gif" width="170" height="1" border="0" style="display:block;height:0px" alt="boşluk">
<div class="yazar-bilgi"><b>{CEVAP_YAZAN}</b></div>
<div class="yazar-bilgi">[{CEVAP_YAZAN_ADI}]</div>
<div class="yazar-bilgi">{CEVAP_YAZAN_YETKISI}</div>
<div class="yazar-bilgi"><div style="max-width:160px">{CEVAP_YAZAN_RESMI}</div></div>
<div class="yazar-bilgi"><font size="1" face="verdana">
<?php echo $l['kayit']; ?>: {CEVAP_YAZAN_KAYIT}
<br>
<?php echo $l['ileti']; ?>: {CEVAP_YAZAN_MESAJSAYI}
<br>
<?php echo $l['konum']; ?>: {CEVAP_YAZAN_SEHIR}
<br>
<?php echo $l['durum']; ?>: {CEVAP_YAZAN_DURUM}
<br>
<br>
{CEVAP_YAZAN_EPOSTA}
{CEVAP_YAZAN_WEB}
<br>
{CEVAP_YAZAN_OZEL}
<br>
</font></div>


	</td>

	<td valign="top" height="150">
<div align="left" style="width:52%; float:left; position:relative; padding-left:10px; margin-top:10px">
<div class="masa-gizle tablet-gizle">
<b><?php echo $l['yazan']; ?>:</b> {CEVAP_YAZAN}<br>
</div>
<b><?php echo $l['tarih']; ?>: </b> {CEVAP_TARIHI}
</div>
<div align="right" style="width:45%; float:right; position:relative; padding-top:4px">
{CEVAP_ALINTI_DUZENLE}
</div>


<div style="width: 100%; float: left; position: relative;">
<hr size="1" style="border:0;border-bottom: 2px solid #ccc">
<br>
</div>

<div style="clear:both; position:relative; margin:0px 4px 0px 4px; overflow:auto; word-wrap:break-word">

{CEVAP_ICERIK}

<br><br>
</div>
	</td>
	</tr>

	<tr>
	<td height="23" class="liste-veri tablo-ici" align="left">
{CEVAP_YAZAN_IMZA}

{CEVAP_DEGISTIRME}
	</td>
	</tr>



<!--__TEKLI_BITIR-1__-->


<!--__KOSUL_BITIR-2__-->


</table>



<div style="float: left; position: relative; width: 100%;margin-top:10px">
<div style="float: left; position: relative; width: 50%; text-align: left;">{BASLIK_CEVAP}</div>
<div style="float: right; position: relative; width: 50%" class="sayfalama">{SAYFALAMA}</div>
</div>
<div class="clear"></div>

<div class="link-agaci" style="margin-top:20px">{FORUM_ANASAYFA}{FORUM_BASLIK}{ALT_FORUM_BASLIK}{KONU_BASLIK}</div>


<!--__KOSUL_BASLAT-4__-->

<table cellspacing="1" cellpadding="0" width="100%" border="0" align="center" class="tablo-ana">
	<tr>
	<td colspan="2" class="forum-kategori-baslik" align="left">
&nbsp;{GOR_KISI}
	</td>
	</tr>

	<tr>
	<td colspan="2" class="liste-veri tablo-ici" align="left" style="padding:10px 20px">
&nbsp;{GOR_UYELER}
	</td>
	</tr>
</table>

<!--__KOSUL_BITIR-4__-->


{FORUMLAR_ARASI_GECIS}
<div class="clear"></div>
{BENZER_KONULAR}
{ETIKETLER}


<!--__KOSUL_BASLAT-3__-->

{FORM_BILGI1}
<input type="hidden" name="mesaj_baslik" value="Cvp:">

<table cellspacing="0" cellpadding="0" border="0" align="center" class="hizli_cevap">
	<tr>
	<td class="hizli_cevap_baslik" colspan="2">Hızlı Cevap</td>
	</tr>

	<tr>
	<td class="hizli_cevap_ifadeler" align="center" valign="top" width="142">
<span><?php echo $l['cevap']; ?>:</span>
<div class="ifadeler"><?php echo ifade_olustur(5); ?></div>
	</td>

	<td class="hizli_cevap_form_icerik">
<?php
// Hızlı Cevap için ayarlanan düzenleyici seçiliyor
$duzenleyici = $ayarlar['yduzenleyici'];
$duzenleyici_tip = 'hizli';

// Düz textarea kodu
$duzenleyici_textarea = '<textarea cols="70" rows="15" name="mesaj_icerik" id="mesaj_icerik" class="post" placeholder="'.$l['cevap_yaz'].'..." style="width:98%">{FORM_ICERIK}</textarea>';

// Düzenleyici (Editör) yükleniyor
include_once('phpkf-bilesenler/editor/index.php');
?>

<div style="margin:4px 0 3px -3px">
<label style="cursor:pointer">
<input type="checkbox" name="bbcode_kullan" checked="checked">Bu iletide BBCode kullan</label>
<br>
<label style="cursor:pointer">
<input type="checkbox" name="ifade" checked="checked">Bu iletide ifade kullan</label>
</div>

<div align="center">
<input class="dugme dugme-mavi" name="mesaj_gonder" type="submit" value="G ö n d e r"> &nbsp; &nbsp;
<input class="dugme dugme-mavi" name="mesaj_onizleme" type="submit" value="Önizleme" onclick="onizle_mesaj()" title="Tarayıcınızın JavaScript özelliğinin açık olması gerekir">
</div>
	</td>
	</tr>
</table>

</form>

<!--__KOSUL_BITIR-3__-->
