<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns:html="http://www.w3.org/TR/REC-html40" xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Site Haritası</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
font-family:"Lucida Grande","Lucida Sans Unicode",Tahoma,Verdana;
font-size:13px;
margin:0;
background: #EEEEEE;
}
#kapsayici{
width:80%;
margin:0 auto;
margin-top:20px;
margin-bottom:20px;
border-radius:5px;
padding:10px;
}
#kapsayici h1{
text-align:center;
color:#fc0;
font-size:16px;
}
#govde{
background: #FFFFFF;
margin:0 auto;
}
table{
background:#DDDDDD;
}
td{
color:#555;
font-size:11px;
background:#FFFFFF;
padding:6px;
}
th{
text-align:center;
padding:8px 8px 6px 10px;
font-size:11px;
color:#555;
background:#f3f3f3;
}
a{
color: #555555;
text-decoration: none;
}
a:hover{
color:#333333;
text-decoration:None;
}
#footer{
text-align:center;
padding-top:10px;
color:#ccc;
font-size:12px;
font-weight:bold;
}
</style>
</head>
<body>
<div id="kapsayici">
<div id="govde">
<table cellpadding="5" width="100%" cellspacing="1">
<tr>
<th style="text-align:left;">Adres</th>
<th>Kalite</th>
<th>Güncelleme Aralığı</th>
<th>Son Güncelleme</th>
</tr>
<xsl:variable name="lower" select="'abcdefghijklmnopqrstuvwxyz'"/>
<xsl:variable name="upper" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'"/>
<xsl:for-each select="sitemap:urlset/sitemap:url">
<tr>
<xsl:if test="position() mod 2 != 1">
<xsl:attribute  name="class">high</xsl:attribute>
</xsl:if>
<td>
<xsl:variable name="itemURL">
<xsl:value-of select="sitemap:loc"/>
</xsl:variable>
<a href="{$itemURL}">
<xsl:value-of select="sitemap:loc"/>
</a>
</td>
<td style="text-align:left;">
<xsl:value-of select="concat(sitemap:priority*100,'%')"/>
</td>
<td style="text-align:left;">
<xsl:value-of select="concat(translate(substring(sitemap:changefreq, 1, 1),concat($lower, $upper),concat($upper, $lower)),substring(sitemap:changefreq, 2))"/>
</td>
<td style="text-align:left;">
<xsl:value-of select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)))"/>
</td>
</tr>
</xsl:for-each>
</table>
</div>
<div id="footer">
<a href="https://www.phpkf.com" target="_blank">Yazılım: phpKF &#169; 2007-2019</a>
</div>
</div>
</body>
</html>
</xsl:template>
</xsl:stylesheet>