<?php
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

require_once('service/v4_1/SugarWebServiceUtilv4_1.php');

class SugarWebServiceUtilquickcrm extends SugarWebServiceUtilv4_1
{
	function Qget_name_value($field,$value){
		return $value;
	}
	
	function Qget_return_value_for_link_fields($bean, $module, $link_name_to_value_fields_array) {
		$GLOBALS['log']->info('Begin: SoapHelperWebServices->get_return_value_for_link_fields');
		global $module_name, $current_user;
		$module_name = $module;
		if($module == 'Users' && $bean->id != $current_user->id){
			$bean->user_hash = '';
		}
		$bean = clean_sensitive_data($bean->field_defs, $bean);

		if (empty($link_name_to_value_fields_array) || !is_array($link_name_to_value_fields_array)) {
			$GLOBALS['log']->debug('End: SoapHelperWebServices->get_return_value_for_link_fields - Invalid link information passed ');
			return array();
		}

		if ($this->isLogLevelDebug()) {
			$GLOBALS['log']->debug('SoapHelperWebServices->get_return_value_for_link_fields - link info = ' . var_export($link_name_to_value_fields_array, true));
		} // if
		$link_output = array();
		foreach($link_name_to_value_fields_array as $link_name_value_fields) {
			if (!is_array($link_name_value_fields) || !isset($link_name_value_fields['name']) || !isset($link_name_value_fields['value'])) {
				continue;
			}
			$link_field_name = $link_name_value_fields['name'];
			$link_module_fields = $link_name_value_fields['value'];
			if (is_array($link_module_fields) && !empty($link_module_fields)) {
				$result = $this->getRelationshipResults($bean, $link_field_name, $link_module_fields);
				if (!$result) {
					$link_output[] = array('name' => $link_field_name, 'records' => array());
					continue;
				}
				$list = $result['rows'];
				$filterFields = $result['fields_set_on_rows'];
				if ($list) {
					$rowArray = array();
					foreach($list as $row) {
						$nameValueArray = array();
						foreach ($filterFields as $field) {
							$nameValue = array();
							if (isset($row[$field])) {
								$nameValueArray[$field] = $this->Qget_name_value($field, $row[$field]);
							} // if
						} // foreach
						$rowArray[] = $nameValueArray;
					} // foreach
					$link_output[] = array('name' => $link_field_name, 'records' => $rowArray);
				} // if
			} // if
		} // foreach
		$GLOBALS['log']->debug('End: SoapHelperWebServices->get_return_value_for_link_fields');
		if ($this->isLogLevelDebug()) {
			$GLOBALS['log']->debug('SoapHelperWebServices->get_return_value_for_link_fields - output = ' . var_export($link_output, true));
		} // if
		return $link_output;
	} // fn
	
	function Qget_name_value_list_for_fields($value, $fields) {
		$GLOBALS['log']->info('Begin: SoapHelperWebServices->get_name_value_list_for_fields');
		global $app_list_strings;
		global $invalid_contact_fields;

		$list = array();
		if(!empty($value->field_defs)){
			if(empty($fields))$fields = array_keys($value->field_defs);
			if(isset($value->assigned_user_name) && in_array('assigned_user_name', $fields)) {
				$list['assigned_user_name'] = $this->Qget_name_value('assigned_user_name', $value->assigned_user_name);
			}
			if(isset($value->modified_by_name) && in_array('modified_by_name', $fields)) {
				$list['modified_by_name'] = $this->Qget_name_value('modified_by_name', $value->modified_by_name);
			}
			if(isset($value->created_by_name) && in_array('created_by_name', $fields)) {
				$list['created_by_name'] = $this->Qget_name_value('created_by_name', $value->created_by_name);
			}

			$filterFields = $this->filter_fields($value, $fields);


			foreach($filterFields as $field){
				$var = $value->field_defs[$field];
				if(isset($value->$var['name'])){
					$val = $value->$var['name'];
					$type = $var['type'];

					if(strcmp($type, 'date') == 0){
						$val = substr($val, 0, 10);
					}elseif(strcmp($type, 'enum') == 0 && !empty($var['options'])){
						//$val = $app_list_strings[$var['options']][$val];
					}

					$list[$var['name']] = $this->Qget_name_value($var['name'], $val);
				} // if
			} // foreach
		} // if
		$GLOBALS['log']->info('End: SoapHelperWebServices->get_name_value_list_for_fields');
		if ($this->isLogLevelDebug()) {
			$GLOBALS['log']->debug('SoapHelperWebServices->get_name_value_list_for_fields - return data = ' . var_export($list, true));
		} // if
		return $list;

	} // fn

	function Qget_return_value_for_fields($value, $module, $fields) {
		$GLOBALS['log']->info('Begin: SoapHelperWebServices->get_return_value_for_fields');
		global $module_name, $current_user;
		$module_name = $module;
		if($module == 'Users' && $value->id != $current_user->id){
			$value->user_hash = '';
		}
		$value = clean_sensitive_data($value->field_defs, $value);
		$GLOBALS['log']->info('End: SoapHelperWebServices->get_return_value_for_fields');
		return Array('id'=>$value->id,
					'module_name'=> $module,
					'name_value_list'=>$this->Qget_name_value_list_for_fields($value, $fields)
					);
	}

    /**
     * Equivalent of get_list function within SugarBean but allows the possibility to pass in an indicator
     * if the list should filter for favorites.  Should eventually update the SugarBean function as well.
     *
	 * NS-TEAM : - fix bug with order by 
     */
    function get_data_list($seed, $order_by = "", $where = "", $row_offset = 0, $limit=-1, $max=-1, $show_deleted = 0, $favorites = false)
	{
		global $sugar_version;
		$GLOBALS['log']->debug("get_list:  order_by = '$order_by' and where = '$where' and limit = '$limit'");
		if(isset($_SESSION['show_deleted']))
		{
			$show_deleted = 1;
		}
		// Fix bug with sort order in get_entry_list
		if ($sugar_version < '6.5.15') {
			$order_by=$seed->process_order_by($order_by, null);
		}

		$params = array();
		if(!empty($favorites)) {
		  $params['favorites'] = true;
		}

		$query = $seed->create_new_list_query($order_by, $where,array(),$params, $show_deleted);
		return $seed->process_list_query($query, $row_offset, $limit, $max, $where);
	}
}