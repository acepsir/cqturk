<?php
if (!defined('PHPKF_ICINDEN')) exit();

include_once('dosya_tipleri.php');

$bul = array("'", "\n", "\r");
$degis = array("\'", '', '');

echo '
<!--  DOSYA YÜKLEME ÖZELLİĞİ  -->
<script type="text/javascript"><!-- //
var azami_boyut = "'.$ayarlar['yukleme_boyut'].'";
var video_etiketi = "'.$video_etiketi.'";
var embed_etiketi = "'.$embed_etiketi.'";
var audio_etiketi = "'.$audio_etiketi.'";
var yukleme_video = \''.str_replace($bul, $degis, $ayarlar['yukleme_video']).'\';
var yukleme_embed = \''.str_replace($bul, $degis, $ayarlar['yukleme_embed']).'\';
var yukleme_audio = \''.str_replace($bul, $degis, $ayarlar['yukleme_audio']).'\';
//  -->
</script>
<style type="text/css">@import "'.$duzenleyici_dizin.'phpkf-bilesenler/yukleme/yukleme.css";</style>
<script type="text/javascript" src="'.$duzenleyici_dizin.'phpkf-bilesenler/yukleme/dosyaal.js"></script>';
?>

<div id="yukleme_pencere" class="yukleme" style="display:none; width:100%; height:100%; overflow:auto; margin:auto; position:fixed; top:0; left:0; bottom:0; right:0; background-color:rgba(0, 0, 0, 0.7);z-index:1001;">

<div class="popup-dosya-yukleme-kutu">

<div class="kapat-kutu"><a href="javascript:YuklemeAcKapat()" class="kapat-dugme" title="<?php echo $l['kapat']; ?>"><span class="kapat-grafik">&nbsp;</span></a></div>


<div class="SlaytPencereEnDis">
<div class="SlaytBaslik">
<div id="SlaytToplam">&nbsp;</div>
<div id="SlaytGit"><span id="SlaytGeri"></span><span id="galeri_sayac"><?php echo $l['onizleme']; ?></span><span id="SlaytIleri"></span></div>
<div class="SlaytKapat"><a href="javascript:void(0)" onclick="endisKutuKapat()" id="SlaytKapat">X</a></div>
</div>
<div class="SlaytPencereIc">
<span id="Onizleme"></span>
</div></div>


<div style="clear:both;margin-top:40px"></div>
<div class="yukleme-alani">
<div class="yukleme-input">
<div class="ikon-bolum"><span id="Ikon"></span></div>
<input type="hidden" id="yuklemeBoyutuSiniri" name="yuklemeBoyutuSiniri" value="983322563" />
<div>
<label for="dosyasecimi"><div id="dosyassurukleme"><?php echo $l['dosya_yukleme_bilgi']; ?><input type="file" id="dosyasecimi" name="dosyasecimi[]" multiple="multiple" /></div></label>
</div>
<div id="yuklemecubugu" style="position:absolute"></div>
</div>
</div>

<table cellpadding="0" cellspacing="0" border="0" height="80%">
<tr>
<td valign="top" class="popup-yan-menu" style="vertical-align:top !important">

<table cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="vertical-align:top !important">
<ul>
<li><a style="color:#db9200" href="javascript:void(0)" onClick="anaDizin()"><?php echo $l['ana_dizin']; ?></a></li>
<?php if ($kullanici_kim['yetki'] == '1'): // Yöneticiler için ?>
<li><a style="color:#86a821" href="javascript:void(0)" onClick="klasorOlustur()"><?php echo $l['klasor_olustur']; ?></a></li>
<li><a style="color:#ff0000" href="javascript:void(0)" onClick="VeriyiIlet('sil')"><?php echo $l['secilenleri_sil']; ?></a></li>
<?php else: // Yetkisiz üyeler için, isterseniz bu özellikleri kaldırabilirsiniz ?>
<li><a style="color:#86a821" href="javascript:void(0)" onClick="klasorOlustur()"><?php echo $l['klasor_olustur']; ?></a></li>
<li><a style="color:#ff0000" href="javascript:void(0)" onClick="VeriyiIlet('sil')"><?php echo $l['secilenleri_sil']; ?></a></li>
<?php endif; ?>
<li><a style="color:#229ad6" href="javascript:void(0)" onClick="VeriyiIlet('textareaEkleCoklu')"><?php echo $l['secilenleri_ekle']; ?></a></li>
</ul>
<br /><br /><br />
<span style="display:none;" id="klasorAdi">
<input class="inputKutusu" type="text" id="kisim" placeholder="<?php echo $l['klasor_adi']; ?>">
<input class="dugme dugme-mavi" type="button" onclick="VeriyiIlet('klasorOlstr')" value="<?php echo $l['olustur']; ?>" style="padding:5px" />
</span>
<br /><br />
</td>
</tr>
</table>
</td>

<td valign="top" style="vertical-align:top !important">
<div id="yenilemeAlani"></div>
</td>
</tr>
</table>

</div>
</div>

<script type="text/javascript">Tazele();</script>
<script type="text/javascript" src="<?php echo $duzenleyici_dizin; ?>phpkf-bilesenler/yukleme/dosyayukle.js"></script>
