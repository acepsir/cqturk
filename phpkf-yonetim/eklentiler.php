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
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');
$uyumlu_surum = $ayarlar['surum'];



// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
else $gyo = '';

// yönetim oturum kodu kontrol ediliyor
if ( (isset($_GET['kur'])) OR (isset($_GET['kaldir'])) OR (isset($_GET['guncel'])) OR (isset($_POST['yukleme'])) )
{
	if ($gyo != $yo)
	{
		header('Location: hatalar.php?hata=45');
		exit();
	}
}



// sayfa başlık
$sayfa_adi = $ly['eklentiler'];
$tema_sayfa_baslik = $ly['eklentiler'];



//  Yükleme işlemleri - Başı  //

if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'yukle') ):

// Yükleme yapılıyor - başı //
if ( (isset($_POST['yukleme'])) AND ($_POST['yukleme'] == 'yapildi') )
{
	$tema_sayfa_icerik = '';

	if ( (isset($_FILES['eklenti_yukle']['error'])) AND ($_FILES['eklenti_yukle']['error'] != 0) )
		$tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Dosya yüklenemedi, dosya adı alınamadı !</b></font><br><br><b>Nedeni dosyanın çok büyük olması ya da<br>dosya adının kabul edilemeyen karakterler içermesi olabilir.</b></p>';

	elseif ( (isset($_FILES['eklenti_yukle']['tmp_name'])) AND ($_FILES['eklenti_yukle']['tmp_name'] != '') )
	{
		$uzanti = @end(@explode('.',$_FILES['eklenti_yukle']['name']));

		if ($_FILES['eklenti_yukle']['size'] > 10485760)
			$tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Çok büyük eklentiler buradan yüklenemez !</b></font><br><br><b>Bu eklentiyi açıp (zipten çıkartıp) FTP programıyla phpkf-bilesenler/eklentiler/ dizinine kendiniz yükleyin.</b></p>';

		elseif ($uzanti != 'zip')
			$tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Sadece .zip uzantılı (zip olarak sıkıştırılmış) eklentiler yüklenebilir !</b></font></p>';

		elseif (!@extension_loaded('zip'))
			$tema_sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Sunucunuz zip dosyalarını açmayı desteklemiyor !</b></font><br><br><b>Bu eklentiyi açıp (zipten çıkartıp) FTP programıyla phpkf-bilesenler/eklentiler/ dizinine kendiniz yükleyin.</b></p>';

		else
		{
			$arsiv = new ZipArchive;
			$zip_dosya = $arsiv->open($_FILES['eklenti_yukle']['tmp_name']);

			if ($zip_dosya === true)
			{
				$eski_umask = umask(0);
				ob_start();
				ob_implicit_flush(0);
				$arsiv->extractTo('../phpkf-bilesenler/eklentiler/');
				$zip_hata = ob_get_contents();
				ob_end_clean();
				$arsiv->close();
				umask($eski_umask);
				$dosyaya_git = substr($_FILES['eklenti_yukle']['name'], 0, -4);


				if ($zip_hata == '') $tema_sayfa_icerik = '<center><br><br><b>Yükleme Tamamlandı !</b><br><br>Yüklü eklentileri görmek için <a href="eklentiler.php#'.$dosyaya_git.'">tıklayın.</a></center>';

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
// Yükleme yapılıyor - sonu //




// Yükleme ekranı - başı
else
{
// eklentiler dizinine yazma hakkına bakılıyor
$eyhakki = ' &nbsp; '.$ly['eklentiler_yazma_hakki'].':&nbsp;';
if (@fopen('../phpkf-bilesenler/eklentiler/yokla.txt', 'w')){
	@unlink('../phpkf-bilesenler/eklentiler/yokla.txt');
	$eyhakki .= '<font color="#008800"><b>'.$ly['var'].'</b></font>';}
else $eyhakki .= '<font color="#ff0000"><b>'.$ly['yok'].' !</b></font>
<br> &nbsp; Eklenti yükleme ve kurulumu için phpkf-bilesenler/eklentiler/ dizinine yazma hakkı olmalıdır.<br>';


// sunucu zip desteğine bakılıyor
$zipdestek = ' &nbsp; '.$ly['sunucu_zip_destegi'].':&nbsp;';
if (@extension_loaded('zip')) $zipdestek .= '<font color="#008800"><b>'.$ly['var'].'</b></font>';
else $zipdestek .= '<font color="#ff0000"><b>'.$ly['desteklenmiyor'].'</b></font>
<br> &nbsp; Eklenti yüklemek için sunucuda zip desteği olmalıdır. Yüklemek istediğiniz eklentileri açıp (zipten çıkartıp), <br>FTP programıyla phpkf-bilesenler/eklentiler/ dizinine kendiniz kopayalabilirsiniz.';


// sunucu safe_mode ayarına bakılıyor
$safe_mode = ' &nbsp; '.$ly['safe_mode'].':&nbsp;';
if(@ini_get('safe_mode')) $safe_mode .= '<font color="#ff0000"><b>'.$ly['acik'].' !</b></font>
 &nbsp; &nbsp; Safe Mode`un açık olması forum üzerinden eklenti yüklemenize engel olabilir.';
else $safe_mode .= '<font color="#008800"><b>'.$ly['kapali'].'</b></font>';



$ly['eklenti_yukleme_bilgi'][0] = str_replace('www.phpKF.com', '<a href="https://www.phpkf.com/eklentiler.php" target="_blank">www.phpKF.com</a>', $ly['eklenti_yukleme_bilgi'][0]);


$tema_sayfa_icerik = '<div style="float:left;width:100%;text-align:left;padding-bottom:25px">
<a href="eklentiler.php">'.$ly['eklentiler'].'</a> &nbsp;|&nbsp;
<a href="eklentiler.php?kip=tema">'.$ly['tema_eklentileri'].'</a> &nbsp;|&nbsp;
<b>'.$ly['eklenti_yukle'].'</b>
</div>

<table cellspacing="1" cellpadding="4" width="100%" border="0" align="left" class="tablo-ana">
	<tr>
	<td class="liste-veri tablo_ici" colspan="4" align="left">
<br>
'.$ly['eklenti_yukleme_bilgi'][0].'
<br><br>
<ul>
'.$ly['eklenti_yukleme_bilgi'][1].'
</ul>

<br>'.$eyhakki.'<br>'.$zipdestek.'<br>'.$safe_mode.'
<br><br><br><br><br>
<center>

<script type="text/javascript"><!-- //
function denetle(){
var dogruMu = true;
if (document.eklenti_yukleme.eklenti_yukle.value.length < 4){
dogruMu = false; 
alert("Dosya seçmeyi unuttunuz !");}
else;
return dogruMu;}
//  -->
</script>

<form name="eklenti_yukleme" action="eklentiler.php?kip=yukle&amp;yo='.$yo.'" method="post" enctype="multipart/form-data" onsubmit="return denetle()">
<input type="hidden" name="yukleme" value="yapildi" />
<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
<b>'.$ly['dosya_sec'].': &nbsp;</b><input class="input-text" name="eklenti_yukle" type="file" size="200" style="width: 250px" />
<br><br><br>
&nbsp; &nbsp; &nbsp; <input class="dugme dugme-mavi" type="submit" value="'.$ly['eklenti_yukle'].'" />
</form></center>
<br><br>
	</td>
	</tr>
	</table>
';
}

//  Yükleme işlemleri - Sonu  //

else:







// varsayılan değişkenler
if ((isset($_GET['kip'])) AND  ($_GET['kip'] == 'tema')) $tema_eklenti = true;
else $tema_eklenti = false;
$hata_ver = '';
$eklenti_kurulum = false;
$eklenti_kaldirma = false;
$eklenti_guncelleme = false;


//  phpkf_eklenti SINIF - BAŞI    //

class phpkf_eklenti
{
	var $eklenti_ham;
	var $eklenti_cikis;
	var $hata;

	// dosya değiştirme için denetleniyor
	function dd_denetle($dosya)
	{
		if (!@is_file($dosya))
		{
			$this->hata = 'dosya yok';
			return false;
		}
		elseif (@touch($dosya))
		{
			if (!@is_writable($dosya))
			{
				$this->hata = 'yazma hakkı yok';
				return false;
			}
			else return true;
		}
		else
		{
			$this->hata = 'yazma hakkı yok';
			return false;
		}
	}

	// değiştirilecek dosya açılıyor
	function dosya_ac($dosya)
	{
		if (!($dosya_ac = @fopen($dosya,'r')))
		{
			$this->hata = $dosya.' = <font color="#ff0000">dosya açılamıyor</font>';
			return false;
		}
		else
		{
			$boyut = filesize($dosya);
			$dosya_metni = fread($dosya_ac,$boyut);
			fclose($dosya_ac);
			$this->eklenti_ham = $dosya_metni;
			return true;
		}
	}

	// dosyadaki bul kodları denetleniyor
	function bul_denetle($bul)
	{
		$t_bul = array('\\', "'", '$', '(', ')', '<', '>', '{', '}', '&', '[', ']', '|', '^', '?', '+', '*');
		$t_cevir = array('\\\\', "\'", '\$', '\(', '\)', '\<', '\>', '\{', '\}', '\&', '\[', '\]', '\|', '\^', '\?', '\+', '\*');
		$bul = @str_replace($t_bul, $t_cevir, $bul);

		if (!preg_match('|'.$bul.'|si', $this->eklenti_ham))
		{
			$this->hata .= '<br><hr><pre>'.htmlspecialchars(stripslashes($bul)).'</pre>';
			$bulunamadi = 1;
		}
		if (isset($bulunamadi)) return false;
		else return true;
	}

	// değişiklik yapılıyor
	function degistir($bul,$cevir)
	{
		$t_bul = array('\\', "'", '$', '(', ')', '<', '>', '{', '}', '&', '[', ']', '|', '^', '?', '+', '*');
		$t_cevir = array('\\\\', "\'", '\$', '\(', '\)', '\<', '\>', '\{', '\}', '\&', '\[', '\]', '\|', '\^', '\?', '\+', '\*');
		$bul = @str_replace($t_bul, $t_cevir, $bul);
		$cevir = @str_replace('\\', '\\\\', $cevir);

		$bul = '|'.$bul.'|si';

		$this->eklenti_cikis = preg_replace($bul,$cevir,$this->eklenti_ham);
	}

	// değiştirilen dosya kaydediliyor
	function dosya_kaydet($dosya)
	{
		if (@touch($dosya))
		{
			if (@is_writable($dosya))
			{
				$dosya_kaydet = fopen($dosya, 'w');
				flock($dosya_kaydet, 2);
				fwrite($dosya_kaydet, $this->eklenti_cikis);
				flock($dosya_kaydet, 3);
				fclose($dosya_kaydet);
				return true;
			}
			else
			{
				$this->hata = 'yazılamıyor';
				return false;
			}
		}
		else
		{
			$this->hata = 'yazılamıyor';
			return false;
		}
	}

	// yedekleme dizini oluşturma
	function yedekleme_dizini($dizin)
	{
		// yedek dizini oluşturuluyor, içine index.html kopyalanıyor
		$eski_umask = umask(0);
		@mkdir('../phpkf-bilesenler/eklentiler/'.$dizin.'/yedek');
		@copy('../phpkf-bilesenler/eklentiler/'.$dizin.'/index.html', '../phpkf-bilesenler/eklentiler/'.$dizin.'/yedek/index.html');
		umask($eski_umask);
	}

	// yedekleme (değiştirilen dosyayı)
	function dosya_yedekle($dosya, $dizin)
	{
		global $_SERVER;
		$dosyak = str_replace(array('../','/'), array('',' '), $dosya);
		$dosyak = '../phpkf-bilesenler/eklentiler/'.$dizin.'/yedek/'.$dosyak;

		if($this->yedekleme_dizini($dizin))
		{
			$this->hata = 'yedek dizini oluşturulamadı';
			return false;
		}
		elseif (!@is_file($dosya))
		{
			$this->hata = 'yedeklenecek dosya yok';
			return false;
		}
		elseif (@copy($dosya, $dosyak))
		{
			//if ($_SERVER['HTTP_HOST'] != 'localhost') @chmod($dosyak, '0777');
			return true;
		}
		else
		{
			$this->hata = $dosyak.'yedek dizine yazma hakkı yok';
			return false;
		}
	}
}

//  phpkf_eklenti SINIF - SONU    //








// TÜM ORTAK İŞLEMLER - BAŞI //
// TÜM ORTAK İŞLEMLER - BAŞI //
// TÜM ORTAK İŞLEMLER - BAŞI //

if ( ((isset($_GET['kur'])) AND  ($_GET['kur'] != ''))
	OR ((isset($_GET['kaldir'])) AND  ($_GET['kaldir'] != ''))
	OR ((isset($_GET['guncel'])) AND  ($_GET['guncel'] != '')) )
{

// Kurulum için değişkenler
if (isset($_GET['kur']))
{
	$eklenti_kurulum = true;
	$dosya_ekleme_durum = true;
	$eklenti_kat1= NULL;
	$eklenti_kat2 = NULL;
	$dizin = zkTemizle($_GET['kur']);
}

// Kaldırma için değişkenler
elseif (isset($_GET['kaldir']))
{
	$eklenti_kaldirma = true;
	$dosya_silme_durum = true;
	$dizin = zkTemizle($_GET['kaldir']);
}

// Güncelleme için değişkenler
elseif (isset($_GET['guncel']))
{
	$eklenti_guncelleme = true;
	$dosya_silme_durum = true;
	$dizin = zkTemizle($_GET['guncel']);
}


// Tema ve normal eklenti seçimi
if ($tema_eklenti) $eklenti_dosya = "../phpkf-bilesenler/temalar/$dizin/eklenti/index.php";
else $eklenti_dosya = "../phpkf-bilesenler/eklentiler/$dizin/index.php";


// Eklenti dosyası yükleniyor, dosya yoksa hata ver
if (!@include_once($eklenti_dosya))
{
	header('Location: hatalar.php?hata=3');
	exit();
}



// dosya kontrol - başı
else
{

// Eklenti sürümü uyumsuz ise
if (!preg_match('/'.$uyumlu_surum.'/', $eklenti_bilgi['usurum']))
{
	if ( (isset($_GET['kur'])) OR (isset($_GET['guncel'])) )
	{
		header('Location: hatalar.php?hata=20');
		exit();
	}
}


// eklenti başlığı temizleniyor
$eklenti_baslik = zkTemizle($eklenti_bilgi['ad']);


//  veritabanından ayarlar tablosu çekiliyor
$vtsorgu = "SELECT * FROM $tablo_ayarlar ORDER BY kat";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

// ayarlar dizi değişkene aktarılıyor
while ($ayar = $vt->fetch_assoc($vtsonuc))
{
	$ayarlar_tam[$ayar['etiket']] = $ayar;
}




// Bul-değiştir işlemleri
if (isset($bul_degistir))
{
	$hata_aciklama = '';
	foreach($bul_degistir as $a)
	{
		$eklenti1 = new phpkf_eklenti();

		if ($eklenti1->dosya_ac('../'.$a['dosya']))
		{
			// Eklenti kaldırılırken çalışır
			if ($eklenti_kaldirma)
			{
				if (!$eklenti1->bul_denetle($a['degistir']))
				{
					$hata_aciklama .= '<br>'.$a['dosya'].' = <font color="#ff0000">şu kod bulunamıyor: </font><br>'.$eklenti1->hata.'<br><br>';
					$bul_degis_hata = true;
				}
				$eklenti1->degistir($a['degistir'],$a['bul']);
			}
			// Eklenti kurulurken çalışır
			else
			{
				if (!$eklenti1->bul_denetle($a['bul']))
				{
					$hata_aciklama .= '<br>'.$a['dosya'].' = <font color="#ff0000">şu kod bulunamıyor: </font><br>'.$eklenti1->hata.'<br><br>';
					$bul_degis_hata = true;
				}
				$eklenti1->degistir($a['bul'],$a['degistir']);
			}

			if ($eklenti1->dosya_yedekle('../'.$a['dosya'], $dizin));
			if ($eklenti1->dosya_kaydet('../'.$a['dosya']));
		}

		elseif ( (preg_match('/\>dosya açılamıyor\</', $eklenti1->hata)) AND (preg_match('/temalar\//i', $a['dosya'])) )
			$hata_aciklama .= '<br>'.$a['dosya'].' = <font color="#ff8800">geçiliyor...</font>';
		else{
			$hata_aciklama .= '<br><font color="#ff0000"><b>'.$eklenti1->hata.'</b></font>';
			$bul_degis_hata = true;
		}

		unset($eklenti1);
	}
}

// Bul-değiştir işleminde hata varsa
if (isset($bul_degis_hata))
{
	echo $hata_aciklama;
	exit();
} // Bul-değiştir işlemleri sonu




// alan ekle
if (isset($alan_ekle))
{
	foreach ($alan_ekle as $alan_tek)
	{
		if ($alan_tek['etiket'] != '')
		{
			if ($alan_tek['yer'] == 'yazi') $alan_yer = 'yazi';
			elseif ($alan_tek['yer'] == 'galeri') $alan_yer = 'galeri';
			elseif ($alan_tek['yer'] == 'video') $alan_yer = 'video';
			else $alan_yer = 'icerik';

			if (!isset($alan_tek['duzenleyici'])) $alan_tek['duzenleyici'] = 'duz';
			if ($alan_tek['duzenleyici'] == 'duzenleyici') $alan_aciklama = 'duzenleyici';
			elseif ($alan_tek['duzenleyici'] == 'gduzenleyici') $alan_aciklama = 'gduzenleyici';
			elseif ($alan_tek['duzenleyici'] == 'vduzenleyici') $alan_aciklama = 'vduzenleyici';
			elseif ($alan_tek['duzenleyici'] == 'yduzenleyici') $alan_aciklama = 'yduzenleyici';
			else $alan_aciklama = 'duz';

			$ad = $alan_tek['etiket'];
			if (!isset($alan_tek['secenek'])) $alan_tek['secenek'] = '';

			// yazılar tablosuna yeni alan ekleniyor
			$vtsorgu = "ALTER TABLE $tablo_yazilar ADD `$ad` $alan_tek[alan_tip]";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

			$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('ygv_$ad','','$alan_tek[form_tip]','$alan_tek[secenek]','html','','1','$alan_tek[diger]','$alan_tek[bilgi]','$alan_tek[baslik]','$alan_aciklama','20','$alan_tek[sira]','$alan_yer','20')";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}
	}
} // alan ekle sonu




// alan kaldır
if (isset($alan_kaldir))
{
	foreach ($alan_kaldir as $alan_tek)
	{
		if ($alan_tek != '')
		{
			$ad = 'ygv_'.$alan_tek;
			// Kaldırılan sistem alanı ise
			if ($ayarlar_tam[$ad]['tip'] == 'sistem')
			{
				header('Location: hatalar.php?hata=15');
				exit();
			}

			else
			{
				// yazılar tablosundan alan kaldırılıyor
				$vtsorgu = "ALTER TABLE $tablo_yazilar DROP `$alan_tek`";
				$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

				$vtsorgu = "DELETE FROM $tablo_ayarlar WHERE etiket='ygv_$alan_tek' LIMIT 1;";
				$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
			}
		}
	}
} // ayar kaldır sonu




// ayar ekle
if (isset($ayar_ekle))
{
	foreach ($ayar_ekle as $ayar_tek)
	{
		if ($ayar_tek['etiket'] != '')
		{
			$otokat = true;

			// kat değeri varsa kontrol ediliyor
			if ( (isset($ayar_tek['kat'])) AND ($ayar_tek['kat'] != '') AND (is_numeric($ayar_tek['kat'])) )
			{
				foreach ($ayarlar_tam as $kat_deger)
				{
					if ($kat_deger['kat'] == $ayar_tek['kat']) $otokat = false;
				}
			}


			// kat değeri otomatik atanıyor
			if ($otokat)
			{
				// en küçük eklenti kat değeri 100 yapılıyor
				$enbuyuk_kat = end($ayarlar_tam);
				if ($enbuyuk_kat['kat'] < 99) {
					$eklenti_kat1 = 100;
					$eklenti_kat2 = 100;}
				else {
					$eklenti_kat1 = ($enbuyuk_kat['kat']+1);
					$eklenti_kat2 = ($enbuyuk_kat['kat']+1);}
			}
			else $eklenti_kat1 = $ayar_tek['kat'];


			if ($ayar_tek['tip'] == 'tema') $eklenti_tip = 'tema';
			else $eklenti_tip = 'eklenti';
			if (!isset($ayar_tek['secenek'])) $ayar_tek['secenek'] = '';


			$vtsorgu = "INSERT INTO $tablo_ayarlar VALUES ('$ayar_tek[etiket]','$ayar_tek[deger]','$ayar_tek[form_tip]','$ayar_tek[secenek]','$ayar_tek[secenek_tip]','$ayar_tek[varsayilan]','$ayar_tek[bos]','$ayar_tek[diger]','$ayar_tek[bilgi]','$ayar_tek[baslik]','$ayar_tek[aciklama]','$eklenti_kat1','$ayar_tek[sira]','$eklenti_tip','$ayar_tek[kip]')";
			$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
		}
	}
} // ayar ekle sonu




// ayar kaldır
if (isset($ayar_kaldir))
{
	foreach ($ayar_kaldir as $ayar_tek)
	{
		if ($ayar_tek != '')
		{
			// Kaldırılan sistem ayarı ise
			if ($ayarlar_tam[$ayar_tek]['tip'] == 'sistem')
			{
				header('Location: hatalar.php?hata=15');
				exit();
			}

			else
			{
				$vtsorgu = "DELETE FROM $tablo_ayarlar WHERE etiket='$ayar_tek' LIMIT 1;";
				$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
			}
		}
	}
} // ayar kaldır sonu




// ayar değiştir
if (isset($ayar_degistir))
{
	// değiştirilecek ayarlar kontrol ediliyor
	foreach ($ayar_degistir as $ayar_etiket => $ayar_deger)
		if (!isset($ayarlar[$ayar_etiket])) $hata_ver .= $ayar_etiket.', ';

	// Geçersiz bir ayar varsa hata ver
	if ($hata_ver != '')
	{
		header('Location: hatalar.php?hata=14&git='.$hata_ver);
		exit();
	}


	// Hata yoksa devam et
	foreach ($ayar_degistir as $ayar_etiket => $ayar_deger)
	{
		if ( ($ayar_etiket != 'duzenleyici') AND ($ayar_etiket != 'gduzenleyici') AND ($ayar_etiket != 'vduzenleyici') AND ($ayar_etiket != 'yduzenleyici') )
			$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$ayar_deger' WHERE etiket='$ayar_etiket' LIMIT 1";

		// düzenleyici ekleme
		else
		{
			if (isset($_GET['kur']))
				$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$ayar_deger', secenek='".$ayarlar_tam[$ayar_etiket]['secenek']."|$ayar_deger:$eklenti_baslik' WHERE etiket='$ayar_etiket' LIMIT 1";

			else
			{
				$duzenleyici_sil = str_replace("|$dizin:$eklenti_baslik", '', $ayarlar_tam[$ayar_etiket]['secenek']);
				$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$ayar_deger', secenek='$duzenleyici_sil' WHERE etiket='$ayar_etiket' LIMIT 1";
			}
		}

		$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
	}
} // ayar değiştir sonu




// bağlantı ekleme
if (isset($baglanti_ekle))
{
	foreach ($baglanti_ekle as $baglantilar)
	{
		// bağlantı veritabanına giriliyor
		$vtsorgu = "INSERT INTO $tablo_baglantilar (yer,sayfa,sira,ad,adres,bilgi)";
		$vtsorgu .= "VALUES ('$baglantilar[yer]','0','$baglantilar[sira]','$baglantilar[ad]','$baglantilar[adres]','$baglantilar[bilgi]')";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
} // bağlantı ekleme sonu




// bağlantı kaldırma
if (isset($baglanti_kaldir))
{
	foreach ($baglanti_kaldir as $baglantilar)
	{
		// bağlantı veritabanından siliniyor
		$vtsorgu = "DELETE FROM $tablo_baglantilar WHERE ad='$baglantilar'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
} // bağlantı kaldırma sonu




// sef ekleme başı
if (isset($sef_ekle))
{
	if ($ayarlar['sef_adresler'] != '') $sef_adresler = $ayarlar['sef_adresler']."\n";
	else $sef_adresler = '';

	$sef_ekle = str_replace(array("\r", ' '), array('', ''), $sef_ekle);
	$sef_adresler .= $sef_ekle;

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$sef_adresler' WHERE etiket='sef_adresler' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

} // sef ekleme sonu




// sef kaldırma başı
if (isset($sef_kaldir))
{
	$sef_kaldir = str_replace(array("\r", ' '), array('', ''), $sef_kaldir);

	$sef_adresler = str_replace($sef_kaldir, '', $ayarlar['sef_adresler']);

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$sef_adresler' WHERE etiket='sef_adresler' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

} // sef kaldırma sonu




// dosya ekleme
if (isset($dosya_ekle))
{
	$eklenti_dizini = $adres = "../phpkf-bilesenler/eklentiler/$dizin/";

	foreach ($dosya_ekle as $dosya_tek)
	{
		$hedef_dosya = $eklenti_dizini.$dosya_tek['dosya'];
		$kopyalanacak = $dosya_tek['adres'].$dosya_tek['dosya'];

		if (@copy($hedef_dosya, $kopyalanacak));
		else $dosya_ekleme_durum = false;
	}

} // dosya ekleme sonu




// dosya silme
if (isset($dosya_sil))
{
	foreach ($dosya_sil as $dosya_tek)
	{
		$silinecek = $dosya_tek['adres'].$dosya_tek['dosya'];

		if (@unlink($silinecek));
		else $dosya_silme_durum = false;
	}

} // dosya silme sonu




// Veritabanı sorguları
if (isset($vt_sorgu_ekle))
{
	foreach ($vt_sorgu_ekle as $vtsorgu_ekle)
	{
		$vtsonuc = $vt->query($vtsorgu_ekle) or die($vt->hata_ver());
	}
}




// Yönetim sayfa-menü ekleme
if (isset($yonetim_menu_ekle))
{
	$gonder = '';

	foreach ($yonetim_menu_ekle as $menuler)
	{
		$gonder .= "\n".$menuler['menu_baslik'].'::';

		foreach ($menuler['adresler'] as $baglar)
			$gonder .= $baglar['baslik'].'||'.$baglar['adres'].';;';
	}

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger=CONCAT(deger,'$gonder') WHERE etiket='yonetim_menu' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
} // Yönetim sayfa-menü ekleme sonu




// Yönetim sayfa-menü kaldırma
if (isset($yonetim_menu_kaldir))
{
	$gonder = '';

	foreach ($yonetim_menu_kaldir as $menuler)
	{
		$gonder .= "\\n".$menuler['menu_baslik']."::";

		foreach ($menuler['adresler'] as $baglar)
			$gonder .= $baglar['baslik']."\|\|".$baglar['adres'].";;";
	}

	$gonder = str_replace('/', '\\/', $gonder);
	$gonder2 = preg_replace("/$gonder/is", '', $ayarlar['yonetim_menu']);

	$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$gonder2' WHERE etiket='yonetim_menu' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());

} // Yönetim sayfa-menü kaldırma sonu












// Eklenti kurulumu yapılıyor - başı
// Eklenti kurulumu yapılıyor - başı
// Eklenti kurulumu yapılıyor - başı

if (isset($_GET['kur']))
{
// eklenti başlığı temizleniyor
$eklenti_baslik = zkTemizle($eklenti_bilgi['ad']);


$blokid = '';

// blok ekle
if (isset($blok_ekle))
{
	foreach ($blok_ekle as $bloklar)
	{
		$ad = 'blok_'.rand(1111111111, 9999999999);
		if ($bloklar['adres'] != '') $adres = "phpkf-bilesenler/eklentiler/$dizin/$bloklar[adres]";
		else $adres = '';
		if (!isset($bloklar['simge'])) $bloklar['simge'] = '';

		// bloklar veritabanına giriliyor
		$vtsorgu = "INSERT INTO $tablo_bloklar (ad,sira,baslik,durum,ozel_blok,ozel_ikon,blok_genislik,adres,ozel_blok_kod)";
		$vtsorgu .= "VALUES ('$ad','0','$bloklar[baslik]','$bloklar[yer]','1','$bloklar[simge]','$bloklar[genislik]','$adres','$bloklar[kod]')";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		// sayfa id'si alınıyor
		$blokid .= $vt->insert_id().',';
	}
} // blok ekle sonu




//  Eklenti veritabanına giriliyor  //
//  Eklenti veritabanına giriliyor  //

if ($eklenti_kat2 == NULL) $ayar_kat = 0;
else $ayar_kat = $eklenti_kat2;

$vtsorgu = "INSERT INTO $tablo_eklentiler (ad,baslik,kur,etkin,vt,dosya,dizin,sistem,usurum,esurum,bloklar,ayar_kat)";
$vtsorgu .= "VALUES ('$dizin','$eklenti_baslik', '1', '1', '1', '1', '1','0', '$uyumlu_surum', '$eklenti_bilgi[esurum]', '$blokid', '$ayar_kat')";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


if ($dosya_ekleme_durum){
	if ($tema_eklenti) header('Location: hatalar.php?bilgi=17');
	else header('Location: hatalar.php?bilgi=2&git='.$dizin);
}
else header('Location: hatalar.php?bilgi=15&git='.$dizin);
exit();


} // Eklenti kurulumu yapılıyor - sonu








// Eklenti kaldırma yapılıyor - başı
// Eklenti kaldırma yapılıyor - başı
// Eklenti kaldırma yapılıyor - başı

if (isset($_GET['kaldir']))
{
// eklenti bilgileri veritabanından çekiliyor
$vtsorgu = "SELECT bloklar FROM $tablo_eklentiler WHERE ad='$dizin' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());
$eklenti = $vt->fetch_assoc($vtsonuc);


// blok kaldır
if ($eklenti['bloklar'] != '')
{
	$bloklar = explode(',',$eklenti['bloklar']);

	foreach ($bloklar as $blok)
	{
		if ($blok == '') continue;
		$vtsorgu = "DELETE FROM $tablo_bloklar WHERE id='$blok' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	}
} // blok kaldır sonu




// eklenti girdisi veritabanından siliniyor
// eklenti girdisi veritabanından siliniyor

$vtsorgu = "DELETE FROM $tablo_eklentiler WHERE ad='$dizin' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


if ($dosya_silme_durum) header('Location: hatalar.php?bilgi=3&git='.$dizin);
else header('Location: hatalar.php?bilgi=16&git='.$dizin);
exit();


} // Eklenti kaldırma yapılıyor - sonu








// Eklenti güncelleme yapılıyor - başı
// Eklenti güncelleme yapılıyor - başı
// Eklenti güncelleme yapılıyor - başı

if (isset($_GET['guncel']))
{

// eklenti veritabanı girdisi güncelleniyor
// eklenti veritabanı girdisi güncelleniyor

$vtsorgu = "UPDATE $tablo_eklentiler SET usurum='$uyumlu_surum', esurum='$eklenti_bilgi[esurum]' WHERE ad='$dizin' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die($vt->hata_ver());


if ($dosya_silme_durum) header('Location: hatalar.php?bilgi=20&git='.$dizin);
else header('Location: hatalar.php?bilgi=21&git='.$dizin);
exit();


} // Eklenti güncelleme yapılıyor - sonu





} // dosya kontrol - sonu

} // son koşul

// TÜM ORTAK İŞLEMLER - SONU //
// TÜM ORTAK İŞLEMLER - SONU //
// TÜM ORTAK İŞLEMLER - SONU //











$eklenti_kurulum = true;
//$eklenti_guncelleme = true;
//$eklenti_kaldirma = true;


//  YÜKLÜ EKLENTİLER SIRALANIYOR  //
//  YÜKLÜ EKLENTİLER SIRALANIYOR  //
//  YÜKLÜ EKLENTİLER SIRALANIYOR  //

if ($tema_eklenti) {
	$dosya_adi = 'eklentiler.php?kip=tema&amp;';
	$yedizin_adi = '../phpkf-bilesenler/temalar/'; // temalar dizini
	$yedizin_adi2 = '/eklenti'; // tema eklenti dizini
	$sayfa_kip_link = '<a href="eklentiler.php">'.$ly['eklentiler'].'</a> &nbsp;|&nbsp; <b>'.$ly['tema_eklentileri'].'</b> &nbsp;|&nbsp; <a href="eklentiler.php?kip=yukle">'.$ly['eklenti_yukle'].'</a>';
}
else {
	$dosya_adi = 'eklentiler.php?';
	$yedizin_adi = '../phpkf-bilesenler/eklentiler/'; // eklentiler dizini
	$yedizin_adi2 = ''; // tema eklenti dizini
	$sayfa_kip_link = '<b>'.$ly['eklentiler'].'</b> &nbsp;|&nbsp; <a href="eklentiler.php?kip=tema">'.$ly['tema_eklentileri'].'</a> &nbsp;|&nbsp; <a href="eklentiler.php?kip=yukle">'.$ly['eklenti_yukle'].'</a>';
}

if (!$yedizin = @opendir($yedizin_adi))  // eklentiler dizini açılıyor
{
	header('Location: hatalar.php?hata=13');
	exit();
}


$adet = 0;
$icerik_kurulu = '';
$icerik_kurdegil = '';
$tema_sayfa_icerik = '<div style="float:left;width:100%;text-align:left;padding-bottom:25px">'.$sayfa_kip_link.'</div>
<br />
<table cellspacing="1" cellpadding="4" width="100%" border="0" align="center" class="tablo-ana">';




//  DİZİNDEKİ EKLENTİLER DÖNGÜYE SOKULARAK GÖRÜNTÜLENİYOR   //

while ( @gettype($bilgi = @readdir($yedizin)) != 'boolean' )
{
$dongu_icerik = '';
$dongu_icerikb = '';


if ( (@is_dir($yedizin_adi.$bilgi)) AND ($bilgi != '.') AND ($bilgi != '..') )
{
	if (!@include_once($yedizin_adi.$bilgi.$yedizin_adi2.'/index.php'))
	{
		if (!$tema_eklenti)
		{
			$icerik_kurdegil .= '<tr class="tablo_ici"><td colspan="4" align="center"><br /><font color="#ff0000">';

			if (@is_file($yedizin_adi.$bilgi.'/eklenti_bilgi.xml'))
				$icerik_kurdegil .= 'Bu eklenti ('.$bilgi.') phpKF Forum veya Portal eklentisi !<br />phpKF-CMS eklentilerini indirmek için <a target="_blank" href="https://www.phpkf.com/eklentiler.php">tıklayın.</a>';
			else $icerik_kurdegil .= 'Eklenti dosyası bulunamıyor !<br />phpkf-bilesenler/eklentiler/'.$bilgi.$yedizin_adi2.'/index.php';

			$icerik_kurdegil .= '</font><br /><br /></td></tr><tr><td bgcolor="#eeeeee" colspan="4" style="height:3px"></td></tr>';
		}
		continue;
	}


	// Eklenti kuruluysa bilgileri veritabanından çekiliyor
	$vtsorgu = "SELECT * FROM $tablo_eklentiler where ad='$bilgi' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$ekl_satir = $vt->fetch_assoc($vtsonuc);

	$kur_kaldir = '<a name="'.$bilgi.'"></a>';


	if ($ekl_satir['kur'] == 1)
	{
		if ( (!preg_match('/'.$uyumlu_surum.'/', $eklenti_bilgi['usurum']))
			OR ($ekl_satir['esurum'] > $eklenti_bilgi['esurum']) )
			$kur_kaldir .= '<font color="#ff0000">'.$ly['eklenti_uyumsuz'].'</font><br />';

		elseif ( ($ekl_satir['usurum'] == $uyumlu_surum) AND (preg_match('/'.$ekl_satir['usurum'].'/', $eklenti_bilgi['usurum'])) AND ($ekl_satir['esurum'] == $eklenti_bilgi['esurum']) )
			$kur_kaldir .= '<font color="#007900">'.$ly['kurulu'].'</font><br />';

		elseif ( (!preg_match('/'.$ekl_satir['usurum'].'$/', $eklenti_bilgi['usurum']))
			OR ($ekl_satir['esurum'] < $eklenti_bilgi['esurum']) )
			$kur_kaldir .= '<font color="#ff0000">'.$ly['guncelleme_gerekli'].'</font><br /><br />
			<a href="'.$dosya_adi.'guncel='.$bilgi.'&amp;yo='.$yo.'" title="'.$ly['eklentiyi_guncelle'].'">- '.$ly['guncelle'].' -</a>';


		$kur_kaldir .= '<div style="height:50px"></div><a href="'.$dosya_adi.'kaldir='.$bilgi.'&amp;yo='.$yo.'" onclick="return window.confirm(\''.$ly['eklenti_kaldir_uyari'].'\')">-'.$ly['kaldir'].'-</a></font>';
	}

	else
	{
		if (!preg_match('/'.$uyumlu_surum.'/', $eklenti_bilgi['usurum']))
			$kur_kaldir .= '<font color="#ff0000">'.$ly['eklenti_uyumsuz'].'</font><br />';
		else $kur_kaldir .= '<font color="#ff0000">'.$ly['kurulu_degil'].'</font><div style="height:50px"></div><a href="'.$dosya_adi.'kur='.$bilgi.'&amp;yo='.$yo.'">-'.$ly['kur'].'-</a>';
	}


	// Eklenti - sistem sürüm uyumluluğu
	$surum_uyumluluk = str_replace(';',', ', $eklenti_bilgi['usurum']);
	if (!preg_match('/'.$uyumlu_surum.'/', $eklenti_bilgi['usurum'])) $surum_uyumluluk .= ' <font color="#ff0000" size="1">('.$ly['uyumsuz'].')</font>';




	// Eklenti bilgileri

	$dongu_icerik .= '<tr class="tablo_ici">
	<td align="center" valign="top" rowspan="2" width="90" style="padding-top:12px">
	'.$kur_kaldir.'
	<img src="../phpkf-dosyalar/bosluk.gif" border="0" height="0" width="90" />
	</td>

	<td align="center" valign="middle" height="28" colspan="3">
	<b class="eklenti_adi">'.$eklenti_bilgi['ad'].'</b>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="center" valign="middle" width="110">
<a href="javascript:void(0)" onclick="pencere(\''.$yedizin_adi.$bilgi.$yedizin_adi2.'/'.$eklenti_bilgi['resim_buyuk'].'\')"><img src="'.$yedizin_adi.$bilgi.$yedizin_adi2.'/'.$eklenti_bilgi['resim_kucuk'].'" alt="'.$ly['gorunum'].'" border="0" width="90"></a>
	</td>

	<td align="left" valign="top" style="min-width:170px" class="eklenti_bilgi">
	'.$ly['tip'].': '.$eklenti_bilgi['tip'].'
	<br />'.$ly['yapımci'].': <a target="_bank" href="'.$eklenti_bilgi['adres'].'">'.$eklenti_bilgi['yapimci'].'</a>
	<br />'.$ly['telif'].': '.$eklenti_bilgi['telif'].'
	<br />'.$l['tarih'].': '.$eklenti_bilgi['tarih'].'
	<br />'.$ly['eklenti_surumu'].': '.$eklenti_bilgi['esurum'].'
	<br />'.$ly['uyumlu_surumler'].': '.$surum_uyumluluk.'
	</td>

	<td align="left" valign="top" style="min-width:200px" class="eklenti_bilgi">
<div style="position: relative; float: center; overflow: auto; width: 100%; height: 118px;" onclick="this.style.height=\'\'">';



	if (isset($tema_ekle))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['eklenecek_tema_adi'].':</b> &nbsp; '.$tema_ekle;
	}


	// Bul-değiştir
	if (isset($bul_degistir))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['degistirilecek_dosyalar'].':</b>';

		foreach ($bul_degistir as $kdosya)
		{
			if (isset($kdosya)) $dongu_icerikb .= '<br />'.$kdosya['dosya'];
		}
	}


	// Bağlantı ekleme
	if (isset($baglanti_ekle))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['eklenecek_bağlantılar'].':</b> &nbsp; ';

		foreach ($baglanti_ekle as $baglar)
		{
			$dongu_icerikb .= $baglar['ad'].', ';
		}
	}


	// Yönetim menü ekleme
	if (isset($yonetim_menu_ekle))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['eklenecek_yonetim_menuleri'].':</b> &nbsp; ';

		foreach ($yonetim_menu_ekle as $menuler)
		{
			$dongu_icerikb .= '<br />'.$menuler['menu_baslik'].': ';

			foreach ($menuler['adresler'] as $baglar)
				$dongu_icerikb .= $baglar['baslik'].', ';
		}
	}


	// Sef adres ekleme
	if (isset($sef_ekle))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['eklenecek_sef_adresler'].':</b> &nbsp; ';

		$sef_adresler = explode("\n", $sef_ekle);

		foreach ($sef_adresler as $sef_adres)
		{
			$sef_adres2 = explode('=', $sef_adres);
			$dongu_icerikb .= $sef_adres2[0].', ';
		}
	}


	// Dosya ekleme
	if (isset($dosya_ekle))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['eklenecek_dosyalar'].':</b> &nbsp; ';

		foreach ($dosya_ekle as $dosyalar)
		{
			$dongu_icerikb .= $dosyalar['dosya'].', ';
		}
	}


	// Alan ekleme
	if (isset($alan_ekle))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['eklenecek_alanlar'].':</b><br />';

		foreach ($alan_ekle as $ealanlar)
		{
			if (isset($ealanlar['etiket'])) $dongu_icerikb .= $ealanlar['etiket'].', ';
		}
	}


	// Ayar ekleme
	if (isset($ayar_ekle))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['eklenecek_ayarlar'].':</b><br />';

		foreach ($ayar_ekle as $eayarlar)
		{
			if (isset($eayarlar['etiket'])) $dongu_icerikb .= $eayarlar['etiket'].', ';
		}
	}



	// Ayar değiştirme
	if (isset($ayar_degistir))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['değiştirilecek_ayarlar'].':</b><br />';

		foreach ($ayar_degistir as $dayarlar => $dayarlark)
		{
			if (isset($dayarlar)) $dongu_icerikb .= $dayarlar.', ';
		}
	}



	// Ayar kaldırma
	if (isset($ayar_kaldir))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['kaldirilacak_ayarlar'].':</b><br />';

		foreach ($ayar_kaldir as $kayarlar)
		{
			if (isset($kayarlar)) $dongu_icerikb .= $kayarlar.', ';
		}
	}


	// Bağlantı kaldırma
	if (isset($baglanti_kaldir))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['kaldirilacak_baglantilar'].':</b> &nbsp; ';

		foreach ($baglanti_kaldir as $baglar)
		{
			$dongu_icerikb .= $baglar.', ';
		}
	}


	// Blok ekleme
	if (isset($blok_ekle))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['eklenecek_bloklar'].':</b> &nbsp; ';

		foreach ($blok_ekle as $bloklar)
		{
			$dongu_icerikb .= '<br />'.$ly['baslik'].': '.$bloklar['baslik'];

			if ($bloklar['yer'] == '1') $dongu_icerikb .= '<br />'.$ly['yer'].': '.$ly['sol'];
			elseif ($bloklar['yer'] == '2') $dongu_icerikb .= '<br />'.$ly['yer'].': '.$ly['sag'];
			else $dongu_icerikb .= '<br />'.$ly['yer'].': '.$ly['kapali'];

			//if ($bloklar['sayfa'] == '0') $dongu_icerikb .= '<br />Sayfa: Tüm sayfalarda';
			//elseif ($bloklar['sayfa'] == '1') $dongu_icerikb .= '<br />Sayfa: Ana sayfada';

			if ($bloklar['adres'] != '') $dongu_icerikb .= '<br />'.$ly['dosya'].': '.$bloklar['adres'];
			if ($bloklar['kod'] != '') $dongu_icerikb .= '<br />'.$ly['kod'].': '.$ly['var'];
			else $dongu_icerikb .= '<br />'.$ly['kod'].': '.$ly['yok'];
		}
	}


	// Veritabanı sorguları
	if (isset($vt_sorgu_ekle))
	{
		if ($dongu_icerikb != '') $dongu_icerikb .= '<br /><br />';
		$dongu_icerikb .= '<b>'.$ly['veritabani_sorgulari'].':</b><br />';
		$sira = 1;

		foreach ($vt_sorgu_ekle as $vtsorgu_ekle)
		{
			if (isset($vtsorgu_ekle))
			{
				if (strlen($vtsorgu_ekle) > 50) $dongu_icerikb .= $sira.') '.substr($vtsorgu_ekle, 0, 50).'...<br>';
				else $dongu_icerikb .= $sira.') '.$vtsorgu_ekle.'<br>';
				$sira++;
			}
		}
	}



	if ($dongu_icerikb == '') $dongu_icerikb = $ly['eklenti_islem_yok'];

	$dongu_icerik .= $dongu_icerikb.'</div></td></tr>

	<tr class="tablo_ici">
	<td align="left" valign="top" colspan="4">
	<div class="eklenti_bilgi" style="position: relative; float: center; overflow: auto; width: 100%; height: 58px;" onclick="this.style.height=\'\'">
	<b>'.$ly['aciklama'].':</b> &nbsp; '.$eklenti_bilgi['aciklama'].'
	</div>
	</td>
	</tr>

	<tr><td class="tablo-alt" colspan="4" style="height:3px"></td></tr>
';

	// Kurulu olanlar en üste alınıyor
	if ($ekl_satir['kur'] == 1) $icerik_kurulu .= $dongu_icerik;
	else $icerik_kurdegil .= $dongu_icerik;


	unset($dongu_icerik);
	unset($dongu_icerikb);
	unset($eklenti_bilgi);
	unset($tema_ekle);
	unset($baglanti_ekle);
	unset($baglanti_kaldir);
	unset($sef_ekle);
	unset($sef_kaldir);
	unset($dosya_ekle);
	unset($dosya_sil);
	unset($alan_ekle);
	unset($ayar_ekle);
	unset($ayar_degistir);
	unset($ayar_kaldir);
	unset($blok_ekle);
	unset($vt_sorgu_ekle);
	unset($bul_degistir);
	unset($yonetim_menu_ekle);
	$adet++;
}
}


// hiç eklenti yoksa
if ($adet == 0)
{
	$icerik_kurulu = '<tr><td class="tablo_ici" align="center">';

	if ($tema_eklenti) $icerik_kurulu .= '<br>'.$ly['tema_eklenti_yok'].'<br><br>';
	else $icerik_kurulu .= '<br>'.$ly['yuklu_eklenti_yok'].'<br><br>'.str_replace('www.phpKF.com', '<a href="https://www.phpkf.com/eklentiler.php" target="_blank">www.phpKF.com</a>', $ly['yuklu_eklenti_yok_bilgi']).'<br><br>';

	$icerik_kurulu .= '</td></tr>';
}


$tema_sayfa_icerik .= $icerik_kurulu.$icerik_kurdegil.'</table>
<script type="text/javascript">
<!-- //
function pencere(adres){
window.open(adres,"_blank","scrollbars=yes,left=0,top=0,resizable=yes,toolbar=0,status=0,width="+screen.width+",height="+screen.height);}
//  -->
</script>
';


endif; // Yükleme koşul sonu



// tema dosyası yükleniyor
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));

?>