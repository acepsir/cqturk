<?php if (!defined('PHPKF_ICINDEN_TEMA')) exit(); ?>

<a name="yorumlar"></a>
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik" style="height:16px;"><?php echo $l['yorumlar']; ?>&nbsp;
<span>(<?php echo $l['toplam'].': '.$yorum_sayi; ?>)</span>
<span style="float:right;position:relative;top:-5px;"><?php echo $l['siralama']; ?>:
<?php echo $form_yorum_siralama; ?>
</span>
</div>
<div class="kutu-icerik yorum-listesi">

<?php
if ($yorum_sayi > 0): // yorum varsa - koşul başı

if ($yorumlar = phpkf_tema_yorumlar($yorum_kosul)): // yorumlar alınıyor

foreach ($yorumlar as $yorum): // yorumlar döngü - başı
?>

<div class="yorum" <?php if ($yorum['yanit_mi']) echo 'style="margin-left:40px"'; ?>>
<div class="avatar">
<a href="<?php echo $yorum['profil'];?>" <?php echo $yorum['hedef']; ?>><img src="<?php echo $yorum['resim']; ?>" width="50" height="50" alt="Avatar"/></a>
</div>
<div class="yorum-icerik">

<div class="yorum-bilgi">
<a class="yorum-yazar" href="<?php echo $yorum['profil']; ?>" <?php $yorum['hedef']; ?>><?php echo $yorum['yazan'] ?></a>
<span class="yorum-tarih"><?php echo $yorum['tarih'] ?></span>
<span class="sag"><?php echo $yorum['duzenle'].$yorum['yanitla']; ?></span>
</div>

<div class="yorum-yazi">
<?php echo $yorum['icerik']; ?>
</div>

</div>
</div>

<?php
endforeach; // yorumlar döngü - sonu
endif; // yorumlar sonu
else: if ($yazi['yorum_durum'] == 1): // Yorum yoksa ve yazı yoruma açıksa
?>
<center><?php echo $l['yorum_yok']; ?></center>
<?php else: // Yorum yoksa ve yazı yoruma kapalıysa ?>
<center><?php echo $l['yorum_kapali']; ?></center>
<?php endif; endif; // yorum varsa - koşul sonu ?>

</div>
</div>


<?php
// Sayfalama bağlantıları varsa ekleniyor
$TEMA_YORUM_SAYFALAMA = phpkf_sayfalama($yrmsayi, $ayarlar['syfkota_yorum'], $ysayfano, 'yms=');
echo $TEMA_YORUM_SAYFALAMA;
?>


<a name="yorumyaz"></a>
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $l['yorum_yaz']; ?></div>
<div class="kutu-icerik kayit-form">
<?php
if ($yazi['yorum_durum'] == 1): // Yazı yoruma açıksa - koşul başı
echo $TEMA_YORUM['FORM'];
?>
<input type="hidden" name="bbcode" value="1" />
<input type="hidden" name="ifade" value="1" />
<input type="hidden" name="mesaj_baslik" value="Cvp:" />
<input type="hidden" name="yazi_id" value="<?php echo $yorum_kosul['yazi_id']; ?>" />
<fieldset>

<?php if (!$TEMA_UYE_BILGI): // ziyaretçi için ad-soyad, e-posta alanları ?>

<div class="phpkf-form-label">
<label class="label" for="adsoyad"><?php echo $l['ad_soyad']; ?>:<br/></label>
<input type="text" name="adsoyad" id="adsoyad" class="input-text yorum-text" placeholder="<?php echo $l['ad_soyad']; ?>" value="<?php echo $TEMA_ZIYARETCI_BILGI['adsoyad']; ?>" required />
</div>

<div class="phpkf-form-label">
<label class="label" for="posta"><?php echo $l['eposta_adresi']; ?>:<br/></label>
<input type="email" name="posta" id="posta" class="input-text yorum-text" placeholder="<?php echo $l['eposta_adresi']; ?>" value="<?php echo $TEMA_ZIYARETCI_BILGI['posta']; ?>" required />
</div>

<?php if ($ayarlar['yorum_onay_kodu'] == '1'): // Yorum onay kodu ?>

<div class="phpkf-form-label">
<label class="label" for="onay_kodu"><?php echo $l['onay_kodu']; ?>:<br/></label>
<input type="text" maxlength="6" name="onay_kodu" id="onay_kodu" class="input-text yorum-text" style="max-width:180px" placeholder="<?php echo $l['onay_kodu_yazin2']; ?>" value="" required />

<img src="phpkf-bilesenler/onay_kodu.php?a=1&amp;oturum=<?php echo $onay_id; ?>" title="<?php echo $l['onay_kodu_yazin']; ?>" alt="<?php echo $l['onay_kodu']; ?>" id="onaykodu" border="1" width="180" height="30" class="onay-kodu" style="margin-left:10px; margin-bottom:-11px" />
<img src="phpkf-bilesenler/temalar/varsayilan/resimler/yenile.png" title="<?php echo $l['onay_kodu_degis']; ?>" alt="." style="cursor:pointer; margin-left:10px; margin-bottom:-11px" onclick="javascript:SayiArttir()" border="0" width="25" height="31" />
</div>

<?php endif; endif; ?>

<div class="phpkf-form-label">
<label class="label" for="yorum">
<div class="ifadeler"><?php echo $l['yorum']; ?>:<br/><br/>
<?php echo ifade_olustur(5); ?>
</div>
</label>
<textarea name="mesaj_icerik" id="mesaj_icerik" rows="8" cols="10" placeholder="<?php echo $l['yorum_yaz']; ?>..." class="input-text yorum-textarea"></textarea>
<?php
$duzenleyici_tip = 'hizli';
include_once('phpkf-bilesenler/editor/index.php');
?>
</div>

<div class="phpkf-form-label" style="margin-top:0; margin-bottom:10px; text-align:center">
<button type="submit" class="dugme dugme-mavi" style="letter-spacing:4px"><?php echo $l['gonder']; ?></button> &nbsp; 
<button type="button" class="dugme dugme-mavi" onclick="FormTemizle()"><?php echo $l['temizle']; ?></button>
</div>
</fieldset>
</form>

<?php else: // Yazı yoruma kapalıysa ?>
<center><?php echo $l['yorum_kapali']; ?></center>
<?php endif; // Yazı yorum - koşul sonu ?>

</div>
</div>


<script type="text/javascript"><!-- //
function SayiArttir(){
var now=new Date();
var sayac=Math.random();
sayac++;
document.images.onaykodu.src="phpkf-bilesenler/onay_kodu.php?a=1&sayi="+sayac+"&oturum=<?php echo $session_id; ?>";
}
if(document.getElementById("onay_kodu"))document.getElementById("onay_kodu").setAttribute("autocomplete","off");
//  -->
</script>