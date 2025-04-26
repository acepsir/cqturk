<?php
/*
 +-=========================================================================-+
 |                                phpKF v3.00                                |
 +---------------------------------------------------------------------------+
 |                  Telif - Copyright (c) 2007 - 2019 phpKF                  |
 |                    www.phpKF.com   -   phpKF@phpKF.com                    |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkarma ve satma hakları sadece phpKF`ye aittir. |
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  phpKF.com/telif.php  adresini ziyaret edin. |
 +-=========================================================================-+*/


if (!defined('PHPKF_ICINDEN')) define('PHPKF_ICINDEN', true);
if (!defined('DOSYA_DIL')) include_once('diller/index.php');
header("Content-type: text/html; charset=utf-8");
$guncel_surum = '3.00';



//  SAYFA BAŞI   //

echo '<!DOCTYPE html>
<html lang="'.$site_dili.'" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../phpkf-bilesenler/temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<link href="sablon.css" rel="stylesheet" type="text/css" />
<title>'.$lk[0].'</title>
</head>
<body>
<div class="ana_govde" style="margin:0 auto; width:100%; max-width:770px">


<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center" bgcolor="#d0d0d0">
<tbody>
	<tr>
	<td class="liste-veri" bgcolor="#f9f9f9" colspan="5" height="50" valign="middle">

'.$TEMA_DIL_SECIM.'

<script type="text/javascript"><!-- //
function denetle()
{
	var dogruMu = true;
	for (var i=0; i<16; i++)
	{
		if (document.kurulum_formu.elements[i].name == "vt_kullanici") continue;
		else if (document.kurulum_formu.elements[i].name == "vt_sifre") continue;
		else if (document.kurulum_formu.elements[i].value=="")
		{
			dogruMu = false;
			alert("'.$lk[1].'");
			break;
		}
	}

	if (document.kurulum_formu.telif_kabul.checked != true )
	{
		dogruMu = false;
		alert("'.$lk[2][1].'");
	}

	return dogruMu;
}
// -->
</script>
	<td>
	<tr>

	<tr class="liste-veri">
	<td width="110" height="27" align="center" valign="middle" bgcolor="#eeeeee" style="border-top: 1px solid #d0d0d0; border-left: 1px solid #d0d0d0; border-right: 1px solid #d0d0d0;">
<b>'.$lk[69].'</b>
	</td>

	<td width="110" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="guncelle.php"><b>'.$lk[70].'</b></a>
	</td>

	<td width="110" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="yukleme.php"><b>'.$lk[71].'</b></a>
	</td>

	<td width="110" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="sil.php"><b>'.$lk[72].'</b></a>
	</td>

	<td bgcolor="#f9f9f9">&nbsp;</td>
	</tr>
</tbody>
</table>



<table cellspacing="1" cellpadding="0" width="100%" border="0" align="center" bgcolor="#d0d0d0">
<tbody>
	<tr>
	<td align="center">

<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center" class="tablo_border2">
<tbody>
	<tr>
	<td height="17"></td>
	</tr>

	<tr>
	<td align="center" valign="top">

<table cellspacing="1" cellpadding="0" width="96%" border="0" class="tablo_border3">
<tbody>
	<tr>
	<td>

<table cellspacing="0" width="100%" cellpadding="15" border="0" align="center" class="tablo_ici">
<tbody>
	<tr>
	<td align="left" class="liste-veri">
<p align="center"><font color="#ff0000"><b><u>'.$lk[3].'</u></b></font></p>
<ul style="padding:15px; margin:0px; line-height:20px">
'.$lk[4].'
</ul>
<br />
<font color="#ff0000"><b>'.$lk[16].'</b></font>
&nbsp; '.$lk[17].'
<center><br /><br />
<b>'.$lk[5].'</b>
<br /><br />';


// ayar.php varsa sürüm numarasını göster

if (@is_file('../phpkf-ayar.php'))
{
	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
	include_once('../phpkf-ayar.php');
	$kurulu_surum = @$ayarlar['surum'];


	if ( (isset($kurulu_surum)) AND ($kurulu_surum == $guncel_surum) );

	elseif ( (isset($kurulu_surum)) AND ($kurulu_surum > $guncel_surum) )
		echo '<br /><br /><span style="color:#ff0000;font-weight:bold">'.$lk[6][0].'</span><br />';


	else
	{
		echo'<form action="guncelle.php" method="get" name="guncelle_formu">
		<br /><span style="color:#ff0000;font-weight:bold">'.$lk[6][1].'</span>
		<br /><br /><b>'.$lk[7].' &nbsp; </b><u>'.$kurulu_surum.'</u>
		<br /><br />
		<input class="dugme" type="submit" value="'.$lk[9].'" />
		</form>';
	}
}



echo '
</center>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr>
	<tr>
	<td height="17"></td>
	</tr>
</tbody></table>
</td></tr></tbody></table>
<br /><br />
';



//  SUNUCUDAKİ PHP SÜRÜMÜNE BAKILIYOR   //

if (@phpversion())
{
	$php_surum = @phpversion();

	if($php_surum < '4.0') echo '<br /><font color="#ff0000" style="font-weight: bold;">
'.$lk[14].'
</font><br /><br /><br />';
}

else echo '<br /><font color="#ff0000" style="font-weight: bold;">
'.$lk[14].'
</font><br /><br /><br />';



$dizin = dirname(dirname($_SERVER['PHP_SELF']));
if ($dizin == '\\') $dizin = '/'; 



