<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<table cellspacing="0" width="100%" cellpadding="0" border="0" align="center">

<!--__KOSUL_BASLAT-3__-->

<!--__DIS_BASLAT-1__-->


<tr>
	<td align="center">

<table cellspacing="1" width="100%" cellpadding="3" border="0" align="center" class="forum-kategori-taban">
<tr>
	<td colspan="6" class="forum-kategori-alt-baslik" align="left" valign="middle">
{FORUM_DALI_BASLIK}
	</td>
</tr>

<tr class="forum-kategori-baslik" align="center" style="height:25px">
	<td colspan="3">Forum</td>
	<td width="225" class="tablet-gizle mobil-gizle">Son Konu</td>
	<td width="55" class="mobil-gizle">Başlık</td>
	<td width="55" class="mobil-gizle">ileti</td>
</tr>


<!--__KOSUL_BASLAT-4__-->

<!--__IC_BASLAT-1__-->


<tr bgcolor="#fafafa">
	<td align="center" valign="middle" width="45" class="forum-klasor mobil-gizle">
<img {FORUM_KLASOR}>
	</td>

	<td align="center" width="45" class="forum-ozel-klasor">
<img {FORUM_OZEL_KLASOR}>
	</td>

	<td align="left" valign="top" class="liste-veri">
<a href="{FORUM_BAGLANTI}"><b>{FORUM_BASLIK}</b></a> &nbsp; <font color="#ff0000"><i>{FORUM_GOR}</i></font>
<br>{FORUM_BILGI}
{FORUM_YARDIMCILARI}
{ALT_FORUMLAR}
	</td>

	<td align="left" valign="top" class="liste-veri tablet-gizle mobil-gizle">
{SONMESAJ_BASLIK}
{SONMESAJ_YAZAN}
<p align="right">{SONMESAJ_TARIH}&nbsp;{SONMESAJ_GIT}</p>
	</td>

	<td align="center" class="liste-veri mobil-gizle" style="font-family: Times New Roman; font-size: 24px;">
<i>{FORUM_BASLIK_SAYISI}</i>
	</td>

	<td align="center" class="liste-veri mobil-gizle" style="font-family: Times New Roman; font-size: 24px;">
<i>{FORUM_MESAJ_SAYISI}</i>
	</td>
</tr>


<!--__IC_BITIR-1__-->

<!--__KOSUL_BITIR-4__-->


</table>

<!--__DIS_BITIR-1__-->


<!--__KOSUL_BITIR-3__-->





<!--__KOSUL_BASLAT-5__-->


<table cellspacing="1" width="100%" cellpadding="2" border="0" align="center" bgcolor="#dddddd">
<tr>
	<td colspan="6" height="20" class="forum-kategori-alt-baslik" align="center" valign="middle">
	&nbsp;
	</td>
</tr>

<tr>
	<td align="center" bgcolor="#ffffff">
<br>
<b>{FORUM_DALI_YOK}</b>
<br><br>

	</td>
</tr>
</table>


<!--__KOSUL_BITIR-5__-->





<!--__KOSUL_BASLAT-2__-->



<table cellspacing="1" width="100%" cellpadding="4" border="0" align="center" class="forum-kategori-taban">
<tr>
	<td class="forum-kategori-alt-baslik" colspan="7" height="20" align="left" valign="middle">
Güncel Konular
	</td>
</tr>

<tr class="forum-kategori-baslik">
	<td align="center" colspan="2">Başlık</td>
	<td align="center" class="tablet-gizle mobil-gizle">Forum</td>
	<td align="center" width="100" class="mobil-gizle">Yazan</td>
	<td align="center" width="55" class="mobil-gizle">Cevap</td>
	<td align="center" width="70" class="mobil-gizle">Gösterim</td>
	<td align="center" width="130">Son ileti</td>
</tr>



<!--__TEKLI_BASLAT-1__-->

<tr class="{SATIR_RENK}">
	<td align="center" width="40" height="30">
<img {ACIK_KONU} alt="Konu Klasör">
	</td>

	<td align="left">
{SON10KONU_BASLIK}
	</td>

	<td align="left" class="tablet-gizle mobil-gizle">
{SON10KONU_FORUMBASLIK}
	</td>

	<td align="center" class="mobil-gizle" title="Kullanıcı profilini görüntüle">
{SON10KONU_ACAN}
	</td>

	<td align="center" class="mobil-gizle">
{SON10KONU_CEVAPSAYI}
	</td>

	<td align="center" class="mobil-gizle">
{SON10KONU_GORSAYISI}
	</td>

	<td align="right" class="son-ileti-tarih">
{SON10KONU_SONTARIH}
<br>
{SON10KONU_SONYAZAN}
	</td>
</tr>

<!--__TEKLI_BITIR-1__-->

</table>

<!--__KOSUL_BITIR-2__-->


<table cellspacing="1" width="100%" cellpadding="2" border="0" align="center" class="forum-kategori-taban">
<tr>
	<td align="left" class="forum-kategori-alt-baslik" colspan="2">
Forum Bilgileri
	</td>
</tr>

<tr bgcolor="#ffffff">
	<td align="center" width="55" height="48">
