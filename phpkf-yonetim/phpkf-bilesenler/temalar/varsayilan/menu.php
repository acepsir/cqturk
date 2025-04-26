<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();


// CMS-Forum ek
if (($cms_kullan == 1) AND ($forum_kullan == 1))
{
	$tym_cms = ' ('.$ly['cms'].')';
	$tym_forum = ' ('.$ly['forum'].')';
}
else
{
	$tym_cms = '';
	$tym_forum = '';
}


// Temaya özel linkler ekleniyor - BAŞI //

@include_once('../phpkf-bilesenler/temalar/'.$temadizini_cms.'/tema_ozellik.php');
$yicerik_menu = '';

if ((isset($tema_ozellik_yonetim_menu)) AND (is_array($tema_ozellik_yonetim_menu)))
{
	foreach ($tema_ozellik_yonetim_menu as $yonetim_menu_tek)
	{
		if ($yonetim_menu_tek == '') continue;
		$yicerik_menu .= '<li>'.$yonetim_menu_tek.'</li>';
	}
	unset($yonetim_menu_dizi);
	unset($yonetim_menu_tek);
}
else
{
$yicerik_menu .= '
<li><a href="kategoriler.php">'.$lymenu['kategoriler'].'</a></li>
<li><a href="yazilar.php">'.$lymenu['icerikler'].'</a></li>
<li><a href="yazi_ekle.php?ktip=0">'.$lymenu['yazi_ekle'].'</a></li>
<li><a href="yazi_ekle.php?ktip=1">'.$lymenu['galeri_ekle'].'</a></li>
<li><a href="yazi_ekle.php?ktip=2">'.$lymenu['video_ekle'].'</a></li>
';
}

// Temaya özel linkler ekleniyor - SONU //



// Özel yönetim menü oluşturuluyor - BAŞI //

$ozel_yonetim_menu = '';

if ($ayarlar['yonetim_menu'] != '')
{
	$yonetim_menu_dizi = explode("\n", $ayarlar['yonetim_menu']);

	if (is_array($yonetim_menu_dizi))
	{
		foreach ($yonetim_menu_dizi as $yonetim_menu_tek)
		{
			if ($yonetim_menu_tek == '') continue;

			$a = explode("::", $yonetim_menu_tek);
			$linkler = explode(";;", $a[1]);

			$ozel_yonetim_menu .= "\r\n".'<div><div class="kutu-baslik ara-baslik">'.$a[0].'<i class="i">-</i></div>
			<div class="kutu-icerik yonetim-menu goster">
			<ul class="kutu-liste">';

			foreach ($linkler as $link)
			{
				if ($link == '') continue;
				$b = explode("||", $link);
				$ozel_yonetim_menu .= '<li><a href="ozel_sayfa.php?s='.$b[1].'">'.$b[0].'</a></li>'."\r\n";
			}

			$ozel_yonetim_menu .= '</ul></div></div>';
		}
	}
}

// Özel yönetim menü oluşturuluyor - SONU //





$TEMA_YONETIM_MENU = '
<!-- Sol bloklar baş -->
<div class="phpkf-blok-gizle sol-goster" onclick="BlokGizle(1)">&raquo;</div>
<div class="sol-blok">
<div class="phpkf-blok-gizle sol-gizle" onclick="BlokGizle(1)">&raquo;</div>
<div class="phpkf-blok-kutusu" id="yonetimMenu">

<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['yonetim_menu'].'<i class="i" style="display:none">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="index.php">'.$lymenu['anasayfa'].'</a></li>
<li><a href="baglantilar.php">'.$lymenu['baglantilar'].'</a></li>';
if ($ayarlar['cms_kullan'] == 1) $TEMA_YONETIM_MENU .= '<li><a href="bloklar.php">'.$lymenu['bloklar'].'</a></li>';
$TEMA_YONETIM_MENU .= '<li><a href="yuklemeler.php">'.$lymenu['yuklemeler'].'</a></li>';
if ($ayarlar['forum_kullan'] == 1) $TEMA_YONETIM_MENU .= '<li><a href="forum_yuklemeler.php">'.$ly['forum'].' '.$lymenu['yuklemeler'].'</a></li>
<li><a href="forum_duyurular.php">'.$lymenu['duyurular'].'</a></li>';
$TEMA_YONETIM_MENU .= '</ul>
</div>
</div>



