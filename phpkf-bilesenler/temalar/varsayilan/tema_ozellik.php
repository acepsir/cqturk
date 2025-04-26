<?php
if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('DOSYA_TEMA_OZELLIK')) define('DOSYA_TEMA_OZELLIK',true);

$t_renkler = array(
'Kırmızı' => 'kirmizi',
);


//  TEMA BİLGİLERİ - BAŞI  //

$tema_bilgi = array(
'ad' => 'Varsayılan',
'yapimci' => 'phpKF',
'duzenleme' => '',
'tsurum' => '3.00',
'usurum' => '1.10;1.20;3.00',
'tarih' => '11.07.2014',
'guncelleme' => '01.09.2019',
'adres' => 'https://www.phpkf.com',
'demo' => 'https://www.phpkf.org/forum/tema-sec.php?cms_tema=varsayilan',
'resim_kucuk' => 'resimler/onizleme.jpg',
'resim_buyuk' => 'resimler/onizleme.jpg',
'telif' => '<a target="_bank" href="https://www.phpkf.com/telif.php#tema">phpKF</a>',
'aciklama' => 'Varsayılan Tema (Resmi Yapım)',
'yonetimden_renk_degisimi' => 1,
'eklenti' => 0,
);

//  TEMA BİLGİLERİ - SONU  //






// Bu dosyada bulunan css class`larını sablon.css dosyasında bulup
// bunları değiştirerek büyük miktarda tasarımı değiştirebilirsiniz.
// CSS değişimi yeterli gelmezse kullanılan HTML kodları
// aşağıdaki dizi değişkenlerde bulunmaktadır.
// Nerede kullanıldıkları ise hemen üstlerinde yorum olarak yazılıdır.







//  TEMA ŞABLONLARI - BAŞI  //

// Yönetim masasından renk değişimi destekleyen temalar için
// Veritabanına aktarılacak varsayılan ve diğer css şablon kodları
// Etiket isimleri aynı kalmalı, css kodlarını değiştirebilirsiniz.
// Kodlar tema kurulumunda veritabanına otomatik olarak eklenir.

// Şablon css kodları baslik.php tema dosyasında bulunan
// phpkf_tema_css();  kodu ile yüklenmektedir.
// Şablon tasarım kullanmayacaksanız aşağıdaki $tema_sablon[] dizi değişkenlerini silin.

$tema_sablon[] = array(
'ad' => 'varsayilan',
'body' => 'body{background:#EEEEEE;}',
'link' => 'a{color:#246A8A;}a:hover{color:#333333;}',
'ickatman' => '.phpkf-blok-kutusu{background:#FFFFFF;color:#333333;border-top:2px solid#58ABD0;border-bottom:2px solid#58ABD0;border-left:1px solid#CBCBCB;border-right:1px solid#CBCBCB;}',
'baslik' => '.site-baslik{background-color:#58ABD0;}',
'baslikyazi' => '#baslikyazi{color:#FFFFFF;}',
'baslikyazig' => '.phpkf-blok-kutusu .kutu-baslik{background:#F3F3F3;color:#555555;}',
'menuler' => '#genel-menu{background-color:#246A8A;border-top:1px solid#246A8A;border-bottom:1px solid#246A8A;}',
'menubag' => '#genel-menu ul li ul.dropdown-menu2{background-color:#246A8A;}#genel-menu ul li:hover > a{background-color:#165E80;}',
'menubag_a' => '.genel-menu ul a{color:#FFFFFF;}',
'anayazi' => '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a{color:#555555;}'
);

