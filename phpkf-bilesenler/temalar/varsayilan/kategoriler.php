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
// KATEGORİ ANA SAYFASI
// Tüm kategoriler sıralanıyor

if ($kat_id == ''):

if ($kategoriler): // kategori varsa

foreach ($kategoriler as $kategori): // kategoriler döngü - başı

// yazılar için koşullar belirleniyor
$yazi_kosul = array(
'kat_id' => $kategori['id'],
'tip' => 2,
);

// sayfalar için koşullar belirleniyor
$sayfa_kosul = array(
'kat_id' => $kategori['id'],
'tip' => 0,
);

// kategorideki yazıların toplamı alınıyor
$toplam_yazi = phpkf_tema_toplam_yazi($yazi_kosul);

// kategorideki sayfaların toplamı alınıyor
$toplam_sayfa = phpkf_tema_toplam_yazi($sayfa_kosul);

// alt kategorileri alınıyor
$alt_kategoriler = phpkf_tema_alt_kategoriler(array('alt_kat' => $kategori['id']));
?>

<fieldset>
<legend class="border">
<a href="<?php echo $kategori['link']; ?>"><?php echo $kategori['baslik']; ?></a>
</legend>
<ul class="liste-daire">

<li>
<?php
if ( ($toplam_yazi == 0) AND ($toplam_sayfa == 0) ) echo $l['kategori_yazi_yok'];
else echo str_replace(array('{00}', '{01}'), array($toplam_sayfa, $toplam_yazi), $l['kategori_yazi_sonuc']);
?>
</li>

<?php if ($alt_kategoriler) echo $l['alt_kategori'].': '.$alt_kategoriler; ?>
</ul>
</fieldset>

<?php endforeach; // kategoriler döngü - sonu ?>




<?php
else: // kategori yoksa
echo $l['kategori_yok'];
endif; // kategori varsa-yoksa koşul sonu
?>




<?php
// KATEGORİ BAĞLANTISI TIKLANMIŞSA
// Seçili kategorideki yazılar sıralanıyor

else:

foreach ($kategoriler as $kategori);

// yazılar için koşullar belirleniyor
$yazi_kosul = array(
'kat_id' => $kat_id,
'tip' => $yazi_tip,
'sayfa' => $kosul_sayfa,
'kota' => $ayarlar['syfkota_kat'],
);

$yazilar = phpkf_tema_yazilar($yazi_kosul); // yazılar alınıyor
?>

<fieldset>
<legend class="border">
<a href="<?php echo $kategori['link']; ?>"><?php echo $kategori['baslik']; ?></a>
</legend>
<ul class="liste-sayisal" start="<?php echo ($kosul_sayfa+1); ?>">

<?php
if ($yazilar): // yazı varsa
foreach ($yazilar as $yazi): // yazılar döngü - başı
?>

<li><a href="<?php echo $yazi['link']; ?>"><?php echo $yazi['baslik']; ?></a></li>

<?php
// alt sayfa bağlantıları oluşturuluyor
if ($yazi['sayfa_no'] != 0) echo phpkf_tema_alt_yazilar(array('alt_yazi' => $yazi['id'], 'link' => $yazi['link']));

endforeach; // yazılar döngü - sonu

else: // yazı yoksa
?>

<li><?php echo $l['kategori_yazi_yok']; ?></li>

<?php endif; // yazı varsa koşul sonu ?>

</ul>
</fieldset>


<?php endif; // Kategori sayfa tipi koşul sonu ?>


</ul>
</div>
</div>
<?php echo $TEMA_SAYFALAMA; // Sayfalama bağlantıları ?>
</div>
