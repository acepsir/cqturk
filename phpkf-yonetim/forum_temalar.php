<?php
/*
 +-=========================================================================-+
 |                              phpKF Forum v3.00                            |
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


$dosya_adi = 'forum_temalar.php';
$uyumlu_surum = '2.10';
$tablo_portal_ayarlar = $tablo_oneki.'portal_ayarlar';



// yönetim oturum kodu
if (isset($_GET['yo'])) $gyo = @zkTemizle($_GET['yo']);
elseif (isset($_POST['yo'])) $gyo = @zkTemizle($_POST['yo']);
else $gyo = '';




// Forum - Portal Seçimi

if (isset($_GET['kip']))
{
	if ($_GET['kip'] == 'portal') $kip = 'portal';
	elseif ($_GET['kip'] == 'pyukle') $kip = 'portal';
	else $kip = 'forum';
}
else $kip = 'forum';

if ($kip == 'forum')
{
	$kip = 'forum';
	$kip_bilgi = ' ('.$l['forum'].')';
	$dizin_tema = '../temalar/';
	$dizin_tema_bilgi = '/temalar/';

	if ((isset($_GET['kip']) AND ($_GET['kip'] == 'yukle')))
	{
		$kip_forum = '&laquo; &nbsp;'.$l['forum'].' '.$ly['tema_yukle'];
		$kip_portal = '<a href="'.$dosya_adi.'?kip=pyukle" style="text-decoration:none"><b>'.$l['portal'].' '.$ly['tema_yukle'].'&nbsp; &raquo;</b></a>';
	}
	else
	{
		$kip_forum = '&laquo; &nbsp;'.$l['forum'].' '.$ly['temalar'];
		$kip_portal = '<a href="'.$dosya_adi.'?kip=portal" style="text-decoration:none"><b>'.$l['portal'].' '.$ly['temalar'].'&nbsp; &raquo;</b></a>';
	}
}

else
{
	$kip = 'portal';
	$kip_bilgi = ' ('.$l['portal'].')';
	$dizin_tema = '../portal/temalar/';
	$dizin_tema_bilgi = '/portal/temalar/';

	if ((isset($_GET['kip']) AND ($_GET['kip'] == 'pyukle')))
	{
		$kip_forum = '<a href="'.$dosya_adi.'?kip=yukle" style="text-decoration:none"><b>&laquo; &nbsp;'.$l['forum'].' '.$ly['tema_yukle'].'</b></a>';
		$kip_portal = $l['portal'].' '.$ly['tema_yukle'].'&nbsp; &raquo;';
	}
	else
	{
		$kip_forum = '<a href="'.$dosya_adi.'?kip=forum" style="text-decoration:none"><b>&laquo; &nbsp;'.$l['forum'].' '.$ly['temalar'].'</b></a>';
		$kip_portal = $l['portal'].' '.$ly['temalar'].'&nbsp; &raquo;';
	}

	$vtsorgu = "SELECT * FROM $tablo_portal_ayarlar where isim='tema_secenek' LIMIT 1";
	$pt_sonuc = @$vt->query($vtsorgu) or die ($vt->hata_ver());
	$portal_temalari = $vt->fetch_assoc($pt_sonuc);
}









//	VARSAYILAN TEMAYI DEĞİŞTİR	//
//	VARSAYILAN TEMAYI DEĞİŞTİR	//

if ( (isset($_GET['temadizini'])) AND ($_GET['temadizini'] != '') )
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if (strlen($_GET['temadizini']) > 20)
	{
		header('Location: hata.php?hata=77');
		exit();
	}

	$_GET['temadizini'] = @zkTemizle($_GET['temadizini']);


	// forum için varsayılan tema değişimi	//

	if ($kip == 'forum')
	{
		// tema bilgileri tema_bilgi.txt dosyasından alınıyor
		$dosya = $dizin_tema.$_GET['temadizini'].'/tema_bilgi.txt';

		if (!($dosya_ac = @fopen($dosya,'r')))
		{
			echo '<p><font color="red"><b>'.$dosya.' dosyası bulunamıyor!</b></font></p>';
			exit();
		}


		// forum tema sürüme bakılıyor
		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// forum teması seçeneklerde var mı bakılıyor
		if (!preg_match("/$_GET[temadizini],/", $ayarlar['tema_secenek']))
		{
			header('Location: hata.php?hata=197');
			exit();
		}


		// tema dizini veritabanına giriliyor //
		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_GET[temadizini]' where etiket='temadizini' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: '.$dosya_adi.'?kip=forum');
		exit();
	}


	// portal için varsayılan tema değişimi //

	else
	{
		// tema bilgileri tema_bilgi.txt dosyasından alınıyor
		$dosya = $dizin_tema.$_GET['temadizini'].'/tema_bilgi.txt';

		if (!($dosya_ac = @fopen($dosya,'r')))
		{
			echo '<p><font color="red"><b>'.$dosya.' dosyası bulunamıyor!</b></font></p>';
			exit();
		}


		// portal tema sürümüne bakılıyor
		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// portal teması seçeneklerde var mı bakılıyor
		if (!preg_match("/$_GET[temadizini],/", $ayarlar['tema_secenek_portal']))
		{
			header('Location: hata.php?hata=197');
			exit();
		}


		// tema dizini veritabanına giriliyor //
		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$_GET[temadizini]' where etiket='temadizini_portal' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: '.$dosya_adi.'?kip=portal');
		exit();
	}
}




//	KULLANICI SEÇİMLERİNİ BU TEMAYA AYARLA	//
//	KULLANICI SEÇİMLERİNİ BU TEMAYA AYARLA	//

elseif ( (isset($_GET['kullanici'])) AND ($_GET['kullanici'] != '') )
{
	$_GET['kullanici'] = @zkTemizle($_GET['kullanici']);

	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if (strlen($_GET['kullanici']) >  20)
	{
		header('Location: hata.php?hata=77');
		exit();
	}



	// forum için kullanıcı seçimi //

	if ($kip == 'forum')
	{
		// forum tema sürümüne bakılıyor
		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// forum teması seçeneklerde var mı bakılıyor
		if (!preg_match("/$_GET[kullanici],/", $ayarlar['tema_secenek']))
		{
			header('Location: hata.php?hata=197');
			exit();
		}



		$vtsorgu = "UPDATE $tablo_kullanicilar SET temadizini='$_GET[kullanici]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: '.$dosya_adi.'?kip=forum');
		exit();
	}


	// portal için kullanıcı seçimi //

	else
	{
		// portal tema sürümüne bakılıyor
		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// portal teması seçeneklerde var mı bakılıyor
		if (!preg_match("/$_GET[kullanici],/", $ayarlar['tema_secenek_portal']))
		{
			header('Location: hata.php?hata=197');
			exit();
		}



		$vtsorgu = "UPDATE $tablo_kullanicilar SET temadizinip='$_GET[kullanici]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: '.$dosya_adi.'?kip=portal');
		exit();
	}
}




//	TEMAYI SEÇENEKLERE EKLE	//
//	TEMAYI SEÇENEKLERE EKLE	//

elseif ( (isset($_GET['ekle'])) AND ($_GET['ekle'] != '') )
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if (strlen($_GET['ekle']) >  20)
	{
		header('Location: hata.php?hata=77');
		exit();
	}



	// forum için seçeneklere ekle //
	if ( ($kip == 'forum') AND (!preg_match("/$_GET[ekle],/", $ayarlar['tema_secenek'])) )
	{
		$tema_ekle = @zkTemizle($_GET['ekle']);
		$tema_ekle = $ayarlar['tema_secenek'].$tema_ekle.',';


		// forum tema sürümüne bakılıyor
		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// tema seçenekler arasına ekleniyor
		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$tema_ekle' where etiket='tema_secenek' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: '.$dosya_adi.'?kip=forum');
		exit();
	}


	// portal için seçeneklere ekle //

	elseif ( ($kip == 'portal') AND (!preg_match("/$_GET[ekle],/", $ayarlar['tema_secenek_portal'])) )
	{
		$tema_ekle = @zkTemizle($_GET['ekle']);
		$tema_ekle = $ayarlar['tema_secenek_portal'].$tema_ekle.',';


		// portal tema sürümüne bakılıyor
		if (!preg_match('/'.$uyumlu_surum.'/', $_GET['surum']))
		{
			header('Location: hata.php?hata=196');
			exit();
		}


		// tema seçenekler arasına ekleniyor
		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$tema_ekle' where etiket='tema_secenek_portal' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: '.$dosya_adi.'?kip=portal');
		exit();
	}

	header('Location: '.$dosya_adi);
	exit();
}




//	TEMAYI SEÇENEKLERDEN KALDIR	//
//	TEMAYI SEÇENEKLERDEN KALDIR	//

elseif ( (isset($_GET['kaldir'])) AND ($_GET['kaldir'] != '') )
{
	//  OTURUM BİLGİSİNE BAKILIYOR  //
	if ($gyo != $yo)
	{
		header('Location: hata.php?hata=45');
		exit();
	}


	if (strlen($_GET['kaldir']) >  20)
	{
		header('Location: hata.php?hata=77');
		exit();
	}


	if ($_GET['kaldir'] == 'varsayilan')
	{
		header('Location: hata.php?hata=150');
		exit();
	}


	// forum için seçeneklerden kalır //
	if ( ($kip == 'forum') AND (preg_match("/$_GET[kaldir],/", $ayarlar['tema_secenek'])) )
	{
		$_GET['kaldir'] = @zkTemizle($_GET['kaldir']);
		$tema_cikart = str_replace($_GET['kaldir'].',','',$ayarlar['tema_secenek']);


		// tema varsayılan ise kaldırılıyor
		if ($secili_tema == $_GET['kaldir'])
		{
			$vtsorgu = "UPDATE $tablo_ayarlar SET deger='varsayilan' where etiket='temadizini' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}


		// tema seçenekler arasından kaldırılıyor
		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$tema_cikart' where etiket='tema_secenek' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


		// temayı kullanan üyelerin seçimleri siliniyor
		$vtsorgu = "UPDATE $tablo_kullanicilar SET temadizini='' where temadizini='$_GET[kaldir]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: '.$dosya_adi.'?kip=forum');
		exit();
	}


	// portal için seçeneklerden kaldır //

	elseif ( ($kip == 'portal') AND (preg_match("/$_GET[kaldir],/", $ayarlar['tema_secenek_portal'])) )
	{
		$_GET['kaldir'] = @zkTemizle($_GET['kaldir']);
		$tema_cikart = str_replace($_GET['kaldir'].',','',$ayarlar['tema_secenek_portal']);


		// tema varsayılan ise kaldırılıyor
		if ($ayarlar['temadizini_portal'] == $_GET['kaldir'])
		{
			$vtsorgu = "UPDATE $tablo_ayarlar SET deger='varsayilan' where etiket='temadizini_portal' LIMIT 1";
			$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
		}


		// tema seçenekler arasından kaldırılıyor
		$vtsorgu = "UPDATE $tablo_ayarlar SET deger='$tema_cikart' where etiket='tema_secenek_portal' LIMIT 1";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


		// temayı kullanan üyelerin seçimleri siliniyor
		$vtsorgu = "UPDATE $tablo_kullanicilar SET temadizinip='' where temadizinip='$_GET[kaldir]'";
		$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

		header('Location: '.$dosya_adi.'?kip=portal');
		exit();
	}

	header('Location: '.$dosya_adi);
	exit();
}










//  YÜKLÜ TEMALAR SIRALANIYOR  //
//  YÜKLÜ TEMALAR SIRALANIYOR  //
//  YÜKLÜ TEMALAR SIRALANIYOR  //



//  Yükleme işlemleri - Başı  //

if ( (isset($_GET['kip'])) AND (($_GET['kip'] == 'yukle') OR ($_GET['kip'] == 'pyukle')) ):


// Yükleme yapılıyor - başı //
if ( (isset($_POST['yukleme'])) AND ($_POST['yukleme'] == 'yapildi') )
{
	$uzanti = @end(@explode('.',$_FILES['tema_yukle']['name']));
	$sayfa_icerik = '';

	if ( (isset($_FILES['tema_yukle']['error'])) AND ($_FILES['tema_yukle']['error'] != 0) )
		$sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Dosya yüklenemedi, dosya adı alınamadı !</b></font><br><br><b>Nedeni dosyanın çok büyük olması ya da<br>dosya adının kabul edilemeyen karakterler içermesi olabilir.</b></p>';

	elseif ( (isset($_FILES['tema_yukle']['tmp_name'])) AND ($_FILES['tema_yukle']['tmp_name'] != '') )
	{
		if ($_FILES['tema_yukle']['size'] > 10485760)
			$sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Çok büyük temalar buradan yüklenemez !</b></font><br><br><b>Bu temayı açıp (zipten çıkartıp) FTP programıyla '.$dizin_tema_bilgi.' dizinine kendiniz yükleyin.</b></p>';

		elseif ($uzanti != 'zip')
			$sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Sadece .zip uzantılı (zip olarak sıkıştırılmış) temalar yükleneblir !</b></font></p>';

		elseif (!@extension_loaded('zip'))
			$sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>Sunucunuz zip dosyalarını açmayı desteklemiyor !</b></font><br><br><b>Bu temayı açıp (zipten çıkartıp) FTP programıyla '.$dizin_tema_bilgi.' dizinine kendiniz yükleyin.</b></p>';

		else
		{
			$arsiv = new ZipArchive;
			$zip_dosya = $arsiv->open($_FILES['tema_yukle']['tmp_name']);

			if ($zip_dosya === true)
			{
				$eski_umask = umask(0);
				ob_start();
				ob_implicit_flush(0);
				$arsiv->extractTo($dizin_tema);
				$zip_hata = ob_get_contents();
				ob_end_clean();
				$arsiv->close();
				umask($eski_umask);
				$dosyaya_git = substr($_FILES['tema_yukle']['name'], 0, -4);


				if ($zip_hata == '') $sayfa_icerik = '<center><br><br><b>Yükleme Tamamlandı !</b><br><br>Yüklü temaları görmek için <a href="'.$dosya_adi.'?kip='.$kip.'#'.$dosyaya_git.'">tıklayın.</a></center>';

				else
				{
					$sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>ZiP DOSYASI ÇIKARTILAMIYOR !</b></font><br><br>Sunucu bu dizine dosya kopyalanmasına izin vermiyor.';
					if(@ini_get('safe_mode')) $sayfa_icerik .= ' Nedeni SAFE MODE`un açık olması olabilir.';
					$sayfa_icerik .= '<br><br><br><br><b>Hata Çıktısı:</b><br>'.$zip_hata.'</p>';
				}
			}

			else $sayfa_icerik = '<br><p align="center"><font color="#ff0000"><b>ZiP DOSYASI AÇILAMIYOR !</b></font><br><br><b>Hata Kodu: '.$zip_dosya.'</b></p>';
		}
	}
	$sayfa_icerik .= '<br>';
}

//  Yükleme yapılıyor - Sonu  //





//  Yükleme ekranı - Başı  //

else
{
if ($kip == 'portal') $kip_yukleme = 'pyukle';
else $kip_yukleme = 'yukle';


// Temalar dizinine yazma hakkına bakılıyor
$eyhakki = ' &nbsp; '.$ly['temalar_yazma_hakki'].':&nbsp;';
if (@fopen($dizin_tema.'yokla.txt', 'w')){
	@unlink($dizin_tema.'yokla.txt');
	$eyhakki .= '<font color="#008800"><b>'.$ly['var'].'</b></font>';}
else $eyhakki .= '<font color="#ff0000"><b>'.$ly['yok'].' !</b></font>
<br> &nbsp; Tema yükleme ve kurulumu için '.$dizin_tema_bilgi.' dizinine yazma hakkı olmalıdır.<br>';


// sunucu zip desteğine bakılıyor
$zipdestek = ' &nbsp; '.$ly['sunucu_zip_destegi'].':&nbsp;';
if (@extension_loaded('zip')) $zipdestek .= '<font color="#008800"><b>'.$ly['var'].'</b></font>';
else $zipdestek .= '<font color="#ff0000"><b>'.$ly['desteklenmiyor'].'</b></font>
<br> &nbsp; Tema yüklemek için sunucuda zip desteği olmalıdır. Yüklemek istediğiniz temaları açıp (zipten çıkartıp), <br>FTP programıyla '.$dizin_tema_bilgi.' dizinine kendiniz kopayalabilirsiniz.';


// sunucu safe_mode ayarına bakılıyor
$safe_mode = ' &nbsp; '.$ly['safe_mode'].':&nbsp;';
if(@ini_get('safe_mode')) $safe_mode .= '<font color="#ff0000"><b>'.$ly['acik'].' !</b></font>
 &nbsp; &nbsp; Safe Mode`un açık olması forum üzerinden tema yüklemenize engel olabilir.';
else $safe_mode .= '<font color="#008800"><b>'.$ly['kapali'].'</b></font>';



$ly['tema_yukleme_bilgi'][0] = str_replace('www.phpKF.com', '<a href="https://www.phpkf.com/temalar.php?sayfa=cms" target="_blank">www.phpKF.com</a>', $ly['tema_yukleme_bilgi'][0]);


$sayfa_icerik = ' &nbsp; '.$ly['tema_yukleme_bilgi'][0].'<br><br>
<ul>
<li>2mb.`dan büyük dosyalar, sunucuda kısıtlama varsa yüklenmeyebilir.</li>
<li>Tema yükleme işlemi için sunucunuzda zip açma özelliği olmalıdır.</li>
<li>Temaların yükleneceği '.$dizin_tema_bilgi.' dizinine yazma hakkı olmalıdır.</li><li>Sorunlu temalar yüklerken değil kurulum yaparken hata verir.</li>
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

<form name="tema_yukleme" action="'.$dosya_adi.'?kip='.$kip_yukleme.'&amp;yo='.$yo.'" method="post" enctype="multipart/form-data" onsubmit="return denetle()">
<input type="hidden" name="yukleme" value="yapildi" />
<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
<b>'.$ly['dosya_sec'].': &nbsp;</b><input class="input-text" name="tema_yukle" type="file" size="200" style="width: 250px" />
<br><br><br>
&nbsp; &nbsp; &nbsp; <input class="dugme dugme-mavi" type="submit" value="'.$ly['tema_yukle'].'" />
</form></center>
<br>';
}




// tema dosyası yükleniyor
$sayfa_adi = $ly['temalar'];
$tema_sayfa_baslik = $ly['temalar'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/forum_temalar.php'));


//  Yükleme ekranı - Sonu  //


























//  YÜKLÜ TEMALAR SIRALANIYOR  //
//  YÜKLÜ TEMALAR SIRALANIYOR  //
//  YÜKLÜ TEMALAR SIRALANIYOR  //

else:

//	SUNUCUDA YÜKLÜ TEMALAR SIRALANIYOR - BAŞI	//

$dizin = @opendir($dizin_tema);	// dizini açıyoruz
$yanlis_tema = 'where';


//	DİZİNDEKİ DOSYALAR DÖNGÜYE SOKULARAK GÖRÜNTÜLENİYOR	//

while ( @gettype($bilgi = @readdir($dizin)) != 'boolean' )
{
	if ( (@is_dir($dizin_tema.$bilgi)) AND ($bilgi != '.') AND ($bilgi != '..') )
	{
		// tema bilgileri tema_bilgi.txt dosyasından alınıyor
		$dosya = $dizin_tema.$bilgi.'/tema_bilgi.txt';

		if (!($dosya_ac = @fopen($dosya,'r')))
		{
			$tema_aciklama = '<p><font color="red">"'.$dizin_tema_bilgi.'tema_bilgi.txt" dosyası bulunamıyor!</font></p>';

			$tekli1[] = array('dizin' => $bilgi,
			'resim' => '',
			'ad' => $bilgi,
			'yapimci' => '',
			'surum' => '',
			'tarih' => '',
			'demo' => '',
			'aciklama' => $tema_aciklama,
			'uygulama' => '',
			'ekle_kaldir' => '',
			'kullanici' => '',
			'kullanim' => '',);

			continue;
		}

		$boyut = filesize($dosya);
		$dosya_metni = fread($dosya_ac,$boyut);
		fclose($dosya_ac);


		//	tema bilgileri parçalanıyor

		preg_match('|<TEMA_ADI>(.*?)</TEMA_ADI>|si', $dosya_metni, $tema_adi, PREG_OFFSET_CAPTURE);
		preg_match('|<YAPIMCI>(.*?)</YAPIMCI>|si', $dosya_metni, $tema_yapimci, PREG_OFFSET_CAPTURE);
		preg_match('|<BAGLANTI>(.*?)</BAGLANTI>|si', $dosya_metni, $tema_baglanti, PREG_OFFSET_CAPTURE);
		preg_match('|<SURUM>(.*?)</SURUM>|si', $dosya_metni, $tema_surum, PREG_OFFSET_CAPTURE);
		preg_match('|<TARIH>(.*?)</TARIH>|si', $dosya_metni, $tema_tarih, PREG_OFFSET_CAPTURE);
		preg_match('|<DEMO>(.*?)</DEMO>|si', $dosya_metni, $tema_demo, PREG_OFFSET_CAPTURE);
		preg_match('|<ACIKLAMA>(.*?)</ACIKLAMA>|si', $dosya_metni, $tema_aciklama, PREG_OFFSET_CAPTURE);
		preg_match('|<DUZENLEME>(.*?)</DUZENLEME>|si', $dosya_metni, $tema_duzenleme, PREG_OFFSET_CAPTURE);


		// bilgiler temizleniyor

		$tema_adi[1][0] = @zkTemizle($tema_adi[1][0]);
		$tema_yapimci[1][0] = @zkTemizle($tema_yapimci[1][0]);
		$tema_baglanti[1][0] = @zkTemizle($tema_baglanti[1][0]);
		$tema_surum[1][0] = @zkTemizle($tema_surum[1][0]);
		$tema_tarih[1][0] = @zkTemizle($tema_tarih[1][0]);
		$tema_demo[1][0] = @zkTemizle($tema_demo[1][0]);
		$tema_aciklama[1][0] = @zkTemizle($tema_aciklama[1][0]);

		if (isset($tema_duzenleme[1][0])) 
			$tema_duzenleme = '<br>Düzenleme: &nbsp;'.@zkTemizle($tema_duzenleme[1][0]);

		else $tema_duzenleme = '';


		//	veriler tema motoruna yollanıyor	//

		$tema_resim = '<img src="'.$dizin_tema.$bilgi.'/onizleme.jpg" width="250" height="238" border="1" alt="Tema Görüntüsü" style="margin:10px">';
		$tema_yapimci = '<a href="http://'.$tema_baglanti[1][0].'">'.$tema_yapimci[1][0].'</a>';
		if ($tema_demo[1][0] != '') $tema_demo = '<a href="http://'.$tema_demo[1][0].'" target="_blank">Tıklayın</a>';
		else $tema_demo = 'Yok';


		// forum için	//

		if ($kip == 'forum')
		{
			// bu temayı kullananların sayısı
			$vtsonuc9 = $vt->query("SELECT id FROM $tablo_kullanicilar WHERE temadizini='$bilgi'") or die ($vt->hata_ver());
			$tema_kullanim = $vt->num_rows($vtsonuc9);


			$tema_uygulama = '<a href="'.$dosya_adi.'?kip=forum&amp;temadizini='.$bilgi.'&amp;surum='.$tema_surum[1][0].'&amp;yo='.$yo.'" onclick="return window.confirm(\'Forumun varsayılan temasını değiştirmek istediğinize eminmisiniz ?\')">- varsayılan tema yap -</a>';
			$tema_kullanici = '<a href="'.$dosya_adi.'?kip=forum&amp;kullanici='.$bilgi.'&amp;surum='.$tema_surum[1][0].'&amp;yo='.$yo.'" onclick="return window.confirm(\'Tüm üye seçimlerini bu tema ile değiştirmek istediğinize eminmisiniz ?\')">- üye seçimlerini değiştir -</a>';


			if (preg_match("/$bilgi,/", $ayarlar['tema_secenek']))
				$ekle_kaldir = '<a href="'.$dosya_adi.'?kip=forum&amp;kaldir='.$bilgi.'&amp;yo='.$yo.'">-KALDIR-</a>';
			else $ekle_kaldir = '<a href="'.$dosya_adi.'?kip=forum&amp;ekle='.$bilgi.'&amp;surum='.$tema_surum[1][0].'&amp;yo='.$yo.'">- EKLE -</a>';
			if ($secili_tema == $bilgi) $ekle_kaldir = '<font color="green">Kullanılan</font><br><br>'.$ekle_kaldir;


			if (!preg_match('/'.$uyumlu_surum.'/', $tema_surum[1][0]))
				$ftema_surum = $tema_surum[1][0].' &nbsp; <font color="#ff0000"><i>( Uyumsuz )</i></font>';
			else $ftema_surum = str_replace(';',', ', $tema_surum[1][0]);


			$tekli1[] = array('dizin' => $bilgi,
			'resim' => $tema_resim,
			'ad' => $tema_adi[1][0],
			'yapimci' => $tema_yapimci,
			'surum' => $ftema_surum,
			'tarih' => $tema_tarih[1][0],
			'demo' => $tema_demo,
			'aciklama' => $tema_aciklama[1][0].$tema_duzenleme,
			'uygulama' => $tema_uygulama,
			'ekle_kaldir' => $ekle_kaldir,
			'kullanici' => $tema_kullanici,
			'kullanim' => $tema_kullanim.'<br>kişi');


			// yüklü olmayan tema seçimleri için sorgu
			$yanlis_tema .= " temadizini!='$bilgi' AND";
		}



		// portal için //

		elseif ($kip == 'portal')
		{
			// bu temayı kullananların sayısı
			$vtsonuc9 = $vt->query("SELECT id FROM $tablo_kullanicilar WHERE temadizinip='$bilgi'") or die ($vt->hata_ver());
			$tema_kullanim = $vt->num_rows($vtsonuc9);
			$ptemas = str_replace('Portal - ', '',$tema_surum[1][0]);


			$tema_uygulama = '<a href="'.$dosya_adi.'?kip=portal&amp;temadizini='.$bilgi.'&amp;surum='.$ptemas.'&amp;yo='.$yo.'" onclick="return window.confirm(\'Portalın varsayılan temasını değiştirmek istediğinize eminmisiniz ?\')">- varsayılan tema yap -</a>';
			$tema_kullanici = '<a href="'.$dosya_adi.'?kip=portal&amp;kullanici='.$bilgi.'&amp;surum='.$ptemas.'&amp;yo='.$yo.'" onclick="return window.confirm(\'Tüm üye seçimlerini bu tema ile değiştirmek istediğinize eminmisiniz ?\')">- üye seçimlerini değiştir -</a>';


			if (preg_match("/$bilgi,/", $ayarlar['tema_secenek_portal']))
				$ekle_kaldir = '<a href="'.$dosya_adi.'?kip=portal&amp;kaldir='.$bilgi.'&amp;yo='.$yo.'">-KALDIR-</a>';
			else $ekle_kaldir = '<a href="'.$dosya_adi.'?kip=portal&amp;ekle='.$bilgi.'&amp;surum='.$ptemas.'&amp;yo='.$yo.'">- EKLE -</a>';
			if ($ayarlar['temadizini_portal'] == $bilgi) $ekle_kaldir = '<font color="green">Kullanılan</font><br><br>'.$ekle_kaldir;


			if (!preg_match('/'.$uyumlu_surum.'/', $ptemas))
				$ptema_surum = $tema_surum[1][0].' &nbsp; <font color="#ff0000"><i>( Uyumsuz )</i></font>';
			else $ptema_surum = str_replace(';',', ', $tema_surum[1][0]);


			$tekli1[] = array('dizin' => $bilgi,
			'resim' => $tema_resim,
			'ad' => $tema_adi[1][0],
			'yapimci' => $tema_yapimci,
			'surum' => $ptema_surum,
			'tarih' => $tema_tarih[1][0],
			'demo' => $tema_demo,
			'aciklama' => $tema_aciklama[1][0].$tema_duzenleme,
			'uygulama' => $tema_uygulama,
			'ekle_kaldir' => $ekle_kaldir,
			'kullanici' => $tema_kullanici,
			'kullanim' => $tema_kullanim.'<br>kişi');


			// yüklü olmayan tema seçimleri için sorgu
			$yanlis_tema .= " temadizinip!='$bilgi' AND";
		}
	}
}


@closedir($dizin);	// dizin kapatılıyor



	//	SUNUCUDA YÜKLÜ TEMALAR SIRALANIYOR - SONU	//



// forum için

if ($kip == 'forum')
{
	//	YÜKLÜ OLMAYAN TEMA KULLANALAR	//

	$yanlis_tema .= " temadizini!=''";

	$vtsorgu = "SELECT id,kullanici_adi FROM $tablo_kullanicilar $yanlis_tema";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if ($vt->num_rows($vtsonuc))
	{
		$profil_degistir = '';

		while ($uye_adi = $vt->fetch_assoc($vtsonuc))
			$profil_degistir .= '<a href="uye_degistir.php?u='.$uye_adi['id'].'">'.$uye_adi['kullanici_adi'].'</a> , ';


		$yanlis_kullananlar = '<p align="left"><u><b>Dikkat:</b></u> &nbsp; Bir temayı kaldırmadan dosyalarını sildiğiniz için alttaki kullanıcılar, sunucunuzda yüklü olmayan bir tema seçmiş görünüyor. Eğer bu kullanıcıların seçimlerini düzeltmezseniz foruma giremezler.
	
		<br><br> İsterseniz kullanıcı adlerını teker teker tıklayarak profillerini değiştirebilir, ya da yukarıdaki temalardan birinin yanındaki
		<br> "- üye seçimlerini değiştir -" bağlantısını tıklayarak bu durumu düzeltebilirsiniz. </p>
	
		<b>Yanlış Tema Seçenler:</b> &nbsp; '.$profil_degistir;
	}

	else $yanlis_kullananlar = '';


	$sayfa_aciklama = '
'.$dizin_tema_bilgi.' dizininde yüklü olan temalar aşağıda sıralanmaktadır. Yeni tema yüklemek için indirdiğiniz temayı klasörüyle beraber '.$dizin_tema_bilgi.' dizine kopyalayın ve aşağıdan - varsayılan tema yap - bağlantısını tıklayın. 
<br><br>
Kullanıcıların yüklediğiniz temalar arasından seçim yapabilmesi için, temanın sol tarafındaki - EKLE - bağlantısı tıklayın. Seçenekler arasından çıkartmak içinse yine aynı yerdeki -KALDIR- bağlantısını tıklayın.
<br><br>
Her temanın sol tarafında görünen Kullanım alanında, o temanın kaç kişi tarafından seçildiğini görebilirsiniz.
<br><br>
Sunucunuzda yüklü olan temaları silmek istediğinizde, bu temayı seçmiş kişilerin hata almaması için önce -KALDIR- bağlantısını tıklayın. Aksi bir durum olduğunda sayfanın en altında bir uyarı belirecektir.
<br><br>
İstediğiniz temanın yanındaki - üye seçimlerini değiştir - bağlantısını tıklayarak, tüm üyelerin seçimlerini bu tema ile değiştirebilirsiniz.';


	$dongusuz = array('{SAYFA_BASLIK}' => $ly['temalar'].$kip_bilgi,
	'{KIP_FORUM}' => $kip_forum,
	'{KIP_PORTAL}' => $kip_portal,
	'{SAYFA_ACIKLAMA}' => $sayfa_aciklama,
	'{SUANKI_TEMA}' => $secili_tema,
	'{YANLIS_KULLANAN}' => $yanlis_kullananlar);
}



// portal için

elseif ($kip == 'portal')
{
	//	YÜKLÜ OLMAYAN TEMA KULLANALAR	//

	$yanlis_tema .= " temadizinip!=''";

	$vtsorgu = "SELECT id,kullanici_adi FROM $tablo_kullanicilar $yanlis_tema";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());


	if ($vt->num_rows($vtsonuc))
	{
		$profil_degistir = '';

		while ($uye_adi = $vt->fetch_assoc($vtsonuc))
			$profil_degistir .= '<a href="uye_degistir.php?u='.$uye_adi['id'].'">'.$uye_adi['kullanici_adi'].'</a> , ';


		$yanlis_kullananlar = '<p align="left"><u><b>Dikkat:</b></u> &nbsp; Bir temayı kaldırmadan dosyalarını sildiğiniz için alttaki kullanıcılar, sunucunuzda yüklü olmayan bir tema seçmiş görünüyor. Eğer bu kullanıcıların seçimlerini düzeltmezseniz foruma giremezler.
	
		<br><br> İsterseniz kullanıcı adlerını teker teker tıklayarak profillerini değiştirebilir, ya da yukarıdaki temalardan birinin yanındaki
		<br> "- üye seçimlerini değiştir -" bağlantısını tıklayarak bu durumu düzeltebilirsiniz. </p>
	
		<b>Yanlış Tema Seçenler:</b> &nbsp; '.$profil_degistir;
	}

	else $yanlis_kullananlar = '';



	$sayfa_aciklama = '
Portal için; &nbsp; '.$dizin_tema_bilgi.' dizininde yüklü olan temalar aşağıda sıralanmaktadır. Yeni tema yüklemek için tek yapmanız gereken temayı klasörüyle beraber bu dizine kopyalamak ve aşağıdan - varsayılan tema yap - bağlantısını tıklamak.
<br><br>
Kullanıcıların yüklediğiniz temalar arasından seçim yapabilmesi için, temanın sol tarafındaki - EKLE - bağlantısı tıklayın. Seçenekler arasından çıkartmak içinse yine aynı yerdeki -KALDIR- bağlantısını tıklayın.
<br><br>
Her temanın sol tarafında görünen Kullanım alanında, o temanın kaç kişi tarafından seçildiğini görebilirsiniz. 
<br><br>
Sunucunuzda yüklü olan temaları silmek istediğinizde, bu temayı seçmiş kişilerin hata almaması için önce -KALDIR- bağlantısını tıklayın. Aksi bir durum olduğunda sayfanın en altında bir uyarı belirecektir.
<br><br>
İstediğiniz temanın yanındaki - üye seçimlerini değiştir - bağlantısını tıklayarak, tüm üyelerin seçimlerini bu tema ile değiştirebilirsiniz.';

}



// tema dosyası yükleniyor
$sayfa_adi = $ly['temalar'].$kip_bilgi;
$tema_sayfa_baslik = $ly['temalar'].$kip_bilgi;
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/forum_temalar.php'));


endif; // Yükleme koşul sonu
?>