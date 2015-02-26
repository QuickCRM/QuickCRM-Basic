<?php
/*********************************************************************************
 * This file is part of QuickCRM Mobile CE.
 * QuickCRM Mobile CE is a mobile client for SugarCRM
 * 
 * Author : NS-Team (http://www.quickcrm.fr/mobile)
 *
 * QuickCRM Mobile CE is licensed under GNU General Public License v3 (GPLv3) 
 * 
 * You can contact NS-Team at NS-Team - 55 Chemin de Mervilla - 31320 Auzeville - France
 * or via email at quickcrm@ns-team.fr
 * 
 ********************************************************************************/
if (! defined('sugarEntry') || ! sugarEntry)
	die('Not A Valid Entry Point');


function post_install() {
	require_once('custom/modules/Administration/genJSfromSugar.php');

	global $sugar_config;
	$access=createMobileFiles();
	if (!$access) {
		echo "<br><br>FILE PERMISSIONS ARE NOT SET PROPERLY IN custom/QuickCRM.<br>PLEASE SET PERMISSIONS <br>- FOR ALL FILES IN custom/QuickCRM FOLDER AND SUBFOLDERS SIMILAR TO config.php<br>- FOR custom/QuickCRM FOLDER AND SUBFOLDERS SIMILAR TO cache FOLDER<br><br>";
	}

	$webapp=$sugar_config['site_url'].'/mobile';
	$nativeapp=$sugar_config['site_url'];
	echo "<br/>You can access the CRM from a mobile at <strong><br>&nbsp;-&nbsp;Web app : $webapp<br>&nbsp;-&nbsp;QuickCRM for iOS : $nativeapp<br>&nbsp;-&nbsp;QuickCRM for Android : $nativeapp".'</strong>';
}
?>