<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster
?>

<div class="genislik" style="margin-top:20px;">
<div class="tam-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $TEMA_SAYFA_BASLIK; ?></div>
<div class="kutu-icerik kayit-form">
<?php echo $TEMA_FORM_BILGI; ?>


<fieldset>

<?php
echo $TEMA_SAYFA_BILGI;


if ($TEMA_SAYFA_TIPI == 'sifre_basvuru'): // YENİ ŞİFRE BAŞVURU FORMU KODLARI ?>

<div class="phpkf-form-label">
<label class="label"><?php echo $l['eposta_adresi']; ?><br/></label>
<input type="text" placeholder="<?php echo $l['eposta_adresi']; ?>" name="posta" id="posta" class="input-text giris-text" size="20" maxlength="100" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>

<script type="text/javascript"><!-- //
document.giris.posta.focus();
//  -->
</script>




<?php elseif ($TEMA_SAYFA_TIPI == 'sifre_sifirlama'): // ŞİFRE SIFIRLAMA FORMU KODLARI ?>

<div class="phpkf-form-label">
<label class="label"><?php echo $l['yeni_sifre']; ?><br/></label>
<input type="password" name="y_sifre1" id="y_sifre1" class="input-text giris-text" size="20" maxlength="20" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>


<div class="phpkf-form-label">
<label class="label"><?php echo $l['yeni_sifre'].' '.$l['tekrar']; ?><br/></label>
<input type="password" name="y_sifre2" id="y_sifre2" class="input-text giris-text" size="20" maxlength="20" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>

<script type="text/javascript"><!-- //
document.giris.y_sifre1.setAttribute("autocomplete","off");
document.giris.y_sifre2.setAttribute("autocomplete","off");
document.giris.y_sifre1.focus();
//  -->
</script>




<?php elseif ($TEMA_SAYFA_TIPI == 'etkinlestir'): // ETKİNLEŞTİRME FORMU KODLARI ?>

<div class="phpkf-form-label">
<label class="label"><?php echo $l['eposta_adresi']; ?><br/></label>
<input type="text" placeholder="<?php echo $l['eposta_adresi']; ?>" name="posta" id="posta" class="input-text giris-text" size="20" maxlength="100" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>

<script type="text/javascript"><!-- //
document.giris.posta.focus();
//  -->
</script>




<?php else: // GİRİŞ FORMU KODLARI ?>

<div class="phpkf-form-label">
<label class="label"><?php echo $l['kullanici_adi']; ?><br/></label>
<input type="text" placeholder="<?php echo $l['kullanici_adi']; ?>" name="kullanici_adi" id="kullanici_adi" class="input-text giris-text" size="20" maxlength="20" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>

<div class="phpkf-form-label">
<label class="label"><?php echo $l['sifre']; ?><br/></label>
<input type="password" placeholder="<?php echo $l['sifre']; ?>" name="sifre" id="sifre" class="input-text giris-text" size="20" maxlength="20" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>

<div class="phpkf-form-label">
<label class="label" for="hatirla"><br/></label>
<label for="hatirla" style="cursor:pointer"><input type="checkbox" name="hatirla" id="hatirla" checked="checked" />&nbsp;<?php echo $l['beni_hatirla']; ?></label>
</div>

<script type="text/javascript"><!-- //
document.giris.kullanici_adi.focus();
setTimeout("dogrula_giris('sifre')",100);
setTimeout("dogrula_giris('kullanici_adi')",100);
//  -->
</script>

<?php endif; // olasılık sonu ?>




</fieldset>

<fieldset>
<div style="text-align:center"><button type="submit" class="dugme dugme-mavi">&nbsp;<?php echo $TEMA_FORM_BUTON; ?>&nbsp;</button></div>
</fieldset>

</form>
</div>

<div class="kutu-footer" style="text-align:center">
<a href="<?php echo $phpkf_dosyalar['giris']; ?>?kip=etkinlestir"><?php echo $l['etkinlestirme_kodu']; ?></a> &nbsp;|&nbsp; 
<a href="<?php echo $phpkf_dosyalar['giris']; ?>?kip=yeni_sifre"><?php echo $l['yeni_sifre']; ?></a> &nbsp;| &nbsp;
<a href="<?php echo $phpkf_dosyalar['kayit']; ?>"><?php echo $l['yeni_kayit']; ?></a>
</div>
</div>

</div>
</div>

<div style="display:none">
<img width="0" height="0" alt="." src="phpkf-bilesenler/temalar/varsayilan/resimler/bos.png" />
<img width="0" height="0" alt="." src="phpkf-bilesenler/temalar/varsayilan/resimler/dogru.png" />
<img width="0" height="0" alt="." src="phpkf-bilesenler/temalar/varsayilan/resimler/yanlis.png" />
</div>