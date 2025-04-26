<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<?php if ($TEMA_DIL_SECIM): // Dil seçim formu - başı ?>

<div class="clear"></div>
<div style="height:40px">
<form action="../<?php echo $phpkf_dosyalar['cms']; ?>" method="get" name="site_dili">
<select name="dil" class="input-select" style="padding:3px; width:153px; text-align:center" onchange="if(this.options[this.selectedIndex].value!='0'){document.forms['site_dili'].submit()}">
<?php echo $TEMA_DIL_SECIM; ?>
</select>
<input type="submit" value="<?php echo $l['sec']; ?>" class="dugme dugme-mavi" style="padding:3px 8px" />
</form>
</div>

<?php endif; // Dil seçim formu - sonu ?>

</div>
<div class="clear" style="height:30px"></div>

<footer id="phpkf-footer">
<div class="enalt yazi-ortala">
{{PHPKF_CMS}}
</div>
</footer>
<script src="../phpkf-bilesenler/temalar/varsayilan/js/mobil.js"></script>
<script src="phpkf-bilesenler/js/menu.js"></script>
</body>
</html>