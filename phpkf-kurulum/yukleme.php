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
@ini_set('magic_quotes_runtime', 0);




		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - BAŞI	//

if ( (isset($_POST['vt_yukleme'])) AND ($_POST['vt_yukleme'] == 'vt_yukleme') ):

if ( (empty($_POST['vt_sunucu'])) OR (empty($_POST['vt_adi'])) )
{
	echo $vt_hata_tablo[0].$lk[108].$vt_hata_tablo[1].$lk[109].$vt_hata_tablo[2];
	exit();
}


//	DOSYA YÜKLEMEDE HATA OLURSA - DOSYA 2`MB. DAN BÜYÜKSE	//

if ( (isset($_FILES['vtyukle']['error'])) AND ($_FILES['vtyukle']['error'] != 0) )
{
	echo $vt_hata_tablo[0].$lk[108].$vt_hata_tablo[1].$lk[110].$_FILES['vtyukle']['tmp_name'].' - '.$_FILES['vtyukle']['error'].$vt_hata_tablo[2];
	exit();
}


//	DOSYA 2`MB. DAN BÜYÜKSE	//
if ( (isset($_FILES['vtyukle']['tmp_name'])) AND ($_FILES['vtyukle']['tmp_name'] != '') )
{
	if ($_FILES['vtyukle']['size'] > 5242880)
	{
		echo $vt_hata_tablo[0].$lk[108].$vt_hata_tablo[1].$lk[111].$vt_hata_tablo[2];
		exit();
	}
}


$ayir = explode(".", strtolower($_FILES['vtyukle']['name']));
$uzanti = end($ayir);


//	DOSYA SIKIŞTIRILMIŞ MI BAKILIYOR	//

if ($uzanti == 'gz'):

	if(extension_loaded('zlib'))
	{
		$gzipdosya01 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ($lk[112]);
		$gzipac01 = gzread( $gzipdosya01, 9921920 );
		gzclose($gzipdosya01);

		//	çift sıkıştırılımış olma olasılığına karşı tekrar açılıyor
		$yeni_gzipdosya = fopen($_FILES['vtyukle']['tmp_name'], 'w') or die ($lk[112]);
		fwrite($yeni_gzipdosya, $gzipac01);
		fclose($yeni_gzipdosya);

		$gzipdosya02 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ($lk[112]);
		$gzipac02 = gzread( $gzipdosya02, 9921920 );
		gzclose($gzipdosya02);

		$ac = $gzipac02;
	}
	else echo $vt_hata_tablo[0].$lk[108].$vt_hata_tablo[1].$lk[113].$vt_hata_tablo[2];


//	DOSYA .SQL UZANTILI DEĞİLSE	//

elseif ($uzanti != 'sql'):
	echo $vt_hata_tablo[0].$lk[108].$vt_hata_tablo[1].$lk[114].$vt_hata_tablo[2];
	exit();


//	TEMP'TEKİ DOSYANIN İÇİNDEKİLER DEĞİŞKENE AKTARILIYOR	//

else:
$dosya = @fopen($_FILES['vtyukle']['tmp_name'], 'r') or die ($lk[112]);
$boyut = filesize($_FILES['vtyukle']['tmp_name']);
$ac = @fread( $dosya, $boyut );
endif;



if (!defined('PHPKF_ICINDEN')) define('PHPKF_ICINDEN', true);


function zkTemizle($metin)
{
	$donen = urldecode($metin);
	$donen = str_replace('>','',$donen);
	$donen = str_replace('<','',$donen);
	$donen = str_replace("'",'',$donen);
	$donen = str_replace('\\','',$donen);
	$donen = str_replace('"','',$donen);
	return $donen;
}


$vt_sunucu = zkTemizle($_POST['vt_sunucu']);
$vt_adi = zkTemizle($_POST['vt_adi']);
$vt_kullanici = zkTemizle($_POST['vt_kullanici']);
$vt_sifre = zkTemizle($_POST['vt_sifre']);
$vtsecim = zkTemizle($_POST['vt_tip']);