<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['ayarlar'].'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="ayarlar.php">'.$lymenu['genel'].'</a></li>
<li><a href="ayarlar.php?kip=entegrasyon">'.$lymenu['entegrasyon'].'</a></li>';
if ($ayarlar['forum_kullan'] == 1) $TEMA_YONETIM_MENU .= '<li><a href="ayarlar.php?kip=forum">'.$lymenu['forum'].'</a></li>';
$TEMA_YONETIM_MENU .= '<li><a href="ayarlar.php?kip=seo">'.$lymenu['seo'].'</a></li>
<li><a href="ayarlar.php?kip=tarih">'.$lymenu['tarih'].'</a></li>
<li><a href="ayarlar.php?kip=uyelik">'.$lymenu['uyelik'].'</a></li>
<li><a href="ayarlar.php?kip=eposta">'.$lymenu['eposta'].'</a></li>
<li><a href="ayarlar.php?kip=yukleme">'.$lymenu['yukleme'].'</a></li>
<li><a href="ayarlar.php?kip=duzenleyici">'.$lymenu['duzenleyici'].'</a></li>
<li><a href="ayarlar.php?kip=phpkf">'.$lymenu['phpkf_duzenleyici'].'</a></li>
<li><a href="ayarlar.php?kip=tinymce">'.$lymenu['tinymce_duzenleyici'].'</a></li>';


if ($ayarlar['forum_kullan'] == 1) $TEMA_YONETIM_MENU .= '<li><a href="ayarlar.php?kip=ozel_ileti">'.$lymenu['ozel_ileti'].'</a></li>';

if ($ayarlar['cms_kullan'] == 1) $TEMA_YONETIM_MENU .= '<li><a href="ayar_alan.php">'.$lymenu['icerik_alanlari'].'</a></li>
<li><a href="ayar_dil.php">'.$lymenu['dil_ekle'].'</a></li>';

$TEMA_YONETIM_MENU .= '</ul>
</div>
</div>';




if ($ayarlar['cms_kullan'] == 1)
$TEMA_YONETIM_MENU .= '
<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['icerikler'].'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
'.$yicerik_menu.'
</ul>
</div>
</div>';




if ($ayarlar['forum_kullan'] == 1)
$TEMA_YONETIM_MENU .= '<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['forum_yonetim'].'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="forumlar.php">'.$lymenu['forum_duzenle'].'</a></li>
<li><a href="forum_izinleri.php">'.$lymenu['forum_izinleri'].'</a></li>
<li><a href="forum_temizle.php">'.$lymenu['forum_temizle'].'</a></li>
<li><a href="forum_silinmis.php">'.$lymenu['silinen_iletiler'].'</a></li>
</ul>
</div>
</div>';




$TEMA_YONETIM_MENU .= '<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['uyelik'].'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="uyeler.php">'.$lymenu['uyeler'].'</a></li>
<li><a href="yeni_uye.php">'.$lymenu['yeni_uye_ekle'].'</a></li>';

if ($ayarlar['forum_kullan'] == 1) $TEMA_YONETIM_MENU .= '
<li><a href="ozel_izinler.php">'.$lymenu['ozel_izinler'].'</a></li>
<li><a href="forum_ip_yonetimi.php">'.$lymenu['ip_yonetimi'].'</a></li>
<li><a href="oi_sil.php">'.$lymenu['ozel_ileti_temizle'].'</a></li>';

$TEMA_YONETIM_MENU .= '<li><a href="yasaklamalar.php">'.$lymenu['yasaklamalar'].'</a></li>
<li><a href="toplu_posta.php">'.$lymenu['toplu_eposta'].'</a></li>';

if ($ayarlar['cms_kullan'] == 1) $TEMA_YONETIM_MENU .= '<li><a href="yorumlar.php">'.$lymenu['yorumlar'].'</a></li>';

$TEMA_YONETIM_MENU .= '<li><a href="../'.$phpkf_dosyalar['cevrimici'].'">'.$lymenu['cevrimici_ziyaretciler'].'</a></li>
</ul>
</div>
</div>';



if ($ayarlar['cms_kullan'] == 1) $TEMA_YONETIM_MENU .= '<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['gorunum'].$tym_cms.'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="temalar.php">'.$lymenu['temalar'].'</a></li>
<li><a href="temalar.php?kip=yukle">'.$lymenu['tema_yukle'].'</a></li>
<li><a href="tasarim.php">'.$lymenu['tema_renkleri'].'</a></li>
<li><a href="ayarlar.php?kip=tema">'.$lymenu['tema_ayarlari'].'</a></li>
</ul>
</div>
</div>';




