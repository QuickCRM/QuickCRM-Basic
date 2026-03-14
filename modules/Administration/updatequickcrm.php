<?php
/*********************************************************************************
 * This file is part of QuickCRM Mobile CE.
 * QuickCRM Mobile CE is a mobile client for SugarCRM
 * 
 * Author : NS-Team (http://www.ns-team.fr)
 *
 * QuickCRM Mobile CE is licensed under GNU General Public License v3 (GPLv3) 
 * 
 * You can contact NS-Team at NS-Team - 8 allee Paul Harris, 31200 Toulouse - France
 * or via email at infos@ns-team.fr
 * 
 ********************************************************************************/
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('custom/modules/Administration/genJSfromSugar.php');

global $sugar_config;
global $mod_strings;
createMobileFiles();
$nativeapp=$sugar_config['site_url'];
echo $mod_strings['LBL_UPDATE_MSG']." <strong><br>&nbsp;-&nbsp;QuickCRM for iOS : $nativeapp<br>&nbsp;-&nbsp;QuickCRM for Android : $nativeapp".'</strong>';

?>