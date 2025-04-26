<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


if (!defined('PHPKF_ICINDEN')) exit();


// ifade javascript kodları yükleniyor
include $duzenleyici_dizin.'bilesenler/editor/ifadeler.php';


echo '<script type="text/javascript" src="'.$duzenleyici_dizin.'bilesenler/editor/phpkf/betik_zengin.js"></script>
<script type="text/javascript" src="'.$duzenleyici_dizin.'bilesenler/editor/phpkf/betik_mesaj.js"></script>
<style type="text/css" scoped="scoped">
@import url("'.$duzenleyici_dizin.'bilesenler/editor/phpkf/duzenleyici.css");
</style>';


// HTML için
if ( (isset($duzenleyici_bicim)) AND ($duzenleyici_bicim == 'html') )
{
	echo '<script type="text/javascript" src="'.$duzenleyici_dizin.'bilesenler/editor/phpkf/betik_duyuru.js"></script>';
	$duzenleyici_cevir = "cevirme";
	$duzenleyici_yolla = "yolla('mesaj_icerik_div','mesaj_icerik','yolla')";
}

// BBCode için
else
{
	$duzenleyici_cevir = 'cevir';
	$duzenleyici_yolla = "yolla('mesaj_icerik_div','mesaj_icerik','yolla','cevir')";
}

?>

<script type="text/javascript"><!-- //
var duzenleyici_cevir = "<?php echo $duzenleyici_cevir; ?>";
var duzenleyici_yolla = "<?php echo $duzenleyici_yolla; ?>";
//  -->
</script>



<!--   BBCODE OLUŞTURMA DÜĞMELERİ - BAŞI   -->

<div id="mesaj_tamekran">

<div id="duzenleyici_baslik" class="duzenleyici_baslik">
<div id="duzenleyici_baslik2" class="duzenleyici_baslik2">Düz Metin Düzenleyici</div>
<div onclick="tam_ekran()" class="goster-gizle" id="goster-gizleb" title="Tam Ekran">&#10064;</div>
<div onclick="duzenleyici_degis(duzenleyici_cevir)" class="goster-gizle" id="goster-gizle" title="Zengin Metin Düzenleyiciye Geç">D</div>
<div style="clear:both"></div>
</div>


