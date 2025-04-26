<?php
/*
 +-=========================================================================-+
 |                              phpKF-CMS v3.00                              |
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


$phpkf_ayarlar_kip = "";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
$uyumlu_surum = $ayarlar['surum'];



// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';

// yönetim oturum kodu kontrol ediliyor
if ( (isset($_GET['kur'])) OR (isset($_GET['kaldir'])) )
{
	if ($gyo != $yo)
	{
		header('Location: hatalar.php?hata=45');
		exit();
	}
}





//  Kurulum işlemleri - Başı  //

if ( (isset($_GET['kur'])) AND  ($_GET['kur'] != '') )
{
	$dizin = zkTemizle($_GET['kur']);
	$ytdizin_adi = '../phpkf-bilesenler/temalar/';


	if (@include_once($ytdizin_adi.$dizin.'/tema_ozellik.php'))
	{
		// Tema sürümü uyumsuz ise
		if (!preg_match('/'.$uyumlu_surum.'/', $tema_bilgi['usurum']))
		{
			header('Location: hatalar.php?hata=21');
			exit();
		}


		if ( (!isset($tema_sablon)) OR (!is_array($tema_sablon)) )
			$tema_sablon[] = array('ad'=>'varsayilan','body'=>'','link'=>'','ickatman'=>'','kenar2'=>'','baslik'=>'','baslikyazi'=>'','baslikyazig'=>'','menuler'=>'','menubag'=>'','menubag_a'=>'','anayazi'=>'');

		foreach($tema_sablon as $sablon)
		{
			if (!is_array($sablon)) continue;
			if (!isset($sablon['kenar2'])) $sablon['kenar2'] = '';

			if ( (!isset($sablon['ad'])) OR ($sablon['ad'] == 'varsayilan') OR ($sablon['ad'] == 'kullanilan') )
			{
				$vtsorgu = "UPDATE $tablo_sablonlar SET body='$sablon[body]', link='$sablon[link]', ickatman='$sablon[ickatman]', kenar2='$sablon[kenar2]', baslik='$sablon[baslik]', baslikyazi='$sablon[baslikyazi]', baslikyazig='$sablon[baslikyazig]', menuler='$sablon[menuler]', menubag='$sablon[menubag]', menubag_a='$sablon[menubag_a]', anayazi='$sablon[anayazi]'
				WHERE ad='kullanilan' OR ad='varsayilan'";
				$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
			}

			else
			{
				$vtsorgu = "SELECT ad FROM $tablo_sablonlar WHERE ad='$sablon[ad]' LIMIT 1";
				$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
				$sablon_var = $vt->num_rows($vtsonuc);

				if ($sablon_var != 1)
				{
					$vtsorgu = "INSERT IGNORE INTO $tablo_sablonlar 
					(ad,body,link,ickatman,kenar2,baslik,baslikyazi,baslikyazig,menuler,menubag,menubag_a,menubag_ahover,anayazi)
					VALUES ('$sablon[ad]', '$sablon[body]', '$sablon[link]', '$sablon[ickatman]', '$sablon[kenar2]', '$sablon[baslik]', '$sablon[baslikyazi]', '$sablon[baslikyazig]', '$sablon[menuler]', '$sablon[menubag]', '$sablon[menubag_a]', '', '$sablon[anayazi]')";
					$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
				}
			}
		}

		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$dizin' WHERE etiket='temadizini_cms' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


		// Tema eklenti işlemleri
		if ( (isset($tema_bilgi['eklenti'])) AND ($tema_bilgi['eklenti'] == 1) )
		{
			// Eklenti bilgileri veritabanından çekiliyor
			$vtsorgu = "SELECT * FROM $tablo_eklentiler where ad='$dizin' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
			$ekl_satir = $vt->fetch_assoc($vtsonuc);

			if ($ekl_satir['kur'] != 1)
			{
				header('Location: eklentiler.php?kip=tema&kur='.$dizin.'&yo='.$yo);
				exit();
			}
		}


		header('Location: hatalar.php?bilgi=17');
		exit();
	}

	// tema_ozellik.php dosyası yoksa
	else
	{
		header('Location: hatalar.php?hata=22');
		exit();
	}
}

//  Kurulum işlemleri - Sonu  //





//  Yükleme işlemleri - Başı  //

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'yukle') ):

// Yükleme yapılıyor - başı //
if ( (isset($_POST['yukleme'])) AND ($_POST['yukleme'] == 'yapildi') )
{
	$uzanti = @end(@explode('.',$_FILES['tema_yukle']['name']));
	$tema_sayfa_icerik = '';

	if ( (isset($_FILES['tema_yukle']['error'])) AND ($_FILES['tema_yukle']['error'] != 0) )
		$tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Dosya yüklenemedi, dosya adı alınamadı !</b></font><br><br><b>Nedeni dosyanın çok büyük olması ya da<br>dosya adının kabul edilemeyen karakterler içermesi olabilir.</b></p>';

	elseif ( (isset($_FILES['tema_yukle']['tmp_name'])) AND ($_FILES['tema_yukle']['tmp_name'] != '') )
	{
		if ($_FILES['tema_yukle']['size'] > 10485760)
			$tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Çok büyük temalar buradan yüklenemez !</b></font><br><br><b>Bu temayı açıp (zipten çıkartıp) FTP programıyla phpkf-bilesenler/temalar/ dizinine kendiniz yükleyin.</b></p>';

		elseif ($uzanti != 'zip')
			$tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Sadece .zip uzantılı (zip olarak sıkıştırılmış) temalar yükleneblir !</b></font></p>';

		elseif (!@extension_loaded('zip'))
			$tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Sunucunuz zip dosyalarını açmayı desteklemiyor !</b></font><br><br><b>Bu temayı açıp (zipten çıkartıp) FTP programıyla phpkf-bilesenler/temalar/ dizinine kendiniz yükleyin.</b></p>';

		else
		{
			$arsiv = new ZipArchive;
			$zip_dosya = $arsiv->open($_FILES['tema_yukle']['tmp_name']);

			if ($zip_dosya === true)
			{
				$eski_umask = umask(0);
				ob_start();
				ob_implicit_flush(0);
				$arsiv->extractTo('../phpkf-bilesenler/temalar/');
				$zip_hata = ob_get_contents();
				ob_end_clean();
				$arsiv->close();
				umask($eski_umask);
				$dosyaya_git = substr($_FILES['tema_yukle']['name'], 0, -4);


				if ($zip_hata == '') $tema_sayfa_icerik = '<center><br><br><b>Yükleme Tamamlandı !</b><br><br>Yüklü temaları görmek için <a href="temalar.php#'.$dosyaya_git.'">tıklayın.</a></center>';

				else
				{
					$tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>ZiP DOSYASI ÇIKARTILAMIYOR !</b></font><br><br>Sunucu bu dizine dosya kopyalanmasına izin vermiyor.';
					if(@ini_get('safe_mode')) $tema_sayfa_icerik .= ' Nedeni SAFE MODE`un açık olması olabilir.';
					$tema_sayfa_icerik .= '<br><br><br><br><b>Hata Çıktısı:</b><br>'.$zip_hata.'</p>';
				}
			}

			else $tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>ZiP DOSYASI AÇILAMIYOR !</b></font><br><br><b>Hata Kodu: '.$zip_dosya.'</b></p>';
		}
	}
	$tema_sayfa_icerik .= '<br>';
}

//  Yükleme yapılıyor - Sonu  //





//  Yükleme ekranı - Başı  //

else
{
// Temalar dizinine yazma hakkına bakılıyor
$eyhakki = ' &nbsp; '.$ly['temalar_yazma_hakki'].':&nbsp;';
if (@fopen('../phpkf-bilesenler/temalar/yokla.txt', 'w')){
	@unlink('../phpkf-bilesenler/temalar/yokla.txt');
	$eyhakki .= '<font color="#008800"><b>'.$ly['var'].'</b></font>';}
else $eyhakki .= '<font color="#ff0000"><b>'.$ly['yok'].' !</b></font>
<br> &nbsp; Tema yükleme ve kurulumu için phpkf-bilesenler/temalar/ dizinine yazma hakkı olmalıdır.<br>';


// sunucu zip desteğine bakılıyor
$zipdestek = ' &nbsp; '.$ly['sunucu_zip_destegi'].':&nbsp;';
if (@extension_loaded('zip')) $zipdestek .= '<font color="#008800"><b>'.$ly['var'].'</b></font>';
else $zipdestek .= '<font color="#ff0000"><b>'.$ly['desteklenmiyor'].'</b></font>
<br> &nbsp; Tema yüklemek için sunucuda zip desteği olmalıdır. Yüklemek istediğiniz temaları açıp (zipten çıkartıp), <br>FTP programıyla phpkf-bilesenler/temalar/ dizinine kendiniz kopayalabilirsiniz.';


// sunucu safe_mode ayarına bakılıyor
$safe_mode = ' &nbsp; '.$ly['safe_mode'].':&nbsp;';
if(@ini_get('safe_mode')) $safe_mode .= '<font color="#ff0000"><b>'.$ly['acik'].' !</b></font>
 &nbsp; &nbsp; Safe Mode`un açık olması forum üzerinden tema yüklemenize engel olabilir.';
else $safe_mode .= '<font color="#008800"><b>'.$ly['kapali'].'</b></font>';



$ly['tema_yukleme_bilgi'][0] = str_replace('www.phpKF.com', '<a href="https://www.phpkf.com/temalar.php?sayfa=cms" target="_blank">www.phpKF.com</a>', $ly['tema_yukleme_bilgi'][0]);


$tema_sayfa_icerik = '<div style="float:left;width:100%;text-align:left;padding-bottom:25px">
<a href="temalar.php">'.$ly['temalar'].'</a> &nbsp;|&nbsp; <a href="eklentiler.php?kip=tema">'.$ly['tema_eklentileri'].'</a> &nbsp;|&nbsp; <b>'.$ly['tema_yukle'].'</b> &nbsp;|&nbsp; <a href="tasarim.php">'.$ly['tema_renkleri'].'</a>
</div>

<table cellspacing="1" cellpadding="4" width="100%" border="0" align="left" class="tablo-ana">
	<tr>
	<td class="liste-veri tablo-ici" colspan="4" align="left">
<br>
'.$ly['tema_yukleme_bilgi'][0].'
<br><br>
<ul>
'.$ly['tema_yukleme_bilgi'][1].'
</ul>

<br>'.$eyhakki.'<br>'.$zipdestek.'<br>'.$safe_mode.'
<br><br><br><br><br>
<center>

<script type="text/javascript"><!-- //
function denetle(){
var dogruMu = true;
if (document.tema_yukleme.tema_yukle.value.length < 4){
dogruMu = false; 
alert("Dosya seçmeyi unuttunuz !");}
else;
return dogruMu;}
//  -->
</script>

<form name="tema_yukleme" action="temalar.php?kip=yukle&amp;yo='.$yo.'" method="post" enctype="multipart/form-data" onsubmit="return denetle()">
<input type="hidden" name="yukleme" value="yapildi" />
<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
<b>'.$ly['dosya_sec'].': &nbsp;</b><input class="input-text" name="tema_yukle" type="file" size="200" style="width: 250px" />
<br><br><br>
&nbsp; &nbsp; &nbsp; <input class="dugme dugme-mavi" type="submit" value="'.$ly['tema_yukle'].'" />
</form></center>
<br><br>
	</td>
	</tr>
	</table>
';
}

//  Yükleme ekranı - Sonu  //










//  YÜKLÜ TEMALAR SIRALANIYOR  //
//  YÜKLÜ TEMALAR SIRALANIYOR  //
//  YÜKLÜ TEMALAR SIRALANIYOR  //

else:

$ytdizin_adi = '../phpkf-bilesenler/temalar/';    // temalar dizini

if (!$yedizin = @opendir($ytdizin_adi))  // dizini açıyoruz
{
	header('Location: hatalar.php?hata=19');
	exit();
}



$icerik_kurulu = '';
$icerik_kurdegil = '';
$tema_sayfa_icerik = '<div style="float:left;width:100%;text-align:left;padding-bottom:25px"><b>'.$ly['temalar'].'</b> &nbsp;|&nbsp; <a href="eklentiler.php?kip=tema">'.$ly['tema_eklentileri'].'</a> &nbsp;|&nbsp; <a href="temalar.php?kip=yukle">'.$ly['tema_yukle'].'</a> &nbsp;|&nbsp; <a href="tasarim.php">'.$ly['tema_renkleri'].'</a></div>

<table cellspacing="1" cellpadding="4" width="100%" border="0" align="center" class="tablo-ana">';




//  DİZİNDEKİ TEMALAR DÖNGÜYE SOKULARAK GÖRÜNTÜLENİYOR   //

while ( @gettype($bilgi = @readdir($yedizin)) != 'boolean' )
{
$dongu_icerik = '';


if ( (@is_dir($ytdizin_adi.$bilgi)) AND ($bilgi != '.') AND ($bilgi != '..') )
{
	if (!@include_once($ytdizin_adi.$bilgi.'/tema_ozellik.php'))
	{
		$icerik_kurdegil .= '<tr class="tablo_ici"><td colspan="3" align="center"><br /><font color="#ff0000">';

		if (@is_file($ytdizin_adi.$bilgi.'/tema_bilgi.txt'))
			$icerik_kurdegil .= 'Bu tema ('.$bilgi.') phpKF Forum veya Portal teması !<br />phpKF-CMS temalarını indirmek için <a target="_blank" href="https://www.phpkf.com/temalar.php?sayfa=cms">tıklayın.</a>';
		else $icerik_kurdegil .= 'Tema dosyası bulunamıyor !<br />phpkf-bilesenler/temalar/'.$bilgi.'/tema_ozellik.php';

		$icerik_kurdegil .= '</font><br /><br /></td></tr><tr><td bgcolor="#eeeeee" colspan="3" style="height:3px"></td></tr>';
		continue;
	}


	if ($tema_bilgi['ad'] == 'Varsayılan') $tema_bilgi['ad'] = $ly['varsayilan'];


	if ($secili_tema_cms == $bilgi) $kur_kaldir = '<font color="#007900">'.$ly['kullanilan'].'</font>';
	else
	{
		if (!preg_match('/'.$uyumlu_surum.'/', $tema_bilgi['usurum']))
			$kur_kaldir = '<font color="#ff0000">'.$ly['tema_uyumsuz'].'</font><br />';
		else $kur_kaldir = '<a href="temalar.php?kur='.$bilgi.'&amp;yo='.$yo.'">-'.$ly['kullan'].'-</a>';
	}


	// Tema sürüm uyumluluğu
	$uyumluluk = str_replace(';',', ', $tema_bilgi['usurum']);
	if (!preg_match('/'.$uyumlu_surum.'/', $tema_bilgi['usurum']))
		$uyumluluk .= ' <font color="#ff0000" size="1">('.$ly['uyumsuz'].')</font>';


	if ($tema_bilgi['adres'] != '') $yapimci = '<a target="_bank" href="'.$tema_bilgi['adres'].'">'.$tema_bilgi['yapimci'].'</a>';
	else $yapimci = $tema_bilgi['yapimci'];

	if ( (isset($tema_bilgi['duzenleme'])) AND ($tema_bilgi['duzenleme'] != '') ) $yapimci .= '<br>'.$ly['duzenleme'].': '.$tema_bilgi['duzenleme'];

	if ($tema_bilgi['telif'] != '') $telif = $tema_bilgi['telif'];
	else $telif = $ly['yok'];

	if ($tema_bilgi['demo'] != '') $demo = '<a target="_bank" href="'.$tema_bilgi['demo'].'">'.$ly['tiklayin2'].'</a>';
	else $demo = $ly['yok'];

	if ( (isset($tema_bilgi['guncelleme'])) AND ($tema_bilgi['guncelleme'] != '') )
		$guncelleme = ' ('.$tema_bilgi['guncelleme'].')';
	else $guncelleme = '';


	// Tema eklenti bilgisi
	if ( (isset($tema_bilgi['eklenti'])) AND ($tema_bilgi['eklenti'] == 1) )
	{
		// Tema eklenti bilgileri veritabanından çekiliyor
		$vtsorgu = "SELECT * FROM $tablo_eklentiler where ad='$bilgi' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		$ekl_satir = $vt->fetch_assoc($vtsonuc);

		if ($ekl_satir['kur'] == 1) $demo .= '<br>'.$ly['eklenti'].': '.$ly['var'].' (<a href="eklentiler.php?kip=tema#'.$bilgi.'">'.$ly['kurulu'].'</a>)';
		else $demo .= '<br>'.$ly['eklenti'].': '.$ly['var'].' ('.$ly['otomatik_kurulur'].')';
	}



	//  TEMA BİLGİLERİ  //

	$dongu_icerik .= '<tr class="tablo_ici">
	<td align="center" valign="middle" width="90">'.$kur_kaldir.'
<img src="../phpkf-dosyalar/bosluk.gif" border="0" height="0" width="90" />
	</td>

	<td align="center" valign="middle" width="200">
<a href="javascript:void(0)" onclick="pencere(\''.$ytdizin_adi.$bilgi.'/'.$tema_bilgi['resim_buyuk'].'\')"><img src="'.$ytdizin_adi.$bilgi.'/'.$tema_bilgi['resim_kucuk'].'" alt="'.$ly['gorunum'].'" border="0" width="180"></a>
	</td>

	<td align="left" valign="top" style="min-width:170px" class="eklenti_bilgi"><a name="'.$bilgi.'"></a>
	<div style="text-align:center; margin-bottom:5px"><b>'.$tema_bilgi['ad'].'</b></div>
	'.$ly['yapımci'].': '.$yapimci.'
	<br />'.$ly['tema_surumu'].': '.$tema_bilgi['tsurum'].'
	<br />'.$ly['uyumlu_surumler'].': '.$uyumluluk.'
	<br />'.$ly['telif'].': '.$telif.'
	<br />'.$ly['demo'].': '.$demo.'
	<br />'.$l['tarih'].': '.$tema_bilgi['tarih'].$guncelleme.'
	<br />'.$ly['aciklama'].': '.$tema_bilgi['aciklama'].'
	<br /><div style="height:10px"></div>
	</td>
	</tr>

	<tr><td colspan="3" class="tablo-alt" style="height:3px"></td></tr>
';


	// Kurulu olanlar en üste alınıyor
	if ($secili_tema_cms == $bilgi) $icerik_kurulu .= $dongu_icerik;
	else $icerik_kurdegil .= $dongu_icerik;


	unset($tema_bilgi);
}
}

$tema_sayfa_icerik .= $icerik_kurulu.$icerik_kurdegil.'</table><br />

<script type="text/javascript">
<!-- //
function pencere(adres){
window.open(adres,"_blank","scrollbars=yes,left=1,top=1,width=750,height=550,resizable=yes");}
//  -->
</script>
';


endif; // Yükleme koşul sonu




// tema dosyası yükleniyor
$sayfa_adi = $ly['temalar'];
$tema_sayfa_baslik = $ly['temalar'];
include_once('phpkf-bilesenler/sayfa_baslik.php');
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>