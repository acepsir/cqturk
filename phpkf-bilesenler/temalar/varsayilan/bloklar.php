<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();

// Bloklar döngü içinde tekrarlandığı için tasarım değişkenler ile taşınmaktadır.
// Blok tasarımlarını aşağıdaki kodlardan, sablon.css dosyasından,
// bağlantılar ve kategori bloklarının içinde oluşan içiçe linkleri ise
// tema_ozellik.php tema dosyasındaki $tema_ozellik_blok_baglanti[]
// dizi değişkeninden değiştirebilirsiniz.




//  SOL BLOKLAR - BAŞI  //

if (isset($TEMA_SOLBLOK)):

$TEMA_SOLBLOK_GOSTER = '
<!-- Sol Bloklar - baş -->
<div class="phpkf-blok-gizle sol-goster" onclick="BlokGizle(1)">&raquo;</div>
<div class="sol-blok">
<div class="phpkf-blok-gizle sol-gizle" onclick="BlokGizle(1)">&raquo;</div>
';

foreach ($TEMA_SOLBLOK as $BLOK):

$TEMA_SOLBLOK_GOSTER .= '
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik">'.$BLOK['BASLIK'].'</div>
<div class="kutu-icerik">'.$BLOK['ICERIK'].'</div>
</div>
';

endforeach;

$TEMA_SOLBLOK_GOSTER .= '</div>
<!-- Sol Bloklar - son -->';

endif;

//  SOL BLOKLAR - SONU  //







//  SAĞ BLOKLAR - BAŞI  //

if (isset($TEMA_SAGBLOK)):

$TEMA_SAGBLOK_GOSTER = '
<!-- Sağ Bloklar - baş -->
<div class="phpkf-blok-gizle sag-goster" onclick="BlokGizle(2)">&laquo;</div>
<div class="sag-blok">
<div class="phpkf-blok-gizle sag-gizle" id="sag-blok-gizle" onclick="BlokGizle(2)">&laquo;</div>
';

foreach ($TEMA_SAGBLOK as $BLOK):

$TEMA_SAGBLOK_GOSTER .= '
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik" style="padding-left:25px">'.$BLOK['BASLIK'].'</div>
<div class="kutu-icerik">'.$BLOK['ICERIK'].'</div>
</div>
';

endforeach;

$TEMA_SAGBLOK_GOSTER .= '</div>
<!-- Sağ Bloklar - son -->';

endif;

//  SAĞ BLOKLAR - SONU  //


?>