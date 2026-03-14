<?php
/*********************************************************************************
 * This file is part of QuickCRM Mobile Full.
 * QuickCRM Mobile Full is a mobile client for Sugar/SuiteCRM
 * 
 * Author : NS-Team (http://www.ns-team.fr)
 * All rights (c) 2011-2023 by NS-Team
 *
 * This Version of the QuickCRM Mobile Full is licensed software and may only be used in 
 * alignment with the License Agreement received with this Software.
 * This Software is copyrighted and may not be further distributed without
 * written consent of NS-Team
 * 
 * You can contact NS-Team at NS-Team - 8 allee Paul Harris, 31200 Toulouse - France
 * or via email at infos@ns-team.fr
 * 
 ********************************************************************************/

// with some versions of SuiteCRM 8, $sugar_config is not reloaded
if (!isset($GLOBALS['suitecrm_version'])) {
	include('suitecrm_version.php');
	$GLOBALS['suitecrm_version'] = $suitecrm_version ;
}

if (!isset($GLOBALS['sugar_config']) && is_file('config.php')) {
    require_once 'config.php'; // provides $sugar_config

	if (is_file('config_override.php')) {
    	require_once 'config_override.php';
	}

	$GLOBALS['sugar_config'] = $sugar_config ;

}

if (!isset($GLOBALS['db'])) {
	$db = DBManagerFactory::getInstance();
	$GLOBALS['db'] = $db ;
}
