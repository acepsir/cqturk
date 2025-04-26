<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

{JAVA}

<form name="giris" action="{ACTION}" method="post" onsubmit="return denetle2()">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />
<input type="hidden" name="git" value="{GIT}" />
	<table cellspacing="0" width="480" cellpadding="8" border="0" align="center" style="border:1px solid #cbcbcb">
	<tbody>
	<tr>
	<td class="ana_forum_baslik" colspan="2" align="center" style="border-bottom:1px solid #cbcbcb">
	{BASLIK}
	</td>
	</tr>
	
	<tr>
	<td align="center" colspan="2" bgcolor="#f6f6f6">

	<font face="Verdana" style="font-size: 8pt">&nbsp;&nbsp;{HOSGELDINIZ}<br>
	&nbsp;&nbsp;{IP}: &nbsp;{IP_SONUC}</font><br><br>
	</td>
	</tr>
	
	<tr>
	<td class="liste-etiket" width="130" align="right" valign="top" bgcolor="#f6f6f6">
{KULLANICI_ADI}:
	</td>

	<td class="liste-etiket" align="left" valign="top" bgcolor="#f6f6f6">
<div style="float: left; position: relative;">
&nbsp;<input class="formlar" type="text" name="kullanici_adi" size="33" maxlength="20" value="{KULLANICI_ADI_VALUE}" placeholder="Kullanıcı Adı" required />
 &nbsp; </div> 
<div style="float: left; width: 20px; position: relative;" id="kullanici_adi-alan"></div>
	</td>
	</tr>
	
	<tr>
	<td class="liste-etiket" align="right" valign="top" bgcolor="#f6f6f6">
{SIFRE}:
	</td>

	<td class="liste-etiket" align="left" valign="top" bgcolor="#f6f6f6">
<div style="float: left; position: relative;">
&nbsp;<input class="formlar" type="password" name="sifre" size="33" maxlength="20" value="" placeholder="Şifre" required />
 &nbsp; </div> 
<div style="float: left; width: 20px; height: 10px; position: relative;" id="sifre-alan"></div>
	</td>
	</tr>

	<tr>
	<td bgcolor="#f6f6f6">&nbsp;</td>
	<td height="30" align="left" class="liste-veri" bgcolor="#f6f6f6">
<label style="cursor: pointer;">
<input type="checkbox" name="hatirla" checked="checked" />{HATIRLA}</label>
<br><br>
&nbsp;&nbsp;&nbsp;<input class="dugme" type="submit" value="&nbsp;&nbsp;&nbsp;{GIRIS_YAP}&nbsp;&nbsp;&nbsp;" />
	</td>
	</tr>

	<tr>
	<td colspan="2" height="25" class="liste-veri" align="center" bgcolor="#f6f6f6">
<a href="{GIRIS_DIZIN}etkinlestir.php">{ETKINLESTIRME}</a>
<br>
&nbsp;&nbsp;&nbsp;
<a href="{GIRIS_DIZIN}yeni_sifre.php">{YENI_SIFRE}</a>
&nbsp;<b>|</b>&nbsp;
<a href="{GIRIS_DIZIN}kayit.php">{YENI_KAYIT}</a>
    </td>
    </tr>

	<tr>
	<td colspan="2" height="13" bgcolor="#f6f6f6"></td>
	</tr>

    </tbody>
</table>
	</form>