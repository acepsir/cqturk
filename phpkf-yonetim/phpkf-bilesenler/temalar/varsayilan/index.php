<?php
if (!defined('PHPKF_ICINDEN_TEMA')) exit();
eval(phpkf_tema_sayfa_baslik());
include_once('menu.php');
?>
<div class="orta-blok">
<div class="phpkf-blok-kutusu">
<div class="kutu-baslik"><?php echo $tema_sayfa_baslik; ?></div>
<div class="kutu-icerik">

<table cellspacing="0" cellpadding="0" border="0" align="center" width="96%" style="margin-bottom:20px">
	<tr>
	<td align="left">
<center>
<font size="2"><b><?php echo $ly['phpkf_hosgeldiniz']; ?></b></font>
</center>
<br />
<?php echo $ly['ana_sayfa_bilgi'][0].'<br />'.$ly['ana_sayfa_bilgi'][1]; ?>
	</td>
	</tr>
</table>


<table cellspacing="1" cellpadding="7" border="0" width="96%" align="center" class="tablo-ana" style="margin-bottom:20px">
	<tr class="tablo_ici">
	<td align="left" width="200"><?php echo $ly['acilis_tarihi']; ?>:</td>
	<td align="left"><?php echo $acilis_tarihi; ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle"><?php echo $ly['phpkf_surumu']; ?>:</td>
	<td align="left" valign="bottom" height="25">
<div id="katman_surum2" style="float:left; width:130px; height:20px"><?php echo $phpkf_surum; ?></div>
<div id="katman_surum3" style="float:left; height:20px"><?php echo $surum_denetle; ?></div>
	</td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $ly['mysql_surumu']; ?>:</td>
	<td align="left"><?php echo $vt->get_server_info(); ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $ly['php_surumu']; ?>:</td>
	<td align="left"><?php echo @phpversion(); ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $ly['zend_surumu']; ?>:</td>
	<td align="left"><?php echo @zend_version(); ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $ly['sunucu_os']; ?>:</td>
	<td align="left"><?php echo $sunucu_is; ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $ly['diger']; ?>:</td>
	<td align="left"><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle"><?php echo $ly['gd_kutuphanesi']; ?>:</td>
	<td align="left"><?php echo $gd_bilgisi; ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle"><?php echo $ly['sef_adres_destegi']; ?>:</td>
	<td align="left"><?php echo $htaccess; ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle"><?php echo $ly['gzip_destegi']; ?>:</td>
	<td align="left"><?php echo $gzip; ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle"><?php echo $ly['register_globals_ayari']; ?>:</td>
	<td align="left"><?php echo $register_globals; ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left" valign="middle"><?php echo $ly['safe_mode_ayari']; ?>:</td>
	<td align="left"><?php echo $safe_mode; ?></td>
	</tr>

	<tr class="tablo_ici">
	<td align="left"><?php echo $ly['veritabani_boyutu']; ?>:</td>
	<td align="left"><?php echo $vt_boyutu; ?></td>
	</tr>
</table>


<table cellspacing="0" cellpadding="0" border="0" align="center" width="96%" style="margin-bottom:15px">
	<tr>
	<td align="left" style="line-height:22px">
<?php
echo $ly['vt_yonetim_tikla'].'
<br>'.$ly['mysql_tikla'].'
<br>'.$ly['sunucu_bilgi_tikla'].'
<br>'.$phpkf_duyuru.'
<img width="0" height="0" border="0" src="../phpkf-dosyalar/yukleniyor.gif" alt="">'.$javascript_kodu;
?>
	</td>
	</tr>
</table>


</div>
</div>
</div>