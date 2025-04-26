<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


// Seçilen dil çereze giriliyor

if ((isset($_GET['dil'])) AND ($_GET['dil'] != ''))
{
	// forum dizini alınıyor
	$forum_dizin = dirname(dirname($_SERVER['PHP_SELF'] ));
	if ($forum_dizin == '\\') $forum_dizin = '/'; 

	if ($_GET['dil'] == 'english')
	{
		@setcookie('forum_dili', 'english', time()+604800, $forum_dizin);
		header('Location: yukleme.php');
		exit();
	}
	else
	{
		@setcookie('forum_dili', '', 0, $forum_dizin);
		header('Location: yukleme.php');
		exit();
	}
}


header("Content-type: text/html; charset=utf-8");


// dil dosyası yükleniyor

if ((isset($_COOKIE['forum_dili'])) AND ($_COOKIE['forum_dili'] != ''))
{
	if ($_COOKIE['forum_dili'] == 'english') include 'dil/english.php';
	else include 'dil/turkce.php';
}
else include 'dil/turkce.php';





// Veritabanı sınıf dosyaları alınıyor

$veritabanlari = '';
$dizin_adi = '../bilesenler/veritabani/';

if ($dizin = @opendir($dizin_adi))
{
	while ( @gettype($bilgi = @readdir($dizin)) != 'boolean' )
	{
		if ( (!@is_dir($dizin_adi.$bilgi)) AND ($bilgi != 'index.php') AND (@preg_match('/.php$/i', $bilgi)) )
		{
			$bilgi = str_replace('.php', '', $bilgi);

			if ($bilgi == 'mysql') $veritabanlari .= '<option value="mysql" selected="selected">MySQL ('.$dil_kurulum[86].')</option>';
			elseif ($bilgi == 'mysqli') $veritabanlari .= '<option value="mysqli">MySQLi (improved)</option>';
			elseif ($bilgi == 'mssql') $veritabanlari .= '<option value="mssql">MSSQL (Microsoft SQL)</option>';
			else $veritabanlari .= '<option value="'.$bilgi.'">'.$bilgi.'</option>';
		}
	}
}

else
{
	$veritabanlari = '<option value="">bilesenler/veritabani/ dizini yok</option>';
}



@ini_set('magic_quotes_runtime', 0);

		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - BAŞI	//

if ( (isset($_POST['vt_yukleme'])) AND ($_POST['vt_yukleme'] == 'vt_yukleme') ):

//  HATA TABLOSU    //

$hata_tablo1 = '<br><br><br><table border="0" cellspacing="1" cellpadding="7" width="530" bgcolor="#999999" align="center">
<tr><td bgcolor="#eeeeee" align="center"><font color="#ff0000"><b>';

$hata_tablo2 = '</b></font></td></tr>
<tr><td bgcolor="#fafafa">
<table border="0" cellspacing="1" cellpadding="7" width="100%" bgcolor="#999999" align="center"><tr><td bgcolor="#eeeeee" align="left"><br>';

$hata_tablo3 = '<br><br></td></tr></table>';



if ( (empty($_POST['vt_sunucu'])) OR (empty($_POST['vt_adi'])) )
{
	echo $hata_tablo1.'Hatalı Bilgi'.$hata_tablo2.'Veritabanı kullanıcı adı ve şifresi hariç tüm alanların doldurulması zorunludur!'.$hata_tablo3;
	exit();
}


//	DOSYA YÜKLEMEDE HATA OLURSA - DOSYA ÇOK BÜYÜKSE	//

if ( (isset($_FILES['vtyukle']['error'])) AND ($_FILES['vtyukle']['error'] != 0) )
{
	echo '<h2>hata_iletisi= Dosya Yüklenemedi, Dosya adı alınamadı !<p>Bunun nedeni dosyanın 2mb.`dan büyük olması ya da<br />dosya adının kabul edilmeyen karakterler içermesi olabilir. <p>Yedeği tablo tablo ayrı dosyalara bölmeyi deneyin veya dosya adını değiştirmeyi deneyin.</h2>'.$_FILES['vtyukle']['tmp_name'].' - '.$_FILES['vtyukle']['error'];
	exit();
}


//	DOSYA 5`MB. DAN BÜYÜKSE	//
if ( (isset($_FILES['vtyukle']['tmp_name'])) AND ($_FILES['vtyukle']['tmp_name'] != '') )
{
	if ($_FILES['vtyukle']['size'] > 5242880)
	{
		echo '<h2>hata_iletisi= 5mb.`dan büyük yedek yükleyemezsiniz. <br />Yedeği tablo tablo ayrı dosyalara bölmeyi deneyin.</h2>';
		exit();
	}
}


$ayir = explode(".", strtolower($_FILES['vtyukle']['name']));
$uzanti = end($ayir);


//	DOSYA SIKIŞTIRILMIŞ MI BAKILIYOR	//

