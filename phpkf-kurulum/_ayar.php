<?php

$dosya_ayar = '&lt;?php
if (!defined(\'DOSYA_AYAR\')) define(\'DOSYA_AYAR\',true);
if (!defined(\'PHPKF_ICINDEN\')) define(\'PHPKF_ICINDEN\', true);


// PHP hata gösterme ve kayıt ayarları
@error_reporting(E_ALL);
@ini_set(\'display_errors\',\'off\');
@ini_set(\'log_errors\', 1);

// Veritabanı Seçimi
$vtsecim = \''.$vtsecim.'\';

// Veritabanı Sunucu Adresi
$vtadres = \''.$vt_sunucu.'\';

// Veritabanı İsmi
$vtisim = \''.$vt_adi.'\';

// Veritabanı Kullanıcı Adı
$vtkul = \''.$vt_kullanici.'\';

// Veritabanı Şifresi
$vtsifre = \''.$vt_sifre.'\';

// Şifre Anahtarı
$anahtar = \''.$anahtar.'\';

// Tablo Öneki
$tablo_oneki = \''.$tablo_oneki.'\';



// Dosya isimleri';



if (($forum_kullan == 1) AND ($cms_kullan == 0))
{
$dosya_ayar .= '
$phpkf_dosyalar = array(
\'anasayfa\' => \''.$site_dizin.'\',
\'index\' => \'index.php\',
\'cms\' => \'index_cms.php\',
\'forum\' => \'index_forum.php\',
\'portal\' => \'portal/index.php\',
\'hata\' => \'hata.php\',
\'giris\' => \'giris.php\',
\'cikis\' => \'cikis.php\',
\'kayit\' => \'kayit.php\',
\'uyeler\' => \'uyeler.php\',
\'cevrimici\' => \'cevrimici.php\',
\'ozel_ileti\' => \'ozel_ileti.php\',
\'oi_oku\' => \'oi_oku.php\',
\'oi_yaz\' => \'oi_yaz.php\',
\'arama\' => \'arama.php\',
\'yardim\' => \'bbcode_yardim.php\',
\'rss\' => \'rss.php\',
\'mobil\' => \'mobil/index.php\',
\'profil\' => \'profil.php\',
\'profil_degistir\' => \'profil_degistir.php\',
\'sifre_degistir\' => \'profil_degistir.php?kosul=sifre\',
);';
}



else
{
$dosya_ayar .= '
$phpkf_dosyalar = array(
\'anasayfa\' => \''.$site_dizin.'\',
\'index\' => \'index.php\',
\'cms\' => \'index_cms.php\',
\'forum\' => \'index_forum.php\',
\'portal\' => \'portal/index.php\',
\'hata\' => \'hatalar.php\',
\'giris\' => \'uye-giris.php\',
\'cikis\' => \'uye-cikis.php\',
\'kayit\' => \'uye-kayit.php\',
\'uyeler\' => \'uye-uyeler.php\',
\'cevrimici\' => \'uye-cevrimici.php\',
\'ozel_ileti\' => \'ozel_ileti.php\',
\'oi_oku\' => \'oi_oku.php\',
\'oi_yaz\' => \'oi_yaz.php\',
\'arama\' => \'arama.php\',
\'yardim\' => \'bbcode_yardim.php\',
\'rss\' => \'rss.php\',
\'mobil\' => \'mobil/index.php\',
\'profil\' => \'uye-profil.php\',
\'profil_degistir\' => \'uye-profil.php?kip=degistir\',
\'sifre_degistir\' => \'uye-profil.php?kip=degistir&amp;kosul=sifre\',
);';
}



$dosya_ayar .= '

// Veritabanı Bağlantısı Yapılıyor
include_once(\'phpkf-bilesenler/vt_baglanti.php\');

?&gt;';

?>