<div id="bbcode_alt" class="bbcode_alt">

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/kalin.gif" border="0" width="23" height="23" alt="kalın" title="Seçili metni kalın yap" class="bbcode" id="bbcode_kalin" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('kalin','',this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/alticizgili.gif" border="0" width="23" height="23" alt="altı çizgili" title="Seçili metni altı çizgili yap" class="bbcode" id="bbcode_acizgili" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('altcizgili','',this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/yatik.gif" border="0" width="23" height="23" alt="yatık" title="Seçili metni yatık yap" class="bbcode" id="bbcode_yatik" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('yatik','',this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/uzericizgili.gif" border="0" width="23" height="23" alt="üzeri çizgili" title="Seçili metni üzeri çizgili yap" class="bbcode" id="bbcode_ucizgili" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('uzericizgili','',this)"></div>


<div class="sabit_katman">
<table cellspacing="4" cellpadding="1" border="0" id="renk_tablosu" onclick="olay_yuzen_tablo('renk_tablosu')">
<tr><td style="background: #000000"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#000000')">&nbsp;</a></td>
<td style="background: #000080"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#000080')">&nbsp;</a></td>
<td style="background: #333399"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#333399')">&nbsp;</a></td>
<td style="background: #0000ff"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#0000ff')">&nbsp;</a></td>
<td style="background: #3366ff"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#3366ff')">&nbsp;</a></td>
<td style="background: #00ccff"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#00ccff')">&nbsp;</a></td></tr>
<tr><td style="background: #800000"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#800000')">&nbsp;</a></td>
<td style="background: #993366"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#993366')">&nbsp;</a></td>
<td style="background: #ff0000"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#ff0000')">&nbsp;</a></td>
<td style="background: #ff6600"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#ff6600')">&nbsp;</a></td>
<td style="background: #ff9900"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#ff9900')">&nbsp;</a></td>
<td style="background: #ffff00"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#ffff00')">&nbsp;</a></td></tr>
<tr><td style="background: #004400"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#004400')">&nbsp;</a></td>
<td style="background: #808000"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#808000')">&nbsp;</a></td>
<td style="background: #008000"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#008000')">&nbsp;</a></td>
<td style="background: #339966"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#339966')">&nbsp;</a></td>
<td style="background: #99cc00"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#99cc00')">&nbsp;</a></td>
<td style="background: #00ff00"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#00ff00')">&nbsp;</a></td></tr>
<tr><td style="background: #800080"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#800080')">&nbsp;</a></td>
<td style="background: #cc00ff"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#cc00ff')">&nbsp;</a></td>
<td style="background: #ff00ff"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#ff00ff')">&nbsp;</a></td>
<td style="background: #ff66ff"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#ff66ff')">&nbsp;</a></td>
<td style="background: #ff99cc"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#ff99cc')">&nbsp;</a></td>
<td style="background: #cc99ff"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#cc99ff')">&nbsp;</a></td></tr>
<tr><td style="background: #555555"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#555555')">&nbsp;</a></td>
<td style="background: #777777"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#777777')">&nbsp;</a></td>
<td style="background: #999999"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#999999')">&nbsp;</a></td>
<td style="background: #bbbbbb"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#bbbbbb')">&nbsp;</a></td>
<td style="background: #dddddd"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#dddddd')">&nbsp;</a></td>
<td style="background: #ffffff"><a href="javascript:void(0);" onclick="islem('yazi_rengi','#ffffff')">&nbsp;</a></td></tr></table>

<img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/renk.gif" border="0" width="23" height="23" alt="Seçili Yazının Rengini Değiştir" title="Seçili Yazının Rengini Değiştir" class="bbcode" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="olay_yuzen_tablo('renk_tablosu')">
</div>


<div class="sabit_katman">
<table cellspacing="0" cellpadding="3" border="0" id="yaziboyutu_tablosu" onclick="olay_yuzen_tablo('yaziboyutu_tablosu')">
<tr><td style="font-size: 9px;padding-bottom:2px"><a href="javascript:void(0);" onclick="islem('yazi_boyutu','1')">1 Büyüklüğünde</a></td></tr>
<tr><td style="font-size: 11px;padding-bottom:2px"><a href="javascript:void(0);" onclick="islem('yazi_boyutu','2')">2 Büyüklüğünde</a></td></tr>
<tr><td style="font-size: 16px;padding-bottom:5px"><a href="javascript:void(0);" onclick="islem('yazi_boyutu','3')">3 Büyüklüğünde</a></td></tr>
<tr><td style="font-size: 18px;padding-top:5px;padding-bottom:5px"><a href="javascript:void(0);" onclick="islem('yazi_boyutu','4')">4 Büyüklüğünde</a></td></tr>
<tr><td style="font-size: 24px;padding-top:5px;padding-bottom:5px"><a href="javascript:void(0);" onclick="islem('yazi_boyutu','5')">5 Büyüklüğünde</a></td></tr>
<tr><td style="font-size: 30px;padding-top:10px;padding-bottom:10px"><a href="javascript:void(0);" onclick="islem('yazi_boyutu','6')">6 Büyüklüğünde</a></td></tr>
<tr><td style="font-size: 43px;padding-top:10px;padding-bottom:20px"><a href="javascript:void(0);" onclick="islem('yazi_boyutu','7')">7 Büyüklüğünde</a></td></tr></table>

<img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/boyut.gif" border="0" width="23" height="23" alt="Seçili Yazının Boyutunu Değiştir" title="Seçili Yazının Boyutunu Değiştir" class="bbcode" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="olay_yuzen_tablo('yaziboyutu_tablosu')">
</div>


<div class="sabit_katman">
<table cellspacing="0" cellpadding="3" border="0" id="yazitipi_tablosu" onclick="olay_yuzen_tablo('yazitipi_tablosu')">
<tr><td style="font-family: arial"><a href="javascript:void(0);" onclick="islem('yazi_tipi','arial')">Arial</a></td></tr>
<tr><td style="font-family: arial black"><a href="javascript:void(0);" onclick="islem('yazi_tipi','arial black')">Arial Black</a></td></tr>
<tr><td style="font-family: comic sans ms"><a href="javascript:void(0);" onclick="islem('yazi_tipi','comic sans ms')">Comic Sans MS</a></td></tr>
<tr><td style="font-family: courier new"><a href="javascript:void(0);" onclick="islem('yazi_tipi','courier new')">Courier New</a></td></tr>
<tr><td style="font-family: georgia"><a href="javascript:void(0);" onclick="islem('yazi_tipi','georgia')">Georgia</a></td></tr>
<tr><td style="font-family: helvetica"><a href="javascript:void(0);" onclick="islem('yazi_tipi','helvetica')">Helvetica</a></td></tr>

<tr><td style="font-family: impact"><a href="javascript:void(0);" onclick="islem('yazi_tipi','impact')">Impact</a></td></tr>
<tr><td style="font-family: sans-serif"><a href="javascript:void(0);" onclick="islem('yazi_tipi','sans-serif')">Sans-Serif</a></td></tr>
<tr><td style="font-family: tahoma"><a href="javascript:void(0);" onclick="islem('yazi_tipi','tahoma')">Tahoma</a></td></tr>
<tr><td style="font-family: times new roman"><a href="javascript:void(0);" onclick="islem('yazi_tipi','times new roman')">Times New Roman</a></td></tr>
<tr><td style="font-family: verdana"><a href="javascript:void(0);" onclick="islem('yazi_tipi','verdana')">Verdana</a></td></tr></table>

<img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/tip.gif" border="0" width="23" height="23" alt="Seçili Yazının Tipini Değiştir" title="Seçili Yazının Tipini Değiştir" class="bbcode" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onclick="olay_yuzen_tablo('yazitipi_tablosu')">
</div>


<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/kaldir.gif" border="0" width="23" height="23" alt="biçim kaldır" title="Seçili metnin tüm özelliklerini kaldır" class="bbcode" id="bbcode_kaldir" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onclick="islem('kaldir','',null)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/sola.gif" border="0" width="23" height="23" alt="ortala" title="Seçili metni sola yasla" class="bbcode" id="bbcode_sola" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('sola','',this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/ortala.gif" border="0" width="23" height="23" alt="sola" title="Seçili metni ortala" class="bbcode" id="bbcode_ortala" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('ortala','',this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/saga.gif" border="0" width="23" height="23" alt="sağa" title="Seçili metni sağa yasla" class="bbcode" id="bbcode_saga" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('saga','',this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/liste.gif" border="0" width="23" height="23" alt="liste" title="Seçili metinle liste oluştur" class="bbcode" id="bbcode_liste" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('liste','',this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/adres.gif" border="0" width="23" height="23" alt="bağ" title="Bağlantı oluştur (link)" class="bbcode" id="bbcode_bage" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('baglanti',prompt('Adresi Yazınız', 'http://'),this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/adresk.gif" border="0" width="23" height="23" alt="bağ kaldır" title="Seçili bağlantıyı kaldır" class="bbcode" id="bbcode_bagk" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('baglantik','',null)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/resim.gif" border="0" width="23" height="23" alt="resim" title="Resim ekle" class="bbcode" id="bbcode_resim" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('resim',prompt('Resim Adresini Yazınız', 'http://'),null)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/eposta.gif" border="0" width="23" height="23" alt="e-posta" title="E-posta adresi ekle" class="bbcode" id="bbcode_eposta" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('eposta',prompt('E-Posta Adresini Yazınız', 'E-POSTA@ADRES.COM'),null)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/alinti.gif" border="0" width="23" height="23" alt="alıntı" title="Seçili metni alıntı çizelgesi içine al" class="bbcode" id="bbcode_alinti" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('alinti','',this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/kod.gif" border="0" width="23" height="23" alt="kod" title="Seçili metni kod çizelgesi içine al" class="bbcode" id="bbcode_kod" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('kod_alani','',this)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/youtube.gif" border="0" width="23" height="23" alt="youtube" title="Yazılan adresteki youtube videosunu oynat" class="bbcode" id="bbcode_youtube" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('youtube',prompt('Video Adresini Yazınız', 'http://'))"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/video.gif" border="0" width="23" height="23" alt="video" title="Yazılan adresteki videoyu oynat" class="bbcode" id="bbcode_video" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('video',prompt('Video Adresini Yazınız', 'http://'))"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/ses.gif" border="0" width="23" height="23" alt="audio" title="Yazılan adresteki sesi çal" class="bbcode" id="bbcode_audio" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('audio',prompt('Ses Dosyasının Adresini Yazınız', 'http://'))"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/geri.gif" border="0" width="23" height="23" alt="geri" title="Geri al" class="bbcode" id="bbcode_geri" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('geri','',null)"></div>

<div class="sabit_katman"><img src="<?php echo $duzenleyici_dizin; ?>bilesenler/editor/phpkf/dugmeler/ileri.gif" border="0" width="23" height="23" alt="ileri" title="İleri al" class="bbcode" id="bbcode_ileri" onmouseover="olay_fare_ustune(this)" onmouseout="olay_fare_cekme(this)" onmousedown="olay_fare_tik(this)" onmouseup="olay_fare_tik2(this)" onclick="islem('ileri','',null)"></div>


</div>

<!--   BBCODE OLUŞTURMA DÜĞMELERİ - SONU   -->



<div id="mesaj_icerik2"><textarea cols="86" rows="25" name="mesaj_icerik" id="mesaj_icerik" class="formlar_mesajyaz">{FORM_ICERIK}</textarea></div>
<div class="formlar_mesajyaz" id="mesaj_icerik_div" style="display:none">{FORM_ICERIK}</div>
<div id="katman_dugme" style="display:none"></div>

<script type="text/javascript"><!-- //
phpKFduzenleyici(duzenleyici_id);
//  -->
</script>

</div>