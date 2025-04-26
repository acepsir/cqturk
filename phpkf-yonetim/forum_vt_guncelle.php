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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');



if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'guncelle') ):


// Üyeler alınıyor
$vtsorgu2 = "SELECT id, kullanici_adi FROM $tablo_kullanicilar ORDER BY id";
$vtsonuc2 = $vt->query($vtsorgu2) or die ($vt->hata_ver());

while ($uyeler = $vt->fetch_assoc($vtsonuc2))
{
	// Konu sayısı alınıyor
	$vtsorgu = "SELECT id FROM $tablo_mesajlar WHERE yazan='$uyeler[kullanici_adi]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$konu_sayisi = $vt->num_rows($vtsonuc);

	// Cevap sayısı alınıyor
	$vtsorgu = "SELECT id FROM $tablo_cevaplar WHERE cevap_yazan='$uyeler[kullanici_adi]'";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$cevap_sayisi = $vt->num_rows($vtsonuc);

	$toplam = ($konu_sayisi + $cevap_sayisi);

	// Üye mesaj sayısı güncelleniyor
	$vtsorgu = "UPDATE $tablo_kullanicilar SET mesaj_sayisi='$toplam' WHERE id='$uyeler[id]' LIMIT 1";
	$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
}


header('Location: forum_vt_guncelle.php?kip=guncellendi');
exit();





//  SAYFA GÖSTERİMİ  //

else:


if ( (isset($_GET['kip'])) AND ($_GET['kip'] == 'guncellendi') )
{
	$tema_sayfa_icerik = '<center><br><font color="green"><b>'.$ly['yazilar_guncellendi'].'</b></font><br><br></center>';
}
else
{
	$tema_sayfa_icerik = '<center><br>Üye ileti sayılarında hata varsa buradan güncelleyebilirsiniz.
	<br>Forum bölümü silme işlemi sonrasında bu işlemi tekrarlayınız.<br><br><br>
	<form name="guncelle_form" action="forum_vt_guncelle.php" method="get">
	<input type="hidden" name="kip" value="guncelle" />
	<input type="submit" name="submit" value="'.$ly['guncelle'].'" class="dugme dugme-mavi" />
	</form><br><br><br></center>';
}



// tema dosyası yükleniyor
$sayfa_adi = $ly['veritabani_guncelleme'];
$tema_sayfa_baslik = $ly['veritabani_guncelleme'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/varsayilan.php'));


endif;

?>