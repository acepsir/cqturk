<!-- //
/*
 +===========================================================+
 |                  php Kolay Forum (phpKF)                  |
 +===========================================================+
 |                                                           |
 |          Telif - Copyright (c) 2007 - 2019 phpKF          |
 |            www.phpKF.com   -   phpKF@phpKF.com            |
 |        Tüm hakları saklıdır - All Rights Reserved         |
 |              http://www.phpkf.com/telif.php               |
 |                                                           |
 +===========================================================+*/

// Tam ekran
document.write('<div id="duzenleyici_govde" style="clear:both"><div id="mesaj_tamekran" class="gmesaj_tamekran">');


// Düzenleyici Başlık
document.write('<div id="gduzenleyici_baslik" class="gduzenleyici_baslik">\
<div id="gduzenleyici_baslik_yazi" class="gduzenleyici_baslik_yazi">'+phpkfl["zengin_galeri_duzenleyici"]+'</div>\
<div onclick="gtam_ekran(\''+duzenleyici_id+'\')" class="ggoster-gizle gdugme_tamekran" id="ggoster-gizleb" title="'+phpkfl["tam_ekran"]+'"></div>\
<div onclick="YuklemeAcKapat(\''+duzenleyici_id+'\')" class="ggoster-gizle gdugme_yukle" id="ggoster-gizle" title="'+editorl["dosya_yukleme"]+'"></div>\
<div style="clear:both"></div>\
</div>');


// Yazı alanı
document.write('<div id="duzenleyici_ana" class="gduzenleyici_ana">\
<div id="phpkf_div" class="gformlar_mesajyaz">&nbsp;</div>\
<div id="duzenleyici_taban" class="gduzenleyici_taban"></div>\
</div>');

document.write('</div></div>');

//  -->