$tema_sablon[] = array(
'ad' => 'Mor',
'body' => 'body{background:#EEEEEE;}',
'link' => 'a{color:#5D7492;}a:hover{color:#333333;}',
'ickatman' => '.phpkf-blok-kutusu{background:#FFFFFF;color:#333333;border-top:2px solid#566E8A;border-bottom:2px solid#DDDDDD;border-left:1px solid#DDDDDD;border-right:1px solid#DDDDDD;}',
'baslik' => '.site-baslik{background-color:#768CA5;}',
'baslikyazi' => '#baslikyazi{color:#FFFFFF;}',
'baslikyazig' => '.phpkf-blok-kutusu .kutu-baslik{background:#F3F3F3;color:#555555;}',
'menuler' => '#genel-menu{background-color:#566E8A;border-top:1px solid#506E92;border-bottom:1px solid#47688F;}',
'menubag' => '#genel-menu ul a:hover{background-color:#45566B;}#genel-menu ul li ul.dropdown-menu2{background-color:#566E8A;}#genel-menu ul li:hover > a{background-color:#45566B;}#genel-menu ul li ul.dropdown-menu2 li a:hover{background-color:#45566B;}',
'menubag_a' => '.genel-menu ul a{color:#FFFFFF;}',
'anayazi' => '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a{color:#555555;}',
'kenar2' => '.dugme.dugme-mavi{background-color:#768CA5;}.sabit-menu{background:#455c77;}.sabit-menu ul a:hover{background:#455C77;}.sabit-menu ul li ul.dropdown-menu{display:none;background-color:#455C77;}.sabit-menu ul li:hover > a{background-color:#36475C;}.sabit-menu ul li ul.dropdown-menu li a:hover{background-color:#36475C;}.sabit-menu .klogo a{background:url("temalar/varsayilan/resimler/bildirim_logo.png") no-repeat 6px 9px;}.sabit-menu .klogo:hover > a, .sabit-menu .klogo ul.dropdown-menu li a{background:url("temalar/varsayilan/resimler/bildirim_logo.png") no-repeat 6px 9px;background-color:#36475C;}#phpkf-footer{background:#5F738A;border-top:1px solid#4B6481;}.enalt{background:#3D5269;}.tablo-baslik{border-top:2px solid#566E8A;}'
);

$tema_sablon[] = array(
'ad' => 'Koyu Gri',
'body' => 'body{background:#EEEEEE;}',
'link' => 'a{color:#555555;}a:hover{color:#000000;}',
'ickatman' => '.phpkf-blok-kutusu{background:#FFFFFF;color:#333333;border-top:2px solid#555555;border-bottom:2px solid#DDDDDD;border-left:1px solid#CBCBCB;border-right:1px solid#CBCBCB;}',
'baslik' => '.site-baslik{background-color:#555555;}',
'baslikyazi' => '#baslikyazi{color:#FFFFFF;}',
'baslikyazig' => '.phpkf-blok-kutusu .kutu-baslik{background:#F3F3F3;color:#555555;}',
'menuler' => '#genel-menu{background-color:#444444;border-top:1px solid#666666;border-bottom:1px solid#333333;}',
'menubag' => '#genel-menu ul a:hover{background-color:#333333;}#genel-menu ul li ul.dropdown-menu2{background-color:#333333;}#genel-menu ul li:hover > a{background-color:#333333;}#genel-menu ul li ul.dropdown-menu2 li a:hover{background-color:#444444;}',
'menubag_a' => '.genel-menu ul a{color:#FFFFFF;}',
'anayazi' => '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a{color:#555555;}',
'kenar2' => '.dugme.dugme-mavi{background-color:#444444;}.tablo-baslik{border-top:2px solid#444444;}'
);

