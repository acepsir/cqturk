<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster

echo $javascript_kodu;
?>

<div class="genislik" style="margin-top:20px">
<div class="tam-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $l['kullanici_kayit']; ?></div>
<div class="kutu-icerik kayit-form">

<form action="phpkf-bilesenler/kayit_yap.php" method="post" onsubmit="return denetle_kayit()" name="form1">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu" />
<input type="hidden" name="oturum" value="<?php echo $php_session; ?>" />


<fieldset>
<legend><?php echo $l['kayit_bilgileri']; ?></legend>
<div class="phpkf-form-label">
<label class="label" for="kuladi"><?php echo $l['kullanici_adi']; ?><br/></label>
<input type="text" placeholder="<?php echo $l['kullanici_adi']; ?>" name="kullanici_adi" id="kullanici_adi" class="input-text giris-text" maxlength="20" value="<?php echo $kullanici_adi; ?>" onkeyup="javascript:dogrula_giris(this.id)" onblur="KAdi()" autocomplete="off" required />
<div style="height:5px; font-size:9px; color:#ff0000" id="kullanici_adi-alan2">
<a href="javascript:void(0)" onclick="KAdi()"><b><?php echo $l['denetle']; ?></b></a>
</div>
</div>

<div class="phpkf-form-label">
<label class="label" for="sifre"><?php echo $l['sifre']; ?><br/></label>
<input type="password" placeholder="<?php echo $l['sifre']; ?>" name="sifre" id="sifre" class="input-text giris-text" maxlength="20" value="" onkeyup="javascript:dogrula_giris(this.id)" autocomplete="new-password" required />
</div>

<div class="phpkf-form-label">
<label class="label" for="sifre2"><?php echo $l['sifre'].' '.$l['tekrar']; ?><br/></label>
<input type="password" placeholder="<?php echo $l['sifre'].' '.$l['tekrar']; ?>" name="sifre2" id="sifre2" class="input-text giris-text" maxlength="20" value="" onkeyup="javascript:dogrula_giris(this.id)" autocomplete="new-password" required />
</div>

<div class="phpkf-form-label">
<label class="label" for="eposta"><?php echo $l['eposta']; ?><br/></label>
<input type="email" placeholder="<?php echo $l['eposta_adresi']; ?>" name="posta" id="posta" class="input-text giris-text" maxlength="70" value="<?php echo $eposta; ?>" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>
</fieldset>


<?php if ($ayarlar['kayit_onay_kodu'] == '1'): // ONAY KODU ALANI ?>

<fieldset>
<legend><?php echo $l['onay_kodu']; ?></legend>
<div class="phpkf-form-label">
<label class="label" for="onay_kodu"><br/></label>
<img src="phpkf-bilesenler/onay_kodu.php?a=1&amp;oturum=<?php echo $onay_id; ?>" title="<?php echo $l['onay_kodu_yazin']; ?>" alt="<?php echo $l['onay_kodu']; ?>" id="onaykodu" border="1" width="200" height="40" class="onay-kodu" /> &nbsp; &nbsp; 
<img src="phpkf-bilesenler/temalar/varsayilan/resimler/yenile.png" title="<?php echo $l['onay_kodu_degis']; ?>" alt="." style="cursor:pointer" onclick="javascript:SayiArttir()" border="0" width="25" height="31" />
</div>

<div class="phpkf-form-label">
<label class="label" for="onay_kodu"><?php echo $l['onay_kodu']; ?><br/></label>
<input type="text" name="onay_kodu" id="onay_kodu" class="input-text giris-text" maxlength="6" placeholder="<?php echo $l['onay_kodu_yazin2']; ?>" onkeyup="javascript:dogrula_giris(this.id)" autocomplete="off" required />
</div>
</fieldset>


<?php
endif;
if ($ayarlar['kayit_soru'] == 1): // KAYIT SORUSU ALANI
?>


<fieldset>
<legend><?php echo $l['guvenlik_sorusu']; ?></legend>
<div><?php echo $ayarlar['kayit_sorusu']; ?></div>
<div class="phpkf-form-label">
<input type="text" placeholder="<?php echo $l['guvenlik_cevap']; ?>" name="kayit_cevabi" id="kayit_cevabi" class="input-text giris-text" maxlength="20" value="<?php echo $kayit_cevabi; ?>" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>
</fieldset>


<?php endif; ?>


<fieldset>
<div>
<label class="label" for="kosul"></label>
<input type="checkbox" name="kosul" id="kosul" style="position:relative; top:2px" required />
<label for="kosul" style="cursor:pointer">
<a href="javascript:void(0)" onclick="window.open('<?php echo $phpkf_dosyalar['kayit']; ?>?kosul=kabul', 'kayit_kosul', 'resizable=yes,toolbar=0,status=0,width=650,height=420');return false">
<?php echo $l['uyelik_kosullari']; ?></a><?php echo $l['uyelik_kosullari_kabul']; ?>
</label>
</div>
</fieldset>


<fieldset>
<div style="text-align:center"><button type="submit" class="dugme dugme-mavi"><?php echo $l['kaydol']; ?></button></div>
</fieldset>

</form>

<div style="display:none">
<img width="0" height="0" border="0" alt="." src="phpkf-bilesenler/temalar/varsayilan/resimler/bos.png" />
<img width="0" height="0" border="0" alt="." src="phpkf-bilesenler/temalar/varsayilan/resimler/dogru.png" />
<img width="0" height="0" border="0" alt="." src="phpkf-bilesenler/temalar/varsayilan/resimler/yanlis.png" />
<img width="0" height="0" border="0" alt="." src="phpkf-dosyalar/yukleniyor.gif" />
</div>

</div>
</div>
</div>
</div>

<script type="text/javascript"><!-- //
<?php if ($kullanici_adi == '') echo 'setTimeout("document.form1.kullanici_adi.value=\'\'",100);'; ?>
setTimeout("document.form1.sifre.value=''",100);
setTimeout("document.form1.sifre2.value=''",100);
setTimeout("dogrula_giris('kullanici_adi')",100);
setTimeout("dogrula_giris('posta')",100);
if(document.getElementById('kayit_cevabi')) setTimeout("dogrula_giris('kayit_cevabi')",100);
// -->
</script>