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


$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
if (!defined('DOSYA_AYAR')) include_once('../phpkf-ayar.php');
if (!defined('DOSYA_YONETIM_GUVENLIK')) include_once('phpkf-bilesenler/guvenlik.php');
if (!defined('DOSYA_KULLANICI_KIMLIK')) include_once('../phpkf-bilesenler/kullanici_kimlik.php');
if (!defined('DOSYA_GERECLER')) include_once('../phpkf-bilesenler/gerecler.php');
if (!defined('DOSYA_SEO')) include_once('../phpkf-bilesenler/seo.php');
if (!defined('DOSYA_TEMA_SINIF')) include_once('../phpkf-bilesenler/sinif_tema.php');


// sil, değiştir ve ip simgeleri
$simge_sil = 'width="22" height="22" border="0" src="../temalar/varsayilan/resimler/sil.png"';
$simge_degistir = 'width="22" height="22" border="0" src="../temalar/varsayilan/resimler/degistir.png"';
$simge_ip = 'width="22" height="22" border="0" src="../temalar/varsayilan/resimler/ip.png"';
$simge_gerial = 'width="22" height="22" border="0" src="../temalar/varsayilan/resimler/gerial.png"';


$dosya_adi = 'forum_konu_silinmis.php';
$dosya_forum_silinmis = 'forum_silinmis.php';


// site kurucusu değilse hata ver
if ($kullanici_kim['id'] != 1)
{
	header('Location: hata.php?hata=151');
	exit();
}


if (isset($_GET['mesaj_no'])) $_GET['k'] = $_GET['mesaj_no'];
if (isset($_GET['k'])) $_GET['k'] = @zkTemizle($_GET['k']);


if (is_numeric($_GET['k']) == false)
{
	header('Location: hata.php?hata=47');
	exit();
}

$zaman_asimi = $ayarlar['uye_cevrimici_sure'];
$tarih = time();



// MESAJ BİLGİLERİ ÇEKİLİYOR
$vtsorgu = "SELECT
id,hangi_forumdan,yazan,mesaj_baslik,mesaj_icerik,tarih,yazan_ip,bbcode_kullan,degistirme_sayisi,degistiren,degistirme_tarihi,degistiren_ip,kilitli,son_mesaj_tarihi,goruntuleme,silinmis,ifade
FROM $tablo_mesajlar WHERE id='$_GET[k]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$mesaj_satir = $vt->fetch_assoc($vtsonuc);


// KONU YOKSA HATA MESAJI, VARSA DEVAM

if ( (empty($mesaj_satir)) OR (empty($_GET['k'])) )
{
	header('Location: hata.php?hata=47');
	exit();
}



// FORUM BİLGİLERİ ÇEKİLİYOR
$vtsorgu = "SELECT forum_baslik,alt_forum FROM $tablo_forumlar WHERE id='$mesaj_satir[hangi_forumdan]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$forum_satir = $vt->fetch_assoc($vtsonuc);



// SAYFA DEĞERLERİ YOKSA SIFIR YAPILIYOR

if (isset($_GET['sayfa'])) $_GET['ks'] = $_GET['sayfa'];
if (isset($_GET['fsayfa'])) $_GET['fs'] = $_GET['fsayfa'];

if (empty($_GET['ks'])) $_GET['ks'] = 0;
else $_GET['ks'] = @zkTemizle($_GET['ks']);
if (is_numeric($_GET['ks']) == false) $_GET['ks'] = 0;

if (empty($_GET['fs'])) $_GET['fs'] = 0;
else $_GET['fs'] = @zkTemizle($_GET['fs']);
if (is_numeric($_GET['fs']) == false) $_GET['fs'] = 0;



// MESAJ SAHİBİNİN PROFİLİ ÇEKİLİYOR
$vtsorgu = "SELECT
id,kullanici_adi,gercek_ad,resim,katilim_tarihi,mesaj_sayisi,sehir_goster,sehir,web,imza,yetki,son_hareket,gizli,engelle,hangi_sayfada,sayfano,ozel_ad 
FROM $tablo_kullanicilar WHERE kullanici_adi='$mesaj_satir[yazan]' LIMIT 1";
$vtsonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
$mesaj_sahibi = $vt->fetch_assoc($vtsonuc);


