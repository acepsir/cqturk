<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

</div>
<div class="clear" <?php if ($cms_icinden == 1) echo 'style="margin-top:20px"'; ?>></div>

{TEMA_SECIMI}

<footer id="phpkf-footer">
<div class="genislik">

<div class="footer-linkler">
<ul>
<li><a href="index.php">Ana Sayfa</a></li>
<li><a href="{MOBIL_ADRES}">Mobil Sayfalar</a></li>
<li><a href="rss.php">RSS Beslemesi</a></li>
</ul>
</div>
<div class="footer-linkler">
<ul>
<li><a href="bbcode_yardim.php">Yardım Sayfaları</a></li>
<li><a href="uyeler.php">Forum Üyeleri</a></li>
<li><a href="cevrimici.php">Çevrimiçi Üyeler</a></li>
</ul>
</div>
<div class="footer-linkler">
<ul>
<li><a href="giris.php">Giriş Formu</a></li>
<li><a href="kayit.php">Kayıt Formu</a></li>
<li><a href="arama.php">Arama Sayfaları</a></li>
</ul>
</div>

<div class="footer-bilgi">
<a href="index.php" class="sola-yasla baslikyazialt"><?php echo $TEMA_LOGO_ALT; ?></a>
</div>
<div class="clear"></div>

<div id="enalt" class="enalt yazi-ortala">
{{PHPKF}}
<div style="margin-top:5px">
<?php echo $TEMA_SITE_TABAN_YAZI; // Taban yazısı ?>
</div>
</div>

</div>
</footer>
<script src="temalar/<?php echo $temadizini; ?>/mobil.js" type="text/javascript"></script>
<?php echo $TEMA_SITE_TABAN_KOD; // Taban kodları ?>
</body>
</html>