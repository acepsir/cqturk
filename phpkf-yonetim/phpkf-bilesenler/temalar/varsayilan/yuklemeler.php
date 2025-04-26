<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>
<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $tema_sayfa_baslik ;?></div>
<div class="kutu-icerik kayit-form">


<style type="text/css">@import "../phpkf-bilesenler/yukleme/yukleme.css";</style>
<script type="text/javascript"><!-- //
<?php echo $dosya_tipleri_js; ?>
// -->
</script>
<script type="text/javascript" src="../phpkf-bilesenler/yukleme/dosyaal.js"></script>


<div class="yukleme">

<div class="SlaytPencereEnDis">
<div class="SlaytBaslik">
<div id="SlaytToplam">&nbsp;</div>
<div id="SlaytGit"><span id="SlaytGeri"></span><span id="galeri_sayac"><?php echo $l['onizleme']; ?></span><span id="SlaytIleri"></span></div>
<div class="SlaytKapat"><a href="javascript:void(0)" onclick="endisKutuKapat()" id="SlaytKapat">X</a></div>
</div>
<div class="SlaytPencereIc">
<span id="Onizleme"></span>
</div></div>


<div class="yukleme-alani">
<div class="yukleme-input">
<div class="ikon-bolum"><span id="Ikon"></span></div>
<input type="hidden" id="yuklemeBoyutuSiniri" name="yuklemeBoyutuSiniri" value="983322563" />
<div>
<label for="dosyasecimi"><div id="dosyassurukleme"><?php echo $l['dosya_yukleme_bilgi']; ?><input type="file" id="dosyasecimi" name="dosyasecimi[]" multiple="multiple" style="width:100px" /></div></label>
</div>
<div id="yuklemecubugu" style="position:absolute"></div>
</div>
</div>

<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td valign="top" class="popup-yan-menu" style="vertical-align:top !important">

<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="vertical-align:top !important">
<ul>
<li><a style="color:#db9200" href="javascript:void(0)" onClick="anaDizin()"><?php echo $l['ana_dizin']; ?></a></li>
<li><a style="color:#86a821" href="javascript:void(0)" onClick="klasorOlustur()"><?php echo $l['klasor_olustur']; ?></a></li>
<li><a style="color:#ff0000" href="javascript:void(0)" onClick="VeriyiIlet('sil')"><?php echo $l['secilenleri_sil']; ?></a></li>
</ul>
<br />
<br />
<span style="display:none;" id="klasorAdi">
<input class="inputKutusu" type="text" id="kisim" placeholder="<?php echo $l['klasor_adi']; ?>">
<button class="dugme dugme-mavi" onClick="VeriyiIlet('klasorOlstr')"><?php echo $l['olustur']; ?></button>
</span>
</td>
</tr>
</table>
<div style="clear:both;min-height:450px"></div>
</td>

<td valign="top" style="vertical-align:top !important">
<div id="yenilemeAlani"></div>
</td>
</tr>
</table>

</div>
</div>
</div>
</div>

<script type="text/javascript">
Tazele();
//sayfaArttir("guncel");
</script>
<script type="text/javascript" src="../phpkf-bilesenler/yukleme/dosyayukle.js"></script>