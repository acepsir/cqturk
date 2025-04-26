<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster
?>

<div class="profil-orta-blok">

<div class="phpkf-blok-kutusu profil-blok">
<div class="kutu-baslik profil-baslik"><?php echo $TEMA_SAYFA_BASLIK; ?></div>
<div class="kutu-icerik profil-kutu-ic">


<?php
echo $javascript_kodu;
echo $TEMA_FORM_BILGI;

if ($TEMA_SAYFA_KIP == 'BILGI'):
?>
<div class="uye-bilgileri">

<div class="pro-duzenle">
<div class="baslik"><b><?php echo $l['uyelik_bilgileri']; ?></b></div>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['kullanici_adi']; ?> <small>(<?php echo $l['kullanici_adi_degistirilemez']; ?>)</small><br/></label>
<input type="text" disabled="disabled" class="input-type-text" value="<?php echo $uye_adi; ?>" />
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['ad_soyad']; ?> <small>(*)</small><br/></label>
<input class="input-type-text" type="text" name="gercek_ad" size="35" maxlength="30" value="<?php echo $uye_tam_adi; ?>" required />
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['dogum_tarihi']; ?> <small>(*)</small><br/></label>
<?php echo $uye_dogum; ?>
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['konum']; ?> <small>(*)</small><br/></label>
<input class="input-type-text" type="text" name="sehir" size="35" maxlength="50" value="<?php echo $uye_sehir; ?>" required />
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['cinsiyet']; ?><br/></label>
<?php echo $uye_cinsiyet; ?>
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['web_sitesi']; ?><br/></label>
<input class="input-type-text" type="text" name="web" size="35" maxlength="99" value="<?php echo $uye_web; ?>" />
</div>
</fieldset>

</div>



<div class="pro-duzenle">
<div class="baslik"><b><?php echo $l['sosyal_aglar']; ?></b></div>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['facebook']; ?><br/></label>
<input class="input-type-text" type="text" name="aim" size="35" maxlength="99" value="<?php echo $uye_facebook; ?>" />
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['twitter']; ?><br/></label>
<input class="input-type-text" type="text" name="skype" size="35" maxlength="99" value="<?php echo $uye_twitter; ?>" />
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['skype']; ?><br/></label>
<input class="input-type-text" type="text" name="msn" size="35" maxlength="99" value="<?php echo $uye_msn; ?>" />
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['yahoo']; ?><br/></label>
<input class="input-type-text" type="text" name="yahoo" size="35" maxlength="99" value="<?php echo $uye_yahoo; ?>" />
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['icq']; ?><br/></label>
<input class="input-type-text" type="text" name="icq" size="35" maxlength="30" value="<?php echo $uye_icq; ?>" />
</div>
</fieldset>

</div><!-- sosyal ağlar -->


</div><!-- üye bilgileri -->



<div class="profil-baglantilar">
<?php if ($TEMA_RESIM_YUKLEME_ALANLARI): // resim yükleme alanaları - başı ?>
<div class="pro-duzenle">
<div class="baslik"><b><?php echo $l['resim_ayarlari']; ?></b></div>

<fieldset class="avatar-duzenle">
<legend><?php echo $l['gecerli_resim']; ?></legend>
<div style="text-align:center;"><?php echo $gecerli_resim; ?></div>
</fieldset>

<fieldset><?php echo $resim_yukleme_bilgi; ?></fieldset>
<?php if ($ayarlar['uye_resim_yukle'] == 1): // resim yükleme - başı ?>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['resim_yukle']; ?> <small><?php echo $l['resim_yukleyin']; ?></small><br/></label>
<input class="input-type-text" name="resim_yukle" type="file" size="30" />
</div>
</fieldset>

<?php
endif; // resim yükleme - sonu
if ($ayarlar['uye_resim_galerisi'] == 1): // resim galerisi - başı
?>

<fieldset style="text-align:center">
<a href="<?php echo $phpkf_dosyalar['profil']; ?>?kip=pgaleri"><u><?php echo $l['galeriden_resim_sec']; ?></u></a>
<input class="input-type-text" type="hidden" name="uzak_resim2" maxlength="150" value="<?php echo $uzak_resim2; ?>" />
</fieldset>

<?php endif; // resim galerisi - sonu ?>

</div>

