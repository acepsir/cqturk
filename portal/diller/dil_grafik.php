<?php
if (!defined('PHPKF_ICINDEN')) exit();

if (@is_file('ayar.php')) $dizin = 'portal/';
else $dizin = '';


if ($site_dili == 'en')
{
	$galeri_simge_sil = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/ingilizce/resimi_sil.png" alt="Resim" border="0">';
	$simge_sil2 = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/ingilizce/sil2.png" alt="Resim" border="0">';
	$galeri_simge_puanver = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/ingilizce/puan_ver.png" alt="Resim" border="0">';
	$galeri_simge_puanverilmis = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/ingilizce/puan_verilmis.png" alt="Resim" border="0">';
	$galeri_simge_girisyap = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/ingilizce/giris_yap.png" alt="Resim" border="0">';
	$galeri_simge_duzelt = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/ingilizce/duzelt.png" alt="Resim" border="0">';
	$yonetim_galerisimge_onayla = '<img src="temalar/'.$temadizini.'/resimler/ingilizce/onayla.png" alt="Resim" border="0">';
	$yonetim_galerisimge_onaylama = '<img src="temalar/'.$temadizini.'/resimler/ingilizce/onaylama_sil.png" alt="Resim" border="0">';
}

else
{
	$galeri_simge_sil = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/resimler/resimi_sil.png" alt="Resim" border="0">';
	$simge_sil2 = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/resimler/sil2.png" alt="Resim" border="0">';
	$galeri_simge_puanver = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/resimler/puan_ver.png" alt="Resim" border="0">';
	$galeri_simge_puanverilmis = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/resimler/puan_verilmis.png" alt="Resim" border="0">';
	$galeri_simge_girisyap = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/resimler/giris_yap.png" alt="Resim" border="0">';
	$galeri_simge_duzelt = '<img src="'.$dizin.'temalar/'.$temadizini.'/resimler/resimler/duzelt.png" alt="Resim" border="0">';
	$yonetim_galerisimge_onayla = '<img src="temalar/'.$temadizini.'/resimler/resimler/onayla.png" alt="Resim" border="0">';
	$yonetim_galerisimge_onaylama = '<img src="temalar/'.$temadizini.'/resimler/resimler/onaylama_sil.png" alt="Resim" border="0">';
}
?>