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


function pre_install() {

// Fix bugs in SugarCRM preventing module installation

	// Some translations install language file for KBDocuments.
	// This make repair/rebuild fail during installation with a message like 
	// Fatal error: Class name must be a valid object or a string in .../include/SubPanel/SubPanelDefinitions.php on line 501
	if (file_exists("modules/KBDocuments")){
		rename("modules/KBDocuments","modules/KBDocumentsFromTranslation");
	}
}
?>