// CEVAP BİLGİLERİ ÇEKİLİYOR
$vtsorgu = "SELECT
id,cevap_yazan,cevap_baslik,cevap_icerik,tarih,yazan_ip,bbcode_kullan,degistirme_sayisi,degistiren,degistirme_tarihi,degistiren_ip,silinmis,ifade
FROM $tablo_cevaplar WHERE hangi_basliktan='$_GET[k]' ORDER BY tarih LIMIT $_GET[ks],$ayarlar[ksyfkota]";
$cevap = $vt->query($vtsorgu) or die ($vt->hata_ver());


// CEVAPLARIN SATIR SAYISINA BAKILIYOR
$vtsonuc9 = $vt->query("SELECT id FROM $tablo_cevaplar WHERE hangi_basliktan='$_GET[k]'") or die ($vt->hata_ver());
$satir_sayi = $vt->num_rows($vtsonuc9);


// OLUŞTURULACAK SAYFA SAYISI BAĞLANTISI
$toplam_sayfa = ($satir_sayi / $ayarlar['ksyfkota']);
settype($toplam_sayfa,'integer');

if (($satir_sayi % $ayarlar['ksyfkota']) != 0)
$toplam_sayfa++;


// BAŞLIĞIN İLETİ NUMARASI
$ileti_no = $_GET['ks'];










//  SAYFA BAĞLANTILARI OLUŞTURULUYOR BAŞI  //

$sayfalama_cikis = '';

if ($satir_sayi > $ayarlar['ksyfkota']):
$sayfalama_cikis = '<table cellspacing="1" cellpadding="2" border="0" align="right" class="tablo_border">
	<tbody>
	<tr>
	<td class="forum_baslik">
Toplam '.$toplam_sayfa.' Sayfa:&nbsp;
	</td>';


if ($_GET['ks'] != 0)
{
	$sayfalama_cikis .= '<td bgcolor="#ffffff" class="liste-veri" title="ilk sayfaya git">
	&nbsp;<a href="'.$dosya_adi.'?f='.$mesaj_satir['hangi_forumdan'].'&amp;k='.$_GET['k'].'&amp;fs='.$_GET['fs'].'">&laquo;ilk</a>&nbsp;</td>
		
	<td bgcolor="#ffffff" class="liste-veri" title="önceki sayfaya git">
	&nbsp;<a href="'.$dosya_adi.'?f='.$mesaj_satir['hangi_forumdan'].'&amp;k='.$_GET['k'].'&amp;fs='.$_GET['fs'].'&amp;ks='.($_GET['ks'] - $ayarlar['ksyfkota']).'">&lt;</a>&nbsp;</td>';
}

for ($sayi=0,$sayfa_sinir=$_GET['ks']; $sayi < $toplam_sayfa; $sayi++)
{
	if ($sayi < (($_GET['ks'] / $ayarlar['ksyfkota']) - 3));
	else
	{
		$sayfa_sinir++;
		if ($sayfa_sinir >= ($_GET['ks'] + 8)) break;
		if (($sayi == 0) and ($_GET['ks'] == 0))
		{
			$sayfalama_cikis .= '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">
			&nbsp;<b>[1]</b>&nbsp;</td>';
		}
	
		elseif (($sayi + 1) == (($_GET['ks'] / $ayarlar['ksyfkota']) + 1))
		{
			$sayfalama_cikis .= '<td bgcolor="#ffffff" class="liste-veri" title="Şu an bulunduğunuz sayfa">
			&nbsp;<b>['.($sayi + 1).']</b>&nbsp;</td>';
		}
	
		else
		{
			$sayfalama_cikis .= '<td bgcolor="#ffffff" class="liste-veri" title="'.($sayi + 1).' numaralı sayfaya git">

			&nbsp;<a href="'.$dosya_adi.'?f='.$mesaj_satir['hangi_forumdan'].'&amp;k='.$_GET['k'].'&amp;fs='.$_GET['fs'].'&amp;ks='.($sayi * $ayarlar['ksyfkota']).'">'.($sayi + 1).'</a>&nbsp;</td>';
		}
	}
}

