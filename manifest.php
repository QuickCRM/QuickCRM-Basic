<?php

$manifest = array (
         'acceptable_sugar_versions' => 
          array (
            '6.*',
          ),
          'acceptable_sugar_flavors' =>
          array(
            'CE'
          ),
	  'readme'=>'',
	  'key'=>'',
	  'author' => 'NS-Team',
	  'description' => 'Gives mobile access to SugarCRM data',
	  'icon' => '',
	  'is_uninstallable' => true,
	  'name' => 'QuickCRM Mobile Basic',
	  'published_date' => '2017-10-27',
	  'type' => 'module',
	  'version' => '3.4.0',
	  'remove_tables' => 'false',

	  );
$installdefs = array (
    'id' => 'QuickCRM_Mobile_CE',
	'copy' => 
		array (
			array (
				'from' => '<basepath>/mobile',
				'to' => 'mobile',
			),
			array(
				'from' => '<basepath>/modules/Administration/genJSfromSugar.php',
				'to'   => 'custom/modules/Administration/genJSfromSugar.php'
			),
			array(
				'from' => '<basepath>/modules/Administration/updatequickcrm.php',
				'to'   => 'custom/modules/Administration/updatequickcrm.php'
			),
			array(
				'from' => '<basepath>/modules/QuickCRM',
				'to'   => 'custom/QuickCRM'
			),
			array(
				'from' => '<basepath>/Extension',
				'to'   => 'custom/Extension'
			),
			array(
				'from' => '<basepath>/service/quickcrm',
				'to'   => 'service/quickcrm'
			),
		),

	'language' => 
		array (
			array (
				'from' => '<basepath>/modules/Administration/language/en_us.admin.php',
				'to_module' => 'Administration',
				'language' => 'en_us',
			),
			array (
				'from' => '<basepath>/modules/Administration/language/de_de.admin.php',
				'to_module' => 'Administration',
				'language' => 'de_de',
			),
			array (
				'from' => '<basepath>/modules/Administration/language/fr_FR.admin.php',
				'to_module' => 'Administration',
				'language' => 'fr_FR',
			),
		),

	'administration' => 
		array(
			array(
				'from'=>'<basepath>/modules/Administration/quickcrmadminoption_ce.php',
			),
		),
);

?>
