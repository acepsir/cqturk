<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

include_once('menu.php');
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">Yönetim Ana Sayfası</div>
<div class="kutu-icerik">

<center>
<font size="2">
<b>php Kolay Foruma (phpKF) Hoş Geldiniz !</b>
</font>
</center><br>
&nbsp; &nbsp; Forumun yönetimiyle ilgili sayfalara, sol taraftaki menüden ulaşabilirsiniz.
<br>&nbsp; &nbsp; Veritabanı yedeği alma veya yükleme işlemlerini sadece site kurucusu yapabilir.
<br><br>



<table cellspacing="1" width="100%" cellpadding="6" border="0" align="left" bgcolor="#d0d0d0">
	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff" width="200">
Forum Açılış Tarihi:
	</td>
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{ACILIS_TARIHI}
	</td>
	</tr>

	<tr>
	<td align="left" valign="middle" class="liste-etiket" bgcolor="#ffffff">
phpKF Sürümü:
	</td>
	<td align="left" valign="bottom" height="25" class="liste-veri" bgcolor="#ffffff">
<div id="katman_surum2" style="float:left; width:98px; height: 20px">{PHPKF_SURUM}</div>
<div id="katman_surum3" style="float:left; height: 20px">
{SURUM_DENETLE}
</div>
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff">
MySQL Sürümü:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{MYSQL_SURUM}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff">
PHP Sürümü:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{PHP_SURUM}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff">
ZEND Sürümü:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{ZEND_SURUM}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff">
Sunucu İşletim Sistemi:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{SUNUCU_IS}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff">
Diğer:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{SUNUCU_BILGI}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff" valign="top">
GD Kütüphanesi:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{GD_BILGI}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff" valign="top">
Gzip Sıkıştırma Desteği:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{GZIP}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff" valign="top">
register_globals ayarı:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{REGISTER_GLOBALS}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff" valign="top">
safe_mode ayarı:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{SAFE_MODE}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff">
Resim Dizini Boyutu:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{RESIM_BOYUTU}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff">
Eklentiler Dizini Boyutu:
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{EKLENTILER_BOYUTU}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-etiket" bgcolor="#ffffff">
Veritabanı Boyutu:
	</td>
	<td align="left" class="liste-veri" bgcolor="#ffffff">
{VT_BOYUTU}
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-veri" bgcolor="#ffffff" colspan="2" style="line-height:30px">
&nbsp; Veritabanı yönetimi için <a href="vt_yonetim.php">tıklayın</a>. (Ayrıntı alma, onarma, ek yük giderme) 
<br>
&nbsp; Daha ayrıntılı MySQL bilgileri için <a href="show_status.php">tıklayın</a>. "SHOW STATUS"
<br>
&nbsp; Daha ayrıntılı sunucu bilgileri için <a href="phpinfo.php">tıklayın</a>. "phpinfo()"
	</td>
	</tr>

	<tr>
	<td class="forum_baslik" bgcolor="#0099ff" align="center" colspan="2">
phpKF Duyuru Ekranı
	</td>
	</tr>

	<tr>
	<td align="left" class="liste-veri" bgcolor="#ffffff" colspan="2" style="margin:20px">
{PHPKF_DUYURU}
<br><br>
<img width="0" height="0" border="0" src="../dosyalar/yukleniyor.gif" alt="">
	</td>
	</tr>
</table>

{JAVASCRIPT_KODU}

</div>
</div>
</div>
