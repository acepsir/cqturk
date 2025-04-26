<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster

$yazilar = phpkf_tema_yazilar($iletisim_kosul); // iletişim yazısı alınıyor
if ($yazilar) foreach ($yazilar as $yazi);  // yazı varsa
?>

<script type="text/javascript"><!-- //
function SayiArttir(){
var now = new Date();
var sayac = Math.random();
sayac++;
document.images.onaykodu.src="phpkf-bilesenler/onay_kodu.php?a=1&sayi="+sayac+"&oturum=<?php echo $session_id; ?>";}
//  -->
</script>


<div class="iletisim-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $l['iletisim']; ?>
<span class="duzenle"><?php if ($yazilar) echo $yazi['duzenle']; ?></span>
</div>
<div class="kutu-icerik kayit-form">

<form action="phpkf-bilesenler/iletisim_yap.php" method="post" onsubmit="return denetle_iletisim()" name="iletisimForm">
<input type="hidden" name="durum" value="form_dolu" />
<input type="hidden" name="oturum" value="<?php echo $php_session; ?>" />
<input type="hidden" name="baslik2" id="baslik2" value="<?php echo $baslik2; ?>" />

<fieldset>
<legend>
<?php
if ($yazilar) echo $yazi['baslik'];
else echo $l['iletisim_bilgileri'];
?>
</legend>
<?php
if ($yazilar) echo $yazi['icerik'];
else echo $iletisim_bilgi;
?>
</fieldset>


<fieldset>
<legend><?php echo $l['iletisim_formu']; ?></legend>
<div class="phpkf-form-label">
<label class="label" for="ad_soyad"><?php echo $l['ad_soyad']; ?>:<br/></label>
<input type="text" placeholder="<?php echo $l['ad_soyad']; ?>" name="ad_soyad" id="ad_soyad" class="input-text yorum-text" maxlength="100" value="<?php echo $ad_soyad; ?>" required />
</div>

<div class="phpkf-form-label">
<label class="label" for="eposta"><?php echo $l['eposta']; ?>:<br/></label>
<input type="text" placeholder="<?php echo $l['eposta_adresi']; ?>" name="posta" id="posta" class="input-text yorum-text" maxlength="100" value="<?php echo $eposta; ?>" required />
</div>

<div class="phpkf-form-label">
<label class="label" for="baslik"><?php echo $l['konu']; ?>:<br/></label>
<select name="baslik" id="baslik" class="input-select" style="width:100%">
<option value="Bilgi" <?php if ($baslik == 'Bilgi') echo 'selected="selected"'; ?>><?php echo $l['bilgi']; ?></option>
<option value="İstek" <?php if ($baslik == 'İstek') echo 'selected="selected"'; ?>><?php echo $l['istek']; ?></option>
<option value="Öneri" <?php if ($baslik == 'Öneri') echo 'selected="selected"'; ?>><?php echo $l['oneri']; ?></option>
<option value="Şikayet" <?php if ($baslik == 'Şikayet') echo 'selected="selected"'; ?>><?php echo $l['sikayet']; ?></option>
<option value="Reklam" <?php if ($baslik == 'Reklam') echo 'selected="selected"'; ?>><?php echo $l['reklam']; ?></option>
<option value="İçerik Hakkında" <?php if ($baslik == 'İçerik Hakkında') echo 'selected="selected"'; ?>><?php echo $l['icerik_hakkında']; ?></option>
<option value="Teknik Sorun" <?php if ($baslik == 'Teknik Sorun') echo 'selected="selected"'; ?>><?php echo $l['teknik_sorun']; ?></option>
<option value="0" <?php if ($baslik == '0') echo 'selected="selected"'; ?>><?php echo $l['diger']; ?></option>
</select>
</div>

<div class="phpkf-form-label">
<label class="label" for="icerik"><?php echo $l['icerik']; ?>:<br/></label>
<textarea placeholder="<?php echo $l['icerik']; ?>..." name="icerik" id="icerik" class="input-text yorum-textarea" required></textarea>
</div>
</fieldset>


<?php if ($ayarlar['yorum_onay_kodu'] == '1'): // onay kodu - koşul başı ?>

<fieldset>
<legend><?php echo $l['onay_kodu']; ?></legend>
<div class="phpkf-form-label">
<label class="label" for="onay_kodu"><br/></label>
<img src="phpkf-bilesenler/onay_kodu.php?a=1&amp;oturum=<?php echo $onay_id; ?>" title="<?php echo $l['onay_kodu_yazin']; ?>" alt="Onay kodu" id="onaykodu" border="1" width="200" height="40" class="onay-kodu" /> &nbsp; &nbsp; 
<img src="phpkf-bilesenler/temalar/varsayilan/resimler/yenile.png" title="<?php echo $l['onay_kodu_degis']; ?>" alt="." style="cursor: pointer;" onclick="javascript:SayiArttir()" border="0" width="25" height="31" />
</div>

<div class="phpkf-form-label">
<label class="label" for="onay_kodu"><?php echo $l['onay_kodu']; ?><br/></label>
<input type="text" placeholder="<?php echo $l['onay_kodu_yazin2']; ?>" name="onay_kodu" id="onay_kodu" class="input-text yorum-text" maxlength="6" required />
</div>
</fieldset>
<script type="text/javascript"><!-- //
document.iletisimForm.onay_kodu.setAttribute("autocomplete","off");
//  -->
</script>

<?php endif; // onay kodu - koşul sonu ?>


<fieldset>
<div style="text-align:center">
<button type="submit" class="dugme dugme-mavi" style="letter-spacing:4px"><?php echo $l['gonder']; ?></button>
</div>
</fieldset>

<script type="text/javascript"><!-- //
$("#baslik").on("change", function(e){
var i = $(this).return().selectedIndex;
var d = $(this).return().options;
if(d[i].value == 0) $("#baslik2").goster();
else $("#baslik2").gizle();});
if($("#baslik").return().options[$("#baslik").return().selectedIndex].value == 0) $("#baslik2").goster();
else $("#baslik2").gizle();
//  -->
</script>

</form>

</div>
</div>
</div>