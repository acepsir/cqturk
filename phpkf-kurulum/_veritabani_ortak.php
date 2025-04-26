<?php

//  VERİTABANI BİLGİLERİ  //
$veritabani_ortak = "



--		`ayarlar` TABLOSU VERiLERi

CREATE TABLE IF NOT EXISTS `$tablo_ayarlar` (
`etiket` varchar(50) NOT NULL,
`deger` text,
`form_tip` varchar(15) NOT NULL DEFAULT '',
`secenek` text,
`secenek_tip` varchar(10) NOT NULL DEFAULT '',
`varsayilan` text,
`bos` tinyint(1) NOT NULL DEFAULT '1',
`diger` varchar(255) NOT NULL DEFAULT '',
`bilgi` varchar(255) NOT NULL DEFAULT '',
`baslik` varchar(255) NOT NULL DEFAULT '',
`aciklama` varchar(1000) NOT NULL DEFAULT '',
`kat` tinyint(3) unsigned NOT NULL DEFAULT '0',
`sira` tinyint(3) unsigned NOT NULL DEFAULT '255',
`tip` varchar(20) NOT NULL DEFAULT '',
`kip` tinyint(3) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY (`etiket`),
KEY `kat` (`kat`),
KEY `sira` (`sira`),
KEY `tip` (`tip`),
KEY `kip` (`kip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('duyuru_tarihi', '0', '', '', 'numeric', '', 0, '', '', '', '', 0, 1, 'sistem', 5);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('anasyfyazi', '1', '', '', 'numeric', '', 0, '', '', '', '', 0, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('surum', '$guncel_surum', '', '', 'numeric', '', 0, '', '', '', '', 0, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('site_acilis', '$tarih', '', '', 'numeric', '', 0, '', '', '', '', 0, 5, 'sistem', 5);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('temadizini', 'varsayilan', '', '', 'text', '', 0, '', '', '', '', 0, 6, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('temadizini_cms', 'varsayilan', '', '', 'text', '', 0, '', '', '', '', 0, 7, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('temadizini_portal', 'varsayilan', '', '', 'text', '', 0, '', '', '', '', 0, 8, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_secenek', 'varsayilan,', '', '', 'text', '', 0, '', '', '', '', 0, 9, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_secenek_portal', 'varsayilan,', '', '', 'text', '', 0, '', '', '', '', 0, 10, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yonetim_menu', '', '', '', 'text', '', 0, '', '', '', '', 0, 11, 'sistem', 5);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dil_eklenen_alanlar', ',', '', '', 'text', '', 0, '', '', '', '', 0, 12, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('site_adi', 'Site Adı', 'text', '', 'text', '', 0, '', '', '', '', 1, 1, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('alanadi', '$alanadi', 'text', '', 'text', '', 0, '', '', '', '', 1, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dizin', '$site_dizin', 'text', '', 'text', '', 0, '', '', '', '', 1, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('f_dizin', '$site_dizin', 'text', '', 'text', '', 0, '', '', '', '', 1, 4, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('durum_anasayfa', '0', 'radio', '', 'numeric', '', 0, 'onclick=\"EtkinYap(this.value)\"', '', '', '', 1, 5, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('anasyfdosya', '', 'text', '', 'text', '', 1, 'disabled=\"disabled\"', '', '', '', 1, 6, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('guncel_kat', '0', 'select', '', 'numeric', '', 0, '', '', '', '', 1, 7, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('guncel_yazi', '2', 'select', '', 'numeric', '', 0, '', '', '', '', 1, 8, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yazan_adi', '0', 'radio', '', 'numeric', '', 0, '', '', '', '', 1, 9, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('vt_hata', '2', 'radio', '', 'numeric', '', 0, '', '', '', '', 1, 10, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('durum_site', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 1, 11, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('site_kapali', '<h2>Site Bakımda !\r\n<br><br>\r\nLütfen daha sonra tekrar deneyin.</h2>\r\n<br>\r\n<a href=\"phpkf-yonetim/index.php\">- Yönetim Giriş -</a>', 'textarea', '', 'html', '', 0, 'rows=\"5\"', '', '', '', 1, 12, 'sistem', 5);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dil_varsayilan', 'tr', 'select', '', 'text', '', 0, '', '', '', '', '1', '13', 'sistem', '1');

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dil_eklenen', ',en,de,it,ar,az,', 'text', '', 'text', '', 0, '', '', '', '', '1', '14', 'sistem', '1');

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('title_anasyf', 'Site Adı', 'text', '', 'text', '', 1, 'maxlength=\"100\"  ', '', '', '', 2, 1, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('title', '', 'text', '', 'text', '', 1, 'maxlength=\"100\"  ', '', '', '', 2, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('site_taban', 'Site Adı Taban Yazı', 'textarea', '', 'html', '', 1, 'rows=\"2\"', '', '', '', 2, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('syfkota_guncel', '10', 'text', '', 'numeric', '', 0, 'maxlength=\"3\"  style=\"width:40px\"', '', '', '', 3, 1, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('syfkota_kat', '20', 'text', '', 'numeric', '', 0, 'maxlength=\"3\"  style=\"width:40px\"', '', '', '', 3, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('syfkota_yorum', '10', 'text', '', 'numeric', '', 0, 'maxlength=\"3\"  style=\"width:40px\"', '', '', '', 3, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('benzer_durum','1','radio','','numeric','','0','','','','','3','4','sistem','1');

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('benzer_kota','10','text','','numeric','','0','maxlength=\"3\" style=\"width:40px\"','','','','3','5','sistem','1');

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('seo', '0', 'radio', '', 'numeric', '', 0, '', '', '', '', 4, 1, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dizin_kat', 'kategoriler', 'text', '', 'text', '', 0, 'maxlength=\"50\"  style=\"width:150px\"', '', '', '', 4, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dizin_sayfa', 'sayfalar', 'text', '', 'text', '', 0, 'maxlength=\"50\"  style=\"width:150px\"', '', '', '', 4, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dizin_galeri', 'galeriler', 'text', '', 'text', '', 0, 'maxlength=\"50\"  style=\"width:150px\"', '', '', '', 4, 4, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dizin_video', 'videolar', 'text', '', 'text', '', 0, 'maxlength=\"50\"  style=\"width:150px\"', '', '', '', 4, 5, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dizin_etiket', 'etiket', 'text', '', 'text', '', 0, 'maxlength=\"50\"  style=\"width:150px\"', '', '', '', 4, 6, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dizin_arama', 'arama', 'text', '', 'text', '', 0, 'maxlength=\"50\"  style=\"width:150px\"', '', '', '', 4, 7, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('meta_description', 'Site tanıtım cümlesi', 'text', '', 'text', '', 0, 'maxlength=\"160\"', '', '', '', 4, 8, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('meta_keywords', 'phpkf, cms, forum, portal, eklenti, tema', 'text', '', 'text', '', 0, 'maxlength=\"260\"', '', '', '', 4, 9, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('meta_diger', '<meta name=\"rating\" content=\"All\" />', 'textarea', '', 'html', '', 1, 'rows=\"5\"', '', '', '', 4, 10, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('meta_sosyal', '', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 4, 11, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('sosyal_imleme', '', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 4, 12, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('site_taban_kod', '', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 4, 13, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('sef_adresler', '', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 4, 14, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tarih', '0', 'radio', '', 'numeric', '', 0, '', '', '', '', 5, 1, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tarih_bolge', 'Asia/Baghdad', 'text', '', 'text', '', 0, 'style=\"width:200px\"', '', '', '', 5, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tarih_dil', 'turkish', 'text', '', 'text', '', 0, 'style=\"width:200px\"', '', '', '', 5, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tarih_bicimi', 'd.m.Y-H:i:s', 'text', '', 'text', '', 0, 'style=\"width:200px\"', '', '', '', 5, 4, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('saat_dilimi', '3', 'select', '', 'text', '', 0, '', '', '', '', 5, 5, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('bbcode', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 6, 1, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yorum_onay', '1', 'select', '', 'numeric', '', 0, '', '', '', '', 6, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yorum_onay_kodu', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 6, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yorum_siralama', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 6, 4, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yorum_sure', '20', 'text', '', 'numeric', '', 0, 'maxlength=\"5\" style=\"width:50px\"', '', '', '', 6, 5, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('uye_cevrimici_sure', '1800', 'text', '', 'numeric', '', 0, 'maxlength=\"5\" style=\"width:50px\"', '', '', '', 6, 6, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('uye_kilit_sure', '1800', 'text', '', 'numeric', '', 0, 'maxlength=\"5\" style=\"width:50px\"', '', '', '', 6, 7, 'sistem', 3);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('uye_imza_uzunluk', '500', 'text', '', 'numeric', '', 0, 'maxlength=\"5\" style=\"width:50px\"', '', '', '', 6, 8, 'sistem', 3);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('k_cerez_zaman', '604800', 'text', '', 'numeric', '', 0, 'maxlength=\"5\" style=\"width:50px\"', '', '', '', 6, 9, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kayit_uyelik', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 7, 1, 'sistem', 2);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kayit_hesap_etkin', '0', 'radio', '', 'numeric', '', 0, '', '', '', '', 7, 2, 'sistem', 2);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kayit_onay_kodu', '0', 'radio', '', 'numeric', '', 0, '', '', '', '', 7, 3, 'sistem', 2);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kayit_soru', '0', 'radio', '', 'numeric', '', 0, '', '', '', '', 7, 4, 'sistem', 2);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kayit_sorusu', 'Türkiye`nin başkenti neresidir?', 'text', '', 'html', '', 1, '', '', '', '', 7, 5, 'sistem', 2);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kayit_cevabi', 'Ankara', 'text', '', 'text', '', 1, '', '', '', '', 7, 6, 'sistem', 2);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('uye_resim_yukle', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 8, 1, 'sistem', 3);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('uye_uzak_resim', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 8, 2, 'sistem', 3);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('uye_resim_galerisi', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 8, 3, 'sistem', 3);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('uye_resim_boyut', '307200', 'text', '', 'numeric', '', 0, 'maxlength=\"4\" style=\"width:50px\"', '', '', '', 8, 4, 'sistem', 3);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('uye_resim_yukseklik', '600', 'text', '', 'numeric', '', 0, 'maxlength=\"3\" style=\"width:50px\"', '', '', '', 8, 5, 'sistem', 3);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('uye_resim_genislik', '600', 'text', '', 'numeric', '', 0, 'maxlength=\"3\" style=\"width:50px\"', '', '', '', 8, 6, 'sistem', 3);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('v-uye_resmi', 'phpkf-dosyalar/resimler/varsayilan_resim.jpg', 'text', '', 'text', '', 1, 'maxlength=\"100\"', '', '', '', 8, 7, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('v-ziyaretci_resmi', 'phpkf-dosyalar/resimler/gravatar.png', 'text', '', 'text', '', 1, 'maxlength=\"100\"', '', '', '', 8, 8, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('site_posta', '$site_posta', 'text', '', 'text', '', 0, 'maxlength=\"200\"', '', '', '', 9, 1, 'sistem', 4);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('eposta_yontem', 'mail', 'radio', '', 'text', '', 0, '', '', '', '', 9, 2, 'sistem', 4);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('smtp_kd', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 10, 1, 'sistem', 4);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('smtp_sunucu', '', 'text', '', 'text', '', 1, 'maxlength=\"200\"', '', '', '', 10, 2, 'sistem', 4);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('smtp_kullanici', '', 'text', '', 'text', '', 1, 'maxlength=\"100\"', '', '', '', 10, 3, 'sistem', 4);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('smtp_sifre', '', 'password', '', 'text', '', 1, 'maxlength=\"100\"', '', '', '', 10, 4, 'sistem', 4);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('smtp_port', '587', 'text', '', 'numeric', '', 0, 'maxlength=\"6\" style=\"width:55px\"', '', '', '', 10, 5, 'sistem', 4);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('duzenleyici', 'varsayilan', 'select', 'duz:Düz|varsayilan:phpKF|galeri:phpKF Galeri|tinymce:TinyMCE|ckeditor:CKEditor|sceditor:SCEditor', 'text', '', 0, '', '', '', '', 11, 1, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('gduzenleyici', 'galeri', 'select', 'duz:Düz|varsayilan:phpKF|galeri:phpKF Galeri|tinymce:TinyMCE|ckeditor:CKEditor|sceditor:SCEditor', 'text', '', 0, '', '', '', '', 11, 2, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('vduzenleyici', 'varsayilan', 'select', 'duz:Düz|varsayilan:phpKF|galeri:phpKF Galeri|tinymce:TinyMCE|ckeditor:CKEditor|sceditor:SCEditor', 'text', '', 0, '', '', '', '', 11, 3, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('bduzenleyici', 'varsayilan', 'select', 'duz:Düz|varsayilan:phpKF|galeri:phpKF Galeri|tinymce:TinyMCE|ckeditor:CKEditor|sceditor:SCEditor', 'text', '', 0, '', '', '', '', 11, 4, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yduzenleyici', 'varsayilan', 'select', 'duz:Düz|varsayilan:phpKF|galeri:phpKF Galeri|tinymce:TinyMCE|ckeditor:CKEditor|sceditor:SCEditor', 'text', '', 0, '', '', '', '', 11, 5, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_dosya', 'https://cdn.tinymce.com/4/tinymce.min.js', 'text', '', 'text', '', 0, 'maxlength=\"255\"', '', '', '', 12, 1, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_dizin', 'phpkf-bilesenler/editor/tinymce', 'text', '', 'text', '', 0, 'maxlength=\"255\"', '', '', '', 12, 2, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_language', '', 'textarea', '', 'html', '', 1, 'rows=\"1\" style=\"height:22px\"', '', '', '', 12, 3, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_toolbar', 'bold underline italic strikethrough | forecolor backcolor emoticons | alignleft aligncenter alignright alignjustify | removeformat link image dosyayukle | bullist numlist outdent indent | preview code fullscreen help | alintiekle devamekle | undo redo', 'textarea', '', 'html', '', 1, 'rows=\"4\"', '', '', '', 12, 4, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_style', '{title: \"Headers\", items: [\r\n{title: \"Header 1\", format: \"h1\"},\r\n{title: \"Header 2\", format: \"h2\"},\r\n{title: \"Header 3\", format: \"h3\"},\r\n{title: \"Header 4\", format: \"h4\"},\r\n{title: \"Header 5\", format: \"h5\"}]},\r\n\r\n{title: \"Inline\", items: [\r\n{title: \"Bold\", icon: \"bold\", format: \"bold\"},\r\n{title: \"Italic\", icon: \"italic\", format: \"italic\"},\r\n{title: \"Underline\", icon: \"underline\", format: \"underline\"},\r\n{title: \"Strikethrough\", icon: \"strikethrough\", format: \"strikethrough\"},\r\n{title: \"Superscript\", icon: \"superscript\", format: \"superscript\"},\r\n{title: \"Subscript\", icon: \"subscript\", format: \"subscript\"},\r\n{title: \"Code\", icon: \"code\", format: \"code\"}]},\r\n\r\n{title: \"Blocks\", items: [\r\n{title: \"Paragraph\", format: \"p\"},\r\n{title: \"Blockquote\", format: \"blockquote\"},\r\n{title: \"Div\", format: \"div\"},\r\n{title: \"Pre\", format: \"pre\"}]},\r\n\r\n{title: \"Alignment\", items: [\r\n{title: \"Left\", icon: \"alignleft\", format: \"alignleft\"},\r\n{title: \"Center\", icon: \"aligncenter\", format: \"aligncenter\"},\r\n{title: \"Right\", icon: \"alignright\", format: \"alignright\"},\r\n{title: \"Justify\", icon: \"alignjustify\", format: \"alignjustify\"},\r\n{title: \"Image Left\", selector: \'img\',styles: {\'float\': \'left\', \'margin\': \'0 10px 0 0\'}},\r\n{title: \'Image Right\', selector: \'img\', styles: {\'float\': \'right\', \'margin\': \'0 0 0 10px\'}}]},', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 12, 5, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_init', 'toolbar2: \"fontselect | fontsizeselect\",\r\nselector: \"textarea\",\r\nselector: \"textarea:not(.mceNoEditor)\",\r\nentity_encoding: \"raw\",\r\nelement_format: \"html\",\r\nremove_linebreaks: false,\r\nforce_br_newlines: true,\r\nforce_p_newlines: false,\r\nforced_root_block: false,\r\nimage_advtab: true,\r\npreformatted: true,\r\nresize: \"both\",\r\nheight: 400,\r\nrelative_urls: false,\r\nremove_script_host: false,\r\nconvert_urls: true,', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 12, 6, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_plugins', '\"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker help\",\r\n\"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking\",\r\n\"save table contextmenu directionality emoticons template paste textcolor\"', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 12, 7, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_harici_plugins', '', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 12, 8, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_dahili', 'ed.addButton(\"devamekle\", {\r\ntitle: editorl[\"devam_ekle\"],\r\nimage:  tinymce_dizin + \"/devam.png\",\r\nonclick: function(){ed.selection.setContent(ed.selection.getContent() + \"{{DEVAMI}}\");}\r\n});\r\ned.addButton(\"alintiekle\", {\r\ntitle: editorl[\"alinti_ekle\"],\r\nicon: \"blockquote\",\r\nonclick: function(){ed.selection.setContent(\"<blockquote>\" + ed.selection.getContent() + \"</blockquote>\");}\r\n});\r\ned.addButton(\"dosyayukle\",{\r\ntitle: editorl[\"dosya_yukleme\"],\r\nicon: \"browse\",\r\nonclick: function(){ed.focus();YuklemeAcKapat(tinyMCE.activeEditor.id);}\r\n});', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 12, 9, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tinymce_harici', '', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 12, 10, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_renk', 'mavi', 'select', '', 'text', '', 0, '', '', '', '', 13, 1, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_renk_cms', 'mavi', 'select', '', 'text', '', 0, '', '', '', '', 13, 1, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_genislik', '95%', 'text', '', 'text', '', 1, 'maxlength=\"8\" style=\"width:65px\"', '', '', '', 13, 2, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_logo_ust', 'Üst Logo 1', 'textarea', '', 'html', '', 1, 'rows=\"1\" style=\"height:22px\"', '', '', '', 13, 3, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_logo_ust2', 'Üst Logo 2', 'textarea', '', 'html', '', 1, 'rows=\"1\" style=\"height:22px\"', '', '', '', 13, 4, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_logo_alt', 'Alt Logo', 'textarea', '', 'html', '', 1, 'rows=\"1\" style=\"height:22px\"', '', '', '', 13, 5, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_uye_menusu', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 13, 6, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_ust_alan', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 13, 7, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_ust_alan_baslik', 'Duyuru', 'text', '', 'html', '', 1, '', '', '', '', 13, 8, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('tema_ust_alan_kod', '', 'textarea', '', 'html', '', 1, 'rows=\"4\"', '', '', '', 13, 9, 'tema', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_dosya', 'zip,rar,tar.gz,tar,gz,jpg,jpeg,gif,png,bmp,ico,wav,mp3,mp4,ogg,ogv,oga,webm,flv,swf,mpeg,mpg,mp2,wmv,mkv,avi,mov,3gp', 'text', '', 'text', '', 0, '', '', '', '', 14, 1, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_dosya_uye', 'zip,rar,jpg,jpeg,gif,png', 'text', '', 'text', '', 1, '', '', '', '', 14, 2, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_dizin', 'phpkf-dosyalar/yuklemeler', 'text', '', 'text', '', 1, '', '', '', '', 14, 3, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_dizin_uye', 'phpkf-dosyalar/yuklemeler/uyeler/{uye_id}', 'text', '', 'text', '', 0, '', '', '', '', 14, 4, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_genislik', '600', 'text', '', 'numeric', '', 0, 'maxlength=\"4\" style=\"width:55px\"', '', '', '', 14, 5, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_yukseklik', '400', 'text', '', 'numeric', '', 0, 'maxlength=\"4\" style=\"width:55px\"', '', '', '', 14, 6, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_kalite', '85', 'text', '', 'numeric', '', 0, 'maxlength=\"3\" style=\"width:55px\"', '', '', '', 14, 7, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_boyut', '10485760', 'text', '', 'numeric', '', 0, 'maxlength=\"10\"  style=\"width:100px\"', '', '', '', 14, 8, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_video', '<video src=\"{VIDEO}\" type=\"{TYPE}\" width=\"100%\" controls=\"true\">Browser does not support the video tag (Tarayıcı video etiketi desteklemiyor)</video>', 'textarea', '', 'html', '', 0, '', '', '', '', 14, 9, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_embed', '<embed src=\"{VIDEO}\" width=\"320\" height=\"240\">', 'textarea', '', 'html', '', 0, '', '', '', '', 14, 10, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yukleme_audio', '<audio src=\"{VIDEO}\" type=\"{TYPE}\" controls=\"true\">Browser does not support the audio tag (Tarayıcı audio etiketi desteklemiyor)</audio>', 'textarea', '', 'html', '', 0, '', '', '', '', 14, 11, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('duzenleyici_html_tema', 'varsayilan', 'select', 'varsayilan:Modern Düz (koyu, büyük)|varsayilan_kucuk:Modern Düz (koyu, küçük)|modern_acik:Modern Düz (açık, büyük)|modern_acik_kucuk:Modern Düz (açık, küçük)|klasik_koyu:Klasik Buton (koyu, büyük)|klasik_koyu_kucuk:Klasik Buton (koyu, küçük)|klasik_acik:Klasik Buton (açık, büyük)|klasik_acik_kucuk:Klasik Buton (açık, küçük)', 'text', '', 0, '', '', '', '', 15, 1, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('duzenleyici_bbcode_tema', 'modern_acik_kucuk', 'select', 'varsayilan:Modern Düz (koyu, büyük)|varsayilan_kucuk:Modern Düz (koyu, küçük)|modern_acik:Modern Düz (açık, büyük)|modern_acik_kucuk:Modern Düz (açık, küçük)|klasik_koyu:Klasik Buton (koyu, büyük)|klasik_koyu_kucuk:Klasik Buton (koyu, küçük)|klasik_acik:Klasik Buton (açık, büyük)|klasik_acik_kucuk:Klasik Buton (açık, küçük)', 'text', '', 0, '', '', '', '', 15, 2, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('duzenleyici_hizli_tema', 'modern_acik_kucuk', 'select', 'varsayilan:Modern Düz (koyu, büyük)|varsayilan_kucuk:Modern Düz (koyu, küçük)|modern_acik:Modern Düz (açık, büyük)|modern_acik_kucuk:Modern Düz (açık, küçük)|klasik_koyu:Klasik Buton (koyu, büyük)|klasik_koyu_kucuk:Klasik Buton (koyu, küçük)|klasik_acik:Klasik Buton (açık, büyük)|klasik_acik_kucuk:Klasik Buton (açık, küçük)', 'text', '', 0, '', '', '', '', 15, 3, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('duzenleyici_font', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', 'text', '', 'text', '', 1, 'maxlength=\"999\"', '', '', '', 15, 4, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dugme_html', 'kalin alticizgili yatik ustucizgili altsimge ustsimge | baslik boyut tip renk artalan kaldir | sol orta sag ikiyana | girintieksi girintiarti liste tablo yataycizgi | adres adresk resim eposta | alinti kod tarih devam | youtube video audio | postimage yukleme | geri ileri', 'textarea', '', 'text', '', 1, 'rows=\"3\"', '', '', '', 15, 5, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dugme_bbcode', 'kalin alticizgili yatik ustucizgili boyut tip renk artalan kaldir sol orta sag liste tablo yataycizgi adres adresk resim eposta alinti kod youtube video audio postimage yukleme', 'textarea', '', 'text', '', 1, 'rows=\"3\"', '', '', '', 15, 6, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dugme_hizli', 'kalin alticizgili yatik ustucizgili | renk artalan kaldir | sol orta sag | adres adresk resim eposta | alinti kod | youtube postimage yukleme', 'textarea', '', 'text', '', 1, 'rows=\"3\"', '', '', '', 15, 7, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dugme_kodlar', '', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 15, 8, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('dugme_stil', '', 'textarea', '', 'html', '', 1, 'rows=\"6\"', '', '', '', 15, 9, 'sistem', 6);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('fsyfkota', '20', 'text', '', 'numeric', '', 0, 'maxlength=\"3\" style=\"width:50px\"', '', '', '', 16, 1, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('ksyfkota', '8', 'text', '', 'numeric', '', 0, 'maxlength=\"3\" style=\"width:50px\"', '', '', '', 16, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('altforum_sira', '1', 'text', '', 'numeric', '', 0, 'maxlength=\"2\" style=\"width:30px\"', '', '', '', 16, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('sonkonular', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 16, 4, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kacsonkonu', '10', 'text', '', 'numeric', '', 0, 'maxlength=\"3\" style=\"width:50px\"', '', '', '', 16, 5, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('bolum_kisi', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 16, 6, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('konu_kisi', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 16, 7, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kurucu', 'Kurucu', 'text', '', 'text', '', 0, '', '', '', '', 17, 1, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yonetici', 'Yönetici', 'text', '', 'text', '', 0, '', '', '', '', 17, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('yardimci', 'Yardımcı', 'text', '', 'text', '', 0, '', '', '', '', 17, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('blm_yrd', 'Blm Yrd', 'text', '', 'text', '', 0, '', '', '', '', 17, 4, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kullanici', 'Üye', 'text', '', 'text', '', 0, '', '', '', '', 17, 5, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('o_ileti', '1', 'radio', '', 'numeric', '', 0, '', '', '', '', 18, 1, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('oi_uyari', '0', 'radio', '', 'numeric', '', 0, '', '', '', '', 18, 2, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('gelen_kutu_kota', '100', 'text', '', 'numeric', '', 0, 'maxlength=\"4\" style=\"width:50px\"', '', '', '', 18, 3, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('ulasan_kutu_kota', '100', 'text', '', 'numeric', '', 0, 'maxlength=\"4\" style=\"width:50px\"', '', '', '', 18, 4, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('kaydedilen_kutu_kota', '100', 'text', '', 'numeric', '', 0, 'maxlength=\"4\" style=\"width:50px\"', '', '', '', 18, 5, 'sistem', 1);

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('cms_kullan', '$cms_kullan', 'radio', '', 'numeric', '', 0, '', '', '', '', '19', '1', 'sistem', '1');

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('forum_kullan', '$forum_kullan', 'radio', '', 'numeric', '', 0, '', '', '', '', '19', '2', 'sistem', '1');

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('portal_kullan', '$portal_kullan', 'radio', '', 'numeric', '', 0, '', '', '', '', '19', '3', 'sistem', '1');

INSERT IGNORE INTO `$tablo_ayarlar` VALUES ('site_index', '$site_index', 'select', '', 'numeric', '', 0, '', '', '', '', '19', '4', 'sistem', '1');

UPDATE `$tablo_ayarlar` SET varsayilan=deger;





--		`baglantilar` TABLOSU VERiLERi

CREATE TABLE IF NOT EXISTS `$tablo_baglantilar` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`yer` tinyint(1) NOT NULL DEFAULT '1',
`sayfa` int(11) unsigned NOT NULL,
`alt_menu` int(11) unsigned NOT NULL DEFAULT '0',
`sistem` tinyint(1) NOT NULL DEFAULT '0',
`sira` tinyint(3) unsigned NOT NULL DEFAULT '1',
`ad` varchar(255) NOT NULL,
`adres` varchar(255) NOT NULL,
`bilgi` varchar(255) NOT NULL,
PRIMARY KEY (`id`),
KEY `alt_menu` (`alt_menu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (1, 1, 0, 0, 1, 15, 'giris-cikis', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (2, 1, 0, 0, 1, 14, 'kayit', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (3, 1, 0, 0, 1, 1, 'anasayfa', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (4, 1, 0, 0, 1, 5, 'kategoriler', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (5, 0, 0, 0, 1, 0, 'sayfalar', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (6, 1, 0, 0, 1, 6, 'galeriler', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (7, 1, 0, 0, 1, 7, 'videolar', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (8, 1, 0, 0, 1, 2, 'cms', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (9, 1, 0, 0, 1, 3, 'forum', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (10, 1, 0, 0, 1, 4, 'portal', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (11, 1, 0, 0, 1, 8, 'uyeler', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (12, 1, 0, 0, 1, 9, 'cevrimici', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (13, 1, 0, 0, 1, 10, 'arama', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (14, 1, 0, 0, 1, 12, 'iletisim', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (15, 0, 0, 0, 1, 0, 'etiket', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (16, 1, 0, 0, 1, 13, 'profil', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (17, 1, 0, 16, 1, 1, 'duzenle', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (18, 1, 0, 16, 1, 2, 'sifre', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (19, 1, 0, 16, 1, 3, 'ozel', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (20, 1, 0, 16, 1, 4, 'yonetim', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (21, 2, 0, 0, 1, 15, 'giris-cikis', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (22, 2, 0, 0, 1, 14, 'kayit', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (23, 2, 0, 0, 1, 1, 'anasayfa', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (24, 2, 0, 0, 1, 2, 'cms', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (25, 2, 0, 0, 1, 3, 'forum', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (26, 2, 0, 0, 1, 4, 'portal', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (27, 2, 0, 0, 1, 5, 'kategoriler', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (28, 2, 0, 0, 1, 6, 'sayfalar', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (29, 2, 0, 0, 1, 7, 'galeriler', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (30, 2, 0, 0, 1, 8, 'videolar', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (31, 2, 0, 0, 1, 9, 'uyeler', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (32, 2, 0, 0, 1, 10, 'cevrimici', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (33, 2, 0, 0, 1, 11, 'arama', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (34, 2, 0, 0, 1, 12, 'iletisim', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (35, 2, 0, 0, 1, 13, 'etiket', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (36, 3, 0, 0, 1, 8, 'giris-cikis', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (37, 3, 0, 0, 1, 9, 'kayit', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (38, 3, 0, 0, 1, 1, 'anasayfa', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (39, 3, 0, 0, 1, 2, 'uyeler', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (40, 3, 0, 0, 1, 3, 'cevrimici', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (41, 3, 0, 0, 1, 4, 'sayfalar', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (42, 3, 0, 0, 1, 5, 'etiket', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (43, 3, 0, 0, 1, 6, 'iletisim', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (44, 3, 0, 0, 1, 7, 'arama', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (45, 0, 0, 0, 1, 2, 'mobil', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (46, 0, 0, 0, 1, 3, 'rss', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (47, 0, 0, 0, 1, 4, 'yardim', '', '');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (48, 1, 0, 4, 0, 1, 'Genel', 'k=1&ka=genel', 'Genel Kategori');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (49, 1, 0, 6, 0, 1, 'Genel Galeri', 'k=2&ka=genel-galeri', 'Genel Galeri');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (50, 1, 0, 7, 0, 1, 'Genel Video', 'k=3&ka=genel-video', 'Genel Video');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (51, 1, 0, 48, 0, 1, 'Genel Alt 1', 'k=4&ka=genel-alt-1', 'Genel Alt 1');

INSERT IGNORE INTO `$tablo_baglantilar` VALUES (52, 1, 0, 48, 0, 2, 'Genel Alt 2', 'k=5&ka=genel-alt-2', 'Genel Alt 2');





--		`bildirimler` TABLOSU VERiLERi

CREATE TABLE IF NOT EXISTS `$tablo_bildirimler` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`tarih` int(11) unsigned NOT NULL,
`uye_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
`seviye` tinyint(1) unsigned NOT NULL DEFAULT '0',
`tip` tinyint(2) unsigned NOT NULL DEFAULT '0',
`okundu` tinyint(1) unsigned NOT NULL DEFAULT '0',
`bildirim` varchar(255) NOT NULL,
PRIMARY KEY (`id`),
KEY `uye_id` (`uye_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`eklentiler` TABLOSU VERiLERi

CREATE TABLE IF NOT EXISTS `$tablo_eklentiler` (
`ad` varchar(40) NOT NULL,
`baslik` varchar(100) NOT NULL DEFAULT '',
`kur` tinyint(1) unsigned NOT NULL,
`etkin` tinyint(1) unsigned NOT NULL,
`vt` tinyint(1) unsigned NOT NULL,
`dosya` tinyint(1) unsigned NOT NULL,
`dizin` tinyint(1) unsigned NOT NULL,
`sistem` tinyint(1) unsigned NOT NULL,
`usurum` varchar(5) NOT NULL,
`esurum` varchar(5) NOT NULL,
`bloklar` varchar(255) NOT NULL DEFAULT '',
`ayar_kat` tinyint(3) unsigned DEFAULT NULL,
PRIMARY KEY (`ad`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`kullanicilar` TABLOSU VERiLERi

CREATE TABLE IF NOT EXISTS `$tablo_kullanicilar` (
`id` mediumint(8) unsigned NOT NULL auto_increment,
`kullanici_kimlik` varchar(40) default NULL,
`kullanici_adi` varchar(99) NOT NULL,
`sifre` varchar(40) NOT NULL,
`posta` varchar(100) NOT NULL,
`web` varchar(100) default NULL,
`gercek_ad` varchar(100) NOT NULL,
`dogum_tarihi` varchar(10) NOT NULL,
`katilim_tarihi` int(11) unsigned NOT NULL,
`sehir` varchar(30) NOT NULL,
`mesaj_sayisi` mediumint(8) unsigned NOT NULL default '0',
`yonetim_kimlik` varchar(40) default NULL,
`resim` varchar(250) default NULL,
`imza` text,
`posta_goster` tinyint(1) NOT NULL default '1',
`dogum_tarihi_goster` tinyint(1) NOT NULL default '1',
`sehir_goster` tinyint(1) NOT NULL default '1',
`okunmamis_oi` smallint(3) unsigned NOT NULL default '0',
`son_ileti` int(11) unsigned NOT NULL default '0',
`kul_etkin` tinyint(1) NOT NULL default '0',
`kul_etkin_kod` varchar(10) NOT NULL default '0',
`engelle` tinyint(1) NOT NULL default '0',
`yeni_sifre` mediumint(7) unsigned NOT NULL default '0',
`yetki` tinyint(1) NOT NULL default '0',
`kilit_tarihi` int(11) unsigned NOT NULL default '0',
`giris_denemesi` tinyint(1) unsigned NOT NULL default '0',
`son_giris` int(11) unsigned NOT NULL default '0',
`son_hareket` int(11) unsigned NOT NULL default '0',
`hangi_sayfada` varchar(120) default NULL,
`kul_ip` varchar(39) default NULL,
`gizli` tinyint(1) NOT NULL default '0',
`icq` varchar(30) default NULL,
`msn` varchar(100) default NULL,
`yahoo` varchar(100) default NULL,
`aim` varchar(100) default NULL,
`skype` varchar(100) default NULL,
`temadizini` varchar(25) default NULL,
`temadizinip` varchar(25) default NULL,
`ozel_ad` varchar(30) default NULL,
`posta2` varchar(100) default NULL,
`sayfano` varchar(25) DEFAULT '0',
`grupid` smallint(5) unsigned DEFAULT '0',
`cinsiyet` tinyint(1) NOT NULL DEFAULT '0',
`hakkinda` text,
`takip` text,
`yrm_sayi` mediumint(6) unsigned NOT NULL DEFAULT '0',
`yrm_yapilan` mediumint(6) unsigned NOT NULL DEFAULT '0',
PRIMARY KEY  (`id`),
KEY `kullanici_adi` (`kullanici_adi`),
KEY `posta` (`posta`),
KEY `katilim_tarihi` (`katilim_tarihi`),
KEY `kul_etkin` (`kul_etkin`),
KEY `engelle` (`engelle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `$tablo_kullanicilar` VALUES (1, NULL, '$yonetici_adi', '$sifre', '$site_posta', 'http://$alanadi', '$yonetici_adi', '12-12-2012', $tarih, 'internet', 1, NULL, '', '', 1, 1, 1, 0, 0, 1, '0', 0, 0, 1, 0, 0, $tarih-1, $tarih-1, '', '', 0, '', '', '', '', '','', '', '', '','-1',0,0,'','',0,0);





--		`oturumlar` TABLOSU VERiLERi

CREATE TABLE IF NOT EXISTS `$tablo_oturumlar` (
`sid` varchar(32) NOT NULL,
`giris` int(11) unsigned NOT NULL,
`son_hareket` int(11) unsigned NOT NULL,
`hangi_sayfada` varchar(120) NOT NULL,
`kul_ip` varchar(39) NOT NULL,
`sayfano` varchar(25) DEFAULT '0',
KEY `sid` (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





--		`yasaklar` TABLOSU VERiLERi

CREATE TABLE IF NOT EXISTS `$tablo_yasaklar` (
`etiket` varchar(30) NOT NULL,
`deger` text,
`tip` tinyint(1) NOT NULL default '0',
PRIMARY KEY  (`etiket`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `$tablo_yasaklar` VALUES ('kulad', '', '0');

INSERT IGNORE INTO `$tablo_yasaklar` VALUES ('adsoyad', '', '0');

INSERT IGNORE INTO `$tablo_yasaklar` VALUES ('posta', '', '0');

INSERT IGNORE INTO `$tablo_yasaklar` VALUES ('sozcukler', '', '0');

INSERT IGNORE INTO `$tablo_yasaklar` VALUES ('cumle', '', '0');

INSERT IGNORE INTO `$tablo_yasaklar` VALUES ('yasak_ip', '', '0');


";

?>