<?php endif; // resim yükleme alanaları - sonu ?>

<div class="pro-duzenle">
<div class="baslik"><b><?php echo $l['secenekler']; ?></b></div>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['dogum_goster']; ?><br/></label>
<?php echo $dogum_goster; ?>
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['eposta_goster']; ?><br/></label>
<?php echo $posta_goster; ?>
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['konum_goster']; ?><br/></label>
<?php echo $sehir_goster; ?>
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['cevrimici_goster']; ?><br/></label>
<?php echo $cevrimici_goster; ?>
</div>
</fieldset>

</div><!-- profil duzenle -->

</div>

<div class="clear"></div>

<div class="profil-imza">

<div class="pro-duzenle">
<div class="baslik"><b><?php echo $l['imza']; ?></b></div>
<fieldset class="imza-hakkinda">
<div class="phpkf-duzenle-label">
<textarea class="input-type-text yorum-textarea" cols="66" rows="5" name="imza" onkeyup="imzaUzunluk()" style="width:90%; height:100px"><?php echo $uye_imza; ?></textarea>
</div>
<div style="text-align:center;"><?php echo $imza_bilgi; ?>
<div id="imza_uzunluk"><?php echo $l['karakter_sayisi']; ?>:</div></div>
</fieldset>
</div>
</div>

<div class="profil-hakkinda">

<div class="pro-duzenle">
<div class="baslik"><b><?php echo $l['hakkinda']; ?></b></div>
<fieldset class="imza-hakkinda">
<div class="phpkf-duzenle-label">
<textarea class="input-type-text yorum-textarea" cols="66" rows="5" name="hakkinda" onkeyup="hakkindaUzunluk()" style="width: 90%; height:100px"><?php echo $uye_hakkinda; ?></textarea>
</div>
<div style="text-align:center;"><?php echo $hakkinda_bilgi; ?>
<div id="hakkinda_uzunluk"><?php echo $l['karakter_sayisi']; ?>:</div></div>
<?php echo $javascript_kodu2; ?>
</fieldset>
</div>
</div>





<?php elseif ($TEMA_SAYFA_KIP == 'SIFRE'): // E-Posta ve Şifre Değiştir - başı ?>

<div class="profil-imza">

<div class="pro-duzenle">
<div class="baslik"><b><?php echo $l['sifre_degistir']; ?></b></div>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['gecerli_sifre']; ?> (*) <br><small><?php echo $l['degisiklik_icin_gerekli']; ?></small><br/></label>
<input class="input-type-text" type="password" name="sifre" size="35" maxlength="20" value="" required />
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['yeni_sifre']; ?> (*) <br><small><?php echo $l['degismeyecekse_dokunma']; ?></small><br/></label>
<input class="input-type-text" type="password" name="ysifre" size="35" maxlength="20" value="sifre_degismedi" required />
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['yeni_sifre'].' '.$l['tekrar']; ?> (*) <br><small><?php echo $l['degismeyecekse_dokunma']; ?></small><br/></label>
<input class="input-type-text" type="password" name="ysifre2" size="35" maxlength="20" value="sifre_degismedi" required />

<script type="text/javascript"><!-- //
document.form1.sifre.setAttribute("autocomplete","off");
document.form1.ysifre.setAttribute("autocomplete","off");
document.form1.ysifre2.setAttribute("autocomplete","off");
//  -->
</script>
</div>
</fieldset>

<fieldset>
<div class="phpkf-duzenle-label">
<label class="label"><?php echo $l['eposta_adresi']; ?> (*) <br><small><?php echo $l['eposta_onay_gerektirir'].' '.$l['degismeyecekse_dokunma']; ?></small><br/></label>
<input class="input-type-text" type="email" name="posta" size="35" maxlength="70" value="<?php echo $uye_posta; ?>" required />
</div>
</fieldset>

</div>

</div>
<?php endif; // E-Posta ve Şifre Değiştir - sonu ?>




<div class="profil-dugmeler">
<?php echo $TEMA_ALAN_BILGI; ?><br />
<input class="dugme dugme-mavi" type="submit" value="<?php echo $l['gonder']; ?>" /> &nbsp; &nbsp; 
<input class="dugme dugme-mavi" type="reset" value="<?php echo $l['temizle']; ?>" />
</div>

</form>

</div>
</div>
</div>