// Veritabanı sınıf dosyası yükleniyor
if(!@include_once('../phpkf-bilesenler/veritabani/'.$vtsecim.'.php'))
{
	echo $vt_hata_tablo[0].$lk[94].$vt_hata_tablo[1].'/phpkf-bilesenler/veritabani/'.$vtsecim.'.php '.$lk[95].'<br /><br />'.$lk[96].$vt_hata_tablo[2];
	exit();
}



//  Veritabanı ile bağlantı kuruluyor
$vt = new sinif_vt();
$vt->baglan($vt_sunucu, $vt_kullanici, $vt_sifre);

//  veritabanı seçiliyor
if ($vt->hata_cikti == '') $veri_tabani = $vt->sec($vt_adi);
else $veri_tabani = false;



// Hata iletileri
if ( (!$vt) OR (!$veri_tabani) )
{
	if ( (preg_match("|Can\'t connect to MySQL server|si", $vt->hata_cikti))
		OR (preg_match("|Unknown MySQL server|si", $vt->hata_cikti))
		OR (preg_match("|php_network_getaddresses|si", $vt->hata_cikti)) )
		echo $vt_hata_tablo[0].$lk[97].$vt_hata_tablo[1].$lk[98].'<br><br>
		<b>'.$lk[99].': </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	elseif (preg_match("|Access denied for user|si", $vt->hata_cikti))
		echo $vt_hata_tablo[0].$lk[100].$vt_hata_tablo[1].$lk[101].'<br><br>
		<b>'.$lk[99].': </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	elseif (preg_match("|Unknown database|si", $vt->hata_cikti))
		echo $vt_hata_tablo[0].$lk[102].$vt_hata_tablo[1].$lk[103].'<br><br>
		<b>'.$lk[99].': </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	else echo $vt_hata_tablo[0].$lk[104].$vt_hata_tablo[1].$lk[105].'<br><br>
		<b>'.$lk[99].': </b>'.$vt->hata_cikti.$vt_hata_tablo[2];

	die();
}




// dosyadaki veriler satır satır dizi değişkene aktarılıyor //
$toplam = explode(";\n\n", $ac);

// satır sayısı alınıyor //
$toplam_sayi = count($toplam);

// dizideki satırlar döngüye sokuluyor //
for ($satir=0;$satir<$toplam_sayi;$satir++)
{
	// 9 karakterden kısa dizi elemanları diziden atılıyor	//
	if (strlen($toplam[$satir]) > 9)
	{
		// yorumlar diziden atılıyor //
		if (preg_match("/\n\n--/", $toplam[$satir]))
		{
			$yorum = explode("\n\n", $toplam[$satir]);
			$yorum_sayi = count($yorum);

			for ($satir2=0;$satir2<$yorum_sayi;$satir2++)
			{
				if ( (strlen($yorum[$satir2]) > 9) AND (!preg_match("/--/", $yorum[$satir2])) )
				// sorgu veritabanına giriliyor //
				$vtsonuc = $vt->query($yorum[$satir2]) or die ($vt->hata_ver());
			}
		}

		else // sorgu veritabanına giziliyor //
		$vtsonuc = $vt->query($toplam[$satir]) or die ($vt->hata_ver());
	}
}


//	VERİTABANI YEDEĞİ YÜKLENDİ MESAJI	//

@setcookie('kullanici_kimlik', '', 0, '/', $_SERVER['HTTP_HOST']);
@setcookie('yonetim_kimlik', '', 0, '/', $_SERVER['HTTP_HOST']);
echo $vt_hata_tablo[0].'- '.$lk[115].' -'.$vt_hata_tablo[1].'<br /><center><b>'.$lk[116].'</b></center>'.$vt_hata_tablo[2];
exit();

		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - SONU	//







else:

//  SAYFA BAŞI   //

