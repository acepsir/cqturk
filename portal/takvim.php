<?php
/*
 +-=========================================================================-+
 |                             phpKF-Portal v3.00                            |
 +---------------------------------------------------------------------------+
 |                  Telif - Copyright (c) 2007 - 2019 phpKF                  |
 |                    www.phpKF.com   -   phpKF@phpKF.com                    |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkarma ve satma hakları sadece phpKF`ye aittir. |
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  phpKF.com/telif.php  adresini ziyaret edin. |
 +-=========================================================================-+*/


	$phpkf_ayarlar_kip = "WHERE kip='1' OR kip='3' OR kip='5'";
	if (!defined('DOSYA_AYAR')) include '../ayar.php';
	if (!defined('DOSYA_GERECLER')) include '../phpkf-bilesenler/gerecler.php';
	if (!defined('DOSYA_KULLANICI_KIMLIK')) include '../phpkf-bilesenler/kullanici_kimlik.php';
	if (!defined('DOSYA_PORTAL_AYARLAR')) include 'portal_ayarlar.php';
	if (!defined('DOSYA_SEC')) include 'sec.php';
	if (!defined('DOSYA_TEMA_SINIF')) include '../phpkf-bilesenler/sinif_tema_forum.php';
	if (!defined('DOSYA_SEO')) include '../phpkf-bilesenler/seo.php';
	if (!defined('DOSYA_HATA')) include 'hata.php';


	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###
	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###

	if ($portal_bloklar_ayar['takvim_sayfasi'] == 1)
	{
	
	$sayfa_adi = 'Takvim Sayfası';
	
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';
	
	if ((isset($_GET['yil'])) AND (is_numeric($_GET['yil']) == false)) 
	{
	$gelen_yil_sonuc=0;
	$bulundugumuz_yil_arti=date("Y", strtotime("+1 Year"));
	$bulundugumuz_yil_eksi=date("Y", strtotime("-1 Year"));
	$bulundugumuz_yil_simdi=$bulundugumuz_yil_eksi+1;
	}
	else
	{
	if (!isset($_GET['yil']))
	{

	$gelen_yil_sonuc=0;

	$bulundugumuz_yil_arti=date("Y", strtotime("+1 Year"));
	$bulundugumuz_yil_eksi=date("Y", strtotime("-1 Year"));
	$bulundugumuz_yil_simdi=$bulundugumuz_yil_eksi+1;
	}
	else
	{
	if ($_GET['yil'] < '1971')
	{
	$yil1=date("Y");
	$gelen_yil_sonuc='1970'-$yil1;
	$bulundugumuz_yil_arti='1970'+1;
	$bulundugumuz_yil_eksi='1969';
	$bulundugumuz_yil_simdi='1970';
	}
	elseif ($_GET['yil'] > '2036')
	{
	$yil1=date("Y");
	$gelen_yil_sonuc='2037'-$yil1;
	$bulundugumuz_yil_arti='2038';
	$bulundugumuz_yil_eksi='2037'-1;
	$bulundugumuz_yil_simdi='2037';
	}
	else
	{
	$yil1=date("Y");
	$gelen_yil_sonuc=$_GET['yil']-$yil1;
	$bulundugumuz_yil_arti=$_GET['yil']+1;
	$bulundugumuz_yil_eksi=$_GET['yil']-1;
	$bulundugumuz_yil_simdi=$bulundugumuz_yil_eksi+1;
	}
	}
	}
	
	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###
	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###
	
	
	$hangi_yil = '0';
	$hangi_ay = '0';
	

	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###
	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###
	
	$ornek1 = new phpkf_tema();
	$tema_dosyasi = 'temalar/'.$temadizini.'/takvim.php';
	eval($ornek1->tema_dosyasi($tema_dosyasi));
	$hangi_yil = $gelen_yil_sonuc;

	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###
	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###
	
	$bugun_doganlar = '';

	// DOĞUM GÜNÜ OLAN ÜYELER //
	$bu_aygun = date('d-m-');
	$bu_aygun2 = date('d-m');
	$bu_yil = date('Y');

	$vtsorgu = "SELECT id,kullanici_adi,dogum_tarihi FROM $tablo_kullanicilar WHERE dogum_tarihi_goster='1' AND dogum_tarihi LIKE '$bu_aygun%'";
	$doganlar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());

	$kackisi = $vt->num_rows($doganlar_sonuc);
	
	if (!$vt->num_rows($doganlar_sonuc))
	{
	$bugun_doganlar .='<div align="center"><font face="Verdana" style="font-size: 10px; text-align:center;">&nbsp;&nbsp;&nbsp;'.$kp_dil_198.' !</font></div>';
	}else{

	$blok_dogum_gunleri ='';

	while ($bugun_doganlar = $vt->fetch_assoc($doganlar_sonuc))
	{
	$dogum_yili = mb_substr($bugun_doganlar['dogum_tarihi'], -4, 'utf-8');

	$uyenin_yasi = ($bu_yil - $dogum_yili);

	$bugun_doganlar_uye_adi = '';

	if (strlen($bugun_doganlar['kullanici_adi']) > 9)
	{
	$bugun_doganlar_uye_adi .= mb_substr($bugun_doganlar['kullanici_adi'],0,9, 'utf-8').'...';
	}
	else
	{
	$bugun_doganlar_uye_adi .= $bugun_doganlar['kullanici_adi'];
	}

	$blok_dogum_gunleri .='
	<div class="hr_cizgisi">
	&nbsp;&nbsp;&nbsp;<b>'.$kp_dil_199 .': </b>
	&nbsp;&nbsp;&nbsp;<a href="'.linkver($alt_dizin.'profil.php?u='.$bugun_doganlar['id'].'&kim='.$bugun_doganlar['kullanici_adi'],$bugun_doganlar['kullanici_adi']).'">'.$bugun_doganlar_uye_adi.'</a><br>
	&nbsp;&nbsp;&nbsp;<b>'.$kp_dil_200.' :</b> '.$dogum_yili.'<br>
	&nbsp;&nbsp;&nbsp;<b>'.$kp_dil_201.' : </b> '.$uyenin_yasi.'</div>';

	}
	
	$bugun_doganlar .='<div align="center"><font face="Verdana" style="font-size: 10px; text-align:center;">'.$bu_aygun2.' '.$kp_dil_533.'<br>'.$kp_dil_128.' ['.NumaraBicim($kackisi).'] '.$kp_dil_534.'</font></div>';
	
	
	if ($vt->num_rows($doganlar_sonuc) > 10)
	{
	$bugun_doganlar .='<div id="comments_scroll_divwb" style="height:300px; overflow:auto; border: #9e9e9e 0px solid; padding: 0px; font-size: 10px; font-family: Verdana;">
	<div id="comments_scroll_divwb2" onmouseover="document.getElementById(\'comments_scroll_container2\').stop();" onmouseout="document.getElementById(\'comments_scroll_container2\').start();">
	'.$blok_dogum_gunleri.'
	</div>
	</div>

	<script type="text/javascript">//<![CDATA[
	hareketli_yazi(\'comments_scroll_divwb\', \'comments_scroll_container2\', \'up\', \'2\', \'90\', \'300\', \'genmed\');//]]></script>';
		}
	else
	{
	$bugun_doganlar .=$blok_dogum_gunleri;
	}
	}

	$dogum_tarihte_doganlar ='';

	if (isset($_GET['ay']))
	{

	// DOĞUM GÜNÜ OLAN ÜYELER //
	
	if ((isset($_GET['ay'])) AND (is_numeric($_GET['ay']) == false) )
	{
	$_GET['ay']='01';
	$_GET['gun']='01';
	}
	elseif ((!isset($_GET['gun'])) OR (!isset($_GET['ay'])))
	{
	$_GET['ay'] ='01';
	$_GET['gun'] ='01';
	}
	else
	{
	$_GET['ay']=$_GET['ay'];
	$_GET['gun']=$_GET['gun'];
	}

	if ((isset($_GET['gun'])) AND (is_numeric($_GET['gun']) == false))
	{
	$_GET['ay']='01';
	$_GET['gun']='01';
	}
	elseif ((!isset($_GET['gun'])) OR (!isset($_GET['ay'])))
	{
	$_GET['ay'] ='01';
	$_GET['gun'] ='01';
	}
	else
	{
	$_GET['ay']=$_GET['ay'];
	$_GET['gun']=$_GET['gun'];
	}
	


	if ((isset($_GET['gun'])) AND (isset($_GET['ay']))) $bu_aygun = $_GET['gun'].'-'.$_GET['ay'].'-';

	$bu_yil = date('Y');

	$vtsorgu = "SELECT id,kullanici_adi,dogum_tarihi FROM $tablo_kullanicilar WHERE dogum_tarihi_goster='1' AND dogum_tarihi LIKE '$bu_aygun%'";
	$doganlar_sonuc = $vt->query($vtsorgu) or die ($vt->hata_ver());
	
	$kackisi = $vt->num_rows($doganlar_sonuc);
	
	if (!$vt->num_rows($doganlar_sonuc))
	{
	$dogum_tarihte_doganlar .='<div align="center"><font face="Verdana" style="font-size: 10px; text-align:center;">&nbsp;&nbsp;&nbsp;'.$kp_dil_198.' !</font></div>';
	}else{

	$blok_dogum_gunleri ='';

	while ($bugun_doganlar = $vt->fetch_assoc($doganlar_sonuc))
	{
	$dogum_yili = mb_substr($bugun_doganlar['dogum_tarihi'], -4, 'utf-8');

	$uyenin_yasi = ($bu_yil - $dogum_yili);

	$bugun_doganlar_uye_adi = '';

	if (strlen($bugun_doganlar['kullanici_adi']) > 9)
	{
	$bugun_doganlar_uye_adi .= mb_substr($bugun_doganlar['kullanici_adi'],0,9, 'utf-8').'...';
	}
	else
	{
	$bugun_doganlar_uye_adi .= $bugun_doganlar['kullanici_adi'];
	}

	$blok_dogum_gunleri .='
	<div class="hr_cizgisi">
	&nbsp;&nbsp;&nbsp;<b>'.$kp_dil_199 .': </b>
	&nbsp;&nbsp;&nbsp;<a href="'.linkver($alt_dizin.'profil.php?u='.$bugun_doganlar['id'].'&kim='.$bugun_doganlar['kullanici_adi'],$bugun_doganlar['kullanici_adi']).'">'.$bugun_doganlar_uye_adi.'</a><br>
	&nbsp;&nbsp;&nbsp;<b>'.$kp_dil_200.' :</b> '.$dogum_yili.'<br>
	&nbsp;&nbsp;&nbsp;<b>'.$kp_dil_201.' : </b> '.$uyenin_yasi.'</div>';

	}
	$dogum_tarihte_doganlar .='<div align="center"><font face="Verdana" style="font-size: 10px; text-align:center;">'.$_GET['gun'].'-'.$_GET['ay'].' '.$kp_dil_533.'<br>'.$kp_dil_128.' ['.NumaraBicim($kackisi).'] '.$kp_dil_534.'</font></div>';
	if ($vt->num_rows($doganlar_sonuc) > 10)
	{
	$dogum_tarihte_doganlar .='
	<div id="comments_scroll_divwsb" style="height:300px; overflow:auto; border: #9e9e9e 0px solid; padding: 0px; font-size: 10px; font-family: Verdana;">
	<div id="comments_scroll_divwsb2" onmouseover="document.getElementById(\'comments_scroll_container3\').stop();" onmouseout="document.getElementById(\'comments_scroll_container3\').start();">
	'.$blok_dogum_gunleri.'
	</div>
	</div>

	<script type="text/javascript">//<![CDATA[
	hareketli_yazi(\'comments_scroll_divwsb\', \'comments_scroll_container3\', \'up\', \'2\', \'90\', \'300\', \'genmed\');//]]></script>';
	}
	else
	{
	$dogum_tarihte_doganlar .=$blok_dogum_gunleri;
	}
	}

	}
	else
	{
	$dogum_tarihte_doganlar .='<div align="center"><font face="Verdana" style="font-size: 10px; text-align:center;">&nbsp;&nbsp;&nbsp;
	'.$kp_dil_530.'</font></div>';
	}

	
	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###
	###$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$###

	$kac_ay = 12;
	$kac_ay_oldu=1;
	$kac_ay_oldu2=0;
	$kac_ay_oldu3=-1;
	$hangi_aydayiz=1;
	$kac_tablo_oldu=1;
	$kac_tablo=1;

	while ($kac_ay_oldu <= $kac_ay):


	$aylar = array( 
	1=> "$kp_dil_51", 
	2=> "$kp_dil_52",
	3=> "$kp_dil_53",
	4=> "$kp_dil_54",
	5=> "$kp_dil_55",
	6=> "$kp_dil_56",
	7=> "$kp_dil_57",
	8=> "$kp_dil_58",
	9=> "$kp_dil_59",
	10=> "$kp_dil_60",
	11=> "$kp_dil_61",
	12=> "$kp_dil_62");

	$ayAdi = $aylar[$kac_ay_oldu];

	$kacGun = cal_days_in_month(CAL_GREGORIAN, $kac_ay_oldu, date("Y", strtotime("+$hangi_yil Year")));
	$oncekiAy = cal_days_in_month(CAL_GREGORIAN, gmdate("n",  mktime(0,0,0,$hangi_ay+$kac_ay_oldu,1,date("Y", strtotime("+$hangi_yil Year")))), date("Y", strtotime("+$hangi_yil Year")));


	$saat_dilimi = $ayarlar['saat_dilimi'];
	$yaz_saati = date('I');

	if ($saat_dilimi >> 0)
	{
	if ($yaz_saati == 1) $bolge = ($saat_dilimi + 1) * 3600;
	else $bolge = $saat_dilimi * 3600;
	}
	else
	{
	if ($yaz_saati == 1) $bolge = 3600;
	else $bolge = 0;
	}

	$sunucu_saati = time();
	$sunucu_saati += $bolge;

	$bu_ay = gmdate("m", $sunucu_saati);
	$bu_yil = date("Y", $sunucu_saati);
	$gun = gmdate("j", $sunucu_saati);
	$saat = gmdate('H', $sunucu_saati).':';
	$dk_sn = gmdate('i:s', $sunucu_saati);
	$bugun = gmdate("j", $sunucu_saati);
	$gunler = array("$kp_dil_85","$kp_dil_86","$kp_dil_87","$kp_dil_88","$kp_dil_89","<font color='#ff0000'>$kp_dil_90</font>","<font color='#ff0000'>$kp_dil_84</font>");
	$gunler1 = array("$kp_dil_434","$kp_dil_428","$kp_dil_429","$kp_dil_430","$kp_dil_431","$kp_dil_432","$kp_dil_433");
	$hafta_gun = $gunler1[date("w")];


	$ilkgun = date("l",  mktime(0,0,0,$hangi_ay+$kac_ay_oldu,1,date("Y", strtotime("+$hangi_yil Year"))));

	switch($ilkgun)
	{
	case "Monday":
	$ilk = 1;
	break;

	case "Tuesday":
	$ilk = 2;
	break;

	case "Wednesday":
	$ilk = 3;
	break;

	case "Thursday":
	$ilk = 4;
	break;

	case "Friday":
	$ilk = 5;
	break;

	case "Saturday":	
	$ilk = 6;
	break;

	case "Sunday":
	$ilk = 7;
	break;
	}



	if ($ilk == 1)
	{
	$onceki_ay = $oncekiAy;
	}
	elseif ($ilk == 2)
	{
	$onceki_ay = $oncekiAy;
	}
	elseif ($ilk == 3)
	{
	$onceki_ay = $oncekiAy-1;
	}
	elseif ($ilk == 4)
	{
	$onceki_ay = $oncekiAy-2;
	}
	elseif ($ilk == 5)
	{
	$onceki_ay = $oncekiAy-3;
	}
	elseif ($ilk == 6)
	{
	$onceki_ay = $oncekiAy-4;
	}
	elseif ($ilk == 7)
	{
	$onceki_ay = $oncekiAy-5;
	}



	$blok_tab6 ='';
	$blok_tab61 ='';

	
	$blok_tab6 .= '
	<td align="center" valign="middle">
	<table cellspacing="1" align="center" width="100%" cellpadding="0" border="0" bgcolor="#cccccc">';

	if (($hangi_aydayiz == $bu_ay) AND (date("Y", strtotime("+$hangi_yil Year")) == $bu_yil))
	{
	$blok_tab6 .= '
	<tr>
	<td height="25px" class="forum_baslik" valign="middle" width="100%" align="center" bgcolor="#ffffff" colspan="7" style="font-size:10px;">
	<b>'.$bugun.' '.$ayAdi.' '.date("Y", strtotime("+$hangi_yil Year")).' '.$hafta_gun.'</b>
	</td>
	</tr>';
	}
	else
	{
	$blok_tab6 .= '
	<tr>
	<td height="25px" class="forum_baslik" valign="middle" width="100%" align="center" bgcolor="#ffffff" colspan="7" style="font-size:10px;">
	<b>'.$ayAdi.' '.date("Y", strtotime("+$hangi_yil Year")).'</b>
	</td>
	</tr>';
	}

	$blok_tab6 .= '<tr>';

	for($i=0;$i<7;$i++)
	{
	$blok_tab6 .= '<td height="100" width="19" valign="middle" align="center" bgcolor="#ffffff" class="takvim_cubuk2"><b>'.$gunler[$i].'</b></td>';
	}
	$blok_tab6 .= '</tr></table>';


	$blok_tab6 .= '<table cellspacing="1" align="center" style="height:160px; width:100%;" cellpadding="0" border="0" bgcolor="#cccccc">';


	$basla=1;
	$doldur=0;


	for($i=1;$i<7;$i++)
	{
	$hucre=0;
	$blok_tab62 = '';



	for($j=1;$j<=7;$j++)
	{


	if($j < $ilk && $doldur==0)
	{

	$hangi_gun = date("l",  mktime(0,0,0,$hangi_ay+$kac_ay_oldu-1,$onceki_ay,date("Y", strtotime("+$hangi_yil Year"))));

	switch($hangi_gun)
	{
	
	case "Saturday":	
	$blok_tab62 .= '<td height="19" width="19" valign="middle" align="center" class="onceki_ve_sonraki_ay_hafta_sonu">'.$onceki_ay.'</td>';
	break;

	case "Sunday":	
	$blok_tab62 .= '<td height="19" width="19" valign="middle" align="center" class="onceki_ve_sonraki_ay_hafta_sonu">'.$onceki_ay.'</td>';
	break;
	
	default:	
	$blok_tab62 .= '<td height="19" width="19" valign="middle" align="center" class="onceki_ve_sonraki_ay_hafta_ici">'.$onceki_ay.'</td>';
	break;
	}
	
	
	$hucre++;
	$onceki_ay++;
	}

	else
	{

	if($basla <= $kacGun)
	{
	
	

	if (($bugun == $basla) AND ($hangi_aydayiz == $bu_ay) AND (date("Y", strtotime("+$hangi_yil Year")) == $bu_yil))
	{
	
	$blok_tab62 .= '<td height="19" width="19" valign="middle" align="center" class="takvim_sayfa_bugun"><b>'.$basla.'</b></td>';
	$hucre++;
	}
	else
	{

	$hangi_ayda_d = $kac_ay_oldu;
	$hangi_gunde_d = $basla;

	if (strlen($hangi_ayda_d) == 1) $hangi_ayda_d2 = '0'.$hangi_ayda_d;
	else $hangi_ayda_d2 = $hangi_ayda_d;

	if (strlen($hangi_gunde_d) == 1) $hangi_gunde_d2 = '0'.$hangi_gunde_d;
	else $hangi_gunde_d2 = $hangi_gunde_d;

	$hangi_gun = date("l",  mktime(0,0,0,$hangi_ay+$kac_ay_oldu,$basla,date("Y", strtotime("+$hangi_yil Year"))));

	switch($hangi_gun)
	{
	
	case "Saturday":	
	$blok_tab62 .= '<td height="19" width="19" valign="middle" align="center" class="takvim_sayfa_hafta_sonu"><a href="'.linkverPortal('takvim.php?gun='.$hangi_gunde_d2.'&ay='.$hangi_ayda_d2).'"><b>'.$basla.'</b></a></td>';
	break;

	case "Sunday":	
	$blok_tab62 .= '<td height="19" width="19" valign="middle" align="center" class="takvim_sayfa_hafta_sonu"><a href="'.linkverPortal('takvim.php?gun='.$hangi_gunde_d2.'&ay='.$hangi_ayda_d2).'"><b>'.$basla.'</b></a></td>';
	break;
	
	default:	
	$blok_tab62 .= '<td height="19" width="19" valign="middle" align="center" class="takvim_sayfa_hafta_ici"><a href="'.linkverPortal('takvim.php?gun='.$hangi_gunde_d2.'&ay='.$hangi_ayda_d2).'"><b>'.$basla.'</b></a></td>';
	break;
	}

	

	
	$hucre++;
	}

	$basla++;
	$doldur=1;
	}
	}
	}


	if ($hucre != 0) $blok_tab6 .= '<tr>'.$blok_tab62;


	if ( ($hucre != 0) AND ($hucre < 7) )
	{
	$ekle = 7 - $hucre;

	for ($a=1; $a< $ekle+1; $a++)
	{
	
	$hangi_gun = date("l",  mktime(0,0,0,$hangi_ay+$kac_ay_oldu+1,$a,date("Y", strtotime("+$hangi_yil Year"))));

	switch($hangi_gun)
	{
	
	case "Saturday":	
	$blok_tab6 .= '<td height="19" width="19" valign="middle" align="center" class="onceki_ve_sonraki_ay_hafta_sonu">'.$a.'</td>';
	break;

	case "Sunday":	
	$blok_tab6 .= '<td height="19" width="19" valign="middle" align="center" class="onceki_ve_sonraki_ay_hafta_sonu">'.$a.'</td>';
	break;
	
	default:	
	$blok_tab6 .= '<td height="19" width="19" valign="middle" align="center" class="onceki_ve_sonraki_ay_hafta_ici">'.$a.'</td>';
	break;
	}
	
	}
	$blok_tab6 .= '</tr>';
	break;
	}
	}


	$blok_tab6 .= '</table>';

	if (($kac_tablo == $kac_tablo_oldu) AND ($kac_tablo_oldu < 13)) $blok_tab61 .= '<tr>';
	if (($kac_tablo == $kac_tablo_oldu) AND ($kac_tablo_oldu < 13)) $kac_tablo_oldu+=2;

	$kac_tablo++;
	$kac_ay_oldu++;
	$kac_ay_oldu2++;
	$kac_ay_oldu3++;

	if ($hangi_aydayiz < 13) $hangi_aydayiz++;

	
	$takvim_dongu[] = array('{BLOKLAR_SONUC}' => $blok_tab61.$blok_tab6);

	endwhile;

	
	$aylar = array( 
	'01'=> "$kp_dil_51", 
	'02'=> "$kp_dil_52",
	'03'=> "$kp_dil_53",
	'04'=> "$kp_dil_54",
	'05'=> "$kp_dil_55",
	'06'=> "$kp_dil_56",
	'07'=> "$kp_dil_57",
	'08'=> "$kp_dil_58",
	'09'=> "$kp_dil_59",
	'10'=> "$kp_dil_60",
	'11'=> "$kp_dil_61",
	'12'=> "$kp_dil_62");
	$ayAdi1 = $aylar[$bu_ay];
	

	$yil_sec = '<form action="takvim.php" method="get" name="yilagit">
	<select style="width:70px;" class="formlar" name="yil" onchange="if(this.options[this.selectedIndex].value != 0){ document.forms[\'yilagit\'].submit()}">';
	
	$yillar=1970;
	while ($yillar <= 2037)
	{

		$yil_sec .= '<option value="'.$yillar.'"';

		if ($bulundugumuz_yil_simdi == $yillar) $yil_sec .= ' selected="selected"';

		$yil_sec .= '>'.$yillar.'</option>';
		
	$yillar++;
	}
	$yil_sec .= '</select>
	<input class="dugme" type="submit" value="'.$kp_dil_493.'">
	</form>';
	

	$ornek1->dongusuz(array(
	'{BUGUN_DOGANLAR}' => $bugun_doganlar,
	'{TARIHTE_DOGANLAR}' => $dogum_tarihte_doganlar,
	'{YIL_SEC}' => $yil_sec,
	'{TAKVIM}' => $kp_dil_7,
	'{YILI}' => $kp_dil_526,
	'{BUGUN2}' => $kp_dil_527,
	'{BUGUN_DOGAN_UYELER}' => $kp_dil_528,
	'{TARIHTE_DOGAN_UYELER}' => $kp_dil_529,
	'{SAAT}' => $kp_dil_190,
	'{SAAT_SONUCU}' => $saat.$dk_sn,
	'{YIL}' => date("Y", $sunucu_saati),
	'{BUGUN}' => $bugun,
	'{AYADI}' => $ayAdi1,
	'{HAFTA_GUN}' => $hafta_gun,
	'{BULUNDUGUMUZ_YIL_SIMDI}' => $bulundugumuz_yil_simdi,
	'{BULUNDUGUMUZ_YIL_EKSI}' => '<a href="'.linkverPortal('takvim.php?yil='.$bulundugumuz_yil_eksi,$bulundugumuz_yil_eksi).'">&laquo; '.$bulundugumuz_yil_eksi.'</a>',
	'{BULUNDUGUMUZ_YIL_ARTI}' => '<a href="'.linkverPortal('takvim.php?yil='.$bulundugumuz_yil_arti,$bulundugumuz_yil_arti).'">'.$bulundugumuz_yil_arti.' &raquo;</a>',
	'{ALT_DIZIN}' => $alt_dizin,
	'{UST_DIZIN}' => $ust_dizin));

	$ornek1->tekli_dongu('tkv',$takvim_dongu);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(TEMA_UYGULA);
	}




	// Sayfa kapalı uyarısı
	else
	{
	$sayfa_adi = 'Takvim Sayfası';
	if (!defined('DOSYA_BASLIK')) include 'phpkf-bilesenler/sayfa_baslik.php';
	if (!defined('DOSYA_BLOKLAR')) include 'bloklar.php';

	$ileti_sonuc = array(
	'{ILETI_BASLIK}' => $kp_yonetim_103,
	'{ADRES}' => '../'.$phpkf_dosyalar['portal'],
	'{ILETI}' => $kp_dil_323,
	'{EK_YAZI}' => '',
	'{YONLENDIRME}' => $ileti__3,
	'{YONLENDIRME2}' => $ileti__2);

	echo $sag_bloklar_cikti1.$sag_blok_cikti.$sag_bloklar_cikti2;
	eval(hata_iletileri($ileti_sonuc));
	exit();
	}
?>