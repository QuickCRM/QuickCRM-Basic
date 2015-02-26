<?php
if (!defined('sugarEntry')) define('sugarEntry', true);
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/


/**
 * SugarWebServiceImplv4_1.php
 *
 * This class is an implementation class for all the web services.  Version 4_1 adds limit/off support to the
 * get_relationships function.  We also added the sync_get_modified_relationships function call from version
 * one to facilitate querying for related meetings/calls contacts/users records.
 *
 */
require_once('service/v4_1/SugarWebServiceImplv4_1.php');
require_once('service/quickcrm/SugarWebServiceUtilquickcrm.php');

class SugarWebServiceImplquickcrm extends SugarWebServiceImplv4_1
{

    /**
     * Class Constructor Object
     *
     */
    public function __construct()
    {
        self::$helperObject = new SugarWebServiceUtilquickcrm();
    }

	function get_computation($session, $module_name, $query, $compute_fields, $operators) {
	$GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_computation');

	$error = new SoapError();
	if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'list', 'no_access', $error)) {
		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_computation');
		return;
	} // if

	global $beanList, $beanFiles, $current_user;

	$class_name = $beanList[$module_name];
	require_once($beanFiles[$class_name]);
	$seed = new $class_name();

    if (!self::$helperObject->checkQuery($error, $query)) {
		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_entries_count');
    	return;
    } // if

    if (!self::$helperObject->checkACLAccess($seed, 'ListView', $error, 'no_access')) {
    	return;
    }

	$find=array();
	foreach ($compute_fields as $idx => $field){
		$find[] = $operators[$idx] . '(' . $field . ') result_' . $field ; 
	}
	
	$sql = 'SELECT ' . implode(', ', $find) . ' FROM ' . $seed->table_name . ' ';


    $customJoin = $seed->getCustomJoin();
    $sql .= $customJoin['join'];

	// build WHERE clauses, if any
	$where_clauses = array();
	if (!empty($query)) {
	    $where_clauses[] = $query;
	}
	$where_clauses[] = $seed->table_name . '.deleted = 0';

	// if WHERE clauses exist, add them to query
	if (!empty($where_clauses)) {
		$sql .= ' WHERE ' . implode(' AND ', $where_clauses);
	}

	$res = $GLOBALS['db']->query($sql);
	$row = $GLOBALS['db']->fetchByAssoc($res);

	$GLOBALS['log']->info('End: SugarWebServiceImpl->get_entries_count');

	$output_list=array();
	foreach ($compute_fields as $idx => $field){
		$output_list[] = $row['result_'.$field] ; 
	}
	return array(
		'results' => $output_list,
	);
}
    function Qget_entry_list($session, $module_name, $query, $order_by,$offset, $select_fields, $link_name_to_fields_array, $max_results, $deleted, $favorites = false ){

        $GLOBALS['log']->info('Begin: SugarWebServiceImpl->get_entry_list');
        global  $beanList, $beanFiles;
        $error = new SoapError();
        $using_cp = false;
        if($module_name == 'CampaignProspects'){
            $module_name = 'Prospects';
            $using_cp = true;
        }
        if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'read', 'no_access', $error)) {
            $GLOBALS['log']->error('End: SugarWebServiceImpl->get_entry_list - FAILED on checkSessionAndModuleAccess');
            return;
        } // if

        if (!self::$helperObject->checkQuery($error, $query, $order_by)) {
    		$GLOBALS['log']->info('End: SugarWebServiceImpl->get_entry_list');
        	return;
        } // if

        // If the maximum number of entries per page was specified, override the configuration value.
        if($max_results > 0){
            global $sugar_config;
            $sugar_config['list_max_entries_per_page'] = $max_results;
        } // if

        $class_name = $beanList[$module_name];
        require_once($beanFiles[$class_name]);
        $seed = new $class_name();

        if (!self::$helperObject->checkACLAccess($seed, 'list', $error, 'no_access')) {
            $GLOBALS['log']->error('End: SugarWebServiceImpl->get_entry_list - FAILED on checkACLAccess');
            return;
        } // if

        if($query == ''){
            $where = '';
        } // if
        if($offset == '' || $offset == -1){
            $offset = 0;
        } // if
        if($deleted){
            $deleted = -1;
        }
        if($using_cp){
            $response = $seed->retrieveTargetList($query, $select_fields, $offset,-1,-1,$deleted);
        }else
        {
            $response = self::$helperObject->get_data_list($seed,$order_by, $query, $offset,-1,-1,$deleted,$favorites);
        } // else
        $list = $response['list'];

        $output_list = array();
        $linkoutput_list = array();

        foreach($list as $value) {
            if(isset($value->emailAddress)){
                $value->emailAddress->handleLegacyRetrieve($value);
            } // if
            $value->fill_in_additional_detail_fields();

            $output_list[] = self::$helperObject->Qget_return_value_for_fields($value, $module_name, $select_fields);
            if(!empty($link_name_to_fields_array)){
                $linkoutput_list[] = self::$helperObject->Qget_return_value_for_link_fields($value, $module_name, $link_name_to_fields_array);
            }
        } // foreach

        // Calculate the offset for the start of the next page
        $next_offset = $offset + sizeof($output_list);

		$returnRelationshipList = array();
		foreach($linkoutput_list as $rel){
			$link_output = array();
			foreach($rel as $row){
				$rowArray = array();
				foreach($row['records'] as $record){
					$rowArray[]['link_value'] = $record;
				}
				$link_output[] = array('name' => $row['name'], 'records' => $rowArray);
			}
			$returnRelationshipList[]['link_list'] = $link_output;
		}

		$totalRecordCount = $response['row_count'];
        if( !empty($sugar_config['disable_count_query']) )
            $totalRecordCount = -1;

        $GLOBALS['log']->info('End: SugarWebServiceImpl->get_entry_list - SUCCESS');
        return array('result_count'=>sizeof($output_list), 'total_count' => $totalRecordCount, 'next_offset'=>$next_offset, 'entry_list'=>$output_list, 'relationship_list' => $returnRelationshipList);
    } // fn

}
