<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">{PORTAL_GENEL_AYARLARI}</div>
<div class="kutu-icerik">

{JAVA_SCRIPT}

<form action="{AYARLARI_KAYDET_SAYFASI_1}" method="post" onSubmit="return denetle()" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">



<table cellspacing="1" width="100%" cellpadding="0" border="0" align="center" bgcolor="#dddddd">
<tr>
<td class="forum_baslik" align="center" colspan="3">
{PORTAL_GENEL_AYARLARI}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{PORTAL_DILI} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<select class="formlar" name="portal_dili">
{PORTAL_DILI_SONUCU}
</select>
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{PORTAL_TABLO} :
<font size="1">
Genişlik değerini yüzde ve piksel cinsinden giriniz.
<br><b>Örnek:</b> 95% veya 1200px
</font>
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="portal_genislik" size="8" maxlength="10" value="{PORTAL_TABLO_SONUCU}">
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{GALERI_KB} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<select class="formlar" name="galeri_kb">
{GALERI_KB_SONUCU}
</select>
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{BLOK_SEKLI} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<select class="formlar" name="blok_sekli">
{BLOK_SEKLI_SONUCU}
</select>
</td>
</tr>



<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
     {KULLANICI_IZNI} :<br>
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{KULLANICI_IZNI_SONUCU}
</td>
</tr>


<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
     {HABERLER_KULLANICI_IZNI} :<br>
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{HABERLER_KULLANICI_IZNI_SONUCU}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{RESIM_EKLEME} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{RESIM_EKLEME_SONUCU}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{SON_MESAJLAR_HR} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{SON_MESAJLAR_HR_SONUCU}
</td>
</tr>

<!--//////////////////////////////-->

<tr>
<td class="forum_baslik" align="center" colspan="2">
{ORTA_BLOK}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{DUYURU} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{DUYURU_SONUCU}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{SON_MESAJLARI_KAPAT} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{SON_MESAJLARI_KAPAT_SONUCU}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{HABER_AC} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{HABER_AC_SONUCU}
</td>
</tr>


<!--//////////////////////////////-->
<tr>
<td class="forum_baslik" align="center" colspan="3">
{PORTAL_SAYFALAMALAR}
</td>
</tr>

   
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{KARAKTER_SINIRLAMASI} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="karakter_sinirlamasi" size="15" maxlength="5" value="{KARAKTER_SINIRLAMASI_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>
   
<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{SON_MESAJLAR_SAYISI} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="son_mesajlar_sayisi" size="15" maxlength="3" value="{SON_MESAJLAR_SAYISI_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>   


<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{SITELER} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="siteler_limit" size="15" maxlength="3" value="{SITELER_LIMIT_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr> 

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{SITELER_DAL} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="siteler_dal_limit" size="15" maxlength="3" value="{SITELER_DAL_LIMIT_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>  

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{HABER_LIMIT} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="haber_limit" size="15" maxlength="3" value="{HABER_LIMIT_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{HABER_DAL} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="haber_dal_limit" size="15" maxlength="3" value="{HABER_DAL_LIMIT_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{HABER_DALALT} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="haber_dalalt_limit" size="15" maxlength="3" value="{HABER_DALALT_LIMIT_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{DOSYA_DAL} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="dosya_dal_limit" size="15" maxlength="3" value="{DOSYA_DAL_LIMIT_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
    {DOSYA_SAYFALAMA} :<br>
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="dosya_sayfalama" size="15" maxlength="3" value="{DOSYA_SAYFALAMA_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{ANKET} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="anket_limit" size="15" maxlength="3" value="{ANKET_LIMIT_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
    {SITEMAPS} :<br>
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="sitemaps" size="15" maxlength="3" value="{SITEMAPS_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
    {GALERI_LIMIT} :<br>
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="galeri_limit" size="15" maxlength="3" value="{GALERI_LIMIT_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr>


<!--//////////////////////////////-->


<tr>
<td class="forum_baslik" align="center" colspan="3">
{BLOK_LIMIT_AYARLARI}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{EN_COK_MESAJ_ATANLAR} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="en_cok_mesaj_atanlar" size="15" maxlength="3" value="{EN_COK_MESAJ_ATANLAR_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr> 

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{SON_UYELER} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="son_uyeler" size="15" maxlength="3" value="{SON_UYELER_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr> 

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{BLOK_DOSYA_KATEGORILERI} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="blok_dosya_kategorileri" size="15" maxlength="3" value="{BLOK_DOSYA_KATEGORILERI_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr> 

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{BLOK_HABER_KATEGORILERI} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="blok_haber_kategorileri" size="15" maxlength="3" value="{BLOK_HABER_KATEGORILERI_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr> 



<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{BLOK_GALERI_KATEGORILERI} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="blok_galeri_kategorileri" size="15" maxlength="3" value="{BLOK_GALERI_KATEGORILERI_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr> 


<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
{BLOK_SITELER_KATEGORILERI} :
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" align="left">
<input class="formlar" type="text" name="blok_siteler_kategorileri" size="15" maxlength="3" value="{BLOK_SITELER_KATEGORILERI_SONUCU}" onkeyup="karakterfiltre(this);">
</td>
</tr> 


<tr>
<td class="forum_baslik" align="center" colspan="2">
{SAYFA_AYARLARI}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{DAVETIYE}: 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
<select class="formlar" name="davetiye">
{DAVETIYE_SONUCU}
</select>
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{SITEHARITASI_SONUCU} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{SITEHARITASI_SONUCU2}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{A1_ANKETLER_SONUCU} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{A1_ANKETLER_SONUCU2}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{A1_SITELER_SONUCU} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{A1_SITELER_SONUCU2}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{TAKVIM_SONUCU} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{TAKVIM_SONUCU2}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{A1_DOSYALAR_SONUCU} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{A1_DOSYALAR_SONUCU2}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{RESIMGALERISI_SONUCU} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{RESIMGALERISI_SONUCU2}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{HABER_SONUCU} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{HABER_SONUCU2}
</td>
</tr>

<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{PORTAL_ARAMA} : 
</td>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" align="left">
{PORTAL_ARAMA_SONUCU}
</td>
</tr>





<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 9px; margin: 3px;" colspan="2" height="50" align="center">
<a href="javascript:sec()">{HEPSINI_ACIK_SEC}</a> &nbsp;-&nbsp;
<a href="javascript:kaldir()">{HEPSINI_KAPALI_SEC}</a>
</td>
</tr>





<tr>
<td class="liste-veri" style="background-color: #ffffff; padding: 8px; margin: 3px;" colspan="2" height="50" align="center">
<input class="dugme" type="submit" name="ayar_degistir" value="{GONDER}">
 &nbsp; &nbsp; &nbsp;
<input class="dugme" type="reset" name="temizle" value="{TEMIZLE}">
</td>
</tr>


</table>
</form>

</div>
