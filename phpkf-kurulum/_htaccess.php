<?php

$dosya_htaccess = '<IfModule mod_rewrite.c>
#Options -FollowSymLinks +SymLinksIfOwnerMatch
RewriteEngine On
RewriteBase '.$site_dizin;



if ($forum_kullan == 1)
$dosya_htaccess .= '

#   phpKF FORUM - BAŞ   #
RewriteRule ^mobil.php mobil/index.php
RewriteRule ^f([1-9][0-9]*)fs([0-9][0-9]*)-(.*).html forum.php?f=$1&fs=$2
RewriteRule ^f([1-9][0-9]*)-(.*).html forum.php?f=$1
RewriteRule ^k([1-9][0-9]*)ks([0-9][0-9]*)-(.*).html konu.php?k=$1&ks=$2
RewriteRule ^k([1-9][0-9]*)-(.*).html konu.php?k=$1
RewriteRule ^k([0-9]+)fs([0-9]+)ks([0-9]+)-(.*).html konu.php?k=$1&fs=$2&ks=$3
RewriteRule ^k([0-9]+)fs([0-9]+)-(.*).html konu.php?k=$1&fs=$2
RewriteRule ^uye-(.*).html profil.php?kim=$1
RewriteRule ^([1-9][0-9]*)-uye-(.*).html profil.php?u=$1
#   phpKF FORUM - SON   #
';



if ($cms_kullan == 1)
$dosya_htaccess .= '

#   phpKF-CMS - BAŞ   #
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-l
RewriteRule (.|\/|.php|.html|.htm)$ index.php [L]
#   phpKF-CMS - SON   #
';

$dosya_htaccess .= '
</IfModule>';

?>