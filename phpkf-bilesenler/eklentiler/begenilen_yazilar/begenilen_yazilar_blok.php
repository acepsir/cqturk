<?php

// yazı kategorisi belirleniyor
if ($ayarlar['begenilen_yazilar_kat'] == 0) $begenilen_kat_id = '';
else $begenilen_kat_id = $ayarlar['begenilen_yazilar_kat'];

// yazı tipi belirleniyor
if ($ayarlar['begenilen_yazilar_tip'] == 0) $begenilen_tip = 0;
elseif ($ayarlar['begenilen_yazilar_tip'] == 2) $begenilen_tip = 2;
else $begenilen_tip = '';


// beğenilen yazılar alınıyor
$begenilen_yazi_kosul = array(
'kat_id'  => $begenilen_kat_id,
'tip'  => $begenilen_tip,
'alan' => 'id,tip,adres,kategori,yazan,yazan_id,tarih,yayin_tarihi,goruntuleme,yorum_sayi,baslik,icerik',
'tum_icerik' => 0,
'kota' => $ayarlar['begenilen_yazilar_sayi'],
'sirala' => 'goruntuleme DESC',
);
?>


<style type="text/css" scoped="scoped">
@import url("phpkf-bilesenler/eklentiler/begenilen_yazilar/begenilen_yazilar_sablon.css");
</style>
<div class="begenilen-yazilar"><ul>


<?php
$bul = array('<br>', '<br />');

if ($begenilen_yazilar = phpkf_tema_yazilar($begenilen_yazi_kosul)): // Yazılar varsa koşul - başı

foreach ($begenilen_yazilar as $begenilen_yazi): // beğenilen yazılar döngü - başı


// Yazı başlığı uzunsa kısaltılıyor
if (strlen($begenilen_yazi['baslik']) > $ayarlar['begenilen_yazilar_baslik'])
$begenilen_yazi_kisa_baslik = mb_substr($begenilen_yazi['baslik'], 0, $ayarlar['begenilen_yazilar_baslik'],'UTF-8').'...';
else $begenilen_yazi_kisa_baslik = $begenilen_yazi['baslik'];


// Yazı içerik uzunsa kısaltılıyor
$begenilen_yazi_kisa_icerik = str_replace($bul, ' ', $begenilen_yazi['icerik']);
$begenilen_yazi_kisa_icerik = stripslashes(strip_tags($begenilen_yazi_kisa_icerik));

if (strlen($begenilen_yazi_kisa_icerik) > $ayarlar['begenilen_yazilar_icerik'])
$begenilen_yazi_kisa_icerik = mb_substr($begenilen_yazi_kisa_icerik, 0, $ayarlar['begenilen_yazilar_icerik'],'UTF-8').'...';


// Değenilen yazılar sıralanıyor
echo '<li>
<a href="'.$begenilen_yazi['link'].'"><b>'.$begenilen_yazi_kisa_baslik.'</b></a>
<br />
'.$begenilen_yazi['tarih'].'<br />
<span><a href="'.$begenilen_yazi['link'].'">'.$begenilen_yazi_kisa_icerik.'</a><br />
('.$l['gosterim'].': '.$begenilen_yazi['goruntuleme'].', '.$l['yorum'].': '.$begenilen_yazi['yorum_sayi'].')</span>
</li>';


endforeach; // beğenilen yazılar döngü - sonu

else: echo $l['hicbir_yazi_yok'];

endif;  // Yazılar varsa koşul - sonu
?>

</ul>
</div>