if ($uzanti == 'gz'):

	if(extension_loaded('zlib'))
	{
		$gzipdosya01 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
		$gzipac01 = gzread( $gzipdosya01, 9921920 );
		gzclose($gzipdosya01);

		//	çift sıkıştırılımış olma olasılığına karşı tekrar açılıyor
		$yeni_gzipdosya = fopen($_FILES['vtyukle']['tmp_name'], 'w') or die ("Dosya açılamıyor!");
		fwrite($yeni_gzipdosya, $gzipac01);
		fclose($yeni_gzipdosya);

		$gzipdosya02 = gzopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
		$gzipac02 = gzread( $gzipdosya02, 9921920 );
		gzclose($gzipdosya02);

		$ac = $gzipac02;
	}
	else echo '<h2>hata_iletisi= Sunucunuz sıkıştırılmış dosya yüklemesini desteklemiyor!</h2>';


//	DOSYA .SQL UZANTILI DEĞİLSE	//

elseif ($uzanti != 'sql'):
	echo '<h2>hata_iletisi= Sadece .sql ve .gz uzantılı dosyalar yüklenebilir.</h2>';
	exit();


//	TEMP'TEKİ DOSYANIN İÇİNDEKİLER DEĞİŞKENE AKTARILIYOR	//

else:
$dosya = @fopen($_FILES['vtyukle']['tmp_name'], 'r') or die ("Dosya açılamıyor!");
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
if(!@include_once('../bilesenler/veritabani/'.$vtsecim.'.php'))
{
	echo $hata_tablo1.'Veritabanı Dosyası Bulunamıyor!'.$hata_tablo2.'/bilesenler/veritabani/'.$vtsecim.'.php dosyası bulunamıyor!<br /><br />Veritabanı Tipi seçimi hatalı veya veritabanı dosyası silinmiş veya eksik.'.$hata_tablo3;
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
		echo $hata_tablo1.'Veritabanı sunucusu ile bağlantı kurulamıyor !'.$hata_tablo2.'Girdiğiniz veritabanı adresini kontrol edip tekrar deneyin.<br><br>
		<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$hata_tablo3;

	elseif (preg_match("|Access denied for user|si", $vt->hata_cikti))
		echo $hata_tablo1.'Hatalı kullanıcı adı veya şifre !'.$hata_tablo2.'Girdiğiniz veritabanı kullanıcı adı ve şifresini kontrol edip tekrar deneyin.<br><br>
		<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$hata_tablo3;

	elseif (preg_match("|Unknown database|si", $vt->hata_cikti))
		echo $hata_tablo1.'Veritabanı açılamıyor !'.$hata_tablo2.'Veritabanı adını doğru yazdığınızdan emin olun.<br><br>
		<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$hata_tablo3;

	else echo $hata_tablo1.'Veritabanı ile bağlantı kurulamıyor !'.$hata_tablo2.'Veritabanı sunucu adresi, kullanıcı adı ve şifre bilgilerinizi tekrar girin.<br><br>
		<b>Hata ayrıntısı: </b>'.$vt->hata_cikti.$hata_tablo3;

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
				$vtsorgu = $vt->query($yorum[$satir2]) or die ($hata_tablo1.'Sorgu Başarısız'.$hata_tablo2.$vt->error().$hata_tablo3);
			}
		}

		else // sorgu veritabanına giziliyor //
		$vtsorgu = $vt->query($toplam[$satir]) or die ($hata_tablo1.'Sorgu Başarısız'.$hata_tablo2.$vt->error().$hata_tablo3);
	}
}


//	VERİTABANI YEDEĞİ YÜKLENDİ MESAJI	//

@setcookie('kullanici_kimlik', '', 0, '/', $_SERVER['HTTP_HOST']);
@setcookie('yonetim_kimlik', '', 0, '/', $_SERVER['HTTP_HOST']);
echo $hata_tablo1.'- Yükleme Başarılı -'.$hata_tablo2.'<br /><center><b>Veritabanı yedeğiniz başarıyla geri yüklenmiştir.</b></center>'.$hata_tablo3;
exit();

		//	VERİTABANI YEDEĞİ YÜKLEME KISMI - SONU	//







else:

//  SAYFA BAŞI   //

echo '<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../temalar/varsayilan/resimler/favicon.png" rel="icon" type="image/png" />
<link href="sablon.css" rel="stylesheet" type="text/css" />
<title>'.$dil_kurulum[73].'</title>
</head>
<body>
<div class="ana_govde" style="margin:0 auto; width:100%; max-width:770px">


<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center" bgcolor="#d0d0d0">
<tbody>
	<tr>
	<td class="liste-veri" bgcolor="#f9f9f9" colspan="5" height="50" valign="middle">

<form name="form-dil" action="yukleme.php" method="get">
<select class="formlar" name="dil" style="padding:2px 6px 2px 2px; width:auto; text-align:center">
<option value="turkce" selected="selected">&nbsp;Türkçe (Turkish)&nbsp; </option>
<option value="english" ';

if ((isset($_COOKIE['forum_dili'])) AND ($_COOKIE['forum_dili'] != '') AND ($_COOKIE['forum_dili'] == 'english') ) echo 'selected="selected"';

echo '>&nbsp;English (İngilizce)&nbsp; </option>
</select>&nbsp; <input class="formlar" type="submit" value="'.$dil_kurulum[52].'" style="padding:3px 8px; margin-left:7px; width:auto" />
</form>