echo '<!DOCTYPE html>
<html lang="'.$site_dili.'" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../phpkf-bilesenler/temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<link href="sablon.css" rel="stylesheet" type="text/css" />
<title>'.$lk[73].'</title>
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
	for (var i=0; i<6; i++)
	{
		if (document.vtyukleme.elements[i].name == "vt_kullanici") continue;
		else if (document.vtyukleme.elements[i].name == "vt_sifre") continue;
		else if (document.vtyukleme.elements[i].value=="")
		{
			dogruMu = false; 
			alert("'.$lk[54].'");
			break;
		}
	}
	return dogruMu;
}
// -->
</script>
	<td>
	<tr>

	<tr class="liste-veri">
	<td width="110" height="27" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="index.php"><b>'.$lk[69].'</b></a>
	</td>

	<td width="110" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="guncelle.php"><b>'.$lk[70].'</b></a>
	</td>

	<td width="110" align="center" valign="middle" bgcolor="#eeeeee" style="border-top: 1px solid #d0d0d0; border-left: 1px solid #d0d0d0; border-right: 1px solid #d0d0d0;">
<b>'.$lk[71].'</b>
	</td>

	<td width="110" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="sil.php"><b>'.$lk[72].'</b></a>
	</td>

	<td bgcolor="#f9f9f9">&nbsp;</td>
	</tr>
</tbody>
</table>



<table cellspacing="1" cellpadding="0" width="100%" border="0" align="center" bgcolor="#d0d0d0">
	<tr>
	<td align="center">

<form name="vtyukleme" action="yukleme.php" method="post" enctype="multipart/form-data" onsubmit="return denetle()">
<input type="hidden" name="vt_yukleme" value="vt_yukleme" />


<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center" class="tablo_border2">
	<tr>
	<td align="center" valign="top" height="17"></td>
	</tr>
	
	<tr>
	<td align="center" valign="top">

<table cellspacing="1" cellpadding="0" width="96%" border="0"  class="tablo_border3">
	<tr>
	<td>

<table cellspacing="10" width="100%" cellpadding="0" border="0" align="center" bgcolor="#ffffff">
	<tr>
	<td class="baslik" colspan="2" align="center" height="45">'.$lk[73].'</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left">
<br />
&nbsp; '.$lk[79].'<br /><br /><br />';


if (!ini_get('file_uploads')) echo '&nbsp; <b>'.$lk[74].'</b><p>';
echo '&nbsp; <b>'.$lk[75].': </b>'.ini_get('upload_max_filesize').
'<br />&nbsp; <b>'.$lk[76].':</b> '.ini_get('post_max_size').
'<br />&nbsp; <b>'.$lk[77].':</b> '.ini_get('max_input_time').$lk[83].'
<br />&nbsp; <b>'.$lk[78].':</b> '.ini_get('max_execution_time').$lk[83];


echo '<br /><br /><br />
<font size="1">
<i>&nbsp;&nbsp; &nbsp; '.$lk[56].'</i>
</font>
	</td>
	</tr>

	<tr>
	<td>

<table cellspacing="1" width="96%" cellpadding="5" border="0" align="center" bgcolor="#d0d0d0">

	<tr>
	<td colspan="2" class="site_baslik" align="center" style="height: 14px;">'.$lk[57].'</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[58].'
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
<select class="formlar" name="vt_tip">
'.$veritabanlari.'
</select>
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[59].'<br />
<font size="1" style="font-weight: normal">'.$lk[80].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_adi" size="40" maxlength="100" required />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[61].'<br />
<font size="1" style="font-weight: normal">'.$lk[62].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_kullanici" size="40" maxlength="100" />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[63].'<br />
<font size="1" style="font-weight: normal">'.$lk[64].'</font>
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_sifre" size="40" maxlength="100" />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
'.$lk[81].'<br />
<font size="1" style="font-weight: normal">'.$lk[82].'</font>
	</td>

	<td align="left">
<input name="vtyukle" type="file" size="30" required />
	</td>
	</tr>
</table>

<script type="text/javascript"><!-- //
document.vtyukleme.vt_sifre.setAttribute("autocomplete","off");
//  -->
</script>

	</td>
	</tr>


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="center" valign="middle" height="50">
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
<input class="dugme" type="submit" value="'.$lk[117].'" />
	</td>
	</tr>


</table>
</td></tr></table>
</td></tr>
	<tr>
	<td height="17" ></td>
	</tr>
</table>
</form>
</td></tr></table>';



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

endif;

?>