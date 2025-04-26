<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>


<table width="100%" cellspacing="1" cellpadding="10" border="0" align="center" class="tablo-ana">
<tr class="liste-veri tablo-ust">
<td align="center" colspan="{HUCRE_SAYISI}" height="20">
<font class="kurucu">{KURUCU}</font> - 
<font class="yonetici">{YONETICI}</font> -
<font class="yardimci">{YARDIMCI}</font> -
<font class="blm_yrd">{BLM_YRD}</font>
{GIZLI}
</td>
</tr>

<tr align="center">
<td class="tablo-baslik" width="160"><?php echo $l['uye_adi']; ?></td>
<td class="tablo-baslik mobil-gizle" align="center" width="100"><?php echo $l['son_giris']; ?></td>
<td class="tablo-baslik mobil-gizle" align="center" width="100"><?php echo $l['son_hareket']; ?></td>
<td class="tablo-baslik" align="center"><?php echo $l['bulundugu_sayfa']; ?></td>
<!--__KOSUL_BASLAT-3__-->
<td class="tablo-baslik" align="center" width="110"><?php echo $l['ipadresi']; ?></td>
<!--__KOSUL_BITIR-3__-->
</tr>

<tr class="liste-veri tablo-ici">
<td align="center" colspan="{HUCRE_SAYISI}" height="30">
<b><?php echo $kullanici_sayi.' '.$l['uye'].' '.$l['cevrimici'].' '.$gizli_sayi; ?></b>
</td>
</tr>




<!--__KOSUL_BASLAT-1__-->
<!--__TEKLI_BASLAT-1__-->
<tr class="liste-veri tablo-satir">
<td align="left">&nbsp;{UYE_BAGLANTI}</td>
<td class="mobil-gizle" align="center">{UYE_SON_GIRIS}</td>
<td class="mobil-gizle" align="center">{UYE_SON_HAREKET}</td>
<td align="left">{UYE_SAYFA}</td>
</tr>
<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-1__-->



<!--__KOSUL_BASLAT-4__-->
<!--__TEKLI_BASLAT-1__-->
<tr class="liste-veri tablo-satir">
<td align="left">&nbsp;{UYE_BAGLANTI}</td>
<td class="mobil-gizle" align="center">{UYE_SON_GIRIS}</td>
<td class="mobil-gizle" align="center">{UYE_SON_HAREKET}</td>
<td align="left">{UYE_SAYFA}</td>
<td align="center">{UYE_IP}</td>
</tr>
<!--__TEKLI_BITIR-1__-->
<!--__KOSUL_BITIR-4__-->




<tr class="liste-veri tablo-ici">
<td align="center" colspan="{HUCRE_SAYISI}" height="30">
<b><?php echo $misafir_sayi.' '.$l['misafir'].' '.$l['cevrimici']; ?></b>
</td>
</tr>



<!--__KOSUL_BASLAT-2__-->
<!--__TEKLI_BASLAT-2__-->
<tr class="liste-veri tablo-satir">
<td align="left">&nbsp;{MISAFIR}</td>
<td class="mobil-gizle" align="center">{MISAFIR_SON_GIRIS}</td>
<td class="mobil-gizle" align="center">{MISAFIR_SON_HAREKET}</td>
<td align="left">{MISAFIR_SAYFA}</td>
</tr>
<!--__TEKLI_BITIR-2__-->
<!--__KOSUL_BITIR-2__-->



<!--__KOSUL_BASLAT-5__-->
<!--__TEKLI_BASLAT-2__-->
<tr class="liste-veri tablo-satir">
<td align="left">&nbsp;{MISAFIR}</td>
<td class="mobil-gizle" align="center">{MISAFIR_SON_GIRIS}</td>
<td class="mobil-gizle" align="center">{MISAFIR_SON_HAREKET}</td>
<td align="left">{MISAFIR_SAYFA}</td>
<td align="center">{MISAFIR_IP}</td>
</tr>
<!--__TEKLI_BITIR-2__-->
<!--__KOSUL_BITIR-5__-->


</table>

{SAYFALAMA}


<div class="liste-veri" style="margin-top:7px">
<font size="1"><?php echo $cevrimici_bilgi; ?></font>
<br><br>
</div>