<script type="text/javascript">
//<![CDATA[
<!-- 
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
			alert("'.$dil_kurulum[54].'");
			break;
		}
	}
	return dogruMu;
}
//  -->
//]]>
</script>
	<td>
	<tr>

	<tr class="liste-veri">
	<td width="85" height="27" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="index.php"><b>'.$dil_kurulum[69].'</b></a>
	</td>

	<td width="95" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="guncelle.php"><b>'.$dil_kurulum[70].'</b></a>
	</td>

	<td width="85" align="center" valign="middle" bgcolor="#f8f8f8" style="border-top: 1px solid #d0d0d0; border-left: 1px solid #d0d0d0; border-right: 1px solid #d0d0d0;">
<b>'.$dil_kurulum[71].'</b>
	</td>

	<td width="80" align="center" valign="middle" bgcolor="#f8f8f8" style="border: 1px solid #e8e8e8;" onmouseover="this.bgColor= \'#eeeeee\'" onmouseout="this.bgColor= \'#f8f8f8\'">
<a href="sil.php"><b>'.$dil_kurulum[72].'</b></a>
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
	<td class="baslik" colspan="2" align="center" height="45">
'.$dil_kurulum[73].'
	</td>
	</tr>

	<tr>
	<td class="liste-veri" align="left">
<br />
&nbsp; '.$dil_kurulum[79].'<br /><br /><br />';


if (!ini_get('file_uploads')) echo '&nbsp; <b>'.$dil_kurulum[74].'</b><p>';
echo '&nbsp; <b>'.$dil_kurulum[75].': </b>'.ini_get('upload_max_filesize').
'<br />&nbsp; <b>'.$dil_kurulum[76].':</b> '.ini_get('post_max_size').
'<br />&nbsp; <b>'.$dil_kurulum[77].':</b> '.ini_get('max_input_time').$dil_kurulum[83].'
<br />&nbsp; <b>'.$dil_kurulum[78].':</b> '.ini_get('max_execution_time').$dil_kurulum[83];


echo '<br /><br /><br />
<font size="1">
<i>&nbsp;&nbsp; &nbsp; '.$dil_kurulum[56].'</i>
</font>
	</td>
	</tr>

	<tr>
	<td>

<table cellspacing="1" width="96%" cellpadding="5" border="0" align="center" bgcolor="#d0d0d0">

	<tr>
	<td colspan="2" class="site_baslik" align="center" style="height: 14px;">
'.$dil_kurulum[57].'
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$dil_kurulum[58].'<br /><br />
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_sunucu" size="40" maxlength="100" value="localhost" required />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$dil_kurulum[84].'<br />
<font size="1" style="font-weight: normal">
'.$dil_kurulum[85].'
</font><br /><br />
	</td>

	<td align="left">
<select class="formlar" name="vt_tip">
'.$veritabanlari.'
</select>
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$dil_kurulum[59].'<br />
<font size="1" style="font-weight: normal">
'.$dil_kurulum[80].'
</font><br /><br />
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_adi" size="40" maxlength="100" required />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$dil_kurulum[61].'<br />
<font size="1" style="font-weight: normal">
'.$dil_kurulum[62].'
</font><br /><br />
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_kullanici" size="40" maxlength="100" />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$dil_kurulum[63].'<br />
<font size="1" style="font-weight: normal">
'.$dil_kurulum[64].'
</font><br /><br />
	</td>

	<td align="left">
<input class="formlar" type="text" name="vt_sifre" size="40" maxlength="100" />
	</td>
	</tr>


	<tr class="liste-etiket" bgcolor="#ffffff">
	<td align="left">
<br />'.$dil_kurulum[81].'<br />
<font size="1" style="font-weight: normal">
'.$dil_kurulum[82].'
</font><br /><br />
	</td>

	<td align="left">
<input name="vtyukle" type="file" size="30" required />
	</td>
	</tr>
</table>

<script type="text/javascript">
//<![CDATA[
<!-- //
//document.vtyukleme.vt_kullanici.setAttribute("autocomplete","off");
document.vtyukleme.vt_sifre.setAttribute("autocomplete","off");
//  -->
//]]>
</script>

	</td>
	</tr>


	<tr>
	<td class="liste-etiket" bgcolor="#ffffff" align="center" valign="middle" height="50">
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
<input class="dugme" type="submit" value="Yedeği Yükle" />
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



$yil = date('Y');

echo '<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
	<tbody>
	<tr>
	<td height="25"></td>
	</tr>

	<tr>
	<td align="center" valign="bottom" class="liste-veri">
<div style="font-family: Verdana, Tahoma, helvetica; font-size:11px; color:#000000; position:relative; z-index:1001; text-align:center; float:left; width:100%; height:35px;">
<br /><a href="http://www.phpkf.com" target="_blank" style="text-decoration:none"><b>php Kolay Forum (phpKF) &copy; 2007 - '.$yil.'</b></a>
</div>
</td></tr></tbody></table>
<br />

</div>
</body>
</html>';

endif;

?>