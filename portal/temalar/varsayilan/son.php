<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

</div>
</div>

<?php if ($TEMA_DIL_SECIM): // Dil seçim formu - başı ?>

<div class="clear" style="height:10px"></div>
<div style="height:20px">
<form action="<?php echo $alt_dizin.$phpkf_dosyalar['forum']; ?>" method="get" name="site_dili">
<select name="dil" class="formlar" style="padding:5px; width:auto; width:148px; text-align:center" onchange="if(this.options[this.selectedIndex].value!='0'){document.forms['site_dili'].submit()}">
<?php echo $TEMA_DIL_SECIM; ?>
</select>
<input type="submit" value="<?php echo $l['sec']; ?>" class="dugme dugme-mavi" style="padding:3px 8px" />
</form>
</div>

<?php endif; // Dil seçim formu - sonu ?>

</div>
<div class="clear"></div>

{TEMA_SECIMI}
<div class="clear"></div>

<footer id="phpkf-footer">
<div class="genislik">
<?php
// Taban linklerini tema.php tema dosyasındaki
// $tema_ozellik_taban_baglanti[] dizi değişkeninden değiştirebilirsiniz.
// Aşağıdaki 3 rakamını değiştirerek link blok sayısını ayarlayabilirsiniz.
phpkf_taban_menu(3, $alt_dizin);
?>

<div class="footer-bilgi">
<div class="baslikyazialt sola-yasla"><?php echo $TEMA_LOGO_ALT; ?></div>
</div>

<div class="enalt yazi-ortala">
<div><?php echo $TEMA_SITE_TABAN_YAZI; // Taban yazısı ?></div>
{{PHPKF}}
</div>

</div>
</footer>
<script src="{UST_DIZIN}temalar/<?php echo $temadizini; ?>/js/mobil.js" type="text/javascript"></script>
<?php echo $TEMA_SITE_TABAN_KOD; // Taban kodları ?>
</body>
</html>