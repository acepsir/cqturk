<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

$yazilar = phpkf_tema_yazilar($yazi_kosul); // güncel yazılar alınıyor

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster

phpkf_tema_blok_goster(1); // sol blokları göster

phpkf_tema_blok_goster(2); // sağ blokları göster

if ($yazilar): // güncel yazı varsa
?>

<div class="orta-blok">

<?php foreach ($yazilar as $yazi): // güncel yazılar döngü - başı ?>

<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">
<a href="<?php echo $yazi['link']; ?>"><?php echo $yazi['baslik']; ?></a>
<span class="sosyal"></span>
<span class="duzenle"><?php echo $yazi['duzenle']; ?></span>
</div>

<div class="kutu-icerik">
<div class="yazi-icerik">
<?php
echo $yazi['icerik'];
if ($yazi['devami']!='') echo '<br /><br />'.$yazi['devami'];
?>
</div>
<div class="clear"></div>
</div>

<div class="kutu-footer">
<span class="kutu-tarih" title="Tarih"><i><?php echo $yazi['yayin_tarihi']; ?></i></span>
<span class="kutu-yazar" title="Yazan"><a href="<?php echo $yazi['profil']; ?>"><?php echo $yazi['yazan']; ?></a></span>
<span class="kutu-okunma" title="Gösterim"><i><?php echo $yazi['goruntuleme'].' '.$l['kez_okundu']; ?></i></span>
<span class="kutu-yorum" title="Yorum"><a href="<?php echo $yazi['link']; ?>#yorumlar"><?php echo $yazi['yorum_sayi'].' '.$l['yorum']; ?></a></span>
<?php if ($TEMA_KUTU_ALTI != '') eval($TEMA_KUTU_ALTI); ?>
</div>

</div>

<?php
endforeach; // güncel yazılar döngü - sonu

echo $TEMA_SAYFALAMA.'</div>'; // Sayfalama bağlantıları

else: // hiçbir güncel yazı yoksa
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $l['guncel_yazilar']; ?></div>
<div class="kutu-icerik"><center><br /><?php echo $l['hicbir_yazi_yok']; ?><br /><br /></center></div>
</div>
</div>

<?php endif; // koşul sonu ?>
