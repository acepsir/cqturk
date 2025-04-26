<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

eval(phpkf_tema_sayfa_baslik()); // sayfa başlık göster

phpkf_tema_blok_goster(1); // sol blokları göster

phpkf_tema_blok_goster(2); // sağ blokları göster

if ($yazilar): // yazı varsa
?>
<div class="orta-blok">

<?php foreach ($yazilar as $yazi): // yazılar döngü - başı ?>

<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">
<a href="<?php echo $yazi['link']; ?>"><?php echo $yazi['baslik']; ?></a>
</div>

<div class="kutu-icerik">
<div class="yazi-icerik">
<?php echo $yazi['icerik']; ?>
</div>
<div class="clear"></div>
<?php
if ($aramalar = phpkf_tema_etiket($yazi['etiket']))
echo '<div class="yazi-etiket">'.$l['etiketler'].': '.$aramalar.'</div>';
?>
</div>

<div class="kutu-footer">
<span class="kutu-tarih" title="Tarih"><i><?php echo $yazi['yayin_tarihi']; ?></i></span>
<span class="kutu-yazar" title="Yazan"><a href="<?php echo $yazi['profil']; ?>"><?php echo $yazi['yazan']; ?></a></span>
<span class="kutu-okunma" title="Gösterim"><i><?php echo $yazi['goruntuleme'].' '.$l['kez_okundu']; ?></i></span>
<span class="kutu-yorum" title="Yorum"><a href="<?php echo $yazi['link']; ?>#yorumlar"><?php echo $yazi['yorum_sayi'].' '.$l['yorum']; ?></a></span>
</div>

</div>

<?php
// yazılar döngü - sonu
endforeach;

// Sayfalama bağlantıları
echo $TEMA_SAYFALAMA.'</div>';

// hiçbir yazı yoksa
else:
?>

<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $TEMA_SAYFA_BASLIK; ?></div>
<div class="kutu-icerik">

<center>
<br />
<form name="arama_sayfasi" action="<?php echo $arama_adres; ?>" method="get" onsubmit="return aramaYap(this, 'arama', <?php echo $arama_seo; ?>)">
<input class="input-text" name="arama" maxlength="100" placeholder="<?php echo $l['arama']; ?>..." type="text" />
<button class="dugme dugme-mavi" type="submit"><?php echo $l['ara']; ?></button>
</form>
<?php
if ($arama_sonuc_yok) // Arama sonuç vermezse
echo '<br /><br />'.$l['arama_sonuc_yok'].'<br />';
?>
<br />
</center>

</div>
</div>
</div>

<?php endif; // koşul sonu ?>