$tema_sablon[] = array(
'ad' => 'Siyah',
'body' => 'body{background:#222222;color:#DDDDDD;}',
'link' => 'a{color:#898989;}a:hover{color:#EEEEEE;}',
'ickatman' => '.phpkf-blok-kutusu{background:#111111;color:#BBBBBB;border-top:2px solid#000000;border-bottom:2px solid#000000;border-left:1px solid#000000;border-right:1px solid#000000;}',
'baslik' => '.site-baslik{background-color:#222222;}',
'baslikyazi' => '#baslikyazi{color:#FFFFFF;}',
'baslikyazig' => '.phpkf-blok-kutusu .kutu-baslik{background:#000000;color:#CCCCCC;border-bottom:1px solid#716D6D;}',
'menuler' => '#genel-menu{background-color:#000000;border-top:1px solid#474747;border-bottom:1px solid#716D6D;}',
'menubag' => '#genel-menu ul a:hover{background-color:#222222;}#genel-menu ul li ul.dropdown-menu2{background-color:#222222;}#genel-menu ul li:hover > a{background-color:#222222;}#genel-menu ul li ul.dropdown-menu2 li a:hover{background-color:#333333;}',
'menubag_a' => '.genel-menu ul a{color:#CCCCCC;}',
'anayazi' => '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a{color:#888888;}',
'kenar2' => '.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li > a:hover{background:#333333;color:#DDDDDD;}.phpkf-blok-kutusu .kutu-icerik ul.kutu-liste li a.active{background:#333333;color:#AAAAAA;font-weight:bold;}.sabit-menu{background:#000000;}.sabit-menu ul a:hover{background:#333333;}.sabit-menu ul li ul.dropdown-menu{display:none;background-color:#333333;}.sabit-menu ul li:hover > a{background-color:#333333;}.sabit-menu ul li ul.dropdown-menu li a:hover{background-color:#444444;}.sabit-menu .klogo a{background:#000000 url("temalar/varsayilan/resimler/bildirim_logo.png") no-repeat 6px 9px;}.sabit-menu .klogo:hover > a, .sabit-menu .klogo ul.dropdown-menu li a{background:#333333 url("temalar/varsayilan/resimler/bildirim_logo.png") no-repeat 6px 9px;}.phpkf-blok-kutusu .kutu-footer{background: #000000;border-top:1px solid#716D6D;}#phpkf-footer{background:#222222;border-top:3px solid#000000;}.enalt{background:#000000;}.dugme.dugme-mavi{background-color:#000000;}fieldset {background-color:unset;border:1px solid#474747}.uye-arama-alani{background:#111111;border-bottom: 1px solid#716D6D;}.liste-veri{color:#DDDDDD;}.tablo-ana{background:#000000;}.tablo-ici, .tablo-satir,.tablo-ust{background:#222222;}.tablo-alt{background:#222222;}.tablo-satir:hover{background:#333333;}.tablo-baslik{background:#000000;border-top:0;padding:11px 0;border-bottom:1px solid#716D6D;color:#CCCCCC;font-weight:normal}.profil-kutusu, .profil-goruntule-ic, .profil-goruntule-ic ul.profil-sol-menu li a, .pro-duzenle, .pro-duzenle fieldset, .profil-dugmeler, .galeri-dugmeler, .dizinler, .resimler, .yazi-etiket{background:#252525;border:1px solid#000000;}.profil-goruntule-ic .sol-kisim, .profil-goruntule-ic .sag-kisim{background:#252525;}.profil-kutusu .baslik, .pro-duzenle .baslik{background:#000000;border:1px solid#393939}.profil-kutusu .kutu-ic .kutu-liste{border:1px solid#000000;}.profil-kutusu .kutu-ic .kutu-liste .liste-sol{background:#252525;border-right:1px solid#000;}.resimler .galeri-resim{background:#252525;border:2px solid#000000;}.resimler .galeri-resim:hover{background:#252525;border:2px solid#999999;}.dizinler ul.dizin-listesi li.secili{background:#252525;border:1px solid#000000;}.dizinler ul.dizin-listesi li{background:#333333;border:1px solid#000000;}.ifadeler{background:#F2F2F2;padding:3px}.yorum-listesi .yorum{border:1px solid#393939;color:#DDDDDD;}.yorum-listesi .yorum .yorum-icerik .yorum-yazi{border-top:1px solid#393939;}.tablo_ici{background:#111111;}.kullanici{color:#BBBBBB;}div.bloklar_yapi2 UL LI{background:#222222 !important;border:1px solid#666666 !important;color:#FFFFFF !important;}.input-alani, .input-alani:focus, .input-text, .input-text:focus, .input-select, .input-select:focus, .textarea, .textarea:focus{background:#333333;border:1px solid#000000;color:#DDDDDD;}.input-text.giris-text{background-repeat:no-repeat;background-position:right 7px center;}.input-alani:disabled{color:#BBBBBB;}.yonetim-form > div.form-div{background:#111111;border:1px solid#716D6D;}.yonetim-form > div.form-div > .yonetim-label, .yonetim-legend{color:#888888;}#cop_alani #cop, #gizle_alani #gizle{border:1px solid#666666 !important;}.popup-yan-menu{background:#222222 !important;border:1px solid#000000 !important;}.yukleme, .yukleme-alani{background:#222222 !important;border:1px solid#000000 !important;}.yukleme li{ background:#222222 !important; border:1px solid#000000 !important;}.yukleme table tr.ilkSatir th{ border:1px solid#000000 !important;}.yukleme table tr.renklendir2 td, table tr.renklendir td{border:1px solid#000000 !important;}.yukleme .dosyalar, .yukleme .resim_alani{border-right:1px solid#000000 !important;}.yukleme table tr.ilkSatir{background:#000000 !important;color:#BBBBBB;}.yukleme table tr.renklendir{background:#222222 !important;color:#BBBBBB;}.renklendir a:link, .renklendir a:visited, .renklendir a:active{color:#898989 !important;}.renklendir a:hover{color:#EEEEEE !important;}'
);

