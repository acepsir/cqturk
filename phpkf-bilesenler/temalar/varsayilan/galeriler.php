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

// galeri için koşullar belirleniyor
$galeri_kosul = array(
'kat_id' => $kategori['id'],
'tip' => $yazi_tip,
);

// kategorideki galerilerin toplamı alınıyor
$toplam_galeri = phpkf_tema_toplam_yazi($galeri_kosul);

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
if ($toplam_galeri == 0) echo $l['kategori_galeri_yok'];
else echo str_replace('{00}', $toplam_galeri, $l['kategori_galeri_sonuc']);
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
// Seçili kategorideki galeriler sıralanıyor

else:

foreach ($kategoriler as $kategori);

// galeriler için koşullar belirleniyor
$yazi_kosul = array(
'kat_id' => $kat_id,
'alan' => '*',
'tip' => $yazi_tip,
'sayfa' => $kosul_sayfa,
'kota' => $ayarlar['syfkota_kat'],
);

$yazilar = phpkf_tema_yazilar($yazi_kosul); // galeriler alınıyor
?>

<fieldset>
<legend class="border">
<a href="<?php echo $kategori['link']; ?>"><?php echo $kategori['baslik']; ?></a>
</legend>

<?php
if ($yazilar): // galeri varsa
foreach ($yazilar as $yazi): // galeriler döngü - başı
preg_match_all('|<a href="(.*?)"><img src="(.*?)"></a>|is', $yazi['icerik'], $resim, PREG_SET_ORDER);
?>

<div class="kategori-galeri">
<a href="<?php echo $yazi['link']; ?>" title="<?php echo $yazi['baslik']; ?>">
<div class="kategori-galeri-artalan" style="background-image:url('<?php echo (isset($resim[0][2])) ? $resim[0][2] : ''; ?>')">
<img class="kategori-galeri-resim" src="<?php echo (isset($resim[0][2])) ? $resim[0][2] : ''; ?>" alt="." />
<div class="kategori-galeri-yazi"><?php echo $yazi['baslik']; ?></div>
</div>
</a>
</div>

<?php
// alt sayfa bağlantıları oluşturuluyor
if ($yazi['sayfa_no'] != 0) echo phpkf_tema_alt_yazilar(array('alt_yazi' => $yazi['id'], 'link' => $yazi['link']));

endforeach; // galeriler döngü - sonu

else: // galeri yoksa
?>

<li><?php echo $l['kategori_galeri_yok']; ?></li>

<?php endif; // galeri varsa koşul sonu ?>

</fieldset>


<?php endif; // Kategori sayfa tipi koşul sonu ?>


</ul>
</div>
</div>
<?php echo $TEMA_SAYFALAMA; // Sayfalama bağlantıları ?>
</div>
