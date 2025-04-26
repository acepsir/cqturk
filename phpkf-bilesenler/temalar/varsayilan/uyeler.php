<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster
?>

<div class="uyeler-orta-blok">

<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $l['uye_listesi']; ?></div>
<div class="kutu-icerik" style="padding:0; padding-bottom:10px">


<div class="uye-arama-alani">
<form name="uyeler" method="get" action="<?php echo $phpkf_dosyalar['uyeler']; ?>">
<div class="arama-input">
<input value="<?php echo $TEMA_UYE_ARAMA; ?>" type="text" name="kul_ara" class="input-text" placeholder="<?php echo $l['uye_ara']; ?>">
<button type="submit" class="dugme dugme-mavi"><?php echo $l['uye_ara']; ?></button>
</div>

<div class="siralama-input">
<select name="sirala" class="input-select">
<?php echo $TEMA_FORM_SIRALAMA; ?>
</select>
<button type="submit" class="dugme dugme-mavi"><?php echo $l['uye_sirala']; ?></button>
</div>

<div style="clear:both;"></div>
</form>
</div>



<div class="uye-listesi">
<?php
if ($uyeler = phpkf_tema_uyeler($uye_kosul)): // üyeler varsa koşul - başı
foreach ($uyeler as $uye): // üyeler döngü - başı
?>

<div class="uye-kutu">
<div class="uye-bilgi">
<div class="uye-avatar">
<img src="<?php echo $uye['resim'] ?>" alt="Resim" />
</div>


<div class="uye-bilgileri">
<div class="bilgiler">
<div class="bilgi-sol">

<span class="kullanici_adi">
<a href="<?php echo $uye['link']; ?>"><?php echo $uye['kullanici_adi']; ?></a>
<?php
$yetki = phpkf_tema_yetkiler($uye['id'], $uye['yetki']);
if ($yetki) echo '<i>(<small class="yetki '.$yetki['renk'].'">'.$yetki['isim'].'</small>)</i>';
?>
</span>

<span class="sehir" title="Konum">
<b><?php echo $l['konum']; ?>:</b>
<?php
if ($uye['sehir_goster'] == 1){
	if ($uye['sehir'] != '') echo $uye['sehir'];
	else echo $l['yok'];
}
else echo $l['gizli'];
?>
</span>

<span class="kayit" title="Kayıt Tarihi">
<b><?php echo $l['kayit']; ?>:</b> <?php echo zaman('d.m.Y', $ayarlar['saat_dilimi'], false, $uye['katilim_tarihi'], 0, true); ?>
</span>

<span class="yorum" title="Yorum Sayısı">
<b><?php echo $l['yorum']; ?>:</b> <?php echo $uye['mesaj_sayisi']; ?>
</span>

</div>
</div>
</div>


<div class="clear"></div>
</div>
</div>

<?php
endforeach; // üyeler döngü - sonu
else: echo '<br /><center>'.$l['uye_arama_sonuc_yok'].'</center>';
endif; // üyeler varsa koşul - sonu
?>



</div>
</div>
<div style="height:10px"></div>
</div>
<?php echo $TEMA_SAYFALAMA; // Sayfalama bağlantıları ?>
</div>