//  TEMA ŞABLONLARI - SONU  //





//  GENEL MENÜ TASARIMI  //

// Tüm sayfaların üstünde bulunan genel menü tasarımı

$tema_ozellik_genel_menu = array(
// üst link açılış
'ust_acilis' => '<li role="menuitem"><a href="{ADRES}" title="{BILGI}">{ISIM}</a>
<ul class="dropdown-menu2" role="menu">',

// üst link kapanış
'ust_kapanis' => '</ul></li>',

// alt link
'alt_link' => '<li role="menuitem"><a href="{ADRES}" title="{BILGI}">{ISIM}</a></li>'
);





//  BAĞLANTILAR VE KATEGORİLER BLOKLARININ TASARIMI  //

// Sayfaların sol ve sağında bulunan
// bağlantılar ve kategoriler bloklarının içindeki sıralama kodları

$tema_ozellik_blok_baglanti = array(
// ana yapı açılış
'ana_yapı_acilis' => '<ul class="kutu-liste">',

// ana yapı kapanış
'ana_yapı_kapanis' => '</ul>',

// üst link açılış
'ust_acilis' => '<li><a href="{ADRES}" title="{BILGI}">{ISIM} <i class="toplam">{TOPLAM}</i></a>
<ul style="list-style-type:none;padding-left:15px">',

// üst link kapanış
'ust_kapanis' => '</ul></li>',

// alt link
'alt_link' => '<li><a href="{ADRES}" title="{BILGI}">{ISIM} <i class="toplam">{TOPLAM}</i></a></li>'
);




//  TABAN BAĞLANTILARI TASARIMI  //

// Sayfaların altında bulunan taban linklerinin sıralanma kodları

$tema_ozellik_taban_baglanti = array(
// ana yapı açılış
'ana_yapı_acilis' => '<div class="footer-linkler"><ul>',

// ana yapı kapanış
'ana_yapı_kapanis' => '</ul></div>',

// üst link açılış
'ust_acilis' => '<li><a href="{ADRES}" title="{BILGI}">{ISIM}</a>
<ul>',

// üst link kapanış
'ust_kapanis' => '</ul></li>',

// alt link
'alt_link' => '<li><a href="{ADRES}" title="{BILGI}">{ISIM}</a></li>'
);





//  SAYFALAMA TASARIMI  //

// Çok sayfalı yazılarda görünen sayfalama bağlantılarının tasarımı

$tema_ozellik_sayfalama = array(
// sayfa link sayısı, çift sayılar kullanın, en küçük değer 2
'sayi' => 8,

// sayfalama açılış
'acilis' => '<div class="sayfalama"><div class="dis"><div class="ic">',

// sayfalama kapanış
'kapanis' => '</div></div></div>',

// en baş düğmesi
'enbas' => '<span class="enbas">&laquo;</span>',

// en son düğmesi
'enson' => '<span class="enson">&raquo;</span>',

// ileri düğmesi
'ileri' => '<span class="ileri">&#9658;</span>',

// geri düğmesi
'geri' => '<span class="geri">&#9668;</span>',

// seçili sayfa düğmesi
'secili' => '<span class="secili">{SAYI}</span>',

// diğer sayfa düğmeleri
'diger' => '<span class="diger">{SAYI}</span>'
);

?>