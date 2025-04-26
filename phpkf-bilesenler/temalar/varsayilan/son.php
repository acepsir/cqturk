<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<?php if ($TEMA_DIL_SECIM): // Dil seçim formu - başı ?>

<div class="clear"></div>
<div style="height:40px">
<form action="<?php echo $phpkf_dosyalar['index']; ?>" method="get" name="site_dili">
<select name="dil" class="input-select" style="padding:3px; width:153px; text-align:center" onchange="if(this.options[this.selectedIndex].value!='0'){document.forms['site_dili'].submit()}">
<?php echo $TEMA_DIL_SECIM; ?>
</select>
<input type="submit" value="<?php echo $l['sec']; ?>" class="dugme dugme-mavi" style="padding:3px 8px" />
</form>
</div>

<?php endif; // Dil seçim formu - sonu ?>

</div>
<div class="clear"></div>


<footer id="phpkf-footer">
<div class="genislik">
<?php
// Taban linklerini tema_ozellik.php tema dosyasındaki
// $tema_ozellik_taban_baglanti[] dizi değişkeninden değiştirebilirsiniz.
// Aşağıdaki 3 rakamını değiştirerek link blok sayısını ayarlayabilirsiniz.
phpkf_taban_menu(3);
?>

<div class="footer-bilgi">
<div class="baslikyazialt sola-yasla"><?php echo $TEMA_LOGO_ALT; ?></div>
</div>

<div class="enalt yazi-ortala">
{{PHPKF_CMS}}
<div><?php echo $TEMA_SITE_TABAN_YAZI; // Taban yazısı ?></div>
</div>

</div>
</footer>
<script src="phpkf-bilesenler/temalar/varsayilan/js/mobil.js"></script>
<?php echo $TEMA_SITE_TABAN_KOD; // Taban kodları ?>
</body>
</html>