if ($_GET['ks'] < ($satir_sayi - $ayarlar['ksyfkota']))
{
	$sayfalama_cikis .= '<td bgcolor="#ffffff" class="liste-veri" title="sonraki sayfaya git">
	&nbsp;<a href="'.$dosya_adi.'?f='.$mesaj_satir['hangi_forumdan'].'&amp;k='.$_GET['k'].'&amp;fs='.$_GET['fs'].'&amp;ks='.($_GET['ks'] + $ayarlar['ksyfkota']).'">&gt;</a>&nbsp;</td>

	<td bgcolor="#ffffff" class="liste-veri" title="son sayfaya git">
	&nbsp;<a href="'.$dosya_adi.'?f='.$mesaj_satir['hangi_forumdan'].'&amp;k='.$_GET['k'].'&amp;fs='.$_GET['fs'].'&amp;ks='.(($toplam_sayfa - 1) * $ayarlar['ksyfkota']).'">son&raquo;</a>&nbsp;</td>';
}

$sayfalama_cikis .= '</tr></tbody></table>';
endif;




//  SAYFA BAĞLANTILARI OLUŞTURULUYOR - SONU  //

//  BAŞLIK TABLOSU - BAŞI  //




if ($_GET['ks'] < 1 ):


if ($mesaj_sahibi['engelle'] != 1) $konu_acan = '<a href="../profil.php?u='.$mesaj_sahibi['id'].'">'.$mesaj_satir['yazan'].'</a>';

else $konu_acan = '<a href="../profil.php?u='.$mesaj_satir['id'].'"><s>'.$mesaj_satir['yazan'].'</s></a>';


if (!empty($mesaj_sahibi['gercek_ad']))
	$konu_acan_adi = $mesaj_sahibi['gercek_ad'];
else $konu_acan_adi = '';


if (!empty($mesaj_sahibi['ozel_ad']))
	$konu_acan_yetkisi = '<font class="ozel_ad"><u>'.$mesaj_sahibi['ozel_ad'].'</u></font>';

elseif ($mesaj_sahibi['id'] == 1) 
	$konu_acan_yetkisi = '<font class="kurucu"><u>'.$ayarlar['kurucu'].'</u></font>';

elseif ($mesaj_sahibi['yetki'] == 1)
	$konu_acan_yetkisi = '<font class="yonetici"><u>'.$ayarlar['yonetici'].'</u></font>';
	
elseif ($mesaj_sahibi['yetki'] == 2)
	$konu_acan_yetkisi = '<font class="yardimci"><u>'.$ayarlar['yardimci'].'</u></font>';

else $konu_acan_yetkisi = '<font class="kullanici">'.$ayarlar['kullanici'].'</font>';


if ($mesaj_sahibi['resim'] != '')
{
	if (preg_match('/^(\/|http:|https:|ftp:)/i', $mesaj_sahibi['resim']))
		$konu_acan_resmi = '<img src="'.$mesaj_sahibi['resim'].'" alt="Kullanıcı Resmi" style="max-width:98%" />';

	else $konu_acan_resmi = '<img src="../'.$mesaj_sahibi['resim'].'" alt="Kullanıcı Resmi" style="max-width:98%" />';
}

elseif ($ayarlar['v-uye_resmi'] != '')
{
	if (preg_match('/^(\/|http:|https:|ftp:)/i', $ayarlar['v-uye_resmi']))
		$konu_acan_resmi = '<img src="'.$ayarlar['v-uye_resmi'].'" alt="Varsayılan Kullanıcı Resmi" style="max-width:98%" />';

	else $konu_acan_resmi = '<img src="../'.$ayarlar['v-uye_resmi'].'" alt="Varsayılan Kullanıcı Resmi" style="max-width:98%" />';
}

