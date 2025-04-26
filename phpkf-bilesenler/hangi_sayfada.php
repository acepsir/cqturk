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


if (!defined('PHPKF_ICINDEN')) exit();

function HangiSayfada($sayfano, $baslik)
{
	global $ayarlar, $kullanici_kim, $l, $tum_kategoriler, $cms_dizin, $forum_dizin, $phpkf_dosyalar;

	switch ($sayfano)
	{
		case -1;
		$sayfa = $l['cikis_yapti'];
		break;

		case 0;
		$sayfa = $baslik;
		break;



		// Forum Sayfaları
		case 1;
		$sayfa = '<a href="'.$forum_dizin.$phpkf_dosyalar['forum'].'">'.$l['forum'].' '.$l['anasayfa'].'</a>';
		break;

		case 2;
		$konuno = explode(',', $sayfano);
		$konu = explode(' : ', $baslik);
		$sayfa = $l['forum_konu'].': <a href="'.$forum_dizin.linkver('konu.php?k='.$konuno[1], $konu[0]).'">'.$baslik.'</a>';
		break;

		case 3;
		$forumno = explode(',', $sayfano);
		$forum = explode(' : ', $baslik);
		$sayfa = $l['forum'].': <a href="'.$forum_dizin.linkver('forum.php?f='.$forumno[1], $forum[0]).'">'.$baslik.'</a>';
		break;

		case 4;
		$uyeno = explode(',', $sayfano);
		$uyeadi = explode(': ', $baslik);
		if (isset($uyeadi[1])) $sayfa = $l['profil_goruntule'].': <a href="'.linkver($phpkf_dosyalar['profil'].'?u='.$uyeno[1].'&kim='.$uyeadi[1], $uyeadi[1]).'">'.$uyeadi[1].'</a>';
		else $sayfa = '<a href="'.$phpkf_dosyalar['profil'].'?u='.$uyeno[1].'">'.$l['profilim'].'</a>';
		break;

		case 5;
		$sayfa = '<a href="'.$phpkf_dosyalar['cevrimici'].'">'.$l['cevrimici'].$l['sayfasi'].'</a>';
		break;

		case 6;
		$sayfa = '<a href="'.$forum_dizin.$phpkf_dosyalar['yardim'].'">'.$l['yardim'].$l['sayfasi'].'</a>';
		break;

		case 7;
		$sayfa = '<a href="'.$phpkf_dosyalar['uyeler'].'">'.$l['uyeler'].$l['sayfasi'].'</a>';
		break;

		case 8;
		$sayfa = '<a href="'.$phpkf_dosyalar['giris'].'">'.$l['kullanici_giris'].'</a>';
		break;

		case 9;
		$sayfa = '<a href="'.$phpkf_dosyalar['kayit'].'">'.$l['kayit'].$l['sayfasi'].'</a>';
		break;

		case 10;
		$sayfa = '<a href="'.$forum_dizin.$phpkf_dosyalar['arama'].'">'.$l['arama'].$l['sayfasi'].'</a>';
		break;

		case 11;
		$konuno = explode(',', $sayfano);
		$sayfa = $l['baslik_tasima'].': <a href="'.$forum_dizin.linkver('konu.php?k='.$konuno[1], $baslik).'">'.$baslik.'</a>';
		break;

		case 12;
		$uyeno = explode(': ', $baslik);
		$sayfa = $l['eposta_gonderme'].': <a href="'.linkver($phpkf_dosyalar['profil'].'?kim='.$uyeno[1], $uyeno[1]).'">'.$uyeno[1].'</a>';
		break;

		case 13;
		$konuno = explode(',', $sayfano);
		$baslik = explode(': ', $baslik);
		$sayfa = $l['konu_degitirme_onizleme'].': <a href="'.$forum_dizin.linkver('konu.php?k='.$konuno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 14;
		$konuno = explode(',', $sayfano);
		$baslik = explode(': ', $baslik);
		$sayfa = $l['cevap_degistirme_onizleme'].': <a href="'.$forum_dizin.linkver('konu.php?k='.$konuno[1], $baslik[1]).'#c'.$konuno[2].'">'.$baslik[1].'</a>';
		break;

		case 15;
		$konuno = explode(',', $sayfano);
		$baslik = explode(': ', $baslik);
		$sayfa = $l['konu_degitirme'].': <a href="'.$forum_dizin.linkver('konu.php?k='.$konuno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 16;
		$konuno = explode(',', $sayfano);
		$baslik = explode(': ', $baslik);
		$sayfa = $l['cevap_degistirme'].': <a href="'.$forum_dizin.linkver('konu.php?k='.$konuno[1], $baslik[1]).'#c'.$konuno[2].'">'.$baslik[1].'</a>';
		break;

		case 17;
		$konuno = explode(',', $sayfano);
		$baslik = explode(': ', $baslik);
		$sayfa = $l['cevap_yazma_onizleme'].': <a href="'.$forum_dizin.linkver('konu.php?k='.$konuno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 18;
		$forumno = explode(',', $sayfano);
		$baslik = explode(': ', $baslik);
		$sayfa = $l['konu_yazma_onizleme'].': <a href="'.$forum_dizin.linkver('forum.php?f='.$forumno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 19;
		$konuno = explode(',', $sayfano);
		$baslik = explode(': ', $baslik);
		$sayfa = $l['cevap_yazma'].': <a href="'.$forum_dizin.linkver('konu.php?k='.$konuno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 20;
		$forumno = explode(',', $sayfano);
		$baslik = explode(': ', $baslik);
		$sayfa = $l['konu_yazma'].': <a href="'.$forum_dizin.linkver('forum.php?f='.$forumno[1], $baslik[1]).'">'.$baslik[1].'</a>';
		break;

		case 21;
		$sayfa = $l['oi_okuma'];
		break;

		case 22;
		$sayfa = $l['oi_onizleme'];
		break;

		case 23;
		$sayfa = $l['oi_yazma'];
		break;

		case 24;
		$sayfa = $l['oi_ayarlar'];
		break;

		case 25;
		$sayfa = $l['ozel_ileti'].' '.$l['kutu_ulasan'];
		break;

		case 26;
		$sayfa = $l['ozel_ileti'].' '.$l['kutu_gonderilen'];
		break;

		case 27;
		$sayfa = $l['ozel_ileti'].' '.$l['kutu_kaydedilen'];
		break;

		case 28;
		$sayfa = $l['ozel_ileti'].' '.$l['kutu_gelen'];
		break;

		case 29;
		$sayfa = $l['sifre_degistir'];
		break;

		case 30;
		$sayfa = $l['profil_degistir'];
		break;

		case 31;
		$sayfa = '<a href="'.$forum_dizin.$phpkf_dosyalar['rss'].'">'.$l['rss_beslemesi'].'</a>';
		break;

		case 32;
		$forumno = explode(',', $sayfano);
		$baslik = explode(': ', $baslik);
		$sayfa = $l['rss_beslemesi'].': <a href="'.$forum_dizin.$phpkf_dosyalar['rss'].'?f='.$forumno[1].'">'.$baslik[1].'</a>';
		break;

		case 33;
		$sayfa = '<a href="'.$phpkf_dosyalar['giris'].'?kip=yeni_sifre">'.$l['yeni_sifre'].'</a>';
		break;

		case 34;
		$sayfa = '<a href="'.$forum_dizin.'ymesaj.php">'.$l['okunmamis_iletiler'].'</a>';
		break;

		case 35;
		$sayfa = '<a href="'.$phpkf_dosyalar['giris'].'?kip=etkinlestir">'.$l['etkinlestirme_kodu'].'</a>';
		break;

		case 36;
		$sayfa = '<a href="'.$phpkf_dosyalar['profil'].'?kip=pgaleri">'.$l['resim_galerisi'].'</a>';
		break;

		case 37;
		$uyeno = explode(': ', $baslik);
		$sayfa = $l['uye_konu_arama'].': <a href="'.linkver($phpkf_dosyalar['profil'].'?kim='.$uyeno[1], $uyeno[1]).'">'.$uyeno[1].'</a>';
		break;

		case 38;
		$uyeno = explode(': ', $baslik);
		$sayfa = $l['uye_cevap_arama'].': <a href="'.linkver($phpkf_dosyalar['profil'].'?kim='.$uyeno[1], $uyeno[1]).'">'.$uyeno[1].'</a>';
		break;

		case 39;
		if ($kullanici_kim['yetki'] != 1) $sayfa = $l['hata_sayfasi'];
		else $sayfa = $l['hata_sayfasi'].': '.$baslik;
		break;

		case 40;
		$sayfa = $l['yuklemeler'];
		break;

		case 41;
		$sayfa = $l['mobil'].': <a href="'.$forum_dizin.$phpkf_dosyalar['mobil'].'">'.$baslik.'</a>';
		break;

		case 42;
		$sayfa = '<a href="'.$forum_dizin.$phpkf_dosyalar['uyeler'].'?kip=grup">'.$l['yetki_grup_sayfasi'].'</a>';
		break;

		case 43;
		$sayfa = $l['bildirimler'];
		break;

		case 44;
		$tarayici = explode(',', $sayfano);
		if (!isset($tarayici[1])) $tarayici[1] = 0;
		if ($tarayici[1] == 1) $sayfa = '<a target="_blank" href="https://addons.mozilla.org/tr/firefox/addon/phpkf/"><font color="#ff0000">'.$l['phpkf_firefox'].'</font></a>';
		elseif ($tarayici[1] == 2) $sayfa = '<a target="_blank" href="https://chrome.google.com/webstore/detail/phpkf/iafmbjiobknabkmoodgmodpkoefgcgbk?hl=tr"><font color="#ff0000">'.$l['phpkf_chrome'].'</font></a>';
		else $sayfa = '<a target="_blank" href="https://play.google.com/store/apps/details?id=com.phpkf.mobil"><font color="#ff0000">'.$l['phpkf_android'].'</font></a>';
		break;

		case 45;
		$sayfa = $l['takip_edilenler'];
		break;

		case 46;
		$sayfa = $l['dosya_yukleme'];
		break;

		case 47;
		$forumno = explode(',', $sayfano);
		$sayfa = 'Mobil Konu: <a href="'.$forum_dizin.$phpkf_dosyalar['mobil'].'?ak='.$forumno[1].'">'.$baslik.'</a>';
		break;

		case 48;
		$forumno = explode(',', $sayfano);
		$sayfa = 'Mobil Forum: <a href="'.$forum_dizin.$phpkf_dosyalar['mobil'].'?af='.$forumno[1].'">'.$baslik.'</a>';
		break;

		case 50;
		if ($kullanici_kim['yetki'] != 1) $sayfa = $l['yonetim_sayfalari'];
		else $sayfa = $l['yonetim'].': '.$baslik;
		break;





		// CMS Sayfaları
		case 100;
		$sayfa = '<a href="'.$phpkf_dosyalar['cms'].'">'.$l['anasayfa'].'</a>';
		break;

		case 101;
		$id = explode(',', $sayfano);
		$sayfa = $l['yazi'].': <a href="'.$phpkf_dosyalar['cms'].'?y='.$id[1].'">'.$baslik.'</a>';
		break;

		case 102;
		$id = explode(',', $sayfano);
		$sayfa = $l['galeri'].': <a href="'.$phpkf_dosyalar['cms'].'?y='.$id[1].'">'.$baslik.'</a>';
		break;

		case 103;
		$id = explode(',', $sayfano);
		$sayfa = $l['video'].': <a href="'.$phpkf_dosyalar['cms'].'?y='.$id[1].'">'.$baslik.'</a>';
		break;

		case 104;
		$sayfa = '<a href="'.linkyap($phpkf_dosyalar['cms'].'?kip=sayfa', $ayarlar['dizin_sayfa']).'">'.$l['sayfalar'].'</a>';
		break;

		case 105;
		$sayfa = '<a href="'.linkyap($phpkf_dosyalar['cms'].'?kip=kat', $ayarlar['dizin_kat']).'">'.$l['kategoriler'].'</a>';
		break;

		case 106;
		$sayfa = '<a href="'.linkyap($phpkf_dosyalar['cms'].'?kip=galeri', $ayarlar['dizin_galeri']).'">'.$l['galeriler'].'</a>';
		break;

		case 107;
		$sayfa = '<a href="'.linkyap($phpkf_dosyalar['cms'].'?kip=video', $ayarlar['dizin_video']).'">'.$l['videolar'].'</a>';
		break;

		case 108;
		$katid = explode(',', $sayfano);
		$sayfa = $l['yazi_kategori'].': <a href="'.$phpkf_dosyalar['cms'].'?kip=kat&k='.$katid[1].'">'.$baslik.'</a>';
		break;

		case 109;
		$katid = explode(',', $sayfano);
		$sayfa = $l['galeri_kategori'].': <a href="'.$phpkf_dosyalar['cms'].'?kip=kat&k='.$katid[1].'">'.$baslik.'</a>';
		break;

		case 110;
		$katid = explode(',', $sayfano);
		$sayfa = $l['Video_kategori'].': <a href="'.$phpkf_dosyalar['cms'].'?kip=kat&k='.$katid[1].'">'.$baslik.'</a>';
		break;

		case 111;
		$sayfa = '<a href="'.linkyap($phpkf_dosyalar['cms'].'?kip=iletisim', 'iletisim.html').'">'.$l['iletisim'].'</a>';
		break;

		case 112;
		$sozcuk = explode(': ', $baslik);
		if (!isset($sozcuk[1])) $sozcuk[1] = '--';
		$sayfa = $l['etiket'].': <a href="'.linkyap($phpkf_dosyalar['cms'].'?etiket='.urlencode($sozcuk[1])).'">'.$sozcuk[1].'</a>';
		break;

		case 113;
		$sozcuk = explode(': ', $baslik);
		if (!isset($sozcuk[1])) $sozcuk[1] = '--';
		$sayfa = $l['arama'].': <a href="'.linkyap($phpkf_dosyalar['cms'].'?arama='.urlencode($sozcuk[1])).'">'.$sozcuk[1].'</a>';
		break;

		case 114;
		$sayfa = '<a href="'.linkyap($phpkf_dosyalar['cms'].'?kip=etiket', $ayarlar['dizin_etiket']).'">'.$l['etiket'].$l['sayfasi'].'</a>';
		break;

		case 115;
		$sayfa = '<a href="'.linkyap($phpkf_dosyalar['cms'].'?kip=arama', $ayarlar['dizin_arama']).'">'.$l['arama'].$l['sayfasi'].'</a>';
		break;

		case 116;
		$sayfa = '404 - '.$l['404'];
		break;

		case 150;
		if ($kullanici_kim['yetki'] != 1) $sayfa = $l['yonetim_sayfalari'];
		else $sayfa = $l['yonetim'].': '.$baslik;
		break;





		// Portal sayfaları
		case 200;
		$sayfa = $l['portal'].': '.$baslik;
		break;

		case 201;
		$sayfa = '<a href="'.$forum_dizin.$phpkf_dosyalar['portal'].'">'.$l['portal'].' '.$l['anasayfa'].'</a>';
		break;

		case 250;
		if ($kullanici_kim['yetki'] != 1) $sayfa = $l['yonetim_sayfalari'];
		else $sayfa = $l['yonetim'].': '.$baslik;
		break;



		default:
		$sayfa = $baslik;
	}
	return $sayfa;
}

?>