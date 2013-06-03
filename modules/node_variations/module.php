<?php
/**
 * @package ContentExperiments
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    01 Jun 2013
 **/

$Module = array(
	'name'            => 'Node Variations',
 	'variable_params' => true
);

$ViewList = array(
	'action' => array(
		'functions'               => array( 'variations_admin' ),
		'script'                  => 'action.php',
		'params'                  => array( 'NodeID' ),
		'default_navigation_part' => 'ezcontentnavigationpart'
	)
);

$FunctionList = array(
	'variations_admin' => array()
);
?>