<img {FORUMBILGI_RESIM} alt="Forum Bilgi">
	</td>

	<td align="left" class="liste-veri">
&nbsp; Toplam başlık: <b>{TOPLAM_BASLIK_SAYI}</b>
&nbsp; Toplam ileti: <b>{TOPLAM_MESAJ_SAYI}</b><br>
&nbsp; Toplam üye: <b>{TOPLAM_UYE_SAYI}</b><br>
&nbsp; En yeni üye: <b>{YENI_UYE}</b>
	</td>
</tr>



<tr>
	<td align="left" class="forum-kategori-alt-baslik" colspan="2">
Çevrimiçi Kullanıcılar
	</td>
</tr>

<tr bgcolor="#ffffff">
	<td align="center" width="55" height="63">
<img {CEVRIMICI_RESIM} alt="Çevrimiçi">
	</td>

	<td align="left" class="liste-veri" height="35">
&nbsp; Toplam <b>{CEVRIMICI_TOPLAM}</b> kullanıcı çevrimiçi (<b>{CEVRIMCI_UYE}</b> kayıtlı, <b>{CEVRIMCI_GIZLI}</b> gizli, <b>{CEVRIMCI_MISAFIR}</b> misafir)
 
&nbsp; <font class="kurucu">{AYARLAR_KURUCU}</font> - 
<font class="yonetici">{AYARLAR_YONETICI}</font> -
<font class="yardimci">{AYARLAR_YARDIMCI}</font> - 
<font class="blm_yrd">{AYARLAR_BLM_YRD}</font>

{SON_24_SAAT_CEVRIMCI}
<br>&nbsp; Çevrimiçi üyeler: 
{CEVRIMCI_ISIMLER}
<br>&nbsp; Buradaki veriler son {CEVRIMICI_ZAMAN} dakika içerisinde etkin olan ziyaretçilere aittir.

<br>&nbsp; <a href="cevrimici.php">Tüm çevrimiçi kullanıcıları göster.</a>
	</td>
</tr>

{BUGUN_DOGANLAR}


<!--__KOSUL_BASLAT-1__-->
<tr>
	<td align="center" class="liste-veri" bgcolor="#ffffff" colspan="2" height="45">

{JAVASCRIPT_KODU}

<form name="giris" action="giris.php" method="post" onsubmit="return denetle()">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />
<input type="hidden" name="git" value="{FORUM_INDEX}" />

<b>Kullanıcı Adı: </b>
<input class="formlar" type="text" name="kullanici_adi" size="20" maxlength="20" placeholder="Kullanıcı Adı" required />
&nbsp; &nbsp; <b>Şifre: </b>
<input class="formlar" type="password" name="sifre" size="20" maxlength="20" placeholder="Şifre" required />
&nbsp; &nbsp; <label style="cursor: pointer;"><input type="checkbox" name="hatirla" checked="checked" style="position: relative; top: 3px;" />Beni Hatırla</label>
&nbsp; &nbsp; <input class="dugme" type="submit" value="Giriş Yap" />
</form>

	</td>
</tr>
<!--__KOSUL_BITIR-1__-->


</table>



<table cellspacing="1" width="100%" cellpadding="5" border="0" align="center" bgcolor="#dddddd">
<tr bgcolor="#ffffff" class="mobil-gizle">
	<td align="center" width="80"><img {ACIK_FORUM} alt="Herkese Açık Forum"></td>
	<td align="left"><font class="liste-veri" style="font-size:13px">&nbsp;Herkese Açık Forum</font></td>

	<td align="center" width="80"><img {UYELER_FORUM} alt="Sadece Üyelere Açık Forum"></td>
	<td align="left"><font class="liste-veri" style="font-size:13px">&nbsp;Üyelere Açık Forum</font></td>

	<td align="center" width="80"><img {OZEL_FORUM} alt="Sadece Özel Yetkilere Sahip Üyelere Açık Forum"></td>
	<td align="left"><font class="liste-veri" style="font-size:13px">&nbsp;Özel Forum</font></td>
</tr>

<tr bgcolor="#ffffff" class="mobil-gizle">
	<td align="center" width="80"><img {YARDIMCI_FORUM} alt="Sadece Yöneticilere ve Yardımcılara Açık Forum"></td>
	<td align="left"><font class="liste-veri" style="font-size:13px">&nbsp;Yardımcılara Açık Forum</font></td>

	<td align="center" width="80"><img {YONETICI_FORUM} alt="Sadece Yöneticilere Açık Forum"></td>
	<td align="left"><font class="liste-veri" style="font-size:13px">&nbsp;Yöneticilere Açık Forum</font></td>

	<td align="center" width="80"><img {KAPALI_FORUM} alt="Kapalı Forum"></td>
	<td align="left"><font class="liste-veri" style="font-size:13px">&nbsp;Kapalı Forum</font></td>
</tr>
<tr bgcolor="#ffffff">
	<td align="center" class="liste-veri" colspan="6">
<div style="margin-top:5px"><b>Geçerli zaman:</b> &nbsp;{GUNCEL_ZAMAN}</div>
	</td>
</tr>
</table>


</td></tr></table>
