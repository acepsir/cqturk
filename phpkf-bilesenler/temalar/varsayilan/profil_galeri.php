<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster
?>

<div class="tam-blok" style="width:100%">

<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $TEMA_SAYFA_BASLIK; ?></div>
<div class="kutu-icerik">
<?php echo $TEMA_FORM_BILGI; ?>



<!-- dizinler - başı -->

<div class="dizinler">
<ul class="dizin-listesi">
<?php
foreach ($TEMA_DIZINLER as $dizin):  // dizinler döngü - başı

// Seçili Dizin
if ($dizin['secili']) echo '<li class="secili">'.$dizin['link'].'</li>';

// Diğer Dizinler
else echo '<li>'.$dizin['link'].'</li>';

endforeach; // dizinler döngü - sonu
?>
</ul>
<div class="clear"></div>
</div>

<!-- dizinler - sonu -->




<!-- resimler - başı -->

<div class="resimler">

<?php foreach ($TEMA_RESIMLER as $resim): // resimler döngü - başı ?>

<div class="galeri-resim">
<label style="cursor:pointer" for="<?php echo $resim['sira']; ?>">
<img src="<?php echo $resim['adres']; ?>" alt="." />
</label>
<?php echo $resim['secenek']; ?>
</div>

<?php endforeach; // resimler döngü - sonu ?>

<div class="clear"></div>
</div>

<!-- resimler - sonu -->

<div class="galeri-dugmeler">
<button class="dugme dugme-mavi" name="secim_yap" type="submit"><?php echo $l['resim_sec']; ?></button>
<button class="dugme dugme-mavi" type="submit"><?php echo $l['iptal']; ?></button>
</div>

</form>

</div>
</div>
</div>