if ($ayarlar['forum_kullan'] == 1)
{
$TEMA_YONETIM_MENU .= '<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['gorunum'].$tym_forum.'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="forum_temalar.php">'.$lymenu['temalar'].'</a></li>';
if ($ayarlar['portal_kullan'] == 1) $TEMA_YONETIM_MENU .= '<li><a href="forum_temalar.php?kip=portal">'.$lymenu['temalar'].' ('.$ly['portal'].')</a></li>';
$TEMA_YONETIM_MENU .= '<li><a href="forum_temalar.php?kip=yukle">'.$lymenu['tema_yukle'].'</a></li>
<li><a href="ayarlar.php?kip=tema&amp;sistem=forum">'.$lymenu['tema_ayarlari'].'</a></li>
</ul>
</div>
</div>';
}







if ($ayarlar['cms_kullan'] == 1)
$TEMA_YONETIM_MENU .= '<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['eklenti'].$tym_cms.'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="eklentiler.php">'.$lymenu['eklentiler'].'</a></li>
<li><a href="eklentiler.php?kip=tema">'.$lymenu['tema_eklentileri'].'</a></li>
<li><a href="eklentiler.php?kip=yukle">'.$lymenu['eklenti_yukle'].'</a></li>
<li><a href="ayarlar.php?kip=eklenti">'.$lymenu['eklenti_ayarlari'].'</a></li>
</ul>
</div>
</div>';




if ($ayarlar['forum_kullan'] == 1)
$TEMA_YONETIM_MENU .= '<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['eklenti'].$tym_forum.'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="forum_eklentiler.php">'.$lymenu['eklentiler'].'</a></li>
<li><a href="forum_eklentiler.php?kip=yukle">'.$lymenu['eklenti_yukle'].'</a></li>
<li><a href="forum_eklentiler.php?kip=ayarlar">'.$lymenu['eklenti_ayarlari'].'</a></li>
</ul>
</div>
</div>




<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['gruplar'].$tym_forum.'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="uye_gruplar.php">'.$lymenu['uye_gruplari'].'</a></li>
<li><a href="forum_uye_izinleri.php">'.$lymenu['uye_ve_grup_izinleri'].'</a></li>
<li><a href="ozel_izinler.php">'.$lymenu['grup_izinleri'].'</a></li>
</ul>
</div>
</div>';




$TEMA_YONETIM_MENU .= '<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['veritabani'].'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="vt_yedek.php">'.$lymenu['yedekleme'].'</a></li>
<li><a href="vt_yukle.php">'.$lymenu['geri_yukle'].'</a></li>
<li><a href="vt_yonetim.php">'.$lymenu['veritabani_yonetimi'].'</a></li>
<li><a href="show_status.php">'.$lymenu['mysql_sunucu_bilgisi'].'</a></li>
</ul>
</div>
</div>



<div>
<div class="kutu-baslik ara-baslik">'.$lymenu['diger'].'<i class="i">-</i></div>
<div class="kutu-icerik yonetim-menu goster">
<ul class="kutu-liste">
<li><a href="sitemap.php">'.$lymenu['site_haritasi'].'</a></li>';

if ($ayarlar['cms_kullan'] == 1) $TEMA_YONETIM_MENU .= '<li><a href="iletisim.php">'.$lymenu['iletisim_mesajlari'].'</a></li>
<li><a href="cms_vt_guncelle.php">'.$lymenu['vt_guncelle'].$tym_cms.'</a></li>';

if ($ayarlar['forum_kullan'] == 1) $TEMA_YONETIM_MENU .= '<li><a href="forum_vt_guncelle.php">'.$lymenu['vt_guncelle'].$tym_forum.'</a></li>';

$TEMA_YONETIM_MENU .= '<li><a href="hata_kayitlari.php">'.$lymenu['hata_kayitlari'].'</a></li>
<li><a href="phpinfo.php">'.$lymenu['sunucu_bilgisi'].'</a></li>
</ul>
</div>
</div>';

$TEMA_YONETIM_MENU .= $ozel_yonetim_menu.'

</div>
</div>
<!-- Sol bloklar son -->

';


echo $TEMA_YONETIM_MENU;
?>