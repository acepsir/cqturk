<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

$kategoriler = phpkf_tema_kategoriler($kat_kosul); // kategoriler alnıyor

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster

phpkf_tema_blok_goster(1); // sol blokları göster

phpkf_tema_blok_goster(2); // sağ blokları göster
?>


<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $TEMA_SAYFA_BASLIK; ?></div>
<div class="kutu-icerik">
<ul class="kutu-liste">


<?php
if ($kategoriler): // kategori varsa
foreach ($kategoriler as $kategori): // kategoriler döngü - başı

// yazılar için koşullar belirleniyor
$yazi_kosul = array(
'kat_id' => $kategori['id'],
'tip' => $kat_tip
);

$yazilar = phpkf_tema_yazilar($yazi_kosul); // yazılar alınıyor
?>

<fieldset>
<legend class="border">
<?php echo '<a href="'.$kategori['link'].'">'.$kategori['baslik']; ?></a>
</legend>
<ul class="liste-sayisal">



<?php
if ($yazilar): // Yazı varsa
foreach ($yazilar as $yazi): // yazılar döngü - başı
?>

<li><a href="<?php echo $yazi['link']; ?>"><?php echo $yazi['baslik']; ?></a></li>

<?php
// alt sayfa bağlantıları oluşturuluyor
if ($yazi['sayfa_no'] != 0) echo phpkf_tema_alt_yazilar(array('alt_yazi' => $yazi['id'], 'link' => $yazi['link']));

endforeach; // yazılar döngü - sonu

else: // yazı yoksa
?>
<li style="list-style-type:disc"><?php echo $l['kategori_sayfa_yok']; ?></li>
<?php endif; // yazı varsa koşul sonu ?>



</ul></fieldset>
<?php
endforeach; // kategoriler döngü - sonu

else: // kategori yoksa
?>

<?php echo $l['kategori_yok']; ?>

<?php endif; // kategori varsa koşul sonu ?>

</ul>
</div>
</div>
</div>
