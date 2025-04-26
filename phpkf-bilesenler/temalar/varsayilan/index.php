<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

$yazilar = phpkf_tema_yazilar($yazi_kosul); // ana sayfa yazısı alınıyor

if ($yazilar) foreach ($yazilar as $yazi); // yazı varsa

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster

phpkf_tema_blok_goster(1); // sol blokları göster

phpkf_tema_blok_goster(2); // sağ blokları göster
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">

<div class="kutu-baslik">
<?php echo $yazi['baslik']; ?>
<span class="sosyal"></span>
<span class="duzenle"><?php echo $yazi['duzenle']; ?></span>
</div>

<div class="kutu-icerik">
<div class="yazi-icerik">
<?php echo $yazi['icerik']; ?>
</div>
<div class="clear"></div>
</div>

</div>
<?php echo $TEMA_SAYFALAMA; // Sayfalama bağlantıları ?>
</div>
