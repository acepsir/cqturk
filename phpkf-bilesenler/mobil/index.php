<?php
if ( (isset($_SERVER['REQUEST_URI'])) AND ($_SERVER['REQUEST_URI'] != '') )
{
	if (preg_match("/\/phpkf-bilesenler\//i", $_SERVER['REQUEST_URI'])) $adres = '../../';
	elseif (preg_match("/\/mobil.php$/i", $_SERVER['REQUEST_URI'])) $adres = '';
	else $adres = '../';
}
else $adres = '../';

header('Location: '.$adres.'index.php');
exit();
?>