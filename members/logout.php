<?php
/*
+------------------------------------------------
|   TBDev.net BitTorrent Tracker PHP
|   =============================================
|   by CoLdFuSiOn
|   (c) 2003 - 2011 TBDev.Net
|   http://www.tbdev.net
|   =============================================
|   svn: http://sourceforge.net/projects/tbdevnet/
|   Licence Info: GPL
+------------------------------------------------
|   $Date$
|   $Revision$
|   $Author$
|   $URL$
+------------------------------------------------
*/
if( !defined('IN_TBDEV_REG') )
    header( "Location: {$TBDEV['baseurl']}/404.html" );

dbconn();

logoutcookie();

//header("Refresh: 0; url=./");
Header("Location: {$TBDEV['baseurl']}/index.php");

?>