<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster
?>

<br /><br /><br /><br />
<div class="genislik">
<div class="tam-blok" style="width:auto; max-width:600px">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $TEMA_HATA['BASLIK']; ?></div>
<div class="kutu-icerik yazi-ortala">
<br />
<?php echo $TEMA_HATA['ICERIK']; ?>
<br /><br />
</div>
</div>
</div>
</div>
<br /><br /><br />