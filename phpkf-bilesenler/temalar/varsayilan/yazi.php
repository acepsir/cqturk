<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

$yazilar = phpkf_tema_yazilar($yazi_kosul); // yazı alınıyor

if ($yazilar) foreach ($yazilar as $yazi); // yazı varsa

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster

phpkf_tema_blok_goster(1); // sağ blokları göster
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">
<?php echo $yazi['baslik']; ?>
<span class="sosyal"><?php echo $ayarlar['sosyal_imleme']; ?></span>
<span class="duzenle"><?php echo $yazi['duzenle']; ?></span>
</div>

<div class="kutu-icerik">
<div class="yazi-icerik">
<?php echo $yazi['icerik']; ?>
</div>
<div class="clear"></div>
<?php
if ($etiketler = phpkf_tema_etiket($yazi['etiket']))
echo '<div class="yazi-etiket">'.$l['etiketler'].': '.$etiketler.'</div>';
?>
</div>

<div class="kutu-footer">
<span class="kutu-tarih" title="Tarih"><i><?php echo $yazi['yayin_tarihi']; ?></i></span>
<span class="kutu-yazar" title="Yazan"><a href="<?php echo $yazi['profil']; ?>"><?php echo $yazi['yazan']; ?></a></span>
<span class="kutu-okunma" title="Gösterim"><i><?php echo $yazi['goruntuleme'].' '.$l['kez_okundu']; ?></i></span>
<span class="kutu-yorum" title="Yorum"><a href="<?php echo $yazi['link']; ?>#yorumlar"><?php echo $yorum_sayi.' '.$l['yorum']; ?></a></span>
<?php if ($TEMA_KUTU_ALTI != '') eval($TEMA_KUTU_ALTI); ?>
</div>
</div>

<?php
echo $TEMA_SAYFALAMA; // Sayfalama bağlantıları
if ($ayarlar['benzer_durum'] == 1): // Benzer yazılar durum - koşul başı
?>

<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $l['benzer_yazilar']; ?></div>
<div class="kutu-icerik">
<ul class="kutu-liste">
<?php
// Benzer yazılar için koşul
$byazi_kosul = array('etiket' => $yazi['etiket'], 'kota' => $ayarlar['benzer_kota']);
$byazilar = phpkf_tema_yazilar($byazi_kosul); // benzer yazılar alınıyor
if ($byazilar): // Benzer yazı varsa - koşul başı
foreach ($byazilar as $byazi): // Benzer yazılar - döngü başı
?>

<li style="list-style-type:none">
<?php
echo '<a href="'.$byazi['link'].'">'.$byazi['baslik'];
if ($yazi['link'] == $byazi['link']): // Aynı yazı ise - koşul başı
?>
<span style="margin-left:10px;padding-left:7px;"><i>(<?php echo $l['bu_yazi']; ?>)</i></span>
<?php endif; // Aynı yazı ise - koşul başı ?>
<i style="font-size:11px"><?php echo $byazi['yayin_tarihi']; ?></i></a>
</li>

<?php
endforeach; // Benzer yazılar - döngü sonu
else: echo '<center>'.$l['benzer_yazi_yok'].'</center>'; // Benzer yazı yoksa
endif; // Benzer yazı varsa - koşul sonu
?>
</ul>
</div>
</div>

<?php
endif; // Benzer yazılar durum - koşul başı
eval(phpkf_tema_sayfa_yorum()); // Yorumları göster
?>
</div>