else $konu_acan_resmi = '';


if (!empty($mesaj_sahibi['katilim_tarihi']))
	$konu_acan_kayit = zaman('d.m.Y', $ayarlar['saat_dilimi'], false, $mesaj_sahibi['katilim_tarihi'], $ayarlar['tarih'], true);

else $konu_acan_kayit = '';


if (!empty($mesaj_sahibi['mesaj_sayisi']))
	$konu_acan_mesajsayi = $mesaj_sahibi['mesaj_sayisi'];

	else $konu_acan_mesajsayi = '';


if ($mesaj_sahibi['sehir_goster'] == 1)
	$konu_acan_sehir = $mesaj_sahibi['sehir'];

else $konu_acan_sehir = 'Gizli';


if (empty($mesaj_sahibi['gercek_ad']))
	$konu_acan_durum = '<font color="#FF0000">üye silinmiş</font>';

elseif ($mesaj_sahibi['engelle'] == 1)
	$konu_acan_durum = '<font color="#FF0000">üye uzaklaştırılmış</font>';

elseif ($mesaj_sahibi['gizli'] == 1)
	$konu_acan_durum = '<font color="#FF0000">Gizli</font>';

elseif ( (($mesaj_sahibi['son_hareket'] + $zaman_asimi) > $tarih ) AND
		($mesaj_sahibi['sayfano'] != '-1') )
	$konu_acan_durum = '<font color="#339900">Forumda</font>';

else $konu_acan_durum = '<font color="#FF0000">Forumda Değil</font>';


$konu_acan_eposta = '<a title="Forum üzerinden e-posta gönder" href="../eposta.php?kim='.$mesaj_sahibi['kullanici_adi'].'">E-Posta Gönder</a>';

if ($mesaj_sahibi['web'])
	$konu_acan_web = '<br><a target="_blank" href="'.$mesaj_sahibi['web'].'">Web Adresi</a>';

else $konu_acan_web = '';

$konu_acan_ozel = '<a href="../oi_yaz.php?ozel_kime='.$mesaj_sahibi['kullanici_adi'].'">Özel ileti Gönder</a>';

$konu_tarihi = zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $mesaj_satir['tarih'], $ayarlar['tarih'], true);



// SİL VE GERİ YÜKLE OLUŞTURULUYOR

$konu_alinti_duzenle = '';

// silinmiş iletiyi kurtarma
if ($mesaj_satir['silinmis'] == 1)
$konu_alinti_duzenle .= '<a href="'.$dosya_forum_silinmis.'?kurtark='.$mesaj_satir['id'].'&amp;yo='.$yo.'"><img '.$simge_gerial.' alt="Bu konuyu cevaplarıyla beraber geri yükle" title="Bu konuyu cevaplarıyla beraber geri yükle"></a>&nbsp;&nbsp;';

$konu_alinti_duzenle .= '<a href="'.$dosya_forum_silinmis.'?silk='.$mesaj_satir['id'].'&amp;yo='.$yo.'"><img '.$simge_sil.' alt="Bu konuyu ve cevaplarını kalıcı olarak sil" title="Bu konuyu ve cevaplarını kalıcı olarak sil" onclick="return window.confirm(\'Bu konuyu ve cevaplarını kalıcı olarak silmek istediğinize emin misiniz?\')"></a>&nbsp;&nbsp;';

$konu_alinti_duzenle .= '<a href="forum_ip_yonetimi.php?kip=1&amp;ip='.$mesaj_satir['yazan_ip'].'"><img '.$simge_ip.' alt="Bu konuyu açanın ip adresi" title="Bu konuyu açanın ip adresi"></a>&nbsp;&nbsp;';



// BAŞLIK İÇERİĞİ YAZDIRILIYOR
// VARSA İMZA VE DEĞİŞTİRME BİLGİLERİ YAZDIRILIYOR


