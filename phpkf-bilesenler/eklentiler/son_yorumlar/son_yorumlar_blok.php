<?php

// yazı kategorisi belirleniyor
if ($ayarlar['son_yorumlar_kat'] == 0) $begenilen_kat_id = '';
else $begenilen_kat_id = $ayarlar['son_yorumlar_kat'];

// son 5 yorum alınıyor
$son_yorum_kosul = array(
	'kat_id' => $begenilen_kat_id,
	'sirala' => 'id DESC',
	'kota' => $ayarlar['son_yorumlar_sayi'],
	'bbcode' => 1,
	'ifade' => 0,
);
?>

<style type="text/css" scoped="scoped">
@import url("phpkf-bilesenler/eklentiler/son_yorumlar/son_yorumlar_sablon.css");
</style>
<div class="son-yorumlar"><ul>

<?php
if ($son_yorumlar = phpkf_tema_yorumlar($son_yorum_kosul)): // yorumlar varsa koşul - başı

foreach($son_yorumlar as $son_yorum): // son yorumlar döngü - başı

// Yorumun yazıldığı yazı alınıyor
$son_yorum_yazi_kosul = array(
'yazi_id' => $son_yorum['yazi_id'],
'alan' => 'id,tip,adres,kategori,goruntuleme,tarih,yayin_tarihi,yazan,yazan_id,yorum_sayi,baslik,icerik',
'tum_icerik' => 0,
'kota' => 1,
);

$son_yorum_yazilar = phpkf_tema_yazilar($son_yorum_yazi_kosul);
foreach($son_yorum_yazilar as $son_yorum_yazi);


// Yazı başlığı uzunsa kısaltılıyor
if (strlen($son_yorum_yazi['baslik']) > $ayarlar['son_yorumlar_baslik'])
$son_yorumlar_kisa_baslik = mb_substr($son_yorum_yazi['baslik'], 0, $ayarlar['son_yorumlar_baslik'],'UTF-8').'...';
else $son_yorumlar_kisa_baslik = $son_yorum_yazi['baslik'];

// Yorum içerik uzunsa kısaltılıyor
$son_yorumlar_kisa_icerik = str_replace($bul, ' ', $son_yorum['icerik']);
$son_yorumlar_kisa_icerik = stripslashes(strip_tags($son_yorumlar_kisa_icerik));

if (strlen($son_yorumlar_kisa_icerik) > $ayarlar['son_yorumlar_icerik'])
$son_yorumlar_kisa_icerik = mb_substr($son_yorumlar_kisa_icerik, 0, $ayarlar['son_yorumlar_icerik'],'UTF-8').'...';


// Son yorumlar sıralanıyor
echo '<li>
<a href="'. $son_yorum_yazi['link'].'#yorumlar"><b>'.$son_yorumlar_kisa_baslik.'</b>
<img class="son-yorumlar-avatar" src="'.$son_yorum['resim'].'" alt="." /><br />
'.$l['yazan'].' '.$son_yorum['yazan'].'<br />
'.$son_yorum['tarih'].'
<span>'.$son_yorumlar_kisa_icerik.'</span></a>
</li>';


endforeach;  // son yorumlar döngü - sonu

else: echo 'Henüz yorum yok';

endif; // yorumlar varsa koşul - başı
?>

</ul></div>