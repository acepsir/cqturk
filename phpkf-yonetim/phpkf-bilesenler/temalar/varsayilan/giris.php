<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
?>

<div class="genislik" style="margin-top:20px;">
<div class="tam-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik kayit-form">

<form name="giris" action="giris.php" method="post" onsubmit="return denetle_giris()">
<input type="hidden" name="kayit_yapildi_mi" value="form_dolu">
<input type="hidden" name="git" value="<?php echo $gelinen_adres; ?>">


<fieldset>
<div class="phpkf-form-label">
<label class="label"><?php echo $l['kullanici_adi']; ?><br/></label>
<input type="text" placeholder="<?php echo $l['kullanici_adi']; ?>" name="kullanici_adi" id="kullanici_adi" value="<?php echo $kulllanici_adi; ?>" class="input-text giris-text" size="20" maxlength="20" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>

<div class="phpkf-form-label">
<label class="label"><?php echo $l['sifre']; ?><br/></label>
<input type="password" placeholder="<?php echo $l['sifre']; ?>" name="sifre" id="sifre" value="" class="input-text giris-text" size="20" maxlength="20" onkeyup="javascript:dogrula_giris(this.id)" required />
</div>

<div class="phpkf-form-label">
<label class="label" for="hatirla"><br/></label>
<label for="hatirla" style="cursor:pointer"><input type="checkbox" name="hatirla" id="hatirla" checked="checked" />&nbsp;<?php echo $l['beni_hatirla']; ?></label>
</div>
</fieldset>

<fieldset>
<div style="text-align:center"><button type="submit" class="dugme dugme-mavi"><?php echo $l['giris_yap']; ?></button></div>
</fieldset>
</form>
</div>

<div class="kutu-footer" style="text-align:center">
<a href="../<?php echo $phpkf_dosyalar['giris']; ?>?kip=etkinlestir"><?php echo $l['etkinlestirme_kodu']; ?></a> &nbsp;|&nbsp; 
<a href="../<?php echo $phpkf_dosyalar['giris']; ?>?kip=yeni_sifre"><?php echo $l['yeni_sifre']; ?></a> &nbsp;| &nbsp;
<a href="../<?php echo $phpkf_dosyalar['kayit']; ?>"><?php echo $l['yeni_kayit']; ?></a>
</div>
</div>

</div>
</div>

<div style="display:none">
<img height="0" border="0" src="phpkf-bilesenler/temalar/varsayilan/resimler/bos.png" alt="." />
<img height="0" border="0" src="phpkf-bilesenler/temalar/varsayilan/resimler/dogru.png" alt="." />
<img height="0" border="0" src="phpkf-bilesenler/temalar/varsayilan/resimler/yanlis.png" alt="." />
</div>

<script type="text/javascript"><!-- //
document.giris.kullanici_adi.focus();
setTimeout("dogrula_giris('sifre')",100);
setTimeout("dogrula_giris('kullanici_adi')",100);
//  -->
</script>