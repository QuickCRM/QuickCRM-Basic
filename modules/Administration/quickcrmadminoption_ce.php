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

$admin_option_defs=array();
$admin_option_defs['Administration']['quickcrm_update']= array('Administration','LBL_UPDATE_QUICKCRM_TITLE','LBL_UPDATE_QUICKCRM','./index.php?module=Administration&action=updatequickcrm');
$admin_group_header[]= array('LBL_QUICKCRM','',false,$admin_option_defs, '');


?>