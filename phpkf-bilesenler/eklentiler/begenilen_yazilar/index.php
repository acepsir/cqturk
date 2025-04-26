<?php

if (!defined('PHPKF_ICINDEN')) exit();


//  Eklenti Bilgileri  //

$eklenti_bilgi = array(
'ad' => 'Beğenilen Yazılar',
'yapimci' => 'phpKF',
'telif' => 'phpKF',
'adres' => 'https://www.phpkf.com',
'tarih' => '14.07.2014 (01.09.2019)',
'esurum' => '1.1',
'usurum' => '0.600;0.650;0.750;1.00;1.10;1.20;3.00',
'tip' => 'Blok',
'aciklama' => 'Bu eklenti, tüm sayfalarda çıkacak şekilde, en beğenilen yazıların göründüğü bir blok ekler.
Bloğun yeri ve genişliğini <a href="bloklar.php">Blok Yönetimi</a> sayfasından ayarlayabilirsiniz.
Gösterilecek yazı sayısı, tipi, kategorisi, başlık ve içerik uzunluğu ayarlarını ise <a href="ayarlar.php?kip=eklenti#begenilen_yazilar_kat">Kurulu Eklentilerin Ayarları</a> sayfasından değiştirebilirsiniz.',
'resim_kucuk' => 'onizlemek.png',
'resim_buyuk' => 'onizlemeb.png',
);




//  EKLENTİ KURULUM İŞLEMLERİ - BAŞI  //

if ($eklenti_kurulum):

//  Eklenecek Bloklar  //
$blok_ekle[] = array(
'baslik' => 'Beğenilen Yazılar',
'yer' => '2',
'genislik' => '250px',
'adres' => 'begenilen_yazilar_blok.php',
'kod' => '',
);



// Kategori seçimi
$ayar_ekle[] = array(
'kat' => '',
'sira' => '1',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'begenilen_yazilar_kat',
'deger' => '0',
'form_tip' => 'select',
'secenek' => '0:Tüm Kategoriler|{KAT_ID}:{KATEGORILER}',
'secenek_tip' => 'numeric',
'varsayilan' => '0',
'bos' => '0',
'diger' => '',
'bilgi' => '',
'baslik' => 'Yazı kategorisi',
'aciklama' => 'Yazıların gösterileceği kategori.',
);


// yazı tipi seçimi
$ayar_ekle[] = array(
'kat' => '',
'sira' => '2',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'begenilen_yazilar_tip',
'deger' => '1',
'form_tip' => 'select',
'secenek' => '2:Sadece Yazılar|0:Sadece Sayfalar|1:Yazılar ve Sayfalar',
'secenek_tip' => 'numeric',
'varsayilan' => '1',
'bos' => '0',
'diger' => '',
'bilgi' => '',
'baslik' => 'Yazı tipi',
'aciklama' => 'Yazıların gösterileceği kategori.',
);


// Yazı sayısı ayarı
$ayar_ekle[] = array(
'kat' => '',
'sira' => '3',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'begenilen_yazilar_sayi',
'deger' => '5',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '5',
'bos' => '0',
'diger' => 'maxlength="2" style="width:30px"',
'bilgi' => '5',
'baslik' => 'Gösterilecek yazı sayısı',
'aciklama' => 'Beğenilen yazılar bloğunda gösterilecek yazı sayısı.',
);


// Yazı başlık karakter sınırlaması
$ayar_ekle[] = array(
'kat' => '',
'sira' => '4',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'begenilen_yazilar_baslik',
'deger' => '25',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '25',
'bos' => '0',
'diger' => 'maxlength="3" style="width:30px"',
'bilgi' => '25',
'baslik' => 'Azami başlık karakter sayısı',
'aciklama' => 'Yazı başlığının alabileceği en fazla karakter sayısı. Girilen değerden uzunsa ... şeklinde kısaltılır.',
);


// Yazı İçerik karakter sınırlaması
$ayar_ekle[] = array(
'kat' => '',
'sira' => '5',
'tip' => 'eklenti',
'kip' => '1',
'etiket' => 'begenilen_yazilar_icerik',
'deger' => '100',
'form_tip' => 'text',
'secenek_tip' => 'numeric',
'varsayilan' => '100',
'bos' => '0',
'diger' => 'maxlength="3" style="width:30px"',
'bilgi' => '100',
'baslik' => 'Azami içerik karakter sayısı',
'aciklama' => 'Yazı içeriğinin alabileceği en fazla karakter sayısı. Girilen değerden uzunsa ... şeklinde kısaltılır.',
);


endif;

//  EKLENTİ KURULUM İŞLEMLERİ - SONU  //



//  EKLENTİ KALDIRMA İŞLEMLERİ - BAŞI  //

if ($eklenti_kaldirma):

// kaldırılacak ayarlar
$ayar_kaldir = array(
'begenilen_yazilar_kat',
'begenilen_yazilar_tip',
'begenilen_yazilar_sayi',
'begenilen_yazilar_baslik',
'begenilen_yazilar_icerik',
);

endif;

//  EKLENTİ KALDIRMA İŞLEMLERİ - SONU  //

?>