echo '
<form action="kurulum.php" method="post" onsubmit="return denetle()" name="kurulum_formu">
<input type="hidden" name="kurulum" value="form_dolu" />


<table cellspacing="1" cellpadding="0" width="100%" border="0" align="center" bgcolor="#d0d0d0">
<tbody>
	<tr>
	<td align="center">

<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center" class="tablo_border2">
<tbody>
	<tr>
	<td align="center" valign="top" height="17"></td>
	</tr>

	<tr>
	<td align="center" valign="top">

<table cellspacing="1" cellpadding="0" width="96%" border="0" class="tablo_border3">
<tbody>
	<tr>
	<td>

<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" class="tablo_ici">
<tbody>
	<tr>
	<td class="baslik" colspan="2" align="center" height="45">'.$lk[20].'	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left">
<br />
&nbsp; &nbsp; '.$lk[21].'<br />
&nbsp; &nbsp; '.$lk[22].'
<br />
<br />
&nbsp; &nbsp; '.$lk[23].' <a href="http://www.phpkf.com/phpkf-cms/cms-kurulum-klavuzu.html" target="_blank">'.$lk[19].'</a>
<br /><br /><br />
<font size="1">
<i>&nbsp; &nbsp; '.$lk[24].'</i>
</font>
	</td>
	</tr>

	<tr>
	<td>


<table cellspacing="1" width="96%" cellpadding="5" border="0" align="center" bgcolor="#d0d0d0">
<tbody>
	<tr>
	<td colspan="2" class="site_baslik" align="center" style="height: 14px;">
'.$lk[25].'
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left" width="50%">
'.$lk[26].'<br />
<font size="1" style="font-weight: normal">'.$lk[27].'</font>
	</td>

	<td align="left" width="50%">
<input class="formlar" type="text" name="alanadi" size="32" maxlength="100" value="'.$_SERVER['HTTP_HOST'].'" required />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[28].'<br />
<font size="1" style="font-weight: normal">'.$lk[29].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="dizin" size="40" maxlength="100" value="'.$dizin.'" required />
	</td>
	</tr>



	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[143].'<br />
<font size="1" style="font-weight: normal">'.$lk[144].'</font>
	</td>

	<td align="left">
<select class="formlar" name="yazilim[]" multiple="multiple" size="3" required>
<option value="cms" selected="selected">CMS</option>
<option value="forum" selected="selected">Forum</option>
<option value="portal" selected="selected">Portal</option>
</select>
	</td>
	</tr>



	<tr>
	<td colspan="2" class="site_baslik" align="center" style="height: 14px;">'.$lk[32].'</td>
	</tr>



	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[33].'
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_sunucu" size="40" maxlength="100" value="localhost" required />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[84].'<br />
<font size="1" style="font-weight: normal">'.$lk[85].'</font>
	</td>

	<td align="left">
<select class="formlar" name="vt_tip" required>
'.$veritabanlari.'
</select>
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[34].'<br />
<font size="1" style="font-weight: normal">'.$lk[35].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_adi" size="40" maxlength="100" value="" required />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[36].'<br />
<font size="1" style="font-weight: normal">'.$lk[37].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_kullanici" size="40" maxlength="100" value="" />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[38].'<br />
<font size="1" style="font-weight: normal">'.$lk[39].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_sifre" size="40" maxlength="100" value="" />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[40].'<br />
<font size="1" style="font-weight: normal">'.$lk[41].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="tablo_oneki" size="40" maxlength="10" value="phpkf_" required />
	</td>
	</tr>



	<tr>
	<td colspan="2" class="site_baslik" align="center" style="height: 14px">'.$lk[42].'</td>
	</tr>



	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[43].'<br />
<font size="1" style="font-weight: normal">'.$lk[44].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="yonetici_adi" size="40" maxlength="20" value="Kurucu" required />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[47].'<br /><font size="1" style="font-weight: normal">'.$lk[48].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="yonetici_sifre" size="40" maxlength="20" value="" required />
	</td>
	</tr>

</tbody>
</table>
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left" valign="top" style="padding-top:0">
&nbsp;<label style="cursor: pointer;">
<input type="checkbox" name="telif_kabul" required />&nbsp;'.$lk[68].'</label>
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="center" valign="middle">
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
<input class="dugme" type="submit" value="'.$lk[51].'" />
	</td>
	</tr>
</tbody>
</table>

</td></tr></tbody></table>

<script type="text/javascript"><!-- //
document.kurulum_formu.vt_sifre.setAttribute("autocomplete","off");
document.kurulum_formu.yonetici_sifre.setAttribute("autocomplete","off");
// -->
</script>

	</td>
	</tr>
	
	<tr>
	<td height="17"></td>
	</tr></tbody></table>
</td></tr></tbody></table>
</form>';



echo '<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
<tbody>
	<tr>
	<td height="25"></td>
	</tr>

	<tr>
	<td align="center" valign="bottom" class="liste-veri">
<div style="font-family: Verdana, Tahoma, helvetica; font-size:11px; color:#000000; position:relative; z-index:1001; text-align:center; float:left; width:100%; height:40px;">
<br /><a href="https://www.phpkf.com" target="_blank" style="text-decoration:none"><b>'.$l['yazilim'].': phpKF &copy; 2007 - '.@gmdate('Y').'</b></a>
</div>
</td></tr></tbody></table>
<br />

</div>
</body>
</html>';

?>