if ($mesaj_satir['ifade'] == 1)
	$mesaj_satir['mesaj_icerik'] = ifadeler($mesaj_satir['mesaj_icerik']);

if ( ($mesaj_satir['bbcode_kullan'] == 1) AND ($ayarlar['bbcode'] == 1) )
	$konu_icerik = bbcode_acik($mesaj_satir['mesaj_icerik'],$mesaj_satir['id']);

else $konu_icerik = bbcode_kapali($mesaj_satir['mesaj_icerik']);


$konu_acan_imza = '';

if ( (isset($mesaj_sahibi['imza'])) AND ($mesaj_sahibi['imza'] != '') )
{
	if ($ayarlar['bbcode'] == 1) $konu_acan_imza .= bbcode_acik(ifadeler($mesaj_sahibi['imza']),0);
	else $konu_acan_imza .= bbcode_kapali(ifadeler($mesaj_sahibi['imza']));
}



// İLETİ DEĞİŞTİRİLME BİLGİLERİ //

$konu_degisme = '';

if ($mesaj_satir['degistirme_sayisi'] != 0):
	$konu_degisme .= '<hr class="ileti_degisim_bilgi" /><font size="1"><i> Bu ileti en son <b>'.$mesaj_satir['degistiren'].'</b>
tarafından <b>'.zaman($ayarlar['tarih_bicimi'], $ayarlar['saat_dilimi'], false, $mesaj_satir['degistirme_tarihi'], $ayarlar['tarih'], true).'</b> tarihinde, toplamda '.$mesaj_satir['degistirme_sayisi'].' kez değiştirilmiştir.</i></font>&nbsp;<a href="forum_ip_yonetimi.php?kip=1&amp;ip='.$mesaj_satir['degistiren_ip'].'"><img '.$simge_ip.' alt="Bu konuyu değiştirenin ip adresi" title="Bu konuyu değiştirenin ip adresi"></a>';
endif;

endif;

//  BAŞLIK TABLOSU - SONU  //





// link ağacı
$forum_anasayfa = '<span><a href="../'.$phpkf_dosyalar['forum'].'">Forum Ana Sayfası</a></span>';
$konu_baslik = '<span>'.$mesaj_satir['mesaj_baslik'].'</span>';

if ($forum_satir['alt_forum'] != '0')
{
	$alt_forum_baslik = '<span><a href="../forum.php?f='.$mesaj_satir['hangi_forumdan'].'&amp;fs='.$_GET['fs'].'">'.$forum_satir['forum_baslik'].'</a></span>';

	$vtsorgu = "SELECT id,forum_baslik FROM $tablo_forumlar WHERE id='$forum_satir[alt_forum]' LIMIT 1";
	$vtsonuc2 = $vt->query($vtsorgu) or die ($vt->hata_ver());
	$forum_satir = $vt->fetch_assoc($vtsonuc2);

	$ust_forum_baslik = '<span><a href="../forum.php?f='.$forum_satir['id'].'">'.$forum_satir['forum_baslik'].'</a></span>';
}

else
{
	$ust_forum_baslik = '<span><a href="../forum.php?f='.$mesaj_satir['hangi_forumdan'].'&amp;fs='.$_GET['fs'].'">'.$forum_satir['forum_baslik'].'</a></span>';
	$alt_forum_baslik = '';
}


$forum_anasayfa = '<a href="../'.$phpkf_dosyalar['forum'].'">Forum Ana Sayfası</a>';




// tema dosyası yükleniyor
$sayfa_adi = 'Silinen İletiler - '.$forum_satir['forum_baslik'].' - '.$mesaj_satir['mesaj_baslik'];
$tema_sayfa_baslik = 'Silinen İletiler - '.$forum_satir['forum_baslik'].' - '.$mesaj_satir['mesaj_baslik'];
eval(phpkf_tema_yukle('phpkf-bilesenler/temalar/'.$temadizini_cms.'/forum_konu_silinmis.php'));

?>